<?php $__env->startSection('head-data'); ?>
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  

  

  <!-- Medicine Features -->
  <section class="section section-features pt-0">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 mb-4 mt-4">
          <div class="section-header">
            <a class="btn btn-primary" href="<?php echo e(route('store')); ?>"><?php echo e(__('regular.go_to_store')); ?></a>

            <h2><?php echo e(__('regular.land_header')); ?></h2>
          </div>
          <div class="features-slider slider">
            <!-- Slider Items -->
            
            <?php $__currentLoopData = \App\MedicineList::limit(50)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $medicine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="profile-widget">
                <div class="doc-img">
                  <a href="<?php echo e(route('store.medicine', ['id' => $medicine->id])); ?>">
                    <img class="img-fluid" alt="User Image" src="<?php echo e(Storage::url($medicine->image??'')); ?>">
                  </a>
                </div>
                <div class="pro-content">
                  <h3 class="title">
                    <a href="<?php echo e(route('store.medicine', ['id' => $medicine->id])); ?>"><?php echo e($medicine->name??null); ?></a>
                    <i class="fas fa-check-circle verified"></i>
                  </h3>
                  <ul class="available-info">
                    <li>
                      <p class="card-text">
                        <?php if(strlen($medicine->description) < 100): ?>
                          <?php echo e($medicine->description); ?>

                        <?php else: ?>
                          <?php echo e(mb_substr($medicine->description, 0,100).'...'); ?>

                        <?php endif; ?>
                      </p>
                    </li>
                    <li>
                      <i class="far fa-money-bill-alt"></i> <?php echo e($medicine->price); ?>$
                    </li>
                  </ul>
                  <div class="row row-sm">
                    <div class="col-6">
                      <a href="<?php echo e(route('store.medicine', ['id' => $medicine->id])); ?>"
                         class="btn view-btn"><?php echo e(__('regular.view_more')); ?></a>
                    </div>
                    <?php if(auth()->guard()->check()): ?>
                      <?php if(auth()->user()->hasrole('Patient')): ?>
                        <div class="col-6">
                          <form action="<?php echo e(route('cart.add')); ?>" method="Post">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="type" value="medicine">
                            <input type="hidden" name="id" value="<?php echo e($medicine->id); ?>">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn view-btn"><i
                                class="fas fa-cart-plus"></i></button>
                          </form>
                        </div>
                      <?php endif; ?>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <!-- /Slider Items -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /Medicine Features -->

  <!-- Our Doctors Section -->
  <section class="section section-doctor">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-4">
          <div class="section-header ">
            <h2><?php echo e(__('regular.all_our_doctors')); ?></h2>
          </div>
          <div class="about-content">
            <a href="<?php echo e(route('doctors-list')); ?>"><?php echo e(__('regular.view_more')); ?>...</a>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="doctor-slider slider">
            <!-- Doctor Widgets -->
            <?php ($doctors = \App\User::role('Doctor')->where('active', true)->get()); ?>
            <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
              $doc_profile = $doctor->doctorProfile()->first();

              if ($doc_profile->photo ?? false) {
                $photo = Storage::url($doc_profile->photo);
              } else {
                $photo = '/assets/img/doctors/doctor-01.jpg';
              }

              $name = \App\User::userNameFormat($doctor);
              ?>
              <div class="profile-widget">
                <div class="doc-img">
                  <a href="<?php echo e(route('doctor-profile', ['id' => $doctor->id])); ?>">
                    <img class="img-fluid" alt="User Image" src="<?php echo e($photo??null); ?>">
                  </a>
                </div>
                <div class="pro-content">
                  <h3 class="title">
                    <a href="<?php echo e(route('doctor-profile', ['id' => $doctor->id])); ?>"><?php echo e($name??null); ?></a>
                    <i class="fas fa-check-circle verified"></i>
                  </h3>
                  <p class="speciality"><?php echo e($doc_profile->clinic_name??null); ?></p>
                  <ul class="available-info">
                    <?php if($doc_profile->clinic_address??false): ?>
                      <li>
                        <i class="fas fa-map-marker-alt"></i> <?php echo e($doc_profile->clinic_address); ?>

                      </li>
                    <?php endif; ?>
                    <li>
                      <i class="fa fa-phone"></i> <?php echo e($doctor->phone??null); ?></li>
                    </li>
                    <?php if($doc_profile->price??false): ?>
                      <li>
                        <i class="far fa-money-bill-alt"></i> <?php echo e($doc_profile->price); ?>

                      </li>
                    <?php endif; ?>
                  </ul>
                  <div class="row row-sm">
                    <div class="col-6">
                      <a href="<?php echo e(route('doctor-profile', ['id' => $doctor->id])); ?>"
                         class="btn view-btn"><?php echo e(__('regular.view_more')); ?></a>
                    </div>
                    <div class="col-3">
                      <a href="tel:<?php echo e($doctor->phone??null); ?>" class="btn view-btn">
                        <i class="fas fa-phone"></i>
                      </a>
                    </div>
                    <div class="col-3">
                      <a href="<?php echo e(route('chat', ['id' => 'D'.$doctor->id])); ?>" class="btn view-btn">
                        <i class="far fa-comment-alt"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <!-- /Doctor Widgets -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /Our Doctors Section -->

  <!-- Chat Section -->
  <section id="app">
    <support-chat ref="supportChat"></support-chat>
  </section>
  <!-- /Chat Section -->

  </div>
  <!-- /Main Wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/a/alexstrilby/ayrveda/resources/views/index.blade.php ENDPATH**/ ?>