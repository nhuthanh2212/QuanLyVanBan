@extends('layouts.app')
@section('content')
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6 row">
            <h1 class="m-0"> Danh Sách Đã Được Cấp Chữ Ký Số</h1>
            <a style="margin-left: 20px;" href="{{route('chu-ky-so.create')}}"><button type="button" class="btn btn-primary">Cấp Chữ Ký Số</button></a>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Home</a></li>
               <li class="breadcrumb-item active">Danh Sách</li>
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
                           <th scope="col">Họ Tên</th>
                           <th scope="col">Thuộc Đơn Vị</th>
                           <th scope="col">Chức Vụ</th>
                           <th scope="col">Ngày Cấp</th>
                           <th scope="col">Trạng Thái</th>
                           <th scope="col">Quản Lý</th>
                        </tr>
                     </thead>
                     <tbody class="order_position">
                        @foreach($chukyso as $key => $cks)
                        <tr id="{{$cks->id}}">
                           <th scope="row">{{$key}}</th>
                           
                           <td>
                           @foreach ($taikhoan as $key => $tk )
                                @if ($tk->id_TK == $cks->id_TK)
                                    {{ $tk->HoTen }}
                                @endif
                                @endforeach
                           </td>
                           <td>
                           @foreach ($taikhoan as $key => $tk )
                                @if ($tk->id_TK == $cks->id_TK)
                                {{ Str::afterLast($tk->nhom->TenGroup, '-') }}
                                @endif
                                @endforeach
                           </td>
                           <td>
                           @foreach ($taikhoan as $key => $tk )
                                @if ($tk->id_TK == $cks->id_TK)
                                    {{ $tk->chucvu->TenCV }}
                                @endif
                                @endforeach
                           </td>
                         
                           <td>
                            <span class="date" data-ngay-gui="{{$cks->NgayKy}}"> {{$cks->NgayKy}}</span>
                           </td>
                           <td>
                              @if($cks->TrangThai == 1)
                              <a href="{{URL::to('khoa/'.$cks->id)}}" style="color:#55e01e;"><span class="fa-solid fa-check"> </span> Đã Cấp</a>
                             
                              @else
                              <a href="{{URL::to('bo-khoa/'.$cks->id)}}" style="color:red;"><span class="fa-solid fa-lock"> </span> Khóa</a>
                              @endif
                           </td>
                           <td>
                             
                              <form onsubmit="return confirm('Bạn Có Muốn Xóa Tài Khoản Đã Cấp Chữ Ký Số Này Không?')" action="{{route('chu-ky-so.destroy',[$cks->id])}}" method="post" enctype="multipart/form-data">
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