<?php $__env->startSection('content'); ?>
  <!-- Breadcrumb -->
  <div class="breadcrumb-bar">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-md-12 col-12">
          <nav aria-label="breadcrumb" class="page-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('header.home')); ?></a></li>
              <li class="breadcrumb-item"><a href="<?php echo e(route('store')); ?>"><?php echo e(__('header.online-store')); ?></a></li>
              <li class="breadcrumb-item active" aria-current="page"><?php echo e($medicine->name); ?></li>
            </ol>
          </nav>
          <h2 class="breadcrumb-title"><?php echo e($medicine->name); ?></h2>
        </div>
      </div>
    </div>
  </div>
  <!-- /Breadcrumb -->

  <!-- Page Content -->
  <div class="content">
    <div class="container">
      <!-- Medicine Widget -->
      <div class="card">
        <div class="card-body d-flex flex-wrap">
          <div class="row">
            <div class="col-12 col-md-4">
              <a href="<?php echo e(Storage::url($medicine->image)); ?>" data-fancybox="gallery">
                <img class="img-fluid" src="<?php echo e(Storage::url($medicine->image)); ?>" alt="">
              </a>
              <div class="clinic-details my-2">
                <ul class="clinic-gallery">
                  <?php $__currentLoopData = explode(',', $medicine->gallery); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($image): ?>
                      <li>
                        <a href="<?php echo e(Storage::url($image)); ?>" class="avatar avatar-lg" data-fancybox="gallery">
                          <img src="<?php echo e(Storage::url($image)); ?>" class="avatar-img rounded" alt="">
                        </a>
                      </li>
                    <?php else: ?>
                      <?php
                      $medicine->gallery = mb_substr($medicine->gallery, 1);
                      $medicine->save();
                      ?>
                    <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
              </div>
            </div>
            <div class="col-12 col-md-8 mt-5 mt-md-0">
              <h2><?php echo e($medicine->name); ?></h2>

              <p><?php echo e($medicine->description); ?></p>

              <?php if($medicine->manufacter): ?>
                <p><b><?php echo e(__('regular.manufacturer')); ?>:</b> <?php echo e($medicine->manufacter); ?></p>
              <?php endif; ?>
              <?php if($medicine->manufacter_address): ?>
                <p><b><?php echo e(__('regular.manufacturer_address')); ?>:</b> <?php echo e($medicine->manufacter_address); ?></p>
              <?php endif; ?>
              <?php if($medicine->manufacter_phone): ?>
                <p><b><?php echo e(__('regular.manufacturer_phone')); ?>:</b> <?php echo e($medicine->manufacter_phone); ?></p>
              <?php endif; ?>
              <p><b><?php echo e(__('cart.price')); ?>:</b> <?php echo e($medicine->price); ?>$</p>

              <?php if(auth()->guard()->guest()): ?>
                <button class="btn btn-primary">You have to be Patient to buy</button>
              <?php endif; ?>
              <?php if(auth()->guard()->check()): ?>
                <?php if(auth()->user()->hasRole('Patient')): ?>
                  <form action="<?php echo e(route('cart.add')); ?>" method="Post" class="d-flex">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="type" value="medicine">
                    <input type="hidden" name="id" value="<?php echo e($medicine->id); ?>">
                    <div class="d-flex">
                      <div class="product-quantity-minus">-</div>
                      <input type="number" name="quantity" class="product-quantity form-control" value="1" min="1" max="999">
                      <div class="product-quantity-plus">+</div>
                    </div>
                    <button class="btn btn-primary"><?php echo e(__('cart.add_to_cart')); ?></button>
                  </form>
                <?php endif; ?>
              <?php endif; ?>
            </div>
          </div>

          <div class="row mt-5 w-100">
            <div class="col-12 col-sm-6 col-lg-3">
              <div class="product-list">
                <h4><?php echo e(__('regular.composition')); ?></h4>
                <ul>
                  <?php $__currentLoopData = explode('\,/',$medicine->sostav); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($item); ?></li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
              <div class="product-list">
                <h4><?php echo e(__('regular.dosage')); ?></h4>
                <ul>
                  <?php $__currentLoopData = explode('\,/',$medicine->doz); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($item); ?></li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
              <div class="product-list">
                <h4><?php echo e(__('regular.contraindications')); ?></h4>
                <ul>
                  <?php $__currentLoopData = explode('\,/',$medicine->protiv); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($item); ?></li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
              <div class="product-list">
                <h4><?php echo e(__('regular.diseases')); ?></h4>
                <ul>
                  <?php $__currentLoopData = explode('\,/',$medicine->diseases); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($item); ?></li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /Medicine Widget -->
    </div>
  </div>
  <!-- /Page Content -->
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/a/alexstrilby/ayrveda/resources/views/store/medicine-single.blade.php ENDPATH**/ ?>