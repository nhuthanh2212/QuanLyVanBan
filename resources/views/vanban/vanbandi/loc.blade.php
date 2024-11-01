@extends('layouts.app')
@section('content')
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0">Lọc Chi Tiết Văn Bản Đi</h1>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Home</a></li>
               <li class="breadcrumb-item"><a href="{{Route('van-ban-di.index')}}">Văn Bản Đi</a></li>
               <li class="breadcrumb-item active">Lọc Chi Tiết</li>
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
            <div class="card-body p-0">
               <div class="row">
                  <div class="mailbox-controls ">
                     <!-- Check all button -->
                     <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
                     </button>
                     <div class="btn-group">
                        <button type="button" class="btn btn-default btn-sm  delete-selected">
                        <i class="far fa-trash-alt"></i>
                        </button>
                     </div>
                     <!-- /.btn-group -->
                     <a href="{{route('van-ban-di.index')}}">
                     <button type="button" class="btn btn-default btn-sm">
                     <i class="fas fa-sync-alt"></i>
                     </button>
                     </a>
                     <a href="{{route('van-ban-di.create')}}">
                     <button type="button" class="btn btn-sm btn-success">
                     <i class="fa-solid fa-pen"></i>
                     Soạn Văn Bản
                     </button>
                     </a>
                     <!-- /.float-right -->
                  </div>
                  <div  class=" form-group " style="margin: 5px 0px 0px 20px;">
                     <form method="get" action="{{URL::to('loc')}}" >
                        @csrf
                        <label for="exampleInputEmail1">Lọc Theo Số Hiệu: </label>
                        <input type="text" name="SoHieu"  style="margin-right: 20px;">
                        <label for="exampleInputEmail1">Lọc Theo Loại Văn Bản: </label>
                        <select name="loaivanban" class="form-select form-select-sm" aria-label="Small select example" style="margin:3px 30px 10px 5px">
                           <option value="" selected>-----------Chọn-----------</option>
                           @foreach ($theloai as $tl )
                           <option value="{{$tl->id_LVB}}" >{{$tl->TenLVB}}</option>
                           @endforeach
                        </select>
                        <input type="submit" value="Lọc" class="btn btn-success btn-sm">
                     </form>
                  </div>
                  <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal" style="height: 30px; margin: 7px 0px 0px 50px;"><i class="fa-solid fa-magnifying-glass"></i></a>
                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog" role="document">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Lọc Chi Tiết</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                           </div>
                           <form method="get" action="{{URL::to('loc-chi-tiet')}}">
                              @csrf
                              <div class="modal-body card-body">
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Loại Văn Bản: </label>
                                    <select name="loaivanban" class="form-select form-select-sm" aria-label="Small select example" >
                                       <option value="" selected>-----------Chọn-----------</option>
                                       @foreach ($theloai as $tl )
                                       <option value="{{$tl->id_LVB}}" >{{$tl->TenLVB}}</option>
                                       @endforeach
                                    </select>
                                 </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Đơn Vị Ban Hành: </label>
                                    <select name="donvibanhanh" class="form-select form-select-sm" aria-label="Small select example" >
                                       <option value="" selected>-----------Chọn-----------</option>
                                       @foreach ($nhom as $gr )
                                       <option value="{{$gr->id}}" >{{ Str::afterLast($gr->TenGroup, '-') }}</option>
                                       @endforeach
                                    </select>
                                 </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Từ Ngày: </label>
                                    <input type="text" id="datepicker"  class="form-control" name="tungay">
                                 </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Đến Ngày: </label>
                                    <input type="text" id="datepicker1"  class="form-control" name="denngay">
                                 </div>
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                 <button type="submit" class="btn btn-primary">Lọc</button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
               <div class=" mailbox-messages table table-reponsive">
                  <table class="table table-hover table-striped" id="myTable" >
                     <thead>
                        <tr>
                           <th scope="col" >
                           </th>
                           <th scope="col">Người Gửi </th>
                           <th scope="col">Nội Dung</th>
                           <th scope="col">Nơi Nhận</th>
                           <th scope="col"></th>
                        </tr>
                     </thead>
                     <tbody>
                        @if($vanbandi->isEmpty())
                        <tr>
                           <td></td>
                           <td></td>
                           <td colspan="5">
                              @if($vanbandi->isEmpty())
                              <p style="color: red; font-weight: bold;">Văn Bản Lọc Không Có Vui Lòng Nhập(Chọn) Lại Để Tìm Được Văn Bản Mong Muốn</p>
                              @endif
                           </td>
                           <td></td>
                           <td></td>
                        </tr>
                        <!-- This will be displayed if the collection is empty -->
                        @else
                        @foreach($vanbandi as $key => $vb)
                        <tr id="scrollspyHeading{{$key}}" data-id="{{ $vb->id }}">
                           <td>
                              <div class="icheck-primary">
                                 <input type="checkbox" value="" id="check{{$key}}">
                                 <label for="check{{$key}}"></label>
                              </div>
                           </td>
                           <td>{{$vb->taikhoan->HoTen}}</td>
                           <td>
                              <a href="{{URL::to('/chi-tiet', $vb->id)}}" id="vb{{$key}}" style="color: black">
                              {{$vb->NoiDung}} <span class="date" data-ngay-gui="{{$vb->NgayGui}}"> {{$vb->NgayGui}}</span>
                              </a>
                              @if($vb->isNew)
                              <img src="{{asset('backend/dist/img/icon-news.gif')}}" alt="new" style=" width: 30px; margin-left: 5px;" id="new{{$key}}">
                              @endif
                           </td>
                           <td>
                              <!-- Bạn có thể thêm dữ liệu ở đây -->
                           </td>
                           <td>
                           </td>
                        </tr>
                        @endforeach
                        @endif
                     </tbody>
                  </table>
                  <!-- /.table -->
               </div>
               <!-- /.mail-box-messages -->
               <div class="card-footer p-0">
                  <div class="mailbox-controls">
                     <!-- Check all button -->
                  </div>
                  <!-- /.btn-group -->
               </div>
               <!-- /.float-right -->
            </div>
         </div>
      </div>
   </div>
</section>
@endsection
