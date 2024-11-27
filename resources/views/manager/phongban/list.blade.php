@extends('layouts.app')
@section('content')
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6 row">
            <h1 class="m-0">Liệt Kê Phòng Ban</h1>
            <a style="margin-left: 20px;" href="{{route('phong-ban.create')}}"><button type="button" class="btn btn-primary">Thêm</button></a>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Home</a></li>
               <li class="breadcrumb-item active">Liệt Kê Phòng Ban</li>
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
                           <th scope="col">Tên Phòng Ban</th>
                           <th scope="col">Mô Tả</th>
                           <th scope="col">Thuộc Khối</th>
                           <th scope="col">Trạng Thái</th>
                           <th scope="col">Quản Lý</th>
                        </tr>
                     </thead>
                     <tbody class="order_position">
                        @foreach($phongban as $key => $pb)
                        <tr id="{{$pb->id}}">
                           <th scope="row">{{$key}}</th>
                           <td>{{$pb->TenPB}}</td>
                           <td>
                              <span class="text-ellipsis">
                              @if($pb->MoTaPB != NULL)
                              @if(strlen($pb->MoTaPB)>150)
                              @php
                              $cate_desc = substr($pb->MoTaPB,0,100);
                              echo $cate_desc.'......'
                              @endphp
                              @else
                              {!!$pb->MoTaPB!!}
                              @endif
                              @else
                              Chưa có Mô Tả
                              @endif
                              </span>
                           </td>
                           <td>{{$pb->khoi->TenK}}</td>
                           <td>
                              @if($pb->TrangThai == 1)
                              <span class="text text-success">Hiển Thị </span>
                              @else
                              <span class="text text-success">Ẩn </span>
                              @endif
                           </td>
                           <td>
                              <a  href="{{ route('phong-ban.edit',[$pb->id]) }}" class="btn btn-success" ui-toggle-class="">
                              Sửa
                              </a>
                              <form onsubmit="return confirm('Bạn Có Muốn Xóa Phòng Ban Này Không?')" action="{{route('phong-ban.destroy',[$pb->id])}}" method="post" enctype="multipart/form-data">
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
   </div>
   </div>
   <!-- /.container-fluid -->
</section>
@endsection
