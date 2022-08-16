<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
  <?php echo $__env->make('layout.partials.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
<?php echo $__env->make('layout.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldContent('content'); ?>
<?php if(!Route::is(['chat-doctor','map-grid','map-list','chat','voice-call','video-call'])): ?>
  <?php echo $__env->make('layout.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php echo $__env->make('layout.partials.footer-scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div id="image-instant-zoom" style="display:none;position: fixed;bottom: 0; left: 50%;transform: translateX(-50%);z-index: 99993;width: 250px;">
  <input type="range" min="0.1" max="3" step="0.01" value="1" style="width: 100%;">
  <button class="btn btn-secondary btn-sm ml-1"><i class="fa fa-redo"></i></button>
</div>
</body>
</html><?php /**PATH /home/a/alexstrilby/ayrveda/resources/views/layout/mainlayout.blade.php ENDPATH**/ ?>