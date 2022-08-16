<div class="card widget-profile pat-widget-profile">
  <div class="card-body">
    <div class="pro-widget-content">
      <div class="profile-info-widget">
        <a href="#" class="booking-doc-img">
          <img
            src="<?php echo e(($profile->photo??null) !== null ? Storage::url($profile->photo) : '/assets/img/patients/patient.jpg'); ?>"
            alt="User Image">
        </a>
        <div class="profile-det-info">
          <?php
          if ((($profile->first_name ?? null) !== null) and (($profile->last_name ?? null) !== null) and (($profile->patronymic ?? null) !== null)) {
            $name = $profile->first_name . ' ' . mb_substr($profile->patronymic, 0, 1) . '. ' . $profile->last_name;
          } else {
            $name = $user->name;
          }
          if (($profile->country ?? null) !== null and ($profile->city ?? null) !== null) {
            $location = $profile->city . ', ' . $profile->country;
          }
          ?>
          <h3><?php echo e($name); ?></h3>

          <div class="patient-details">
            <h5><b><?php echo e(__('regular.patient-id')); ?> :</b> P<?php echo e($user->id); ?></h5>
            <h5 class="mb-0"><i class="fas fa-map-marker-alt"></i> <?php echo e($location??'Not set'); ?></h5>
          </div>
        </div>
      </div>
    </div>
    <div class="patient-info">
      <?php
      if ($profile->birth ?? false) {
        $birth = date('F j Y', strtotime($profile->birth));

        $date = new DateTime($profile->birth);
        $now = new DateTime();
        $interval = $now->diff($date);
        $birth = $interval->y . ' years';
      }
      ?>
      <ul>
        <li><?php echo e(__('regular.phone')); ?> <span><?php echo e($user->phone??'Not set'); ?></span></li>
        <li><?php echo e(__('regular.age')); ?> <span><?php echo e($birth??'Not set'); ?>, <?php echo e($profile->gender??'Not set'); ?></span></li>
        <li><?php echo e(__('regular.blood-group')); ?> <span><?php echo e($profile->blood_group??'Not set'); ?></span></li>
      </ul>

      <?php ($diseases = $user->patientDiseases()->first()); ?>
      <?php if($diseases): ?>
        <?php ($diseases = explode(',', $diseases->data)); ?>
        <ul class="mt-3 pt-3 border-top">
          <?php $__currentLoopData = $diseases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $disease): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><b><?php echo e($disease); ?></b></li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php /**PATH W:\domains\docure\resources\views/doctor/regular/patients/info.blade.php ENDPATH**/ ?>