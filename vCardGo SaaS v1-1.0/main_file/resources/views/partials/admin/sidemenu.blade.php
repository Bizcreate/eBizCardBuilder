@php
    $logo=asset(Storage::url('uploads/logo/'));
    $company_logo=\App\Models\Utility::getValByName('logo');
@endphp
<div class="sidenav custom-sidenav" id="sidenav-main">
  <!-- Sidenav header -->
  <div class="sidenav-header d-flex align-items-center">
    <a class="navbar-brand" href="{{url('/')}}">
      @if(Auth::user()->type == 'super admin')
        <img src="{{$logo.'/logo.png'}}" class="navbar-brand-img" alt="...">
      @else
        <img src="{{asset(Storage::url($company_logo))}}" class="navbar-brand-img" alt="...">
      @endif
     
    </a>
    <div class="ml-auto">
      <!-- Sidenav toggler -->
      <div class="sidenav-toggler sidenav-toggler-dark d-md-none" data-action="sidenav-unpin" data-target="#sidenav-main">
        <div class="sidenav-toggler-inner">
          <i class="sidenav-toggler-line bg-white"></i>
          <i class="sidenav-toggler-line bg-white"></i>
          <i class="sidenav-toggler-line bg-white"></i>
        </div>
      </div>
    </div>
  </div>
  <div class="scrollbar-inner">
    <div class="div-mega">
        <ul class="navbar-nav navbar-nav-docs">
          <li class="nav-item">
            <a href="{{route('home')}}" class="nav-link {{ (Request::segment(1) == 'home' || Request::segment(1) == '' ||Request::segment(1) == 'dashboard')?'active':''}}">
              <i class="fas fa-home"></i>{{ __('Dashboard') }}
            </a>
          </li>
          @if(Auth::user()->type == 'super admin')
            <li class="nav-item">
                <a href="{{ route('coupons.index') }}" class="nav-link {{ (Request::segment(1) == 'coupons')?'active':''}}">
                <i class="fas fa-gift"></i><span> {{ __('Coupons') }} </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('users.index') }}" class="nav-link {{ (Request::segment(1) == 'users')?'active':''}}">
                <i class="fas fa-columns"></i><span> {{ __('Users') }} </span>
                </a>
            </li>
             
            <li class="nav-item">
                <a href="{{ route('order.index') }}" class="nav-link {{ (Request::segment(1) == 'order')?'active':''}}">
                    <i class="fas fa-cart-plus"></i>{{__('Order')}}
                </a>
            </li>
            @endif
            <li class="nav-item">
              <a href="{{ route('plans.index') }}" class="nav-link {{ (Request::segment(1) == 'plans')?'active':''}}">
              <i class="fas fa-paper-plane"></i><span> {{ __('Plans') }} </span>
              </a>
          </li>
          @if(Auth::user()->type =='company')
          <li class="nav-item">
            <a href="{{route('business.index')}}" class="nav-link {{ (Request::segment(1) == 'business')?'active':''}}">
              <i class="fas fa-users-cog"></i>{{ __('Business') }}
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('appointments.index')}}" class="nav-link {{ (Request::segment(1) == 'appointments')?'active':''}}">
              <i class="fas fa-calendar-check"></i>{{ __('Appointments') }}
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('appointment.calendar')}}" class="nav-link {{ (Request::segment(1) == 'appointment-calendar')?'active':''}}">
              <i class="fas fa-calendar"></i>{{ __('Calendar') }}
            </a>
          </li>
          @endif
          @if(Auth::user()->type =='super admin')
          <li class="nav-item">
              <a href="{{route('custom_landing_page.index')}}" class="nav-link">
                  <i class="fas fa-clipboard"></i>{{__('Landing page')}}
              </a>
          </li>
          
          @endif
          <li class="nav-item">
            <a href="{{route('systems.index')}}" class="nav-link {{ (Request::segment(1) == 'systems')?'active':''}}">
              <i class="fas fa-sliders-h"></i>{{ __('Setting') }}
            </a>
          </li>
        </ul>
    </div>
  </div>
</div>