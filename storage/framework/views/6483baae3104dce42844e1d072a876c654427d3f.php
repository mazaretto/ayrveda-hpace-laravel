<?php $__env->startSection('content'); ?>
  <!-- Breadcrumb -->
  <div class="breadcrumb-bar">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-md-12 col-12">
          <nav aria-label="breadcrumb" class="page-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('header.home')); ?></a></li>
              <li class="breadcrumb-item active"
                  aria-current="page"><?php echo e(__('patient_nav.purchase_history')); ?></li>
            </ol>
          </nav>
          <h2 class="breadcrumb-title"><?php echo e(__('patient_nav.purchase_history')); ?></h2>
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
            <div class="card-body">
              <div class="card card-table mb-0">
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-center mb-0">
                      <thead>
                      <tr>
                        <th class="col-10"><?php echo e(__('cart.order_details')); ?></th>
                        <th class="col-1"><?php echo e(__('cart.total_price')); ?></th>
                        <th class="col-1"><?php echo e(__('cart.order_status')); ?></th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php $__currentLoopData = $purchases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php ($purchase->order_data = json_decode($purchase->order_data)); ?>
                        <tr>
                          <td>
                            <?php $__currentLoopData = $purchase->order_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$order_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <?php if($key == 'total_price'): ?>
                                <?php continue; ?>
                              <?php endif; ?>
                              <?php
                              if ($order_item->type == 'medicine') {
                                $medicine = \App\MedicineList::find($order_item->product_id);
                              }
                              ?>
                              <div class="row mb-3">
                                <div class="col-12 d-flex">
                                  <a href="<?php echo e(route('store.medicine', ['id' => $order_item->product_id])); ?>">
                                    <div class="avatar">
                                      <?php if($medicine??false): ?>
                                        <img src="<?php echo e(Storage::url($medicine->image)); ?>" alt="">
                                      <?php endif; ?>
                                    </div>
                                  </a>
                                  <h4 class="ml-2 d-flex align-items-center"><a
                                      href="<?php echo e(route('store.medicine', ['id' => $order_item->product_id])); ?>"><?php echo e($order_item->product_name); ?></a></h4>
                                  <div class="table-responsive mx-5">
                                    <table class="table table-hover table-center mb-0">
                                      <thead>
                                      <tr>
                                        <th class="py-0 px-2" style="width: 33.33333%">Price</th>
                                        <th class="py-0 px-2" style="width: 33.33333%">Quantity</th>
                                        <th class="py-0 px-2" style="width: 33.33333%">Total</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <tr>
                                        <td class="py-0 px-2" style="width: 33.33333%"><?php echo e($order_item->product_price); ?></td>
                                        <td class="py-0 px-2" style="width: 33.33333%"><?php echo e($order_item->quantity); ?></td>
                                        <td class="py-0 px-2" style="width: 33.33333%"><?php echo e($order_item->product_total); ?></td>
                                      </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </td>
                          <td>
                            <?php echo e($purchase->order_data->total_price); ?>

                          </td>
                          <td><?php echo e(\App\Http\Controllers\Store\StoreController::status($purchase->status)); ?></td>
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

    </div>

  </div>
  <!-- /Page Content -->
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH W:\domains\docure\resources\views/patient/purchase-history.blade.php ENDPATH**/ ?>