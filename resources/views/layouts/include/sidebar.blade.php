<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{URL::to('manager')}}" class="brand-link">
      <img src="{{asset('backend/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('backend/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item {{Request::segment(1) == 'manager' ? 'menu-is-opening menu-open' : ''}}">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Managers
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              <li class="nav-item">
                <a href="{{route('loai-van-ban.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Loại Văn Bản</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('don-vi-cap-cao.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Đơn Vị Cấp Cao</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('truong.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Trường Thành Viên</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('khoa.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Khoa</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('trung-tam.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Trung Tâm</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('hanh-chinh.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Khối Hành Chính</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('phuc-vu.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Khối Phục Vụ</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('to-chuc.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tổ Chức Đoàn Thể</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('chuc-vu.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Chức Vụ</p>
                </a>
              </li>
            </ul>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>