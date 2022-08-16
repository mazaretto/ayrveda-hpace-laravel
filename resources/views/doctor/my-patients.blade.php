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
                  aria-current="page">{{__('doctor_nav.my_patients')}}</li>
            </ol>
          </nav>
          <h2 class="breadcrumb-title">{{__('doctor_nav.my_patients')}}</h2>
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
          <div class="row row-grid">
            @if ($patients??false)
              @foreach($patients as $patient)
                <?php
                if (!$patient->email ?? true) {
                  $patient = \App\User::find($patient->user_id);
                }
                $profile = $patient->patientProfile()->first();

                $name = \App\User::userNameFormat($patient);


                if (($profile->country ?? null) !== null and ($profile->city ?? null) !== null) {
                  $location = $profile->city . ', ' . $profile->country;
                }
                ?>
                <div class="col-md-6 col-lg-4 col-xl-3">
                  <div class="card widget-profile pat-widget-profile">
                    <div class="card-body">
                      <div class="pro-widget-content">
                        <div class="profile-info-widget">
                          <a href="{{route('doctor.my-patient', ['id' => $patient->id])}}"
                             class="booking-doc-img">
                            <img
                              src="{{($profile->photo??null)!==null ? Storage::url($profile->photo) : '/assets/img/patients/patient.jpg'}}"
                              alt="User Image">
                          </a>
                          <div class="profile-det-info">
                            <h3>
                              <a href="{{route('doctor.my-patient', ['id' => $patient->id])}}">{{$name}}</a>
                            </h3>

                            <div class="patient-details">
                              <h5 class="mb-0"><i
                                  class="fas fa-map-marker-alt"></i> {{$location??trans('regular.loc_unknown')}}
                              </h5>

                              <a href="{{route('chat', ['id' => 'P'.$patient->id])}}" class="btn btn-lg btn-white msg-btn mt-2 w-100">
                                <i class="far fa-comment-alt"></i>
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="patient-info">
                        <?php
                        if ($profile->birth ?? false) {
                          $birth = date('F j Y', strtotime($profile->birth));

                          $date = new DateTime($profile->birth);
                          $now = new DateTime();
                          $interval = $now->diff($date);
                          $birth = $interval->y . ' years';
                        }
                        ?>
                        <ul>
                          <li>{{__('regular.phone')}} <span>{{$patient->phone??'Not set'}}</span></li>
                          <li>{{__('regular.age')}} <span>{{$birth??'Not set'}}, {{$profile->gender ?? 'Not set'}}</span>
                          </li>
                          <li>{{__('regular.blood-group')}} <span>{{$profile->blood_group??'Not set'}}</span>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            @endif
          </div>

        </div>
      </div>

    </div>

  </div>
  <!-- /Page Content -->
@endsection
