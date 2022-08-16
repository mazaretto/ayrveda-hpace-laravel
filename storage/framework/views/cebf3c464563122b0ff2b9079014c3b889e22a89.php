<!-- Main Wrapper -->
<div class="main-wrapper">

  <!-- Header -->
  <div class="header">

    <!-- Logo -->
    <div class="header-left">
      <a href="<?php echo e(route('admin.dashboard')); ?>" class="logo">
        <h3 style="word-break: break-all;margin-top: 0.4em;"><?php echo e(env('APP_NAME')); ?></h3>
      </a>
      <a href="<?php echo e(route('admin.dashboard')); ?>" class="logo logo-small">
        <h3 style="word-break: break-all;margin-top: 0.4em;"><?php echo e(env('APP_NAME')); ?></h3>
      </a>
    </div>
    <!-- /Logo -->

    <a href="javascript:void(0);" id="toggle_btn">
      <i class="fe fe-text-align-left"></i>
    </a>

    

    <!-- Mobile Menu Toggle -->
    <a class="mobile_btn" id="mobile_btn">
      <i class="fa fa-bars"></i>
    </a>
    <!-- /Mobile Menu Toggle -->

    <!-- Header Right Menu -->
    <ul class="nav user-menu">

    

    <!-- User Menu -->
      <?php
      $user = auth()->user();
      if ($user->hasRole('Doctor')) {
        $profile = $user->doctorProfile()->first();
      } elseif ($user->hasRole('Patient')) {
        $profile = $user->patientProfile()->first();
      }

      $name = \App\User::userNameFormat($user);

      $photo = ($profile->photo ?? null) !== null ? Storage::url($profile->photo) : '/assets_admin/img/profiles/avatar-01.jpg';
      ?>
      <li class="nav-item dropdown has-arrow">
        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
          <span class="user-img admin"><img class="rounded-circle" src="<?php echo e($photo); ?>" width="31" alt="Ryan Taylor"></span>
        </a>
        <div class="dropdown-menu admin">
          <div class="user-header">
            <div class="avatar avatar-sm">
              <img src="<?php echo e($photo); ?>" alt="User Image" class="avatar-img rounded-circle">
            </div>
            <div class="user-text">
              <h6><?php echo e($name); ?></h6>
              <?php if(auth()->user()->hasRole('Admin')): ?>
                <p class="text-muted mb-0">Administrator</p>
              <?php endif; ?>
            </div>
          </div>
          <a class="dropdown-item" href="<?php echo e(route('logout')); ?>">Logout</a>
        </div>
      </li>
      <!-- /User Menu -->

    </ul>
    <!-- /Header Right Menu -->

  </div>
  <!-- /Header -->
<?php /**PATH /home/a/alexstrilby/ayrveda/resources/views/layout/partials/header_admin.blade.php ENDPATH**/ ?>