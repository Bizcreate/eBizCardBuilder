@extends('layouts.auth')
@section('page-title')
{{__('Login')}}
@endsection
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
                    <div class="mb-5">
                      <h6 class="h3">{{ __('Login') }}</h6>
                      <p class="text-muted mb-0">{{__('Sign in to your account to continue.')}}</p>
                    </div>
                    <span class="clearfix"></span>
                    {{ Form::open(array('route'=>'login','method'=>'post','id'=>'loginForm','class'=>'login-form' ))}}
                      <div class="form-group">
                        {{Form::label('email',__('Email'))}}
                        <div class="input-group input-group-merge">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                          </div>
                          {{Form::text('email',null,array('class'=>'form-control','id'=>'input-email','placeholder'=>__('Enter Your Email')))}}
                          @error('email')
                                <span class="invalid-email text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                          @enderror
                        </div>
                      </div>
                      <div class="form-group mb-4">
                        <div class="d-flex align-items-center justify-content-between">
                          <div>
                            {{Form::label('password',__('Password'),array('class' => 'form-control-label'))}}
                          </div>
                          <div class="mb-2">
                            @if (Route::has('password.request'))
                                    <a class="small text-muted text-underline--dashed border-primary" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                            @endif
                          </div>
                        </div>
                        <div class="input-group input-group-merge">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                          </div>
                          <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="input-password" placeholder="Password">
                          <div class="input-group-append">
                            <span class="input-group-text">
                              <a href="#" data-toggle="password-text" data-target="#input-password">
                                <i class="fas fa-eye"></i>
                              </a>
                            </span>
                          </div>
                          @error('password')
                                <span class="invalid-password text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                </span>
                          @enderror
                        </div>
                      </div>
                      <div class="mt-4"><button type="submit" class="btn btn-sm btn-primary btn-icon rounded-pill">
                          <span class="btn-inner--text">{{ __('Login') }}</span>
                          <span class="btn-inner--icon"><i class="fas fa-long-arrow-alt-right"></i></span>
                        </button></div>
                    </form>
                  </div>
                  <div class="card-footer px-md-5"><small>Not registered?</small>
                    <a href="{{url('register')}}" class="small font-weight-bold">Create account</a></div>
                </div>
              </div>
            </div>
          </div>
@endsection
