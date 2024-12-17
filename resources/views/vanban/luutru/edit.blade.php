@extends('layouts.app')
@section('content')
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0">Sữa Nội Dung</h1>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Home</a></li>
               <li class="breadcrumb-item"><a href="{{Route( 'luu-tru.index')}}">Danh Sách Lưu Trữ</a></li>
               <li class="breadcrumb-item active">Sữa Nội Dung</li>
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
               <form action="{{ url::to('save-file', ['id' => $vanban->id]) }}" method="POST">
                    @csrf
                    <textarea name="content" rows="10" cols="50" style="height: 450px; width: 100%;">{{ $content }}</textarea>
                    <br>
                    <button type="submit">Lưu thay đổi</button>
                </form>
            </div>
         </div>
      </div>
   </div>
</section>
@endsection
