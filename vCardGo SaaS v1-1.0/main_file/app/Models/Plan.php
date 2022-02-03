<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'price',
        'duration',
        'description',
        'business',
        'themes'
    ];

    public static $arrDuration = [
        'Unlimited' => 'Unlimited',
        'Month' => 'Per Month',
        'Year' => 'Per Year',
    ];

    public static function total_plan()
    {
        return Plan::count();
    }

    public static function most_purchese_plan()
    {
        $free_plan = Plan::where('price', '<=', 0)->first()->id;

        return User:: select('plans.name', 'plans.id', \DB::raw('count(*) as total'))->join('plans', 'plans.id', '=', 'users.plan')->where('type', '=', 'owner')->where('plan', '!=', $free_plan)->orderBy('total', 'Desc')->groupBy('plans.name', 'plans.id')->first();
    }

    public function transkeyword()
    {
        $arr = [
            __('Per Month'),
            __('Per Year'),
            __('Year'),
        ];
    }
    public function getThemes(){
        if(!empty($this->themes)){
            return explode(',',$this->themes);
        }else{
            return [];
        }
    }
    public static function getThemescount(){
        if(!empty($this->themes)){
            return explode(',',$this->themes);
        }else{
            return [];
        }
    }
}
