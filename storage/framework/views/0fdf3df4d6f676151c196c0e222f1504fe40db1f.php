<?php $__env->startSection('content'); ?>
  <!-- Breadcrumb -->
  <div class="breadcrumb-bar">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-md-12 col-12">
          <nav aria-label="breadcrumb" class="page-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('header.home')); ?></a></li>
              <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('patient_nav.dashboard')); ?></li>
            </ol>
          </nav>
          <h2 class="breadcrumb-title"><?php echo e(__('patient_nav.dashboard')); ?></h2>
        </div>
      </div>
    </div>
  </div>
  <!-- /Breadcrumb -->

  <!-- Page Content -->
  <div class="content">
    <div class="container-fluid">

      <div class="row">

        <!-- Profile Sidebar -->
        <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
          <div class="profile-sidebar">
            <?php echo $__env->make('patient.regular.profile-info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('patient.regular.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          </div>
        </div>
        <!-- / Profile Sidebar -->
        <div class="col-md-7 col-lg-8 col-xl-9">
          <div class="card">
            <div class="card-body pt-0">

              <!-- Tab Menu -->
              <nav class="user-tabs mb-4">
                <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                  <li class="nav-item">
                    <a class="nav-link active" href="#prescriptions"
                       data-toggle="tab"><?php echo e(__('regular.prescriptions')); ?></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#medical_records" data-toggle="tab"><span
                        class="med-records"><?php echo e(__('regular.medical-records')); ?></span></a>
                  </li>
                </ul>
              </nav>
              <!-- /Tab Menu -->

              <!-- Tab Content -->
              <div class="tab-content pt-0">
                <!-- Prescription Tab -->
                <div id="prescriptions" class="tab-pane fade active show">
                  <div class="card card-table mb-0">
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
                                <div class="table-action">
                                  <?php if($row->file): ?>
                                    <a href="<?php echo e(Storage::url($row->file)); ?>" download
                                       class="btn btn-sm bg-info-light">
                                      <i class="fa fa-download"></i> <?php echo e(__('regular.download')); ?>

                                    </a>
                                  <?php endif; ?>
                                </div>
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
                <div id="medical_records" class="tab-pane fade">
                  <div class="card card-table mb-0">
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-hover table-center mb-0">
                          <thead>
                          <tr>
                            <th><?php echo e(__('regular.date')); ?></th>
                            <th><?php echo e(__('regular.description')); ?></th>
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
                              <td><?php echo e($row->description); ?></td>
                              <td>
                                <?php if($row->file): ?>
                                  <a href="#"><?php echo e($row->file_name); ?></a>
                                <?php endif; ?>
                              </td>
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
                                <div class="table-action">
                                  <?php if($row->file): ?>
                                    <a href="<?php echo e(Storage::url($row->file)); ?>" download="<?php echo e($row->file_name); ?>"
                                       class="btn btn-sm bg-info-light">
                                      <i class="fa fa-download"></i> <?php echo e(__('regular.download')); ?>

                                    </a>
                                  <?php endif; ?>
                                </div>
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
              </div>
              <!-- Tab Content -->

            </div>
          </div>
        </div>
      </div>

    </div>

  </div>
  <!-- /Page Content -->
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/a/alexstrilby/ayrveda/resources/views/patient/patient-dashboard.blade.php ENDPATH**/ ?>