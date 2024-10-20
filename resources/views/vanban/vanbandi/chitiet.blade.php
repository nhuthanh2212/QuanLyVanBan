@extends('layouts.app')
@section('content')

<div class="content">
      <div class="container-fluid">
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0">Chi Tiết {{$vanbandi_chitiet->TenVB}}</h1>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Home</a></li>
               <li class="breadcrumb-item"><a href="{{Route('van-ban-di.index')}}">Văn Bản Đi</a></li>
               <li class="breadcrumb-item active">{{$vanbandi_chitiet->TenVB}}</li>
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
              <form >
              	@csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1" style="margin-right: 5px;">Loại Văn Bản: </label>
                    <span>{{$theloai->TenLVB}}</span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1" style="margin-right: 5px;">Đơn Vị Ban Hành: </label>
                    <span>{{$tengroup}}</span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1" style="margin-right: 5px;">Số Hiệu: </label>
                    <span>{{$vanbandi_chitiet->SoHieu}}</span>
                    
                  </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1" style="margin-right: 5px;">Trích Nội Dung: </label>
                      <span>{{$vanbandi_chitiet->NoiDung}}</span>
                   
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1" style="margin-right: 5px;">Ghi Chú: </label>
                      @if ($vanbandi_chitiet->GhiChu == NULL)
                        <span>Không Có Ghi Chú Liên Quan</span>
                      @else
                      <span>{{$vanbandi_chitiet->GhiChu}}</span>
                      @endif
                      
                   
                  </div>
                  
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1" style="margin-right: 5px;">Ngày Ban Hành: </label>
                    <span > {{$vanbandi_chitiet->NgayBH}}</span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1" style="margin-right: 5px;">Ngày Gửi: </label>
                    <span class="date" data-ngay-gui="{{$vanbandi_chitiet->NgayGui}}"> {{$vanbandi_chitiet->NgayGui}}</span>
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1" style="margin-right: 5px;">Trạng Thái: </label>
                      @if ($vanbandi_chitiet->TrangThai == 1)
                        <span>Đã Duyệt</span>
                      @else
                      <span>Chưa Được Duyệt</span>
                      @endif
                      
                   
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1" style="margin-right: 5px;">File Đính Kèm: </label>
                   
                     <span>{{$vanbandi_chitiet->file}}</span>
                    
                     
                    <a  target="_blank" class="preview-file" data-file="{{ asset('uploads/vanbandi/'.$vanbandi_chitiet->file) }}" style="color: black; margin-left:10px; margin-right: 5px;" data-toggle="modal" data-target=".bd-example-modal-xl"> <i class="fa-regular fa-eye"></i></a>
                    
                    <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                      <div class="modal-content" id="output">
                     
                      </div>
                    </div>
                  </div>
                   
                    <a href="#" class="download-file" data-filename="{{$vanbandi_chitiet->file}}"><button class="btn btn-light btn-sm" type="button"><i class="far fa-trash-alt"></i></button></a>
                    
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Gửi Đến: </label>
                    <div>
                      @foreach ($vb_pb as $vbpb)
                        @foreach ($phongban as $pb )
                          @if ($pb->id == $vbpb->id_PB)
                            <span  class="badge badge-secondary">{{$pb->TenPB}}</span>  
                          @endif                        
                        @endforeach                                            
                      @endforeach
                      @foreach ($vb_dv as $vbdv)
                        @foreach ($donvi as $dv )
                          @if ($dv->id == $vbdv->id_DV)
                            <span  class="badge badge-secondary">{{$dv->TenDV}}</span>  
                          @endif                        
                        @endforeach                                            
                      @endforeach
                      @foreach ($vb_p as $vbp)
                        @foreach ($phong as $p )
                          @if ($p->id == $vbp->id_P)
                            <span  class="badge badge-secondary">{{$p->TenP}}</span>  
                          @endif                        
                        @endforeach                                            
                      @endforeach
                      @foreach ($vb_n as $vbn)
                        @foreach ($nganh as $ng )
                          @if ($ng->id == $vbn->id_N)
                            <span  class="badge badge-secondary">{{$ng->TenN}}</span>  
                          @endif                        
                        @endforeach                                            
                      @endforeach
                      @foreach ($vb_cn as $vbcn)
                        @foreach ($chuyennganh as $cn )
                          @if ($cn->id == $vbcn->id_CN)
                            <span  class="badge badge-secondary">{{$cn->TenCN}}</span>  
                          @endif                        
                        @endforeach                                            
                      @endforeach
                    </div>
                  </div>
                  <!-- Collapsible section -->
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                 
                  <a href="{{route('van-ban-di.index')}}"><button type="button" class="btn btn-light">Quay Lại </button></a>
                </div>
              </form>
</div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>
@endsection
