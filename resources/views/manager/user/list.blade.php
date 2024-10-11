@extends('layouts.app')
@section('content')
<div class="content">
   <div class="container-fluid">
      <div class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
                  <h1 class="m-0">Liệt Kê User</h1>
               </div>
               <!-- /.col -->
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Home</a></li>
                     <li class="breadcrumb-item active">Liệt Kê User</li>
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
                    <th scope="col">Tên User</th>
                    <th scope="col">Địa Chỉ</th>
                    <th scope="col">Số Điện Thoại</th>
                    <th scope="col">Giới Tính</th>
                    

                    <th scope="col">Quản Lý</th>

               </tr>
            </thead>
            <tbody class="order_position">             
              @foreach ($taikhoan as $key => $tk )
              <tr>
                  <th scope="row">{{$key}}</th>
                  <td>{{$tk->HoTen}}</td>
                  
                  
                  <td>
                        <span class="text-ellipsis">
                      @if($tk->DiaChi!=NULL)
                        @if(strlen($tk->DiaChi)>150)
                          @php
                            $cate_dc = substr($tk->DiaChi,0,100);
                            echo $cate_dc.'......'
                          @endphp
                         @else
                         {!!$tk->DiaChi!!}
                        @endif
                      @else
                        Chưa có địa chỉ
                      @endif
                        </span>
                  </td>
                  <td>{{$tk->DienThoai}}</td>
                  <td>
                    @if($tk->GioiTinh == 1)
                     <span class="text text-success">Nam</span>
                    @else
                    <span class="text text-success">Nữ </span>
                    @endif
                  </td>
                  
                  <td>
                    <a  href="{{ route('user.edit',[$tk->id_TK]) }}" class="btn btn-success" ui-toggle-class="">
                    Sữa
                    </a>
                    <form onsubmit="return confirm('Bạn Có Muốn Xóa Tài Khoản Này Không?')" action="{{route('user.destroy',[$tk->id_TK])}}" method="post" enctype="multipart/form-data">
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
      <a href="{{route('user.create')}}"><button type="button" class="btn btn-primary">Thêm</button></a>
   </div>
</div>

  
@endsection