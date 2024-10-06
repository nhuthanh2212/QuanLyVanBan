@extends('layouts.app')
@section('content')
<div class="content">
   <div class="container-fluid">
      <div class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
                  <h1 class="m-0">Liệt Kê Khoa</h1>
               </div>
               <!-- /.col -->
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="{{URL::to('manager')}}">Home</a></li>
                     <li class="breadcrumb-item active">Liệt Kê Khoa</li>
                  </ol>
               </div>
               <!-- /.col -->
            </div>
            <!-- /.row -->
         </div>
         <!-- /.container-fluid -->
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
         <div class="table table-reponsive">
         <table class="table table-striped" id="myTable">
            <thead>
               <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên Khoa</th>
                    <th scope="col">Mô Tả</th>
                    <th scope="col">Thuộc Trường</th>
                    <th scope="col">Trạng Thái</th>
                    <th scope="col">Quản Lý</th>

               </tr>
            </thead>
            <tbody class="order_position">
              @foreach($khoa as $key => $kh)
               <tr id="{{$kh->id}}">
                  <th scope="row">{{$key}}</th>
                  <td>{{$kh->TenKhoa}}</td>
                  
                  
                  <td>
                        <span class="text-ellipsis">
                      @if($kh->MoTaKhoa != NULL)
                        @if(strlen($kh->MoTaKhoa)>150)
                          @php
                            $cate_desc = substr($kh->MoTaKhoa,0,100);
                            echo $cate_desc.'......'
                          @endphp
                         @else
                         {!!$kh->MoTaKhoa!!}
                        @endif
                      @else
                        Chưa có Mô Tả
                      @endif
                        </span>
                  </td>
                  <td>{{$kh->truong->TenTruong}}</td>
                  <td>
                    @if($kh->TrangThai == 1)
                     <span class="text text-success">Hiển Thị </span>
                    @else
                    <span class="text text-success">Ẩn </span>
                    @endif
                  </td>
                  
                  <td>
                    <a  href="{{ route('khoa.edit',[$kh->id]) }}" class="btn btn-success" ui-toggle-class="">
                    Sữa
                    </a>
                    <form onsubmit="return confirm('Bạn Có Muốn Xóa Khoa Này Không?')" action="{{route('khoa.destroy',[$kh->id])}}" method="post" enctype="multipart/form-data">
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
      <a href="{{route('khoa.create')}}"><button type="button" class="btn btn-primary">Thêm</button></a>
   </div>
</div>

  
@endsection