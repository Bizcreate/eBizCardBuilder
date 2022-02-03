@extends('layouts.admin')
@php
    $dir= asset(Storage::url('uploads/plan'));
@endphp
@section('page-title')
   {{__('Plans')}}
@endsection


@section('content')


@if(\Auth::user()->type=='super admin' && !App\Models\Utility::getPaymentIsOn())
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong><i class="fa fa-exclamation" aria-hidden="true"></i></strong> {{__(' Please configure at list one payment gateway.')}}.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif

<div class="page-title">
  <div class="row justify-content-between align-items-center">
          <div class="col-xl-4 col-lg-4 col-md-4 d-flex align-items-center justify-content-between justify-content-md-start mb-3 mb-md-0">
            <div class="d-inline-block">
              <h5 class="h4 d-inline-block font-weight-400 mb-0 ">{{__('Manage Plan')}}</h5>
            </div>
          </div>
    <div class="col-xl-8 col-lg-8 col-md-8 d-flex align-items-center justify-content-between justify-content-md-end">
    @if(App\Models\Utility::getPaymentIsOn() && \Auth::user()->type=='super admin' )
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
            <a href="#" data-url="{{ route('plans.create') }}" data-ajax-popup="true" data-title="{{__('Create New Plan')}}" class="btn btn-xs btn-white btn-icon-only width-auto">
                <i class="fas fa-plus"></i> {{__('Create')}}
            </a>
        </div>
    @endif
    </div>
  </div>
</div>

    <div class="row">
        @foreach($plans as $plan)
            <div class="col-lg-4 col-xl-3 col-md-6 col-sm-6 mb-4">
                <div class="plan-3">
                    <h6>{{$plan->name}}</h6>
                    <p class="price">
                        <sup>{{(env('CURRENCY_SYMBOL')) ? env('CURRENCY_SYMBOL') : '$'}}</sup>
                        {{$plan->price}}
                        <sub>{{__('Duration : ').ucfirst($plan->duration)}}</sub>
                    </p>
                    <p class="price-text"></p>
                    <ul class="plan-detail">
                        <li>{{count($plan->getThemes())}} {{__('Themes')}}</li>
                        <li>{{$plan->business == '-1'?'Unlimited':$plan->business;}} {{__('Business')}}</li>
                    </ul>
                    @if(\Auth::user()->type=='super admin')
                        <a title="{{__('Edit Plan')}}" href="#" class="button text-xs" data-url="{{ route('plans.edit',$plan->id) }}" data-ajax-popup="true" data-title="{{__('Edit Plan')}}" data-toggle="tooltip" data-original-title="{{__('Edit')}}">
                            <i class="far fa-edit"></i>
                        </a>
                    @endif
                    @if(\Auth::user()->type=='company' && \Auth::user()->plan == $plan->id)
                        @if($plan->duration !== 'Unlimited')
                            @if(\Auth::user()->type == 'company' && (empty(\Auth::user()->plan_expire_date) || \Auth::user()->plan_expire_date < date('Y-m-d')))
                                <p class="server-plan text-red">
                                    {{__('Plan Expired') }}
                                </p>
                            @else
                            <p class="server-plan text-white">
                                {{__('Plan Expired : ') }} {{!empty( \Auth::user()->plan_expire_date) ?  date('d-m-Y',strtotime(\Auth::user()->plan_expire_date)):'Unlimited'}}
                            </p>
                            @endif
                        @else
                        <p class="server-plan text-white">
                                {{__('Plan Expired : Unlimited') }}
                            </p>
                        
                        @endif
                    @endif
                    @if(\Auth::user()->type == 'company' && (empty(\Auth::user()->plan_expire_date) || \Auth::user()->plan_expire_date < date('Y-m-d')))
                        @if(App\Models\Utility::getPaymentIsOn())
                               
                            @if($plan->price > 0)
                                <a href="{{route('stripe',\Illuminate\Support\Facades\Crypt::encrypt($plan->id))}}" class="button text-xs">{{__('Buy Plan')}}</a>
                            @else
                                <a href="#" class="button text-xs">{{__('Free')}}</a>
                            @endif
                               
                        @endcan
                        
                    @else
                        @if(App\Models\Utility::getPaymentIsOn())
                                @if($plan->id != \Auth::user()->plan && \Auth::user()->type=='company')
                                    @if($plan->price > 0)
                                        <a href="{{route('stripe',\Illuminate\Support\Facades\Crypt::encrypt($plan->id))}}" class="button text-xs">{{__('Buy Plan')}}</a>
                                    @else
                                        <a href="#" class="button text-xs">{{__('Free')}}</a>
                                    @endif
                                @endif
                        @endcan
                    @endif
                   
                </div>
            </div>
        @endforeach
    </div>
@endsection
