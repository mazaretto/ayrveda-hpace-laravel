<?php $__env->startSection('content'); ?>
  <!-- Breadcrumb -->
  <div class="breadcrumb-bar">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-md-12 col-12">
          <nav aria-label="breadcrumb" class="page-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('header.home')); ?></a></li>
              <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('patient_nav.cart')); ?></li>
            </ol>
          </nav>
          <h2 class="breadcrumb-title"><?php echo e(__('patient_nav.cart')); ?></h2>
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
              <?php if($cart['medicine']??false): ?>
                <div class="card card-table mb-0">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-hover table-center mb-0">
                        <thead>
                        <tr>
                          <th class="avatar-xl"></th>
                          <th><?php echo e(__('cart.name')); ?></th>
                          <th><?php echo e(__('cart.price')); ?></th>
                          <th><?php echo e(__('cart.quantity')); ?></th>
                          <th><?php echo e(__('cart.total_price')); ?></th>
                          <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $cart['medicine']??[]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php
                          $medicine = \App\MedicineList::find($cart_item['id']);
                          ?>
                          <?php if(!$medicine): ?>
                            <?php continue; ?>
                          <?php endif; ?>
                          <tr>
                            <td>
                              <a target="_blank" href="<?php echo e(route('store.medicine', ['id' => $medicine->id])); ?>">
                                <div class="avatar avatar-xl">
                                  <img class="" src="<?php echo e(Storage::url($medicine->image)); ?>"
                                       alt="">
                                </div>
                              </a>
                            </td>
                            <td>
                              <a target="_blank" href="<?php echo e(route('store.medicine', ['id' => $medicine->id])); ?>">
                                <?php echo e($medicine->name); ?>

                              </a>
                            </td>
                            <td>
                              <span class="cart-price"><?php echo e($medicine->price); ?>$</span>
                            </td>
                            <td>
                              <form action="<?php echo e(route('cart.quantity')); ?>" method="Post"
                                    class="d-flex cart-form-quantity">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="type" value="medicine">
                                <input type="hidden" name="id" value="<?php echo e($medicine->id); ?>">
                                <input type="hidden" name="get-quantity" value="<?php echo e(route('cart.total')); ?>">
                                <div class="product-quantity-minus">-</div>
                                <input type="number" name="quantity"
                                       class="product-quantity form-control"
                                       value="<?php echo e($cart_item['quantity']); ?>" min="1" max="999">
                                <div class="product-quantity-plus">+</div>
                              </form>
                            </td>
                            <td>
                              <span class="total-price cart-total-price"></span>
                            </td>
                            <td>
                              <form action="<?php echo e(route('cart.remove')); ?>" method="Post"
                                    class="cart-form-remove">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="type" value="medicine">
                                <input type="hidden" name="id" value="<?php echo e($medicine->id); ?>">
                                <button type="submit" class="btn btn-danger"><i
                                    class="fas fa-times"></i></button>
                              </form>
                            </td>
                          </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td></td>
                          <td><h3><?php echo e(__('cart.total')); ?>:</h3></td>
                          <td></td>
                          <td>
                            <h3 class="cart-quantity-total"><?php echo e(\App\Http\Controllers\Store\CartController::total()); ?></h3>
                          </td>
                          <td><h3 class="cart-price-total"></h3></td>
                          <td></td>
                        </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

                <div class="row mt-4 justify-content-end m-0">
                  <a class="btn btn-primary" href="<?php echo e(route('patient.cart.details')); ?>"><?php echo e(__('cart.proceed')); ?></a>
                </div>
              <?php else: ?>
                <h4><?php echo e(__('cart.no_data')); ?></h4>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>
  <!-- /Page Content -->
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/a/alexstrilby/ayrveda/resources/views/patient/cart.blade.php ENDPATH**/ ?>