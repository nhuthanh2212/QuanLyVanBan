@extends('layouts.app')
@section('content')
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6 row">
            <h1 class="m-0">Liệt Kê Phòng</h1>
            <a style="margin-left: 20px;" href="{{route('phong.create')}}"><button type="button" class="btn btn-primary">Thêm</button></a>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Home</a></li>
               <li class="breadcrumb-item active">Liệt Kê Phòng</li>
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
               <div class="table table-reponsive">
                  <table class="table table-striped" id="myTable">
                     <thead>
                        <tr>
                           <th scope="col">#</th>
                           <th scope="col">Tên Phòng</th>
                           <th scope="col">Mô Tả</th>
                           <th scope="col">Thuộc Đơn Vị</th>
                           <th scope="col">Trạng Thái</th>
                           <th scope="col">Quản Lý</th>
                        </tr>
                     </thead>
                     <tbody class="order_position">
                        @foreach($phong as $key => $p)
                        <tr id="{{$p->id}}">
                           <th scope="row">{{$key}}</th>
                           <td>{{$p->TenP}}</td>
                           <td>
                              <span class="text-ellipsis">
                              @if($p->MoTaP != NULL)
                              @if(strlen($p->MoTaP)>150)
                              @php
                              $cate_desc = substr($p->MoTaN,0,100);
                              echo $cate_desc.'......'
                              @endphp
                              @else
                              {!!$p->MoTaP!!}
                              @endif
                              @else
                              Chưa có Mô Tả
                              @endif
                              </span>
                           </td>
                           <td>{{$p->donvi->TenDV}}</td>
                           <td>
                              @if($p->TrangThai == 1)
                              <span class="text text-success">Hiển Thị </span>
                              @else
                              <span class="text text-success">Ẩn </span>
                              @endif
                           </td>
                           <td>
                              <a  href="{{ route('phong.edit',[$p->id]) }}" class="btn btn-success" ui-toggle-class="">
                              Sữa
                              </a>
                              <form onsubmit="return confirm('Bạn Có Muốn Xóa Phòng Này không?')" action="{{route('phong.destroy',[$p->id])}}" method="post" enctype="multipart/form-data">
                                 @csrf
                                 @method('DELETE')
                                 <input type="submit" class="btn  btn-danger" value="Xóa" >
                              </form>
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
            
            <!-- /.card -->
         </div>
      </div>
   </div>
   <!-- /.container-fluid -->
</section>
@endsection
