<?php $page = "search1";?>

<?php $__env->startSection('content'); ?>
    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Doctors List</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">Doctors List</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <div class="container">

            <div class="row">
                <div class="col-12">

                <?php $__currentLoopData = $doctors??[]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <!-- Doctor Widget -->
                        <div class="card">
                            <div class="card-body">
                                <?php
                                $profile = $user->doctorProfile()->first();

                                if ((($profile->first_name ?? null) !== null) and (($profile->last_name ?? null) !== null) and (($profile->patronymic ?? null) !== null)) {
                                    $name = 'Dr. ' . $profile->first_name . ' ' . mb_substr($profile->patronymic, 0, 1) . '. ' . $profile->last_name;
                                } else {
                                    $name = 'Dr. ' . $user->name;
                                }

                                ?>
                                <div class="doctor-widget">
                                    <div class="doc-info-left">
                                        <div class="doctor-img">
                                            <a href="<?php echo e(route('doctor-profile', ['id'=>$user->id])); ?>">
                                                <img
                                                    src="<?php echo e(($profile->photo??null)!==null?Storage::url($profile->photo):'/assets/img/doctors/doctor-thumb-01.jpg'); ?>"
                                                    class="img-fluid" alt="User Image">
                                            </a>
                                        </div>
                                        <div class="doc-info-cont">
                                            <h4 class="doc-name"><a
                                                    href="<?php echo e(route('doctor-profile', ['id'=>$user->id])); ?>"><?php echo e($name); ?></a>
                                            </h4>
                                            <p class="doc-speciality"><?php echo e($profile->clinic_name??null); ?></p>
                                            <h5 class="doc-department">
                                                <?php $__currentLoopData = explode(',',$profile->specialist??null); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $str): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($loop->last): ?>
                                                        <?php echo e($str); ?>

                                                    <?php else: ?>
                                                        <?php echo e($str.', '); ?>

                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </h5>
                                            <div class="clinic-details">
                                                <?php if($profile->clinic_address??false): ?>
                                                <p class="doc-location"><i
                                                        class="fas fa-map-marker-alt"></i> <?php echo e($profile->clinic_address??null); ?>

                                                </p>
                                                <?php endif; ?>
                                                <ul class="clinic-gallery">
                                                    <?php if($profile->clinic_pics??null): ?>
                                                        <?php $__currentLoopData = explode(',', $profile->clinic_pics); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <li>
                                                                <a href="<?php echo e(Storage::url($pic)); ?>"
                                                                   data-fancybox="gallery">
                                                                    <img src="<?php echo e(Storage::url($pic)); ?>" alt="Feature">
                                                                </a>
                                                            </li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php else: ?>
                                                        <li>
                                                            <a href="/assets/img/features/feature-01.jpg"
                                                               data-fancybox="gallery">
                                                                <img src="/assets/img/features/feature-01.jpg"
                                                                     alt="Feature">
                                                            </a>
                                                        </li>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
                                            <?php if($profile->services??false): ?>
                                            <div class="clinic-services">
                                                <?php $__currentLoopData = explode(',', $profile->services??null); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <span><?php echo e($serv); ?></span>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="doc-info-right">
                                        <div class="clini-infos">
                                            <ul>
                                                <li>
                                                    <i class="fas fa-map-marker-alt"></i> <?php echo e($profile->clinic_address??null); ?>

                                                </li>
                                                <li><i class="far fa-money-bill-alt"></i> <?php echo e($profile->price??null); ?></li>
                                                <li><i class="fa fa-phone"></i> <?php echo e($user->phone??null); ?></li>
                                                <li><i class="fa fa-birthday-cake"></i> <?php echo e($profile->birth??null); ?></li>
                                                <li><i class="far fa-user"></i>
                                                    <?php if(($profile->gender??false) == 'male'): ?>
                                                        Male
                                                    <?php elseif(($profile->gender??false) == 'female'): ?>
                                                        Female
                                                    <?php endif; ?>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="clinic-booking">
                                            <a class="view-pro-btn"
                                               href="<?php echo e(route('doctor-profile', ['id'=>$user->id])); ?>">View Profile</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Doctor Widget -->
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

        </div>

    </div>
    <!-- /Page Content -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH W:\domains\docure\resources\views/doctors-list.blade.php ENDPATH**/ ?>