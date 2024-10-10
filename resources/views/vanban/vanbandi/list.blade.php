@extends('layouts.app')
@section('content')
<div class="content">
   <div class="container-fluid">
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0">Danh Sách Văn Bản Đi</h1>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Home</a></li>
               <li class="breadcrumb-item active">Danh Sách Văn Bản Đi</li>
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
<div class="content">
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
                  <button type="button" class="btn btn-default btn-sm">
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
              <div  class=" form-group " style="margin: 5px 0px 0px 50px;">
                  <form method="get" action="{{URL::to('loc')}}" enctype="multipart/form-data">
                  
                     <label for="exampleInputEmail1">Lọc Theo Loại Văn Bản: </label>
                     
                     <select name="loaivanban" class="form-select form-select-sm" aria-label="Small select example" style="margin:3px 30px 10px 5px">
                        <option value="" selected>-----------Chọn-----------</option>
                        @foreach ($theloai as $tl )
                           <option value="{{$tl->id_LVB}}" >{{$tl->TenLVB}}</option>
                        @endforeach
                     </select>
                     <label for="exampleInputEmail1">Lọc Theo Ngày: </label>
                     <input  name="ngay" type="text" id="departure_date"  style="margin:3px 30px 10px 5px" placeholder=" ">
                     <input type="submit" value="Lọc" class="btn btn-success btn-sm">
                  </form>
                  </div>
               </div>
              <div class=" mailbox-messages table table-reponsive">
                <table class="table table-hover table-striped" id="myTable" data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-offset="0" class="scrollspy-example" tabindex="0">
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
                           <td>
                              <div class="icheck-primary">
                                 <input type="checkbox" value="" id="check1">
                                 <label for="check1"></label>
                              </div>
                           </td>
                           <td class="mailbox-star"><a href="#"><i class="fas fa-star text-warning"></i></a></td>
                           <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
                           <td class="mailbox-subject"><b>AdminLTE 3.0 Issue</b> - Trying to find a solution to this problem...
                           </td>
                           
                           
                        </tr><!-- This will be displayed if the collection is empty -->
                     @else
                        <ul>
                        @foreach($vanbandi as $key => $vb)
                           <tr id="scrollspyHeading{{$key}}">
                              <td>
                                    <div class="icheck-primary">
                                       <input type="checkbox" value="" id="check{{$key}}">
                                       <label for="check{{$key}}"></label>
                                    </div>
                              </td>
                              <td>{{$vb->taikhoan->HoTen}}</td>
                              <td>
                                    <a href="{{URL::to('/chi-tiet', $vb->slug)}}" id="vb{{$key}}" style="color: black">
                                       {{$vb->TenVB}} <span class="date" data-ngay-gui="{{$vb->NgayGui}}"> {{$vb->NgayGui}}</span>
                                       
                                    </a>
                                    @if($vb->isNew)
                                    <img src="{{'backend/dist/img/icon-news.gif'}}" alt="new" style=" width: 30px; margin-left: 5px;" id="new{{$key}}">
                                    @endif
                                   
                              </td>
                              <td>
                                    <!-- Bạn có thể thêm dữ liệu ở đây -->
                              </td>
                              <td>

                              </td>
                           </tr>
                        @endforeach
                        </ul>
                     @endif
                  
                  
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
              <div class="card-footer p-0">
              <div class="mailbox-controls">               <!-- Check all button -->
                
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.float-right -->
              </div>
            </div>
            </div>
            
         </div>
         
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>
@endsection
