<?php $__env->startSection('content'); ?>
  <!-- Breadcrumb -->
  <div class="breadcrumb-bar">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-md-12 col-12">
          <nav aria-label="breadcrumb" class="page-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('header.home')); ?></a></li>
              <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('patient_nav.diseases')); ?></li>
            </ol>
          </nav>
          <h2 class="breadcrumb-title"><?php echo e(__('patient_nav.diseases')); ?></h2>
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
              <form action="<?php echo e(route('patient.diseases-set')); ?>" method="Post">
                <?php echo csrf_field(); ?>
                <?php
                $user_diseases = auth()->user()->patientDiseases()->first();
                $user_diseases = explode(',', $user_diseases->data ?? null);
                ?>
                <?php if($diseases): ?>
                  <?php $__currentLoopData = $diseases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $disease): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="disease-category">
                      <h4 class="diseases-title" onclick="collapse(this)"><i
                          class="fa fa-sort-up collapse-disease"></i> <?php echo e($disease->title); ?></h4>
                      <ul class="diseases-list">
                        <?php $__currentLoopData = $disease->diseases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <li>
                            <label>
                              <input name="data[]" type="checkbox" value="<?php echo e($row); ?>" <?php echo e((in_array($row, $user_diseases)) ? 'checked' : null); ?>>
                              <?php echo e($row); ?>

                            </label>
                          </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </ul>
                    </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <button type="submit" class="btn btn-primary"><?php echo e(__('forms.submit')); ?></button>
                <?php else: ?>
                  <h2>Not seted</h2>
                <?php endif; ?>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>
  <!-- /Page Content -->
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer-script'); ?>
  <script>
    function collapse(element) {
      let el = $(element).find('i.collapse-disease')
      let list = el.closest('.disease-category').find('.diseases-list')
      if (el.hasClass('fa-sort-up')) {
        el.removeClass('fa-sort-up')
        el.addClass('fa-sort-down')
        list.addClass('active')
      } else if (el.hasClass('fa-sort-down')) {
        el.removeClass('fa-sort-down')
        el.addClass('fa-sort-up')
        list.removeClass('active')
      }
    }
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH W:\domains\docure\resources\views/patient/patient-diseases.blade.php ENDPATH**/ ?>