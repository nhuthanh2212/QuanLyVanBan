@extends('layouts.app')
@section('content')
<div class="content">
      <div class="container-fluid">
      	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Thêm Khoa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('quan-ly-van-ban.index')}}">Home</a></li>
              <li class="breadcrumb-item active">Thêm Khoa</li>
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
              <form method="post" action="{{route('khoa.store')}}" enctype="multipart/form-data">
              	@csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tên Khoa: </label>
                    <input type="text" class="form-control" name="TenKhoa" id="exampleInputEmail1" placeholder="...">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Mô Tả: </label>
                    <textarea style="resize: none;" rows="8" class="form-control" name="MoTaKhoa" id="ckeditor" placeholder="..."></textarea>
                    
                  </div>
                  <div class="form-group">
                                <label for="exampleInputEmail1">Trường</label>
                                <select name="id_Truong" class="form-control input-sm m-bot15">
                                    <option >------Chọn------</option>
                                    @foreach($truong as $key => $school)
                                    <option value="{{$school->id}}">{{$school->TenTruong}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Thêm</button>
                  <button type="button" class="btn btn-light"><a href="{{route('khoa.index')}}">Quay Lại </a></button>
                </div>
              </form>
</div>
</div>
</div>
@endsection