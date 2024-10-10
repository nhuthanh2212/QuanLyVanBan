@extends('layouts.app')
@section('content')

<div class="content">
      <div class="container-fluid">
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0">Chi Tiết {{$vanbandi_chitiet->TenVB}}</h1>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Home</a></li>
               <li class="breadcrumb-item"><a href="{{Route('van-ban-di.index')}}">Văn Bản Đi</a></li>
               <li class="breadcrumb-item active">{{$vanbandi_chitiet->TenVB}}</li>
            </ol>
         </div>
         <!-- /.col -->
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
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
              <form >
              	@csrf
                <div class="card-body">
                    <div class="form-group">
                    <label for="exampleInputEmail1" style="margin-right: 5px;">Tên Văn bản: </label>
                    <span>{{$vanbandi_chitiet->TenVB}}</span>
                   
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1" style="margin-right: 5px;">Số Hiệu: </label>
                    <span>{{$vanbandi_chitiet->SoHieu}}</span>
                    
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1" style="margin-right: 5px;">Loại Văn Bản: </label>
                    <span>{{$theloai->TenLVB}}</span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1" style="margin-right: 5px;">Ngày Gửi: </label>
                    <span class="date" data-ngay-gui="{{$vanbandi_chitiet->NgayGui}}"> {{$vanbandi_chitiet->NgayGui}}</span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1" style="margin-right: 5px;">File Đính Kèm: </label>
                    <a href="{{ asset('uploads/vanbandi/'.$vanbandi_chitiet->file) }}" target="_blank" style="margin-right: 5px;"> <span>{{$vanbandi_chitiet->file}}</span></a>
                    
                    <a href="#" class="download-file" data-filename="{{$vanbandi_chitiet->file}}"><button class="btn btn-light btn-sm" type="button"><i class="far fa-trash-alt"></i></button></a>
                    
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Gửi Đến: </label>
                    
                  </div>
                  <!-- Collapsible section -->
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                 
                  <a href="{{route('van-ban-di.index')}}"><button type="button" class="btn btn-light">Quay Lại </button></a>
                </div>
              </form>
</div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>
@endsection
