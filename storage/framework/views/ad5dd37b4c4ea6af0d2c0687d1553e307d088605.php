<script src="<?php echo e(asset('js/app.js')); ?>"></script>

<!-- Bootstrap Core JS -->
<script src="<?php echo e(asset('assets/js/popper.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/bootstrap.min.js')); ?>"></script>
<!-- Datetimepicker JS -->
<script src="<?php echo e(asset('assets/js/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/bootstrap-datetimepicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/daterangepicker/daterangepicker.js')); ?>"></script>
<!-- Full Calendar JS -->
<script src="<?php echo e(asset('assets/plugins/jquery-ui/jquery-ui.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/fullcalendar/fullcalendar.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/fullcalendar/jquery.fullcalendar.js')); ?>"></script>
<!-- Sticky Sidebar JS -->
<script src="<?php echo e(asset('assets/plugins/theia-sticky-sidebar/ResizeSensor.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js')); ?>"></script>
<!-- Select2 JS -->
<script src="<?php echo e(asset('assets/plugins/select2/js/select2.min.js')); ?>"></script>
<!-- Fancybox JS -->
<script src="<?php echo e(asset('assets/plugins/fancybox/jquery.fancybox.min.js')); ?>"></script>
<!-- Dropzone JS -->
<script src="<?php echo e(asset('assets/plugins/dropzone/dropzone.min.js')); ?>"></script>

<!-- Bootstrap Tagsinput JS -->
<script src="<?php echo e(asset('assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.js')); ?>"></script>

<!-- Profile Settings JS -->
<script src="<?php echo e(asset('assets/js/profile-settings.js')); ?>"></script>
<!-- Circle Progress JS -->
<script src="<?php echo e(asset('assets/js/circle-progress.min.js')); ?>"></script>
<!-- Slick JS -->
<script src="<?php echo e(asset('assets/js/slick.js')); ?>"></script>
<!-- NoUISlider JS -->
<script src="<?php echo e(asset('assets/plugins/nouislider/nouislider.min.js')); ?>"></script>

<!-- Custom JS -->
<script src="<?php echo e(asset('assets/js/script.js')); ?>"></script>
<script src="<?php echo e(asset('js/script.js')); ?>"></script>
<?php echo $__env->yieldContent('footer-script'); ?>
<?php if(Route::is(['map-grid','map-list'])): ?>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD6adZVdzTvBpE2yBRK8cDfsss8QXChK0I"></script>
    <script src="<?php echo e(asset('assets/js/map.js')); ?>"></script>
<?php endif; ?>
<?php /**PATH W:\domains\docure\resources\views/layout/partials/footer-scripts.blade.php ENDPATH**/ ?>