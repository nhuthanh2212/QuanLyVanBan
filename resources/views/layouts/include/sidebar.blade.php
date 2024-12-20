<aside class="main-sidebar sidebar-dark-primary elevation-4">
   <!-- Brand Logo -->
   <a href="{{URL::to('/home')}}" class="brand-link">
   <img src="{{asset('backend/img/logo.jpg')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
   <span class="brand-text font-weight-light">Quản Lý Văn Bản</span>
   </a>
   <!-- Sidebar -->
   <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
         <?php
            use App\Models\TaiKhoan;
            use Illuminate\Support\Facades\Session;
                $name = Session::get('name');
                $id = Session::get('id');
                $slug = TaiKhoan::where('id_TK',$id)->first();
                ?>
         <div class="image">
            <img src="{{asset('/uploads/img/'.$slug->img)}}" class="img-circle elevation-2 " style="width: 40px;height: 35px;" alt="{{$slug->HoTen}}">
         </div>
         <div class="info">
            <?php
               if($name){
               ?>
            <a href="{{URL::to('/profile',$slug->slug)}}" class="d-block">
            <?php
               echo $name ;
               ?>
            </a>
            <?php }
               ?>
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
            <li class="nav-item {{Request::segment(1) == 'van-ban' ? 'menu-is-opening menu-open' : ''}}">
               <a href="#" class="nav-link ">
               <i class="fa-solid fa-folder-tree" style="margin-right:5px"></i>
                  <p>
                     Văn Bản 
                     <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="{{route('van-ban-den.index')}}" class="nav-link">
                     <i class="fa-solid fa-file-arrow-down"></i>
                        <p>Văn Bản Đến</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{route('van-ban-di.index')}}" class="nav-link">
                     <i class="fa-solid fa-file-arrow-up"></i>
                        <p>Văn Bản Đi</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{route('van-ban-mau.index')}}" class="nav-link">
                     <i class="fa-regular fa-file"></i>
                        <p>Văn Bản Mẫu</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{route('luu-tru.index')}}" class="nav-link">
                     <i class="fa-solid fa-database"></i>
                        <p>Lưu Trữ</p>
                     </a>
                  </li>
               </ul>
            </li>
            @role('admin')
            <li class="nav-item {{Request::segment(1) == 'manager' ? 'menu-is-opening menu-open' : ''}}">
               <a href="#" class="nav-link ">
                  <i class="nav-icon fa-solid fa-bars-progress"></i>
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
                     <a href="{{URL::to('/manager/noi-nhan-loai-van-ban')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Nhận Theo Loại Văn Bản</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{route('chuc-vu.index')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Chức Vụ</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{route('khoi.index')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Khối</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{route('phong-ban.index')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Phòng Ban</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{route('don-vi.index')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Đơn Vị</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{route('phong.index')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Phòng</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{route('nganh.index')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Ngành</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{route('chuyen-nganh.index')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Chuyên Ngành</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{route('chu-ky-so.index')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Chữ Ký Số</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{URL::to('/manager/group')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Group</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{route('user.index')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Người Dùng</p>
                     </a>
                  </li>
               </ul>
            </li>
            @endrole
         </ul>
      </nav>
      <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
</aside>
