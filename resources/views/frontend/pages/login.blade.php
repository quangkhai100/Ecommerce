@extends('frontend.layouts.master')
@section('content')
<section id="form">
	<!--form-->
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-1">
				<div class="login-form">
					<!--login form-->
					<h2>Login to your account</h2>
					<form action="" method='post'>
					@csrf
						<input type="email" name='email' placeholder="Email Address" />
						<input type="password" name='password' placeholder="Password" />
						<button type="submit" name='login' class="btn btn-default">Login</button>
				</div>
				<label for="remember">Remember me</label>
				<input type="checkbox" name="rememer_me" id="remember" value=false>
				</form>
				@if ($errors->any())
	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
	@endif
			</div>
			<!--/login form-->
		</div>
	</div>
	</div>
</section>

@endsection