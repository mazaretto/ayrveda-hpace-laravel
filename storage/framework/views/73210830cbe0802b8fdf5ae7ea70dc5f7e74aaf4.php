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
        <?php
            if ((($profile->first_name ?? null) !== null) and (($profile->last_name ?? null) !== null) and (($profile->patronymic ?? null) !== null)) {
                $name = 'Dr. '.$profile->first_name . ' ' . mb_substr($profile->patronymic, 0 ,1). '. ' . $profile->last_name;
            } else {
                $name = $user->name;
            }
        ?>
            <h3><?php echo e($name); ?></h3>

            <div class="patient-details">
                <h5 class="mb-0"><?php echo e($profile->clinic_name??''); ?></h5>
            </div>
        </div>
    </div>
</div>
<?php /**PATH W:\domains\docure\resources\views/doctor/regular/info.blade.php ENDPATH**/ ?>