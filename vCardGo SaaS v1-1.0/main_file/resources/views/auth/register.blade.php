@extends('layouts.auth')
@section('page-title')
{{__('Register')}}
@endsection
@section('content')
@php
    $logo=asset(Storage::url('uploads/logo/'));
    $company_logo=Utility::getValByName('company_logo');
@endphp
<div class="w-100">
    <div class="row justify-content-center">
      <div class="col-sm-8 col-lg-5">
        <div class="row justify-content-center mb-3">
            <a class="navbar-brand" href="{{url('/')}}">
                <img src="{{$logo.'/logo.png'}}" class="auth-logo" width="300">
            </a>
        </div>
        <div class="card shadow zindex-100 mb-0">
          <div class="card-body px-md-5 py-5">
            <div class="mb-5">
              <h6 class="h3">{{ __('Register') }}</h6>
              <p class="text-muted mb-0">{{__("Don't have an account? Create your account, it takes less than a minute")}}</p>
            </div>
            <span class="clearfix"></span>
            {{Form::open(array('route'=>'register','method'=>'post','id'=>'loginForm'))}}
              <div class="form-group">
                    <label class="form-control-label">{{__('Name')}}</label>
                    <div class="input-group input-group-merge">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Your Name')))}}
                    </div>
                    @error('name')
                    <span class="error invalid-name text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
              </div>  
              <div class="form-group">
                    <label class="form-control-label">{{__('Email')}}</label>
                    <div class="input-group input-group-merge">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-envelope"></i></span>
                        </div>
                        {{Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter Your Email')))}}
                    </div>
                    @error('email')
                    <span class="error invalid-email text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label class="form-control-label">{{__('Password')}}</label>
                    <div class="input-group input-group-merge">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        {{Form::password('password',array('class'=>'form-control','id'=>'input-password','placeholder'=>__('Enter Your Password')))}}
                        <div class="input-group-append">
                            <span class="input-group-text">
                            <a href="#" data-toggle="password-text" data-target="#input-password">
                                <i class="fas fa-eye"></i>
                            </a>
                            </span>
                        </div>
                    </div>
                    @error('password')
                    <span class="error invalid-password text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-control-label">{{__('Confirm password')}}</label>
                    <div class="input-group input-group-merge">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        {{Form::password('password_confirmation',array('class'=>'form-control','id'=>'confirm-input-password','placeholder'=>__('Enter Your Confirm Password')))}}
                        <div class="input-group-append">
                            <span class="input-group-text">
                            <a href="#" data-toggle="password-text" data-target="#confirm-input-password">
                                <i class="fas fa-eye"></i>
                            </a>
                            </span>
                        </div>
                    </div>
                    @error('password_confirmation')
                    <span class="error invalid-password_confirmation text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="mt-4">
                    {{Form::submit(__('Create my account'),array('class'=>'btn btn-sm btn-primary btn-icon rounded-pill','id'=>'saveBtn'))}}
                </div>
            </div>
            <div class="card-footer px-md-5"><small>{{__('Already have an acocunt?')}}</small>
                <a href="{{ route('login') }}" class="small font-weight-bold">{{__('Login')}}</a>
            </div>
            {{Form::close()}}
    </div>
</div>
@endsection
