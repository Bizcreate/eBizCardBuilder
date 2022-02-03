@extends('layouts.auth')
@section('content')
@php
    $logo=asset(Storage::url('uploads/logo/'));
    $company_logo=Utility::getValByName('company_logo');
@endphp
<div class="w-100">
            <div class="row justify-content-center">
              <div class="col-sm-8 col-lg-4">
                <div class="row justify-content-center mb-3">
                  <a class="navbar-brand" href="{{url('/')}}">
                      <img src="{{$logo.'/logo.png'}}" class="auth-logo" width="300">
                  </a>
              </div>
                <div class="card shadow zindex-100 mb-0">
                  <div class="card-body px-md-5 py-5">
                      <h4 class="text-primary font-weight-normal mb-1"><strong>{{__('Verify Your Email Address')}}</strong></h4>
                      <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                      </div>
                      <span>{{ __('Before proceeding, please check your email for a verification link.') }}</span>
                      <span>{{ __('If you did not receive the email') }},</span>
                      <form action="{{ route('verification.resend') }}" method="POST" class="pt-3 text-left needs-validation" novalidate="">
                        @csrf
                        <button type="submit" class="btn-primary px-4 py-2 text-xs"><span class="d-block py-1">{{ __('click here to request another') }}</span></button>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>                  
@endsection
