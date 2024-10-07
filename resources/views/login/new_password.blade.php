@extends('login_manager')

@section('content')
<h2>Nhập Mật Khẩu Mới</h2>
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
        $id = Session::get('id');
		if($message){
			echo '<span class="text-alert">'.$message.'</span>' ;
			Session::put('message',null);
		}
	?>
		<form action="{{URL::to('/password')}}" method="post">
			{{ csrf_field() }}
			<input type="hidden"   name="id" value="{{$id}}">
			<input type="text" class="ggg" placeholder="Mật Khẩu Mới"  name="password">
            <input type="text" class="ggg" placeholder="Xác Nhận Mật Khẩu"  name="comfirm">
			
			
		
			<div class="clearfix"></div>
			<input type="submit" value="Sign In" >
            <a href="{{URL::to('/forgot-password')}}"><button type="button" class="btn btn-light">Quai Lại</button></a>
			
			
		</form>
@endsection