<?php $page = "login"; ?>
@extends('layout.mainlayout')
@section('content')
  <!-- Page Content -->
  <div class="content account-page" style="padding: 50px 0;">
    <div class="container-fluid">

      <div class="row">
        <div class="col-md-8 offset-md-2">

          <!-- Login Tab Content -->
          <div class="account-content">
            <div class="row align-items-center justify-content-center">
              <div class="col-md-7 col-lg-6 login-left">
                <img src="/assets/img/login-banner.png" class="img-fluid"
                     alt="{{env('APP_NAME')}} Login">
              </div>
              <div class="col-md-12 col-lg-6 login-right">
                <div class="login-header">
                  <h3>{{__('auth.Login')}} <span>{{env('APP_NAME')}}</span> @if($doctor ?? '') {{__('auth.for-doctor')}} @endif</h3>
                </div>
                @if (session()->has('message'))
                  <p class="text-danger">{{session()->get('message')}}</p>
                @endif
                <form method="POST" action="{{ route('login') }}">
                  @csrf
                  <div class="form-group form-focus">
                    <input id="email" type="email"
                           class="form-control floating @error('email') is-invalid @enderror"
                           name="email"
                           value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                    @enderror

                    <label class="focus-label">{{__('auth.email')}}</label>
                  </div>

                  <div class="form-group form-focus">
                    <input id="password" type="password"
                           class="form-control floating @error('password') is-invalid @enderror"
                           name="password" required autocomplete="current-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                    @enderror
                    <label class="focus-label">{{__('auth.password')}}</label>
                  </div>

                  <div class="form-group">
                    <input type="checkbox" id="show_pass">
                    <label for="show_pass">{{__('regular.show_password')}}</label>
                  </div>

                  <div class="status-toggle">
                    <input type="checkbox" class="check" name="remember"
                           id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember" class="checktoggle">{{__('auth.remember')}}</label>
                  </div>

                  @if (Route::has('password.request'))
                    <div class="text-right">
                      <a class="forgot-link" href="{{ route('password.request') }}">
                        {{__('auth.forgot')}}</a>
                    </div>
                  @endif

                  <button class="btn btn-primary btn-block btn-lg login-btn" type="submit">
                    {{__('auth.Login')}}
                  </button>

                  {{--
                  <div class="login-or">
                    <span class="or-line"></span>
                    <span class="span-or">{{__('auth.or')}}</span>
                  </div>
                  <div class="row form-row social-login">
                    <div class="col-6">
                      <a href="#" class="btn btn-facebook btn-block">
                        <i class="fab fa-facebook-f mr-1"></i> {{__('auth.Login')}}
                      </a>
                    </div>
                    <div class="col-6">
                      <a href="#" class="btn btn-google btn-block">
                        <i class="fab fa-google mr-1"></i> {{__('auth.Login')}}
                      </a>
                    </div>
                  </div>
                  --}}
                  <div class="text-center dont-have">{{__('auth.no_acc')}}
                    <a href="
                                        @if (isset($doctor))
                    {{route('register.doctor')}}
                    @else
                    {{route('register')}}
                    @endif">{{__('auth.Signup')}}</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- /Login Tab Content -->

        </div>
      </div>

    </div>

  </div>
  <!-- /Page Content -->
  </div>
@endsection
