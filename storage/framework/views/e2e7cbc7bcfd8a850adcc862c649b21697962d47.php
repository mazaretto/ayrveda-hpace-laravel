<?php $__env->startSection('meta'); ?>
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <!-- Page Wrapper -->
  <div class="page-wrapper" id="app">
    <div class="content container-fluid">

      <!-- Page Header -->
      <div class="page-header">
        <div class="row">
          <div class="col-sm-12">
            <h3 class="page-title">Support</h3>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
              <li class="breadcrumb-item active">Support</li>
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
                    <th style="width: 50px">Token</th>
                    <th>Last Message</th>
                    <th>Sent At</th>
                    <th style="width: 50px"></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $__currentLoopData = $supports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $support): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td><?php echo e($support->id); ?></td>
                      <td>
                        <?php if($support->last_message->send_to !== 'support'): ?>
                          <b>(Support)</b>
                        <?php endif; ?>
                        <?php if(strlen($support->last_message->data) > 50): ?>
                          <?php echo e(mb_substr($support->last_message->data, 0, 50)); ?>...
                        <?php else: ?>
                          <?php echo e($support->last_message->data); ?>

                        <?php endif; ?>
                      </td>
                      <td><?php echo e(date('j M Y, G:i:s', strtotime($support->created_at))); ?></td>
                      <td class="d-flex">
                        <support-load :token="<?php echo e($support->id); ?>"></support-load>
                        <form action="<?php echo e(route('admin.support.delete')); ?>" method="Post">
                          <?php echo csrf_field(); ?>
                          <input type="hidden" name="id" value="<?php echo e($support->id); ?>">
                          <button type="submit" class="btn btn-danger"><i class="fe fe-close"></i></button>
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
    <support-chat-support ref="supportChat" active="false" url-get="<?php echo e(route('admin.support.token')); ?>" url-post="<?php echo e(route('admin.support.send')); ?>"></support-chat-support>
    </div>
  </div>
  <!-- /Page Wrapper -->

  </div>
  <!-- /Main Wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.mainlayout_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/a/alexstrilby/ayrveda/resources/views/admin/support.blade.php ENDPATH**/ ?>