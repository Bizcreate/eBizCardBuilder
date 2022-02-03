<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;
use App\Models\Business;
use App\Models\PlanOrder;
use App\Models\Order;
use App\Models\Plan;
use App\Models\Utility;
use App\Models\LandingPageSection;
class HomeController extends Controller
{
    use \RachidLaasri\LaravelInstaller\Helpers\MigrationsHelper;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        
        if(!file_exists(storage_path() . "/installed"))
        {
            header('location:install');
            die;
        }
        else
        {
            if(\Auth::user()->type == 'super admin'){
                $user                       = \Auth::user();
                $user['total_user']         = $user->countCompany();
                $user['total_paid_user']    = $user->countPaidCompany();
                $user['total_orders']       = PlanOrder::total_orders();
                $user['total_orders_price'] = PlanOrder::total_orders_price();
                $user['total_plan']         = Plan::total_plan();
                $user['most_purchese_plan'] = (!empty(Plan::most_purchese_plan()) ? Plan::most_purchese_plan()->total : 0);
                $chartData                  = $this->getPlanOrderChart(['duration' => 'week']);

                return view('dashboard.admin_dashboard',compact('user', 'chartData'));
            }else{
                $total_bussiness = \App\Models\Business::count();
                $total_app = \App\Models\Appointment_deatail::count();
                $chartData = $this->getOrderChart(['duration' => 'month']);
        
                $user      = \Auth::user();
                // $store     = Store::where('id', $user->current_store)->first();
                // $slug      = $store->slug;
        
                $visitor_url   = \DB::table('visitor')->selectRaw("count('*') as total, url")->groupBy('url')->orderBy('total', 'DESC')->get();
                $user_device   = \DB::table('visitor')->selectRaw("count('*') as total, device")->groupBy('device')->orderBy('device', 'DESC')->get();
                $user_browser  = \DB::table('visitor')->selectRaw("count('*') as total, browser")->groupBy('browser')->orderBy('browser', 'DESC')->get();
                $user_platform = \DB::table('visitor')->selectRaw("count('*') as total, platform")->groupBy('platform')->orderBy('platform', 'DESC')->get();
        
        
                // dd($user_platform);
                $devicearray          = [];
                $devicearray['label'] = [];
                $devicearray['data']  = [];
        
                foreach($user_device as $name => $device)
                {
                    if(!empty($device->device))
                    {
                        $devicearray['label'][] = $device->device;
                    }
                    else
                    {
                        $devicearray['label'][] = 'Other';
                    }
                    $devicearray['data'][] = $device->total;
                }
        
                $browserarray          = [];
                $browserarray['label'] = [];
                $browserarray['data']  = [];
        
                foreach($user_browser as $name => $browser)
                {
                    $browserarray['label'][] = $browser->browser;
                    $browserarray['data'][]  = $browser->total;
                }
                $platformarray          = [];
                $platformarray['label'] = [];
                $platformarray['data']  = [];
        
                foreach($user_platform as $name => $platform)
                {
                    $platformarray['label'][] = $platform->platform;
                    $platformarray['data'][]  = $platform->total;
                }
                return view('dashboard.dashboard',compact('total_bussiness','total_app', 'visitor_url', 'devicearray', 'browserarray', 'platformarray','chartData'));

            }
        }
        
    }
    public function getOrderChart($arrParam)
    {
        $user  = \Auth::user();
       
        $arrDuration = [];
        if($arrParam['duration'])
        {
            if($arrParam['duration'] == 'month')
            {
                $previous_month = strtotime("-1 month +2 day");
                for($i = 0; $i < 30; $i++)
                {
                    $arrDuration[date('Y-m-d', $previous_month)] = date('d-M', $previous_month);
                    $previous_month                              = strtotime(date('Y-m-d', $previous_month) . " +1 day");
                }
            }
        }
        $arrTask          = [];
        $arrTask['label'] = [];
        $arrTask['data']  = [];


        foreach($arrDuration as $date => $label)
        {



            $data['visitor'] = \DB::table('visitor')->select(\DB::raw('count(*) as total'))->whereDate('created_at', '=', $date)->first();
            $uniq            = \DB::table('visitor')->select('ip')->distinct()->whereDate('created_at', '=', $date)->get();

            $data['unique']           = $uniq->count();
            $arrTask['label'][]       = $label;
            $arrTask['data'][]        = $data['visitor']->total;
            $arrTask['unique_data'][] = $data['unique'];
        }

        $business = Business::all();
        $array_app = [];
        foreach($business as $b){
            $d['data'] = [];
            $d['name'] = $b->title;
            foreach($arrDuration as $date => $label)
            {
                $d['data'][] = \DB::table('appointment_deatails')->where('business_id',$b->id)->whereDate('created_at', '=', $date)->count();  
            }
            $array_app[] = $d;
        }
        $arrTask['data'] =$array_app; 
        return $arrTask;
    }
    public function getPlanOrderChart($arrParam)
    {
        $arrDuration = [];
        if($arrParam['duration'])
        {
            if($arrParam['duration'] == 'week')
            {
                $previous_week = strtotime("-2 week +1 day");
                for($i = 0; $i < 14; $i++)
                {
                    $arrDuration[date('Y-m-d', $previous_week)] = date('d-M', $previous_week);
                    $previous_week                              = strtotime(date('Y-m-d', $previous_week) . " +1 day");
                }
            }
        }

        $arrTask          = [];
        $arrTask['label'] = [];
        $arrTask['data']  = [];
        foreach($arrDuration as $date => $label)
        {

            $data               = PlanOrder::select(\DB::raw('count(*) as total'))->whereDate('created_at', '=', $date)->first();
            $arrTask['label'][] = $label;
            $arrTask['data'][]  = $data->total;
        }

        return $arrTask;
    }
    public function landingPage()
    {
        if(!file_exists(storage_path() . "/installed"))
        {
            header('location:install');
            die;
        }
        else
        {
         
            if(Utility::getValByName('display_landing_page') == 'off')
            {
                return redirect()->route('login');
            }
            else
            {
                $get_section = LandingPageSection::orderBy('section_order', 'ASC')->get();
                $plans = Plan::get();
                return view('layouts.landing', compact('plans','get_section'));
            }
        }
    }
    
}
