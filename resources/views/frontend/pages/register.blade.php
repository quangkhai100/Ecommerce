@extends('frontend.layouts.master')
@section('content')
<section id="form">
	<!--form-->
	<div class="container">
		<div class="row">

			<div class="col-sm-4">
				<div class="signup-form">
					<!--sign up form-->
					<h2>New User Signup!</h2>
					<form action="" method='post' enctype="multipart/form-data">
						@csrf
						<input type="text" name='name' placeholder="name" />
						<input type="email" name='email' placeholder="Email Address" />
						<input type="password" name='password' placeholder="Password" />
						<input type="file" name='avatar' placeholder="avatar" />
						<input type="number" name='phone' placeholder="Phone Number" />
						<input type="text" name='message' placeholder="Message" />
						<select name= 'country'>
							<?php
							foreach ($countries as $value) { ?>
								<option value="<?php echo $value['id'] ?>" <?php echo $value['id']  ?>><?php echo $value['name'] ?></option>
							<?php } ?>
						</select>
						<button type="submit" name='register' class="btn btn-default">Signup</button>
						<br>
					</form>
				</div>
				<!--/sign up form-->
			</div>
		</div>
	</div>
	@if ($errors->any())
	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
	@endif
</section>
<!--/form-->
@endsection