@extends('layouts.app')
@section('content')
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6 row">
            <h1 class="m-0">Liệt Kê Chuyên Ngành</h1>
            <a style="margin-left: 20px;" href="{{route('chuyen-nganh.create')}}"><button type="button" class="btn btn-primary">Thêm</button></a>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Home</a></li>
               <li class="breadcrumb-item active">Liệt Kê Chuyên Ngành</li>
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
                           <th scope="col">Tên Chuyên Ngành</th>
                           <th scope="col">Mô Tả</th>
                           <th scope="col">Thuộc Ngành</th>
                           <th scope="col">Trạng Thái</th>
                           <th scope="col">Quản Lý</th>
                        </tr>
                     </thead>
                     <tbody class="order_position">
                        @foreach($chuyennganh as $key => $cn)
                        <tr id="{{$cn->id}}">
                           <th scope="row">{{$key}}</th>
                           <td>{{$cn->TenCN}}</td>
                           <td>
                              <span class="text-ellipsis">
                              @if($cn->MoTaCN != NULL)
                              @if(strlen($cn->MoTaCN)>150)
                              @php
                              $cate_desc = substr($cn->MoTaN,0,100);
                              echo $cate_desc.'......'
                              @endphp
                              @else
                              {!!$cn->MoTaCN!!}
                              @endif
                              @else
                              Chưa có Mô Tả
                              @endif
                              </span>
                           </td>
                           <td>{{$cn->nganh->TenN}}</td>
                           <td>
                              @if($cn->TrangThai == 1)
                              <span class="text text-success">Hiển Thị </span>
                              @else
                              <span class="text text-success">Ẩn </span>
                              @endif
                           </td>
                           <td>
                              <a  href="{{ route('chuyen-nganh.edit',[$cn->id]) }}" class="btn btn-success" ui-toggle-class="">
                              Sửa
                              </a>
                              <form onsubmit="return confirm('Bạn Có Muốn Xóa Chuyên Ngành Này không?')" action="{{route('chuyen-nganh.destroy',[$cn->id])}}" method="post" enctype="multipart/form-data">
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
