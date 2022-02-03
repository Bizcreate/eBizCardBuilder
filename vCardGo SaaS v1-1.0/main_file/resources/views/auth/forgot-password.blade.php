@extends('layouts.auth')

@section('title')
    {{ __('Reset Password') }}
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

                      <h4 class="text-primary font-weight-normal mb-1"><strong>{{__('Reset Password')}}</strong></h4>
                      @if(session('status'))
                        <div class="alert alert-primary">
                            {{ session('status') }}
                        </div>
                      @endif
                      <p class="text-xs text-muted">{{__('We will send a link to reset your password')}}</p>
                      <form action="{{ route('password.email') }}" method="POST" class="pt-3 text-left needs-validation" novalidate="">
                        @csrf
                        <label class="d-block position-relative mb-3">
                          <p class="text-sm mb-2">{{ __('E-Mail Address') }}</p>
                          <input type="email" id="email" name="email" value="{{ old('email') }}"  class="text-sm rounded-6 w-100 py-3 px-3 border text-grayDark @error('email') is-invalid @enderror" required autofocus>
                          @error('email')
                            <span class="invalid-feedback" role="alert">
                                <small>{{ $message }}</small>
                            </span>
                          @enderror
                        </label>
                        <button type="submit" class="btn boxbtn fluid shadow-sm btn-primary rounded-6 d-inline-flex align-items-center">
                            <p class="mb-0 pl-4 pr-3 text-sm">{{ __('Send Password Reset Link') }}</p>
                        </button>     
                        <div class="or-text">{{__('OR')}}</div>       
                        <a href="{{route('login')}}" class="btn boxbtn fluid shadow-sm btn-primary rounded-6 d-inline-flex align-items-center">
                            <p class="mb-0 pl-3 pr-3 text-sm">{{ __('Login') }}</p>
                        </a>
                      </form>   
                    </div>
                </div>
            </div>
        </div>
    </div>                     
@endsection

