<!-- Sidebar -->
<div class="sidebar" id="sidebar">
  <div class="sidebar-inner slimscroll">
    <div id="sidebar-menu" class="sidebar-menu">
      <ul>
        <li class="menu-title">
          <span>Main</span>
        </li>
        <li class="<?php echo e(Route::current()->getName() == 'admin.dashboard' ? 'active' : ''); ?>">
          <a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fe fe-home"></i> <span>Dashboard</span></a>
        </li>

        <?php if(auth()->user()->hasRole('Admin')): ?>
          <li class="menu-title">
            <span>Users</span>
          </li>
          <li class="<?php echo e(Request::is('admin/doctors-list*') ? 'active' : ''); ?>">
            <a href="<?php echo e(route('admin.doctors-list')); ?>"><i class="fe fe-user"></i> <span>Doctors</span></a>
          </li>
          <li class="<?php echo e(Request::is('admin/patients-list*') ? 'active' : ''); ?>">
            <a href="<?php echo e(route('admin.patients-list')); ?>"><i class="fe fe-user-plus"></i> <span>Patients</span></a>
          </li>
        <?php endif; ?>

        <li class="menu-title">
          <span>Pages</span>
        </li>
        <li class="<?php echo e(Request::is('admin/medicine-list*') ? 'active' : ''); ?>">
          <a href="<?php echo e(route('admin.medicine-list')); ?>"><i class="fe fe-text-align-left"></i> <span>Medicine List</span></a>
        </li>
        <?php if(auth()->user()->hasRole('Admin')): ?>
        <li class="<?php echo e(Request::is('admin/diseases-list*') ? 'active' : ''); ?>">
          <a href="<?php echo e(route('admin.diseases-list')); ?>"><i class="fe fe-book"></i> <span>Diseases</span></a>
        </li>
        <?php endif; ?>
        <li class="submenu">
          <a href="#"><i class="fe fe-cart"></i> <span>Online Store</span> <span class="menu-arrow"></span></a>
          <ul style="display: none;">
            <li><a class="<?php echo e(Request::is('admin/online-store') ? 'active' : ''); ?>" href="<?php echo e(route('admin.online-store')); ?>">Processing</a></li>
            <li><a class="<?php echo e(Request::is('admin/online-store/dismissed') ? 'active' : ''); ?>" href="<?php echo e(route('admin.online-store.dismissed')); ?>">Dismissed</a></li>
            <li><a class="<?php echo e(Request::is('admin/online-store/successful') ? 'active' : ''); ?>" href="<?php echo e(route('admin.online-store.successful')); ?>">Successful</a></li>
          </ul>
        </li>

        <?php if(auth()->user()->hasRole('Admin')): ?>
        <li class="menu-title">
          <span>Support</span>
        </li>
        <li class="<?php echo e(Request::is('admin/support*') ? 'active' : ''); ?>">
          <a href="<?php echo e(route('admin.support')); ?>"><i class="fe fe-users"></i> <span>Support</span></a>
        </li>
        <?php endif; ?>

        <?php if(auth()->user()->hasRole('Admin')): ?>
        <li class="menu-title">
          <span>Settings</span>
        </li>
        <li class="<?php echo e(Request::is('admin/support*') ? 'active' : ''); ?>">
          <a href="<?php echo e(route('admin.settings')); ?>"><i class="fe fe-wrench"></i> <span>Settings</span></a>
        </li>
        <?php endif; ?>

        
      </ul>
    </div>
  </div>
</div>
<!-- /Sidebar -->
<?php /**PATH /home/a/alexstrilby/ayrveda/resources/views/layout/partials/nav_admin.blade.php ENDPATH**/ ?>