<?php $page = "search1";?>
@extends('layout.mainlayout')
@section('content')
  <!-- Breadcrumb -->
  <div class="breadcrumb-bar">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-md-8 col-12">
          <nav aria-label="breadcrumb" class="page-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Doctors List</li>
            </ol>
          </nav>
          <h2 class="breadcrumb-title">Doctors List</h2>
        </div>
      </div>
    </div>
  </div>
  <!-- /Breadcrumb -->

  <!-- Page Content -->
  <div class="content">
    <div class="container">

      <div class="row">
        <div class="col-12">
        {{--<!-- Search -->
        <div class="search-box mb-2">
          <form action="{{route('search-doctor')}}" method="Get">
            <div class="form-group search-info">
              <input type="text" name="s" class="form-control" placeholder="Search for Our Doctors" value="{{$search??null}}">
              <span class="form-text">Ex : Services or Doctor Name</span>
            </div>
            <button type="submit" class="btn btn-primary search-btn"><i class="fas fa-search"></i> <span>Search</span></button>
          </form>
        </div>
        <!-- /Search -->--}}

        @foreach($doctors??[] as $user)
          <!-- Doctor Widget -->
            <div class="card">
              <div class="card-body">
                <?php
                $profile = $user->doctorProfile()->first();

                $name = \App\User::userNameFormat($user);
                ?>
                <div class="doctor-widget">
                  <div class="doc-info-left">
                    <div class="doctor-img">
                      <a href="{{route('doctor-profile', ['id'=>$user->id])}}">
                        <img
                            src="{{($profile->photo??null)!==null?Storage::url($profile->photo):'/assets/img/doctors/doctor-thumb-01.jpg'}}"
                            class="img-fluid" alt="User Image">
                      </a>
                    </div>
                    <div class="doc-info-cont">
                      <h4 class="doc-name"><a
                            href="{{route('doctor-profile', ['id'=>$user->id])}}">{{$name}}</a>
                      </h4>
                      <p class="doc-speciality">{{$profile->clinic_name??null}}</p>
                      <h5 class="doc-department">
                        @foreach(explode(',',$profile->specialist??null) as $str)
                          @if($loop->last)
                            {{$str}}
                          @else
                            {{$str.', '}}
                          @endif
                        @endforeach
                      </h5>
                      <div class="clinic-details">
                        @if($profile->clinic_address??false)
                          <p class="doc-location"><i
                                class="fas fa-map-marker-alt"></i> {{$profile->clinic_address??null}}
                          </p>
                        @endif
                        <ul class="clinic-gallery">
                          @if ($profile->clinic_pics??null)
                            @foreach(explode(',', $profile->clinic_pics) as $pic)
                              <li>
                                <a href="{{Storage::url($pic)}}" data-fancybox="gallery">
                                  <img class="avatar avatar-sm" src="{{Storage::url($pic)}}" alt="Feature">
                                </a>
                              </li>
                            @endforeach
                          @endif
                        </ul>
                      </div>
                      @if($profile->services??false)
                        <div class="clinic-services">
                          @foreach(explode(',', $profile->services??null) as $serv)
                            <span>{{$serv}}</span>
                          @endforeach
                        </div>
                      @endif
                    </div>
                  </div>
                  <div class="doc-info-right">
                    <div class="clini-infos">
                      <ul>
                        <li>
                          <i class="fas fa-map-marker-alt"></i> {{$profile->clinic_address??null}}
                        </li>
                        <li><i class="far fa-money-bill-alt"></i> {{$profile->price??null}}</li>
                        <li><i class="fa fa-phone"></i> {{$user->phone??null}}</li>
                        <li><i class="fa fa-birthday-cake"></i> {{$profile->birth??null}}</li>
                        <li><i class="far fa-user"></i>
                          @if(($profile->gender??false) == 'male')
                            Male
                          @elseif(($profile->gender??false) == 'female')
                            Female
                          @endif
                        </li>
                      </ul>
                    </div>
                    <div class="mb-2">
                      <a href="{{route('chat', ['id' => 'D'.$user->id])}}" class="btn btn-white msg-btn ">
                        <i class="far fa-comment-alt"></i>
                      </a>

                      <a href="tel:{{$user->phone??null}}" class="btn btn-white call-btn">
                        <i class="fas fa-phone"></i>
                      </a>
                    </div>
                    <div class="clinic-booking">
                      <a class="view-pro-btn"
                         href="{{route('doctor-profile', ['id'=>$user->id])}}">View Profile</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /Doctor Widget -->
          @endforeach
        </div>
      </div>

    </div>

  </div>
  <!-- /Page Content -->
  </div>
@endsection
