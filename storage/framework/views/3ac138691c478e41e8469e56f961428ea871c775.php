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
                                aria-current="page"><?php echo e(__('doctor_nav.social_media')); ?></li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title"><?php echo e(__('doctor_nav.social_media')); ?></h2>
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
                    <div class="card">
                        <div class="card-body">
                            <!-- Social Form -->
                            <form action="<?php echo e(route('doctor.setSocial')); ?>" method="Post">
                                <?php echo csrf_field(); ?>
                                <?php ($social = auth()->user()->social()->first()); ?>
                                <div class="row">
                                    <div class="col-md-12 col-lg-8">
                                        <div class="form-group">
                                            <label>Facebook URL</label>
                                            <input type="text" name="facebook" value="<?php echo e($social->facebook??''); ?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-lg-8">
                                        <div class="form-group">
                                            <label>Twitter URL</label>
                                            <input type="text" name="twitter" value="<?php echo e($social->twitter??''); ?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-lg-8">
                                        <div class="form-group">
                                            <label>Instagram URL</label>
                                            <input type="text" name="instagram" value="<?php echo e($social->instagram??''); ?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-lg-8">
                                        <div class="form-group">
                                            <label>Pinterest URL</label>
                                            <input type="text" name="pinterest" value="<?php echo e($social->pinterest??''); ?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-lg-8">
                                        <div class="form-group">
                                            <label>Linkedin URL</label>
                                            <input type="text" name="linkedin" value="<?php echo e($social->linkedin??''); ?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-lg-8">
                                        <div class="form-group">
                                            <label>Youtube URL</label>
                                            <input type="text" name="youtube" value="<?php echo e($social->youtube??''); ?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="submit-section">
                                    <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                                </div>
                            </form>
                            <!-- /Social Form -->

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- /Page Content -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH W:\domains\docure\resources\views/doctor/social-media.blade.php ENDPATH**/ ?>