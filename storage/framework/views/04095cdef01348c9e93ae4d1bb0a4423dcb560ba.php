<?php $__env->startSection('content'); ?>
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">List of Patients</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                            <li class="breadcrumb-item active">Patient</li>
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
                                <div class="table-responsive">
                                    <table class="datatable table table-hover table-center mb-0">
                                        <thead>
                                        <tr>
                                            <th>Patient ID</th>
                                            <th>Patient Name</th>
                                            <th>Age</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                            if ($patient->patientProfile->first_name ?? false and $patient->patientProfile->last_name ?? false and $patient->patientProfile->patronymic ?? false) {
                                                $name = $patient->patientProfile->first_name . ' ' . mb_substr($patient->patientProfile->patronymic, 0, 1) . '. ' . $patient->patientProfile->last_name;
                                            } else {
                                                $name = $patient->name;
                                            }

                                            if ($patient->patientProfile->birth ?? false) {
                                                $age = date('F j Y', strtotime($patient->patientProfile->birth));

                                                $date = new DateTime($patient->patientProfile->birth);
                                                $now = new DateTime();
                                                $interval = $now->diff($date);
                                                $age = $interval->y;
                                            }
                                            ?>
                                            <tr>
                                                <td>P<?php echo e($patient->id); ?></td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="<?php echo e(route('admin.patient-profile', ['id' => $patient->id])); ?>" class="avatar avatar-sm mr-2"><img
                                                                class="avatar-img rounded-circle"
                                                                src="<?php echo e($patient->patientProfile->photo??false?Storage::url($patient->patientProfile->photo):'/assets_admin/img/patients/patient1.jpg'); ?>"
                                                                alt="User Image"></a>
                                                        <a href="<?php echo e(route('admin.patient-profile', ['id' => $patient->id])); ?>"><?php echo e($name); ?></a>
                                                    </h2>
                                                </td>
                                                <td><?php echo e($age??'Not set'); ?></td>
                                                <td><?php echo e($patient->patientProfile->zip_code??null); ?> <?php echo e($patient->patientProfile->address??null); ?>, <?php echo e($patient->patientProfile->state??null); ?>, <?php echo e($patient->patientProfile->country??null); ?></td>
                                                <td><?php echo e($patient->phone??null); ?></td>
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
    <!-- /Page Wrapper -->

    </div>
    <!-- /Main Wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.mainlayout_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH W:\domains\docure\resources\views/admin/patient/patients-list.blade.php ENDPATH**/ ?>