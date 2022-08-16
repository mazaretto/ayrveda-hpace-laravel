@extends('layout.mainlayout')

@section('head-data')
  <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
  {{--
  <!-- Home Banner -->
  <section class="section section-search">
    <div class="container-fluid">
      <div class="banner-wrapper">
        <div class="banner-header text-center">
          <h1>Ayurveda</h1>
          <p>Clinic with doctors and prescriptions only for your Health.</p>
        </div>

        <!-- Search -->
        <div class="search-box">
          <form action="{{route('search-doctor')}}" method="Get">
            <div class="form-group search-info">
              <input type="text" name="s" class="form-control" placeholder="Search for Our Doctors">
              <span class="form-text">Ex : Services or Doctor Name</span>
            </div>
            <button type="submit" class="btn btn-primary search-btn"><i class="fas fa-search"></i> <span>Search</span></button>
          </form>
        </div>
        <!-- /Search -->
      </div>
    </div>
  </section>
  <!-- /Home Banner -->--}}

  {{--<!-- Clinic and Specialities -->
  <section class="section section-specialities">
      <div class="container-fluid">
          <div class="section-header text-center">
              <h2>Clinic and Specialities</h2>
              <p class="sub-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                  incididunt ut labore et dolore magna aliqua.</p>
          </div>
          <div class="row justify-content-center">
              <div class="col-md-9">
                  <!-- Slider -->
                  <div class="specialities-slider slider">

                      <!-- Slider Item -->
                      <div class="speicality-item text-center">
                          <div class="speicality-img">
                              <img src="/assets/img/specialities/specialities-01.png" class="img-fluid"
                                   alt="Speciality">
                              <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                          </div>
                          <p>Urology</p>
                      </div>
                      <!-- /Slider Item -->

                      <!-- Slider Item -->
                      <div class="speicality-item text-center">
                          <div class="speicality-img">
                              <img src="/assets/img/specialities/specialities-02.png" class="img-fluid"
                                   alt="Speciality">
                              <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                          </div>
                          <p>Neurology</p>
                      </div>
                      <!-- /Slider Item -->

                      <!-- Slider Item -->
                      <div class="speicality-item text-center">
                          <div class="speicality-img">
                              <img src="/assets/img/specialities/specialities-03.png" class="img-fluid"
                                   alt="Speciality">
                              <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                          </div>
                          <p>Orthopedic</p>
                      </div>
                      <!-- /Slider Item -->

                      <!-- Slider Item -->
                      <div class="speicality-item text-center">
                          <div class="speicality-img">
                              <img src="/assets/img/specialities/specialities-04.png" class="img-fluid"
                                   alt="Speciality">
                              <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                          </div>
                          <p>Cardiologist</p>
                      </div>
                      <!-- /Slider Item -->

                      <!-- Slider Item -->
                      <div class="speicality-item text-center">
                          <div class="speicality-img">
                              <img src="/assets/img/specialities/specialities-05.png" class="img-fluid"
                                   alt="Speciality">
                              <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                          </div>
                          <p>Dentist</p>
                      </div>
                      <!-- /Slider Item -->

                  </div>
                  <!-- /Slider -->

              </div>
          </div>
      </div>
  </section>
  <!-- Clinic and Specialities -->--}}

  <!-- Medicine Features -->
  <section class="section section-features pt-0">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 mb-4 mt-4">
          <div class="section-header">
            <a class="btn btn-primary" href="{{route('store')}}">{{__('regular.go_to_store')}}</a>

            <h2>{{__('regular.land_header')}}</h2>
          </div>
          <div class="features-slider slider">
            <!-- Slider Items -->
            {{--<div class="feature-item text-center">
                <a href="{{route('store.medicine', ['id' => $medicine->id])}}">
                  <img src="{{Storage::url($medicine->image??'')}}" class="img-fluid" alt="Feature">
                  <p>{{$medicine->name}}</p>
                  <span>{{$medicine->price}}</span>
                </a>
              </div>--}}
            @foreach(\App\MedicineList::limit(50)->get() as $medicine)
              <div class="profile-widget">
                <div class="doc-img">
                  <a href="{{route('store.medicine', ['id' => $medicine->id])}}">
                    <img class="img-fluid" alt="User Image" src="{{Storage::url($medicine->image??'')}}">
                  </a>
                </div>
                <div class="pro-content">
                  <h3 class="title">
                    <a href="{{route('store.medicine', ['id' => $medicine->id])}}">{{$medicine->name??null}}</a>
                    <i class="fas fa-check-circle verified"></i>
                  </h3>
                  <ul class="available-info">
                    <li>
                      <p class="card-text">
                        @if(strlen($medicine->description) < 100)
                          {{$medicine->description}}
                        @else
                          {{mb_substr($medicine->description, 0,100).'...'}}
                        @endif
                      </p>
                    </li>
                    <li>
                      <i class="far fa-money-bill-alt"></i> {{$medicine->price}}$
                    </li>
                  </ul>
                  <div class="row row-sm">
                    <div class="col-6">
                      <a href="{{route('store.medicine', ['id' => $medicine->id])}}"
                         class="btn view-btn">{{__('regular.view_more')}}</a>
                    </div>
                    @auth
                      @if(auth()->user()->hasrole('Patient'))
                        <div class="col-6">
                          <form action="{{route('cart.add')}}" method="Post">
                            @csrf
                            <input type="hidden" name="type" value="medicine">
                            <input type="hidden" name="id" value="{{$medicine->id}}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn view-btn"><i
                                class="fas fa-cart-plus"></i></button>
                          </form>
                        </div>
                      @endif
                    @endauth
                  </div>
                </div>
              </div>
          @endforeach
          <!-- /Slider Items -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /Medicine Features -->

  <!-- Our Doctors Section -->
  <section class="section section-doctor">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-4">
          <div class="section-header ">
            <h2>{{__('regular.all_our_doctors')}}</h2>
          </div>
          <div class="about-content">
            <a href="{{route('doctors-list')}}">{{__('regular.view_more')}}...</a>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="doctor-slider slider">
            <!-- Doctor Widgets -->
            @php($doctors = \App\User::role('Doctor')->where('active', true)->get())
            @foreach($doctors as $doctor)
              <?php
              $doc_profile = $doctor->doctorProfile()->first();

              if ($doc_profile->photo ?? false) {
                $photo = Storage::url($doc_profile->photo);
              } else {
                $photo = '/assets/img/doctors/doctor-01.jpg';
              }

              $name = \App\User::userNameFormat($doctor);
              ?>
              <div class="profile-widget">
                <div class="doc-img">
                  <a href="{{route('doctor-profile', ['id' => $doctor->id])}}">
                    <img class="img-fluid" alt="User Image" src="{{$photo??null}}">
                  </a>
                </div>
                <div class="pro-content">
                  <h3 class="title">
                    <a href="{{route('doctor-profile', ['id' => $doctor->id])}}">{{$name??null}}</a>
                    <i class="fas fa-check-circle verified"></i>
                  </h3>
                  <p class="speciality">{{$doc_profile->clinic_name??null}}</p>
                  <ul class="available-info">
                    @if ($doc_profile->clinic_address??false)
                      <li>
                        <i class="fas fa-map-marker-alt"></i> {{$doc_profile->clinic_address}}
                      </li>
                    @endif
                    <li>
                      <i class="fa fa-phone"></i> {{$doctor->phone??null}}</li>
                    </li>
                    @if($doc_profile->price??false)
                      <li>
                        <i class="far fa-money-bill-alt"></i> {{$doc_profile->price}}
                      </li>
                    @endif
                  </ul>
                  <div class="row row-sm">
                    <div class="col-6">
                      <a href="{{route('doctor-profile', ['id' => $doctor->id])}}"
                         class="btn view-btn">{{__('regular.view_more')}}</a>
                    </div>
                    <div class="col-3">
                      <a href="tel:{{$doctor->phone??null}}" class="btn view-btn">
                        <i class="fas fa-phone"></i>
                      </a>
                    </div>
                    <div class="col-3">
                      <a href="{{route('chat', ['id' => 'D'.$doctor->id])}}" class="btn view-btn">
                        <i class="far fa-comment-alt"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
          @endforeach
          <!-- /Doctor Widgets -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /Our Doctors Section -->

  <!-- Chat Section -->
  <section id="app">
    <support-chat ref="supportChat"></support-chat>
  </section>
  <!-- /Chat Section -->

  </div>
  <!-- /Main Wrapper -->
@endsection
