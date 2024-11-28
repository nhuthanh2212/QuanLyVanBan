@extends('layouts.app')
@section('content')
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0">Thêm Tài Khoản</h1>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Home</a></li>
               <li class="breadcrumb-item"><a href="{{Route( 'user.index')}}">Danh Sách Tài Khoản</a></li>
               <li class="breadcrumb-item active">Thêm Tài Khoản</li>
            </ol>
         </div>
         <!-- /.col -->
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>
<section class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <div class="card card-primary">
               <div class="card-header">
                  <h3 class="card-title"></h3>
               </div>
               @if ($errors->any())
               <div class="alert alert-danger">
                  <ul>
                     @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                     @endforeach
                  </ul>
               </div>
               @endif
               <!-- /.card-header -->
               <!-- form start -->
               <form method="post" action="{{route('user.store')}}" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                     <div class="form-group">
                        <label for="exampleInputEmail1">Họ Tên: </label>
                        <input type="text" class="form-control" name="HoTen" id="exampleInputEmail1" placeholder="...">
                     </div>
                     <div class="form-group">
                        <label for="exampleInputEmail1" >Hình Ảnh: </label>
                        <input type="file" class="form-control form-control-sm" id="formFileSm" name="img"  >
                     </div>
                     <div class="form-group">
                        <label for="exampleInputEmail1" style="margin-right: 10px;" >Giới Tính: </label>
                        <label for="exampleInputEmail1" style="margin-right: 10px;"><input type="radio" name="GioiTinh" value="1" checked> Nam</label>
                        <label for="exampleInputEmail1" style="margin-right: 20px;" ><input type="radio" name="GioiTinh" value="0" > Nữ</label><br>
                        <label for="exampleInputEmail1" style="margin-right: 10px;">Năm Sinh: </label>
                        <input  name="NamSinh" type="text" id="datepicker" placeholder=" ">
                     </div>
                     <div class="form-group">
                        <label for="exampleInputPassword1">Địa Chỉ: </label>
                        <textarea style="resize: none;" rows="8" class="form-control" name="DiaChi" id="ckeditor" placeholder="..."></textarea>
                     </div>
                     <div class="form-group">
                        <label for="exampleInputEmail1">Số Điện Thoại: </label>
                        <input type="text" class="form-control" name="DienThoai" id="exampleInputEmail1" placeholder="...">
                     </div>
                     <div class="form-group">
                        <label for="exampleInputEmail1">Email: </label>
                        <input type="text" class="form-control" name="Gmail" id="exampleInputEmail1" placeholder="...">
                     </div>
                     <div class="form-group">
                        <label for="exampleInputEmail1">Thuộc Phòng Ban</label>
                        <select name="id_Gr" class="form-control input-sm m-bot15">
                           <option >------Chọn------</option>
                           @foreach($nhom as $key => $nh)
                           <option value="{{$nh->id}}">{{ Str::afterLast($nh->TenGroup, '-') }}</option>
                           @endforeach
                        </select>
                     </div>
                     <div class="form-group">
                        <label for="exampleInputEmail1">Chức Vụ</label>
                        <select name="id_CV" class="form-control input-sm m-bot15">
                           <option >------Chọn------</option>
                           @foreach($chucvu as $key => $cv)
                           <option value="{{$cv->id}}">{{$cv->TenCV}}</option>
                           @endforeach
                        </select>
                     </div>
                     <div class="form-group">
                        <label for="exampleInputEmail1">Tên Đăng Nhập: </label>
                        <input type="text" class="form-control" name="TenDN" id="exampleInputEmail1" placeholder="...">
                     </div>
                     <div class="form-group">
                        <label for="exampleInputEmail1">PassWord: </label>
                        <input type="password" class="form-control" name="password" id="exampleInputEmail1" placeholder="...">
                     </div>
                  </div>
                  <div class="card-footer">
                     <button type="submit" class="btn btn-primary">Thêm</button>
                     <a href="{{route('user.index')}}"><button type="button" class="btn btn-light">Quay Lại </button></a>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</section>
@endsection
