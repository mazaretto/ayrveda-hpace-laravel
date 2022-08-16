@extends('layout.mainlayout')
@section('content')
    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('header.home')}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{__('patient_nav.profile_settings')}}</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">{{__('patient_nav.profile_settings')}}</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <!-- Profile Sidebar -->
                <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
                    <div class="profile-sidebar">
                        @include('patient.regular.profile-info')
                        @include('patient.regular.nav')
                    </div>
                </div>
                <!-- / Profile Sidebar -->

                <div class="col-md-7 col-lg-8 col-xl-9">
                    <div class="card">
                        <div class="card-body">

                            <!-- Profile Settings Form -->
                            <form action="{{route('patient.setProfile')}}" method="Post" enctype="multipart/form-data">
                                @csrf
                                <div class="row form-row">
                                    <div class="col-12 col-md-12">
                                        <div class="form-group">
                                            <div class="change-avatar">
                                                <div class="profile-img">
                                                    <img src="{{(isset($user->photo))?Storage::url($user->photo):'/assets/img/patients/patient.jpg'}}" alt="User Image">
                                                </div>
                                                <div class="upload-img">
                                                    <div class="change-photo-btn">
                                                        <span><i class="fa fa-upload"></i> {{__('forms.upload_photo')}}</span>
                                                        <input type="file" accept="image/*" name="photo" class="upload @error('photo') is-invalid @enderror">

                                                        @error('photo')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <small class="form-text text-muted">Allowed JPG, GIF or PNG.</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>{{__('forms.first_name')}}</label>
                                            <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror"
                                                   value="{{(isset($user->first_name))?$user->first_name:old('first_name')}}">
                                            @error('first_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>{{__('forms.last_name')}}</label>
                                            <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror"
                                                   value="{{(isset($user->last_name))?$user->last_name:old('last_name')}}">
                                            @error('last_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>{{__('forms.patronymic')}}</label>
                                            <input type="text" name="patronymic" class="form-control @error('patronymic') is-invalid @enderror"
                                                   value="{{(isset($user->patronymic))?$user->patronymic:old('patronymic')}}">
                                            @error('patronymic')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>{{__('forms.birth_date')}}</label>
                                            <div class="cal-icon">
                                                <input type="text" class="form-control date-picker @error('birth') is-invalid @enderror" name="birth"
                                                       value="{{$user->birth ?? old('birth')}}">
                                                @error('birth')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-break"></div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>{{__('forms.blood-group')}}</label>
                                            <select class="form-control select @error('blood_group') is-invalid @enderror" name="blood_group">
                                                <option>{{__('forms.select')}}</option>
                                                <option value="A-" {{(($user->blood_group ?? null) == 'A-') ? 'selected' : null}}>A-</option>
                                                <option value="A+" {{(($user->blood_group ?? null) == 'A+') ? 'selected' : null}}>A+</option>
                                                <option value="B-" {{(($user->blood_group ?? null) == 'B-') ? 'selected' : null}}>B-</option>
                                                <option value="B+" {{(($user->blood_group ?? null) == 'B+') ? 'selected' : null}}>B+</option>
                                                <option value="AB-" {{(($user->blood_group ?? null) == 'AB-') ? 'selected' : null}}>AB-</option>
                                                <option value="AB+" {{(($user->blood_group ?? null) == 'AB+') ? 'selected' : null}}>AB+</option>
                                                <option value="O-" {{(($user->blood_group ?? null) == 'O-') ? 'selected' : null}}>O-</option>
                                                <option value="O+" {{(($user->blood_group ?? null) == 'O+') ? 'selected' : null}}>O+</option>
                                            </select>
                                            @error('blood_group')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>{{__('forms.gender')}}</label>
                                            <select class="form-control select @error('blood_group') is-invalid @enderror" name="gender">
                                                <option>{{__('forms.select')}}</option>
                                                <option value="male" {{(($user->gender ?? null) == 'male') ? 'selected' : null}}>{{__('forms.male')}}</option>
                                                <option value="female" {{(($user->gender ?? null) == 'female') ? 'selected' : null}}>{{__('forms.female')}}</option>
                                            </select>
                                            @error('blood_group')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="flex-break"></div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>{{__('forms.phone')}}</label>
                                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                                value="{{auth()->user()->phone??null}}" readonly>

                                            @error('phone')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="flex-break"></div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>{{__('forms.country')}}</label>
                                            <input type="text" name="country" class="form-control @error('country') is-invalid @enderror"
                                                   value="{{(isset($user->country))?$user->country:old('country')}}">

                                            @error('country')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>{{__('forms.state')}}</label>
                                            <input type="text" name="state" class="form-control @error('state') is-invalid @enderror"
                                                   value="{{(isset($user->state))?$user->state:old('state')}}">

                                            @error('state')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>{{__('forms.city')}}</label>
                                            <input type="text" name="city" class="form-control @error('city') is-invalid @enderror"
                                                   value="{{(isset($user->city))?$user->city:old('city')}}">

                                            @error('city')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>{{__('forms.postal-code')}}</label>
                                            <input type="text" name="zip_code" class="form-control @error('zip_code') is-invalid @enderror"
                                                   value="{{(isset($user->zip_code))?$user->zip_code:old('zip_code')}}">

                                            @error('zip_code')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>{{__('forms.address')}}</label>
                                            <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
                                                   value="{{(isset($user->address))?$user->address:old('address')}}">

                                            @error('address')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="submit-section">
                                    <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                                </div>
                            </form>
                            <!-- /Profile Settings Form -->

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /Page Content -->
    </div>
@endsection
