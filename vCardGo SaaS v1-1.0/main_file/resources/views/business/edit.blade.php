@php
$content = json_decode($business->content);
$no = 1;
$social_no = 1;
$stringid = $business->id;
$appointment_no = 0;
$service_row_no = 0;
$testimonials_row_no = 0;
$is_preview_bussiness_hour = "false";
@endphp
@extends('layouts.admin')
@push('css-page')
<style>
   @import url({{ asset('css/font-awesome.css') }});
   .image {
  position: relative;
}

.image .actions {
  right: 1em;
  top: 1em;
  display: block;
  position: absolute;
}

.image .actions a {
  display: inline-block;
}

</style>
@endpush
@section('page-title')
   {{__('Edit Business')}}
@endsection
@section('content')
<div class="page-title">
   <div class="container-lg edit-page-container">
      <div class="row justify-content-between align-items-center">
         <div class="col-md-12 mb-3 mb-md-0">
            <h5 class="h3 font-weight-400 mb-0">{{ __('Business Information') }}</h5>
         </div>
      </div>
   </div>
</div>
<div class="container-lg edit-page-container">
   <div class="row justify-content-between">
      <ul class="nav nav-tabs my-4">
         <li>
            <a data-toggle="tab" class="active" id="contact-tab4" href="#theme-setting">{{ __('Theme') }}</a>
         </li>
         <li>
            <a data-toggle="tab" id="contact-tab4" href="#details-setting">{{ __('Details') }}</a>
         </li>
      </ul>
      <ul class="nav nav-tabs m-4">
         <li>
            <a class="active" href="{{url('/'.$business->slug)}}" target="-blank">{{ __('Preview') }}</a>
         </li>
      </ul>
   </div>

  <div class="tab-content">
    <div class="tab-pane active" id="theme-setting">
       <div class="container-lg edit-page-container">
          <div class="row">
             <div class="col-lg-7">
                <div class="card bg-none card-box">
                   {{Form::open(array('route' => array('business.edit-theme', $business->id),'method' => 'POST','enctype' => "multipart/form-data"))}}
                   <div class="card-body">
                      <div class="row">
                         @foreach(\App\Models\Utility::themeOne() as $key => $v)
                           @if(in_array($key, Auth::user()->getPlanThemes()))
                              <div class="col-4 cc-selector mb-2">
                                 <div class="mb-3 screen image">
                                    
                                    <img src="{{asset(Storage::url('uploads/card_theme/'.$key.'/color1.png'))}}" class="img-center pro_max_width pro_max_height {{$key}}_img">
                                    <div class="actions">
                                       <a href="">
                                          <button type="button" class="btn btn-default delete-image-btn pull-right">
                                             <span class="glyphicon glyphicon-trash"></span>
                                          </button>
                                       </a>
                                       <a href="">
                                          <button type="button" class="btn btn-default edit-image-btn pull-right">
                                                <span class="glyphicon glyphicon-pencil"></span>
                                          </button>
                                       </a>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <div class="row gutters-xs mx-auto" id="{{$key}}">
                                       @foreach($v as $css => $val)
                                       <div class="col">
                                          <label class="colorinput">
                                          <input name="theme_color" type="radio" value="{{$css}}" data-theme="{{$key}}" data-imgpath="{{$val['img_path']}}" class="colorinput-input" {{(isset($business->theme_color) && $business->theme_color == $css) ? 'checked' : ''}}>
                                          <span class="colorinput-color" style="background:{{$val['color']}}"></span>
                                          </label>
                                       </div>
                                       @endforeach
                                    </div>
                                 </div>
                              </div>
                              @endif
                         @endforeach
                      </div>
                   </div>
                   <div class="row card-footer">
                      <div class="col-12 text-right">
                         {{Form::hidden('themefile',null,array('id'=>'themefile'))}}

                         <button type="submit" class="btn btn-sm badge-blue rounded-pill theme-save">Save changes</button>
                      </div>
                   </div>
                   {{Form::close()}}
                </div>
             </div>
             <div class="col-lg-5">
                <!--  <iframe  class="w-100 h-1050" frameborder="0" src="{{url('business/preview/card',$business->id)}}"></iframe> -->
                <div class="card bg-none card-box">
                   <img src="{{asset(Storage::url('uploads/card_theme/theme1/color1.png'))}}" class="img-fluid img-center w-75 theme_preview_img">
                </div>
             </div>
          </div>
       </div>
    </div>
    <div class="tab-pane" id="details-setting">
       <div class="container-lg edit-page-container">
          <div class="row">
             <div class="col-lg-7">
                <div class="card bg-none card-box">
                   <div class="card-body">
                      {{ Form::open(array('route'=>array('business.update',$business->id),'method'=>'put','enctype' => "multipart/form-data"))}}
                      <input type="hidden" name="url" value="{{url('/')}}" id="url">
                      <!-- General information -->
                      <div class="row">
                         <div class="col-md-6">
                            <div class="form-group">
                               <input type="file" name="banner" id="file-1" class="custom-input-file custom-input-file-link banner" data-multiple-caption="{count} files selected" multiple="">
                               <label for="file-1">
                               <button type="button" class="btn btn-sm badge-blue rounded-pill"  onclick="selectFile('banner')">{{__('Banner')}}</button>
                               </label>
                               @error('banner')
                               <span class="invalid-favicon text-xs text-danger" role="alert">{{ $message }}</span>
                               @enderror
                            </div>
                         </div>
                         <div class="col-md-6">
                            <img src="{{ isset($business->banner) && !empty($business->banner) ? asset(Storage::url('card_banner/'.$business->banner)) : asset('assets/img/placeholder-image.jpg') }}" class="imagepreview" id="banner" alt="{{asset('assets/img/placeholder-image.jpg')}}">
                         </div>
                      </div>
                      <div class="row mt-4">
                         <div class="col-md-6">
                            <div class="form-group">
                               <input type="file" name="logo" id="file-1" class="custom-input-file custom-input-file-link logo" data-multiple-caption="{count} files selected" multiple="">
                               <label for="file-1">
                               <button type="button" class="btn btn-sm badge-blue rounded-pill"  onclick="selectFile('logo')">{{__('Logo')}}</button>
                               <input type="hidden" name="business_id" value="{{$business->id}}">
                               </label>
                               @error('logo')
                               <span class="invalid-favicon text-xs text-danger" role="alert">{{ $message }}</span>
                               @enderror
                            </div>
                         </div>
                         <div class="col-md-6 text-center">
                            <img src="{{ isset($business->logo) && !empty($business->logo) ? asset(Storage::url('card_logo/'.$business->logo)) : asset('assets/img/logo-placeholder-image-2.png') }}" class="avatar avatar-xl rounded-circle mr-3" id="logo" alt="{{asset('assets/img/logo-placeholder-image-2.png')}}">
                         </div>
                      </div>
                      <div class="row mt-2">
                         <div class="col-12">
                            {{Form::label('Title',__('Title'),array('class'=>'form-control-label'))}}
                            {{Form::text('title',$business->title,array('class'=>'form-control','id'=>$stringid.'_title','placeholder'=>__('Enter Title')))}}
                            @error('title')
                            <span class="invalid-favicon text-xs text-danger" role="alert">{{ $message }}</span>
                            @enderror
                         </div>
                      </div>
                      <div class="row mt-2">
                         <div class="col-12">
                            {{Form::label('Designation',__('Designation'),array('class'=>'form-control-label'))}}
                            {{Form::text('designation',$business->designation,array('class'=>'form-control','id'=>$stringid.'_designation','placeholder'=>__('Enter Designation')))}}
                            @error('title')
                            <span class="invalid-favicon text-xs text-danger" role="alert">{{ $message }}</span>
                            @enderror
                         </div>
                      </div>
                      <div class="row mt-2">
                         <div class="col-12">
                            {{Form::label('Sub_Title',__('Sub Title'),array('class'=>'form-control-label'))}}
                            {{Form::text('sub_title',$business->sub_title,array('class'=>'form-control','id'=>$stringid.'_subtitle','placeholder'=>__('Enter Sub Title')))}}
                            @error('sub_title')
                            <span class="invalid-favicon text-xs text-danger" role="alert">{{ $message }}</span>
                            @enderror
                         </div>
                      </div>
                      <div class="row mt-2">
                         <div class="col-12">
                            {{Form::label('Description',__('Description'),array('class'=>'form-control-label'))}}
                            {{Form::textarea('description',$business->description,array('class'=>'form-control','rows'=>'3','id'=>$stringid.'_desc','placeholder'=>__('Enter Description')))}}
                            @error('description')
                            <span class="invalid-favicon text-xs text-danger" role="alert">{{ $message }}</span>
                            @enderror
                         </div>
                      </div>
                      <div class="row mt-2">
                        <div class="col-12">
                           {{Form::label('meta_keyword',__('Meta Keywords'),array('class'=>'form-control-label'))}}
                           {{Form::text('meta_keyword',$business->meta_keyword,array('class'=>'form-control','rows'=>'3','id'=>$stringid.'_desc','placeholder'=>__('Enter Meta Keywords')))}}
                           @error('metakeywords')
                           <span class="invalid-favicon text-xs text-danger" role="alert">{{ $message }}</span>
                           @enderror
                        </div>
                     </div>
                     <div class="row mt-2">
                        <div class="col-12">
                           {{Form::label('meta_description',__('Meta Description'),array('class'=>'form-control-label'))}}
                           {{Form::textarea('meta_description',$business->meta_description,array('class'=>'form-control','rows'=>'3','id'=>$stringid.'_desc','placeholder'=>__('Enter Meta Description')))}}
                           @error('meta_description')
                           <span class="invalid-favicon text-xs text-danger" role="alert">{{ $message }}</span>
                           @enderror
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                               <i class="fab fa-google" aria-hidden="true"></i>
                               {{Form::label('google_analytic',__('Google Analytic'),array('class'=>'form-control-label')) }}
                               {{Form::text('google_analytic',$business->google_analytic,array('class'=>'form-control','placeholder'=>'UA-XXXXXXXXX-X'))}}
                               @error('google_analytic')
                               <span class="invalid-google_analytic" role="alert">
                                <strong class="text-danger">{{ $message }}</strong>
                            </span>
                               @enderror
                           </div>
                       </div>
                       <div class="col-md-6">
                           <div class="form-group">
                               <i class="fab fa-facebook-f" aria-hidden="true"></i>
                               {{Form::label('facebook_pixel_code',__('Facebook Pixel'),array('class'=>'form-control-label')) }}
                               {{Form::text('fbpixel_code',$business->fbpixel_code,array('class'=>'form-control','placeholder'=>'UA-0000000-0'))}}
                               @error('facebook_pixel_code')
                               <span class="invalid-google_analytic" role="alert">
                                <strong class="text-danger">{{ $message }}</strong>
                            </span>
                               @enderror
                           </div>
                       </div>
                       <div class="form-group col-md-12">
                           {{Form::label('customjs',__('Custom JS'),array('class'=>'form-control-label')) }}
                           {{Form::textarea('customjs',$business->customjs,array('class'=>'form-control','rows'=>3,'placeholder'=>__('Custom JS')))}}
                           @error('customjs')
                           <span class="invalid-about" role="alert">
                                <strong class="text-danger">{{ $message }}</strong>
                            </span>
                           @enderror
                       </div>
                       </div>
                      <hr class="mb-0" />
                      <div id="accordion-2" class="accordion accordion-spaced">
                         <div class="">
                            <div class="card-header py-4" id="heading-2-8" data-toggle="collapse" role="button" data-target="#collapse-2-8" aria-expanded="false" aria-controls="collapse-2-8">
                               <h6 class="mb-0"><i class="far fa-credit-card mr-3"></i>{{ __('Contact Info') }}</h6>
                            </div>
                            <div id="collapse-2-8" class="collapse" aria-labelledby="heading-2-8" data-parent="#accordion-2">
                              <div id="showContacts">
                                 <div class=" d-flex align-items-center  justify-content-between border-0 mt-3 py-2 borderleft ">
                                 <div class="custom-control custom-switch">
                                       <input type="hidden" name="is_contacts_enabled" value="off">
                                       <input type="checkbox" class="custom-control-input" name="is_contacts_enabled" id="is_contacts_enabled" {{ isset($contactinfo['is_enabled']) && $contactinfo['is_enabled'] == '1' ? 'checked="checked"' : '' }}>
                                       <label class="custom-control-label form-control-label" for="is_contacts_enabled">{{ __('Enable Contact Info') }}</label>
                                    </div>
                                    <div class="col-auto justify-content-end">
                                       <a href="javascript:void(0)"  class="btn btn-xs btn-white btn-icon-only min-100  w-25 min-vw-25 hideelement" type="button" value="sdfcvgbnn"   data-target="#fieldModal"  data-toggle="modal"><i class="fas fa-plus"></i>
                                       <span class="d-none d-sm-inline-block">{{__('Create')}}</span></a>
                                    </div>
                                 </div>
                                 <div class="card-body">
                                    <table class="table table-hover border-0" data-repeater-list="stages">
                                       <tbody id="inputrow_contact" >
                                          @if(!is_null($contactinfo_content))
                                          @foreach($contactinfo_content as $key => $val)
                                          @foreach($val as $key1 => $val1)
                                          @if($key1 != 'id')
                                          <tr id="inputFormRow" class="inputFormRow border-0">
                                             <td>
                                                <div class="form-icon-user">
                                                   <span class="currency-icon"><img class="mb-3  mt-2" src="{{asset('assets/icon/black/'.strtolower($key1).'.svg')}}" style="color:#082e7b;"></span>
                                                   <input type="text" id="{{$key1.'_'.$no}}" name="{{'contact['.$no.']['.$key1.']'}}" class="form-control mb-0" value="{{$val1}}" required/>
                                                   <input type="hidden" name="{{'contact['.$no.'][id]'}}" value="{{$no}}">
                                                </div>
                                             </td>
                                             <td class="text-right">
                                                <a class="delete-icon" id="removeRow_contact" data-id="contact_{{$loop->parent->index+1}}"><i class="fas fa-trash"></i></a>
                                             </td>
                                          </tr>
                                          @endif
                                          @php
                                          $no++;
                                          @endphp
                                          @endforeach
                                          @endforeach
                                          @endif
                                       </tbody>
                                    </table>
                                 </div>
                                 <div class="modal fade" id="fieldModal" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                       <div class="modal-content">
                                          <div>
                                             <h4 class="h4 font-weight-400 float-left modal-title">{{__('Add Field')}}</h4>
                                             <a href="#" class="more-text widget-text float-right close-icon" data-dismiss="modal" aria-label="close">{{__('Close')}}</a>
                                          </div>
                                          <div class="modal-body">
                                             <div class="card bg-none card-box px-4 py-4">
                                                <div class="row d-flex align-items-center justify-content-between">
                                                   <div class="col-auto">
                                                      @foreach($businessfields as $val)
                                                      <button type="button" value="{{$val}}" id="{{$val}}" data-id="{{$val}}" class="btn btn-sm btn-secondary text-muted mb-2 getvalue" onclick="getValue(this.id)">
                                                         <img class="{{ $val }} mb-3  mt-2" src="{{asset('assets/icon/'.strtolower($val).'.svg')}}" style="color:#082e7b;"></i>
                                                         <h6 class="text-muted">{{ $val }}</h6>
                                                      </button>
                                                      @endforeach
                                                      <div id="addnewfield">
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                            </div>
                         </div>
                         <div class="">
                            <div class="card-header py-4" id="heading-2-2" data-toggle="collapse" role="button" data-target="#collapse-2-2" aria-expanded="false" aria-controls="collapse-2-2">
                               <h6 class="mb-0"><i class="far fa-credit-card mr-3"></i>{{ __('Business Hours') }}</h6>
                            </div>
                            <div id="collapse-2-2" class="collapse" aria-labelledby="heading-2-2" data-parent="#accordion-2">
                               <div class="card-body">
                                  <div class="row">
                                     <div class="col-12 py-2 text-right">
                                        <div class="custom-control custom-switch">
                                           <input type="hidden" name="is_business_hours_enabled" value="off">
                                           <input type="checkbox" class="custom-control-input" name="is_business_hours_enabled" id="is_business_hours_enabled" {{ isset($businesshours['is_enabled']) && $businesshours['is_enabled'] == '1' ? 'checked="checked"' : '' }}>
                                           <label class="custom-control-label form-control-label" for="is_business_hours_enabled">{{ __('Enable Business Hours') }}</label>
                                        </div>
                                     </div>
                                  </div>
                                  <div class="py-4" id="showElement">
                                     @foreach($days as $k=>$day)
                                     <div class="row" >
                                        <div class="col-md-3">
                                           <div class="form-group">
                                              <div class="custom-control custom-checkbox" data-toggle="tooltip" title="{{__('On/Off')}}">
                                                 <input class="custom-control-input days" type="checkbox" name="days_{{$k}}" id="days_{{$k}}" @if(!is_null($business_hours)) {{ (isset($business_hours->$k) && $business_hours->$k->days=='on') ?'checked':''}} @endif>
                                                 <label class="custom-control-label" for="days_{{$k}}">{{$day}}</label>
                                              </div>
                                           </div>
                                        </div>
                                        <div class="col">
                                           <div class="row">
                                              <label class="col-auto control-label">{{__('Start Time')}}</label>
                                              <div class="col">
                                                 <input type="time" id="days_{{$k}}_start" data-id="days_{{$k}}" class="form-control timepicker" name="start-{{$k}}"  value="{{(
                                                    !is_null($business_hours) && isset($business_hours->$k) && $business_hours->$k->days=='on') ?$business_hours->$k->start_time:''}}" onchange="changeFunction(this.id)">
                                              </div>
                                              <label for="inputValue" class="col-auto control-label">{{__('End Time')}}</label>
                                              <div class="col">
                                                 <input type="time" id="days_{{$k}}_end" data-id="days_{{$k}}" class="form-control timepicker" name="end-{{$k}}" value="{{(!is_null($business_hours) && isset($business_hours->$k) && $business_hours->$k->days=='on') ?$business_hours->$k->end_time:''}}" onchange="changeFunction(this.id)" >
                                              </div>
                                           </div>
                                        </div>
                                     </div>
                                     @endforeach
                                  </div>
                               </div>
                            </div>
                         </div>
                         <div class="">
                            <div class="card-header py-4" id="heading-2-3" data-toggle="collapse" role="button" data-target="#collapse-2-3" aria-expanded="false" aria-controls="collapse-2-3">
                               <h6 class="mb-0"><i class="far fa-credit-card mr-3"></i>{{ __('Appointment') }}</h6>
                            </div>
                            <div id="collapse-2-3" class="collapse" aria-labelledby="heading-2-3" data-parent="#accordion-2">
                               <div class="">
                                  <div class="py-4">
                                       <div class="rounded-12 appoinment-element  px-4" data-value="{{json_encode($appoinment_hours)}}">
                                      
                                        <div class=" d-flex align-items-center  justify-content-between border-0 py-2 borderleft">
                                          <div class=" text-left">
                                             <div class="custom-control custom-switch">
                                                <input type="hidden" name="is_appoinment_enabled" value="off">
                                                <input type="checkbox" class="custom-control-input" name="is_appoinment_enabled" id="is_appoinment_enabled" {{ isset($appoinment['is_enabled']) && $appoinment['is_enabled'] == '1' ? 'checked="checked"' : '' }}>
                                                <label class="custom-control-label form-control-label" for="is_appoinment_enabled">{{ __('Enable Appoinments') }}</label>
                                             </div>
                                          </div>
                                           <div class="col-auto justify-content-end">
                                              <a href="javascript:void(0)"  class="btn btn-xs btn-white btn-icon-only min-100  w-25 min-vw-25"  type="button" onclick="appointmentRepeater()"><i class="fas fa-plus"></i>
                                              <span class="d-none d-sm-inline-block">{{__('Create')}}</span></a>
                                           </div>
                                        </div>
                                        <div  id="showAppoinment">
                                           <table class="table table-hover border">
                                              <thead>
                                                 <th>{{__('Starting Hour')}}</th>
                                                 <th>{{__('Ending Hour')}}</th>
                                                 <th class="text-right">{{__('Delete')}}</th>
                                              </thead>
                                              <tbody id="inputrow_appointment">
                                                 <tr>
                                                    @if(!is_null($appoinment_hours))
                                                    @foreach($appoinment_hours as $k => $hour)
                                                 <tr id="inputFormRow1">
                                                    <td>
                                                       <input type="time" class="form-control appointment_time timepicker" id="appoinment_start_{{$appointment_no}}" name="{{'hours['.$appointment_no.'][start]'}}" value="{{$hour->start}}" onchange="changeTime(this.id)">
                                                    </td>
                                                    <td>
                                                       <input type="time" class="form-control appointment_time timepicker" id="appoinment_end_{{$appointment_no}}" name="{{'hours['.$appointment_no.'][end]'}}" value="{{$hour->end}}" onchange="changeTime(this.id)">
                                                    </td>
                                                    <td class="text-right">
                                                       <a class="delete-icon float-right" id="removeRow_appointment" data-id="{{'appointment_'.$appointment_no}}" ><i class="fas fa-trash"></i></a>
                                                    </td>
                                                 </tr>
                                                 @php
                                                 $appointment_no++;
                                                 @endphp
                                                 @endforeach
                                                 @endif
                                                 </tr>
                                              </tbody>
                                           </table>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                            </div>
                         </div>
                         <div>
                            <div class="card-header py-4" id="heading-2-4" data-toggle="collapse" role="button" data-target="#collapse-2-4" aria-expanded="false" aria-controls="collapse-2-4">
                               <h6 class="mb-0"><i class="far fa-credit-card mr-3"></i>{{ __('Services') }}</h6>
                            </div>
                            <div id="collapse-2-4" class="collapse" aria-labelledby="heading-2-4" data-parent="#accordion-2">
                                 <div class=" rounded-12 appoinment-element">
                                    <div class=" d-flex align-items-center  justify-content-between border-0 mt-3 py-2 borderleft pb-3">
                                    <div class="custom-control custom-switch">
                                       <input type="hidden" name="is_services_enabled" value="off">
                                       <input type="checkbox" class="custom-control-input" name="is_services_enabled" id="is_services_enabled" {{ isset($services['is_enabled']) && $services['is_enabled'] == '1' ? 'checked="checked"' : '' }}>
                                       <label class="custom-control-label form-control-label" for="is_services_enabled">{{ __('Enable Services') }}</label>
                                    </div> 
                                    <div class="col-auto justify-content-end">
                                          <a href="javascript:void(0)"  class="btn btn-xs btn-white btn-icon-only min-100  w-25 min-vw-25"  type="button" onclick="servieRepeater()"><i class="fas fa-plus"></i>
                                          <span class="d-none d-sm-inline-block">{{__('Create')}}</span></a>
                                       </div>
                                    </div>
                                    <div  id="showServices">
                                       <div class="row" id="inputrow_service">
                                          @php $image_count = 0; @endphp
                                          @if(!is_null($services_content))
                                          @foreach($services_content as $k1 => $content)
                                          <div class="col-6" id="inputFormRow2">
                                             <div class="card shadow-lg  min-317">
                                                <div class="card-body text-center">
                                                   <div class="float-right">
                                                      <a class="delete-icon" id="removeRow_services" data-id="{{'services_'.$service_row_no}}"><i class="fas fa-trash"></i></a>
                                                   </div>
                                                   <div class="avatar-parent-child">
                                                      <img alt="Image placeholder" src="{{ !empty($content->image) ? asset(Storage::url('service_images/'.$content->image)) : asset('assets/img/logo-placeholder-image-2.png') }}" id="{{'s_image'.$image_count}}" class="avatar imagepreview  rounded-circle avatar-card-lg ml-4">
                                                      <span class="avatar-child1 avatar-child avatar-card-badge rounded-2 edit-icon " >
                                                      <i class="fas fa-pen" onclick="selectFile('s_image{{$image_count}}')"></i>
                                                      <input type="file" id="file-1"  class="custom-input-file custom-input-file-link s_image{{$image_count}}"  data-multiple-caption="{count} files selected" multiple="" name="{{'services['.$service_row_no.'][image]'}}" >
                                                      <input type="hidden" name="{{'services['.$service_row_no.'][get_image]'}}" value="{{$content->image}}">
                                                      </span>
                                                   </div>
                                                   <h4 class="mt-4 font-weight-bold mb-0">
                                                      <input type="text" id="{{'title_'.$service_row_no}}"  name="{{'services['.$service_row_no.'][title]'}}" class="h4 border-0 text-dark text-center" placeholder="Enter title" value="{{$content->title}}">
                                                   </h4>
                                                   <div class="mt-4 text-dark">
                                                      <textarea class="border-0 text-dark text-center" name="{{'services['.$service_row_no.'][description]'}}" id="{{'description_'.$service_row_no}}"  placeholder="Enter Description">{{$content->description}}</textarea>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          @php
                                          $image_count++;
                                          $service_row_no++;
                                          @endphp
                                          @endforeach
                                          @endif
                                       </div>
                                    </div>
                                 </div>
                            </div>
                         </div>
                         <div >
                            <div class="card-header py-4" id="heading-2-5" data-toggle="collapse" role="button" data-target="#collapse-2-5" aria-expanded="false" aria-controls="collapse-2-5">
                               <h6 class="mb-0"><i class="far fa-credit-card mr-3"></i>{{ __('Testimonials') }}</h6>
                            </div>
                            <div id="collapse-2-5" class="collapse" aria-labelledby="heading-2-5" data-parent="#accordion-2">
                               <div class="">
                                  <div >
                                     <div class="rounded-12 appoinment-element">
                                        <div class=" d-flex align-items-center  justify-content-between border-0 mt-3 py-2 borderleft pb-3">
                                          <div class="custom-control custom-switch">
                                             <input type="hidden" name="is_testimonials_enabled" value="off">
                                             <input type="checkbox" class="custom-control-input" name="is_testimonials_enabled" id="is_testimonials_enabled" {{ isset($testimonials['is_enabled']) && $testimonials['is_enabled'] == '1' ? 'checked="checked"' : '' }}>
                                             <label class="custom-control-label form-control-label" for="is_testimonials_enabled">{{ __('Enable Testimonials') }}</label>
                                          </div>
                                           <div class="col-auto justify-content-end">
                                              <a href="javascript:void(0)"  class="btn btn-xs btn-white btn-icon-only min-100  w-25 min-vw-25"  type="button" onclick="testimonialRepeater()"><i class="fas fa-plus"></i>
                                              <span class="d-none d-sm-inline-block">{{__('Create')}}</span></a>
                                           </div>
                                        </div>
                                        <div id="showTestimonials">
                                           <div class="row" id="inputrow_testimonials">
                                              @php
                                              $t_image_count = 0;
                                              $t_rating_count = 0;
                                              @endphp
                                              @if(!is_null($testimonials_content))
                                              @foreach($testimonials_content as $k2 => $testi_content)
                                              <div class="col-6" id="inputFormRow3">
                                                 <div class="card shadow-lg  min-317">
                                                    <div class="card-body text-center">
                                                       <div class="float-right">
                                                          <a class="delete-icon" id="removeRow_testimonials" data-id="{{'testimonials_'.$testimonials_row_no}}"><i class="fas fa-trash"></i></a>
                                                       </div>
                                                       <div class="avatar-parent-child">
                                                          <img alt="Image placeholder" src="{{ !empty($testi_content->image) ? asset(Storage::url('testimonials_images/'.$testi_content->image)) : asset('assets/img/logo-placeholder-image-2.png') }}" id="{{'t_image'.$t_image_count}}" class="avatar imagepreview  rounded-circle avatar-card-lg ml-4">
                                                          <span class="avatar-child1 avatar-child avatar-card-badge rounded-2 edit-icon " >
                                                          <i class="fas fa-pen" onclick="selectFile('t_image{{$t_image_count}}')"></i>
                                                          <input type="file" id="file-1"  class="custom-input-file custom-input-file-link t_image{{$t_image_count}}"  data-multiple-caption="{count} files selected" multiple="" name="{{'testimonials['.$testimonials_row_no.'][image]'}}" >
                                                          <input type="hidden" name="{{'testimonials['.$t_image_count.'][get_image]'}}" value="{{$testi_content->image}}">
                                                          </span>
                                                       </div>
                                                       <h4 class="mt-4 font-weight-bold mb-0">
                                                          <span class="{{'stars'.$testimonials_row_no}}">{{$testi_content->rating}}</span>/5
                                                       </h4>
                                                       <div class="text-center mt-2">
                                                          <fieldset id='demo1' class="rating">
                                                             <input class="{{'stars'.$testimonials_row_no}}" type="radio" id="{{'testimonials-5'.$t_rating_count}}" name="{{'testimonials['.$testimonials_row_no.'][rating]'}}" value="5" onclick="getRadio(this)" {{ isset($testi_content->rating) && $testi_content->rating == '5' ? 'checked="checked"' : '' }} />
                                                             <label class="full" for="{{'testimonials-5'.$t_rating_count}}" title="Awesome - 5 stars"></label>
                                                             <input class="{{'stars'.$testimonials_row_no}}" type="radio" id="{{'testimonials-4'.$t_rating_count}}" name="{{'testimonials['.$testimonials_row_no.'][rating]'}}" value="4" onclick="getRadio(this)" {{ isset($testi_content->rating) && $testi_content->rating == '4' ? 'checked="checked"' : '' }}/>
                                                             <label class="full" for="{{'testimonials-4'.$t_rating_count}}" title="Pretty good - 4 stars"></label>
                                                             <input class="{{'stars'.$testimonials_row_no}}" type="radio" id="{{'testimonials-3'.$t_rating_count}}" name="{{'testimonials['.$testimonials_row_no.'][rating]'}}" value="3" onclick="getRadio(this)" {{ isset($testi_content->rating) && $testi_content->rating == '3' ? 'checked="checked"' : '' }}/>
                                                             <label class="full" for="{{'testimonials-3'.$t_rating_count}}" title="Meh - 3 stars"></label>
                                                             <input class="{{'stars'.$testimonials_row_no}}" type="radio" id="{{'testimonials-2'.$t_rating_count}}" name="{{'testimonials['.$testimonials_row_no.'][rating]'}}" value="2" onclick="getRadio(this)" {{ isset($testi_content->rating) && $testi_content->rating == '2' ? 'checked="checked"' : '' }}/>
                                                             <label class="full" for="{{'testimonials-2'.$t_rating_count}}" title="Kinda bad - 2 stars"></label>
                                                             <input class="{{'stars'.$testimonials_row_no}}" type="radio" id="{{'testimonials-1'.$t_rating_count}}" name="{{'testimonials['.$testimonials_row_no.'][rating]'}}" value="1" onclick="getRadio(this)" {{ isset($testi_content->rating) && $testi_content->rating == '1' ? 'checked="checked"' : '' }}/>
                                                             <label class="full" for="{{'testimonials-1'.$t_rating_count}}" title="Sucks big time - 1 star"></label>
                                                          </fieldset>
                                                       </div>
                                                       <div class="mt-4 text-dark">
                                                          <textarea class="border-0 text-dark text-center" id="{{'testimonial_description_'.$testimonials_row_no}}" name="{{'testimonials['.$testimonials_row_no.'][description]'}}"   placeholder="Enter Description">{{$testi_content->description}}</textarea>
                                                       </div>
                                                    </div>
                                                 </div>
                                              </div>
                                              @php
                                              $t_rating_count++;
                                              $t_image_count++;
                                              $testimonials_row_no++;
                                              @endphp
                                              @endforeach
                                              @endif
                                           </div>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                            </div>
                         </div>
                         <div class="mb-4">
                            <div class="card-header py-4" id="heading-2-6" data-toggle="collapse" role="button" data-target="#collapse-2-6" aria-expanded="false" aria-controls="collapse-2-6">
                               <h6 class="mb-0"><i class="far fa-credit-card mr-3"></i>{{ __('Social Links') }}</h6>
                            </div>
                            <div id="collapse-2-6" class="collapse" aria-labelledby="heading-2-6" data-parent="#accordion-2">
                              <div class="card rounded-12 appoinment-element">
                                 <div class=" d-flex align-items-center  justify-content-between border-0 mt-3 py-2 borderleft pb-3">
                                 <div class="custom-control custom-switch">
                                    <input type="hidden" name="is_socials_enabled" value="off">
                                    <input type="checkbox" class="custom-control-input" name="is_socials_enabled" id="is_socials_enabled" {{ isset($sociallinks['is_enabled']) && $sociallinks['is_enabled'] == '1' ? 'checked="checked"' : '' }}>
                                    <label class="custom-control-label form-control-label" for="is_socials_enabled">{{ __('Enable Social Links') }}</label>
                                 </div>
                                    <div class="col-auto justify-content-end">
                                       <a href="javascript:void(0)"  class="btn btn-xs btn-white btn-icon-only min-100  w-25 min-vw-25" type="button" value="sdfcvgbnn"   data-target="#socialsModal"  data-toggle="modal"><i class="fas fa-plus"></i>
                                       <span class="d-none d-sm-inline-block">{{__('Create')}}</span></a>
                                    </div>
                                 </div>
                                 <div  id="showSocials">
                                    <table class="table table-hover border-0">
                                       <tbody id="inputrow_socials" >
                                          @if(!is_null($social_content))
                                          @foreach($social_content as $social_key => $social_val)
                                          @foreach($social_val as $social_key1 => $social_val1)
                                          @if($social_key1 != 'id')
                                          <tr id="inputFormRow4" class="border-0">
                                             <td>
                                                <div class="form-icon-user">
                                                   <span class="currency-icon">
                                                      <img class="mb-3  mt-2" src="{{asset('assets/icon/black/'.strtolower($social_key1).'.svg')}}" style="color:#082e7b;">
                                                   </span>
                                                   <input type="text" placeholder="Enter link"  name="{{'socials['.$social_no.']['.$social_key1.']'}}" class="form-control mb-0 social_href " value="{{$social_val1}}" id="{{'social_link_'.$social_no}}" required/>
                                                   <input type="hidden" name="{{'socials['.$social_no.'][id]'}}" value="{{$social_no}}"><br>
                                                   <h6 class="text-danger text-xs" id="{{'social_link_'.$social_no.'_error_href'}}"></h6>
                                                </div>
                                             </td>
                                             <td class="text-right">
                                                <a class="delete-icon" id="removeRow_socials" data-id="socials_{{$loop->parent->index+1}}"><i class="fas fa-trash"></i></a>
                                             </td>
                                          </tr>
                                          @endif
                                          @php
                                          $social_no++;
                                          @endphp
                                          @endforeach
                                          @endforeach
                                          @endif
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                            </div>
                         </div>
                      </div>
                      <!-- Save changes buttons -->
                      <button type="submit" class="btn btn-sm badge-blue rounded-pill">Save changes</button>
                      <button type="reset" class="btn btn-sm btn-secondary rounded-pill">Cancel</button>
                      </form>
                   </div>
                </div>
             </div>
             <div class="col-lg-5" >
                <div class="tech-card-body card bg-none card-box preview-height" id="sticky">
                   <div class="h-100 sfdsafg">
                      <!--  <iframe  class="w-100 h-1050" frameborder="0" src="{{url('business/preview/card',$business->id)}}"></iframe> -->
                      @include('card.'.$business->card_theme.'.index')
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
  </div>
</div>
<div class="modal fade" id="socialsModal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div>
            <h4 class="h4 font-weight-400 float-left modal-title">{{__('Add Field')}}</h4>
            <a href="#" class="more-text widget-text float-right close-icon" data-dismiss="modal" aria-label="close">{{__('Close')}}</a>
         </div>
         <div class="modal-body">
            <div class="card bg-none card-box px-4 py-4">
               <div class="row d-flex align-items-center justify-content-between">
                  <div class="col-auto">
                     @foreach($businessfields as $val)
                     @if($val != 'Email' && $val != 'Phone')
                     <button type="button" value="{{$val}}" id="{{$val}}" data-id="{{$val}}" class="btn btn-sm btn-secondary text-muted mb-2 getvalue" onclick="socialRepeater(this.id)">
                        <image class="{{ $val }} mb-3  mt-2" src="{{asset('assets/icon/'.strtolower($val).'.svg')}}" style="color:#082e7b;">
                        </i>
                        <h6 class="text-muted">{{ $val }}</h6>
                     </button>
                     @endif
                     @endforeach
                     <div id="addnewfield">
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@push('custom-scripts')
<script type="text/javascript" src="{{asset('assets/js/repeaterInput.js')}}"></script>
<script src="{{ asset('js/bootstrap-toggle.js') }}"></script>
<script src="{{asset('assets/js/jquery.qrcode.js')}}"></script>
<script type="text/javascript" src="https://jeromeetienne.github.io/jquery-qrcode/src/qrcode.js"></script>
<script type="text/javascript">
   var theme = '{{$business->card_theme}}';
   var theme_path = `{{ asset('assets/${theme}/icon/') }}`;
   var asset_path = `{{ asset('assets/icon/') }}`
   var color = `{{$business->theme_color}}`.substring(0,6);
   var add_row_no = {{$no}};
   function getValue(el){
     //alert(el);
     var data = repeaterInput(el,'contact',add_row_no,'inputrow_contact',theme_path,`${theme}`,color,asset_path);
     add_row_no = data;
   }
   var row_no = {{$appointment_no}};
   function appointmentRepeater(){

     var data = repeaterInput('','appointment',row_no,'inputrow_appointment',"",`${theme}`,color,asset_path);
     row_no = data;
   }
   var service_row_no = {{$service_row_no}};
     function servieRepeater(){
       var data = repeaterInput('','service',service_row_no,'inputrow_service',theme_path,`${theme}`,color,asset_path);
       service_row_no = data;
     }

   var testimonials_row_no = {{$testimonials_row_no}};
     function testimonialRepeater(){
       var data = repeaterInput('','testimonial',testimonials_row_no,'inputrow_testimonials',"{{asset('assets/img/logo-placeholder-image-2.png')}}",`${theme}`,color,asset_path);
       testimonials_row_no = data;
     }

   var socials_row_no = {{$social_no}};
     function socialRepeater(el){
       //alert(el);
       var data = repeaterInput(el,'social_links',socials_row_no,'inputrow_socials',theme_path,`${theme}`,color,asset_path);
       socials_row_no = data;
     }
     $( "#is_business_hours_enabled" ).change(function() {
         var $input = $( this );
         var enable = $input.is( ":checked" );

         //console.log(enable);
         if(enable == true){
           $('#business-hours-div').show();
           //console.log('dfd');
           $('#showElement').show();
         }
         if(enable == false){
           $('#showElement').hide();
           $('#business-hours-div').hide();
         }
       }).change();

     $( "#is_appoinment_enabled" ).change(function() {
         var $input = $( this );
         var enable = $input.is( ":checked" );

         //console.log(enable);
         if(enable == true){
           //console.log('dfd');
           $('#appointment-div').show();
           $('#showAppoinment').show();
         }
         if(enable == false){
           $('#appointment-div').hide();
           $('#showAppoinment').hide();
         }
       }).change();


     $( "#is_socials_enabled" ).change(function() {
         var $input = $( this );
         var enable = $input.is( ":checked" );

         //console.log(enable);
         if(enable == true){
           //console.log('dfd');
           $('#social-div').show();
           $('.social-div').show();
           $('#showSocials').show();
         }
         if(enable == false){
           $('#social-div').hide();
           $('#showSocials').hide();
         }
       }).change();

     $( "#is_testimonials_enabled" ).change(function() {
         var $input = $( this );
         var enable = $input.is( ":checked" );

         //console.log(enable);
         if(enable == true){
           //console.log('dfd');
           $('#testimonials-div').show();
           $('#showTestimonials').show();
         }
         if(enable == false){
           $('#testimonials-div').hide();
           $('#showTestimonials').hide();
         }
       }).change();

     $( "#is_services_enabled" ).change(function() {
         var $input = $( this );
         var enable = $input.is( ":checked" );

         //console.log(enable);
         if(enable == true){
           //console.log('dfd');
           $('#services-div').show();
           $('#showServices').show();
         }
         if(enable == false){
           $('#services-div').hide();
           $('#showServices').hide();
         }
       }).change();
     $( "#is_contacts_enabled" ).change(function() {
         var $input = $( this );
         var enable = $input.is( ":checked" );

         //console.log(enable);
         if(enable == true){
           //console.log('dfd');
           $('#showContact').show();
           $('#showContact_preview').show();
         }
         if(enable == false){
           $('#showContact').hide();
           $('#showContact_preview').hide();
         }
       }).change();


     var count = document.querySelectorAll('.inputFormRow').length;
     if(count < 3){
       $('.hideelement').show();
     }
     else{
       $('.hideelement').hide();
     }
   /*var testinomials_radio_class = 'stars' + testimonials_row_no;
   $(document).on("change", "input[class=" + testinomials_radio_class + "]", function () {
       //alert("hiii");
       var stars_view = $(this).val();
       var stars_class = $(this).attr('class');
       console.log('#' + stars_class);
       $('#' + stars_class).text(stars_view);
       //console.log(color);
   });
   */

   function changeFunction(el){
      var data_preview_id = $(`#${el}`).data('id');
      var start_time_preview = $(`#${data_preview_id}_start`).val();
      var end_time_preview = $(`#${data_preview_id}_end`).val();
      var time_preview = start_time_preview + '-' + end_time_preview;
      //var is_closed = $(`.${data_preview_id}`).text();
      if($(`#${data_preview_id}`).prop('checked')){
      $(`.${data_preview_id}`).text(time_preview);
   }
   //var preview_time = $(`#${el}`).val();
   //$(`.${el}`).text(preview_time);
   }
   function getRadio(el){
   //var classss = $(el).attr('class');
      var get_val = $(el).val();
      //alert(get_val);
      var get_class = $(el).attr('class');
      $('.' + get_class).text(get_val);
      var span_star = '';
   /*for (let i = 1; i <= 5; i++) {
   if(i <= get_val){
       span_star =  `<i class="text-warning fas fa-star-half-alt"></i>`;
   }
   else{
   span_star = `<i class="fas fa-star"></i>`;
   }
   }
   $('#' + get_class + '_star').html(span_star);*/

   const arr = [
   1,
   2,
   3,
   4,
   5
   ];
   $('#' + get_class + '_star').text('')
   $.each(arr, function(index, value) {
   //console.log(value);
   // Will stop running after "three"
   //return (value !== 3);
   if(value <= get_val){
       span_star =  `<i class="star-color  fas fa-star"></i>`;
   }
   else{
     span_star = `<i class="fa fa-star"></i>`;
   }
   console.log(span_star);
   $('#' + get_class + '_star').append(span_star);
   });
   //console.log(span_star);


   }

   function validURL(str) {
       var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
         '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
         '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
         '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
         '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
         '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
       return !!pattern.test(str);
     }


   $( "input" ).keyup(function() {
    var id = $(this).attr('id');
    //console.log(id);
    var preview = $(`#${id}`).val();
    $(`#${id}_preview`).text(preview);
   });

   $( ".social_href" ).keyup(function() {
    var id = $(this).attr('id');
    //console.log(id);
    var preview = $(`#${id}`).val();
    var h_preview = validURL(preview);
    //console.log(h_preview);
    if(h_preview == true){
       $(`#${id}_error_href`).text("");
       $(`#${id}_href_preview`).attr("href",preview);
    }else{
       $(`#${id}_error_href`).text("Please enter valid link");
       $(`#${id}_href_preview`).attr("href","#");
    }
    //var h_preview = `{{ url("") }}/${preview}`;

   });

   $( "textarea" ).keyup(function() {
    var id = $(this).attr('id');
    //console.log(id);
    var preview = $(`#${id}`).val();
    $(`#${id}_preview`).text(preview);
   });

   $(".days").change(function() {
     var day_id = $(this).attr('id');
     //console.log(day_id);
     if($(this).prop('checked')) {
       var this_attr_id = $(this).attr('id');
       var start_time = $(`#${this_attr_id}_start`).val();
       var end_time = $(`#${this_attr_id}_end`).val();
       if(start_time == '' && end_time ==''){
         //var time = start_time + '-' + end_time;
         $(`.${day_id}`).text('00:00');
         //console.log("empty");
         //console.log("Checked Box Selected");
       }else{
         var time = start_time + '-' + end_time;
         $(`.${day_id}`).text(time);
       }
     } else {
       $(`.${day_id}`).text('closed');
         //console.log("Checked Box deselect");
     }
   });

   function changeTime(el){
     //alert("hii");
     var time_input =  $(`#${el}`).val();
     $(`#${el}_preview`).text(time_input);
   }

   $(document).on('click', 'input[name="theme_color"]', function () {
     var eleParent = $(this).attr('data-theme');
     $('#themefile').val(eleParent);
     var imgpath = $(this).attr('data-imgpath');
     $('.' + eleParent + '_img').attr('src', imgpath);
     //console.log(imgpath);
     $('.theme_preview_img').attr('src',imgpath);
     setTimeout(function (e) {
      $('.theme-save').trigger('click');
     },200);
   });

   $(document).ready(function () {
       setTimeout(function (e) {
           var checked = $("input[type=radio][name='theme_color']:checked");
           $('#themefile').val(checked.attr('data-theme'));
           $('.' + checked.attr('data-theme') + '_img').attr('src', checked.attr('data-imgpath'));
           $('.theme_preview_img').attr('src',checked.attr('data-imgpath'));
           //console.log(checked.attr('data-imgpath'));
       }, 300);


   });




</script>
@endpush
