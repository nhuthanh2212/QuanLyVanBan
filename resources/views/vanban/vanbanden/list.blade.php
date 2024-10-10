@extends('layouts.app')
@section('content')
<div class="content">
   <div class="container-fluid">
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0">Danh Sách Văn Bản Đến</h1>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Home</a></li>
               <li class="breadcrumb-item active">Danh Sách Văn Bản Đến</li>
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
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm">
                    <i class="far fa-trash-alt"></i>
                  </button>
                  
                </div>
                <!-- /.btn-group -->
                  <a href="{{route('van-ban-den.index')}}">
                     <button type="button" class="btn btn-default btn-sm">
                        <i class="fas fa-sync-alt"></i>
                     </button>
                  </a>
                <!-- /.float-right -->
              </div>
              <div class=" mailbox-messages table table-reponsive">
                <table class="table table-hover table-striped" id="myTable">
                  <thead>
                     <tr>
                        <th scope="col">
                          
                        </th>
                        <th scope="col"></th>
                        <th scope="col">Tên </th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col">Quản Lý</th>

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
                    <td class="mailbox-attachment"></td>
                    <td class="mailbox-date">5 mins ago</td>
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
