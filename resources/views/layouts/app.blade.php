<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link type="image/x-icon" href="https://duytan.edu.vn/images/icon/DTU.ICO?v=1" rel="Shortcut Icon">
  <title>Quản Lý Văn Bản Trường Đại Học Duy Tân </title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('backend/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('backend/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

  <!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<!-- css date -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

<link rel="stylesheet" href="https://code.jquery.com/ui/1.14.0/themes/base/jquery-ui.css">
<!-- biểu đồ-->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
 <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{URL::to('/home')}}" class="nav-link">Home</a>
      </li>
      <?php
          use Illuminate\Support\Facades\Session;
            $id = Session::get('id');
            
          ?>
      @if($id)
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{URL::to('/logout')}}" class="nav-link"><button type="button" class="btn btn-ligh btn-sm">Đăng Xuất</button></a>
      </li>
      @endif
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <?php 
            use App\Models\TaiKhoan;
            $taikhoan = TaiKhoan::where('id_TK',$id)->first();
          ?>
          @if ($taikhoan->chu_ky_so == 1)
          <a href="{{url::to('manager/create-ky-so')}}" class="dropdown-item" >
            <i class="fas fa-envelope mr-2"></i> Chữ Ký Số
            
          </a>
          @endif
        
          <div class="dropdown-divider"></div>
          
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('layouts.include.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @yield('content')
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2024-2025</strong>
    <img style="margin-left: 10px; margin-right: 5px;" src="https://duytan.edu.vn/images/icon/DTU.ICO?v=1"  alt="Shortcut Icon">
    Quản Lý Văn Bản Trường Đại Học Duy Tân
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->


<!-- REQUIRED SCRIPTS -->



<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- jQuery -->
<script src="{{asset('backend/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE -->
<script src="{{asset('backend/dist/js/adminlte.js')}}"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{asset('backend/plugins/chart.js/Chart.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('backend/dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('backend/dist/js/pages/dashboard3.js')}}"></script>

<script src="https://code.jquery.com/ui/1.14.0/jquery-ui.js"></script>

<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>


<!-- DataTables  & Plugins -->
<script src="{{asset('backend/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('backend/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('backend/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('backend/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<!-- xem trước trên web -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/mammoth/1.4.2/mammoth.browser.min.js"></script> -->
<script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
<script src="https://unpkg.com/mammoth/mammoth.browser.min.js"></script>
<script src="https://cdn.rawgit.com/andreasgal/rtf.js/master/rtf.js"></script>

<script>
    CKEDITOR.replace( 'ckeditor', {
        licenseKey: 'your license key'
    } );
    CKEDITOR.replace( 'ckeditor1', {
        licenseKey: 'your license key'
    } );
    CKEDITOR.replace( 'ckeditor2', {
        licenseKey: 'your license key'
    } );
</script>


<script>
  $( function() {
      $( "#datepicker" ).datepicker({
        dateFormat: "dd/mm/yy"
      });
      $( "#datepicker1" ).datepicker({
        dateFormat: "dd/mm/yy"
      });
  } );
  </script>

  <script src="//cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
  <script type="text/javascript">
    let table = new DataTable('#myTable');

  </script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script>
  $(document).ready(function() {
    //Enable check and uncheck all functionality
    $('.checkbox-toggle').click(function () {
      var clicks = $(this).data('clicks')
      if (clicks) {
        //Uncheck all checkboxes
        $('.mailbox-messages input[type=\'checkbox\']').prop('checked', false)
        $('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
      } else {
        //Check all checkboxes
        $('.mailbox-messages input[type=\'checkbox\']').prop('checked', true)
        $('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
      }
      $(this).data('clicks', !clicks)
    })

    //Handle starring for font awesome
    $('.mailbox-star').click(function (e) {
      e.preventDefault()
      //detect type
      var $this = $(this).find('a > i')
      var fa    = $this.hasClass('fa')

      //Switch states
      if (fa) {
        $this.toggleClass('fa-star')
        $this.toggleClass('fa-star-o')
      }
    });
    // Handle delete button click event
    $('.delete-selected').click(function() {
        var selectedIds = [];
        
        // Collect all checked checkboxes
        $('input[type="checkbox"]:checked').each(function() {
            // Assuming the row id is stored in a data attribute (for example, data-id)
            var rowId = $(this).closest('tr').data('id');
            if (rowId) {
                selectedIds.push(rowId);
            }
        });

        if (selectedIds.length === 0) {
            alert('Chọn Ít Nhất Một Văn Bản Để Xóa.');
            return;
        }

        // Send an AJAX request to delete the selected rows
        $.ajax({
            url: '{{ route("van-ban-di.delete") }}', // Your delete route here
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}', // CSRF token
                ids: selectedIds
            },
            success: function(response) {
                // Reload the page or remove the deleted rows
                location.reload(); // or manually remove the rows from the table
            },
            error: function(xhr) {
                console.error('An error occurred:', xhr);
                alert('Error deleting the records. Please try again.');
            }
        });
    });
    $('.deleted-selected').click(function() {
        var selectedIds = [];
        
        // Collect all checked checkboxes
        $('input[type="checkbox"]:checked').each(function() {
            // Assuming the row id is stored in a data attribute (for example, data-id)
            var rowId = $(this).closest('tr').data('id');
            if (rowId) {
                selectedIds.push(rowId);
            }
        });

        if (selectedIds.length === 0) {
            alert('Chọn Ít Nhất Một Văn Bản Để Xóa.');
            return;
        }

        // Send an AJAX request to delete the selected rows
        $.ajax({
            url: '{{ route("van-ban-den.delete") }}', // Your delete route here
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}', // CSRF token
                ids: selectedIds
            },
            success: function(response) {
                // Reload the page or remove the deleted rows
                location.reload(); // or manually remove the rows from the table
            },
            error: function(xhr) {
                console.error('An error occurred:', xhr);
                alert('Error deleting the records. Please try again.');
            }
        });
    });
  });
</script>
<script>
         $(function() {
             $( "#start_date" ).datepicker({
                 //defaultDate: "+1w",
                 minDate: '0',
                 dateFormat: "dd-mm-yy",
                 changeMonth: true,
                 numberOfMonths: 1,
                 onClose: function( selectedDate ) {
                     $( "#end_date" ).datepicker( "option", "minDate", selectedDate );
                 }
             });
             $( "#end_date" ).datepicker({
                 //defaultDate: "+1w",
                 dateFormat: "dd-mm-yy",
                 changeMonth: true,
                 numberOfMonths: 1,
                 onClose: function( selectedDate ) {
                     $( "#start_date" ).datepicker( "option", "maxDate", selectedDate );
                 }
             });
         });
      </script>

<!-- collapse nguoi nhan ở van ban di -->
<script>
$(document).ready(function() {
    // Check/uncheck all checkboxes in a column
    $('.check-all').on('change', function() {
        var isChecked = $(this).is(':checked');
        var className = $(this).attr('id').replace('checkAll', 'check-'); // get the corresponding checkbox class
        $('.' + className).prop('checked', isChecked);

        // Update the display of selected names after check/uncheck all
        updateSelectedRecipients();
    });

    // Show or hide the recipient list when clicking on recipientDisplay
    $('#recipientDisplay').on('click', function() {
        $('#recipientList').collapse('toggle');
    });

    // Collect selected recipients when checkboxes change
    $(' .check-phong-ban, .check-don-vi, .check-phong, .check-nganh, .check-chuyen-nganh').on('change', function() {
        updateSelectedRecipients();
        updateCheckAllStatus();
    });

    // Function to collect and display selected recipients by name
    function updateSelectedRecipients() {
        var selectedNames = []; // Array to store selected names
        
        // Collect checked checkboxes and their corresponding names
        $('.check-phong-ban:checked').each(function() {
            selectedNames.push($(this).next('span').text()); // Get the text of the next sibling span
        });
        $('.check-don-vi:checked').each(function() {
            selectedNames.push($(this).next('span').text());
        });
        $('.check-phong:checked').each(function() {
            selectedNames.push($(this).next('span').text());
        });
        $('.check-nganh:checked').each(function() {
            selectedNames.push($(this).next('span').text());
        });
        $('.check-chuyen-nganh:checked').each(function() {
            selectedNames.push($(this).next('span').text());
        });
        

        // Display the selected names in Bootstrap badges
        var badgeHtml = selectedNames.map(function(name) {
            return '<span class="badge badge-secondary m-1">' + name + '</span>'; // Create a span for each name with Bootstrap badge class
        }).join(''); // Join all the span elements

        // Update the recipient display
        $('#recipientDisplay').html(badgeHtml); // Set the inner HTML with badges
    }
    function updateCheckAllStatus() {
        // Check for each group, if all checkboxes are selected, check the "check-all", otherwise uncheck it
        $('#checkAllPhongBan').prop('checked', $('.check-phong-ban:checked').length === $('.check-phong-ban').length);
        $('#checkAllDonVi').prop('checked', $('.check-don-vi:checked').length === $('.check-don-vi').length);
        $('#checkAllPhong').prop('checked', $('.check-phong:checked').length === $('.check-phong').length);
        $('#checkAllNganh').prop('checked', $('.check-nganh:checked').length === $('.check-nganh').length);
        $('#checkAllChuyenNganh').prop('checked', $('.check-chuyen-nganh:checked').length === $('.check-chuyen-nganh').length);
       
        
    }
    // Apply change handler to check-all for each group to ensure update on check/uncheck
    $('#checkAllPhongBan').on('change', function() {
        $('.check-phong-ban').prop('checked', this.checked);
        updateSelectedRecipients(); // Ensure to update recipients list after check/uncheck
    });

    $('#checkAllDonVi').on('change', function() {
        $('.check-don-vi').prop('checked', this.checked);
        updateSelectedRecipients();
    });

    $('#checkAllPhong').on('change', function() {
        $('.check-phong').prop('checked', this.checked);
        updateSelectedRecipients();
    });

    $('#checkAllNganh').on('change', function() {
        $('.check-nganh').prop('checked', this.checked);
        updateSelectedRecipients();
    });

    $('#checkAllChuyenNganh').on('change', function() {
        $('.check-chuyen-nganh').prop('checked', this.checked);
        updateSelectedRecipients();
    });

   
    $('#checkAll').on('change', function() {
      $('.check-phong-ban').prop('checked', this.checked);
      $('.check-don-vi').prop('checked', this.checked);
      $('.check-phong').prop('checked', this.checked);
      $('.check-nganh').prop('checked', this.checked);
      $('.check-chuyen-nganh').prop('checked', this.checked);
      
      updateSelectedRecipients();
    });
    
    // Initial call to update selected recipients when the page loads (if needed)
    updateSelectedRecipients();
    updateCheckAllStatus();
});
</script>

<!-- //format data ngay va gio -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Duyệt qua tất cả các thẻ span chứa ngày gửi
        document.querySelectorAll('.date').forEach(function(element, index) {
            // Lấy giá trị ngày gửi từ thuộc tính data
            const ngayGui = new Date(element.getAttribute('data-ngay-gui'));

            // Định dạng lại ngày (dd/mm/yyyy hh:mm:ss)
            const formattedDate = 
                ngayGui.getDate().toString().padStart(2, '0') + '/' +         // Ngày
                (ngayGui.getMonth() + 1).toString().padStart(2, '0') + '/' +  // Tháng
                ngayGui.getFullYear() + ' ' +                                 // Năm
                ngayGui.getHours().toString().padStart(2, '0') + ':' +        // Giờ
                ngayGui.getMinutes().toString().padStart(2, '0') + ':' +      // Phút
                ngayGui.getSeconds().toString().padStart(2, '0');             // Giây

            // Cập nhật nội dung đã định dạng vào thẻ span
            element.textContent = formattedDate;
        });
    });
</script>


<!-- tai van ban -->
<script>
  
    $(document).ready(function() {
        $('.download-file').on('click', function(e) {
            e.preventDefault(); // Ngăn chặn hành vi mặc định của liên kết

            const fileName = $(this).data('filename');

            // Gửi yêu cầu AJAX để tải file
            $.ajax({
                url: '{{ route("file.download") }}',
                type: 'GET',
                data: { file: fileName },
                xhrFields: {
                    responseType: 'blob' // Đặt loại phản hồi là blob để tải file
                },
                success: function(blob, status, xhr) {
                    // Tạo một đối tượng URL từ blob
                    const url = window.URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = fileName; // Đặt tên file cho file tải về
                    document.body.appendChild(a);
                    a.click(); // Tự động nhấp vào liên kết để tải file
                    a.remove(); // Xóa liên kết sau khi tải xong
                    window.URL.revokeObjectURL(url); // Giải phóng URL
                },
                error: function(xhr) {
                    alert('Có lỗi xảy ra trong quá trình tải file: ' + xhr.responseJSON.error);
                }
            });
        });
    });

</script>

<script>
  $(document).ready(function() {
    $('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel', 'pdf', 'print'
        ]
    });
});
</script>
<!-- nhom nguoi dung thuoc phòng ban nao -->
<script>
  jQuery(document).ready(function(){
    fetch_group();
    function fetch_group(){
      var _token = $('input[name="_token"]').val();
      $ajax({
        url: '{{url("/manager/list-group")}}',
        method: 'POST',
        data: {_token: _token},
        success:function(data){
          $('#load_group').html(data);
        }
      });
    }
    $('.choose').on('change', function(){
      var action = $(this).attr('id');
      var id_K = $(this).val();
      var _token = $('input[name="_token"]').val();
      var $result = ' ';
      if(action == 'khoi'){
        $result = 'phongban';
      }else if(action == 'phongban'){
        $result = 'donvi';
      }else if(action == 'donvi'){
        $result = 'phong';
      }else if(action == 'phong'){
        $result = 'nganh';
      }else if(action == 'nganh'){
        $result = 'chuyennganh';
      }
      $.ajax({
        url: '{{url("/manager/select-group")}}',
        method: 'post',
        data: { action: action, id_K: id_K, _token: _token },
        success: function(data) {
            console.log('Data received:', data); // Debug log
            $('#'+$result).html(data); // Cập nhật thẻ select kế tiếp
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log('Error:', textStatus, errorThrown); // Debug log
        }
      });
    });

  });
</script>

<!-- gui van ban -->
<script>
  jQuery(document).ready(function() {
    
    $(document).on('change', '.check-alll', function() {
        var isChecked = $(this).is(':checked');
        var className = $(this).attr('id').replace('checkAlll', 'check-');
        $('.' + className).prop('checked', isChecked);
        updateSelectedRecipients();
    });

    $(document).on('change', '.checkk-phong-ban, .checkk-don-vi, .checkk-phong, .checkk-nganh, .checkk-chuyen-nganh', function() {
    updateSelectedRecipients();
    updateCheckAllStatus();
    });

     // Show or hide the recipient list when clicking on recipientDisplay
    $('#recipientDisplayy').on('click', function() {
        $('#recipientListt').collapse('toggle');
    });
     // Function to collect and display selected recipients by name
    function updateSelectedRecipients() {
        var selectedNames = []; // Array to store selected names
        
        // Collect checked checkboxes and their corresponding names
        $('.checkk-phong-ban:checked').each(function() {
            selectedNames.push($(this).next('span').text()); // Get the text of the next sibling span
        });
        $('.checkk-don-vi:checked').each(function() {
            selectedNames.push($(this).next('span').text());
        });
        $('.checkk-phong:checked').each(function() {
            selectedNames.push($(this).next('span').text());
        });
        $('.checkk-nganh:checked').each(function() {
            selectedNames.push($(this).next('span').text());
        });
        $('.checkk-chuyen-nganh:checked').each(function() {
            selectedNames.push($(this).next('span').text());
        });
        

        // Display the selected names in Bootstrap badges
        var badgeHtml = selectedNames.map(function(name) {
            return '<span class="badge badge-secondary m-1">' + name + '</span>'; // Create a span for each name with Bootstrap badge class
        }).join(''); // Join all the span elements

        // Update the recipient display
        $('#recipientDisplayy').html(badgeHtml); // Set the inner HTML with badges
    }
    function updateCheckAllStatus() {
        // Check for each group, if all checkboxes are selected, check the "check-all", otherwise uncheck it
        $('#checkAlllPhongBan').prop('checked', $('.checkk-phong-ban:checked').length === $('.checkk-phong-ban').length);
        $('#checkAlllDonVi').prop('checked', $('.checkk-don-vi:checked').length === $('.checkk-don-vi').length);
        $('#checkAlllPhong').prop('checked', $('.checkk-phong:checked').length === $('.checkk-phong').length);
        $('#checkAlllNganh').prop('checked', $('.checkk-nganh:checked').length === $('.checkk-nganh').length);
        $('#checkAlllChuyenNganh').prop('checked', $('.checkk-chuyen-nganh:checked').length === $('.checkk-chuyen-nganh').length);
       
        
    }
    // Apply change handler to check-all for each group to ensure update on check/uncheck
    $('#checkAlllPhongBan').on('change', function() {
        $('.checkk-phong-ban').prop('checked', this.checked);
        updateSelectedRecipients(); // Ensure to update recipients list after check/uncheck
    });

    $('#checkAlllDonVi').on('change', function() {
        $('.checkk-don-vi').prop('checked', this.checked);
        updateSelectedRecipients();
    });

    $('#checkAlllPhong').on('change', function() {
        $('.checkk-phong').prop('checked', this.checked);
        updateSelectedRecipients();
    });

    $('#checkAlllNganh').on('change', function() {
        $('.checkk-nganh').prop('checked', this.checked);
        updateSelectedRecipients();
    });

    $('#checkAlllChuyenNganh').on('change', function() {
        $('.checkk-chuyen-nganh').prop('checked', this.checked);
        updateSelectedRecipients();
    });

   
    $('#checkAlll').on('change', function() {
      $('.checkk-phong-ban').prop('checked', this.checked);
      $('.checkk-don-vi').prop('checked', this.checked);
      $('.checkk-phong').prop('checked', this.checked);
      $('.checkk-nganh').prop('checked', this.checked);
      $('.checkk-chuyen-nganh').prop('checked', this.checked);
      
      updateSelectedRecipients();
    });
    
    

    $('#recipientListt').hide(); // Ẩn danh sách khi trang tải

    // Sự kiện thay đổi dropdown loại văn bản
    $('.choose').on('change', function() {
        var id_LVB = $('#loaivanban').val();  // Lấy giá trị từ dropdown Loại Văn Bản
        var id_Gr = $('#donvibanhanh').val();  // Lấy giá trị từ input Đơn Vị Ban Hành
        var _token = $('meta[name="csrf-token"]').attr('content');  // Lấy CSRF token từ meta tag

        // Kiểm tra nếu cả hai giá trị đã được chọn
        if (id_LVB != '0' && id_Gr) {
            $.ajax({
                url: '{{ url("/van-ban/check-noi-nhan") }}', // Đường dẫn đến phương thức kiểm tra
                method: 'POST',
                data: { id_LVB: id_LVB, id_Gr: id_Gr, _token: _token },
                success: function(response) {
                    $('#recipientListt').html(response.html); // Cập nhật nội dung danh sách
                    $('#recipientListt').show(); // Hiện danh sách
                   
                    // Gọi lại các hàm để cập nhật danh sách đã chọn và trạng thái checkbox
                      updateSelectedRecipients();
                      updateCheckAllStatus();

                      // Re-bind lại sự kiện cho các checkbox mới được thêm
                      $(document).on('change', '.checkk-phong-ban, .checkk-don-vi, .checkk-phong, .checkk-nganh, .checkk-chuyen-nganh', function() {
                          updateSelectedRecipients();
                          updateCheckAllStatus();
                      });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('Error:', textStatus, errorThrown); // Debug lỗi
                }
            });
        }
    });
  });
</script>

<!-- xem trước online  -->
<script>
    document.querySelectorAll('.preview-file').forEach(link => {
    link.addEventListener('click', function(event) {
        event.preventDefault();
        const fileUrl = this.getAttribute('data-file');
        const fileExtension = fileUrl.split('.').pop().toLowerCase();
        
        const modalBody = document.getElementById('output');
        modalBody.innerHTML = '';  // Clear the previous content

        if (fileExtension === 'docx') {
            fetch(fileUrl)
                .then(response => response.arrayBuffer())
                .then(arrayBuffer => {
                    mammoth.convertToHtml({ arrayBuffer: arrayBuffer })
                        .then(result => {
                            document.getElementById('output').innerHTML = result.value; // Display DOCX content
                        })
                        .catch(handleError);
                });
        } else if (fileExtension === 'pdf') {
            displayPDF(fileUrl); // Handle PDF
        } else if (fileExtension === 'txt') {
            fetch(fileUrl)
                .then(response => response.text())
                .then(text => {
                    modalBody.innerHTML = '<pre>' + text + '</pre>'; // Display TXT content
                });
        } else if (fileExtension === 'rtf') {
            fetch(fileUrl)
                .then(response => response.text())
                .then(rtf => {
                    displayRTF(rtf); // Display RTF content
                });
        } else {
            alert("Định dạng file không hỗ trợ.");
        }
    });
});

function displayPDF(fileUrl) {
    const modalBody = document.getElementById('output');
    modalBody.innerHTML = '<iframe src="' + fileUrl + '" style="width: 100%; height: 500px;"></iframe>';
}

function displayRTF(rtf) {
    const parser = new RTFJS.Document(rtf);
    parser.render().then(html => {
        document.getElementById('output').innerHTML = html; // Display the formatted RTF
    });
}

function handleError(err) {
    console.log(err);
    alert("Đã xảy ra lỗi khi đọc file.");
}
</script>
<!-- xử lý số hiệu tăng theo loại văn bản cua tháng -->
<script>
    $(document).ready(function() {
        $('#loaivanban').on('change', function() {
            var id_LVB = $(this).val();

            // Kiểm tra nếu không chọn loại văn bản nào
            if (id_LVB == 0) {
                $('#so_thu_tu').val(''); // Xóa giá trị nếu không chọn gì
                return;
            }

            // Gửi AJAX request đến Controller để lấy số thứ tự tiếp theo
            $.ajax({
                url: '/get-next-so-thu-tu/' + id_LVB,
                method: 'GET',
                success: function(response) {
                    $('#so_thu_tu').val(response.next_so_thu_tu);
                    $('#kytu').val(response.ky_tu);
                },
                error: function() {
                    alert('Có lỗi xảy ra, vui lòng thử lại!');
                }
            });
        });
    });
</script>
<!-- //thong ke -->

<script type="text/javascript">
    	$(document).ready(function(){
    		chart30daysorder();
    		var chart = new Morris.Bar({
    			element: 'myfirstchart',
    			lineColors:['#819c79','#fc8710','#FF6541','#A4ADD3','#766B56'],
    			pointFillColors: ['#ffffff'],
    			pointStrokeColors: ['black'],
    			fillOpacity: 0.6,
    			hideHover: 'auto',
    			parseTime: false,
    			xkey: 'period',
    			ykeys: ['type', 'quantity'],
    			behaveLikeLine: true,
    			labels: ['Công Văn','Số Lương']
    		});

    		function chart30daysorder(){
    			var _token = $('input[name="_token"]').val();
    			$.ajax({
    				url: "{{url('/days-order')}}",
    				method: "POST",
    				dataType: "JSON",
    				data: {_token:_token},
    				success:function(data){
    					chart.setData(data);
    				}
    			});
    		}

    		$('.dashboard-filter').change(function(){
    			var dashboard_value = $(this).val();
    			var _token = $('input[name="_token"]').val();
    			$.ajax({
    				url: "{{url('/dashboard-filter')}}",
    				method:"POST",
    				dataType:"JSON",
    				data:{dashboard_value:dashboard_value, _token:_token },
    				success:function(data){
    					chart.setData(data);
     				}
    			});

    		});

    		$('#thong_ke').click(function(){
    			var _token = $('input[name="_token"]').val();
    			var from_date = $('#datepicker').val();
    			var to_date = $('#datepicker1').val();
    			$.ajax({
    				url: "{{url('/filter-by-date')}}",
    				method:"POST",
    				dataType:"JSON",
    				data:{from_date:from_date, to_date:to_date, to_date:to_date, _token:_token },
    				success:function(data){
    					chart.setData(data);
    				}
    			});
    		});
    	});
    </script>
</body>
</html>
