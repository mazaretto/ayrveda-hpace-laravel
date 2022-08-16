<?php $page = "register"; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Content -->
    <div class="content account-page" style="padding: 50px 0;">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-8 offset-md-2">

                    <!-- Register Content -->
                    <div class="account-content">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-7 col-lg-6 login-left">
                                <img src="/assets/img/login-banner.png" class="img-fluid" alt="{{env('APP_NAME')}} Register">
                            </div>
                            <div class="col-md-12 col-lg-6 login-right">
                                <div class="login-header">
                                    @if (isset($doctor))
                                        <h3>{{__('auth.doctor-register')}} <a href="{{route('register')}}">{{__('auth.patient-question')}}</a></h3>
                                    @else
                                        <h3>{{__('auth.patient-register')}} <a href="{{route('register.doctor')}}">{{__('auth.doctor-question')}}</a></h3>
                                    @endif
                                </div>

                                <!-- Register Form -->
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                    @if (isset($doctor))
                                        <input type="hidden" name="doctor" value="1">
                                    @endif
                                    <div class="form-group form-focus">
                                        <input id="name" type="text"
                                               class="form-control floating @error('name') is-invalid @enderror"
                                               name="name" value="{{ old('name') }}" required autocomplete autofocus>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                        <label class="focus-label">{{__('auth.name')}}</label>
                                    </div>

                                    <div class="form-group form-focus">
                                        <input id="email" type="email"
                                               class="form-control floating @error('email') is-invalid @enderror"
                                               name="email" value="{{ old('email') }}" required autocomplete>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                        <label class="focus-label">{{__('auth.email')}}</label>
                                    </div>

                                    <div class="form-group form-focus">
                                        <input id="phone" type="tel"
                                               class="form-control floating @error('phone') is-invalid @enderror"
                                               name="phone" value="{{ old('phone') }}" required autocomplete>

                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                        <label class="focus-label">{{__('auth.phone')}}</label>
                                    </div>

                                    <div class="form-group form-focus">
                                        <input id="password" type="password"
                                               class="form-control floating @error('password') is-invalid @enderror"
                                               name="password" required>

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                        <label class="focus-label">{{__('auth.password')}}</label>
                                    </div>

                                    <div class="form-group form-focus">
                                        <input id="password-confirm" type="password"
                                               class="form-control floating @error('password-confirm') is-invalid @enderror"
                                               name="password_confirmation" required>
                                        <label class="focus-label">{{__('auth.password_confirm')}}</label>
                                    </div>

                                    <div class="form-group">
                                        <input type="checkbox" id="show_pass">
                                        <label for="show_pass">{{__('regular.show_password')}}</label>
                                    </div>

                                    <div class="text-right">
                                        <a class="forgot-link" href="
                                        @if (isset($doctor))
                                            {{route('login.doctor')}}
                                        @else
                                            {{route('login')}}
                                        @endif">{{__('auth.acc_exist')}}</a>
                                    </div>

                                    <button class="btn btn-primary btn-block btn-lg login-btn" type="submit">{{__('auth.Signup')}}
                                    </button>
                                    {{--
                                    <div class="login-or">
                                        <span class="or-line"></span>
                                        <span class="span-or">{{__('auth.or')}}</span>
                                    </div>
                                    <div class="row form-row social-login">
                                        <div class="col-6">
                                            <a href="#" class="btn btn-facebook btn-block"><i
                                                    class="fab fa-facebook-f mr-1"></i> {{__('auth.Login')}}</a>
                                        </div>
                                        <div class="col-6">
                                            <a href="#" class="btn btn-google btn-block"><i
                                                    class="fab fa-google mr-1"></i> {{__('auth.Login')}}</a>
                                        </div>
                                    </div>
                                    --}}
                                </form>
                                <!-- /Register Form -->

                            </div>
                        </div>
                    </div>
                    <!-- /Register Content -->

                </div>
            </div>

        </div>

    </div>
    <!-- /Page Content -->
    </div>
@endsection
