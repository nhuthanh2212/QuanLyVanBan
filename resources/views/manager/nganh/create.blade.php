@extends('layouts.app')
@section('content')
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0">Thêm Ngành</h1>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Home</a></li>
               <li class="breadcrumb-item"><a href="{{Route( 'nganh.index')}}">Danh Sách Ngành</a></li>
               <li class="breadcrumb-item active">Thêm Ngành</li>
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
               <form method="post" action="{{route('nganh.store')}}" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                     <div class="form-group">
                        <label for="exampleInputEmail1">Tên Ngành: </label>(<span style="color:red;">*</span>)
                        <input type="text" class="form-control" name="TenN" id="exampleInputEmail1" placeholder="...">
                     </div>
                     <div class="form-group">
                        <label for="exampleInputPassword1">Mô Tả: </label>
                        <textarea style="resize: none;" rows="8" class="form-control" name="MoTaN" id="ckeditor" placeholder="..."></textarea>
                     </div>
                     <div class="form-group">
                        <label for="exampleInputEmail1">Thuộc Phòng</label>(<span style="color:red;">*</span>)
                        <select name="id_P" class="form-control input-sm m-bot15">
                           <option >------Chọn------</option>
                           @foreach($phong as $key => $p)
                           <option value="{{$p->id}}">{{$p->TenP}}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                     <button type="submit" class="btn btn-primary">Thêm</button>
                     <a href="{{route('nganh.index')}}"><button type="button" class="btn btn-light">Quay Lại</button> </a>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
   <!-- /.container-fluid -->
</section>
@endsection
