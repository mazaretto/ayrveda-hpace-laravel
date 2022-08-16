<?php $__env->startSection('content'); ?>
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title d-flex justify-content-between">Medicine List
                            <a href="#" class="btn btn-primary text-light" data-toggle="modal"
                               data-target="#add_medicine">Add Medicine</a></h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">Medicine List</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="datatable table table-stripped">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Image</th>
                                        <th>Description</th>
                                        <th style="width: 50px;"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $medicines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $medicine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($medicine->name); ?></td>
                                            <td><?php echo e($medicine->price); ?></td>
                                            <td>
                                                <div class="avatar avatar-xl">
                                                    <img class="avatar-img rounded" src="<?php echo e(Storage::url($medicine->image)); ?>" alt="">
                                                </div>
                                            </td>
                                            <td>
                                              <?php if(strlen($medicine->description) > 50): ?>
                                                <?php echo e(mb_substr($medicine->description, 0, 50).'...'); ?>

                                              <?php else: ?>
                                                <?php echo e($medicine->description); ?>

                                              <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo e(route('admin.medicine-edit', ['id'=>$medicine->id])); ?>" class="btn btn-success"><i class="fe fe-edit"></i> Edit</a>
                                                <form action="<?php echo e(route('admin.medicine-delete')); ?>" method="Post">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" value="<?php echo e($medicine->id); ?>" name="id">
                                                    <button class="btn btn-danger mt-1" type="submit"><i class="fe fe-close"></i> Delete
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

            <!-- Add Medical Records Modal -->
            <div class="modal fade custom-modal" id="add_medicine">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">New Medicine</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <form action="<?php echo e(route('admin.medicine-add')); ?>" method="Post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="required">Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Name of Medicine" required>
                                </div>
                                <div class="form-group">
                                    <label class="required">Price</label>
                                    <input type="number" name="price" class="form-control" placeholder="10.50" min="0" step="0.01" required>
                                </div>
                                <div class="form-group">
                                    <label class="required">Image</label>
                                    <input type="file" name="image" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label class="required">Description</label>
                                    <textarea class="form-control" name="description" rows="5" required></textarea>
                                </div>
                                <div class="submit-section text-center">
                                    <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                                    <button type="button" class="btn btn-secondary submit-btn" data-dismiss="modal">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /Add Medical Records Modal -->

        </div>
    </div>
    <!-- /Page Wrapper -->

    </div>
    <!-- /Main Wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.mainlayout_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/a/alexstrilby/ayrveda/resources/views/admin/medicine/medicine-list.blade.php ENDPATH**/ ?>