
<!DOCTYPE html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link type="image/x-icon" href="https://duytan.edu.vn/images/icon/DTU.ICO?v=1" rel="Shortcut Icon">
  <title>Quản Lý Văn Bản Trường Đại Học Duy Tân </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{asset('login/css/bootstrap.min.css')}}" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('login/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('login/css/style-responsive.css')}}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('login/css/font.css')}}" type="text/css"/>
<link href="{{asset('login/css/font-awesome.css')}}" rel="stylesheet"> 
<!-- //font-awesome icons -->
<script src="{{asset('login/js/jquery2.0.3.min.js')}}"></script>
</head>
<body>
<div class="log-w3">
<div class="w3layouts-main">
	<h2>Đăng Nhập</h2>
	

		<form action="{{URL::to('/home')}}" method="post">
			{{ csrf_field() }}
			@if ($errors->any())
				    <div class="alert alert-dark">
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				        </ul>
				    </div>
				@endif
			<input type="text" class="ggg" placeholder="Tên Đăng Nhập"  name="TenDN">
			<input type="password" class="ggg" name="password" placeholder="Mật Khẩu" >
			<span><input type="checkbox" />Remember Me</span>
			<h6><a href="{{url::to('/forgot-password')}}">Forgot Password?</a></h6>
			<div class="clearfix"></div>
			<input type="submit" value="Sign In" >

			
			
		</form>
		<!-- <p>Don't Have an Account ?<a href="registration.html">Create an account</a></p> -->
		
</div>
</div>
<script src="{{asset('login/js/bootstrap.js')}}"></script>
<script src="{{asset('login/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('login/js/scripts.js')}}"></script>
<script src="{{asset('login/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('login/js/jquery.nicescroll.js')}}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset('login/js/jquery.scrollTo.js')}}"></script>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>
</html>
