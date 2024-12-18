@extends('layouts.app')
@section('content')

      	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Thêm Văn Bản Mẫu</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Home</a></li>
              <li class="breadcrumb-item active">Thêm Văn Bản Mẫu</li>
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
              <form method="post" action="{{route('van-ban-mau.store')}}" enctype="multipart/form-data">
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
                        <label for="exampleInputEmail1">Tên Văn Bản: </label>
                        <input type="text" class="form-control" name="TenVB" id="exampleInputEmail1" placeholder="...">
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1">File Đính Kèm: </label>
                        <input type="file" class="form-control" name="file" id="exampleInputEmail1" >
                    </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Gửi</button>
                  <a href="{{route('van-ban-mau.index')}}"><button type="button" class="btn btn-light">Quay Lại </button></a>
                </div>
              </form>
</div>
</div>
</div>
</div>
</section>

@endsection