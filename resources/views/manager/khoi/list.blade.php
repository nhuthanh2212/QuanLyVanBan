@extends('layouts.app')
@section('content')
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6 row">
            <h1 class="m-0">Liệt Kê Khối</h1>
            <a style="margin-left: 20px;" href="{{route('khoi.create')}}"><button type="button" class="btn btn-primary">Thêm</button></a>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Home</a></li>
               <li class="breadcrumb-item active">Liệt Kê Khối</li>
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
                           <th scope="col">Tên Khối</th>
                           <th scope="col">Mô Tả</th>
                           <th scope="col">Trạng Thái</th>
                           <th scope="col">Quản Lý</th>
                        </tr>
                     </thead>
                     <tbody class="order_position">
                        @foreach($khoi as $key => $k)
                        <tr id="{{$k->id}}">
                           <th scope="row">{{$key}}</th>
                           <td>{{$k->TenK}}</td>
                           <td>
                              <span class="text-ellipsis">
                              @if($k->MoTaK != NULL)
                              @if(strlen($k->MoTaK)>150)
                              @php
                              $cate_desc = substr($k->MoTaK,0,100);
                              echo $cate_desc.'......'
                              @endphp
                              @else
                              {!!$k->MoTaK!!}
                              @endif
                              @else
                              Chưa có Mô Tả
                              @endif
                              </span>
                           </td>
                           <td>
                              @if($k->TrangThai == 1)
                              <span class="text text-success">Hiển Thị </span>
                              @else
                              <span class="text text-success">Ẩn </span>
                              @endif
                           </td>
                           <td>
                              <a  href="{{ route('khoi.edit',[$k->id]) }}" class="btn btn-success" ui-toggle-class="">
                              Sửa
                              </a>
                              <form onsubmit="return confirm('Bạn Có Muốn Xóa Khối Này Không?')" action="{{route('khoi.destroy',[$k->id])}}" method="post" enctype="multipart/form-data">
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
           
         </div>
      </div>
   </div>
</section>
@endsection