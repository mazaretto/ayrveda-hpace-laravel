<?php $__env->startSection('content'); ?>
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
        <?php
        $user = auth()->user();
        if ($user->hasRole('Doctor')) {
            $profile = $user->doctorProfile()->first();
        } elseif ($user->hasRole('Patient')) {
            $profile = $user->patientProfile()->first();
        }

        if ((($profile->first_name ?? null) !== null) and (($profile->last_name ?? null) !== null) and (($profile->patronymic ?? null) !== null)) {
            $name = $profile->first_name . ' ' . mb_substr($profile->patronymic, 0, 1) . '. ' . $profile->last_name;
        } else {
            $name = $user->name;
        }

        $photo = ($profile->photo ?? null) !== null ? Storage::url($profile->photo) : '/assets_admin/img/profiles/avatar-01.jpg';
        ?>

        <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Welcome, <?php echo e($name); ?>!</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <?php
            $doctors = App\User::role('Doctor')->get();
            $patients = App\User::role('Patient')->get();
            ?>

            <div class="row">
                <div class="col-xl-6 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
										<span class="dash-widget-icon text-primary border-primary">
											<i class="fe fe-users"></i>
										</span>
                                <div class="dash-count">
                                    <h3><?php echo e($doctors->count()); ?></h3>
                                </div>
                            </div>
                            <div class="dash-widget-info">
                                <h6 class="text-muted">Doctors</h6>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-primary w-25"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
										<span class="dash-widget-icon text-success">
											<i class="fe fe-credit-card"></i>
										</span>
                                <div class="dash-count">
                                    <h3><?php echo e($patients->count()); ?></h3>
                                </div>
                            </div>
                            <div class="dash-widget-info">

                                <h6 class="text-muted">Patients</h6>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-success w-25"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 d-flex">

                    <!-- Recent Orders -->
                    <div class="card card-table flex-fill">
                        <div class="card-header">
                            <h4 class="card-title">Doctors List</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-center mb-0">
                                    <thead>
                                    <tr>
                                        <th>Doctor Name</th>
                                        <th>Speciality</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                        $profile = $doctor->doctorProfile()->first();
                                        $photo = ($profile->photo ?? null) !== null ? Storage::url($profile->photo) : '/assets_admin/img/doctors/doctor-thumb-01.jpg';

                                        if ((($profile->first_name ?? null) !== null) and (($profile->last_name ?? null) !== null) and (($profile->patronymic ?? null) !== null)) {
                                            $name = 'Dr.' . $profile->first_name . ' ' . mb_substr($profile->patronymic, 0, 1) . '. ' . $profile->last_name;
                                        } else {
                                            $name = 'Dr. ' . $doctor->name;
                                        }
                                        ?>
                                        <tr>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="<?php echo e(route('admin.doctor-profile', ['id' => $doctor->id])); ?>" class="avatar avatar-sm mr-2"><img
                                                            class="avatar-img rounded-circle"
                                                            src="<?php echo e($photo); ?>"
                                                            alt="User Image"></a>
                                                    <a href="<?php echo e(route('admin.doctor-profile', ['id' => $doctor->id])); ?>"><?php echo e($name); ?></a>
                                                </h2>
                                            </td>
                                            <td>
                                                <?php $__currentLoopData = explode(',', $profile->specialist??null); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $speciality): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($loop->last): ?>
                                                        <?php echo e($speciality); ?>

                                                    <?php else: ?>
                                                        <?php echo e($speciality.', '); ?>

                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /Recent Orders -->

                </div>
                <div class="col-md-6 d-flex">

                    <!-- Feed Activity -->
                    <div class="card  card-table flex-fill">
                        <div class="card-header">
                            <h4 class="card-title">Patients List</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-center mb-0">
                                    <thead>
                                    <tr>
                                        <th>Patient Name</th>
                                        <th>Phone</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                        $profile = $patient->patientProfile()->first();
                                        $photo = ($profile->photo ?? null) !== null ? Storage::url($profile->photo) : '/assets_admin/img/patients/patient1.jpg';

                                        if ((($profile->first_name ?? null) !== null) and (($profile->last_name ?? null) !== null) and (($profile->patronymic ?? null) !== null)) {
                                            $name = $profile->first_name . ' ' . mb_substr($profile->patronymic, 0, 1) . '. ' . $profile->last_name;
                                        } else {
                                            $name = $patient->name;
                                        }
                                        ?>
                                        <tr>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="<?php echo e(route('admin.patient-profile', ['id' => $patient->id])); ?>" class="avatar avatar-sm mr-2"><img
                                                            class="avatar-img rounded-circle"
                                                            src="<?php echo e($photo); ?>"
                                                            alt="User Image"></a>
                                                    <a href="<?php echo e(route('admin.patient-profile', ['id' => $patient->id])); ?>"><?php echo e($name); ?></a>
                                                </h2>
                                            </td>
                                            <td><?php echo e($patient->phone??'Not set'); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /Feed Activity -->

                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->

    </div>
    <!-- /Main Wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.mainlayout_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH W:\domains\docure\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>