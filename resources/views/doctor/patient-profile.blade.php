@extends('layout.mainlayout')

@section('footer-script')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
  <script>
      $(document).ready(function () {
          $('#medicine_id').select2({
              width: '100%',
          });
      });
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
              <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('header.home')}}</a></li>
              <li class="breadcrumb-item"><a
                    href="{{route('doctor.my-patients')}}">{{__('doctor_nav.my_patients')}}</a></li>
              <li class="breadcrumb-item active"
                  aria-current="page">{{__('header.patient')}} P{{$user->id}}
              </li>
            </ol>
          </nav>
          <h2 class="breadcrumb-title">{{__('header.patient')}} P{{$user->id}}</h2>
        </div>
      </div>
    </div>
  </div>
  <!-- /Breadcrumb -->

  @php($profile = $user->patientProfile()->first())
  <!-- Page Content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar dct-dashbd-lft">

          <!-- Profile Widget -->
        @include('doctor.regular.patients.info')
        <!-- /Profile Widget -->
        </div>

        <div class="col-md-7 col-lg-8 col-xl-9 dct-appoinment">
          <div class="card">
            <div class="card-body pt-0">
              <div class="user-tabs">
                <ul class="nav nav-tabs nav-tabs-bottom nav-justified flex-wrap">
                  <li class="nav-item">
                    <a class="nav-link active" href="#pres"
                       data-toggle="tab"><span>{{__('regular.prescriptions')}}</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#medical" data-toggle="tab"><span class="med-records">{{__('regular.medical-records')}}</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#files" data-toggle="tab"><span class="med-records">{{__('patient_nav.uploaded_files')}}</span></a>
                  </li>
                </ul>
              </div>

              <div class="tab-content">
                <!-- Prescription Tab -->
                <div class="tab-pane fade show active" id="pres">
                  <div class="text-right">
                    <a href="#" class="add-new-btn" data-toggle="modal"
                       data-target="#add_prescription">{{__('regular.add-prescr')}}</a>
                  </div>
                  <div class="card card-table msb-0">
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-hover table-center mb-0">
                          <thead>
                          <tr>
                            <th>{{__('regular.date')}}</th>
                            <th>{{__('regular.name-prescription')}}</th>
                            <th>{{__('regular.medicine')}}</th>
                            <th>{{__('regular.created_by')}}</th>
                            <th></th>
                          </tr>
                          </thead>
                          <tbody>
                          @foreach($user->prescription()->get()->sortByDesc('date')??null as $row)
                            <?php
                            $doctor = App\User::find($row->from_id);
                            if ($doctor ?? false) {
                              $doctor_prof = $doctor->doctorProfile()->first();
                            }

                            if ($doctor_prof->first_name ?? null and $doctor_prof->last_name ?? null and $doctor_prof->patronymic ?? null) {
                              $name = 'Dr. ' . $doctor_prof->first_name . ' ' . mb_substr($doctor_prof->patronymic, 0, 1) . ' ' . $doctor_prof->last_name;
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
                              <td>{{$row->name}}</td>
                              <td>
                                @if($row->medicine_id??false and \App\MedicineList::find($row->medicine_id) !== null)
                                  <?php
                                  $medicine = \App\MedicineList::find($row->medicine_id);
                                  ?>
                                  <a href="{{route('store.medicine', ['id' => $medicine->id])}}">{{$medicine->name}}</a>
                                @endif
                              </td>
                              <td>
                                <h2 class="table-avatar">
                                  <a href="{{route('doctor-profile', ['id' => $row->from_id])}}"
                                     class="avatar avatar-sm mr-2">
                                    <img class="avatar-img rounded-circle"
                                         src="{{$photo??null}}"
                                         alt="User Image">
                                  </a>
                                  <a href="{{route('doctor-profile', ['id' => $row->from_id])}}">{{$name??null}}</a>
                                </h2>
                              </td>
                              <td class="text-right">
                                @if($row->file)
                                  <div class="table-action">
                                    <a href="{{Storage::url($row->file)}}" download
                                       class="btn btn-sm bg-info-light">
                                      <i class="fa fa-download"></i> {{__('regular.download')}}
                                    </a>
                                  </div>
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
                <!-- /Prescription Tab -->

                <!-- Medical Records Tab -->
                <div class="tab-pane fade" id="medical">
                  <div class="text-right">
                    <a href="#" class="add-new-btn" data-toggle="modal"
                       data-target="#add_medical_records">{{__('regular.add-medical-rec')}}</a>
                  </div>
                  <div class="card card-table mb-0">
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-hover table-center mb-0">
                          <thead>
                          <tr>
                            <th>{{__('regular.date')}}</th>
                            <th class="col-3">{{__('regular.description')}}</th>
                            <th>{{__('regular.attachment')}}</th>
                            <th>{{__('regular.created_by')}}</th>
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
                              $name = 'Dr. ' . $doctor_prof->first_name . ' ' . mb_substr($doctor_prof->patronymic, 0, 1) . ' ' . $doctor_prof->last_name;
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
                              <td class="col-3">{{$row->description}}</td>
                              <td>
                                <?php
                                $allowedMimeTypes = ['image/jpeg', 'image/gif', 'image/png', 'image/bmp', 'image/svg+xml'];
                                $pdf = 'application/pdf';
                                $contentType = mime_content_type('storage/' . $row->file);
                                ?>
                                @if(in_array($contentType, $allowedMimeTypes))
                                  <a href="{{Storage::url($row->file)}}" data-fancybox="gallery">
                                    <img class="uploaded-files__image-preview"
                                         src="{{Storage::url($row->file)}}"
                                         alt="">
                                  </a>
                                @elseif($contentType==$pdf)
                                  <div class="d-flex flex-wrap">
                                    <iframe src="{{Storage::url($row->file)}}"
                                            class="uploaded-files__pdf-preview"></iframe>
                                    <a href="{{Storage::url($row->file)}}" class="btn btn-outline-info mt-2" data-fancybox="pdf">
                                      <i class="fas fa-compress"></i> {{__('regular.fullscreen')}}
                                    </a>
                                  </div>
                                @else
                                  <span>{{$row->file_name}}</span>
                                @endif
                              <td>
                                <h2 class="table-avatar">
                                  <a href="{{route('doctor-profile', ['id' => $row->from_id])}}"
                                     class="avatar avatar-sm mr-2">
                                    <img class="avatar-img rounded-circle"
                                         src="{{$photo}}"
                                         alt="User Image">
                                  </a>
                                  <a href="{{route('doctor-profile', ['id' => $row->from_id])}}">{{$name}}</a>
                                </h2>
                              </td>
                              <td class="text-right">
                                @if($row->file)
                                  <div class="table-action">
                                    <a href="{{Storage::url($row->file)}}"
                                       download="{{$row->file_name}}"
                                       class="btn btn-sm bg-info-light">
                                      <i class="fa fa-download"></i> {{__('regular.download')}}
                                    </a>
                                  </div>
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
                <!-- /Medical Records Tab -->

                <!-- Files Tab -->
                <div class="tab-pane fade" id="files">
                  <div class="card card-table mb-0">
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-hover table-center mb-0">
                          <thead>
                          <tr>
                            <th class="col-2">{{__('regular.file-name')}}</th>
                            <th class="col-8">{{__('regular.file')}}</th>
                            <th class="col-2"></th>
                          </tr>
                          </thead>
                          <tbody>
                          @foreach($user->uploadedFiles()->latest()->get()??null as $file)
                            <tr>
                              <td class="col-2 text-left uploaded-files__name">
                                <h2>{{$file->name}}</h2>
                              </td>
                              <td class="col-8">
                                <?php
                                $allowedMimeTypes = ['image/jpeg', 'image/gif', 'image/png', 'image/bmp', 'image/svg+xml'];
                                $pdf = 'application/pdf';
                                $contentType = mime_content_type('storage/' . $file->file);
                                ?>
                                @if(in_array($contentType, $allowedMimeTypes))
                                  <a href="{{Storage::url($file->file)}}" data-fancybox="gallery">
                                    <img class="uploaded-files__image-preview"
                                         src="{{Storage::url($file->file)}}"
                                         alt="">
                                  </a>
                                @elseif($contentType==$pdf)
                                  <div class="d-flex flex-wrap">
                                    <iframe src="{{Storage::url($file->file)}}"
                                            class="uploaded-files__pdf-preview"></iframe>
                                    <a href="{{Storage::url($file->file)}}" class="btn btn-outline-info mt-2" data-fancybox="pdf">
                                      <i class="fas fa-compress"></i> {{__('regular.fullscreen')}}
                                    </a>
                                  </div>
                                @else
                                  <a href="{{Storage::url($file->file)}}"
                                     class="btn btn-sm bg-info-light">
                                    <i class="far fa-eye"></i> {{__('regular.view')}}
                                  </a>
                                @endif
                              </td>
                              <td class="col-2 d-flex flex-wrap">
                                <a href="{{Storage::url($file->file)}}"
                                   download="{{$file->name}}"
                                   class="btn btn-sm bg-success-light">
                                  <i class="fas fa-download"></i> {{__('regular.download')}}
                                </a>
                                <form action="{{route('patient.remove-files')}}" method="Post">
                                  @csrf
                                  <input type="hidden" name="id" value="{{$file->id}}">
                                  <button class="btn bg-danger-light mt-2">
                                    <i class="fas fa-trash"></i>
                                  </button>
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
                <!-- /Files Tab -->
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>
  <!-- /Page Content -->
  </div>

  <!-- Add Prescription Modal -->
  <div class="modal fade custom-modal" id="add_prescription">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Prescription</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
        </div>
        <form action="{{route('doctor.add-prescription')}}" method="Post" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="id" value="{{$user->id}}">
          <div class="modal-body">
            <div class="form-group">
              <label class="required">Date </label>
              <div class="cal-icon">
                <input type="text" name="date" class="form-control date-picker" value="" required>
              </div>
            </div>
            <div class="form-group">
              <label class="required">Name </label>
              <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
              <label class="required">Medicine </label>
              <div class="col-12">
                <select name="medicine_id" id="medicine_id" required>
                  <option value>{{__('forms.select')}}</option>
                  @foreach(\App\MedicineList::all() as $medicine)
                    <option value="{{$medicine->id}}">{{$medicine->name}} | {{$medicine->price}}
                      - {{$medicine->description}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="">Upload File</label>
              <input type="file" name="file" class="form-control">
            </div>
            <div class="submit-section text-center">
              <button type="submit" class="btn btn-primary submit-btn">Submit</button>
              <button type="button" class="btn btn-secondary submit-btn" data-dismiss="modal">Cancel
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- /Add Prescription Modal -->

  <!-- Add Medical Records Modal -->
  <div class="modal fade custom-modal" id="add_medical_records">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Medical Records</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
        </div>
        <form action="{{route('doctor.add-medical-record')}}" method="Post" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="id" value="{{$user->id}}">
          <div class="modal-body">
            <div class="form-group">
              <label class="required">Date </label>
              <div class="cal-icon">
                <input type="text" name="date" class="form-control date-picker" required>
              </div>
            </div>
            <div class="form-group">
              <label class="required">Description </label>
              <input type="text" name="description" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Attachment </label>
              <input type="file" name="file" class="form-control">
            </div>
            <div class="submit-section text-center">
              <button type="submit" class="btn btn-primary submit-btn">Submit</button>
              <button type="button" class="btn btn-secondary submit-btn" data-dismiss="modal">Cancel
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- /Add Medical Records Modal -->
@endsection
