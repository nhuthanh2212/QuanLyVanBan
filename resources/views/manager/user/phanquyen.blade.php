@extends('layouts.app')
@section('content')
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0">Cấp Quyền Cho {{$user->HoTen}}</h1>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Home</a></li>
               <li class="breadcrumb-item"><a href="{{Route( 'user.index')}}">Danh Sách</a></li>
               <li class="breadcrumb-item active">Cấp Quyền</li>
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
               <form action="{{url('manager/insert-permission',[$user->id_TK])}}" method="POST">
                    @csrf
                    <div class="card-body" style="margin-left: 20px;">
                    <div class="form-group">
                    @if(isset($name_roles))
                    <p>Vai Trò Hiện Tại (Role):
                        @foreach($name_roles as $key => $r)
                            {{$r->name}}
                        @endforeach
                    </p>
                    @else
                        <p>Chưa Có Vai Trò</p>
                    @endif
                    </div>
                    @foreach($permission as $key => $per)
                    <div class="form-group">
                     
                        <label class="form-check-label" for="{{$per->id}}">
                            <input class="form-check-input" type="checkbox" 
                            @foreach($get_permission_viarole as $key => $get)
                                @if($get->id == $per->id)
                                    checked
                                    
                                @endif
                            @endforeach

                             name="permission[]" multiple value="{{$per->id}}" id="{{$per->id}}">
                            
                            {{$per->name}}
                          </label>
                        </div>
                    @endforeach
                    </div>
                    <div class="card-footer">
                        @if($get_permission_viarole)
                            <input type="submit" name="updateroles" value="Cập Nhật Thêm Quyền Cho User" class="btn btn-warning btn-sm">
                        @else
                            <input type="submit" name="insertroles" value="Cấp Quyền Cho User" class="btn btn-danger btn-sm">
                        @endif
                        <a href="{{route('user.index')}}" class="btn btn-success btn-sm">Quay Lại</a>
                    </div>
                </form>
                <div class="col-md-8">
            <div >
                <form action="{{url('manager/insert-per')}}" method="POST" >
                    @csrf
                    <div class="form-group">
                        <label for="exampleModalLabel">Tên Quyền:</label>
                        <input type="text" class="form-control" name="permission" value="{{old('permission')}}" placeholder="Tên Quyền....">
                    </div>
                
                <input type="submit" class="btn btn-primary btn-sm" name="insertper" value="Thêm Quyền">
                </form>
            </div>
        </div>
            </div>
         </div>
      </div>
   </div>
   <!-- /.container-fluid -->
</section>
@endsection
