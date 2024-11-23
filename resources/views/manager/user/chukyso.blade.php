@extends('layouts.app')
@section('content')
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0">Tạo Chữ Ký Số</h1>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Home</a></li>
             
               <li class="breadcrumb-item active">Tạo Chữ Ký Số</li>
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
               <form method="post" action="{{route('chu-ky-so.store')}}" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                     <div class="form-group">
                        <?php
                            use Illuminate\Support\Facades\Session;
                            $id = Session::get('id');
                            
                        ?>
                        <label for="exampleInputEmail1">Họ Tên: </label>
                        <input type="text" class="form-control" name="HoTen" id="exampleInputEmail1" placeholder="...">
                        <input type="hidden" class="form-control" name="id" value="{{$id}}">
                     </div>
                    
                     <div class="form-group">
                        <label for="exampleInputEmail1">Số Điện Thoại: </label>
                        <input type="text" class="form-control" name="DienThoai" id="exampleInputEmail1" placeholder="...">
                     </div>
                     <div class="form-group">
                        <label for="exampleInputEmail1">Số CCCD/(CMND): </label>
                        <input type="text" class="form-control" name="CCCD" id="exampleInputEmail1" placeholder="...">
                     </div>
                     
                    
                  </div>
                  <div class="card-footer">
                     <button type="submit" class="btn btn-primary">Tạo</button>
                     <a href="{{URL::to('/home')}}"><button type="button" class="btn btn-light">Quay Lại </button></a>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</section>
@endsection
