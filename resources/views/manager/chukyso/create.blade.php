@extends('layouts.app')
@section('content')
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0">Cấp Chữ Ký Số</h1>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Home</a></li>
               <li class="breadcrumb-item"><a href="{{Route( 'chu-ky-so.index')}}">Danh Sách</a></li>
               <li class="breadcrumb-item active">Cấp Chữ Ký Số</li>
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
               <form method="post" action="{{URL::to('manager/cap-chu-ky-so')}}" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                        <div class="form-group">
                           <label for="exampleInputPassword1">Chọn Đơn Vị Cấp Chữ Ký Số:</label>
                           <select name="donvi" id="donvi" class="form-control input-sm m-bot15 choose donvi">
                              <option value="0">-----Chọn Khối-----</option>
                              @foreach($nhom as $key => $nh)
                              <option value="{{$nh->id}}">{{ Str::afterLast($nh->TenGroup, '-') }}</option>
                              @endforeach
                           </select>
                        </div>
                        <div class="form-group">
                           <label for="exampleInputPassword1">Chọn Cá Nhân Cấp Chữ Ký Số:</label>
                           <select name="canhan" id="canhan" class="form-control input-sm m-bot15 canhan  ">
                              <option value="0">-----Chọn Phòng Ban------</option>
                           </select>
                        </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                     <button type="submit" name="add_chuky" class="btn btn-primary add_chuky">Thêm</button>
                     <a href="{{route('chu-ky-so.index')}}"><button type="button" class="btn btn-light">Quay Lại</button> </a>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
   <!-- /.container-fluid -->
</section>
<script >
   $(document).ready(function(){
     
        $('.choose').on('change', function() {
        var action = $(this).attr('id');
        var donvi = $(this).val(); // Lấy giá trị của select hiện tại
        var _token = $('input[name="_token"]').val();
        var $result = '';

        // Kiểm tra xem action là đơn vị hay không
        if (action == 'donvi') {
            $result = 'canhan'; // Nếu là đơn vị, cập nhật cá nhân
        } 

        // Gọi Ajax để lấy danh sách cá nhân
        $.ajax({
            url: '{{url("/manager/select-ca-nhan")}}',
            method: 'post',
            data: { action: action, donvi: donvi, _token: _token }, // Truyền 'donvi' trong request
            success: function(data) {
                $('#' + $result).html(data); // Cập nhật select box cá nhân
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown); // Log lỗi nếu có
            }
        });
        });
   });
</script>
@endsection
