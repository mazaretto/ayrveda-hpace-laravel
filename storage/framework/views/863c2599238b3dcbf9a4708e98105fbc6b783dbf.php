<div class="dashboard-widget">
  <nav class="dashboard-menu">
    <ul>
      <li class="<?php echo e((request()->is('patient/profile'))?'active':null); ?>">
        <a href="<?php echo e(route('patient.dashboard')); ?>">
          <i class="fas fa-columns"></i>
          <span><?php echo e(__('patient_nav.dashboard')); ?></span>
        </a>
      </li>
      <li class="<?php echo e((request()->is('patient/my-diseases'))?'active':null); ?>">
        <a href="<?php echo e(route('patient.diseases')); ?>">
          <i class="fas fa-book-medical"></i>
          <span><?php echo e(__('patient_nav.diseases')); ?></span>
        </a>
      </li>
      <li class="<?php echo e((request()->is('chat'))?'active':null); ?>">
        <a href="<?php echo e(route('chat')); ?>">
          <i class="fas fa-comments"></i>
          <span><?php echo e(__('patient_nav.message')); ?></span>
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
      <li class="<?php echo e((request()->is('patient/uploaded-files'))?'active':null); ?>">
        <a href="<?php echo e(route('patient.files')); ?>">
          <i class="fas fa-file-medical"></i>
          <span><?php echo e(__('patient_nav.uploaded_files')); ?></span>
        </a>
      </li>
      <li class="<?php echo e((request()->is('store'))?'active':null); ?>">
        <a target="_blank" href="<?php echo e(route('store')); ?>">
          <i class="fas fa-store"></i>
          <span><?php echo e(__('patient_nav.shop')); ?></span>
        </a>
      </li>
      <li class="<?php echo e((request()->is('patient/cart'))?'active':null); ?>">
        <a href="<?php echo e(route('patient.cart')); ?>">
          <i class="fas fa-shopping-cart"></i>
          <span><?php echo e(__('patient_nav.cart')); ?></span>
          <small class="unread-msg cart-quantity-total"><?php echo e(\App\Http\Controllers\Store\CartController::total()); ?></small>
        </a>
      </li>
      <li class="<?php echo e((request()->is('patient/purchase-history'))?'active':null); ?>">
        <a href="<?php echo e(route('patient.purchase-history')); ?>">
          <i class="fas fa-dolly-flatbed"></i>
          <span><?php echo e(__('patient_nav.purchase_history')); ?></span>
        </a>
      </li>
      <li class="<?php echo e((request()->is('patient/settings'))?'active':null); ?>">
        <a href="<?php echo e(route('patient.settings')); ?>">
          <i class="fas fa-user-cog"></i>
          <span><?php echo e(__('patient_nav.profile_settings')); ?></span>
        </a>
      </li>
      <li class="<?php echo e((request()->is('patient/logout'))?'active':null); ?>">
        <a href="<?php echo e(route('logout')); ?>">
          <i class="fas fa-sign-out-alt"></i>
          <span><?php echo e(__('auth.Logout')); ?></span>
        </a>
      </li>
    </ul>
  </nav>
</div>
<?php /**PATH W:\domains\docure\resources\views/patient/regular/nav.blade.php ENDPATH**/ ?>