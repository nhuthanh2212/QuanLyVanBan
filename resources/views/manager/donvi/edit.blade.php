@extends('layouts.app')
@section('content')
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0">Cập Nhật Đơn Vị</h1>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Home</a></li>
               <li class="breadcrumb-item"><a href="{{Route( 'don-vi.index')}}">Danh Sách Đơn Vị</a></li>
               <li class="breadcrumb-item active">Cập Nhật Đơn Vị</li>
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
               <form method="post" action="{{route('don-vi.update',[$donvi->id])}}" enctype="multipart/form-data">
                  @method('PUT')
                  @csrf
                  <div class="card-body">
                     <div class="form-group">
                        <label for="exampleInputEmail1">Tên Đơn Vị: </label>
                        <input type="text" class="form-control" value="{{$donvi->TenDV}}" name="TenDV" id="exampleInputEmail1" placeholder="...">
                     </div>
                     <div class="form-group">
                        <label for="exampleInputPassword1">Mô Tả: </label>
                        <textarea style="resize: none;" rows="8" class="form-control" name="MoTaDV" id="ckeditor" placeholder="...">{!!$donvi->MoTaDV!!}</textarea>
                     </div>
                     <div class="form-group">
                        <label for="exampleInputEmail1">Thuộc Phòng Ban:</label>
                        <select name="id_PB" class="form-control input-sm m-bot15">
                           <option >------Chọn------</option>
                           @foreach($phongban as $key => $pb)
                           <option value="{{$pb->id}}" {{ $pb->id == $donvi->id_PB ? 'selected="selected"' : '' }}>{{$pb->TenPB}}</option>
                           @endforeach
                        </select>
                     </div>
                     <div class="form-group">
                        <label>
                        <input name="TrangThai" type="radio" id="TrangThai" value="1"
                           <?php if($donvi->TrangThai == 1){ echo 'checked=checked';} ?> />
                        Hiển Thị</label>
                        <br />
                        <label>
                        <input type="radio" name="TrangThai" value="0" id="TrangThai" <?php if($donvi->TrangThai == 0){ echo 'checked=checked';} ?> />
                        Ẩn</label>
                        <br />
                     </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                     <button type="submit" class="btn btn-primary">Lưu</button>
                     <a href="{{route('don-vi.index')}}"><button type="button" class="btn btn-light">Quay Lại </button></a>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</section>
@endsection
