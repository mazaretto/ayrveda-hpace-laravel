<?php $__env->startSection('footer-script'); ?>
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
  <!-- Breadcrumb -->
  <div class="breadcrumb-bar">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-md-12 col-12">
          <nav aria-label="breadcrumb" class="page-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
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
            <?php echo $__env->make('doctor.regular.info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('doctor.regular.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                    <th><?php echo e(__('auth.name')); ?></th>
                    <th><?php echo e(__('header.doctor')); ?></th>
                    <th style="width: 25px;"></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  $patients = \App\PatientToDoctor::where('doctor_id', auth()->user()->id)->pluck('user_id')->toArray();
                  ?>
                  <?php $__currentLoopData = App\User::role('Patient')->with('patientToDoctor')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <tr>
                      <td>P<?php echo e($patient->id); ?></td>
                      <td><a href="<?php echo e(route('doctor.my-patient', ['id' => $patient->id])); ?>"><?php echo e(\App\User::userNameFormat($patient)); ?></a></td>
                      <td>
                        <?php $__currentLoopData = $patient->patientToDoctor()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php ($doctor = \App\User::find($doc->doctor_id)); ?>
                          <?php if($doctor): ?>
                            <a href="<?php echo e(route('doctor-profile', ['id' => $doctor->id])); ?>"><?php echo e(\App\User::userNameFormat($doctor)); ?></a>
                          <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </td>
                      <td>
                        <?php if(!in_array($patient->id, $patients)): ?>
                          <form action="<?php echo e(route('doctor.add-patient')); ?>" method="Post">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="id" value="<?php echo e($patient->id); ?>">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-user-plus"></i></button>
                          </form>
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
      </div>

    </div>

  </div>
  <!-- /Page Content -->
  </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/a/alexstrilby/ayrveda/resources/views/doctor/doctor-dashboard.blade.php ENDPATH**/ ?>