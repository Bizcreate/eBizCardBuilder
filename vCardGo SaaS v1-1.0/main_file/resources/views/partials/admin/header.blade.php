@php
    $logo=asset(Storage::url('uploads/logo/'));
    $company_favicon=Utility::getValByName('favicon');
@endphp

<head >
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Purpose Application UI is the following chapter we've finished in order to create a complete and robust solution next to the already known Purpose Website UI.">
  <meta name="author" content="Webpixels">
  <title>
      @yield('page-title') - @if(Auth::user()->type == 'super admin')  {{config('app.name', 'vCard SaaS')}} @else {{(Utility::getValByName('title_text')) ? Utility::getValByName('title_text') : config('app.name', 'vCard SaaS')}} @endif </title>
  <!-- Favicon -->
  @if(Auth::user()->type == 'super admin')
  <link rel="icon" href="{{$logo.'/favicon.png'}}" type="image" sizes="16x16">
  @else
    <link rel="icon" href="{{(isset($company_favicon) && !empty($company_favicon)?asset(Storage::url($company_favicon)):'favicon.png')}}" type="image" sizes="16x16">
 @endif
 <!-- Font Awesome 5 -->
  <link rel="stylesheet" href="{{ asset('assets/libs/@fortawesome/fontawesome-free/css/all.min.css') }}">
  <!-- Page CSS -->
  <link rel="stylesheet" href="{{ asset('assets/libs/fullcalendar/dist/fullcalendar.min.css') }}">
  <!-- Purpose CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/datatables.min.css') }}" id="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}">
  @stack('css-page')
  <link rel="stylesheet" href="{{ asset('assets/css/site.css') }}" id="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/ac.css') }}" id="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/stylesheet.css') }}" id="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" id="stylesheet">
  @if(env('SITE_RTL')=='on')
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-rtl.css') }}">
    @endif
</head>