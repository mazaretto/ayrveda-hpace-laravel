@extends('layout.mainlayout_admin')
@section('content')
  <!-- Page Wrapper -->
  <div class="page-wrapper">
    <div class="content container-fluid">

      <!-- Page Header -->
      <div class="page-header">
        <div class="row">
          <div class="col">
            <h3 class="page-title">Profile</h3>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.patients-list')}}">Patients</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ul>
          </div>
        </div>
      </div>
      <!-- /Page Header -->

      <?php
      $name = \App\User::userNameFormat($user);

      if (($profile->country ?? null) !== null and ($profile->city ?? null) !== null) {
        $location = $profile->city . ', ' . $profile->country;
      } else {
        $location = 'Not set';
      }

      ?>

      <div class="row">
        <div class="col-md-12">
          <div class="profile-header">
            <div class="row align-items-center">
              <div class="col-auto profile-image">
                <a href="#">
                  <img class="rounded-circle" alt="User Image"
                       src="{{($profile->photo??false)?Storage::url($profile->photo):'/assets_admin/img/profiles/avatar-01.jpg'}}">
                </a>
              </div>
              <div class="col ml-md-n2 profile-user-info">
                <h4 class="user-name mb-0">{{$name}}</h4>
                <h6 class="text-muted">{{$user->email}}</h6>
                <form action="{{route('admin.seller-set')}}" method="Post">
                  @csrf
                  <input type="hidden" name="id" value="{{$user->id}}">
                  <label>
                    <input type="checkbox" name="seller" id="check-input-seller" @if($user->hasRole('Seller')){{'checked'}}@endif>
                    Manager for Sales
                  </label>
                </form>
                <script>
                    document.getElementById('check-input-seller').onchange = (event) => {
                        event.target.closest('form').submit()
                    }
                </script>
                <div class="user-Location"><i class="fa fa-map-marker"></i> {{$location}}</div>
                <div class="about-text">{{$profile->biography??null}}</div>
              </div>
            </div>
          </div>
          <div class="profile-menu">
            <ul class="nav nav-tabs nav-tabs-solid">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#per_details_tab">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#med_records">Medical Records</a>
              </li>
            </ul>
          </div>
          <div class="tab-content profile-tab-cont">

            <!-- Personal Details Tab -->
            <div class="tab-pane fade show active" id="per_details_tab">
              <!-- Personal Details -->
              <?php
              $name = \App\User::userNameFormat($user);
              ?>
              <div class="row">
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title d-flex justify-content-between">
                        <span>Personal Details</span>
                        <!--
                        <a class="edit-link" data-toggle="modal"
                           href="#edit_personal_details"><i class="fa fa-edit mr-1"></i>Edit</a>
                           -->
                      </h5>
                      <div class="row">
                        <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Name</p>
                        <p class="col-sm-10">{{$name}}</p>
                      </div>
                      <div class="row">
                        <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Date of
                          Birth</p>
                        <p class="col-sm-10">{{$profile->birth??null}}</p>
                      </div>
                      <div class="row">
                        <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Email ID</p>
                        <p class="col-sm-10">{{$user->email}}</p>
                      </div>
                      <div class="row">
                        <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Mobile</p>
                        <p class="col-sm-10">{{$user->phone??null}}</p>
                      </div>
                      <div class="row">
                        <p class="col-sm-2 text-muted text-sm-right mb-0">Address</p>
                        <p class="col-sm-10 mb-0">
                          {{$profile->zip_code??null}}, {{$profile->address??null}}
                        </p>
                      </div>
                    </div>
                  </div>

                  <!-- Edit Details Modal -->
                  <div class="modal fade" id="edit_personal_details" aria-hidden="true" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Personal Details</h5>
                          <button type="button" class="close" data-dismiss="modal"
                                  aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form>
                            <div class="row form-row">
                              <div class="col-12 col-sm-6">
                                <div class="form-group">
                                  <label>First Name</label>
                                  <input type="text" class="form-control"
                                         value="John">
                                </div>
                              </div>
                              <div class="col-12 col-sm-6">
                                <div class="form-group">
                                  <label>Last Name</label>
                                  <input type="text" class="form-control" value="Doe">
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="form-group">
                                  <label>Date of Birth</label>
                                  <div class="cal-icon">
                                    <input type="text" class="form-control"
                                           value="24-07-1983">
                                  </div>
                                </div>
                              </div>
                              <div class="col-12 col-sm-6">
                                <div class="form-group">
                                  <label>Email ID</label>
                                  <input type="email" class="form-control"
                                         value="johndoe@example.com">
                                </div>
                              </div>
                              <div class="col-12 col-sm-6">
                                <div class="form-group">
                                  <label>Mobile</label>
                                  <input type="text" value="+1 202-555-0125"
                                         class="form-control">
                                </div>
                              </div>
                              <div class="col-12">
                                <h5 class="form-title"><span>Address</span></h5>
                              </div>
                              <div class="col-12">
                                <div class="form-group">
                                  <label>Address</label>
                                  <input type="text" class="form-control"
                                         value="4663 Agriculture Lane">
                                </div>
                              </div>
                              <div class="col-12 col-sm-6">
                                <div class="form-group">
                                  <label>City</label>
                                  <input type="text" class="form-control"
                                         value="Miami">
                                </div>
                              </div>
                              <div class="col-12 col-sm-6">
                                <div class="form-group">
                                  <label>State</label>
                                  <input type="text" class="form-control"
                                         value="Florida">
                                </div>
                              </div>
                              <div class="col-12 col-sm-6">
                                <div class="form-group">
                                  <label>Zip Code</label>
                                  <input type="text" class="form-control"
                                         value="22434">
                                </div>
                              </div>
                              <div class="col-12 col-sm-6">
                                <div class="form-group">
                                  <label>Country</label>
                                  <input type="text" class="form-control"
                                         value="United States">
                                </div>
                              </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Save
                              Changes
                            </button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /Edit Details Modal -->

                </div>


              </div>
              <!-- /Personal Details -->
            </div>
            <!-- /Personal Details Tab -->

            <!-- Medical Records Tab -->
            <div class="tab-pane fade" id="med_records">
              <!-- Medical Records -->
              <div class="row">
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title d-flex justify-content-between">
                        <span>Medical Records</span>
                      </h5>
                    </div>
                  </div>

                  <div class="card card-table">
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-hover table-center mb-0">
                          <thead>
                          <tr>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Attachment</th>
                            <th>Created</th>
                            <th></th>
                          </tr>
                          </thead>
                          <tbody>
                          @foreach($user->medicalRecord()->get()->sortByDesc('date')??null as $row)
                            <?php
                            $doctor = App\User::find($row->from_id);
                            if ($doctor ?? false) {
                              $doctor_prof = $doctor->doctorProfile()->first();
                            }

                            if ($doctor_prof->first_name ?? null and $doctor_prof->last_name ?? null and $doctor_prof->patronymic ?? null) {
                              $name = 'Dr. ' . $doctor_prof->first_name . mb_substr($doctor_prof->patronymic, 0, 1) . $doctor_prof->last_name;
                            } else {
                              $name = 'Dr. ' . $doctor->name;
                            }

                            if ($doctor_prof->photo ?? false) {
                              $photo = Storage::url($doctor_prof->photo);
                            } else {
                              $photo = '/assets/img/doctors/doctor-thumb-01.jpg';
                            }
                            ?>
                            <tr>
                              <td>{{date('j M Y', strtotime($row->date))}}</td>
                              <td>{{$row->description}}</td>
                              <td><a href="#">{{$row->file_name}}</a></td>
                              <td>
                                <h2 class="table-avatar">
                                  <a href="{{route('admin.doctor-profile', ['id' => $row->from_id])}}"
                                     class="avatar avatar-sm mr-2">
                                    <img class="avatar-img rounded-circle"
                                         src="{{$photo}}"
                                         alt="User Image">
                                  </a>
                                  <a href="{{route('admin.doctor-profile', ['id' => $row->from_id])}}">{{$name}}</a>
                                </h2>
                              </td>
                              <td class="text-right">
                                <div class="table-action">
                                  <a href="{{Storage::url($row->file)}}"
                                     download="{{$row->file_name}}"
                                     class="btn btn-sm bg-info-light">
                                    <i class="fa fa-download"></i> Download
                                  </a>
                                </div>
                              </td>
                            </tr>
                          @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>

                </div>


              </div>
              <!-- /Medical Records -->
            </div>
            <!-- /Medical Records Tab -->
          </div>
        </div>
      </div>

    </div>
  </div>
  <!-- /Page Wrapper -->

  </div>
  <!-- /Main Wrapper -->
@endsection
