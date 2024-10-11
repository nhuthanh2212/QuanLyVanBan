@extends('layouts.app')
@section('content')
<div class="content">
      <div class="container-fluid">
      	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Cập Nhật Tài Khoản</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{Route( 'user.index')}}">Danh Sách Tài Khoản</a></li>
              <li class="breadcrumb-item active">Cập Nhật Tài Khoản</li>
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
              <form method="post" action="{{route('user.update',[$tk->id_TK])}}" enctype="multipart/form-data">
              	@csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Họ Tên: </label>
                        <input type="text" class="form-control" name="HoTen" value="{{$tk->HoTen}}" id="exampleInputEmail1" placeholder="...">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Giới Tính</label>
                        <select name="GioiTinh" class="form-control input-sm m-bot15 ">
                            <option >------Chọn------</option>
                            <option  {{ $tk->GioiTinh == 1 ? 'selected="selected"' : '' }} value="1">Nam</option>
                            <option {{ $tk->GioiTinh == 0 ? 'selected="selected"' : '' }} value="0">Nữ</option>
                                  
                                    
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Năm Sinh: </label>
                        <input  name="NamSinh" type="text" id="departure_date" placeholder=" " value="{{$tk->NamSinh}}">
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputPassword1">Địa Chỉ: </label>
                        <textarea style="resize: none;" rows="8" class="form-control" name="DiaChi" id="ckeditor" placeholder="...">value="{!! $tk->DiaChi !!}</textarea>
                        
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Số Điện Thoại: </label>
                        <input type="text" class="form-control" name="DienThoai" value="{{$tk->DienThoai}}" id="exampleInputEmail1" placeholder="...">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email: </label>
                        <input type="text" class="form-control" name="Email" value="{{$tk->Email}}" id="exampleInputEmail1" placeholder="...">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Chức Vụ</label>
                        <select name="id_Truong" class="form-control input-sm m-bot15">
                                    <option >------Chọn------</option>
                                    @foreach($chucvu as $key => $cv)
                                    <option  {{ $cv->id == $tk->id_CV ? 'selected="selected"' : '' }} value="{{$cv->id}}">{{$cv->TenCV}}</option>
                                    @endforeach
                                    
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên Đăng Nhập: </label>
                        <input type="text" class="form-control" name="TenDN" value="{{$tk->TenDN}}" id="exampleInputEmail1" placeholder="...">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">PassWord: </label>
                        <input type="password" class="form-control" name="password" value="{{$tk->password}}" id="exampleInputEmail1" placeholder="...">
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Thêm</button>
                  <a href="{{route('user.index')}}"><button type="button" class="btn btn-light">Quay Lại </button></a>
                </div>
              </form>
</div>
</div>
</div>
@endsection