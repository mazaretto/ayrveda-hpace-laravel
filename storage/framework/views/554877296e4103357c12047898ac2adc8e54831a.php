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
                    <div class="d-flex flex-wrap">
                      <style>
                        .change-avatar .profile-img img {
                          object-fit: initial;
                        }
                      </style>
                      <div class="change-avatar">
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
                        </div>
                      </div>

                      <div class="submit-section ml-2">
                        <button type="submit"
                                class="upload_file-submit"><?php echo e(__('regular.upload-file')); ?></button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
              <!-- /Uploaded files -->

              <div class="mt-4">
                <div class="card card-table mb-0">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-hover table-center mb-0">
                        <thead>
                        <tr class="d-flex align-items-start">
                          <th class="col-2"><?php echo e(__('regular.file-name')); ?></th>
                          <th class="col-8"><?php echo e(__('regular.file')); ?></th>
                          <th class="col-2"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <tr class="d-flex align-items-start">
                            <td class="col-2 text-left uploaded-files__name">
                              <h2><?php echo e($file->name); ?></h2>
                            </td>
                            <td class="col-8">
                              <?php
                              $allowedMimeTypes = ['image/jpeg', 'image/gif', 'image/png', 'image/bmp', 'image/svg+xml'];
                              $pdf = 'application/pdf';
                              $contentType = mime_content_type('storage/' . $file->file);
                              ?>
                              <?php if(in_array($contentType, $allowedMimeTypes)): ?>
                                <a href="<?php echo e(Storage::url($file->file)); ?>" data-fancybox="gallery">
                                  <img class="uploaded-files__image-preview"
                                       src="<?php echo e(Storage::url($file->file)); ?>"
                                       alt="">
                                </a>
                              <?php elseif($contentType==$pdf): ?>
                                <div class="d-flex flex-wrap">
                                  <iframe src="<?php echo e(Storage::url($file->file)); ?>"
                                          class="uploaded-files__pdf-preview"></iframe>
                                  <a href="<?php echo e(Storage::url($file->file)); ?>" class="btn btn-outline-info mt-2" data-fancybox="pdf">
                                    <i class="fas fa-compress"></i> <?php echo e(__('regular.fullscreen')); ?>

                                  </a>
                                </div>
                              <?php else: ?>
                                <a href="<?php echo e(Storage::url($file->file)); ?>"
                                   class="btn btn-sm bg-info-light">
                                  <i class="far fa-eye"></i> <?php echo e(__('regular.view')); ?>

                                </a>
                              <?php endif; ?>
                            </td>
                            <td class="col-2 d-flex flex-wrap">
                              <a href="<?php echo e(Storage::url($file->file)); ?>"
                                 download="<?php echo e($file->name); ?>"
                                 class="btn btn-sm bg-success-light flex-basis-100">
                                <i class="fas fa-download"></i> <?php echo e(__('regular.download')); ?>

                              </a>
                              <form action="<?php echo e(route('patient.remove-files')); ?>" method="Post">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="id" value="<?php echo e($file->id); ?>">
                                <button class="btn bg-danger-light mt-2">
                                  <i class="fas fa-trash"></i>
                                </button>
                              </form>
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

<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/a/alexstrilby/ayrveda/resources/views/patient/uploaded-files.blade.php ENDPATH**/ ?>