@extends('layouts.app')

@section('content')
<style type="text/css">
		h1.tile {
			text-align: center;
			font-size: 30px;
			font-weight: bold;
			margin: 10px;
		}
	</style>
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 ">
            <h1 class="m-0 tile">Thống Kê Theo Loại Văn Bản</h1>
          </div><!-- /.col -->
         
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
         <div class="card card-primary">
                    <div class="row">
                      <div class="form-group col-md-12" style="margin: 5px 0px 0px 20px;">
                          <form autocomplete="off" class="d-flex align-items-center">
                          @csrf
                              <p class="mb-0 me-4">Từ Ngày: <input type="text" name="" id="datepicker" class="form-control" style="width: auto;     margin-right: 50px;"></p>
                              <p class="mb-0 me-4">Đến Ngày: <input type="text" id="datepicker1" name="" class="form-control" style="width: auto;     margin-right: 50px;"></p>
                              <input type="button" value="Thống Kê" class="btn btn-success btn-sm me-3" id="thong_ke" style="margin-right: 50px;">
                              <p class="mb-4">Lọc Theo: 
                                  <select class="dashboard-filter form-control">
                                      <option>------Chọn-----</option>
                                      <option value="7ngay">Tuần Trước</option>
                                      <option value="thangtruoc">Tháng Trước</option>
                                      <option value="thangnay">Tháng Này</option>
                                      <option value="365ngayqua">Năm</option>
                                  </select>
                              </p>
                          </form>
                      </div>
                  </div>
                     <div id="myfirstchart" style="height: 250px;"></div>
                    </div>
          </div>
        </div>
       
      </div>
     
    </section>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 ">
            <h1 class="m-0 tile">Thống Kê Theo Đơn Vị Ban Hành</h1>
          </div><!-- /.col -->
         
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
         <div class="card card-primary">
                  
                    <div class="row">
                      <div class="form-group col-md-12" style="margin: 5px 0px 0px 20px;">
                          <form autocomplete="off" class="d-flex align-items-center">
                          @csrf
                              <p class="mb-0 me-4">Từ Ngày: <input type="text" name="" id="datepicker2" class="form-control" style="width: auto;     margin-right: 50px;"></p>
                              <p class="mb-0 me-4">Đến Ngày: <input type="text" id="datepicker3" name="" class="form-control" style="width: auto;     margin-right: 50px;"></p>
                              <input type="submit" value="Thống Kê" class="btn btn-success btn-sm me-3" id="thong_ke_dvbh" style="margin-right: 50px;">
                              <p class="mb-4">Lọc Theo: 
                                  <select class="dashboard-filter1 form-control">
                                      <option>------Chọn-----</option>
                                      <option value="7ngay">Tuần Trước</option>
                                      <option value="thangtruoc">Tháng Trước</option>
                                      <option value="thangnay">Tháng Này</option>
                                      <option value="365ngayqua">Năm</option>
                                  </select>
                              </p>
                          </form>
                      </div>
                  </div>
                     <div id="myfirstchart1" style="height: 250px;"></div>
                    </div>
          </div>
        </div>
       
      
     </div>
    </section>
@endsection
