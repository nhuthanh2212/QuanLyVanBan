@extends('layouts.app')
@section('content')
<div class="content">
   <div class="container-fluid">
      <div class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
                  <h1 class="m-0">Danh Sách Văn Bản Mẫu</h1>
               </div>
               <!-- /.col -->
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Home</a></li>
                     <li class="breadcrumb-item active">Danh Sách Văn Bản Mẫu</li>
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
                              <button type="button" class="btn btn-default btn-sm delete-selected">
                              <i class="far fa-trash-alt"></i>
                              </button>
                           </div>
                           <!-- /.btn-group -->
                           <a href="{{route('van-ban-mau.index')}}">
                           <button type="button" class="btn btn-default btn-sm">
                           <i class="fas fa-sync-alt"></i>
                           </button>
                           </a>
                           <a href="{{route('van-ban-mau.create')}}">
                           <button type="button" class="btn btn-sm btn-success">
                           <i class="fa-solid fa-pen"></i>
                           THêm Văn Bản Mẫu
                           </button>
                           </a>
                           <!-- /.float-right -->
                        </div>
                        <div  class=" form-group " style="margin: 5px 0px 0px 20px;">
                           <form method="get" action="{{URL::to('loc-van-mau')}}" >
                             
                                <label for="exampleInputEmail1">Lọc Theo Loại Văn Bản: </label>
                                <select name="loaivanban" class="form-select form-select-sm" aria-label="Small select example" style="margin:3px 30px 10px 5px">
                                    <option value="" selected>-----------Chọn-----------</option>
                                    @foreach ($theloai as $tl )
                                    <option value="{{$tl->id_LVB}}" >{{$tl->TenLVB}}</option>
                                    @endforeach
                                </select>
                              <label for="exampleInputEmail1">Đơn Vị Ban Hành: </label>
                              <select name="donvibanhanh" class="form-select form-select-sm" aria-label="Small select example" style="margin:3px 30px 10px 5px">
                                 <option value="" selected>-----------Chọn-----------</option>
                                 @foreach ($nhom as $nh )
                                 <option value="{{$nh->id}}" >{{ Str::afterLast($nh->TenGroup, '-') }}</option>
                                 @endforeach
                              </select>
                              <input type="submit" value="Lọc" class="btn btn-success btn-sm">
                           </form>
                        </div>
                        
                     </div>
                     <div class=" mailbox-messages table table-reponsive">
                        <table class="table table-hover table-striped" id="myTable" >
                           <thead>
                              <tr >
                                 <th scope="col" >
                                 </th>
                                 <th scope="col">Loại Văn Bản</th>
                                 <th scope="col">Tên Văn Bản</th>
                                 
                                 <th scope="col">Đơn Vị Ban Hành</th>
                                 <th scope="col">Quản Lý</th>

                             
                              </tr>
                           </thead>
                           <tbody>
                              @if($vanbanmau->isEmpty())
                              <tr>
                                 <td></td>
                                 <td></td>
                                 <td colspan="5">
                                    @if($vanbanmau->isEmpty())
                                    <p style="color: red; font-weight: bold;">Văn Bản Lọc Không Có Vui Lòng Nhập(Chọn) Lại Để Tìm Được Văn Bản Mong Muốn</p>
                                    @endif
                                 </td>
                                 <td></td>
                                 <td></td>
                              </tr>
                              <!-- This will be displayed if the collection is empty -->
                              @else
                             
                                 @foreach($vanbanmau as $key => $vb)
                                 <tr id="scrollspyHeading{{$key}}" data-id="{{ $vb->id }}">
                                    <td>
                                       <div class="icheck-primary">
                                          <input type="checkbox" value="" id="check{{$key}}">
                                          <label for="check{{$key}}"></label>
                                       </div>
                                    </td>
                                    <td>
                                       {{ $vb->loaivanban->TenLVB }}
                                    </td>
                                    <td>
                                       <a href="{{URL::to('/chi-tiet', $vb->id)}}" id="vb{{$key}}" style="color: black">
                                       {{$vb->TenVB}} 
                                       </a>
                                      
                                    </td>
                                    <td>
                                    {{ Str::afterLast($vb->nhom->TenGroup, '-') }}
                                    </td>
                                    
                                    <td>
                                        <a  href="{{ route('van-ban-mau.edit',[$vb->id]) }}" class="btn btn-success" ui-toggle-class="">
                                        Sữa
                                        </a>
                                        <form onsubmit="return confirm('Bạn Có Muốn Xóa Văn Bản Mẫu Này không?')" action="{{route('van-ban-mau.destroy',[$vb->id])}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" class="btn  btn-danger" value="Xóa" >
                                        </form>
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
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>
@endsection
