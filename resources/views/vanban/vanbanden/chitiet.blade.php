@extends('layouts.app')
@section('content')
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0">Chi Tiết {{$vanbanden_chitiet->NoiDung}}</h1>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Home</a></li>
               <li class="breadcrumb-item"><a href="{{Route('van-ban-den.index')}}">Văn Bản Đến</a></li>
               <li class="breadcrumb-item active">{{$vanbandi_chitiet->NoiDung}}</li>
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
            <form >
               @csrf
               <div class="card-body">
                  <div class="form-group">
                     <label for="exampleInputEmail1" style="margin-right: 5px;">Loại Văn Bản: </label>
                     <span>{{$theloai->TenLVB}}</span>
                  </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1" style="margin-right: 5px;">Đơn Vị Ban Hành: </label>
                     <span>{{$tengroup}}</span>
                  </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1" style="margin-right: 5px;">Số Hiệu: </label>
                     <span>{{$vanbanden_chitiet->SoHieu}}</span>
                  </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1" style="margin-right: 5px;">Trích Nội Dung: </label>
                     <span>{{$vanbanden_chitiet->NoiDung}}</span>
                  </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1" style="margin-right: 5px;">Ghi Chú: </label>
                     @if ($vanbanden_chitiet->GhiChu == NULL)
                     <span>Không Có Ghi Chú Liên Quan</span>
                     @else
                     <span>{{$vanbanden_chitiet->GhiChu}}</span>
                     @endif
                  </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1" style="margin-right: 5px;">Ngày Ban Hành: </label>
                     <span > {{$vanbanden_chitiet->NgayBH}}</span>
                  </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1" style="margin-right: 5px;">Ngày Nhận: </label>
                     <span class="date" data-ngay-gui="{{$vanbanden_chitiet->NgayNhan}}"> {{$vanbanden_chitiet->NgayNhan}}</span>
                  </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1" style="margin-right: 5px;">Trạng Thái: </label>
                     @if ($vanbanden_chitiet->TrangThai == 1)
                     <span>Đã Duyệt</span>
                     @else
                     <span>Chưa Được Duyệt</span>
                     @endif
                  </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1" style="margin-right: 5px;">File Đính Kèm: </label>
                     <span>{{$vanbanden_chitiet->file}}</span>
                     <a   style="color: black; margin-left:10px; margin-right: 5px;" data-toggle="modal" data-target=".bd-example-modal-xl"> <i class="fa-regular fa-eye"></i></a>
                     <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                           <div class="modal-content" id="output">
                              {!! $htmlOutput !!}
                           </div>
                        </div>
                     </div>
                     <a href="#" class="download-file" data-filename="{{$vanbanden_chitiet->file}}"><button class="btn btn-light btn-sm" type="button"><i class="fa-solid fa-download"></i></button></a>
                  </div>
                 
                  <!-- Collapsible section -->
               </div>
               <!-- /.card-body -->
               <div class="card-footer">
                  <a href="{{route('van-ban-den.index')}}"><button type="button" class="btn btn-light">Quay Lại </button></a>
               </div>
            </form>
         </div>
         <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
   </div>
</div>
</section>
@endsection
