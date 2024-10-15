@extends('layouts.app')
@section('content')
<div class="content">
      <div class="container-fluid">
      	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tạo Group</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Home</a></li>
             
              <li class="breadcrumb-item active">Tạo Group</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
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
       
                    <div class="position-center">
                        <form>
                            @csrf
                                            
                            <div class="form-group">
                                <label for="exampleInputPassword1">Chọn Khối</label>
                                <select name="khoi" id="khoi" class="form-control input-sm m-bot15 choose khoi">
                                    
                                    <option value="0">-----Chọn Khối-----</option>
                                    @foreach($khoi as $key => $k)
                                        <option value="{{$k->id}}">{{$k->TenK}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Chọn Phòng Ban</label>
                                <select name="phongban" id="phongban" class="form-control input-sm m-bot15 choose phongban">
                                    
                                    <option value="0">-----Chọn Phòng Ban------</option>
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Chọn Đơn Vị</label>
                                <select name="donvi" id="donvi" class="form-control input-sm m-bot15 choose donvi">
                                    
                                    <option value="0">-----Chọn Đơn Vị-----</option>
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Chọn Phòng</label>
                                <select name="phong" id="phong" class="form-control input-sm m-bot15 choose phong">
                                    
                                    <option value="0">-----Chọn Phòng-----</option>
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Chọn Ngành</label>
                                <select name="nganh" id="nganh" class="form-control input-sm m-bot15 choose nganh">
                                    
                                    <option value="0">-----Chọn Ngành-----</option>
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Chọn Chuyên Ngành</label>
                                <select name="chuyennganh" id="chuyennganh" class="form-control input-sm m-bot15 chuyennganh">
                                    
                                    <option value="0">-----Chọn Đơn Vị-----</option>
                                    
                                </select>
                            </div>
                            
                    
                            <button type="button" name="add_group" class=" btn btn-info add_delivery">Tạo</button>
                        </form>
                    </div>
                    <br>
                    <div id="load_group">
                        
                    </div>
            
</div>
</div>
</div>

<!-- nhom nguoi dung thuoc phòng ban nao -->
<script type="text/javascript">
    $(document).ready(function(){
        fetch_group();
        
        function fetch_group(){
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url("/list-group")}}',
                method: 'POST',
                data: {_token:_token},
                success:function(data){
                    $('#load_group').html(data);
                }
            });
        }
        
        $('.add_group').click(function(){

            var khoi = $('.khoi').val();
            var phongban = $('.phongban').val();
            var donvi = $('.donvi').val();
            var phong = $('.phong').val();
            var nganh = $('.nganh').val();
            var chuyennganh = $('.chuyennganh').val();
            
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: '{{url("/insert-group")}}',
                method: 'post',
                data: { khoi: khoi, phongban: phongban, donvi: donvi, phong: phong, nganh: nganh, chuyennganh: chuyennganh , _token: _token },
                success: function(data){
                    alert('Tạo Group Thành Công');
                    fetch_group();
                }
            });

        });
        $('.choose').on('change', function() {
            var action = $(this).attr('id');
            var id_K = $(this).val(); // Lấy giá trị của select hiện tại
            var _token = $('input[name="_token"]').val();
            var $result = '';

            // Kiểm tra xem action là khối hay các mục khác
            if (action == 'khoi') {
                $result = 'phongban'; // Nếu là khối, cập nhật phòng ban
            } else if (action == 'phongban') {
                $result = 'donvi'; // Nếu là phòng ban, cập nhật đơn vị
            } else if (action == 'donvi') {
                $result = 'phong'; // Nếu là đơn vị, cập nhật phòng
            } else if (action == 'phong') {
                $result = 'nganh'; // Nếu là phòng, cập nhật ngành
            } else if (action == 'nganh') {
                $result = 'chuyennganh'; // Nếu là ngành, cập nhật chuyên ngành
            }

            // Gọi Ajax để lấy dữ liệu tương ứng với lựa chọn hiện tại
            $.ajax({
                url: '{{url("/select-group")}}', // URL có thể cần điều chỉnh
                method: 'post',
                data: { action: action, id_K: id_K, _token: _token },
                success: function(data) {
                    $('#' + $result).html(data); // Cập nhật thẻ select kế tiếp
                }
            });
        });
    });
</script>
@endsection