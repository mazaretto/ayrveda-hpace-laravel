<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<?php echo $__env->yieldContent('meta'); ?>
<?php if(!Route::is(['appointment-list','specialities','doctor-list','patient-list','reviews','transactions-list','settings','invoice-report','profile','login','register','forgot-password','lock-screen','error-404','error-500','blank-page','components','form-basic','form-inputs','form-horizontal','form-vertical','form-mask','form-validation','tables-basic','data-tables','invoice','calendar'])): ?>
  <title><?php echo e(env('APP_NAME')); ?> - Dashboard</title>
<?php endif; ?>
<?php if(Route::is(['appointment-list'])): ?>
  <title><?php echo e(env('APP_NAME')); ?> - Appointment List Page</title>
<?php endif; ?>
<?php if(Route::is(['specialities'])): ?>
  <title><?php echo e(env('APP_NAME')); ?> - Specialities Page</title>
<?php endif; ?>
<?php if(Route::is(['doctor-list'])): ?>
  <title><?php echo e(env('APP_NAME')); ?> - Doctor List Page</title>
<?php endif; ?>
<?php if(Route::is(['patient-list'])): ?>
  <title><?php echo e(env('APP_NAME')); ?> - Patient List Page</title>
<?php endif; ?>
<?php if(Route::is(['reviews'])): ?>
  <title><?php echo e(env('APP_NAME')); ?> - Reviews Page</title>
<?php endif; ?>
<?php if(Route::is(['transactions-list'])): ?>
  <title><?php echo e(env('APP_NAME')); ?> - Transactions List Page</title>
<?php endif; ?>
<?php if(Route::is(['settings'])): ?>
  <title><?php echo e(env('APP_NAME')); ?> - Settings Page</title>
<?php endif; ?>
<?php if(Route::is(['invoice-report'])): ?>
  <title><?php echo e(env('APP_NAME')); ?> - Invoice Report Page</title>
<?php endif; ?>
<?php if(Route::is(['profile'])): ?>
  <title><?php echo e(env('APP_NAME')); ?> - Profile</title>
<?php endif; ?>
<?php if(Route::is(['login'])): ?>
  <title><?php echo e(env('APP_NAME')); ?> - Login</title>
<?php endif; ?>
<?php if(Route::is(['register'])): ?>
  <title><?php echo e(env('APP_NAME')); ?> - Register</title>
<?php endif; ?>
<?php if(Route::is(['forgot-password'])): ?>
  <title><?php echo e(env('APP_NAME')); ?> - Forgot Password</title>
<?php endif; ?>
<?php if(Route::is(['lock-screen'])): ?>
  <title><?php echo e(env('APP_NAME')); ?> - Lock Screen</title>
<?php endif; ?>
<?php if(Route::is(['error-404'])): ?>
  <title><?php echo e(env('APP_NAME')); ?> - Error 404</title>
<?php endif; ?>
<?php if(Route::is(['error-500'])): ?>
  <title><?php echo e(env('APP_NAME')); ?> - Error 500</title>
<?php endif; ?>
<?php if(Route::is(['blank-page'])): ?>
  <title><?php echo e(env('APP_NAME')); ?> - Blank Page</title>
<?php endif; ?>
<?php if(Route::is(['components'])): ?>
  <title><?php echo e(env('APP_NAME')); ?> - Components</title>
<?php endif; ?>
<?php if(Route::is(['form-basic'])): ?>
  <title><?php echo e(env('APP_NAME')); ?> - Basic Inputs</title>
<?php endif; ?>
<?php if(Route::is(['form-inputs'])): ?>
  <title><?php echo e(env('APP_NAME')); ?> - Form Input Groups</title>
<?php endif; ?>
<?php if(Route::is(['form-horizontal'])): ?>
  <title><?php echo e(env('APP_NAME')); ?> - Horizontal Form</title>
<?php endif; ?>
<?php if(Route::is(['form-vertical'])): ?>
  <title><?php echo e(env('APP_NAME')); ?> - Vertical Form</title>
<?php endif; ?>
<?php if(Route::is(['form-mask'])): ?>
  <title><?php echo e(env('APP_NAME')); ?> - Form Mask</title>
<?php endif; ?>
<?php if(Route::is(['form-validation'])): ?>
  <title><?php echo e(env('APP_NAME')); ?> - Form Validation</title>
<?php endif; ?>
<?php if(Route::is(['tables-basic'])): ?>
  <title><?php echo e(env('APP_NAME')); ?> - Tables Basic</title>
<?php endif; ?>
<?php if(Route::is(['data-tables'])): ?>
  <title><?php echo e(env('APP_NAME')); ?> - Data Tables</title>
<?php endif; ?>
<?php if(Route::is(['invoice'])): ?>
  <title><?php echo e(env('APP_NAME')); ?> - Invoice</title>
<?php endif; ?>
<?php if(Route::is(['calendar'])): ?>
  <title><?php echo e(env('APP_NAME')); ?> - Calendar</title>
<?php endif; ?>
<!-- Favicon -->
<link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('assets_admin/img/favicon.png')); ?>">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="<?php echo e(asset('assets_admin/css/bootstrap.min.css')); ?>">

<!-- Fontawesome CSS -->
<link rel="stylesheet" href="<?php echo e(asset('assets_admin/css/font-awesome.min.css')); ?>">

<!-- Feathericon CSS -->
<link rel="stylesheet" href="<?php echo e(asset('assets_admin/css/feathericon.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets_admin/plugins/morris/morris.css')); ?>">
<!-- Select2 CSS -->
<link rel="stylesheet" href="<?php echo e(asset('assets_admin/css/select2.min.css')); ?>">
<!-- Datetimepicker CSS -->
<link rel="stylesheet" href="<?php echo e(asset('assets_admin/css/bootstrap-datetimepicker.min.css')); ?>">

<!-- Full Calander CSS -->
<link rel="stylesheet" href="<?php echo e(asset('assets_admin/plugins/fullcalendar/fullcalendar.min.css')); ?>">
<!-- Datatables CSS -->
<link rel="stylesheet" href="<?php echo e(asset('assets_admin/plugins/datatables/datatables.min.css')); ?>">

<?php echo $__env->yieldContent('header-css'); ?>

<!-- <link rel="stylesheet" href="assets/plugins/morris/morris.css"> -->

<!-- Main CSS -->
<link rel="stylesheet" href="<?php echo e(asset('assets_admin/css/style.css')); ?>">
<?php /**PATH W:\domains\docure\resources\views/layout/partials/head_admin.blade.php ENDPATH**/ ?>