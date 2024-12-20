@extends('layouts.app')
@section('content')
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0">Cập Nhật Loại Văn Bản</h1>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Home</a></li>
               <li class="breadcrumb-item"><a href="{{Route( 'loai-van-ban.index')}}">Danh Sách Loại Văn bản</a></li>
               <li class="breadcrumb-item active">Cập Nhật Loại Văn Bản</li>
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
               <form method="post" action="{{route('loai-van-ban.update',[$loai->id_LVB])}}" enctype="multipart/form-data">
                  @method('PUT')
                  @csrf
                  <div class="card-body">
                     <div class="form-group">
                        <label for="exampleInputEmail1">Tên Loại Văn Bản: </label>(<span style="color:red;">*</span>)
                        <input type="text" class="form-control" value="{{$loai->TenLVB}}" name="TenLVB" id="exampleInputEmail1" placeholder="...">
                     </div>
                     <div class="form-group">
                        <label for="exampleInputPassword1">Mô Tả: </label>(<span style="color:red;">*</span>)
                        <textarea style="resize: none;" rows="8" class="form-control" name="MoTaLVB" id="ckeditor" placeholder="...">{!!$loai->MoTaLVB!!}</textarea>
                     </div>
                     <div class="form-group">
                        <label>
                        <input name="TrangThai" type="radio" id="TrangThai" value="1"
                           <?php if($loai->TrangThai == 1){ echo 'checked=checked';} ?> />
                        Hiển Thị</label>
                        <br />
                        <label>
                        <input type="radio" name="TrangThai" value="0" id="TrangThai" <?php if($loai->TrangThai == 0){ echo 'checked=checked';} ?> />
                        Ẩn</label>
                        <br />
                     </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                     <button type="submit" class="btn btn-primary">Lưu</button>
                     <a href="{{route('loai-van-ban.index')}}"><button type="button" class="btn btn-light">Quay Lại</button></a>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
   <!-- /.container-fluid -->
</section>
@endsection
