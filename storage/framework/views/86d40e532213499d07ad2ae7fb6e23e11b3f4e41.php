<?php $__env->startSection('header-css'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <!-- Page Wrapper -->
  <div class="page-wrapper">
    <div class="content container-fluid">

      <!-- Page Header -->
      <div class="page-header">
        <div class="row">
          <div class="col-sm-12">
            <h3 class="page-title">Support, token #<?php echo e($token); ?></h3>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?php echo e(route('admin.support')); ?>">Support</a></li>
              <li class="breadcrumb-item active">Support, token #<?php echo e($token); ?></li>
            </ul>
          </div>
        </div>
      </div>
      <!-- /Page Header -->

      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
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

<?php echo $__env->make('layout.mainlayout_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH W:\domains\docure\resources\views/admin/support-chat.blade.php ENDPATH**/ ?>