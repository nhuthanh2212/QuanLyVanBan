@extends('layouts.app')
@section('content')

      <div class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6 row">
                  <h1 class="m-0">Liệt Kê Người Dùng</h1>
                  <a style="margin-left: 20px;" href="{{route('user.create')}}"><button type="button" class="btn btn-primary">Thêm</button></a>
               </div>
               <!-- /.col -->
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Home</a></li>
                     <li class="breadcrumb-item active">Liệt Kê Người Dùng</li>
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
                    <th scope="col">Hình Ảnh</th>
                    <th scope="col">Họ Tên</th>
                    <th scope="col">Thông Tin Liên Hệ</th>
                    <th scope="col">Thuộc Group</th>
                    <th scope="col">Chức Vụ</th>
                    <th scope="col">Giới Tính</th>
                    

                    <th scope="col">Quản Lý</th>

               </tr>
            </thead>
            <tbody class="order_position">             
              @foreach ($taikhoan as $key => $tk )
              <tr>
                  <th scope="row">{{$key}}</th>
                  <td>
                     <img src="{{ asset('uploads/img/'.$tk->img) }}" alt="{{$tk->HoTen}}" class="img-thumbnail" style="width: 110px;
    height: 110px;">
                  </td>
                  <td>{{$tk->HoTen}}</td>
                  
                  <td>
                     <h5><span class="badge badge-secondary">{{$tk->Gmail}}</span></h5>
                     <h5><span class="badge badge-secondary">{{$tk->DienThoai}}</span></h5>
                  </td>
                  <td>{{$tengroup}}</td>
                  <td>{{$tk->chucvu->TenCV}}</td>
                  <td>
                    @if($tk->GioiTinh == 1)
                     <span class="text text-success">Nam</span>
                    @else
                    <span class="text text-success">Nữ </span>
                    @endif
                  </td>
                  
                  <td>
                     <div class="row">
                     <a  href="{{ route('user.show',[$tk->slug]) }}" style="margin-right: 3px;">
                     <button class="btn btn-primary btn-sm">  <i class="fa-solid fa-eye"></i></button>
                    
                    </a>
                    <a  href="{{ route('user.edit',[$tk->id_TK]) }}" style="margin-right: 3px;"><button class="btn btn-success btn-sm"> <i class="fa-solid fa-pen"></i></button>
                   
                    </a>
                    <form onsubmit="return confirm('Bạn Có Muốn Xóa Tài Khoản Này Không?')" action="{{route('user.destroy',[$tk->id_TK])}}" method="post" enctype="multipart/form-data">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn  btn-danger btn-sm" ><i class="fa-solid fa-trash-can"></i></button>
                    </form>
                    </div>
                  </td>
               </tr>
              @endforeach
             
            </tbody>
         </table>
      </div>
      </div>
     
   </div>
</div>
   </div></section>
  
@endsection