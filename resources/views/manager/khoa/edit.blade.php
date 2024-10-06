@extends('layouts.app')
@section('content')
<div class="content">
      <div class="container-fluid">
      	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Cập Nhật Khoa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL::to('manager')}}">Home</a></li>
              <li class="breadcrumb-item active">Cập Nhật Khoa</li>
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
              <form method="post" action="{{route('khoa.update',[$khoa->id])}}" enctype="multipart/form-data">
                @method('PUT')
              	@csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tên Khoa: </label>
                    <input type="text" class="form-control" value="{{$khoa->TenKhoa}}" name="TenKhoa" id="exampleInputEmail1" placeholder="...">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Mô Tả: </label>
                    <textarea style="resize: none;" rows="8" class="form-control" name="MoTaKhoa" id="ckeditor" placeholder="...">{!!$khoa->MoTaKhoa!!}</textarea>
                    
                  </div>
                  <div class="form-group">
                                <label for="exampleInputEmail1">Trường</label>
                                <select name="id_Truong" class="form-control input-sm m-bot15">
                                    <option >------Chọn------</option>
                                    @foreach($truong as $key => $school)
                                    <option value="{{$school->id}}" {{ $school->id == $khoa->id_Truong ? 'selected="selected"' : '' }}>{{$school->TenTruong}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                  <div class="form-group">
                  <label>
                        <input name="TrangThai" type="radio" id="TrangThai" value="1"
                        <?php if($khoa->TrangThai == 1){ echo 'checked=checked';} ?> />
                        Hiển Thị</label>
                        <br />
                        <label>
                        <input type="radio" name="TrangThai" value="0" id="TrangThai" <?php if($khoa->TrangThai == 0){ echo 'checked=checked';} ?> />
                        Ẩn</label>
                        <br />
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Lưu</button>
                  <a href="{{route('khoa.index')}}"><button type="button" class="btn btn-light">Quay Lại </button></a>
                </div>
              </form>
</div>
</div>
</div>
@endsection