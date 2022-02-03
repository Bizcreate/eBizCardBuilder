@php
    $social_no = 1;
    $appointment_no = 0;
    $service_row_no = 0;
    $testimonials_row_no = 0;
    $path = isset($business->banner) && !empty($business->banner) ? asset(Storage::url('card_banner/'.$business->banner)) : asset('assets/img/placeholder-image.jpg');
    $no = 1;
    $stringid = $business->id;
    $is_enable = false;
    $is_enable_appoinment = false;
    $is_enable_service = false;
    $is_enable_testimonials = false;
    $is_enable_sociallinks = false;

    if(!is_null($business_hours) && !is_null($businesshours)){
        $businesshours['is_enabled'] == '1' ? $is_enable = true : $is_enable = false;
    }

    if(!is_null($appoinment_hours) && !is_null($appoinment)){
        $appoinment['is_enabled'] == '1' ? $is_enable_appoinment = true : $is_enable_appoinment = false;
    }

    if(!is_null($services_content) && !is_null($services)){
        $services['is_enabled'] == '1' ? $is_enable_service = true : $is_enable_service = false;
    }

    if(!is_null($testimonials_content) && !is_null($testimonials)){
        $testimonials['is_enabled'] == '1' ? $is_enable_testimonials = true : $is_enable_testimonials = false;
    }

    if(!is_null($social_content) && !is_null($sociallinks)){
        $sociallinks['is_enabled'] == '1' ? $is_enable_sociallinks = true : $is_enable_sociallinks = false;
    }
    if(isset($color)){
        $business->theme_color =$color;
    }
     $color = substr($business->theme_color,0,6);
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$business->title}}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="author" content="{{$business->title}}">
    <
    <meta name="keywords" content="{{$business->meta_keyword}}">
    <meta name="description" content="{{$business->meta_description}}">
     @if(isset($is_slug))
    <link rel="stylesheet" href="{{asset('assets/theme5/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/theme5/modal/bootstrap.min.css')}}">
    <script src="{{asset('assets/theme5/modal/jquery.min.js')}}"></script>
    <script src="{{asset('assets/theme5/modal/bootstrap.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('assets/theme5/fontawesome-free/css/all.min.css')}}">
    @endif
    <link rel="stylesheet" href="{{asset('assets/theme5/css/styles/'.$business->theme_color.'/style.css')}}">
</head>

<body>
    <div class="wrapper">
        <div class="vCard">
            <div class="vCard-header">
                <div class="bg-white overflow-hidden">
                    <div class="banner-card-header">
                        <div class="banner-image">
                            <div class="banner-image-bg">
                                <div class="profile-head">
                                    <div class="align-items-center justify-content-center profile-head-main">
                                        <div class="profile-qr-code">
                                            <img src="{{ isset($business->logo) && !empty($business->logo) ? asset(Storage::url('card_logo/'.$business->logo)) : asset('assets/img/logo-placeholder-image-2.png') }}"  id="banner_preview"alt="user"
                                                class="img-fluid">
                                        </div>
                                        <div class="vcard-description">
                                            <h1 id="{{$stringid.'_title'}}_preview">{{$business->title}}</h1>
                                            <h6 id="{{$stringid.'_designation'}}_preview">{{$business->designation}}</h6>
                                            <p id="{{$stringid.'_subtitle'}}_preview">{{$business->sub_title}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-detail p-0">
                            <div class="card-contact pt-0">
                                <div
                                    class="text-center card-business-hours d-flex align-items-center justify-content-between ">
                                    <div class="make-an-appointment d-flex">
                                        <button type="button"
                                            class="make-an-appointment-btn-main d-flex align-items-center justify-content-center w-100 save-card" onclick="location.href = '{{route('bussiness.save',$business->slug)}}'">
                                            <img src="{{asset('assets/theme5/icon/save.svg')}}" alt="folder" class="img-fluid">
                                            <h4>{{ __('Save card') }}</h4>
                                        </button>
                                    </div>
                                    <div class="make-an-appointment d-flex">
                                        <button type="button"
                                            class="border-dark make-an-appointment-btn-main d-flex align-items-center justify-content-center w-100 bg-transparent"
                                            data-toggle="modal" data-target="#myModal">
                                            <img src="{{asset('assets/theme5/icon/share.svg')}}" alt="signout" class="img-fluid">
                                            <h4 class="text-white">{{ __('Share card') }}</h4>
                                        </button>
                                    </div>
                                </div>
                                <div class="vcard-description ">
                                    <p id="{{$stringid.'_desc'}}_preview">{{$business->description}}</p>
                                </div>
                                <div class="card-contact-header social-div">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <div class="contact-text">
                                            <h3 class="text-white">{{ __('Social') }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="social-icon social-div">
                                    <div class="text-center card-business-hours res-pt-0e">
                                        <div class="social-icon-main w-100 align-items-center justify-content-center">
                                            <div class="container-lg">
                                                <div class="row justify-content-between" id="inputrow_socials_preview">
                                                    @foreach($social_content as $social_key => $social_val)
                                                        @foreach($social_val as $social_key1 => $social_val1)
                                                            @if($social_key1 !== 'id')
                                                            <div class="col-3 socials_{{$loop->parent->index+1}}" id="socials_{{$loop->parent->index+1}}">
                                                                <div class="social-image-icon">
                                                                    <a href="{{$social_val1}}">
                                                                        <img src="{{asset('assets/theme5/icon/'.$color.'/social/'.strtolower($social_key1).'.svg')}}" alt="twitter"
                                                                            class="img-fluid">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-contact appointment-div">
                        <div class="card-contact-header">
                            <ul>
                                <li class=" d-flex align-items-center justify-content-start">
                                    <div class="contact-text">
                                        <h3> {{ __('Appointment') }}</h3>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="text-center card-business-hours pb-0">
                            <form action="" class="datepicker-form">
                                <div class="date-click d-flex w-50 float-left">
                                    <div class="pr-4">
                                        <div class="lable-custom">
                                            <label for="input_from" class="Date appointment-lable">{{ __('Date') }}</label>
                                        </div>
                                        <div class="radio-custom date-input">
                                            <div class="">
                                                <input type="text" id="input_from" class="app_date text-center"
                                                    placeholder="Pick a Date">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-50 float-left dropdown time-dropdown-sec category-dropdown-main"
                                    tabindex="1">
                                    <div class="select w-100">
                                        <div class="lable-custom">
                                            <label for="Category" class="Date appointment-lable">{{ __('Hours') }}</label>
                                        </div>
                                        <div
                                            class="time-dropdown w-100 d-flex align-items-center justify-content-start justify-content-xs-center justify-content-sm-center">
                                            <span class="app_time">00:00 - 00:00</span>
                                            <i class="fa fa-angle-down right-side-arrow" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <input type="hidden" name="Category">
                                    <ul class="dropdown-menu time-dropdown-menu" style="display: none;" id="inputrow_appointment_preview">
                                        @php $radiocount = 1; @endphp
                                        @if(!is_null($appoinment_hours))
                                            @foreach($appoinment_hours as $k => $hour)
                                                <li id="{{'appointment_'.$appointment_no}}">@if(!empty($hour->start)) {{$hour->start}} @else 00:00  @endif  -  @if(!empty($hour->end)) {{$hour->end}} @else 00:00  @endif</li>
                                                @php
                                                $radiocount++;
                                                $appointment_no++;
                                            @endphp
                                        @endforeach
                                    @endif
                                    </ul>
                                </div>
                                <div class="text-center pl-3 ">
                                    <span class="text-danger text-center h5 span-error-date" style="margin-left: 78px;"></span>
                                </div>
                                <div class="text-center pl-3">
                                    <span class="text-danger text-center h5 span-error-time" style="margin-left: 78px;"></span>
                                </div>
                                <div class="make-an-appointment d-flex w-100 p-0">
                                    <div class="make-an-appointment-btn">
                                        <button type="button" data-toggle="modal" data-target="#appointment-modal"
                                            class="make-an-appointment-btn-main d-flex align-items-center justify-content-center w-100">
                                            <img src="{{asset('assets/theme5/icon/calender-black.svg')}}" alt="calender-black"
                                                class="img-fluid">
                                            <h4>{{ __('Make an appointment') }}</h4>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card-contact services-div">
                        <div class="">
                            <ul>
                                <li class="d-flex align-items-center justify-content-start">
                                    <div class="contact-text">
                                        <h3> <span> </span> {{ __('Services') }}</h3>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-contact services-div">
                        <div class="container-lg">
                            <div class="row" id="inputrow_service_preview">
                                @php $image_count = 0; @endphp
                                @foreach($services_content as $k1 => $content)
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="services_{{$service_row_no}}">
                                        <div class="service-card">
                                            <div class="service-card-img">
                                                <img src="{{ !empty($content->image) ? asset(Storage::url('service_images/'.$content->image)) : asset('assets/theme2/icon/image.svg') }}"  id="{{'s_image'.$image_count.'_preview'}}" alt="image" class="img-fluid">
                                            </div>
                                            <div class="service-card-heading">
                                                <h3 id="{{'title_'.$service_row_no.'_preview'}}">
                                                    {{$content->title}}
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                    $image_count++;
                                    $service_row_no++;
                                @endphp
                               @endforeach

                            </div>
                        </div>
                    </div>


                    <div class="card-contact testimonials-div">
                        <div class="">
                            <ul>
                                <li class="d-flex align-items-center justify-content-start">
                                    <div class="contact-text">
                                        <h3> <span> </span>  {{ __('Testimonials') }}</h3>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-contact pt-0 testimonials-div">
                        <div class="text-center card-business-hours pb-0">
                            <div class="container-lg">
                                <div class="row" id="inputrow_testimonials_preview">
                                    @php
                                    $t_image_count = 0;
                                    $rating = 0;
                                    @endphp
                                    @foreach($testimonials_content as $k2 => $testi_content)
                                        <div class="col-lg-6 pr-8 pl-0 res-pr-0" id="testimonials_{{$testimonials_row_no}}">
                                            <div class="service-card testimonials-card mb-0 pb-0">
                                                <div class="service-card-img ">
                                                    <img id="{{'t_image'.$t_image_count.'_preview'}}" src="{{ !empty($testi_content->image) ? asset(Storage::url('testimonials_images/'.$testi_content->image)) : asset('assets/img/logo-placeholder-image-2.png') }}" alt="user" class="img-fluid">
                                                </div>
                                                <div class="service-card-heading">
                                                    <h3 class="text-dark">
                                                        <span class="{{'stars'.$testimonials_row_no}}">{{$testi_content->rating}}</span>/5
                                                    </h3>

                                                    @php
                                                        if(!empty($testi_content->rating)){
                                                            $rating = (int)$testi_content->rating;
                                                            $overallrating = $rating;
                                                        }
                                                        else{
                                                            $overallrating = 0;
                                                        }
                                                    @endphp
                                                    <div class="star_color d-flex align-items-center justify-content-center" id="stars{{$testimonials_row_no}}_star">
                                                        @for($i=1; $i<=5; $i++)
                                                            @if($overallrating < $i)
                                                                @if(is_float($overallrating) && (round($overallrating) == $i))
                                                                    <i class="star-color fas fa-star-half-alt"></i>
                                                                @else
                                                                    <i class="fa fa-star" style="color: #8a8080 !important;"></i>
                                                                @endif
                                                            @else
                                                                <i class="star-color fas fa-star"></i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                    <p  id="testimonial_description_{{$testimonials_row_no}}_preview">
                                                        {{$testi_content->description}}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                            $t_image_count++;
                                            $testimonials_row_no++;
                                        @endphp
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-contact business-hour-bg" id="business-hours-div">
                        <div class="card-contact-header">
                            <ul>
                                <li class="d-flex align-items-center justify-content-start">

                                    <div class="contact-text">
                                        <h3 class="text-white">{{ __('Business Hours') }}</h3>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="card-business-hours pb-0">
                            <ul>
                                @foreach($days as $k=>$day)
                                    <li>
                                        <p>{{$day}} :<span class="days_{{$k}}"> @if(isset($business_hours->$k) && $business_hours->$k->days=='on')
                                        <span class="days_{{$k}}_start">{{ !empty($business_hours->$k->start_time) && isset($business_hours->$k->start_time) ? $business_hours->$k->start_time : '00:00' }}</span> - <span class="days_{{$k}}_end">{{ !empty($business_hours->$k->end_time) && isset($business_hours->$k->end_time) ? $business_hours->$k->end_time : '00:00' }}</span>
                                            @else
                                            Closed
                                            @endif</span></p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @if(isset($contactinfo['is_enabled']) && $contactinfo['is_enabled'] == '1')
                    <div class="card-contact">
                        <div class="card-contact-header">
                            <ul>
                                <li class="d-flex align-items-center justify-content-start">
                                    <div class="contact-text">
                                        <h3>{{ __('Contact informations') }}</h3>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="text-center contact_informations">
                            <ul class="row justify-content-center" id="inputrow_contact_preview">
                                @if(!is_null($contactinfo_content) && !is_null($contactinfo))
                                @if($contactinfo['is_enabled'] == '1')
                                    @foreach($contactinfo_content as $key => $val)
                                        @foreach($val as $key1 => $val1)
                                            @if($key1 == 'Phone')
                                                @php $href = 'tel:'.$val1; @endphp
                                            @elseif($key1 == 'Email')
                                                @php $href = 'mail:'.$val1; @endphp
                                            @else
                                                @php $href = $val1 @endphp
                                            @endif
                                            @if($key1 != 'id')
                                                <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="contact_{{$loop->parent->index+1}}">
                                                    <div class="d-flex align-items-center justify-content-start">
                                                        <div class="image-icon">
                                                            <img src="{{asset('assets/theme5/icon/'.$color.'/contact/'.strtolower($key1).'.svg')}}" alt="{{$key1}}" class="img-fluid">
                                                        </div>
                                                        <div class="contact-text">
                                                            <a href="{{$href}}">
                                                                <h4 id="{{$key1.'_'.$no}}_preview">{{$val1}}</h4>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach
                                    @endforeach
                                @endif
                                @endif
                            </ul>
                        </div>
                    </div>
                    @endif
                    <div class="card-contact banner-card-header">
                        <div class="text-center card-business-hours d-flex align-items-center justify-content-between p-0">
                            <div class="make-an-appointment d-flex">
                                <button type="button" class="make-an-appointment-btn-main d-flex align-items-center justify-content-center w-100 save-card"  >
                                    <img src="{{asset('assets/theme5/icon/save.svg')}}" alt="folder" class="img-fluid">
                                    <h4>{{__('Save card')}}</h4>
                                </button>
                            </div>
                            <div class="make-an-appointment d-flex">
                                <button type="button" class="border-dark make-an-appointment-btn-main d-flex align-items-center justify-content-center w-100 bg-transparent" data-toggle="modal" data-target="#myModal">
                                    <img src="{{asset('assets/theme5/icon/signout.svg')}}" alt="signout" class="img-fluid">
                                    <h4 class="text-white">{{__('Share card')}}</h4>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade appointment-modal" id="appointment-modal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header border-0">
                    <div class="modal-custom-header d-flex align-items-center justify-content-between w-100">
                        <h4 class="modal-title">{{__('Make Appointment')}}</h4>
                        <button type="button" class="back-btn d-flex align-items-center justify-content-center"
                            data-dismiss="modal">
                            <img src="{{asset('assets/theme5/icon/close.svg')}}" alt="back" class="img-fluid">
                        </button>
                    </div>
                </div>
                <div class="modal-body px-4">
                    <form class="appointment-form">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">{{__('Name')}}:</label>
                            <input type="text" name="name" placeholder="{{__('Enter your name')}}" class="form-control app_name"
                                id="recipient-name">
                            <div class="">
                                <span class="text-danger  h5 span-error-name"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">{{__('Email')}}:</label>
                            <input type="email" name="email" placeholder="{{__('Enter your email')}}"
                                class="form-control app_email" id="recipient-name">
                            <div class="">
                                <span class="text-danger  h5 span-error-email"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">{{__('Phone')}}:</label>
                           <input type="text" name="phone" placeholder="Enter your phone no." class="form-control app_phone" id="recipient-name">
                           <div class="">
                                <span class="text-danger  h5 span-error-phone"></span>
                            </div>
                          </div>
                        <div class="form-btn-group">
                            <button type="button" class="btn form-btn--close" data-dismiss="modal">{{__('Close')}}</button>
                            <button type="button" class="btn form-btn--submit" id="makeappointment">{{__('Make Appointment')}} </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade qr-modal" id="myModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-half-bg">
                </div>
                <div class="modal-header border-0">
                    <div class="modal-custom-header d-flex align-items-center justify-content-between w-100">
                        <button type="button" class="back-btn d-flex align-items-center justify-content-center" data-dismiss="modal">
                            <img src="{{asset('assets/theme5/img/back.svg')}}" alt="back" class="img-fluid">
                        </button>
                        <h4 class="modal-title">{{__('Share this card')}}</h4>
                        <button type="button" class="logout-btn">
                            <img src="{{asset('assets/theme5/icon/signout-black.svg')}}" alt="signout" class="img-fluid">
                        </button>
                    </div>
                </div>
                <div class="modal-body border-0">
                    <div class="modal-body-section text-center">
                        <div class="qr-main-image">
                            <div class="qr-code-border">
                                <img src="{{asset('assets/theme5/icon/left-top.svg')}}" alt="left-top" class="img-fluid left-top-border">
                                <img src="{{asset('assets/theme5/icon/left-bottom.svg')}}" alt="left-bottom"
                                    class="img-fluid left-bottom-border">
                                <img src="{{asset('assets/theme5/icon/right-top.svg')}}" alt="right-top" class="img-fluid right-top-border">
                                <img src="{{asset('assets/theme5/icon/right-bottom.svg')}}" alt="right-bottom"
                                    class="img-fluid right-bottom-border">
                            </div>
                            <div class="qrcode mt-3"></div>
                        </div>
                        <div class="text">
                            <p>
                                {{__('Point your camera at the QR code, or visit')}} <span class="qr-link text-center mr-2"></span>
                            </p>
                        </div>
                        <div class="share-card-btn">
                            <button type="button" class="share-card-btn-main">
                                <img src="{{asset('assets/theme5/icon/signout-black.svg')}}" alt="signout" class="img-fluid">
                                {{__('Share our card')}}
                            </button>
                        </div>
                        <div class="text social-div">
                            <p class="mb-0">
                                {{__('Or check my social channels')}}
                            </p>
                        </div>
                        <div class="social-icon-section modal-social-icon-section social-div">
                            <div class="text-center card-business-hours pb-20">
                                <div class="container-lg">
                                    <div class="row">
                                        <div class="social-icon w-100 d-flex align-items-center justify-content-center inputrow_socials_preview">
                                            @foreach($social_content as $social_key => $social_val)
                                            @foreach($social_val as $social_key1 => $social_val1)
                                                @if($social_key1  != 'id')
                                                <span class="socials_{{$loop->parent->index+1}}" id="socials_{{$loop->parent->index+1}}">
                                                     <div class="image-icon">
                                                        <a href="#">
                                                            <img src="{{asset('assets/theme5/icon/'.$color.'/social_white/'.strtolower($social_key1).'.svg')}}" alt="twitter"
                                                                class="img-fluid">
                                                        </a>
                                                    </div>
                                                </span>
                                                @endif
                                            @endforeach
                                        @endforeach
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.3/picker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.3/picker.date.js"></script>
    <script src="{{asset('assets/js/jquery.qrcode.js')}}"></script>
    <script type="text/javascript" src="https://jeromeetienne.github.io/jquery-qrcode/src/qrcode.js"></script>
    <script>
        $( document ).ready(function() {
            $(`.span-error-date`).text("");
            $(`.span-error-time`).text("");
            $(`.span-error-name`).text("");
            $(`.span-error-email`).text("");
            var slug = '{{$business->slug}}';
            var url_link = `{{ url("/") }}/${slug}`;
            $(`.qr-link`).text(url_link);
            $('.qrcode').qrcode({width: 180,height: 180,text: url_link});
            var time = $('.time-dropdown-sec li').first().text();
           $('.time-dropdown span').text(time);
        });

        $(`.rating_preview`).attr('id');
        var from_$input = $('#input_from').pickadate(),
            from_picker = from_$input.pickadate('picker')

        var to_$input = $('#input_to').pickadate(),
            to_picker = to_$input.pickadate('picker')

        var is_enabled = "{{$is_enable}}";
        if(is_enabled){
            $('#business-hours-div').show();
        }else{
            $('#business-hours-div').hide();
        }

        var is_enabled = "{{$is_enable}}";
        if(is_enabled){
            $('#business-hours-div').show();
        }else{
            $('#business-hours-div').hide();
        }

        var is_enable_appoinment = "{{$is_enable_appoinment}}";
        if(is_enable_appoinment){
            $('.appointment-div').show();
        }else{
            $('.appointment-div').hide();
        }

        var is_enable_service = "{{$is_enable_service}}";
        if(is_enable_service){
            $('.services-div').show();
        }else{
            $('.services-div').hide();
        }

        var is_enable_testimonials = "{{$is_enable_testimonials}}";
        if(is_enable_testimonials){
            $('.testimonials-div').show();
        }else{
            $('.testimonials-div').hide();
        }


        var is_enable_sociallinks = "{{$is_enable_sociallinks}}";
        if(is_enable_sociallinks){
            $('.social-div').show();
        }else{
            $('.social-div').hide();
        }
        $('.time-dropdown-sec').click(function () {
            $(this).attr('tabindex', 1).focus();
            $(this).toggleClass('active');
            $(this).find('.time-dropdown-menu').slideToggle(300);
        });
        $('.time-dropdown-sec').focusout(function () {
            $(this).removeClass('active');
            $(this).find('.time-dropdown-menu').slideUp(300);
        });
        $('.time-dropdown-sec .time-dropdown-menu li').click(function () {
            $(this).parents('.time-dropdown-sec').find('span').text($(this).text());
            $(this).parents('.time-dropdown-sec').find('input').attr('value', $(this).attr('id'));
        });

        $( `#makeappointment` ).click(function() {
            var name = $(`.app_name`).val();
            var email = $(`.app_email`).val();
            var date = $(`.picker__input`).val();
            var time = $(`.time-dropdown span`).text();
            var business_id = '{{$business->id}}';
            var phone = $(`.app_phone`).val();
            $(`.span-error-date`).text("");
            $(`.span-error-time`).text("");
            $(`.span-error-name`).text("");
            $(`.span-error-email`).text("");

            if(date == ""){
                $(`.span-error-date`).text("*Please choose date");
                $("[data-dismiss=modal]").trigger({ type: "click" });
            }
            else if(time.length < 1){
                $(`.span-error-time`).text("*Please choose time");
                $("[data-dismiss=modal]").trigger({ type: "click" });
            }
            else if(name == ""){
                $(`.span-error-name`).text("*Please enter your name");
            }
            else if(email == ""){
                $(`.span-error-email`).text("*Please enter your email");
            } else if(phone == ""){
                //alert("DSfgbn");
                $(`.span-error-phone`).text("{{__('*Please enter your phone no.')}}");
            }
            else{
                $(`.span-error-date`).text("");
                $(`.span-error-time`).text("");
                $(`.span-error-name`).text("");
                $(`.span-error-email`).text("");
                $.ajax({
                    url: '{{route('appoinment.store')}}',
                    type: 'POST',
                    data: {
                        "name": name,"email": email,"phone":phone,"date": date,"time": time,"business_id": business_id, "_token": "{{ csrf_token() }}",
                    },
                    success: function (data) {
                        location.reload();
                        $("[data-dismiss=modal]").trigger({ type: "click" });
                    }
                });
            }
        });
    </script>
       <!-- Google Analytic Code -->
       <script async src="https://www.googletagmanager.com/gtag/js?id={{$business->google_analytic}}"></script>
       <script>
           window.dataLayer = window.dataLayer || [];
           function gtag() {
               dataLayer.push(arguments);
           }
           gtag('js', new Date());
           gtag('config', '{{ $business->google_analytic }}');    
       </script>
       
       <!-- Facebook Pixel Code -->
       <script>
         !function(f,b,e,v,n,t,s)
         {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
         n.callMethod.apply(n,arguments):n.queue.push(arguments)};
         if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
         n.queue=[];t=b.createElement(e);t.async=!0;
         t.src=v;s=b.getElementsByTagName(e)[0];
         s.parentNode.insertBefore(t,s)}(window, document,'script',
         'https://connect.facebook.net/en_US/fbevents.js');
         fbq('init', '{{$business->fbpixel_code}}');
         fbq('track', 'PageView');
       </script>
       <noscript><img height="1" width="1" style="display:none"
         src="https://www.facebook.com/tr?id=0000&ev=PageView&noscript={{$business->fbpixel_code}}"
       /></noscript>
       
         <!-- Custom Code -->
       
       {!! $business->customjs !!}
       
</body>
</html>
