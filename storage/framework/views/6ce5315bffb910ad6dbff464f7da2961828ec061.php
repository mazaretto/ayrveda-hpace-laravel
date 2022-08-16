<?php
$user = auth()->user();
$profile = $user->doctorProfile()->first();
?>
<div class="widget-profile pro-widget-content">
  <div class="profile-info-widget">
    <div class="booking-doc-img">
      <img
        src="<?php echo e((($profile->photo ?? null) !== null) ? Storage::url($profile->photo) : '/assets/img/doctors/doctor-thumb-02.jpg'); ?>"
        alt="User Image">
    </div>
    <div class="profile-det-info">
      <h3><?php echo e(\App\User::userNameFormat($user)); ?></h3>

      <div class="patient-details">
        <h5 class="mb-0"><?php echo e($profile->clinic_name??''); ?></h5>
      </div>
    </div>
  </div>
</div>
<?php /**PATH /home/a/alexstrilby/ayrveda/resources/views/doctor/regular/info.blade.php ENDPATH**/ ?>