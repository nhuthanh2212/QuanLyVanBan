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

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
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



<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>



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
    $( "#departure_date" ).datepicker();
    $( "#return_date" ).datepicker();
    
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
  $(function () {
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
    })
  })
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
    $('.check-don-vi, .check-truong, .check-khoa, .check-trung-tam, .check-hanh-chinh, .check-phuc-vu, .check-to-chuc').on('change', function() {
        updateSelectedRecipients();
        updateCheckAllStatus();
    });

    // Function to collect and display selected recipients by name
    function updateSelectedRecipients() {
        var selectedNames = []; // Array to store selected names
        
        // Collect checked checkboxes and their corresponding names
        $('.check-don-vi:checked').each(function() {
            selectedNames.push($(this).next('span').text()); // Get the text of the next sibling span
        });
        $('.check-truong:checked').each(function() {
            selectedNames.push($(this).next('span').text());
        });
        $('.check-khoa:checked').each(function() {
            selectedNames.push($(this).next('span').text());
        });
        $('.check-trung-tam:checked').each(function() {
            selectedNames.push($(this).next('span').text());
        });
        $('.check-hanh-chinh:checked').each(function() {
            selectedNames.push($(this).next('span').text());
        });
        $('.check-phuc-vu:checked').each(function() {
            selectedNames.push($(this).next('span').text());
        });
        $('.check-to-chuc:checked').each(function() {
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
        $('#checkAllDonViCap').prop('checked', $('.check-don-vi:checked').length === $('.check-don-vi').length);
        $('#checkAllTruong').prop('checked', $('.check-truong:checked').length === $('.check-truong').length);
        $('#checkAllKhoa').prop('checked', $('.check-khoa:checked').length === $('.check-khoa').length);
        $('#checkAllTrungTam').prop('checked', $('.check-trung-tam:checked').length === $('.check-trung-tam').length);
        $('#checkAllHanhChinh').prop('checked', $('.check-hanh-chinh:checked').length === $('.check-hanh-chinh').length);
        $('#checkAllPhucVu').prop('checked', $('.check-phuc-vu:checked').length === $('.check-phuc-vu').length);
        $('#checkAllToChuc').prop('checked', $('.check-to-chuc:checked').length === $('.check-to-chuc').length);
        
    }
    // Apply change handler to check-all for each group to ensure update on check/uncheck
    $('#checkAllDonViCap').on('change', function() {
        $('.check-don-vi').prop('checked', this.checked);
        updateSelectedRecipients(); // Ensure to update recipients list after check/uncheck
    });

    $('#checkAllTruong').on('change', function() {
        $('.check-truong').prop('checked', this.checked);
        updateSelectedRecipients();
    });

    $('#checkAllKhoa').on('change', function() {
        $('.check-khoa').prop('checked', this.checked);
        updateSelectedRecipients();
    });

    $('#checkAllTrungTam').on('change', function() {
        $('.check-trung-tam').prop('checked', this.checked);
        updateSelectedRecipients();
    });

    $('#checkAllHanhChinh').on('change', function() {
        $('.check-hanh-chinh').prop('checked', this.checked);
        updateSelectedRecipients();
    });

    $('#checkAllPhucVu').on('change', function() {
        $('.check-phuc-vu').prop('checked', this.checked);
        updateSelectedRecipients();
    });

    $('#checkAllToChuc').on('change', function() {
        $('.check-to-chuc').prop('checked', this.checked);
        updateSelectedRecipients();
    });
    $('#checkAll').on('change', function() {
      $('.check-don-vi').prop('checked', this.checked);
      $('.check-truong').prop('checked', this.checked);
      $('.check-khoa').prop('checked', this.checked);
      $('.check-trung-tam').prop('checked', this.checked);
      $('.check-hanh-chinh').prop('checked', this.checked);
      $('.check-phuc-vu').prop('checked', this.checked);
        $('.check-to-chuc').prop('checked', this.checked);
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
</body>
</html>
