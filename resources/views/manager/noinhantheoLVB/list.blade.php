@extends('layouts.app')
@section('content')
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6 row">
            <h1 class="m-0">Liệt Kê Nơi Nhận</h1>
            <a style="margin-left: 20px;" href="{{URL::to('/manager/noi-nhan-loai-van-ban/createe')}}"><button type="button" class="btn btn-primary">Thêm</button></a>
            
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Home</a></li>
               <li class="breadcrumb-item active">Liệt Kê Nơi Nhận</li>
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
                           <th scope="col">Loại Văn Bản</th>
                           
                           <th scope="col">Đơn Vị Ban Hành</th>
                           <th scope="col">Nơi Nhận</th>
                           <th scope="col">Quản Lý</th>
                        </tr>
                     </thead>
                     <tbody class="order_position">
                     @foreach($nhan as $key => $n)
                        <tr id="{{$n->id}}">
                           <th scope="row">{{$key}}</th>
                           <td>
                              @foreach ($loaivanban as $lvb )
                                 @if ($lvb->id_LVB == $n->id_LVB)
                                    {{ $lvb->TenLVB }}
                                 @endif
                              @endforeach
                           </td>
                           <td>{{$tengroup}}</td>
                           
                           <td>
                              @foreach ($bh_pb as $bhpb )
                                 @if ($bhpb->id_BH_LVB == $n->id)
                                    @foreach ($phongban as $pb)
                                       @if ($pb->id == $bhpb->id_PB)
                                         <span class="badge badge-secondary">{{$pb->TenPB}}</span>
                                       @endif
                                    @endforeach
                                    
                                 @endif
                              @endforeach
                              @foreach ($bh_dv as $bhdv )
                                 @if ($bhdv->id_BH_LVB == $n->id)
                                    @foreach ($donvi as $dv)
                                       @if ($dv->id == $bhdv->id_DV)
                                         <span class="badge badge-secondary">{{$dv->TenDV}}</span>
                                       @endif
                                    @endforeach
                                    
                                 @endif
                              @endforeach
                              @foreach ($bh_p as $bhp )
                                 @if ($bhp->id_BH_LVB == $n->id)
                                    @foreach ($phong as $p)
                                       @if ($p->id == $bhp->id_P)
                                         <span class="badge badge-secondary">{{$p->TenP}}</span>
                                       @endif
                                    @endforeach
                                    
                                 @endif
                              @endforeach
                              @foreach ($bh_n as $bhn )
                                 @if ($bhn->id_BH_LVB == $n->id)
                                    @foreach ($nganh as $ng)
                                       @if ($ng->id == $bhn->id_N)
                                         <span class="badge badge-secondary">{{$ng->TenN}}</span>
                                       @endif
                                    @endforeach
                                    
                                 @endif
                              @endforeach
                              @foreach ($bh_cn as $bhcn )
                                 @if ($bhcn->id_BH_LVB == $n->id)
                                    @foreach ($chuyennganh as $cn)
                                       @if ($cn->id == $bhcn->id_CN)
                                         <span class="badge badge-secondary">{{$cn->TenCN}}</span>
                                       @endif
                                    @endforeach
                                    
                                 @endif
                              @endforeach
                    
                           </td>
                           <td>
                              <a  href="{{URL::to('/manager/noi-nhan-loai-van-ban/edite',[$n->id])}}" class=" btn btn btn-success">
                              Sửa
                              </a>
                              <form onsubmit="return confirm('Bạn Có Muốn Xóa Nơi Nhận Theo Loại Văn Bản Do Đơn Vị Ban Hành Này Không?')" action="{{URL::to('/manager/noi-nhan-loai-van-ban/delete',[$n->id])}}" method="post" enctype="multipart/form-data">
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
   <!-- /.container-fluid -->
</section>
@endsection
