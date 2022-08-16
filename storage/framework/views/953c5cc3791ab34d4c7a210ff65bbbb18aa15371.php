<?php $__env->startSection('content'); ?>
  <!-- Breadcrumb -->
  <div class="breadcrumb-bar">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-md-12 col-12">
          <nav aria-label="breadcrumb" class="page-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('header.home')); ?></a></li>
              <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('header.online-store')); ?></li>
            </ol>
          </nav>
          <h2 class="breadcrumb-title"><?php echo e(__('header.online-store')); ?></h2>
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
          <form class="profile-sidebar pro-widget-content text-left" method="Get">
            <div class="filter-content">
              <h4>Price</h4>
              <div class="form-group d-flex">
                <input type="text" class="form-control filter-price-range-min" name="price-min"
                       value="<?php echo e(request()->get('price-min')??'0'); ?>">
                <input type="text" class="form-control filter-price-range-max" name="price-max"
                       value="<?php echo e(request()->get('price-max')??($max_price??100)); ?>">
              </div>
              <div class="filter-price-range" data-init-min="<?php echo e(request()->get('price-min')??0); ?>"
                   data-init-max="<?php echo e(request()->get('price-max')??($max_price??100)); ?>"
                   data-max="<?php echo e($max_price??100); ?>"></div>
            </div>
            <div class="filter-content">
              <h4>Manufacturer</h4>
              <ul class="d-flex flex-column pl-2 m-0">
                <?php $__currentLoopData = $manufacters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manufacter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <label>
                    <input type="checkbox" name="manufacter[]"
                           value="<?php echo e($manufacter); ?>" <?php echo e((in_array($manufacter, request()->get('manufacter')??[]))?'checked':null); ?>>
                    <?php echo e($manufacter); ?>

                  </label>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
            </div>
            <div class="filter-content">
              <h4>Diseases</h4>
              <ul class="d-flex flex-column pl-2 m-0">
                <?php $__currentLoopData = $diseases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $disease): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <label>
                    <input type="checkbox" name="disease[]"
                           value="<?php echo e($disease); ?>" <?php echo e((in_array($disease, request()->get('disease')??[]))?'checked':null); ?>>
                    <?php echo e($disease); ?>

                  </label>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
            </div>

            <button class="btn btn-primary"><?php echo e(__('regular.search')); ?></button>
            <a href="<?php echo e(route('store')); ?>" class="btn btn-primary">Reset filters</a>
          </form>
          <!-- /Profile Sidebar -->

        </div>

        <div class="col-md-7 col-lg-8 col-xl-9">
          <div class="row">
            <div class="col-12 d-flex flex-wrap">
              <?php
              if(auth()->check()){
                $prescriptions = auth()->user()->prescription()->pluck('medicine_id')->toArray();
              }
              ?>
              <?php $__currentLoopData = $medicines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $medicine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-12 col-sm-6 col-md-12 col-lg-4 col-xl-3">
                  <div class="card store-card <?php echo e((in_array($medicine->id, $prescriptions ?? [])?'prescription':null)); ?>">
                    <a href="<?php echo e(route('store.medicine', ['id' => $medicine->id])); ?>"><img
                        src="<?php echo e(Storage::url($medicine->image??'')); ?>" class="card-img-top"
                        alt="Feature"></a>
                    <div class="card-body">
                      <a class="card-title font-weight-bold text-lg d-block mb-1"
                         href="<?php echo e(route('store.medicine', ['id' => $medicine->id])); ?>"><?php echo e($medicine->name); ?></a>
                      <p class="card-text"><?php echo e($medicine->description); ?></p>
                      <p class="card-text"><?php echo e($medicine->price); ?></p>
                      <div class="d-flex">
                        <a href="<?php echo e(route('store.medicine', ['id' => $medicine->id])); ?>"
                           class="btn btn-primary mr-2">View More</a>
                        <?php if(auth()->guard()->check()): ?>
                          <?php if(auth()->user()->hasrole('Patient')): ?>
                            <form action="<?php echo e(route('cart.add')); ?>" method="Post">
                              <?php echo csrf_field(); ?>
                              <input type="hidden" name="type" value="medicine">
                              <input type="hidden" name="id" value="<?php echo e($medicine->id); ?>">
                              <input type="hidden" name="quantity" value="1">
                              <button type="submit" class="btn btn-secondary"><i
                                  class="fas fa-cart-plus"></i></button>
                            </form>
                          <?php endif; ?>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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


<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH W:\domains\docure\resources\views/store/online-store.blade.php ENDPATH**/ ?>