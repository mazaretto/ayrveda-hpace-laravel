<?php $__env->startSection('content'); ?>
  <!-- Page Wrapper -->
  <div class="page-wrapper">
    <div class="content container-fluid">

      <!-- Page Header -->
      <div class="page-header">
        <div class="row">
          <div class="col-sm-12">
            <h3 class="page-title">General Settings</h3>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Dashboard</a></li>
              <li class="breadcrumb-item active">General Settings</li>
            </ul>
          </div>
        </div>
      </div>
      <!-- /Page Header -->

      <div class="row">
        <div class="col-12">
          <!-- General -->
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">General</h4>
            </div>
            <div class="card-body">
              <form action="<?php echo e(route('admin.settings-set')); ?>" method="Post">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                  <label>Contact Phone</label>
                  <input type="text" name="contact_phone" class="form-control" value="<?php echo e($settings['contact_phone']??null); ?>">
                </div>

                <div class="form-group">
                  <label>Address</label>
                  <input type="text" name="address" class="form-control" value="<?php echo e($settings['address']??null); ?>">
                </div>

                <div class="form-group">
                  <label>Email</label>
                  <input type="text" name="email" class="form-control" value="<?php echo e($settings['email']??null); ?>">
                </div>

                <button class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
          <!-- /General -->
        </div>

        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Media</h4>
            </div>
            <div class="card-body">
              <form action="<?php echo e(route('admin.settings-set')); ?>" method="Post">
                <?php echo csrf_field(); ?>
                <div class="d-flex flex-wrap">
                  <div class="form-group col-6">
                    <label>Facebook</label>
                    <input type="text" name="facebook" class="form-control" value="<?php echo e($settings['facebook']??null); ?>">
                  </div>

                  <div class="form-group col-6">
                    <label>Twitter</label>
                    <input type="text" name="twitter" class="form-control" value="<?php echo e($settings['twitter']??null); ?>">
                  </div>

                  <div class="form-group col-6">
                    <label>LinkedIn</label>
                    <input type="text" name="linkedin" class="form-control" value="<?php echo e($settings['linkedin']??null); ?>">
                  </div>

                  <div class="form-group col-6">
                    <label>Instagram</label>
                    <input type="text" name="instagram" class="form-control" value="<?php echo e($settings['instagram']??null); ?>">
                  </div>

                  <div class="form-group col-6">
                    <label>Dribble</label>
                    <input type="text" name="dribble" class="form-control" value="<?php echo e($settings['dribble']??null); ?>">
                  </div>
                </div>

                <button class="btn btn-primary">Submit</button>
              </form>
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

<?php echo $__env->make('layout.mainlayout_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/a/alexstrilby/ayrveda/resources/views/admin/settings.blade.php ENDPATH**/ ?>