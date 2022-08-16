<?php $__env->startSection('content'); ?>
  <!-- Page Wrapper -->
  <div class="page-wrapper">
    <div class="content container-fluid">

      <!-- Page Header -->
      <div class="page-header">
        <div class="row">
          <div class="col">
            <h3 class="page-title">Online Store</h3>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
              <li class="breadcrumb-item active">Online Store</li>
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
                <table class="datatable table table-stripped">
                  <thead>
                  <tr>
                    <th style="width: 5%">Order ID</th>
                    <th style="width: 5%">Patient</th>
                    <th>Order</th>
                    <th style="width: 5%">Total Price</th>
                    <th style="width: 150px">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                    $order->order_data = json_decode($order->order_data);

                    $user = App\User::find($order->user_id);
                    $profile = $user->patientProfile()->first();

                    if ($profile->first_name ?? false and $profile->last_name ?? false and $profile->patronymic ?? false) {
                      $name = $profile->first_name . ' ' . mb_substr($profile->patronymic, 0, 1) . '. ' . $profile->last_name;
                    } else {
                      $name = $user->name ?? 'Not found';
                    }
                    ?>
                    <tr>
                      <td><?php echo e($order->id); ?></td>
                      <td><a target="_blank" href="<?php echo e(route('admin.patient-profile', ['id' => $user->id])); ?>"><?php echo e($name); ?></a></td>
                      <td>
                        <?php $__currentLoopData = $order->order_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$order_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                              <a target="_blank" href="<?php echo e(route('store.medicine', ['id' => $order_item->product_id])); ?>">
                                <div class="avatar">
                                  <?php if($medicine??false): ?>
                                    <img src="<?php echo e(Storage::url($medicine->image)); ?>" alt="">
                                  <?php endif; ?>
                                </div>
                              </a>
                              <a target="_blank" class="ml-2" href="<?php echo e(route('store.medicine', ['id' => $order_item->product_id])); ?>"><?php echo e($order_item->product_name); ?></a>
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
                        <?php echo e($order->order_data->total_price); ?>

                      </td>
                      <td>
                        <div class="d-flex flex-wrap">
                          <span class="mb-2"><?php echo e(\App\Http\Controllers\Store\StoreController::status($order->status)); ?></span>
                          <div class="flex-break"></div>
                          <?php if($order->status != -1 and $order->status != 1): ?>
                            <form action="<?php echo e(route('admin.online-store.next')); ?>" method="Post">
                              <?php echo csrf_field(); ?>
                              <input type="hidden" name="dismiss" value="0">
                              <input type="hidden" name="id" value="<?php echo e($order->id); ?>">
                              <button class="btn btn-success mr-1"><i class="fa fa-check"></i></button>
                            </form>
                          <?php endif; ?>
                          <a href="tel:<?php echo e($user->phone); ?>" class="btn btn-primary"><i class="fa fa-phone"></i></a>
                          <?php if($order->status != -1 and $order->status != 1): ?>
                            <form action="<?php echo e(route('admin.online-store.next')); ?>" method="Post">
                              <?php echo csrf_field(); ?>
                              <input type="hidden" name="dismiss" value="1">
                              <input type="hidden" name="id" value="<?php echo e($order->id); ?>">
                              <button class="btn btn-danger ml-1"><i class="fa fa-times"></i></button>
                            </form>
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
      </div>
    </div>
  </div>
  <!-- /Page Wrapper -->

  </div>
  <!-- /Main Wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.mainlayout_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH W:\domains\docure\resources\views/admin/online-store/online-store.blade.php ENDPATH**/ ?>