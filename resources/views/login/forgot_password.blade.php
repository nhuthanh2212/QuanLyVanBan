@extends('login_manager')

@section('content')
<h2>Lấy Lại Mật Khẩu</h2>
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
		<form action="{{URL::to('/forgot')}}" method="post">
			{{ csrf_field() }}
			
			<input type="text" class="ggg" placeholder="Tên Đăng Nhập"  name="TenDN">
            <input type="text" class="ggg" placeholder="Số Điện Thoại"  name="DienThoai">
			
			
		
			<div class="clearfix"></div>
			<input type="submit" value="Sign In" >
            <a href="{{URL::to('/login-manager')}}"><button type="button" class="btn btn-light">Quai Lại</button></a>
			
			
		</form>
@endsection