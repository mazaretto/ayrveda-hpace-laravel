<?php error_reporting(0);?>
<!-- Loader -->
<?php if(Route::is(['map-grid','map-list'])): ?>
    <div id="loader">
        <div class="loader">
            <span></span>
            <span></span>
        </div>
    </div>
<?php endif; ?>
<!-- /Loader  -->
<div class="main-wrapper">
    <!-- Header -->
    <header class="header">
        <nav class="navbar navbar-expand-lg header-nav">
            <div class="navbar-header">
                <a id="mobile_btn" href="javascript:void(0);">
							<span class="bar-icon">
								<span></span>
								<span></span>
								<span></span>
							</span>
                </a>
                <a href="<?php echo e(route('home')); ?>" class="navbar-brand logo">
                    <h2><?php echo e(env('APP_NAME')); ?></h2>
                </a>
            </div>
            <div class="main-menu-wrapper">
                <div class="menu-header">
                    <a href="<?php echo e(route('home')); ?>" class="navbar-brand logo">
                        <h2><?php echo e(env('APP_NAME')); ?></h2>
                    </a>
                    <a id="menu_close" class="menu-close" href="javascript:void(0);">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
                <ul class="main-nav">
                    <li class="buttons">
                        <div class="btn-group" role="group">
                            <button type="button" id="font-size-page-increase" class="btn btn-primary">
                                <i class="fas fa-search-plus"></i>
                            </button>
                            <button type="button" id="font-size-page-decrease" class="btn btn-primary">
                                <i class="fas fa-search-minus"></i>
                            </button>
                            <button type="button" id="font-size-reset" class="btn btn-primary"><i
                                    class="fas fa-font"></i></button>
                        </div>
                    </li>
                    <li class="buttons">
                        <div class="btn-group" role="group">
                            <a href="<?php echo e(route('locale.en')); ?>" class="btn btn-primary">
                                <img style="height: 1rem" src="<?php echo e(asset('icons/locale/gb.png')); ?>" alt="">
                            </a>
                            <a href="<?php echo e(route('locale.ru')); ?>" class="btn btn-primary">
                                <img style="height: 1rem" src="<?php echo e(asset('icons/locale/ru.png')); ?>" alt="">
                            </a>
                        </div>
                    </li>
                    <li class="<?php echo e(Request::is('/') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('home')); ?>"><?php echo e(__('header.home')); ?></a>
                    </li>
                    <li class="<?php echo e(Request::is('doctors-list*') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('doctors-list')); ?>"><?php echo e(__('header.doctors-list')); ?></a>
                    </li>
                    <?php if(auth()->guard()->check()): ?>
                        <?php if(auth()->user()->hasRole('Admin')): ?>
                            <li>
                                <a href="<?php echo e(route('admin.dashboard')); ?>" target="_blank"><?php echo e(__('header.admin')); ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if(auth()->guard()->guest()): ?>
                        <li class="buttons reg-buttons">
                            <a class="btn btn-primary" href="<?php echo e(route('login')); ?>"><?php echo e(__('auth.Login')); ?></a>
                        </li>
                        <li class="buttons reg-buttons">
                            <a class="btn btn-primary" href="<?php echo e(route('login.doctor')); ?>"><?php echo e(__('auth.Login-Doctor')); ?></a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            <ul class="nav header-navbar-rht">
                <li class="nav-item contact-item">
                    <div class="header-contact-img">
                        <i class="far fa-hospital"></i>
                    </div>
                    <div class="header-contact-detail">
                        <p class="contact-header"><?php echo e(__('header.contact')); ?></p>
                        <p class="contact-info-header"> +1 315 369 5943</p>
                    </div>
                </li>
                <?php if(auth()->guard()->guest()): ?>
                    <li class="nav-item login-item">
                        <a class="nav-link header-login" href="<?php echo e(route('login')); ?>"><?php echo e(__('auth.Login')); ?></a>
                    </li>
                    <li class="nav-item login-item">
                        <a class="nav-link header-login"
                           href="<?php echo e(route('login.doctor')); ?>"><?php echo e(__('auth.Login-Doctor')); ?></a>
                    </li>
                <?php endif; ?>
                <?php if(auth()->guard()->check()): ?>
                <!-- User Menu -->
                    <?php
                    $user = auth()->user();
                    $profile_name = $user->name;

                    if ($user->hasRole('Patient')) {
                        $profile = $user->patientProfile()->first();
                        if ((($profile->first_name ?? null) !== null) and (($profile->last_name ?? null) !== null) and (($profile->patronymic ?? null) !== null)) {
                            $profile_name = $profile->first_name . ' ' . mb_substr($profile->patronymic, 0, 1) . '. ' . $profile->last_name;
                        } else {
                            $profile_name = $user->name;
                        }
                    }

                    if ($user->hasRole('Doctor')) {
                        $profile = $user->doctorProfile()->first();
                        if ((($profile->first_name ?? null) !== null) and (($profile->last_name ?? null) !== null) and (($profile->patronymic ?? null) !== null)) {
                            $profile_name = 'Dr.' . $profile->first_name . ' ' . mb_substr($profile->patronymic, 0, 1) . '. ' . $profile->last_name;
                        } else {
                            $profile_name = $user->name;
                        }
                    }

                    $profile_photo = ($profile->photo ?? null) !== null ? Storage::url($profile->photo) : asset('assets/img/doctors/doctor-thumb-02.jpg');
                    ?>
                    <li class="nav-item dropdown has-arrow logged-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <span class="user-img">
                                <img class="rounded-circle"
                                     src="<?php echo e($profile_photo); ?>"
                                     width="31"
                                     alt="<?php echo e($profile_name); ?>">
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="user-header">
                                <div class="avatar avatar-sm">
                                    <img src="<?php echo e($profile_photo??null); ?>" alt="User Image"
                                         class="avatar-img rounded-circle">
                                </div>
                                <div class="user-text">

                                    <h6><?php echo e($profile_name??null); ?></h6>
                                    <?php if(auth()->user()->hasRole('Admin')): ?>
                                        <p class="text-muted mb-0"><?php echo e(__('header.admin')); ?></p>
                                    <?php elseif(auth()->user()->hasRole('Doctor-Main')): ?>
                                        <p class="text-muted mb-0"><?php echo e(__('header.doctor-main')); ?></p>
                                    <?php elseif(auth()->user()->hasRole('Doctor')): ?>
                                        <p class="text-muted mb-0"><?php echo e(__('header.doctor')); ?></p>
                                    <?php elseif(auth()->user()->hasRole('Patient')): ?>
                                        <p class="text-muted mb-0"><?php echo e(__('header.patient')); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php if(auth()->user()->hasRole('Doctor')): ?>
                                <a class="dropdown-item"
                                   href="<?php echo e(route('doctor.dashboard')); ?>"><?php echo e(__('header.dashboard')); ?></a>
                                <a class="dropdown-item"
                                   href="<?php echo e(route('doctor.settings')); ?>"><?php echo e(__('header.profile_settings')); ?></a>
                            <?php elseif(auth()->user()->hasRole('Patient')): ?>
                                <a class="dropdown-item"
                                   href="<?php echo e(route('patient.dashboard')); ?>"><?php echo e(__('header.dashboard')); ?></a>
                                <a class="dropdown-item" style="position: relative"
                                   href="<?php echo e(route('patient.cart')); ?>">
                                    <?php echo e(__('patient_nav.cart')); ?> <small
                                        class="unread-msg cart-quantity-total"><?php echo e(\App\Http\Controllers\Store\CartController::total()); ?></small></a>
                                <a class="dropdown-item"
                                   href="<?php echo e(route('patient.settings')); ?>"><?php echo e(__('header.profile_settings')); ?></a>
                            <?php endif; ?>
                            <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"><?php echo e(__('auth.Logout')); ?></a>
                        </div>
                    </li>
                    <!-- /User Menu -->
                <?php endif; ?>

            </ul>
        </nav>
    </header>
    <!-- /Header -->
<?php /**PATH W:\domains\docure\resources\views/layout/partials/header.blade.php ENDPATH**/ ?>