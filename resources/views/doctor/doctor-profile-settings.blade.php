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
                            <li class="breadcrumb-item active"
                                aria-current="page">{{__('doctor_nav.profile_settings')}}</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">{{__('doctor_nav.profile_settings')}}</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">

                    <!-- Profile Sidebar -->
                    <div class="profile-sidebar">
                        @include('doctor.regular.info')
                        @include('doctor.regular.nav')
                    </div>
                    <!-- /Profile Sidebar -->

                </div>
                <div class="col-md-7 col-lg-8 col-xl-9">
                    <form action="{{route('doctor.setProfile')}}" id="doctor-profile-form" method="Post"
                          enctype="multipart/form-data">
                    @csrf
                    <!-- Basic Information -->
                        @php($user = auth()->user())
                        @php($profile = $user->doctorProfile()->first())
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{__('forms.basic_information')}}</h4>
                                <div class="row form-row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="change-avatar">
                                                <div class="profile-img">
                                                    <img
                                                        src="{{($profile->photo??null) !== null ? Storage::url($profile->photo) : '/assets/img/doctors/doctor-thumb-02.jpg'}}"
                                                        alt="User Image">
                                                </div>
                                                <div class="upload-img">
                                                    <div class="change-photo-btn">
                                                    <span>
                                                        <i class="fa fa-upload"></i> {{__('forms.upload_photo')}}</span>
                                                        <input type="file" accept="image/*" name="photo" class="upload">
                                                        @error('photo')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <small class="form-text text-muted">Allowed JPG, GIF or PNG.</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="h5">{{__('forms.first_name')}} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="first_name" value="{{$profile->first_name??null}}"
                                                   class="form-control">
                                            @error('first_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="h5">{{__('forms.last_name')}} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="last_name" value="{{$profile->last_name??null}}"
                                                   class="form-control">
                                            @error('last_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="h5">{{__('forms.patronymic')}} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="patronymic" value="{{$profile->patronymic??null}}"
                                                   class="form-control">
                                            @error('patronymic')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="h5">{{__('forms.email')}}</label>
                                            <input type="email" class="form-control"
                                                   value="{{$user->email??null}}"
                                                   readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="h5">{{__('forms.phone')}}</label>
                                            <input type="text" value="{{$user->phone??null}}"
                                                   class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="h5">{{__('forms.gender')}}</label>
                                            <select class="form-control select" name="gender">
                                                <option>{{__('forms.select')}}</option>
                                                <option
                                                    value="male" {{($profile->gender??null) == 'male' ? 'selected' : null}}>{{__('forms.male')}}</option>
                                                <option
                                                    value="female" {{($profile->gender??null) == 'female' ? 'selected' : null}}>{{__('forms.female')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-0">
                                            <label class="h5">{{__('forms.birth_date')}}</label>
                                            <div class="cal-icon">
                                                <input type="text" name="birth" value="{{$profile->birth??null}}"
                                                       class="form-control date-picker">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Basic Information -->

                        <!-- About Me -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{__('forms.about_me')}}</h4>
                                <div class="form-group mb-0">
                                    <label class="h5">{{__('forms.biography')}}</label>
                                    <textarea class="form-control" name="biography"
                                              rows="5">{{$profile->biography??null}}</textarea>
                                </div>
                            </div>
                        </div>
                        <!-- /About Me -->

                        <!-- Clinic Info -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{__('forms.clinic_info')}}</h4>
                                <div class="row form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="h5">{{__('forms.clinic_name')}}</label>
                                            <input type="text" class="form-control" name="clinic_name"
                                                   value="{{$profile->clinic_name??null}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="h5">{{__('forms.clinic_address')}}</label>
                                            <input type="text" class="form-control" name="clinic_address"
                                                   value="{{$profile->clinic_address??null}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="h5">{{__('forms.clinic_images')}}</label>
                                            <input type="file" multiple class="form-control" name="clinic_pics[]">
                                        </div>
                                        <div class="upload-wrap">
                                            @if (($profile->clinic_pics ?? null) !== null)
                                                @foreach(explode(',', $profile->clinic_pics) as $pic)
                                                    <div class="upload-images">
                                                        <img src="{{Storage::url($pic)}}" alt="Upload Image">
                                                    </div>
                                                @endforeach
                                            @endif
                                            @if (($profile->clinic_pics??null) == null)
                                                <div class="upload-images">
                                                    <img src="/assets/img/features/feature-01.jpg" alt="Upload Image">
                                                    <a href="javascript:void(0);"
                                                       class="btn btn-icon btn-danger btn-sm"><i
                                                            class="far fa-trash-alt"></i></a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Clinic Info -->

                        <!-- Contact Details -->
                        <div class="card contact-card">
                            <div class="card-body">
                                <h4 class="card-title">{{__('forms.contact-details')}}</h4>
                                <div class="row form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">{{__('forms.country')}}</label>
                                            <input type="text" class="form-control" name="country"
                                                   value="{{$profile->country??null}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">{{__('forms.state')}}</label>
                                            <input type="text" class="form-control" name="state"
                                                   value="{{$profile->state??null}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">{{__('forms.city')}}</label>
                                            <input type="text" class="form-control" name="city"
                                                   value="{{$profile->city??null}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="h5">{{__('forms.address')}}</label>
                                            <input type="text" class="form-control" name="address"
                                                   value="{{$profile->address??null}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">{{__('forms.postal-code')}}</label>
                                            <input type="text" class="form-control" name="zip_code"
                                                   value="{{$profile->zip_code??null}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Contact Details -->

                        <!-- Pricing -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{__('forms.pricing')}}</h4>

                                <div class="row custom_price_cont" id="custom_price_cont">
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" id="custom_rating_input"
                                               name="price" value="{{$profile->price??null}}" placeholder="20 USD">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- /Pricing -->

                        <!-- Services and Specialization -->
                        <div class="card services-card">
                            <div class="card-body">
                                <h4 class="card-title">{{__('forms.services-specialization')}}</h4>
                                <div class="form-group">
                                    <label class="h5">{{__('forms.services')}}</label>
                                    <input type="text" data-role="tagsinput" class="input-tags form-control"
                                           placeholder="" name="services"
                                           value="{{$profile->services??null}}"
                                           id="services">
                                    <small class="form-text text-muted">{{__('forms.services-note')}}</small>
                                </div>
                                <div class="form-group mb-0">
                                    <label class="h5">{{__('forms.specialization')}}</label>
                                    <input class="input-tags form-control" type="text" data-role="tagsinput"
                                           placeholder="" name="specialist"
                                           value="{{$profile->specialist??null}}" id="specialist">
                                    <small class="form-text text-muted">{{__('forms.specialization-note')}}</small>
                                </div>
                            </div>
                        </div>
                        <!-- /Services and Specialization -->

                        <!-- Education -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{__('forms.education')}}</h4>
                                <div class="education-info">
                                    @if (($profile->education??null) !== null)
                                        @foreach(unserialize($profile->education) as $education)
                                            <div class="row form-row education-cont">
                                                <div class="col-12 col-md-10 col-lg-11">
                                                    <div class="row form-row">
                                                        <div class="col-12 col-md-6 col-lg-4">
                                                            <div class="form-group">
                                                                <label class="h5">{{__('forms.education-degree')}}</label>
                                                                <input type="text" class="form-control"
                                                                       value="{{$education[0]}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6 col-lg-4">
                                                            <div class="form-group">
                                                                <label class="h5">{{__('forms.education-college')}}</label>
                                                                <input type="text" class="form-control"
                                                                       value="{{$education[1]}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6 col-lg-4">
                                                            <div class="form-group">
                                                                <label class="h5">{{__('forms.education-year')}}</label>
                                                                <div class="cal-icon">
                                                                    <input type="text" class="form-control"
                                                                           value="{{$education[2]}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-2 col-lg-1">
                                                    <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                                    <a href="#" class="btn btn-danger trash">
                                                        <i class="far fa-trash-alt"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="row form-row education-cont" style="display: none" id="education-blank">
                                    <div class="col-12 col-md-10 col-lg-11">
                                        <div class="row form-row">
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label class="h5">{{__('forms.education-degree')}}</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label class="h5">{{__('forms.education-college')}}</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label class="h5">{{__('forms.education-year')}}</label>
                                                    <div class="cal-icon">
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2 col-lg-1">
                                        <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                        <a href="#" class="btn btn-danger trash">
                                            <i class="far fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="add-more">
                                    <a href="javascript:void(0);" class="add-education"><i
                                            class="fa fa-plus-circle"></i> {{__('forms.add-more')}}</a>
                                </div>
                            </div>
                        </div>
                        <!-- /Education -->

                        <!-- Experience -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{__('forms.experience')}}</h4>
                                <div class="experience-info">
                                    @if (($profile->experience??null) !== null)
                                        @foreach(unserialize($profile->experience) as $experience)
                                            <div class="row form-row experience-cont">
                                                <div class="col-12 col-md-10 col-lg-11">
                                                    <div class="row form-row">
                                                        <div class="col-12 col-md-6 col-lg-4">
                                                            <div class="form-group">
                                                                <label class="h5">{{__('forms.experience-hospital-name')}}</label>
                                                                <input type="text" class="form-control"
                                                                       value="{{$experience[0]}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6 col-lg-4">
                                                            <div class="form-group">
                                                                <label class="h5">{{__('forms.experience-from')}}</label>
                                                                <div class="cal-icon">
                                                                    <input type="text" class="form-control"
                                                                           value="{{$experience[1]}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6 col-lg-4">
                                                            <div class="form-group">
                                                                <label class="h5">{{__('forms.experience-to')}}</label>
                                                                <div class="cal-icon">
                                                                    <input type="text" class="form-control"
                                                                           value="{{$experience[2]}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6 col-lg-4">
                                                            <div class="form-group">
                                                                <label class="h5">{{__('forms.experience-designation')}}</label>
                                                                <input type="text" class="form-control"
                                                                       value="{{$experience[3]}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-2 col-lg-1">
                                                    <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                                    <a href="#" class="btn btn-danger trash">
                                                        <i class="far fa-trash-alt"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="row form-row experience-cont" style="display: none" id="experience-blank">
                                    <div class="col-12 col-md-10 col-lg-11">
                                        <div class="row form-row">
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label class="h5">{{__('forms.experience-hospital-name')}}</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label class="h5">{{__('forms.experience-from')}}</label>
                                                    <div class="cal-icon">
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label class="h5">{{__('forms.experience-to')}}</label>
                                                    <div class="cal-icon">
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label class="h5">{{__('forms.experience-designation')}}</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2 col-lg-1">
                                        <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                        <a href="#" class="btn btn-danger trash">
                                            <i class="far fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="add-more">
                                    <a href="javascript:void(0);" class="add-experience"><i
                                            class="fa fa-plus-circle"></i> {{__('forms.add-more')}}</a>
                                </div>
                            </div>
                        </div>
                        <!-- /Experience -->

                        <!-- Awards -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{__('forms.awards')}}</h4>
                                <div class="awards-info">
                                    @if (($profile->awards??null) !== null)
                                        @foreach(unserialize($profile->awards) as $awards)
                                            <div class="row form-row awards-cont">
                                                <div class="col-12 col-md-5">
                                                    <div class="form-group">
                                                        <label class="h5">{{__('forms.awards-award')}}</label>
                                                        <input type="text" class="form-control"
                                                               value="{{$awards[0]}}">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-5">
                                                    <div class="form-group">
                                                        <label class="h5">{{__('forms.awards-year')}}</label>
                                                        <div class="cal-icon">
                                                            <input type="text" class="form-control"
                                                                   value="{{$awards[1]}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-2">
                                                    <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                                    <a href="#" class="btn btn-danger trash">
                                                        <i class="far fa-trash-alt"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="row form-row awards-cont" style="display: none;" id="awards-blank">
                                    <div class="col-12 col-md-5">
                                        <div class="form-group">
                                            <label class="h5">{{__('forms.awards-award')}}</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-5">
                                        <div class="form-group">
                                            <label class="h5">{{__('forms.awards-year')}}</label>
                                            <div class="cal-icon">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                        <a href="#" class="btn btn-danger trash">
                                            <i class="far fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="add-more">
                                    <a href="javascript:void(0);" class="add-award"><i class="fa fa-plus-circle"></i> {{__('forms.add-more')}}</a>
                                </div>
                            </div>
                        </div>
                        <!-- /Awards -->

                        <!-- Memberships -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{__('forms.memberships')}}</h4>
                                <div class="membership-info">
                                    @if (($profile->membership??null) !== null)
                                        @foreach(unserialize($profile->membership) as $membership)
                                            <div class="row form-row membership-cont">
                                                <div class="col-12 col-md-10 col-lg-5">
                                                    <div class="form-group">
                                                        <label class="h5">{{__('forms.memberships-membership')}}</label>
                                                        <input type="text" class="form-control"
                                                               value="{{$membership[0]}}">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-2 col-lg-2">
                                                    <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                                    <a href="#" class="btn btn-danger trash">
                                                        <i class="far fa-trash-alt"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="row form-row membership-cont" style="display: none" id="memberships-blank">
                                    <div class="col-12 col-md-10 col-lg-5">
                                        <div class="form-group">
                                            <label class="h5">{{__('forms.memberships-membership')}}</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2 col-lg-2">
                                        <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                        <a href="#" class="btn btn-danger trash">
                                            <i class="far fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="add-more">
                                    <a href="javascript:void(0);" class="add-membership"><i
                                            class="fa fa-plus-circle"></i> {{__('forms.add-more')}}</a>
                                </div>
                            </div>
                        </div>
                        <!-- /Memberships -->

                        <!-- Registrations -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{__('forms.registrations')}}</h4>
                                <div class="registrations-info">
                                    @if (($profile->registrations??null) !== null)
                                        @foreach(unserialize($profile->registrations) as $registrations)
                                            <div class="row form-row reg-cont">
                                                <div class="col-12 col-md-5">
                                                    <div class="form-group">
                                                        <label class="h5">{{__('forms.registration-reg')}}</label>
                                                        <input type="text" class="form-control"
                                                               value="{{$registrations[0]}}">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-5">
                                                    <div class="form-group">
                                                        <label class="h5">{{__('forms.registration-year')}}</label>
                                                        <div class="cal-icon">
                                                            <input type="text" class="form-control"
                                                                   value="{{$registrations[1]}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-2">
                                                    <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                                    <a href="#" class="btn btn-danger trash">
                                                        <i class="far fa-trash-alt"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="row form-row reg-cont" style="display: none" id="reg-blank">
                                    <div class="col-12 col-md-5">
                                        <div class="form-group">
                                            <label class="h5">{{__('forms.registration-reg')}}</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-5">
                                        <div class="form-group">
                                            <label class="h5">{{__('forms.registration-year')}}</label>
                                            <div class="cal-icon">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                        <a href="#" class="btn btn-danger trash">
                                            <i class="far fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="add-more">
                                    <a href="javascript:void(0);" class="add-reg"><i class="fa fa-plus-circle"></i> {{__('forms.add-more')}}</a>
                                </div>
                            </div>
                        </div>
                        <!-- /Registrations -->

                        <div class="submit-section submit-btn-bottom">
                            <button type="submit" class="btn btn-primary submit-btn">{{__('forms.save-changes')}}</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>
    <!-- /Page Content -->
    <script>
        document.getElementById('doctor-profile-form').addEventListener('submit', function (event) {
            education(event)
            experience(event)
            awards(event)
            memberships(event)
            registrations(event)
        })

        function education(event) {
            let education_list = event.target.getElementsByClassName('education-cont')
            let education = []
            for (let item of education_list) {
                let education_temp = []
                for (let inner of item.getElementsByTagName('input')) {
                    education_temp.push(inner.value)
                }
                education.push(education_temp)
            }
            education.forEach(function (item) {
                let input = document.createElement('input')
                input.setAttribute('type', 'hidden')
                input.setAttribute('name', 'education[]')
                input.setAttribute('value', item.join(';,-;'))
                event.target.appendChild(input)
            })
        }

        function experience(event) {
            let experience_list = event.target.getElementsByClassName('experience-cont')
            let experience = []
            for (let item of experience_list) {
                let experience_temp = []
                for (let inner of item.getElementsByTagName('input')) {
                    experience_temp.push(inner.value)
                }
                experience.push(experience_temp)
            }
            experience.forEach(function (item) {
                let input = document.createElement('input')
                input.setAttribute('type', 'hidden')
                input.setAttribute('name', 'experience[]')
                input.setAttribute('value', item.join(';,-;'))
                event.target.appendChild(input)
            })
        }

        function awards(event) {
            let awards_list = event.target.getElementsByClassName('awards-cont')
            let awards = []
            for (let item of awards_list) {
                let awards_temp = []
                for (let inner of item.getElementsByTagName('input')) {
                    awards_temp.push(inner.value)
                }
                awards.push(awards_temp)
            }
            awards.forEach(function (item) {
                let input = document.createElement('input')
                input.setAttribute('type', 'hidden')
                input.setAttribute('name', 'awards[]')
                input.setAttribute('value', item.join(';,-;'))
                event.target.appendChild(input)
            })
        }

        function memberships(event) {
            let memberships_list = event.target.getElementsByClassName('membership-cont')
            let memberships = []
            for (let item of memberships_list) {
                let memberships_temp = []
                for (let inner of item.getElementsByTagName('input')) {
                    memberships_temp.push(inner.value)
                }
                memberships.push(memberships_temp)
            }
            memberships.forEach(function (item) {
                let input = document.createElement('input')
                input.setAttribute('type', 'hidden')
                input.setAttribute('name', 'membership[]')
                input.setAttribute('value', item.join(';,-;'))
                event.target.appendChild(input)
            })
        }

        function registrations(event) {
            let registrations_list = event.target.getElementsByClassName('reg-cont')
            let registrations = []
            for (let item of registrations_list) {
                let registrations_temp = []
                for (let inner of item.getElementsByTagName('input')) {
                    registrations_temp.push(inner.value)
                }
                registrations.push(registrations_temp)
            }
            registrations.forEach(function (item) {
                let input = document.createElement('input')
                input.setAttribute('type', 'hidden')
                input.setAttribute('name', 'registrations[]')
                input.setAttribute('value', item.join(';,-;'))
                event.target.appendChild(input)
            })
        }
    </script>
@endsection
