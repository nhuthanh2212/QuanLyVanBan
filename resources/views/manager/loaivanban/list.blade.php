@extends('layouts.app')
@section('content')
<div class="content">
   <div class="container-fluid">
      <div class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
                  <h1 class="m-0">Liệt Kê Loại Văn Bản</h1>
               </div>
               <!-- /.col -->
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="{{URL::to('manager')}}">Home</a></li>
                     <li class="breadcrumb-item active">Liệt Kê Loại Văn Bản</li>
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
                    <th scope="col">Tên Loại Văn Bản</th>
                    <th scope="col">Mô Tả</th>
                    <th scope="col">Trạng Thái</th>

                    <th scope="col">Quản Lý</th>

               </tr>
            </thead>
            <tbody class="order_position">
              @foreach($loaivanban as $key => $loai)
               <tr id="{{$loai->id}}">
                  <th scope="row">{{$key}}</th>
                  <td>{{$loai->TenLVB}}</td>
                  
                  
                  <td>
                        <span class="text-ellipsis">
                      @if($loai->MoTaLVB!=NULL)
                        @if(strlen($loai->MoTaLVB)>150)
                          @php
                            $cate_desc = substr($loai->MoTaLVB,0,100);
                            echo $cate_desc.'......'
                          @endphp
                         @else
                         {!!$loai->MoTaLVB!!}
                        @endif
                      @else
                        Chưa có Mô Tả
                      @endif
                        </span>
                  </td>
                  
                  <td>
                    @if($loai->TrangThai == 1)
                     <span class="text text-success">Hiển Thị </span>
                    @else
                    <span class="text text-success">Ẩn </span>
                    @endif
                  </td>
                  
                  <td>
                    <a  href="{{ route('loai-van-ban.edit',[$loai->id_LVB]) }}" class="btn btn-success" ui-toggle-class="">
                    Sữa
                    </a>
                    <form onsubmit="return confirm('Bạn Có Muốn Xóa Loại Văn Bản Này Không?')" action="{{route('loai-van-ban.destroy',[$loai->id_LVB])}}" method="post" enctype="multipart/form-data">
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
      <a href="{{route('loai-van-ban.create')}}"><button type="button" class="btn btn-primary">Thêm</button></a>
   </div>
</div>

  
@endsection