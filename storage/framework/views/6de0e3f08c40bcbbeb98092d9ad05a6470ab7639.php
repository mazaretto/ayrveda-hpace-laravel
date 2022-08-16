<?php $__env->startSection('content'); ?>
    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('header.home')); ?></a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('patient_nav.uploaded_files')); ?></li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title"><?php echo e(__('patient_nav.uploaded_files')); ?></h2>
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

                            <!-- Uploaded files -->
                            <form action="<?php echo e(route('patient.add-files')); ?>" method="Post" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="row form-row">
                                    <div class="col-12 col-md-12">
                                        <div class="form-group">
                                            <style>
                                                .change-avatar .profile-img img {
                                                    object-fit: initial;
                                                }
                                            </style>
                                            <div class="change-avatar">
                                                <div class="profile-img">
                                                    <img src="<?php echo e(asset('icons/pdf.svg')); ?>" alt="User Image">
                                                </div>
                                                <div class="profile-img">
                                                    <img src="<?php echo e(asset('icons/jpg.png')); ?>" alt="User Image">
                                                </div>
                                                <div class="profile-img">
                                                    <img src="<?php echo e(asset('icons/txt.png')); ?>" alt="User Image">
                                                </div>
                                                <div class="upload-img">
                                                    <div class="change-photo-btn">
                                                        <span><i class="fa fa-upload"></i> <?php echo e(__('regular.choose-file')); ?></span>
                                                        <input type="file" name="file"
                                                               class="upload <?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                               required>
                                                        <?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <div class="alert alert-danger"><?php echo e($message); ?></div>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="h5"><?php echo e(__('regular.file-name')); ?></label>
                                                        <input type="text" name="name"
                                                               class="h6 form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                               required
                                                               style="line-height: 2rem; padding: 0; min-height: initial; height: initial;">
                                                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <div class="alert alert-danger"><?php echo e($message); ?></div>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="submit-section">
                                    <button type="submit"
                                            class="btn btn-primary submit-btn"><?php echo e(__('regular.upload-file')); ?></button>
                                </div>
                            </form>
                            <!-- /Uploaded files -->

                            <div class="mt-4">
                                <div class="card card-table mb-0">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-center mb-0">
                                                <thead>
                                                <tr>
                                                    <th><?php echo e(__('regular.file-name')); ?></th>
                                                    <th><?php echo e(__('regular.file')); ?></th>
                                                    <th><?php echo e(__('regular.upload-date')); ?></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td class="w-25">
                                                            <h2><?php echo e($file->name); ?></h2>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            $allowedMimeTypes = ['image/jpeg', 'image/gif', 'image/png', 'image/bmp', 'image/svg+xml'];
                                                            $contentType = mime_content_type('storage/' . $file->file);
                                                            ?>
                                                            <?php if(in_array($contentType, $allowedMimeTypes)): ?>
                                                                <a href="<?php echo e(Storage::url($file->file)); ?>"
                                                                   download="<?php echo e($file->name); ?>">
                                                                    <img class="w-50"
                                                                         src="<?php echo e(Storage::url($file->file)); ?>"
                                                                         alt="">
                                                                </a>
                                                            <?php else: ?>
                                                                <a href="<?php echo e(Storage::url($file->file)); ?>"
                                                                   download="<?php echo e($file->name); ?>"
                                                                   class="btn btn-sm bg-info-light">
                                                                    <i class="far fa-eye"></i> <?php echo e(__('View')); ?>

                                                                </a>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo e($file->created_at); ?>

                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /Page Content -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH W:\domains\docure\resources\views/patient/uploaded-files.blade.php ENDPATH**/ ?>