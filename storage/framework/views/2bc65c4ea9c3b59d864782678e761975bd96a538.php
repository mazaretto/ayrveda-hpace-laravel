<?php $__env->startSection('content'); ?>
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Edit Medicine</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="<?php echo e(route('admin.medicine-list')); ?>">Medicine
                                    List</a></li>
                            <li class="breadcrumb-item active">Edit Medicine</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="row">
                <div class="col-sm-12">
                    <form class="card" action="<?php echo e(route('admin.medicine-edit-submit')); ?>" method="Post">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="id" value="<?php echo e($medicine->id); ?>">
                        <div class="card-header">
                            <h2><input name="name" class="form-control title-medicine" type="text"
                                       value="<?php echo e($medicine->name); ?>"></h2>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <img class="avatar avatar-medicine" src="<?php echo e(Storage::url($medicine->image)); ?>" alt="">
                                </div>
                                <div class="col-9">
                                    <div class="form-group">
                                        <h4>Price</h4>
                                        <input name="price" type="number" class="form-control" step="0.01" min="0" placeholder="10.50"
                                               value="<?php echo e($medicine->price); ?>">
                                    </div>
                                    <div class="form-group">
                                        <h4>Description</h4>
                                        <textarea class="form-control" name="description"
                                                  rows="5"><?php echo e($medicine->description); ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-2">
                                <h4>Gallery</h4>
                                <div class="dropzone form-control"></div>
                            </div>
                            <div class="row my-2 multiline-input__js">
                                <h4>Composition</h4>
                                <?php if($medicine->sostav??false and $medicine->sostav!=''): ?>
                                    <?php $__currentLoopData = explode('\,/', $medicine->sostav); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="mb-1 col-12 d-flex">
                                            <input type="text" name="sostav[]" class="form-control new-line__js"
                                                   value="<?php echo e($item); ?>">
                                            <button class="ml-3 btn btn-danger multiline-input-remove__js"><i
                                                    class="fe fe-close"></i></button>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <div class="mb-1 col-12 d-flex">
                                        <input type="text" name="sostav[]" class="form-control new-line__js"
                                               placeholder="Type line and press Enter">
                                        <button class="ml-3 btn btn-danger multiline-input-remove__js"><i
                                                class="fe fe-close"></i></button>
                                    </div>
                                <?php endif; ?>
                                <div class="mb-1 col-12 d-flex multiline-input-blank__js">
                                    <input type="text" name="sostav[]" class="form-control new-line__js"
                                           placeholder="Type line and press Enter">
                                    <button class="ml-3 btn btn-danger multiline-input-remove__js"><i
                                            class="fe fe-close"></i></button>
                                </div>
                            </div>

                            <div class="row my-2 multiline-input__js">
                                <h4>Dosage</h4>
                                <?php if($medicine->doz??false and $medicine->doz!=''): ?>
                                    <?php $__currentLoopData = explode('\,/', $medicine->doz); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="mb-1 col-12 d-flex">
                                            <input type="text" name="doz[]" class="form-control new-line__js"
                                                   value="<?php echo e($item); ?>">
                                            <button class="ml-3 btn btn-danger multiline-input-remove__js"><i
                                                    class="fe fe-close"></i></button>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <div class="mb-1 col-12 d-flex">
                                        <input type="text" name="doz[]" class="form-control new-line__js"
                                               placeholder="Type line and press Enter">
                                        <button class="ml-3 btn btn-danger multiline-input-remove__js"><i
                                                class="fe fe-close"></i></button>
                                    </div>
                                <?php endif; ?>

                                <div class="mb-1 col-12 d-flex multiline-input-blank__js">
                                    <input type="text" name="doz[]" class="form-control new-line__js"
                                           placeholder="Type line and press Enter">
                                    <button class="ml-3 btn btn-danger multiline-input-remove__js"><i
                                            class="fe fe-close"></i></button>
                                </div>
                            </div>

                            <div class="row my-2 multiline-input__js">
                                <h4>Contraindications</h4>
                                <?php if($medicine->protiv??false and $medicine->protiv!=''): ?>
                                    <?php $__currentLoopData = explode('\,/', $medicine->protiv); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="mb-1 col-12 d-flex">
                                            <input type="text" name="protiv[]" class="form-control new-line__js"
                                                   value="<?php echo e($item); ?>">
                                            <button class="ml-3 btn btn-danger multiline-input-remove__js"><i
                                                    class="fe fe-close"></i></button>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <div class="mb-1 col-12 d-flex">
                                        <input type="text" name="protiv[]" class="form-control new-line__js"
                                               placeholder="Type line and press Enter">
                                        <button class="ml-3 btn btn-danger multiline-input-remove__js"><i
                                                class="fe fe-close"></i></button>
                                    </div>
                                <?php endif; ?>

                                <div class="mb-1 col-12 d-flex multiline-input-blank__js">
                                    <input type="text" name="protiv[]" class="form-control new-line__js"
                                           placeholder="Type line and press Enter">
                                    <button class="ml-3 btn btn-danger multiline-input-remove__js"><i
                                            class="fe fe-close"></i></button>
                                </div>
                            </div>

                            <div class="row my-2">
                                <h4>Manufacturer</h4>
                                <div class="mb-1 col-12 d-flex">
                                    <input type="text" name="manufacter" class="form-control" placeholder="" value="<?php echo e($medicine->manufacter??null); ?>">
                                </div>
                            </div>

                            <div class="row my-2 multiline-input__js">
                                <h4>Diseases</h4>
                                <?php if($medicine->diseases??false and $medicine->diseases!=''): ?>
                                    <?php $__currentLoopData = explode('\,/', $medicine->diseases); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="mb-1 col-12 d-flex">
                                            <input type="text" name="diseases[]" class="form-control new-line__js"
                                                   value="<?php echo e($item); ?>">
                                            <button class="ml-3 btn btn-danger multiline-input-remove__js"><i
                                                    class="fe fe-close"></i></button>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <div class="mb-1 col-12 d-flex">
                                        <input type="text" name="diseases[]" class="form-control new-line__js"
                                               placeholder="Type line and press Enter">
                                        <button class="ml-3 btn btn-danger multiline-input-remove__js"><i
                                                class="fe fe-close"></i></button>
                                    </div>
                                <?php endif; ?>

                                <div class="mb-1 col-12 d-flex multiline-input-blank__js">
                                    <input type="text" name="diseases[]" class="form-control new-line__js"
                                           placeholder="Type line and press Enter">
                                    <button class="ml-3 btn btn-danger multiline-input-remove__js"><i
                                            class="fe fe-close"></i></button>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <button type="submit" class="btn btn-success mr-2">Submit</button>
                                <button class="btn btn-warning text-light" onclick="window.location.reload();">Cancel
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->

    </div>
    <!-- /Main Wrapper -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('/js/dropzone/basic.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/js/dropzone/dropzone.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer-script'); ?>
    <script src="<?php echo e(asset('/js/dropzone/dropzone.min.js')); ?>"></script>

    <script>
        Dropzone.autoDiscover = false;
        let gallery = $(".dropzone").dropzone({
            url: "<?php echo e(route('admin.medicine-image-upload', ['id' => $medicine->id])); ?>",
            init: function () {
                this.on("addedfile", function (file) {
                    // Create the remove button
                    let removeButton = Dropzone.createElement(`<a class="dz-remove" href="javascript:undefined;" data-dz-remove="">Remove image</a>`);
                    // Capture the Dropzone instance as closure.
                    let _this = this;
                    // Listen to the click event
                    removeButton.addEventListener("click", function (e) {
                        // Make sure the button click doesn't submit the form:
                        e.preventDefault();
                        e.stopPropagation();

                        // Remove the file preview.
                        _this.removeFile(file);
                        $.ajax({
                            method: 'POST',
                            url: '<?php echo e(route('admin.medicine-image-delete', ['id' => $medicine->id])); ?>',
                            data: {
                                file: file.dataURL,
                            }
                        })
                    });
                    // Add the button to the file preview element.
                    file.previewElement.appendChild(removeButton);
                });


                let images = '<?php echo e($medicine->gallery); ?>'.split(',');
                images.forEach((value, index) => {
                    if (value === '') return;

                    let mockFile = {name: "image", size: 0};
                    this.displayExistingFile(mockFile, "/storage/" + value);
                })
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.mainlayout_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH W:\domains\docure\resources\views/admin/medicine/medicine-edit.blade.php ENDPATH**/ ?>