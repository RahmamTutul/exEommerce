 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.dashboard')}}" class="brand-link text-center">
      <span class="brand-text font-weight-light">EX-COMMERCE</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('storage/images/admin/profile/'.Auth::guard('admin')->user()->image)}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::guard('admin')->user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{route('admin.dashboard')}}" class="nav-link {{ (request()->is('admin/dashboard')) ? 'active' : '' }}">
                <i class="nav-icon  fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
        <li class="nav-item has-treeview {{ (request()->is('admin/settings') || request()->is('admin/update/info')) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ (request()->is('admin/settings') || request()->is('admin/update/info')) ? 'active' : '' }}">
              {{-- <i class="nav-icon fas fa-th"></i> --}}
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.settings')}}" class="nav-link {{ (request()->is('admin/settings')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update Password</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.update.info')}}" class="nav-link {{ (request()->is('admin/update/info')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update Info</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="{{url('admin/other-settings')}}" class="nav-link {{ (request()->is('admin/other-settings')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update cart value</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview {{ (request()->is('admin/section/index') || request()->is('admin/category')) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ (request()->is('admin/section/index') || request()->is('admin/category')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Itmes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.section.index')}}" class="nav-link {{ (request()->is('admin/section/index')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sections</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.category.index')}}" class="nav-link {{ (request()->is('admin/category')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categories</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{route('product.index')}}" class="nav-link {{ (request()->is('product/*')) ? 'active' : '' }}">
                <i class="nav-icon  fas fa-tachometer-alt"></i>
                <p>
                    Products
                </p>
            </a>
          </li>
          @if (Auth::guard('admin')->user()->type=="superadmin" || Auth::guard('admin')->user()->type=="admin")
          <li class="nav-item">
            <a href="{{url('/admin/admin-subadmin')}}" class="nav-link {{ (request()->is('/admin/admin-subadmin/*')) ? 'active' : '' }}">
                <i class="nav-icon  fas fa-tachometer-alt"></i>
                <p>
                    Admin / Subadmins
                </p>
            </a>
          </li>
          @endif
          <li class="nav-item">
            <a href="{{route('admin.brands.index')}}" class="nav-link {{ (request()->is('admin/brands')) ? 'active' : '' }}">
                <i class="nav-icon  fas fa-tachometer-alt"></i>
                <p>
                    Brands
                </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('admin/coupon/index')}}" class="nav-link {{ (request()->is('admin/coupon/*')) ? 'active' : '' }}">
                <i class="nav-icon  fas fa-tachometer-alt"></i>
                <p>
                   Coupons
                </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.banner.index')}}" class="nav-link {{ (request()->is('admin/banner/*')) ? 'active' : '' }}">
                <i class="nav-icon  fas fa-tachometer-alt"></i>
                <p>
                   Bannner Info
                </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('admin/order/index')}}" class="nav-link {{ (request()->is('admin/order/*')) ? 'active' : '' }}">
                <i class="nav-icon  fas fa-tachometer-alt"></i>
                <p>
                   Orders
                </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('admin/cms/index')}}" class="nav-link {{ (request()->is('admin/cms/*')) ? 'active' : '' }}">
                <i class="nav-icon  fas fa-tachometer-alt"></i>
                <p>
                   CMS
                </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('admin/shipping/index')}}" class="nav-link {{ (request()->is('admin/shipping/*')) ? 'active' : '' }}">
                <i class="nav-icon  fas fa-tachometer-alt"></i>
                <p>
                   Shipping Charges
                </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('admin/ratting/index')}}" class="nav-link {{ (request()->is('admin/ratting/*')) ? 'active' : '' }}">
                <i class="nav-icon  fas fa-tachometer-alt"></i>
                <p>
                   Rattings/Reviews
                </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
