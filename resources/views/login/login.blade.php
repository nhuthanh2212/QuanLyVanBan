@extends('login_manager')

@section('content')
<h2>Đăng Nhập</h2>
	@if ($errors->any())
				    <div class="alert alert-dark">
				        <ul style="list-style-type: none;">
				            @foreach ($errors->all() as $error)
				                <li><span class="text-alert">{{ $error }}</span></li>
				            @endforeach
				        </ul>
				    </div>
				@endif
	<?php
	use Illuminate\Support\Facades\Session;
		$message = Session::get('message');
		if($message){
			echo '<span class="text-alert">'.$message.'</span>' ;
			Session::put('message',null);
		}
	?>
		<form action="{{URL::to('/dang-nhap')}}" method="post">
			{{ csrf_field() }}
			
			<input type="text" class="ggg" placeholder="Tên Đăng Nhập"  name="TenDN">
			<input type="password" class="ggg" name="password" placeholder="Mật Khẩu" >
			<span><input type="checkbox" />Remember Me</span>
			<h6><a href="{{url::to('/forgot-password')}}">Forgot Password?</a></h6>
			<div class="clearfix"></div>
			<input type="submit" value="Sign In" >

			
			
		</form>
@endsection