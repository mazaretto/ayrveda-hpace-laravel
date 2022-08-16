@extends('layout.mainlayout_admin')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">List of Patients</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Patient</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="table-responsive">
                                    <table class="datatable table table-hover table-center mb-0">
                                        <thead>
                                        <tr>
                                            <th>Patient ID</th>
                                            <th>Patient Name</th>
                                            <th>Age</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($patients as $patient)
                                            <?php
                                            if ($patient->patientProfile->first_name ?? false and $patient->patientProfile->last_name ?? false and $patient->patientProfile->patronymic ?? false) {
                                                $name = $patient->patientProfile->first_name . ' ' . mb_substr($patient->patientProfile->patronymic, 0, 1) . '. ' . $patient->patientProfile->last_name;
                                            } else {
                                                $name = $patient->name;
                                            }

                                            if ($patient->patientProfile->birth ?? false) {
                                                $age = date('F j Y', strtotime($patient->patientProfile->birth));

                                                $date = new DateTime($patient->patientProfile->birth);
                                                $now = new DateTime();
                                                $interval = $now->diff($date);
                                                $age = $interval->y;
                                            }
                                            ?>
                                            <tr>
                                                <td>P{{$patient->id}}</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{route('admin.patient-profile', ['id' => $patient->id])}}" class="avatar avatar-sm mr-2"><img
                                                                class="avatar-img rounded-circle"
                                                                src="{{$patient->patientProfile->photo??false?Storage::url($patient->patientProfile->photo):'/assets_admin/img/patients/patient1.jpg'}}"
                                                                alt="User Image"></a>
                                                        <a href="{{route('admin.patient-profile', ['id' => $patient->id])}}">{{$name}}</a>
                                                    </h2>
                                                </td>
                                                <td>{{$age??'Not set'}}</td>
                                                <td>{{$patient->patientProfile->zip_code??null}} {{$patient->patientProfile->address??null}}, {{$patient->patientProfile->state??null}}, {{$patient->patientProfile->country??null}}</td>
                                                <td>{{$patient->phone??null}}</td>
                                              <td>
                                                <form action="{{route('admin.patient-delete')}}" method="Post">
                                                  @csrf
                                                  <input type="hidden" name="id" value="{{$patient->id}}">
                                                  <button type="submit" class="btn btn-danger"><i class="fe fe-trash"></i></button>
                                                </form>
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
            </div>

        </div>
    </div>
    <!-- /Page Wrapper -->

    </div>
    <!-- /Main Wrapper -->
@endsection
