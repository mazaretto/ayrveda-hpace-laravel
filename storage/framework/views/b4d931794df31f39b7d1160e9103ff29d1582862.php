<?php $__env->startSection('head-data'); ?>
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Home Banner -->
    <section class="section section-search">
        <div class="container-fluid">
            <div class="banner-wrapper">
                <div class="banner-header text-center">
                    <h1>Ayurveda</h1>
                    <p>Clinic with doctors and prescriptions only for your Health.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- /Home Banner -->

    <!-- Clinic and Specialities -->
    <section class="section section-specialities">
        <div class="container-fluid">
            <div class="section-header text-center">
                <h2>Clinic and Specialities</h2>
                <p class="sub-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                    incididunt ut labore et dolore magna aliqua.</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <!-- Slider -->
                    <div class="specialities-slider slider">

                        <!-- Slider Item -->
                        <div class="speicality-item text-center">
                            <div class="speicality-img">
                                <img src="/assets/img/specialities/specialities-01.png" class="img-fluid"
                                     alt="Speciality">
                                <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                            </div>
                            <p>Urology</p>
                        </div>
                        <!-- /Slider Item -->

                        <!-- Slider Item -->
                        <div class="speicality-item text-center">
                            <div class="speicality-img">
                                <img src="/assets/img/specialities/specialities-02.png" class="img-fluid"
                                     alt="Speciality">
                                <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                            </div>
                            <p>Neurology</p>
                        </div>
                        <!-- /Slider Item -->

                        <!-- Slider Item -->
                        <div class="speicality-item text-center">
                            <div class="speicality-img">
                                <img src="/assets/img/specialities/specialities-03.png" class="img-fluid"
                                     alt="Speciality">
                                <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                            </div>
                            <p>Orthopedic</p>
                        </div>
                        <!-- /Slider Item -->

                        <!-- Slider Item -->
                        <div class="speicality-item text-center">
                            <div class="speicality-img">
                                <img src="/assets/img/specialities/specialities-04.png" class="img-fluid"
                                     alt="Speciality">
                                <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                            </div>
                            <p>Cardiologist</p>
                        </div>
                        <!-- /Slider Item -->

                        <!-- Slider Item -->
                        <div class="speicality-item text-center">
                            <div class="speicality-img">
                                <img src="/assets/img/specialities/specialities-05.png" class="img-fluid"
                                     alt="Speciality">
                                <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                            </div>
                            <p>Dentist</p>
                        </div>
                        <!-- /Slider Item -->

                    </div>
                    <!-- /Slider -->

                </div>
            </div>
        </div>
    </section>
    <!-- Clinic and Specialities -->

    <!-- Our Doctors Section -->
    <section class="section section-doctor">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="section-header ">
                        <h2>All Our Doctors</h2>
                        <p>Lorem Ipsum is simply dummy text </p>
                    </div>
                    <div class="about-content">
                        <p>It is a long established fact that a reader will be distracted by the readable content of a
                            page when looking at its layout. The point of using Lorem Ipsum.</p>
                        <p>web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem
                            ipsum' will uncover many web sites still in their infancy. Various versions have evolved
                            over the years, sometimes</p>
                        <a href="<?php echo e(route('doctors-list')); ?>">View More...</a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="doctor-slider slider">
                        <!-- Doctor Widgets -->
                        <?php
                        \Spatie\Permission\Models\Role::findorcreate('Doctor');

                        $doctors = \App\User::where('active', true)->role('Doctor')->get();
                        ?>
                        <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                            $doc_profile = $doctor->doctorProfile()->first();

                            if ($doc_profile->photo ?? false) {
                                $photo = Storage::url($doc_profile->photo);
                            } else {
                                $photo = '/assets/img/doctors/doctor-01.jpg';
                            }

                            if ($doc_profile->first_name ?? false and $doc_profile->last_name ?? false and $doc_profile->patronymic ?? false) {
                                $name = 'Dr. ' . $doc_profile->first_name . ' ' . mb_substr($doc_profile->patronymic, 0, 1) . '. ' . $doc_profile->last_name;
                            } else {
                                $name = $doctor->name;
                            }
                            ?>
                            <div class="profile-widget">
                                <div class="doc-img">
                                    <a href="<?php echo e(route('doctor-profile', ['id' => $doctor->id])); ?>">
                                        <img class="img-fluid" alt="User Image" src="<?php echo e($photo??null); ?>">
                                    </a>
                                </div>
                                <div class="pro-content">
                                    <h3 class="title">
                                        <a href="<?php echo e(route('doctor-profile', ['id' => $doctor->id])); ?>"><?php echo e($name??null); ?></a>
                                        <i class="fas fa-check-circle verified"></i>
                                    </h3>
                                    <p class="speciality"><?php echo e($doc_profile->clinic_name??null); ?></p>
                                    <ul class="available-info">
                                        <?php if($doc_profile->clinic_address??false): ?>
                                            <li>
                                                <i class="fas fa-map-marker-alt"></i> <?php echo e($doc_profile->clinic_address); ?>

                                            </li>
                                        <?php endif; ?>
                                        <li>
                                            <i class="fa fa-phone"></i> <?php echo e($doctor->phone??null); ?></li>
                                        </li>
                                        <?php if($doc_profile->price??false): ?>
                                            <li>
                                                <i class="far fa-money-bill-alt"></i> <?php echo e($doc_profile->price); ?>

                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                    <div class="row row-sm">
                                        <div class="col-6">
                                            <a href="<?php echo e(route('doctor-profile', ['id' => $doctor->id])); ?>"
                                               class="btn view-btn">View Profile</a>
                                        </div>
                                        <div class="col-3">
                                            <a href="tel:<?php echo e($doctor->phone??null); ?>" class="btn view-btn">
                                                <i class="fas fa-phone"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <!-- /Doctor Widgets -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Our Doctors Section -->

    <!-- Medicine Features -->
    <section class="section section-features">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9 mb-4">
                    <div class="section-header">
                        <h2 class="my-2">Ayurveda</h2>
                        <a class="btn btn-primary" href="<?php echo e(route('store')); ?>">Go to our Online Store</a>
                    </div>
                    <div class="features-slider slider">
                        <!-- Slider Items -->
                        <?php
                        $medicines = \App\MedicineList::all()
                        ?>
                        <?php $__currentLoopData = $medicines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $medicine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="feature-item text-center">
                                <a href="<?php echo e(route('store.medicine', ['id' => $medicine->id])); ?>">
                                    <img src="<?php echo e(Storage::url($medicine->image??'')); ?>" class="img-fluid" alt="Feature">
                                    <p><?php echo e($medicine->name); ?></p>
                                    <span><?php echo e($medicine->price); ?></span>
                                </a>
                            </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <!-- /Slider Items -->
                    </div>
                </div>
                <div class="col-lg-3 features-img">
                    <img src="/assets/img/features/feature.png" class="img-fluid" alt="Feature">
                </div>
            </div>
        </div>
    </section>
    <!-- /Medicine Features -->

    

    <!-- Chat Section -->
    <section id="app">
      <support-chat ref="supportChat"></support-chat>
    </section>
    <!-- /Chat Section -->

    </div>
    <!-- /Main Wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH W:\domains\docure\resources\views/index.blade.php ENDPATH**/ ?>