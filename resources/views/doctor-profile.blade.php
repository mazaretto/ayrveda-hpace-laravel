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
              <li class="breadcrumb-item"><a
                  href="{{route('doctors-list')}}">{{__('header.doctors-list')}}</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{__('header.doctors-profile')}}</li>
            </ol>
          </nav>
          <h2 class="breadcrumb-title">{{__('header.doctors-profile')}}</h2>
        </div>
      </div>
    </div>
  </div>
  <!-- /Breadcrumb -->

  <!-- Page Content -->
  <div class="content">
    <div class="container">
    <?php
    $profile = $user->doctorProfile()->first();

    $name = \App\User::userNameFormat($user);

    ?>

    <!-- Doctor Widget -->
      <div class="card">
        <div class="card-body">
          <div class="doctor-widget">
            <div class="doc-info-left">
              <div class="doctor-img">
                <img
                  src="{{($profile->photo??false)?Storage::url($profile->photo):'/assets/img/doctors/doctor-thumb-02.jpg'}}"
                  class="img-fluid" alt="User Image">
              </div>
              <div class="doc-info-cont">
                <h4 class="doc-name">{{$name}}</h4>
                <p class="doc-speciality">{{$profile->clinic_name??null}}</p>
                <p class="doc-department">
                  @foreach(explode(',',$profile->specialist??null) as $str)
                    @if($loop->last)
                      {{$str}}
                    @else
                      {{$str.', '}}
                    @endif
                  @endforeach
                </p>
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
                          <a href="{{Storage::url($pic)}}"
                             data-fancybox="gallery">
                            <img src="{{Storage::url($pic)}}" alt="Feature">
                          </a>
                        </li>
                      @endforeach
                    @endif
                  </ul>
                </div>
                <div class="clinic-services">
                  @if($profile->services??false)
                    @foreach(explode(',', $profile->services??null) as $serv)
                      <span>{{$serv}}</span>
                    @endforeach
                  @endif
                </div>

                {{--
                <div class="mt-3">
                  <a href="{{route('chat', ['id' => 'D'.$user->id])}}" class="btn btn-lg btn-white msg-btn ">
                    <i class="far fa-comment-alt"></i>
                  </a>
                </div>
                --}}
              </div>
            </div>
            <div class="doc-info-right">
              <div class="clini-infos">
                <ul>
                  <li><i class="fas fa-map-marker-alt"></i> {{$profile->clinic_address??null}}</li>
                  <li><i class="fa fa-phone"></i> {{$user->phone??null}}</li>
                  <li><i class="fa fa-birthday-cake"></i> {{$profile->birth??null}}</li>

                  {{--
                  <li><i class="far fa-money-bill-alt"></i> {{$profile->price??null}}</li>
                  <li><i class="far fa-user"></i>
                    @if(($profile->gender??false) == 'male')
                      Male
                    @elseif(($profile->gender??false) == 'female')
                      Female
                    @endif
                  </li>
                  --}}
                </ul>
              </div>

              {{--
              <div class="doctor-action">
                <a href="tel:{{$user->phone??null}}" class="btn btn-white call-btn">
                  <i class="fas fa-phone"></i>
                </a>
              </div>
              --}}
            </div>
          </div>
        </div>
      </div>
      <!-- /Doctor Widget -->

      <!-- Doctor Details Tab -->
      <div class="card">
        <div class="card-body pt-0">

          <!-- Tab Menu -->
          <nav class="user-tabs mb-4">
            <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
              <li class="nav-item">
                <a class="nav-link active" href="#doc_overview"
                   data-toggle="tab">{{__('regular.overview')}}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#doc_education"
                   data-toggle="tab">{{__('regular.education-awards')}}</a>
              </li>
            </ul>
          </nav>
          <!-- /Tab Menu -->

          <!-- Tab Content -->
          <div class="tab-content pt-0">

            <!-- Overview Content -->
            <div role="tabpanel" id="doc_overview" class="tab-pane fade show active">
              <div class="row">
                <div class="col-md-12 col-lg-9">

                  <!-- About Details -->
                  <div class="widget about-widget">
                    <h4 class="widget-title">{{__('forms.about_me')}}</h4>
                    <p>{{$profile->biography??null}}</p>
                  </div>
                  <!-- /About Details -->

                  <!-- Social List -->
                  <div class="service-list">
                    <h4>{{__('regular.socials')}}</h4>
                    <?php
                    $soc = $user->social()->first();
                    ?>
                    <ul class="clearfix social">
                      @if($soc->facebook??false)
                        <li><a href="{{$soc->facebook}}" target="_blank"><i
                              class="fab fa-facebook"></i></a></li>
                      @endif
                      @if($soc->twitter??false)
                        <li><a href="{{$soc->twitter}}" target="_blank"><i
                              class="fab fa-twitter"></i></a></li>
                      @endif
                      @if($soc->instagram??false)
                        <li><a href="{{$soc->instagram}}" target="_blank"><i
                              class="fab fa-instagram"></i></a></li>
                      @endif
                      @if($soc->pinterest??false)
                        <li><a href="{{$soc->pinterest}}" target="_blank"><i
                              class="fab fa-pinterest"></i></a></li>
                      @endif
                      @if($soc->linkedin??false)
                        <li><a href="{{$soc->linkedin}}" target="_blank"><i
                              class="fab fa-linkedin"></i></a></li>
                      @endif
                      @if($soc->youtube??false)
                        <li><a href="{{$soc->youtube}}" target="_blank"><i
                              class="fab fa-youtube"></i></a></li>
                      @endif
                    </ul>
                  </div>
                  <!-- /Social List -->

                  <!-- Experience Details -->
                  <div class="widget experience-widget">
                    <h4 class="widget-title">{{__('regular.work-experience')}}</h4>
                    <div class="experience-box">
                      <ul class="experience-list">
                        <?php
                        $exp = unserialize($profile->experience ?? null);
                        ?>
                        @if($exp)
                          @for($i=count($exp)-1;$i>=0;$i--)
                            <li>
                              <div class="experience-user">
                                <div class="before-circle"></div>
                              </div>
                              <div class="experience-content">
                                <div class="timeline-content">
                                  <a href="javascript:void(0)"
                                     class="name">{{$exp[$i][0]}} ({{$exp[$i][3]}}
                                    )</a>
                                  <span
                                    class="time">{{$exp[$i][1]}} - {{$exp[$i][2]}}</span>
                                </div>
                              </div>
                            </li>
                          @endfor
                        @endif
                      </ul>
                    </div>
                  </div>
                  <!-- /Experience Details -->

                  <!-- Services List -->
                  <div class="service-list">
                    <h4>{{__('forms.services')}}</h4>
                    <ul class="clearfix">
                      @foreach(explode(',', $profile->services??null) as $serv)
                        <li>{{$serv}}</li>
                      @endforeach
                    </ul>
                  </div>
                  <!-- /Services List -->

                  <!-- Specializations List -->
                  <div class="service-list">
                    <h4>{{__('forms.specialization')}}</h4>
                    <ul class="clearfix">
                      @foreach(explode(',', $profile->specialist??null) as $spec)
                        <li>{{$spec}}</li>
                      @endforeach
                    </ul>
                  </div>
                  <!-- /Specializations List -->

                </div>
              </div>
            </div>
            <!-- /Overview Content -->

            <!-- Education Content -->
            <div role="tabpanel" id="doc_education" class="tab-pane fade">
              <div class="row">
                <div class="col-md-12 col-lg-9">
                  <!-- Education Details -->
                  <div class="widget education-widget">
                    <h4 class="widget-title">{{__('forms.education')}}</h4>
                    <div class="experience-box">
                      <ul class="experience-list">
                        <?php
                        $educ = unserialize($profile->education ?? null);
                        ?>
                        @if($educ)
                          @foreach($educ as $row)
                            <li>
                              <div class="experience-user">
                                <div class="before-circle"></div>
                              </div>
                              <div class="experience-content">
                                <div class="timeline-content">
                                  <a href="javascript:void(0)"
                                     class="name">{{$row[0]}} - {{$row[1]}}
                                    <span class="time">{{$row[2]}}</span>
                                </div>
                              </div>
                            </li>
                          @endforeach
                        @endif
                      </ul>
                    </div>
                  </div>
                  <!-- /Education Details -->

                  <!-- Awards Details -->
                  <div class="widget awards-widget">
                    <h4 class="widget-title">{{__('forms.awards')}}</h4>
                    <div class="experience-box">
                      <ul class="experience-list">
                        <?php
                        $awar = unserialize($profile->awards ?? null);
                        ?>
                        @if($awar)
                          @foreach($awar as $row)
                            <li>
                              <div class="experience-user">
                                <div class="before-circle"></div>
                              </div>
                              <div class="experience-content">
                                <div class="timeline-content">
                                  <p class="exp-year">{{$row[1]}}</p>
                                  <h4 class="exp-title">{{$row[0]}}</h4>
                                </div>
                              </div>
                            </li>
                          @endforeach
                        @endif
                      </ul>
                    </div>
                  </div>
                  <!-- /Awards Details -->

                  <!-- Memberships Details -->
                  <div class="widget awards-widget">
                    <h4 class="widget-title">{{__('forms.memberships')}}</h4>
                    <div class="experience-box">
                      <ul class="experience-list">
                        <?php
                        $mem = unserialize($profile->membership ?? null);
                        ?>
                        @if($mem)
                          @foreach($mem as $row)
                            <li>
                              <div class="experience-user">
                                <div class="before-circle"></div>
                              </div>
                              <div class="experience-content">
                                <div class="timeline-content">
                                  <h4 class="exp-title">{{$row[0]}}</h4>
                                </div>
                              </div>
                            </li>
                          @endforeach
                        @endif
                      </ul>
                    </div>
                  </div>
                  <!-- /Memberships Details -->

                  <!-- Registrations Details -->
                  <div class="widget awards-widget">
                    <h4 class="widget-title">{{__('forms.registrations')}}</h4>
                    <div class="experience-box">
                      <ul class="experience-list">
                        <?php
                        $reg = unserialize($profile->registrations ?? null);
                        ?>
                        @if($reg)
                          @foreach($reg as $row)
                            <li>
                              <div class="experience-user">
                                <div class="before-circle"></div>
                              </div>
                              <div class="experience-content">
                                <div class="timeline-content">
                                  <p class="exp-year">{{$row[1]}}</p>
                                  <h4 class="exp-title">{{$row[0]}}</h4>
                                </div>
                              </div>
                            </li>
                          @endforeach
                        @endif
                      </ul>
                    </div>
                  </div>
                  <!-- /Registrations Details -->
                </div>
              </div>
            </div>
            <!-- /Education Content -->
          </div>
        </div>
      </div>
      <!-- /Doctor Details Tab -->

    </div>
  </div>
  <!-- /Page Content -->
  </div>
@endsection
