<?php

namespace App\Models;
use App\Models\Business;
use App\Models\PlanOrder;
use App\Models\Plan;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'avatar',
        'lang',
        'delete_status',
        'plan',
        'plan_expire_date',
        'created_by',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function creatorId()
    {
        if($this->type == 'company' || $this->type == 'super admin')
        {
            return $this->id;
        }
        else
        {
            return $this->created_by;
        }
    }
    public function currentLanguage()
    {
        return $this->lang;
    }
    public function countCompany()
    {
        return User::where('type', '=', 'company')->where('created_by', '=', $this->creatorId())->count();
    }
    public function countPaidCompany()
    {
        return User::where('type', '=', 'company')->whereNotIn(
            'plan', [
                      0,
                      1,
                  ]
        )->where('created_by', '=', \Auth::user()->id)->count();
    }
    public function totalBusiness($id)
    {
        return Business::where('created_by', '=', $id)->count();
    }

    public function currentPlan()
    {
        return $this->hasOne('App\Models\Plan', 'id', 'plan');
    }
    // public function totalCompanyCustomer($id)
    // {
    //     return Customer::where('created_by', '=', $id)->count();
    // }
    public function assignPlan($planID)
    {
        $plan = Plan::find($planID);
       
        if($plan)
        {
            $this->plan = $plan->id;
            $business   = Business::where('created_by', '=', \Auth::user()->id)->get();
            if(strtolower($plan->duration) == 'month')
            {
                
                $this->plan_expire_date = Carbon::now()->addMonths(1)->isoFormat('YYYY-MM-DD');
            }
            elseif(strtolower($plan->duration) == 'year')
            {
                $this->plan_expire_date = Carbon::now()->addYears(1)->isoFormat('YYYY-MM-DD');
            }
            if($plan->business == -1)
            {
                foreach($business as $b)
                {
                    $b->status = 'active';
                    $b->save();
                }
            }
            else
            {
                $businessCount = 0;
                foreach($business as $b)
                {
                    $businessCount++;
                    if($businessCount <= $plan->business)
                    {
                        $b->status = 'active';;
                        $b->save();
                    }
                    else
                    {
                        $b->status = 'lock';
                        $b->save();
                    }
                }
            }
            $this->save();
            return ['is_success' => true];
        }
        else
        {
            return [
                'is_success' => false,
                'error' => 'Plan is deleted.',
            ];
        }
    }
    public function planPrice()
    {
        $user = \Auth::user();
        if($user->type == 'super admin')
        {
            $userId = $user->id;
        }
        else
        {
            $userId = $user->created_by;
        }

        return \DB::table('settings')->where('created_by', '=', $userId)->get()->pluck('value', 'name');

    }
    public function dateFormat($date)
    {

        return date('d-m-Y',strtotime($date));
    }
    public function getPlanThemes(){
        $plan = Plan::find($this->plan);
        if($plan){
            $themes = $plan->themes;
            if(!empty($themes)){
               return explode(',',$themes);
            }else{
                return [];
            }
        }else{
            return [];
        }
    }
    public function getTotalAppoinments(){
        return Appointment_deatail::where('business_id',$this->id)->count();
    }

    public function getMaxBusiness(){
        $plan = Plan::find($this->plan);
        if($plan){
            return $plan->business;
        }else{
            return 0;
        }
    }

}
