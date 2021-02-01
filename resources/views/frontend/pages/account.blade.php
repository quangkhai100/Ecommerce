@extends('frontend.layouts.masterAccount')
@section('content')
<section>

	<div class="col-sm-9 padding-right">
		<div class="features_items">
			<!--features_items-->
			<h2 class="title text-center">User Update</h2>
			<div class="signup-form">
				<!--sign up form-->
				<form method='post' enctype="multipart/form-data">
					@csrf
					<input type="text" name='name' placeholder="UserName" value="{{ Auth::user()->name }}" />

					<input type="email" name='email' placeholder="Email Address" value=" {{ Auth::user()->email }}" />

					<input type="password" name='password' placeholder="Password" />

					<input type="password" name='password-c' placeholder="Confirm Password" />

					<input type="file" name="avatar" />

					<input type="number" name='phone' placeholder="Phone No" />

					<textarea rows="3" placeholder="Message"></textarea>

					<select name='id_country'>
						<?php
						foreach ($countries as $value) { ?>
							<option value="<?php echo $value['id'] ?>" <?php echo ($value['id']==Auth::user()->id_country)?'selected':' ' ?>><?php echo $value['name'] ?></option>
						<?php } ?>
					</select>
					<button type="submit" name='update' class="btn btn-default">Update</button>
					<br>
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
		</div>
		<!--features_items-->
	</div>

</section>
@endsection
