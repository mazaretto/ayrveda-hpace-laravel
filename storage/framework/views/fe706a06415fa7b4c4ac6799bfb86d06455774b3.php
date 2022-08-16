<?php $__env->startSection('footer-script'); ?>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
  <script>
      $(document).ready(function () {
          $('#medicine_id').select2({
              width: '100%',
          });
      });
  </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
  <!-- Breadcrumb -->
  <div class="breadcrumb-bar">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-md-12 col-12">
          <nav aria-label="breadcrumb" class="page-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('header.home')); ?></a></li>
              <li class="breadcrumb-item"><a
                    href="<?php echo e(route('doctor.my-patients')); ?>"><?php echo e(__('doctor_nav.my_patients')); ?></a></li>
              <li class="breadcrumb-item active"
                  aria-current="page"><?php echo e(__('header.patient')); ?> P<?php echo e($user->id); ?>

              </li>
            </ol>
          </nav>
          <h2 class="breadcrumb-title"><?php echo e(__('header.patient')); ?> P<?php echo e($user->id); ?></h2>
        </div>
      </div>
    </div>
  </div>
  <!-- /Breadcrumb -->

  <?php ($profile = $user->patientProfile()->first()); ?>
  <!-- Page Content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar dct-dashbd-lft">

          <!-- Profile Widget -->
        <?php echo $__env->make('doctor.regular.patients.info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- /Profile Widget -->
        </div>

        <div class="col-md-7 col-lg-8 col-xl-9 dct-appoinment">
          <div class="card">
            <div class="card-body pt-0">
              <div class="user-tabs">
                <ul class="nav nav-tabs nav-tabs-bottom nav-justified flex-wrap">
                  <li class="nav-item">
                    <a class="nav-link active" href="#pres"
                       data-toggle="tab"><span><?php echo e(__('regular.prescriptions')); ?></span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#medical" data-toggle="tab"><span class="med-records"><?php echo e(__('regular.medical-records')); ?></span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#files" data-toggle="tab"><span class="med-records"><?php echo e(__('patient_nav.uploaded_files')); ?></span></a>
                  </li>
                </ul>
              </div>

              <div class="tab-content">
                <!-- Prescription Tab -->
                <div class="tab-pane fade show active" id="pres">
                  <div class="text-right">
                    <a href="#" class="add-new-btn" data-toggle="modal"
                       data-target="#add_prescription"><?php echo e(__('regular.add-prescr')); ?></a>
                  </div>
                  <div class="card card-table msb-0">
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-hover table-center mb-0">
                          <thead>
                          <tr>
                            <th><?php echo e(__('regular.date')); ?></th>
                            <th><?php echo e(__('regular.name-prescription')); ?></th>
                            <th><?php echo e(__('regular.medicine')); ?></th>
                            <th><?php echo e(__('regular.created_by')); ?></th>
                            <th></th>
                          </tr>
                          </thead>
                          <tbody>
                          <?php $__currentLoopData = $user->prescription()->get()->sortByDesc('date')??null; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                              <td><?php echo e(date('j M Y', strtotime($row->date))); ?></td>
                              <td><?php echo e($row->name); ?></td>
                              <td>
                                <?php if($row->medicine_id??false and \App\MedicineList::find($row->medicine_id) !== null): ?>
                                  <?php
                                  $medicine = \App\MedicineList::find($row->medicine_id);
                                  ?>
                                  <a href="<?php echo e(route('store.medicine', ['id' => $medicine->id])); ?>"><?php echo e($medicine->name); ?></a>
                                <?php endif; ?>
                              </td>
                              <td>
                                <h2 class="table-avatar">
                                  <a href="<?php echo e(route('doctor-profile', ['id' => $row->from_id])); ?>"
                                     class="avatar avatar-sm mr-2">
                                    <img class="avatar-img rounded-circle"
                                         src="<?php echo e($photo??null); ?>"
                                         alt="User Image">
                                  </a>
                                  <a href="<?php echo e(route('doctor-profile', ['id' => $row->from_id])); ?>"><?php echo e($name??null); ?></a>
                                </h2>
                              </td>
                              <td class="text-right">
                                <?php if($row->file): ?>
                                  <div class="table-action">
                                    <a href="<?php echo e(Storage::url($row->file)); ?>" download
                                       class="btn btn-sm bg-info-light">
                                      <i class="fa fa-download"></i> <?php echo e(__('regular.download')); ?>

                                    </a>
                                  </div>
                                <?php endif; ?>
                              </td>
                            </tr>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                       data-target="#add_medical_records"><?php echo e(__('regular.add-medical-rec')); ?></a>
                  </div>
                  <div class="card card-table mb-0">
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-hover table-center mb-0">
                          <thead>
                          <tr>
                            <th><?php echo e(__('regular.date')); ?></th>
                            <th class="col-3"><?php echo e(__('regular.description')); ?></th>
                            <th><?php echo e(__('regular.attachment')); ?></th>
                            <th><?php echo e(__('regular.created_by')); ?></th>
                            <th></th>
                          </tr>
                          </thead>
                          <tbody>
                          <?php $__currentLoopData = $user->medicalRecord()->get()->sortByDesc('date')??null; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                              <td><?php echo e(date('j M Y', strtotime($row->date))); ?></td>
                              <td class="col-3"><?php echo e($row->description); ?></td>
                              <td>
                                <?php
                                $allowedMimeTypes = ['image/jpeg', 'image/gif', 'image/png', 'image/bmp', 'image/svg+xml'];
                                $pdf = 'application/pdf';
                                $contentType = mime_content_type('storage/' . $row->file);
                                ?>
                                <?php if(in_array($contentType, $allowedMimeTypes)): ?>
                                  <a href="<?php echo e(Storage::url($row->file)); ?>" data-fancybox="gallery">
                                    <img class="uploaded-files__image-preview"
                                         src="<?php echo e(Storage::url($row->file)); ?>"
                                         alt="">
                                  </a>
                                <?php elseif($contentType==$pdf): ?>
                                  <div class="d-flex flex-wrap">
                                    <iframe src="<?php echo e(Storage::url($row->file)); ?>"
                                            class="uploaded-files__pdf-preview"></iframe>
                                    <a href="<?php echo e(Storage::url($row->file)); ?>" class="btn btn-outline-info mt-2" data-fancybox="pdf">
                                      <i class="fas fa-compress"></i> <?php echo e(__('regular.fullscreen')); ?>

                                    </a>
                                  </div>
                                <?php else: ?>
                                  <span><?php echo e($row->file_name); ?></span>
                                <?php endif; ?>
                              <td>
                                <h2 class="table-avatar">
                                  <a href="<?php echo e(route('doctor-profile', ['id' => $row->from_id])); ?>"
                                     class="avatar avatar-sm mr-2">
                                    <img class="avatar-img rounded-circle"
                                         src="<?php echo e($photo); ?>"
                                         alt="User Image">
                                  </a>
                                  <a href="<?php echo e(route('doctor-profile', ['id' => $row->from_id])); ?>"><?php echo e($name); ?></a>
                                </h2>
                              </td>
                              <td class="text-right">
                                <?php if($row->file): ?>
                                  <div class="table-action">
                                    <a href="<?php echo e(Storage::url($row->file)); ?>"
                                       download="<?php echo e($row->file_name); ?>"
                                       class="btn btn-sm bg-info-light">
                                      <i class="fa fa-download"></i> <?php echo e(__('regular.download')); ?>

                                    </a>
                                  </div>
                                <?php endif; ?>
                              </td>
                            </tr>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                            <th class="col-2"><?php echo e(__('regular.file-name')); ?></th>
                            <th class="col-8"><?php echo e(__('regular.file')); ?></th>
                            <th class="col-2"></th>
                          </tr>
                          </thead>
                          <tbody>
                          <?php $__currentLoopData = $user->uploadedFiles()->latest()->get()??null; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                              <td class="col-2 text-left uploaded-files__name">
                                <h2><?php echo e($file->name); ?></h2>
                              </td>
                              <td class="col-8">
                                <?php
                                $allowedMimeTypes = ['image/jpeg', 'image/gif', 'image/png', 'image/bmp', 'image/svg+xml'];
                                $pdf = 'application/pdf';
                                $contentType = mime_content_type('storage/' . $file->file);
                                ?>
                                <?php if(in_array($contentType, $allowedMimeTypes)): ?>
                                  <a href="<?php echo e(Storage::url($file->file)); ?>" data-fancybox="gallery">
                                    <img class="uploaded-files__image-preview"
                                         src="<?php echo e(Storage::url($file->file)); ?>"
                                         alt="">
                                  </a>
                                <?php elseif($contentType==$pdf): ?>
                                  <div class="d-flex flex-wrap">
                                    <iframe src="<?php echo e(Storage::url($file->file)); ?>"
                                            class="uploaded-files__pdf-preview"></iframe>
                                    <a href="<?php echo e(Storage::url($file->file)); ?>" class="btn btn-outline-info mt-2" data-fancybox="pdf">
                                      <i class="fas fa-compress"></i> <?php echo e(__('regular.fullscreen')); ?>

                                    </a>
                                  </div>
                                <?php else: ?>
                                  <a href="<?php echo e(Storage::url($file->file)); ?>"
                                     class="btn btn-sm bg-info-light">
                                    <i class="far fa-eye"></i> <?php echo e(__('regular.view')); ?>

                                  </a>
                                <?php endif; ?>
                              </td>
                              <td class="col-2 d-flex flex-wrap">
                                <a href="<?php echo e(Storage::url($file->file)); ?>"
                                   download="<?php echo e($file->name); ?>"
                                   class="btn btn-sm bg-success-light">
                                  <i class="fas fa-download"></i> <?php echo e(__('regular.download')); ?>

                                </a>
                                <form action="<?php echo e(route('patient.remove-files')); ?>" method="Post">
                                  <?php echo csrf_field(); ?>
                                  <input type="hidden" name="id" value="<?php echo e($file->id); ?>">
                                  <button class="btn bg-danger-light mt-2">
                                    <i class="fas fa-trash"></i>
                                  </button>
                                </form>
                              </td>
                            </tr>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
        <form action="<?php echo e(route('doctor.add-prescription')); ?>" method="Post" enctype="multipart/form-data">
          <?php echo csrf_field(); ?>
          <input type="hidden" name="id" value="<?php echo e($user->id); ?>">
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
                  <option value><?php echo e(__('forms.select')); ?></option>
                  <?php $__currentLoopData = \App\MedicineList::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $medicine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($medicine->id); ?>"><?php echo e($medicine->name); ?> | <?php echo e($medicine->price); ?>

                      - <?php echo e($medicine->description); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
        <form action="<?php echo e(route('doctor.add-medical-record')); ?>" method="Post" enctype="multipart/form-data">
          <?php echo csrf_field(); ?>
          <input type="hidden" name="id" value="<?php echo e($user->id); ?>">
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/a/alexstrilby/ayrveda/resources/views/doctor/patient-profile.blade.php ENDPATH**/ ?>