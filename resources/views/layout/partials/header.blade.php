<?php error_reporting(0);?>
<!-- Loader -->
@if(Route::is(['map-grid','map-list']))
  <div id="loader">
    <div class="loader">
      <span></span>
      <span></span>
    </div>
  </div>
@endif
<!-- /Loader  -->
<div class="main-wrapper">
  <!-- Header -->
  <header class="header">
    <nav class="navbar navbar-expand-lg header-nav">
      <div class="navbar-header">
        <a id="mobile_btn" href="javascript:void(0);">
							<span class="bar-icon">
								<span></span>
								<span></span>
								<span></span>
							</span>
        </a>
        <a href="{{route('home')}}" class="navbar-brand logo">
          <img src="{{asset('logo.png')}}" alt="">
        </a>
      </div>
      <div class="main-menu-wrapper">
        <div class="menu-header">
          <a href="{{route('home')}}" class="navbar-brand logo">
            <h2>{{env('APP_NAME')}}</h2>
          </a>
          <a id="menu_close" class="menu-close" href="javascript:void(0);">
            <i class="fas fa-times"></i>
          </a>
        </div>
        <ul class="main-nav">
          <li class="buttons">
            <div class="btn-group" role="group">
              <button type="button" id="font-size-page-increase" class="btn btn-primary btn-lg">
                <i class="fas fa-search-plus"></i>
              </button>
              <button type="button" id="font-size-page-decrease" class="btn btn-primary btn-lg">
                <i class="fas fa-search-minus"></i>
              </button>
              <button type="button" id="font-size-reset" class="btn btn-primary btn-lg"><i
                  class="fas fa-font"></i></button>
            </div>
          </li>
          <li class="buttons">
            <div class="btn-group" role="group">
              <a href="{{route('locale.en')}}" class="btn btn-primary btn-lg" style="font-size: 1.25rem;">
                <img style="height: 1.25rem" src="{{asset('icons/locale/gb.png')}}" alt="">
              </a>
              <a href="{{route('locale.ru')}}" class="btn btn-primary btn-lg" style="font-size: 1.25rem;">
                <img style="height: 1.25rem" src="{{asset('icons/locale/ru.png')}}" alt="">
              </a>
            </div>
          </li>
          <li class="{{ Request::is('/') ? 'active' : '' }}">
            <a href="{{route('home')}}">{{__('header.home')}}</a>
          </li>
          <li class="{{ Request::is('doctors-list*') ? 'active' : '' }}">
            <a href="{{route('doctors-list')}}">{{__('header.doctors-list')}}</a>
          </li>
          @guest
            <li class="buttons reg-buttons">
              <a class="btn btn-primary" href="{{route('login')}}">{{__('auth.Login')}}</a>
            </li>
            <li class="buttons reg-buttons">
              <a class="btn btn-primary" href="{{route('login.doctor')}}">{{__('auth.Login-Doctor')}}</a>
            </li>
          @endguest
        </ul>
      </div>
      <ul class="nav header-navbar-rht">
        <li class="nav-item contact-item">
          <div class="header-contact-img">
            <i class="far fa-hospital"></i>
          </div>
          <div class="header-contact-detail">
            <p class="contact-header">{{__('header.contact')}}</p>
            @php($con_phone = \App\SiteSettings::where('key', 'contact_phone')->first()->value)
            <p class="contact-info-header"><a href="tel:{{$con_phone}}">{{$con_phone}}</a></p>
          </div>
        </li>
        @guest
          <li class="nav-item login-item">
            <a class="nav-link header-login client" href="{{route('login')}}">{{__('auth.Login')}}</a>
          </li>
          <li class="nav-item login-item">
            <a class="nav-link header-login stuff"
               href="{{route('login.doctor')}}">{{__('auth.Login-Doctor')}}</a>
          </li>
        @endguest
        @auth
        <!-- User Menu -->
          <?php
          $user = auth()->user();
          if ($user->hasRole('Patient')) {
            $profile = $user->patientProfile;
          } else {
            $profile = $user->doctorProfile;
          }
          $profile_name = \App\User::userNameFormat($user);
          $profile_photo = ($profile->photo ?? null) !== null ? Storage::url($profile->photo) : asset('assets/img/doctors/doctor-thumb-02.jpg');
          ?>
          @if (auth()->user()->hasRole('Doctor'))
            <li class="nav-item login-item">
              <a class="nav-link header-login" href="{{route('doctor.settings')}}">{{__('header.profile')}}</a>
            </li>
          @elseif (auth()->user()->hasRole('Patient'))
            <li class="nav-item login-item">
              <a class="nav-link header-login" href="{{route('patient.settings')}}">{{__('header.profile')}}</a>
            </li>
          @endif
          <li class="dropdown nav-item has-arrow logged-item">
            <a href="javascript:void(0)" class="dropdown-toggle nav-link" data-toggle="dropdown" aria-haspopup="true"
               aria-expanded="false">
              <span class="user-img">
                  <img class="rounded-circle"
                       src="{{$profile_photo}}"
                       width="31"
                       alt="{{$profile_name}}">
              </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="user-header">
                <div class="avatar avatar-sm">
                  <img src="{{$profile_photo??null}}" alt="User Image"
                       class="avatar-img rounded-circle">
                </div>
                <div class="user-text">

                  <h6>{{$profile_name??null}}</h6>
                  @if (auth()->user()->hasRole('Admin'))
                    <p class="text-muted mb-0">{{__('header.admin')}}</p>
                  @elseif (auth()->user()->hasRole('Seller'))
                    <p class="text-muted mb-0">{{__('header.seller')}}</p>
                  @elseif (auth()->user()->hasRole('Doctor-Main'))
                    <p class="text-muted mb-0">{{__('header.doctor-main')}}</p>
                  @elseif (auth()->user()->hasRole('Doctor'))
                    <p class="text-muted mb-0">{{__('header.doctor')}}</p>
                  @elseif (auth()->user()->hasRole('Patient'))
                    <p class="text-muted mb-0">{{__('header.patient')}}</p>
                  @endif
                </div>
              </div>
              @if (auth()->user()->hasAnyRole('Admin', 'Seller'))
                <a class="dropdown-item" href="{{route('admin.dashboard')}}" target="_blank">{{__('header.admin')}}</a>
              @endif
              @if (auth()->user()->hasRole('Doctor'))
                <a class="dropdown-item"
                   href="{{route('doctor.dashboard')}}">{{__('header.dashboard')}}</a>
              @elseif(auth()->user()->hasRole('Patient'))
                <a class="dropdown-item"
                   href="{{route('patient.dashboard')}}">{{__('header.dashboard')}}</a>
                <a class="dropdown-item" style="position: relative"
                   href="{{route('patient.cart')}}">
                  {{__('patient_nav.cart')}} <small
                    class="unread-msg cart-quantity-total">{{\App\Http\Controllers\Store\CartController::total()}}</small></a>
              @endif
              <a class="dropdown-item" href="{{route('logout')}}">{{__('auth.Logout')}}</a>
            </div>
          </li>
          <!-- /User Menu -->
        @endauth

      </ul>
    </nav>
  </header>
  <!-- /Header -->
