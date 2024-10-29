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
                        <label for="loaivanban">Loại Văn Bản: </label>
                        <select id="loaivanban" name="id_LVB" class="form-control choose" aria-label="Small select example" >
                            <option value="0" selected>-----------Chọn-----------</option>
                            @foreach ($loaivanban as $lvb )
                            <option value="{{$lvb->id_LVB}}" >{{$lvb->TenLVB}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Đơn Vị Ban Hành: </label>
                        <input type="text" class="form-control" value="{{$tengroup}}" disabled>
                        <input type="hidden"  name="id_Gr"  id="donvibanhanh" value="{{$id}}" >
                        
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1">Văn Bản Số: </label>
                        <div class="row">
                            <input type="text" name="tt" id="so_thu_tu" style="width: 80px; margin: 0px 5px 0px 10px;" >
                            <input disabled  value="-" style="width: 15px; margin-right: 5px;">
                            <input readonly   name="kytu" id="kytu" style="width: 40px; margin-right: 5px;">
                            <input disabled  value="-" style="width: 15px; margin-right: 5px;">
                            <input readonly   name="namgui" value="{{ \Carbon\Carbon::now()->format('Y') }}" style="width: 40px; margin-right: 5px;">
                            <input disabled  value="-" style="width: 15px; margin-right: 5px;">
                            <input readonly   name="thuoc" value="DHDT">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Trích Yếu Nội Dung: </label>
                        <input type="text" class="form-control" name="NoiDung" id="exampleInputEmail1" placeholder="...">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Ghi Chú: </label>
                        <input type="text" class="form-control" name="GhiChu" id="exampleInputEmail1" placeholder="...">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Ngày Ban Hành: </label>
                        <input type="text" class="form-control" name="NgayBH"  id="datepicker"  value="{{ \Carbon\Carbon::now()->format('d/m/Y') }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Ngày Gửi: </label>
                        <input type="text" class="form-control"  id="exampleInputEmail1" disabled value="{{ \Carbon\Carbon::now()->format('d/m/Y') }}">
                        <input type="hidden" class="form-control" name="NgayGui" id="exampleInputEmail1"  >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Người Gửi: </label>
                        <input type="text" class="form-control" name="id_TK" id="exampleInputEmail1" placeholder="..." value="{{$taikhoan->HoTen}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tình Trạng Văn Bản: </label>
                        <div class="row">
                            <label style=" margin: 0px 5px 0px 10px;"><input type="radio" name="TrangThai" id="exampleInputEmail1" value="1" style="margin-right: 5px;" checked> Đã Duyệt</label>
                            <label style=" margin-left: 10px;"><input type="radio"  name="TrangThai" id="exampleInputEmail1" value="0"  style="margin-right: 5px;">Chưa Duyệt</label>
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">File Đính Kèm: </label>
                        <input type="file" class="form-control" name="file" id="exampleInputEmail1" >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nơi Nhận: </label>
                        
                    </div>
                  <!-- Collapsible section -->
                  <div id="recipientListt" style="display: none;">
                       
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