@extends('layouts.app')
@section('content')

      	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Cập Nhật Nơi Nhận Theo Loại Văn Bản Của Đơn Vị Ban Hành</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{URL::to('/manager/noi-nhan-loai-van-ban')}}">Danh Sach</a></li>
              <li class="breadcrumb-item active">Cập Nhật Nơi Nhận Theo Loại Văn Bản Của Đơn Vị Ban Hành</li>
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
              <form method="post" action="{{URL::to('/manager/updatee',$nhan->id)}}" enctype="multipart/form-data">
              @method('PUT')
              	@csrf
                <div class="card-body">
                    
                  <div class="form-group">
                    <label for="exampleInputEmail1">Loại Văn Bản: </label>
                    <select name="id_LVB" class="form-control " aria-label="Small select example" >
                        <option value="0" selected>-----------Chọn-----------</option>
                        @foreach ($loaivanban as $lvb )
                           <option  {{ $lvb->id_LVB == $nhan->id_LVB ? 'selected="selected"' : '' }} value="{{$lvb->id_LVB}}" >{{$lvb->TenLVB}}</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nơi Ban Hành: </label>
                    <select name="id_Gr" class="form-control " aria-label="Small select example" >
                        <option value="0" selected>-----------Chọn-----------</option>
                        @foreach ($nhom as $nh )
                           <option {{ $nh->id == $nhan->id_Gr ? 'selected="selected"' : '' }} value="{{$nh->id}}" >{{$nh->TenGroup}}</option>
                        @endforeach
                     </select>
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nơi Nhận Theo Loại Văn Bản: </label>
                    <div id="recipientDisplay" class="selected-recipients" aria-expanded="false" >Chọn Nơi Nhận Loại Văn Bản</div>
                  </div>
                  <!-- Collapsible section -->
                  <div id="recipientList">
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
                                        <label style=" font-weight: normal;">
                                            <input type="checkbox" class="check-phong-ban" value="{{ $pb->slug }}" name="slug_pb[]" id="checkPhongBan{{ $pb->id }}"  {{ in_array($pb->slug, $checkedSlugPB) ? 'checked' : '' }}>
                                            <span>{{ $pb->TenPB }}</span>
                                            </label><br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($donvi as $dv)
                                        <label style=" font-weight: normal;">
                                            <input type="checkbox" class="check-don-vi" value="{{ $dv->slug }}" name="slug_dv[]"  id="checkDonVi{{ $dv->id }}">
                                            <span>{{ $dv->TenDV }}</span>
                                            </label><br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($phong as $p)
                                        <label style=" font-weight: normal;">
                                            <input type="checkbox" class="check-phong" value="{{ $p->slug }}" name="slug_p[]"  id="checkPhong{{ $p->id }}">
                                            <span>{{ $p->TenP }}</span>
                                            </label><br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($nganh as $n)
                                        <label style=" font-weight: normal;">
                                            <input type="checkbox" class="check-nganh" value="{{ $n->slug }}" name="slug_n[]"  id="checkNganh{{ $n->id }}">
                                            <span>{{ $n->TenN }}</span>
                                            </label><br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($chuyennganh as $cn)
                                        <label style=" font-weight: normal;">
                                            <input type="checkbox" class="check-chuyen-nganh" value="{{ $cn->slug }}" name="slug_cn[]"  id="checkChuyenNganh{{ $cn->id }}">
                                            <span>{{ $cn->TenCN }}</span>
                                            </label><br>
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
                  <a href="{{URL::to('manager/noi-nhan-loai-van-ban')}}"><button type="button" class="btn btn-light">Quay Lại </button></a>
                </div>
              </form>
</div>
</div>
</div>
</div>
</section>
@endsection