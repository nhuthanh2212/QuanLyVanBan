@extends('layouts.app')
@section('content')
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0">Cập Nhật Phòng Ban</h1>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Home</a></li>
               <li class="breadcrumb-item"><a href="{{Route( 'phong-ban.index')}}">Danh Sách Phòng Ban</a></li>
               <li class="breadcrumb-item active">Cập Nhật Phòng Ban</li>
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
               <form method="post" action="{{route('phong-ban.update',[$phongban->id])}}" enctype="multipart/form-data">
                  @method('PUT')
                  @csrf
                  <div class="card-body">
                     <div class="form-group">
                        <label for="exampleInputEmail1">Tên Phòng Ban: </label>(<span style="color:red;">*</span>)
                        <input type="text" class="form-control" value="{{$phongban->TenPB}}" name="TenPB" id="exampleInputEmail1" placeholder="...">
                     </div>
                     <div class="form-group">
                        <label for="exampleInputPassword1">Mô Tả: </label>(<span style="color:red;">*</span>)
                        <textarea style="resize: none;" rows="8" class="form-control" name="MoTaPB" id="ckeditor" placeholder="...">{!!$phongban->MoTaPB!!}</textarea>
                     </div>
                     <div class="form-group">
                        <label for="exampleInputEmail1">Thuộc Khối: </label>(<span style="color:red;">*</span>)
                        <select name="id_K" class="form-control input-sm m-bot15">
                           <option >------Chọn------</option>
                           @foreach($khoi as $key => $k)
                           <option value="{{$k->id}}" {{ $k->id == $phongban->id_K ? 'selected="selected"' : '' }}>{{$k->TenK}}</option>
                           @endforeach
                        </select>
                     </div>
                     <div class="form-group">
                        <label>
                        <input name="TrangThai" type="radio" id="TrangThai" value="1"
                           <?php if($phongban->TrangThai == 1){ echo 'checked=checked';} ?> />
                        Hiển Thị</label>
                        <br />
                        <label>
                        <input type="radio" name="TrangThai" value="0" id="TrangThai" <?php if($phongban->TrangThai == 0){ echo 'checked=checked';} ?> />
                        Ẩn</label>
                        <br />
                     </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                     <button type="submit" class="btn btn-primary">Lưu</button>
                     <a href="{{route('phong-ban.index')}}"><button type="button" class="btn btn-light">Quay Lại </button></a>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
   <!-- /.container-fluid -->
</section>
@endsection
