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

        <li class="menu-title">
          <span>Users</span>
        </li>
        <li class="<?php echo e(Request::is('admin/doctors-list*') ? 'active' : ''); ?>">
          <a href="<?php echo e(route('admin.doctors-list')); ?>"><i class="fe fe-user"></i> <span>Doctors</span></a>
        </li>
        <li class="<?php echo e(Request::is('admin/patients-list*') ? 'active' : ''); ?>">
          <a href="<?php echo e(route('admin.patients-list')); ?>"><i class="fe fe-user-plus"></i> <span>Patients</span></a>
        </li>

        <li class="menu-title">
          <span>Pages</span>
        </li>
        <li class="<?php echo e(Request::is('admin/medicine-list*') ? 'active' : ''); ?>">
          <a href="<?php echo e(route('admin.medicine-list')); ?>"><i class="fe fe-text-align-left"></i> <span>Medicine List</span></a>
        </li>
        <li class="<?php echo e(Request::is('admin/diseases-list*') ? 'active' : ''); ?>">
          <a href="<?php echo e(route('admin.diseases-list')); ?>"><i class="fe fe-book"></i> <span>Diseases</span></a>
        </li>
        <li class="submenu">
          <a href="#"><i class="fe fe-cart"></i> <span>Online Store</span> <span class="menu-arrow"></span></a>
          <ul style="display: none;">
            <li><a class="<?php echo e(Request::is('admin/online-store') ? 'active' : ''); ?>" href="<?php echo e(route('admin.online-store')); ?>">Processing</a></li>
            <li><a class="<?php echo e(Request::is('admin/online-store/dismissed') ? 'active' : ''); ?>" href="<?php echo e(route('admin.online-store.dismissed')); ?>">Dismissed</a></li>
            <li><a class="<?php echo e(Request::is('admin/online-store/successful') ? 'active' : ''); ?>" href="<?php echo e(route('admin.online-store.successful')); ?>">Successful</a></li>
          </ul>
        </li>
        <li class="<?php echo e(Request::is('admin/transactions-list') ? 'active' : ''); ?>">
          <a href="#"><i class="fe fe-activity"></i> <span>Transactions</span></a>
        </li>

        <li class="menu-title">
          <span>Support</span>
        </li>
        <li class="<?php echo e(Request::is('admin/support*') ? 'active' : ''); ?>">
          <a href="<?php echo e(route('admin.support')); ?>"><i class="fe fe-users"></i> <span>Support</span></a>
        </li>

        <li class="menu-title">
          <span>UI Interface</span>
        </li>
        <li class="<?php echo e(Request::is('admin/components') ? 'active' : ''); ?>">
          <a href="components"><i class="fe fe-vector"></i> <span>Components</span></a>
        </li>
        <li class="submenu">
          <a href="#"><i class="fe fe-layout"></i> <span> Forms </span> <span class="menu-arrow"></span></a>
          <ul style="display: none;">
            <li><a class="<?php echo e(Request::is('admin/form-basic-inputs') ? 'active' : ''); ?>" href="<?php echo e(url('admin/form-basic-inputs')); ?>">Basic Inputs </a></li>
            <li><a class="<?php echo e(Request::is('admin/form-input-groups') ? 'active' : ''); ?>" href="<?php echo e(url('admin/form-input-groups')); ?>">Input Groups </a></li>
            <li><a class="<?php echo e(Request::is('admin/form-horizontal') ? 'active' : ''); ?>" href="<?php echo e(url('admin/form-horizontal')); ?>">Horizontal Form</a></li>
            <li><a class="<?php echo e(Request::is('admin/form-vertical') ? 'active' : ''); ?>" href="<?php echo e(url('admin/form-vertical')); ?>"> Vertical Form </a></li>
            <li><a class="<?php echo e(Request::is('admin/form-mask') ? 'active' : ''); ?>" href="<?php echo e(url('admin/form-mask')); ?>"> Form Mask </a></li>
            <li><a class="<?php echo e(Request::is('admin/form-validation') ? 'active' : ''); ?>" href="<?php echo e(url('admin/form-validation')); ?>"> Form Validation </a></li>
          </ul>
        </li>
        <li class="submenu">
          <a href="#"><i class="fe fe-table"></i> <span> Tables </span> <span class="menu-arrow"></span></a>
          <ul style="display: none;">
            <li><a class="<?php echo e(Request::is('admin/tables-basic') ? 'active' : ''); ?>" href="<?php echo e(url('admin/tables-basic')); ?>">Basic Tables </a></li>
            <li><a class="<?php echo e(Request::is('admin/data-tables') ? 'active' : ''); ?>" href="<?php echo e(url('admin/data-tables')); ?>">Data Table </a></li>
          </ul>
        </li>
        <li class="submenu">
          <a href="javascript:void(0);"><i class="fe fe-code"></i> <span>Multi Level</span> <span class="menu-arrow"></span></a>
          <ul style="display: none;">
            <li class="submenu">
              <a href="javascript:void(0);"> <span>Level 1</span> <span class="menu-arrow"></span></a>
              <ul style="display: none;">
                <li><a href="javascript:void(0);"><span>Level 2</span></a></li>
                <li class="submenu">
                  <a href="javascript:void(0);"> <span> Level 2</span> <span class="menu-arrow"></span></a>
                  <ul style="display: none;">
                    <li><a href="javascript:void(0);">Level 3</a></li>
                    <li><a href="javascript:void(0);">Level 3</a></li>
                  </ul>
                </li>
                <li><a href="javascript:void(0);"> <span>Level 2</span></a></li>
              </ul>
            </li>
            <li>
              <a href="javascript:void(0);"> <span>Level 1</span></a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</div>
<!-- /Sidebar -->
<?php /**PATH W:\domains\docure\resources\views/layout/partials/nav_admin.blade.php ENDPATH**/ ?>