<!-- Sidebar -->
<div class="sidebar" id="sidebar">
  <div class="sidebar-inner slimscroll">
    <div id="sidebar-menu" class="sidebar-menu">
      <ul>
        <li class="menu-title">
          <span>Main</span>
        </li>
        <li class="{{Route::current()->getName() == 'admin.dashboard' ? 'active' : '' }}">
          <a href="{{route('admin.dashboard')}}"><i class="fe fe-home"></i> <span>Dashboard</span></a>
        </li>

        @if(auth()->user()->hasRole('Admin'))
          <li class="menu-title">
            <span>Users</span>
          </li>
          <li class="{{ Request::is('admin/doctors-list*') ? 'active' : '' }}">
            <a href="{{route('admin.doctors-list')}}"><i class="fe fe-user"></i> <span>Doctors</span></a>
          </li>
          <li class="{{ Request::is('admin/patients-list*') ? 'active' : '' }}">
            <a href="{{route('admin.patients-list')}}"><i class="fe fe-user-plus"></i> <span>Patients</span></a>
          </li>
        @endif

        <li class="menu-title">
          <span>Pages</span>
        </li>
        <li class="{{ Request::is('admin/medicine-list*') ? 'active' : '' }}">
          <a href="{{route('admin.medicine-list')}}"><i class="fe fe-text-align-left"></i> <span>Medicine List</span></a>
        </li>
        @if(auth()->user()->hasRole('Admin'))
        <li class="{{ Request::is('admin/diseases-list*') ? 'active' : '' }}">
          <a href="{{route('admin.diseases-list')}}"><i class="fe fe-book"></i> <span>Diseases</span></a>
        </li>
        @endif
        <li class="submenu">
          <a href="#"><i class="fe fe-cart"></i> <span>Online Store</span> <span class="menu-arrow"></span></a>
          <ul style="display: none;">
            <li><a class="{{ Request::is('admin/online-store') ? 'active' : '' }}" href="{{route('admin.online-store')}}">Processing</a></li>
            <li><a class="{{ Request::is('admin/online-store/dismissed') ? 'active' : '' }}" href="{{route('admin.online-store.dismissed')}}">Dismissed</a></li>
            <li><a class="{{ Request::is('admin/online-store/successful') ? 'active' : '' }}" href="{{route('admin.online-store.successful')}}">Successful</a></li>
          </ul>
        </li>

        @if(auth()->user()->hasRole('Admin'))
        <li class="menu-title">
          <span>Support</span>
        </li>
        <li class="{{ Request::is('admin/support*') ? 'active' : '' }}">
          <a href="{{route('admin.support')}}"><i class="fe fe-users"></i> <span>Support</span></a>
        </li>
        @endif

        @if(auth()->user()->hasRole('Admin'))
        <li class="menu-title">
          <span>Settings</span>
        </li>
        <li class="{{ Request::is('admin/support*') ? 'active' : '' }}">
          <a href="{{route('admin.settings')}}"><i class="fe fe-wrench"></i> <span>Settings</span></a>
        </li>
        @endif

        {{--<li class="menu-title">
          <span>UI Interface</span>
        </li>
        <li class="{{ Request::is('admin/components') ? 'active' : '' }}">
          <a href="components"><i class="fe fe-vector"></i> <span>Components</span></a>
        </li>
        <li class="submenu">
          <a href="#"><i class="fe fe-layout"></i> <span> Forms </span> <span class="menu-arrow"></span></a>
          <ul style="display: none;">
            <li><a class="{{ Request::is('admin/form-basic-inputs') ? 'active' : '' }}" href="{{ url('admin/form-basic-inputs') }}">Basic Inputs </a></li>
            <li><a class="{{ Request::is('admin/form-input-groups') ? 'active' : '' }}" href="{{ url('admin/form-input-groups') }}">Input Groups </a></li>
            <li><a class="{{ Request::is('admin/form-horizontal') ? 'active' : '' }}" href="{{ url('admin/form-horizontal') }}">Horizontal Form</a></li>
            <li><a class="{{ Request::is('admin/form-vertical') ? 'active' : '' }}" href="{{ url('admin/form-vertical') }}"> Vertical Form </a></li>
            <li><a class="{{ Request::is('admin/form-mask') ? 'active' : '' }}" href="{{ url('admin/form-mask') }}"> Form Mask </a></li>
            <li><a class="{{ Request::is('admin/form-validation') ? 'active' : '' }}" href="{{ url('admin/form-validation') }}"> Form Validation </a></li>
          </ul>
        </li>
        <li class="submenu">
          <a href="#"><i class="fe fe-table"></i> <span> Tables </span> <span class="menu-arrow"></span></a>
          <ul style="display: none;">
            <li><a class="{{ Request::is('admin/tables-basic') ? 'active' : '' }}" href="{{ url('admin/tables-basic') }}">Basic Tables </a></li>
            <li><a class="{{ Request::is('admin/data-tables') ? 'active' : '' }}" href="{{ url('admin/data-tables') }}">Data Table </a></li>
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
        </li>--}}
      </ul>
    </div>
  </div>
</div>
<!-- /Sidebar -->
