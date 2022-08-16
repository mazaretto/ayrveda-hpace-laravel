@extends('layout.mainlayout')

@section('footer-script')
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
  <script>
      $(document).ready(function () {
          let lang = document.documentElement.getAttribute('lang')
          if (lang === 'ru') {
              $('table').dataTable({
                  language: {
                      url: '//cdn.datatables.net/plug-ins/1.10.22/i18n/Russian.json'
                  }
              })
          } else {
              $('table').dataTable()
          }
      })
  </script>
@endsection
@section('content')
  <!-- Breadcrumb -->
  <div class="breadcrumb-bar">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-md-12 col-12">
          <nav aria-label="breadcrumb" class="page-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
          </nav>
          <h2 class="breadcrumb-title">Dashboard</h2>
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
          <div class="card card-table p-3">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>{{__('auth.name')}}</th>
                    <th>{{__('header.doctor')}}</th>
                    <th style="width: 25px;"></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  $patients = \App\PatientToDoctor::where('doctor_id', auth()->user()->id)->pluck('user_id')->toArray();
                  ?>
                  @foreach(App\User::role('Patient')->with('patientToDoctor')->get() as $patient)

                    <tr>
                      <td>P{{$patient->id}}</td>
                      <td><a href="{{route('doctor.my-patient', ['id' => $patient->id])}}">{{\App\User::userNameFormat($patient)}}</a></td>
                      <td>
                        @foreach($patient->patientToDoctor()->get() as $doc)
                          @php($doctor = \App\User::find($doc->doctor_id))
                          @if ($doctor)
                            <a href="{{route('doctor-profile', ['id' => $doctor->id])}}">{{\App\User::userNameFormat($doctor)}}</a>
                          @endif
                        @endforeach
                      </td>
                      <td>
                        @if(!in_array($patient->id, $patients))
                          <form action="{{route('doctor.add-patient')}}" method="Post">
                            @csrf
                            <input type="hidden" name="id" value="{{$patient->id}}">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-user-plus"></i></button>
                          </form>
                        @endif
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
  <!-- /Page Content -->
  </div>
@endsection

