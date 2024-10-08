@extends('layouts.app')
@section('content')
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0">Danh Sách Văn Bản Đi</h1>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Home</a></li>
               <li class="breadcrumb-item active">Danh Sách Văn Bản Đi</li>
            </ol>
         </div>
         <!-- /.col -->
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
         <div class="card-body p-0">
              <div class="mailbox-controls ">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm">
                    <i class="far fa-trash-alt"></i>
                  </button>
                  
                </div>
                <!-- /.btn-group -->
                  <a href="{{route('van-ban-di.index')}}">
                     <button type="button" class="btn btn-default btn-sm">
                        <i class="fas fa-sync-alt"></i>
                     </button>
                  </a>
                  <a href="{{route('van-ban-di.create')}}">
                     <button type="button" class="btn btn-sm btn-success">
                        <i class="fa-solid fa-pen"></i>
                        Soạn Văn Bản
                     </button>
                  </a>
                  <div  class=" " >
                  <form method="post" action="{{route('loc-phim')}}" enctype="multipart/form-data">
                  @csrf
                     <select class="form-select form-select-sm" aria-label="Small select example">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                     </select>
                     <select class="form-select form-select-sm" aria-label="Small select example">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                     </select>
                  </form>
                  </div>
                <!-- /.float-right -->
              </div>
              <div class=" mailbox-messages table table-reponsive">
                <table class="table table-hover table-striped" id="myTable">
                  <thead>
                     <tr>
                        <th scope="col">
                          
                        </th>
                        
                        <th scope="col">Người Gửi </th>
                        <th scope="col">Nội Dung</th>
                        <th scope="col">Nơi Đến</th>
                        

                     </tr>
                  </thead>
                  <tbody>
                     
                  <tr>
                    <td>
                      <div class="icheck-primary">
                        <input type="checkbox" value="" id="check1">
                        <label for="check1"></label>
                      </div>
                    </td>
                    <td class="mailbox-star"><a href="#"><i class="fas fa-star text-warning"></i></a></td>
                    <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
                    <td class="mailbox-subject"><b>AdminLTE 3.0 Issue</b> - Trying to find a solution to this problem...
                    </td>
                    
                    
                  </tr>
                  
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
              <div class="card-footer p-0">
              <div class="mailbox-controls">               <!-- Check all button -->
                
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.float-right -->
              </div>
            </div>
            </div>
            
         </div>
         
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>
@endsection
