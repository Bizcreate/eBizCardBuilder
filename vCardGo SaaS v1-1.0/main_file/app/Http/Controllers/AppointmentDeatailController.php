<?php

namespace App\Http\Controllers;

use App\Models\Appointment_deatail;
use App\Models\Business;

use Illuminate\Http\Request;

class AppointmentDeatailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $appointment_deatails = Appointment_deatail::orderBy('id','DESC')->get();
        $no = 0;
        foreach ($appointment_deatails as $key => $value) {
            $value->no = $no;
            $business_name = Business::where('id',$value->business_id)->pluck('title')->first();
            $value->business_name = $business_name;
            $no++;
        }

       return view('appointments.index',compact('appointment_deatails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();
        $business_id = $request->business_id;
        $business = Business::where('id',$business_id)->first();
        Appointment_deatail::create([
            'business_id' => $request->business_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'date' => $request->date,
            'time' => $request->time,
            'created_by' => $business->created_by
        ]);       

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment_deatail  $appointment_deatail
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment_deatail $appointment_deatail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment_deatail  $appointment_deatail
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment_deatail $appointment_deatail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment_deatail  $appointment_deatail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment_deatail $appointment_deatail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment_deatail  $appointment_deatail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment_deatail $appointment_deatail,$id)
    {
        $app = Appointment_deatail::find($id);
        if($app){
            $app->delete();
            return redirect()->back()->with('success', __('Appointment successfully deleted.'));
        }
        return redirect()->back()->with('error', __('Appointment not found.'));
        //
    }
    public function getCalenderAllData($id=null){
       
        $objUser          = \Auth::user();
        if($id== null){
            $appointents = Appointment_deatail::get();
        }else{
            $appointents = Appointment_deatail::where('business_id',$id)->get();
        }
        $arrayJson = [];
        foreach($appointents as $appointent)
        {

            $time = explode('-',$appointent->time);
            $stime = isset($time[0])?trim($time[0]).':00':'00:00:00';
            $etime = isset($time[1])?trim($time[1]).':00':'00:00:00';
            $start_date = date("Y-m-d",strtotime($appointent->date)).' '.$stime;
            $end_date = date("Y-m-d",strtotime($appointent->date)).' '.$etime;
           
            $arrayJson[] = [
                "title" =>'('.$stime .' - '. $etime.') '.$appointent->name .'-'. $appointent->getBussinessName(),
                "start" => $start_date,
                "end" => $end_date ,
                "app_id" => $appointent->id,
                "url" => route('appointment.details',$appointent->id),
                "className" =>  'bg-info',
                "allDay" => true,
            ];
        }
        return view('appointments.calender',compact('arrayJson'));

    }
    public function getAppointmentDetails($id){
        $ad = Appointment_deatail::find($id);
        return view('appointments.calender-modal',compact('ad'));
    }
}
