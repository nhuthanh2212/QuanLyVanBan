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
            <div class="card-body">
               <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                  <div class="row">
                     <div class="col-sm-12 col-md-6">
                        <div class="dt-buttons btn-group flex-wrap">
                           <button class="btn btn-secondary buttons-copy buttons-html5" tabindex="0" aria-controls="example1" type="button">
                                <span>Copy</span
                            ></button>
                            <button class="btn btn-secondary buttons-csv buttons-html5" tabindex="0" aria-controls="example1" type="button">
                                <span>CSV</span>
                            </button> 
                            <button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0" aria-controls="example1" type="button">
                                <span>Excel</span>
                            </button> 
                            <button class="btn btn-secondary buttons-pdf buttons-html5" tabindex="0" aria-controls="example1" type="button">
                                <span>PDF</span>
                            </button> <button class="btn btn-secondary buttons-print" tabindex="0" aria-controls="example1" type="button">
                                <span>Print</span>
                            </button> 
                           
                        </div>
                     </div>
                     
                  </div>
                  <div class="row">
                     <div class="col-sm-12">
                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                           <thead>
                              <tr>
                                 <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Rendering engine</th>
                                 <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Browser</th>
                                 <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Platform(s)</th>
                                 <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Engine version</th>
                                 <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">CSS grade</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr class="odd">
                                 <td class="dtr-control sorting_1" tabindex="0">Gecko</td>
                                 <td>Firefox 1.0</td>
                                 <td>Win 98+ / OSX.2+</td>
                                 <td>1.7</td>
                                 <td>A</td>
                              </tr>
                              <tr class="even">
                                 <td class="dtr-control sorting_1" tabindex="0">Gecko</td>
                                 <td>Firefox 1.5</td>
                                 <td>Win 98+ / OSX.2+</td>
                                 <td>1.8</td>
                                 <td>A</td>
                              </tr>
                              
                           </tbody>
                           <tfoot>
                              <tr>
                                 <th rowspan="1" colspan="1">Rendering engine</th>
                                 <th rowspan="1" colspan="1">Browser</th>
                                 <th rowspan="1" colspan="1">Platform(s)</th>
                                 <th rowspan="1" colspan="1">Engine version</th>
                                 <th rowspan="1" colspan="1">CSS grade</th>
                              </tr>
                           </tfoot>
                        </table>
                     </div>
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
