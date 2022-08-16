<?php
$profile = auth()->user()->patientProfile()->first();
?>
<div class="widget-profile pro-widget-content">
  <div class="profile-info-widget">
    <div class="booking-doc-img">
      <img
        src="<?php echo e((isset($profile->photo))?Storage::url($profile->photo):'/assets/img/patients/patient.jpg'); ?>"
        alt="User Image">
    </div>
    <div class="profile-det-info">
      <?php
      $profile_name = \App\User::userNameFormat(auth()->user());
      ?>
      <h3><?php echo e($profile_name); ?></h3>
      <div class="patient-details">
        <?php
        if (isset($profile->birth)) {
          $birth = date('F j Y', strtotime($profile->birth));

          $date = new DateTime($profile->birth);
          $now = new DateTime();
          $interval = $now->diff($date);
          $birth .= ', ' . $interval->y . ' years';
        } else {
          $birth = '';
        }
        ?>
        <h5><i class="fas fa-birthday-cake"></i> <?php echo e($birth); ?></h5>
        <?php
        if (isset($profile->country) and isset($profile->city)) {
          $location = $profile->city . ', ' . $profile->country;
        } else {
          $location = '';
        }
        ?>
        <h5 class="mb-0"><i class="fas fa-map-marker-alt"></i> <?php echo e($location); ?></h5>
      </div>
    </div>
  </div>
</div>
<?php /**PATH /home/a/alexstrilby/ayrveda/resources/views/patient/regular/profile-info.blade.php ENDPATH**/ ?>