@extends('layouts.app')
@section('content')
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0">Cấp Vai Trò Cho {{$user->HoTen}}</h1>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Home</a></li>
               <li class="breadcrumb-item"><a href="{{Route( 'user.index')}}">Danh Sách</a></li>
               <li class="breadcrumb-item active">Cấp Vai Trò</li>
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
               <form action="{{url('manager/insert-roles',[$user->id_TK])}}" method="POST">
                    @csrf
                    <div class="card-body" style="margin-left: 20px;">
                        <div class="form-group">
                    @if(isset($name_roles))
                        <p>Vai Trò Hiện Tại (Role): 
                                @foreach($name_roles as $key => $name_rol)
                                {{$name_rol->name}}
                                @endforeach
                        </p>
                    @else
                    <p>Chưa Có Vai Trò</p>
                    @endif
                        </div>
                        
                    @foreach($role as $key => $r)
                        @if(isset($all_column_roles))
                        <div class="form-group">
                        <label class="form-check-label" for="{{$r->id}}">
                                <input class="form-check-input"  type="radio" name="role" id="{{$r->id}}" value="{{$r->name}}" 
                                    @foreach($user->roles as $rol)
                                        @if($rol->id == $r->id)
                                            checked
                                        @endif
                                    @endforeach
                                 >
                                
                                    {{$r->name}}
                                </label>
                                
                   
                        </div>
                        
                        @else
                        <div class="form-group">
                            
                            <input class="form-check-input"type="radio" name="role" id="{{$r->id}}" value="{{$r->name}}">
                            <label class="form-check-label" for="{{$r->id}}">
                                {{$r->name}}
                            </label>
                        
                         
                            </div>
                        @endif
                        
                    @endforeach
                    </div>
                    <div class="card-footer">
                    @if(isset($all_column_roles))
                        <input type="submit" name="updateroles" value="Cập Nhật Thêm Vai Trò Cho User" class="btn btn-warning btn-sm">
                    @else
                         <input type="submit" name="insertroles" value="Cấp Vai Trò Cho User" class="btn btn-danger btn-sm">
                    @endif
                    <a href="{{route('user.index')}}" class="btn btn-success btn-sm">Quay Lại</a>
                    </div>
                    
                </form>
            </div>
         </div>
      </div>
   </div>
   <!-- /.container-fluid -->
</section>
@endsection
