@extends('layouts.app')
@section('content')

      	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Nơi Nhận Theo Loại Văn Bản</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Home</a></li>
              <li class="breadcrumb-item active">Nơi Nhận Theo Loại Văn Bản</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <style>
        /* Style for the selected recipients display */
        .selected-recipients {
            border: 1px solid #ced4da;
            padding: 5px;
            border-radius: 4px;
            margin-bottom: 10px;
            min-height: 40px; /* Optional: to ensure some space */
        }
        .recipient-tag {
            display: inline-block;
            background-color: #007bff;
            color: white;
            border-radius: 12px;
            padding: 5px 10px;
            margin: 2px;
            cursor: pointer;
        }
    </style>
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
              <form method="post" action="{{URL::to('/manager/inser')}}" enctype="multipart/form-data">
              	@csrf
                <div class="card-body">
                    
                  <div class="form-group">
                    <label for="exampleInputEmail1">Loại Văn Bản: </label>
                    <select name="id_LVB" class="form-control " aria-label="Small select example" >
                        <option value="0" selected>-----------Chọn-----------</option>
                        @foreach ($loaivanban as $lvb )
                           <option value="{{$lvb->id_LVB}}" >{{$lvb->TenLVB}}</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nơi Ban Hành: </label>
                    <select name="id_Gr" class="form-control " aria-label="Small select example" >
                        <option value="0" selected>-----------Chọn-----------</option>
                        @foreach ($loaivanban as $lvb )
                           <option value="{{$lvb->id_LVB}}" >{{$lvb->TenLVB}}</option>
                        @endforeach
                     </select>
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nơi Nhận Theo Loại Văn Bản: </label>
                    <div id="recipientDisplay" class="selected-recipients" aria-expanded="false" >Chọn Nơi Nhận Loại Văn Bản</div>
                  </div>
                  <!-- Collapsible section -->
                  <div id="recipientList" class="collapse">
                        <table class="table">
                            <thead>
                                <tr><th scope="col"><input type="checkbox" id="checkAll" class="check-all"> Chọn Tất Cả</th></tr>
                                <tr>
                                    <th scope="col"><input type="checkbox" id="checkAllPhongBan" class="check-all"> Phòng Ban</th>
                                    <th scope="col"><input type="checkbox" id="checkAllDonVi" class="check-all"> Đơn Vị</th>
                                    <th scope="col"><input type="checkbox" id="checkAllPhong" class="check-all"> Phòng</th>
                                    <th scope="col"><input type="checkbox" id="checkAllNganh" class="check-all"> Ngành</th>
                                    <th scope="col"><input type="checkbox" id="checkAllChuyenNganh" class="check-all">Chuyên Ngành</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        @foreach ($phongban as $pb)
                                            <input type="checkbox" class="check-phong-ban" value="{{ $pb->id }}" name="id_pb[]" id="checkPhongBan{{ $pb->id }}">
                                            <span>{{ $pb->TenPB }}</span><br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($donvi as $dv)
                                            <input type="checkbox" class="check-don-vi" value="{{ $dv->id }}" name="id_dv[]"  id="checkDonVi{{ $dv->id }}">
                                            <span>{{ $dv->TenDV }}</span><br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($phong as $p)
                                            <input type="checkbox" class="check-phong" value="{{ $p->id }}" name="id_p[]"  id="checkPhong{{ $p->id }}">
                                            <span>{{ $p->TenP }}</span><br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($nganh as $n)
                                            <input type="checkbox" class="check-nganh" value="{{ $n->id }}" name="id_n[]"  id="checkNganh{{ $n->id }}">
                                            <span>{{ $n->TenN }}</span><br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($chuyennganh as $cn)
                                            <input type="checkbox" class="check-chuyen-nganh" value="{{ $cn->id }}" name="id_cn[]"  id="checkChuyenNganh{{ $cn->id }}">
                                            <span>{{ $cn->TenCN }}</span><br>
                                        @endforeach
                                    </td>
                                   
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Gửi</button>
                  <a href="{{route('van-ban-di.index')}}"><button type="button" class="btn btn-light">Quay Lại </button></a>
                </div>
              </form>
</div>
</div>
</div>
</div>
</section>
@endsection