@extends('layouts.app')
@section('content')
<div class="content">
      <div class="container-fluid">
      	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Soạn Văn Bản</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Home</a></li>
              <li class="breadcrumb-item active">Soạn Văn Bản</li>
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
              <form method="post" action="{{route('van-ban-di.store')}}" enctype="multipart/form-data">
              	@csrf
                <div class="card-body">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Tên Văn bản: </label>
                    <input type="text" class="form-control" name="TenVB" id="exampleInputEmail1" placeholder="...">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Số Hiệu: </label>
                    <input type="text" class="form-control" name="SoHieu" id="exampleInputEmail1" placeholder="...">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Loại Văn Bản: </label>
                    <select name="loaivanban" class="form-control " aria-label="Small select example" >
                        <option value="" selected>-----------Chọn-----------</option>
                        @foreach ($loaivanban as $lvb )
                           <option value="{{$lvb->id_LVB}}" >{{$lvb->TenLVB}}</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">File Đính Kèm: </label>
                    <input type="file" class="form-control" name="file" id="exampleInputEmail1" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Gửi Đến: </label>
                    <div id="recipientDisplay" class="selected-recipients" aria-expanded="false" style="cursor: pointer;">Chọn Nơi Gửi Đến</div>
                  </div>
                  <!-- Collapsible section -->
                  <div id="recipientList" class="collapse">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"><input type="checkbox" id="checkAllDonViCap" class="check-all"> Đơn Vị Cấp Cao</th>
                                    <th scope="col"><input type="checkbox" id="checkAllTruong" class="check-all"> Trường Thành Viên</th>
                                    <th scope="col"><input type="checkbox" id="checkAllKhoa" class="check-all"> Khoa</th>
                                    <th scope="col"><input type="checkbox" id="checkAllTrungTam" class="check-all"> Trung Tâm</th>
                                    <th scope="col"><input type="checkbox" id="checkAllHanhChinh" class="check-all"> Khối Hành Chính</th>
                                    <th scope="col"><input type="checkbox" id="checkAllPhucVu" class="check-all"> Khối Phục Vụ</th>
                                    <th scope="col"><input type="checkbox" id="checkAllToChuc" class="check-all"> Tổ Chức Đoàn Thể</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        @foreach ($donvicapcao as $dv)
                                            <input type="checkbox" class="check-don-vi" value="{{ $dv->id_DV }}" id="checkDonVi{{ $dv->id_DV }}">
                                            <span>{{ $dv->TenDV }}</span><br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($truong as $truong)
                                            <input type="checkbox" class="check-truong" value="{{ $truong->id }}" id="checkTruong{{ $truong->id }}">
                                            <span>{{ $truong->TenTruong }}</span><br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($khoa as $khoa)
                                            <input type="checkbox" class="check-khoa" value="{{ $khoa->id }}" id="checkKhoa{{ $khoa->id }}">
                                            <span>{{ $khoa->TenKhoa }}</span><br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($trungtam as $tt)
                                            <input type="checkbox" class="check-trung-tam" value="{{ $tt->id }}" id="checkTrungTam{{ $tt->id }}">
                                            <span>{{ $tt->TenTT }}</span><br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($hanhchinh as $hc)
                                            <input type="checkbox" class="check-hanh-chinh" value="{{ $hc->id }}" id="checkHanhChinh{{ $hc->id }}">
                                            <span>{{ $hc->TenP }}</span><br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($phucvu as $pv)
                                            <input type="checkbox" class="check-phuc-vu" value="{{ $pv->id }}" id="checkPhucVu{{ $pv->id }}">
                                            <span>{{ $pv->TenPPV }}</span><br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($tochuc as $tc)
                                            <input type="checkbox" class="check-to-chuc" value="{{ $tc->id }}" id="checkToChuc{{ $tc->id }}">
                                            <span>{{ $tc->TenTC }}</span><br>
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
@endsection