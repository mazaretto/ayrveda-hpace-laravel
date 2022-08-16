<?php $__env->startSection('content'); ?>

    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('header.home')); ?></a></li>
                            <li class="breadcrumb-item active"
                                aria-current="page"><?php echo e(__('doctor_nav.my_patients')); ?></li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title"><?php echo e(__('doctor_nav.my_patients')); ?></h2>
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
                    <div class="profile-sidebar">
                        <?php echo $__env->make('doctor.regular.info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('doctor.regular.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <!-- /Profile Sidebar -->

                </div>

                <div class="col-md-7 col-lg-8 col-xl-9">
                    <div class="row row-grid">
                        <?php if($patients??false): ?>
                            <?php $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                if (!$patient->email??true) {
                                    $patient = \App\User::find($patient->user_id);
                                }
                                $profile = $patient->patientProfile()->first();

                                if (($profile->first_name ?? null) !== null and ($profile->last_name ?? null) !== null and ($profile->patronymic ?? null) !== null) {
                                    $name = $profile->first_name . ' ' . mb_substr($profile->last_name, 0, 1) . '. ' . $profile->patronymic;
                                } else {
                                    $name = $patient->name;
                                }

                                if (($profile->country ?? null) !== null and ($profile->city ?? null) !== null) {
                                    $location = $profile->city . ', ' . $profile->country;
                                }
                                ?>
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="card widget-profile pat-widget-profile">
                                        <div class="card-body">
                                            <div class="pro-widget-content">
                                                <div class="profile-info-widget">
                                                    <a href="<?php echo e(route('doctor.my-patient', ['id' => $patient->id])); ?>"
                                                       class="booking-doc-img">
                                                        <img
                                                            src="<?php echo e(($profile->photo??null)!==null ? Storage::url($profile->photo) : '/assets/img/patients/patient.jpg'); ?>"
                                                            alt="User Image">
                                                    </a>
                                                    <div class="profile-det-info">
                                                        <h3>
                                                            <a href="<?php echo e(route('doctor.my-patient', ['id' => $patient->id])); ?>"><?php echo e($name); ?></a>
                                                        </h3>

                                                        <div class="patient-details">
                                                            <h5><b><?php echo e(__('regular.patient-id')); ?>:</b> P<?php echo e($patient->id); ?></h5>
                                                            <h5 class="mb-0"><i
                                                                    class="fas fa-map-marker-alt"></i> <?php echo e($location??'Unknown'); ?>

                                                            </h5>
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
                                                    <li><?php echo e(__('regular.phone')); ?> <span><?php echo e($patient->phone??'Not set'); ?></span></li>
                                                    <li><?php echo e(__('regular.age')); ?> <span><?php echo e($birth??'Not set'); ?>, <?php echo e($profile->gender ?? 'Not set'); ?></span>
                                                    </li>
                                                    <li><?php echo e(__('regular.blood-group')); ?> <span><?php echo e($profile->blood_group??'Not set'); ?></span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>

                </div>
            </div>

        </div>

    </div>
    <!-- /Page Content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH W:\domains\docure\resources\views/doctor/my-patients.blade.php ENDPATH**/ ?>