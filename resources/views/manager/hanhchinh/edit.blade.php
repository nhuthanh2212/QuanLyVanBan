@extends('layouts.app')
@section('content')
<div class="content">
      <div class="container-fluid">
      	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Cập Nhật Khối hành Chính</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('quan-ly-van-ban.index')}}">Home</a></li>
              <li class="breadcrumb-item active">Cập Nhật Khối Hành Chính</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
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
              <form method="post" action="{{route('hanh-chinh.update',[$hanhchinh->id])}}" enctype="multipart/form-data">
                @method('PUT')
              	@csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tên Phòng: </label>
                    <input type="text" class="form-control" value="{{$hanhchinh->TenP}}" name="TenP" id="exampleInputEmail1" placeholder="...">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Mô Tả: </label>
                    <textarea style="resize: none;" rows="8" class="form-control" name="MoTaP" id="ckeditor" placeholder="...">{!!$hanhchinh->MoTaP!!}</textarea>
                    
                  </div>
                  <div class="form-group">
                  <label>
                        <input name="TrangThai" type="radio" id="TrangThai" value="1"
                        <?php if($hanhchinh->TrangThai == 1){ echo 'checked=checked';} ?> />
                        Hiển Thị</label>
                        <br />
                        <label>
                        <input type="radio" name="TrangThai" value="0" id="TrangThai" <?php if($hanhchinh->TrangThai == 0){ echo 'checked=checked';} ?> />
                        Ẩn</label>
                        <br />
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Lưu</button>
                  <button type="button" class="btn btn-light"><a href="{{route('hanh-chinh.index')}}">Quay Lại </a></button>
                </div>
              </form>
</div>
</div>
</div>
@endsection