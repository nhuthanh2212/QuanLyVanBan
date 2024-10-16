@extends('layouts.app')
@section('content')
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0">Chi Tiết {{$taikhoan->HoTen}}</h1>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Home</a></li>
               <li class="breadcrumb-item"><a href="{{Route( 'user.index')}}">Danh Sách Tài Khoản</a></li>
               <li class="breadcrumb-item active">{{$taikhoan->HoTen}}</li>
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
               
                  <div class="card-body">
                     <div class="form-group row">
                        <label style="margin-right: 5px;">Họ Tên: </label>
                        <h5>{{$taikhoan->HoTen}}</h5>
                     </div>
                     
                     <div class="form-group row">
                        <label  style="margin-right: 5px;" >Giới Tính: </label>
                        @if($taikhoan->GioiTinh == 1)
                            <h5>Nam</h5>
                        @else
                            <h5>Nữ</h5>
                        @endif
                        <label style="margin-right: 5px; margin-left: 20px">Ngày Sinh: </label>
                        <h5>{{$taikhoan->NamSinh}}</h5>
                     </div>
                     <div class="form-group row">
                        <label style="margin-right: 5px;">Số Điện Thoại: </label>
                        <h5>{{$taikhoan->DienThoai}}</h5>
                     </div>
                     <div class="form-group row">
                        <label  style="margin-right: 5px;">Email: </label>
                        <h5>{{$taikhoan->Gmail}}</h5>
                     </div>
                     <div class="form-group row">
                        <label  style="margin-right: 5px;">Địa Chỉ: </label>
                        <h5>{{$taikhoan->DiaChi}}</h5>
                     </div>
                     
                     <div class="form-group row">
                        <label style="margin-right: 5px;">Thuộc Phòng Ban:</label>
                        <h5>{{$taikhoan->nhom->TenGroup}}</h5>
                     </div>
                     <div class="form-group row">
                        <label style="margin-right: 5px;">Chức Vụ:</label>
                        <h5>{{$taikhoan->chucvu->TenCV}}</h5>
                     </div>
                     
                  </div>
                  <div class="card-footer">
                    
                     <a href="{{route('user.index')}}"><button type="button" class="btn btn-light">Quay Lại </button></a>
                  </div>
              
            </div>
         </div>
      </div>
   </div>
</section>
@endsection
