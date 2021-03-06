@php
    $users=\Auth::user();
    $profile=asset(Storage::url('uploads/avatar/'));
    $logo=asset(Storage::url('uploads/logo/'));
    $company_logo=Utility::getValByName('company_logo');
    $company_small_logo=Utility::getValByName('company_small_logo');
    $currantLang = $users->currentLanguage();
    $languages=Utility::languages();
@endphp
<nav class="navbar navbar-main navbar-expand-lg navbar-border n-top-header" id="navbar-main">
    <div class="container-fluid">
        <button class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbar-main-collapse"
                aria-controls="navbar-main-collapse"
                aria-expanded="false"
                aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- User's navbar -->
        <div class="navbar-user d-lg-none ml-auto">
            <ul class="navbar-nav flex-row align-items-center">
                <li class="nav-item">
                    <a
                        href="#"
                        class="nav-link nav-link-icon sidenav-toggler"
                        data-action="sidenav-pin"
                        data-target="#sidenav-main"
                    ><i class="fas fa-bars"></i
                        ></a>
                </li>
                <li class="nav-item dropdown dropdown-animate">
                    <a
                        class="nav-link pr-lg-0"
                        href="#"
                        role="button"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                    <span class="avatar avatar-sm rounded-circle">
                      <img src="{{(!empty($users->avatar)? $profile.'/'.$users->avatar : $profile.'/avatar.png')}}"/>
                    </span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right dropdown-menu-arrow">
                        <h6 class="dropdown-header px-0">{{__('Hi')}}, {{\Auth::user()->name}}</h6>
                       
                            <a href="{{route('profile')}}" class="dropdown-item has-icon">
                                <i class="fa fa-user"></i> <span>{{__('My Profile')}}</span>
                            </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" class="dropdown-item">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>{{__('Logout')}}</span>
                        </a>
                            <form id="frm-logout" action="{{ route('logout') }}" method="POST" class="d-none">
                                {{ csrf_field() }}
                            </form>
                       
                    </div>
                </li>
            </ul>
        </div>

        <div class="collapse navbar-collapse navbar-collapse-fade" id="navbar-main-collapse">
            <ul class="navbar-nav align-items-center d-none d-lg-flex">
                <li class="nav-item">
                    <a
                        href="#"
                        class="nav-link nav-link-icon sidenav-toggler"
                        data-action="sidenav-pin"
                        data-target="#sidenav-main"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item dropdown dropdown-animate">
                    <a
                        class="nav-link pr-lg-0"
                        href="#"
                        role="button"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        <div class="media media-pill align-items-center">
                      <span class="avatar rounded-circle">
                        <img src="{{(!empty($users->avatar)? $profile.'/'.$users->avatar : $profile.'/avatar.png')}}"/>
                      </span>
                            <div class="ml-2 d-none d-lg-block">
                                <span class="mb-0 text-sm font-weight-bold">{{\Auth::user()->name}}</span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right dropdown-menu-arrow">
                        <h6 class="dropdown-header px-0">{{__('Hi')}}, {{\Auth::user()->name}}</h6>
                        
                            <a href="{{route('profile')}}" class="dropdown-item has-icon">
                                <i class="fa fa-user"></i> <span>{{__('My Profile')}}</span>
                            </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>{{__('Logout')}}</span>
                                <form id="frm-logout" action="{{ route('logout') }}" method="POST" class="d-none">
                                    {{ csrf_field() }}
                                </form>
                        
                        </a>
                    </div>
                </li>
              
            </ul>
            <ul class="navbar-nav ml-lg-auto align-items-lg-center">
                <li class="nav-item">
                    <div class="dropdown global-icon" data-toggle="tooltip" data-original-titla="{{__('Choose Language')}}">
                        <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-globe-europe"></i>
                        </button>
                        <div class="dropdown-menu  dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                         
                            <a class="dropdown-item" href="{{route('manage.language',[$currantLang])}}">{{ __('Create & Customize') }}</a>
                            @foreach($languages as $language)
                                <a class="dropdown-item @if($language == $currantLang) text-danger @endif" href="{{route('change.language',$language)}}">{{Str::upper($language)}}</a>
                            @endforeach
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

        <div class="container-fluid">
          <!-- Brand + Toggler (for mobile devices) -->
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-main-collapse" aria-controls="navbar-main-collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <!-- User's navbar -->
          <div class="navbar-user d-lg-none ml-auto">
            <ul class="navbar-nav flex-row align-items-center">
              <li class="nav-item">
                <a href="#" class="nav-link nav-link-icon sidenav-toggler" data-action="sidenav-pin" data-target="#sidenav-main"><i class="fas fa-bars"></i></a>
              </li>
              
              
            </ul>
          </div>
          <!-- Navbar nav -->
          <div class="collapse navbar-collapse navbar-collapse-fade" id="navbar-main-collapse">
          <ul class="navbar-nav align-items-center d-none d-lg-flex">
              <li class="nav-item">
                <a href="#" class="nav-link nav-link-icon sidenav-toggler" data-action="sidenav-pin" data-target="#sidenav-main"><i class="fas fa-bars"></i></a>
              </li>
              <li class="nav-item dropdown dropdown-animate">
                <a class="nav-link pr-lg-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <div class="media media-pill align-items-center">
                    <span class="avatar rounded-circle">
                      <img alt="Image placeholder" src="{{(!empty($users->avatar)? $profile.'/'.$users->avatar : $profile.'/avatar.png')}}">
                    </span>
                    <div class="ml-2 d-none d-lg-block">
                      <span class="mb-0 text-sm  font-weight-bold">{{\Auth::user()->name}}</span>
                    </div>
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right dropdown-menu-arrow">
                    <h6 class="dropdown-header px-0">{{__('Hi')}}, {{\Auth::user()->name}}</h6>   
                    <a href="{{route('profile')}}" class="dropdown-item has-icon">
                        <i class="fa fa-user"></i> <span>{{__('My Profile')}}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                          <i class="fas fa-sign-out-alt"></i>
                            <span>{{__('Logout')}}</span>
                                <form id="frm-logout" action="{{ route('logout') }}" method="POST" class="d-none">
                                    {{ csrf_field() }}
                                </form>
                        </a>
                    </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>