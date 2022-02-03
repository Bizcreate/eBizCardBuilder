<?php

namespace App\Http\Controllers;
use JeroenDesloovere\VCard\VCard;
use App\Models\Business;
use App\Models\Businessfield;
use App\Models\Utility;
use App\Models\business_hours;
use App\Models\appoinment;
use App\Models\service;
use App\Models\social;
use App\Models\ContactInfo;
use App\Models\testimonial;
use Illuminate\Http\Request;
use Storage;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $business = Business::where('created_by',\Auth::user()->id)->orderBy('id','DESC')->get();
        $no = 0;
        foreach ($business as $key => $value) {
            $value->no = $no;
            $no++;
        }
        return view('business.index',compact('business'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $businessfields = Utility::getFields();
        return view('business.create',compact('businessfields'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $max_business = \Auth::user()->getMaxBusiness();
        $count = Business::where('created_by',\Auth::user()->id)->count();
        if($count < $max_business || $max_business == -1)
        {
            $validator = \Validator::make(
                $request->all(), [
                    'title' => 'required',
                ]
            );

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $slug = Utility::createSlug('businesses', $request->title);
            $user= Business::create([
                'title' => $request->title,
                'slug'  => $slug,
                'card_theme'=>'theme1',
                'theme_color'=>'color1-theme1',
                'created_by' => \Auth::user()->id
            ]);
            return redirect()->back()->with('success',__('Business Created Successfully'));
        }else{
            return redirect()->back()->with('error', __('Your user business is over, Please upgrade plan.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function show(Business $business)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function edit(Business $business,$id)
    {
        
        $business = Business::where('id',$id)->first();
        $businessfields = Utility::getFields();
        $businesshours = business_hours::where('business_id',$id)->first();
        $appoinment = appoinment::where('business_id',$id)->first();
        $appoinment_hours = [];
        if(!empty($appoinment->content))
        {
            $appoinment_hours = json_decode($appoinment->content);
        }
        $contactinfo = ContactInfo::where('business_id',$id)->first();
        $contactinfo_content = [];
        if(!empty($contactinfo->content))
        {
            $contactinfo_content = json_decode($contactinfo->content);
        }
        $services = service::where('business_id',$id)->first();
        $services_content = [];
        if(!empty($services->content))
        {
            $services_content = json_decode($services->content);
        }
        $testimonials = testimonial::where('business_id',$id)->first();
        $testimonials_content = [];
        if(!empty($testimonials->content))
        {
            $testimonials_content = json_decode($testimonials->content);
        }
        $sociallinks = social::where('business_id',$id)->first();
        $social_content = [];
        if(!empty($sociallinks->content))
        {
            $social_content = json_decode($sociallinks->content);
        }
        $days = business_hours::$days;
        $business_hours = [];
        if(!empty($businesshours->content))
        {
            $business_hours = json_decode($businesshours->content);
        }
        return view('business.edit',compact('businessfields','appoinment_hours','contactinfo','contactinfo_content','appoinment','services_content','services','testimonials_content','testimonials','social_content','sociallinks','businesshours','business_hours','business','days','id'));
    }
  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Business $business)
    {
   
        if(!is_null($business)){
            if(is_null($business->banner)){
                $this->validate(
                    $request, ['banner' => 'required',]
                );
            }
            if(is_null($business->logo)){
                $this->validate(
                    $request, ['logo' => 'required',]
                );
            }
            $this->validate(
                    $request, [
                        'title' => 'required',
                        'sub_title' => 'required',
                        'description' => 'required',
                    ]
            );
            $business->title = $request->title;
            $business->sub_title = $request->sub_title;
            $business->description = $request->description;
            $business->meta_keyword = $request->meta_keyword;
            $business->meta_description = $request->meta_description;
            $business->google_analytic = $request->google_analytic;
            $business->fbpixel_code = $request->fbpixel_code;
            $business->customjs = $request->customjs;

            if($request->hasFile('logo')){
                $logo = $request->file('logo');
                $ext = $logo->getClientOriginalExtension();
                $fileName = 'logo_'.time().rand().'.'.$ext;
                $request->file('logo')->storeAs('card_logo', $fileName);
                Storage::delete('card_logo/'.$business->logo);
                $business->logo = $fileName;
            }

            if($request->hasFile('banner')){
                $banner = $request->file('banner');
                $ext = $banner->getClientOriginalExtension();
                $fileName = 'banner'.time().rand().'.'.$ext;
                $request->file('banner')->storeAs('card_banner', $fileName);
                Storage::delete('card_banner/'.$business->banner);
                $business->banner = $fileName;
            }
            $business_id = $request->business_id;
            if($request->is_business_hours_enabled == "on"){
                $requestAll = $request->all();
                $days       = business_hours::$days;
                $business_hours = [];
                foreach($days as $k => $day)
                {
                    $time['days']       = isset($requestAll['days_' . $k]) ? 'on' : 'off';
                    $time['start_time'] = $requestAll['start-' . $k];
                    $time['end_time']   = $requestAll['end-' . $k];
                    $business_hours[$k]    = $time;
                }
                $business_hours = json_encode($business_hours);
                $businessHours = business_hours::where('business_id', $business_id)->first();
                if(!is_null($businessHours)){
                    $businessHours->content = $business_hours;
                    $businessHours->is_enabled = '1';
                    $businessHours->created_by = \Auth::user()->id;
                    $businessHours->save();
                }else{
                    business_hours::create([
                        'business_id' => $business_id,
                        'content' => $business_hours,
                        'is_enabled' => '1',
                        'created_by' => \Auth::user()->id
                    ]);
                }
            }else{
                $businessHours = business_hours::where('business_id', $business_id)->first();
                if(!is_null($businessHours)){
                    $businessHours->is_enabled = '0';
                    $businessHours->created_by = \Auth::user()->id;
                    $businessHours->save();
                }else{
                business_hours::create([
                            'business_id' => $business_id,
                            'is_enabled' => '0',
                            'created_by' => \Auth::user()->id
                        ]);
                }
            }

            if($request->is_appoinment_enabled == "on"){
                $app_hours = $request->hours;
                $appointment_count = 1;
                $appoinment_hours = [];
                $hours = [];
                if(!empty($app_hours)){
                    foreach ($app_hours as $business_hours_key => $business_hours_val) {
                        $hours['id'] = $appointment_count;
                        $hours['start'] = $business_hours_val['start'];
                        $hours['end'] = $business_hours_val['end'];
                        $appoinment_hours[$business_hours_key] = $hours;
                        $appointment_count++;
                    }
                    $appoinment_hours = json_encode($appoinment_hours);
                    $appoinment = appoinment::where('business_id',$business_id)->first();
                    if(!is_null($appoinment)){
                        $appoinment->content = $appoinment_hours;
                        $appoinment->is_enabled = '1';
                        $appoinment->created_by = \Auth::user()->id;
                        $appoinment->save();
                    }else{
                        appoinment::create([
                            'business_id' => $business_id,
                            'content' => $appoinment_hours,
                            'is_enabled' => '1',
                            'created_by' => \Auth::user()->id
                        ]);
                    }

                }
            }else{
                $appoinment = appoinment::where('business_id',$business_id)->first();
                if(!is_null($appoinment)){
                    $appoinment->is_enabled = '0';
                    $appoinment->created_by = \Auth::user()->id;
                    $appoinment->save();
                }else{
                appoinment::create([
                            'business_id' => $business_id,
                            'is_enabled' => '0',
                            'created_by' => \Auth::user()->id
                        ]);
                }
            }

            if($request->is_services_enabled == "on"){
                $servicedetails = $request->services;
                $service_count = 1;
                $service_details = [];
                $details = [];
                if(!empty($servicedetails)){
                    foreach ($servicedetails as $service_key => $service_val) {
                        $images = $request->file('services');
                        $details['id'] = $service_count;
                        $details['title'] = $service_val['title'];
                        $details['description'] = $service_val['description'];
                        if(isset($images[$service_key])){
                            $img_ext = $images[$service_key]['image']->getClientOriginalExtension();
                            $img_fileName = 'img_'.time().rand().'.'.$img_ext;
                            $images[$service_key]['image']->storeAs('service_images', $img_fileName);
                            $details['image'] = $img_fileName;
                        }
                        else{
                            if(isset($service_val['get_image']) && !is_null($service_val['get_image'])){
                                $details['image'] = $service_val['get_image'];
                            }
                            else{
                                $details['image'] = "";
                            }
                        }
                        $service_details[$service_key] = $details;
                        $service_count++;
                    }
                    $service_details = json_encode($service_details);
                    $services_data = service::where('business_id',$business_id)->first();
                    if(!is_null($services_data)){
                        $services_data->content = $service_details;
                        $services_data->is_enabled = '1';
                        $services_data->created_by = \Auth::user()->id;
                        $services_data->save();
                    }else{
                        service::create([
                            'business_id' => $business_id,
                            'content' => $service_details,
                            'is_enabled' => '1',
                            'created_by' => \Auth::user()->id
                        ]);
                    }
                }
            }else{
                $services_data = service::where('business_id',$business_id)->first();
                if(!is_null($services_data)){
                    $services_data->is_enabled = '0';
                    $services_data->created_by = \Auth::user()->id;
                    $services_data->save();
                }else{
                service::create([
                            'business_id' => $business_id,
                            'is_enabled' => '0',
                            'created_by' => \Auth::user()->id
                        ]);
                }
            }

             if($request->is_testimonials_enabled == "on"){
                $testimonialsdetails = $request->testimonials;
                $testimonials_count = 1;
                $testimonials_details = [];
                $testi_details = [];
                if(!empty($testimonialsdetails)){
                    foreach ($testimonialsdetails as $testimonials_key => $testimonials_val) {
                        $testimonials_images = $request->file('testimonials');
                        $testi_details['id'] = $testimonials_count;
                        if(isset($testimonials_val['rating'])){
                            $testi_details['rating'] = $testimonials_val['rating'];
                        }else{
                            $testi_details['rating'] = "0";
                        }
                        $testi_details['description'] = $testimonials_val['description'];
                        if(isset($testimonials_images[$testimonials_key])){
                            $testimonials_img_ext = $testimonials_images[$testimonials_key]['image']->getClientOriginalExtension();
                            $testimonials_img_fileName = 'img_'.time().rand().'.'.$testimonials_img_ext;
                            $testimonials_images[$testimonials_key]['image']->storeAs('testimonials_images', $testimonials_img_fileName);

                            $testi_details['image'] = $testimonials_img_fileName;
                        }
                        else{
                            if(isset($testimonials_val['get_image']) && !is_null($testimonials_val['get_image'])){
                                $testi_details['image'] = $testimonials_val['get_image'];
                            }
                            else{
                                $testi_details['image'] = "";
                            }
                        }
                        $testimonials_details[$testimonials_key] = $testi_details;
                        $testimonials_count++;
                    }
                    $testimonials_details = json_encode($testimonials_details);
                    $testimonials_data = testimonial::where('business_id',$business_id)->first();
                    if(!is_null($testimonials_data)){
                        $testimonials_data->content = $testimonials_details;
                        $testimonials_data->is_enabled = '1';
                        $testimonials_data->created_by = \Auth::user()->id;
                        $testimonials_data->save();
                    }else{
                        testimonial::create([
                            'business_id' => $business_id,
                            'content' => $testimonials_details,
                            'is_enabled' => '1',
                            'created_by' => \Auth::user()->id
                        ]);
                    }
                }


            }else{
                $testimonials_data = testimonial::where('business_id',$business_id)->first();
                if(!is_null($testimonials_data)){
                    $testimonials_data->is_enabled = '0';
                    $testimonials_data->created_by = \Auth::user()->id;
                    $testimonials_data->save();
                }else{
                testimonial::create([
                            'business_id' => $business_id,
                            'is_enabled' => '0',
                            'created_by' => \Auth::user()->id
                        ]);
                }
            }

            if($request->is_socials_enabled == "on"){
                 $sociallinks_content = json_encode($request->socials);
                $sociallinks = social::where('business_id', $business_id)->first();
                if(!is_null($sociallinks)){
                    $sociallinks->content = $sociallinks_content;
                    $sociallinks->is_enabled = '1';
                    $sociallinks->created_by = \Auth::user()->id;
                    $sociallinks->save();
                }else{
                    social::create([
                        'business_id' => $business_id,
                        'content' => $sociallinks_content,
                        'is_enabled' => '1',
                        'created_by' => \Auth::user()->id
                    ]);
                }
            }else{
                 $sociallinks = social::where('business_id', $business_id)->first();
                    if(!is_null($sociallinks)){
                        $sociallinks->is_enabled = '0';
                        $sociallinks->created_by = \Auth::user()->id;
                        $sociallinks->save();
                    }else{
                    social::create([
                                'business_id' => $business_id,
                                'is_enabled' => '0',
                                'created_by' => \Auth::user()->id
                            ]);
                    }
            }


            if($request->is_contacts_enabled == "on"){
                 $contacts_content = json_encode($request->contact);
                $contactsinfo = ContactInfo::where('business_id', $business_id)->first();
                if(!is_null($contactsinfo)){
                    $contactsinfo->content = $contacts_content;
                    $contactsinfo->is_enabled = '1';
                    $contactsinfo->created_by = \Auth::user()->id;
                    $contactsinfo->save();
                }else{
                    ContactInfo::create([
                        'business_id' => $business_id,
                        'content' => $contacts_content,
                        'is_enabled' => '1',
                        'created_by' => \Auth::user()->id
                    ]);
                }
            }else{
                 $contactsinfo = ContactInfo::where('business_id', $business_id)->first();
                    if(!is_null($contactsinfo)){
                        $contactsinfo->is_enabled = '0';
                        $contactsinfo->created_by = \Auth::user()->id;
                        $contactsinfo->save();
                    }else{
                    ContactInfo::create([
                                'business_id' => $business_id,
                                'is_enabled' => '0',
                                'created_by' => \Auth::user()->id
                            ]);
                    }
            }

            $business->designation = $request->designation;
            $business->created_by = \Auth::user()->id;
            $business->save();
            return redirect()->back()->with('success',__('Business Information Add Successfully'));

        }
        else{

            return redirect()->back()->with('Error',__('Business does not exist'));
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $business = Business::where('id',$id)->delete();

        return redirect()->back()->with('success',__('Business Information Deleted Successfully'));
    }

    public function addField(Request $request){
        return $request->all();
    }

    public function getcard($slug){

        if(!\Auth::check())
        {
            visitor()->visit($slug);
        }
        
        $business = Business::where('slug',$slug)->first();
        if(!is_null($business)){
            \App::setLocale($business->getLanguage());
            $is_slug = "true";
            $businessfields = Utility::getFields();
            $businesshours = business_hours::where('business_id',$business->id)->first();
            $appoinment = appoinment::where('business_id',$business->id)->first();
            $appoinment_hours = [];
            if(!empty($appoinment->content))
            {
                $appoinment_hours = json_decode($appoinment->content);
            }
            
            $services = service::where('business_id',$business->id)->first();
            $services_content = [];
            if(!empty($services->content))
            {
                $services_content = json_decode($services->content);
            }

            $testimonials = testimonial::where('business_id',$business->id)->first();
            $testimonials_content = [];
            if(!empty($testimonials->content))
            {
                $testimonials_content = json_decode($testimonials->content);
            }

            $contactinfo = ContactInfo::where('business_id',$business->id)->first();
            $contactinfo_content = [];
            if(!empty($contactinfo->content))
            {
                $contactinfo_content = json_decode($contactinfo->content);
            }

            $sociallinks = social::where('business_id',$business->id)->first();
            $social_content = [];
            if(!empty($sociallinks->content))
            {
                $social_content = json_decode($sociallinks->content);
            }


            $days = business_hours::$days;
            $business_hours = '';
            if(!empty($businesshours->content))
            {
                $business_hours = json_decode($businesshours->content);
            }
                return view('card.'.$business->card_theme.'.index',compact('businessfields','contactinfo','contactinfo_content','appoinment_hours','appoinment','services_content','services','testimonials_content','testimonials','social_content','sociallinks','businesshours','business_hours','business','days','is_slug'));
        }
        else{
            return abort('403', 'The Link You Followed Has Expired');
        }
    }

    /*public function gettemplate($id){
        $business = Business::where('id',$id)->first();
        $businessfields = Utility::getFields();
        $businesshours = business_hours::where('business_id',$id)->first();
        $appoinment = appoinment::where('business_id',$id)->first();
        $appoinment_hours = [];
        if(!empty($appoinment->content))
        {
            $appoinment_hours = json_decode($appoinment->content);
        }

        $services = service::where('business_id',$id)->first();
        $services_content = [];
        if(!empty($services->content))
        {
            $services_content = json_decode($services->content);
        }

        $contactinfo = ContactInfo::where('business_id',$id)->first();
        $contactinfo_content = [];
        if(!empty($contactinfo->content))
        {
            $contactinfo_content = json_decode($contactinfo->content);
        }

        $testimonials = testimonial::where('business_id',$id)->first();
        $testimonials_content = [];
        if(!empty($testimonials->content))
        {
            $testimonials_content = json_decode($testimonials->content);
        }

        $sociallinks = social::where('business_id',$id)->first();
        $social_content = [];
        if(!empty($sociallinks->content))
        {
            $social_content = json_decode($sociallinks->content);
        }


        $days = business_hours::$days;
        $business_hours = [];
        if(!empty($businesshours->content))
        {
            $business_hours = json_decode($businesshours->content);
        }
        return view('card.index',compact('businessfields','contactinfo','contactinfo_content','appoinment_hours','appoinment','services_content','services','testimonials_content','testimonials','social_content','sociallinks','businesshours','business_hours','business','days','id'));
    }*/

    public function editTheme($id,Request $request){
        //return $request->all();
        $validator = \Validator::make(
        $request->all(), [
                           'theme_color' => 'required',
                           'themefile' => 'required',
                       ]
        );
        if($validator->fails())
        {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }
        $businesss                = Business::where('id',$id)->first();
        $businesss['theme_color'] = $request->theme_color;
        $businesss['card_theme']   = $request->themefile;
        $businesss->save();

        return redirect()->back()->with('success', __('Theme Successfully Updated.'));
    }
    public function getVcardDownload($slug){
        $business = Business::where('slug',$slug)->first();
       
        $vcard = new VCard();
            // dd($business);
            $lastname = '';
            $firstname = $business->title;
            $additional = '';
            $prefix = '';
            $suffix = '';
            // add personal data
            $vcard->addName($lastname, $firstname, $additional, $prefix, $suffix);
            // add work data
            $vcard->addCompany($business->title);
            $vcard->addRole($business->designation);
          
            $contacts =  ContactInfo::where('business_id',$business->id)->first();
            if(!empty($contacts) && !empty($contacts->content)){
                $contact = json_decode($contacts->content,true);
                foreach($contact as $key => $val){
                    foreach($val as $key2 => $val2){
                        if($key2 == 'Email'){
                            $vcard->addEmail($val2);
                        }
                        if($key2 == 'Phone'){
                            $vcard->addPhoneNumber($val2, 'WORK');
                        }
                    }
                    
                }
            }
           
           
            $path = public_path('/card');
            \File::delete($path);
            if(!is_dir($path)){
                \File::makeDirectory($path,0777);
            }
            $vcard->setSavePath($path);
            $vcard->save();
            $file = $vcard->getFilename() . '.' . $vcard->getFileExtension();
            self::download($path.'/'.$file);

            // return vcard as a download
            // return $vcard->download();

    }
    function download($file) {
        

        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            ob_clean();
            flush();
            readfile($file);
            exit;
        }
    }

    public function analytics($id){


        $business = Business::find($id);
    


        $user_device   = \DB::table('visitor')->where('slug',$business->slug)->selectRaw("count('*') as total, device")->groupBy('device')->orderBy('device', 'DESC')->get();
        $user_browser  = \DB::table('visitor')->where('slug',$business->slug)->selectRaw("count('*') as total, browser")->groupBy('browser')->orderBy('browser', 'DESC')->get();
        $user_platform = \DB::table('visitor')->where('slug',$business->slug)->selectRaw("count('*') as total, platform")->groupBy('platform')->orderBy('platform', 'DESC')->get();


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
        return view('business.analytics',compact('platformarray','browserarray','devicearray'));

    }

}
