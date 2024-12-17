@extends('layouts.app')
@section('content')
<div class="content">
   <div class="container-fluid">
      <div class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
                  <h1 class="m-0">Danh Sách Văn Bản Đã Lưu</h1>
               </div>
               <!-- /.col -->
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Home</a></li>
                     <li class="breadcrumb-item active">Lưu Trữ</li>
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
                    
                     <div class=" mailbox-messages table table-reponsive">
                        <table class="table table-hover table-striped" id="myTable" >
                           <thead>
                              <tr >
                                 <th scope="col" >STT
                                 </th>
                               
                                 <th scope="col">Tên Văn Bản</th>
                                 <th scope="col">file</th>
                               
                                 <th scope="col">Quản Lý</th>

                             
                              </tr>
                           </thead>
                           <tbody>
                             
                             
                                 @foreach($vanBan as $key => $vb)
                                 <tr id="scrollspyHeading{{$key}}" data-id="{{ $vb->id }}">
                                    <td>
                                       {{ $key }}
                                    </td>
                                   
                                    <td>
                                       <span>
                                       {{$vb->NoiDung}} 
                                       </span>
                                      
                                    </td>
                                    <td>
                                    <a href="{{URL::to('/mo-file', $vb->id)}}" id="vb{{$key}}" style="color: black">
                                       {{$vb->file}} 
                                       </a>
                                    </td>
                                    
                                    <td>
                                      
                                        <form onsubmit="return confirm('Bạn Có Muốn Xóa Văn Bản Lưu Trữ Này không?')" action="{{route('luu-tru.destroy',$vb->id)}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" class="btn  btn-danger" value="Xóa" >
                                        </form>
                                    </td>
                                   
                                 </tr>
                                 @endforeach
                            
                           </tbody>
                        </table>
                        <!-- /.table -->
                     </div>
                     <!-- /.mail-box-messages -->
                 
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
