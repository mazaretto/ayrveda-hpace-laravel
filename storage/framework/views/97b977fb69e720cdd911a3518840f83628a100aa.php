<div class="dashboard-widget">
  <nav class="dashboard-menu">
    <ul>
      <li class="<?php echo e((request()->is('doctor/profile'))?'active':null); ?>">
        <a href="<?php echo e(route('doctor.dashboard')); ?>">
          <i class="fas fa-columns"></i>
          <span><?php echo e(__('doctor_nav.dashboard')); ?></span>
        </a>
      </li>
      <li class="<?php echo e((request()->is('doctor/my-patients'))?'active':null); ?>">
        <a href="<?php echo e(route('doctor.my-patients')); ?>">
          <i class="fas fa-user-injured"></i>
          <span><?php echo e(__('doctor_nav.my_patients')); ?></span>
        </a>
      </li>
      <li class="<?php echo e((request()->is('chat'))?'active':null); ?>">
        <a href="<?php echo e(route('chat')); ?>">
          <i class="fas fa-comments"></i>
          <span><?php echo e(__('doctor_nav.message')); ?></span>
          <?php
          $unread = \App\ChatMessage::where([
            ['user_to_id', auth()->user()->id],
            ['read', false],
          ])->count()
          ?>
          <?php if($unread): ?>
          <small class="unread-msg"><?php echo e($unread); ?></small>
          <?php endif; ?>
        </a>
      </li>
      <li class="<?php echo e((request()->is('doctor/social'))?'active':null); ?>">
        <a href="<?php echo e(route('doctor.social')); ?>">
          <i class="fas fa-share-alt"></i>
          <span><?php echo e(__('doctor_nav.social_media')); ?></span>
        </a>
      </li>
      <li class="<?php echo e((request()->is('doctor/settings'))?'active':null); ?>">
        <a href="<?php echo e(route('doctor.settings')); ?>">
          <i class="fas fa-user-cog"></i>
          <span><?php echo e(__('doctor_nav.profile_settings')); ?></span>
        </a>
      </li>
      <li class="<?php echo e((request()->is('doctor/logout'))?'active':null); ?>">
        <a href="<?php echo e(route('logout')); ?>">
          <i class="fas fa-sign-out-alt"></i>
          <span><?php echo e(__('auth.Logout')); ?></span>
        </a>
      </li>
    </ul>
  </nav>
</div>
<?php /**PATH /home/a/alexstrilby/ayrveda/resources/views/doctor/regular/nav.blade.php ENDPATH**/ ?>