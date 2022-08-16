<?php $__env->startSection('footer-script'); ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.min.js"
          integrity="sha512-quHCp3WbBNkwLfYUMd+KwBAgpVukJu5MncuQaWXgCrfgcxCJAq/fo+oqrRKOj+UKEmyMCG3tb8RB63W+EmrOBg=="
          crossorigin="anonymous"></script>
  <script>
    function doctorStatus(el) {
      let input = $(el).parent().find('input').first()
      let checked = !input.prop('checked')
      let id = input.attr('data-id')

      axios.post('<?php echo e(route('admin.doctor-status')); ?>', {
        id: id,
        status: checked,
      }).then(r => {
        console.log(r)
      })
    }
  </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <!-- Page Wrapper -->
  <div class="page-wrapper">
    <div class="content container-fluid">

      <!-- Page Header -->
      <div class="page-header">
        <div class="row">
          <div class="col-sm-12">
            <h3 class="page-title">List of Doctors</h3>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Dashboard</a></li>
              <li class="breadcrumb-item active">Doctors</li>
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
                <table class="datatable table table-hover table-center mb-0">
                  <thead>
                  <tr>
                    <th>Doctor Name</th>
                    <th>Speciality</th>
                    <th>Member Since</th>
                    <th>Account Status</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                    if ($doctor->doctorProfile->first_name ?? false and $doctor->doctorProfile->last_name ?? false and $doctor->doctorProfile->patronymic ?? false) {
                      $name = 'Dr. ' . $doctor->doctorProfile->first_name . ' ' . mb_substr($doctor->doctorProfile->patronymic, 0, 1) . '. ' . $doctor->doctorProfile->last_name;
                    } else {
                      $name = 'Dr. ' . $doctor->name;
                    }
                    ?>
                    <tr>
                      <td>
                        <h2 class="table-avatar">
                          <a href="<?php echo e(route('admin.doctor-profile', ['id' => $doctor->id])); ?>"
                             class="avatar avatar-sm mr-2"><img
                              class="avatar-img rounded-circle"
                              src="<?php echo e(($doctor->doctorProfile->photo??false)?Storage::url($doctor->doctorProfile->photo):'/assets_admin/img/doctors/doctor-thumb-01.jpg'); ?>"
                              alt="User Image"></a>
                          <a href="<?php echo e(route('admin.doctor-profile', ['id' => $doctor->id])); ?>"><?php echo e($name); ?></a>
                        </h2>
                      </td>
                      <td>
                        <?php $__currentLoopData = explode(',', $doctor->doctorProfile->specialist??null); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $speciality): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php if($loop->last): ?>
                            <?php echo e($speciality); ?>

                          <?php else: ?>
                            <?php echo e($speciality.', '); ?>

                          <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </td>
                      <?php
                      $date = date('j M Y', strtotime($doctor->created_at));
                      $time = date('g:i a', strtotime($doctor->created_at));
                      ?>

                      <td><?php echo e($date??null); ?> <br><small><?php echo e($time??null); ?></small></td>

                      <td>
                        <div class="status-toggle">
                          <input type="checkbox" id="status_<?php echo e($doctor->id); ?>" data-id="<?php echo e($doctor->id); ?>"
                                 class="check" <?php echo e($doctor->active??false ? 'checked':null); ?>>
                          <label for="status_<?php echo e($doctor->id); ?>" class="checktoggle"
                                 onclick="doctorStatus(this)">checkbox</label>
                        </div>
                      </td>

                      <td>
                        <form action="<?php echo e(route('admin.doctor-delete')); ?>" method="Post">
                          <?php echo csrf_field(); ?>
                          <input type="hidden" name="id" value="<?php echo e($doctor->id); ?>">
                          <button type="submit" class="btn btn-danger"><i class="fe fe-trash"></i></button>
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
      </div>

    </div>
  </div>
  <!-- /Page Wrapper -->

  </div>
  <!-- /Main Wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.mainlayout_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/a/alexstrilby/ayrveda/resources/views/admin/doctor/doctors-list.blade.php ENDPATH**/ ?>