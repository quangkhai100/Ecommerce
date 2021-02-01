@extends('frontend.layouts.masterHome')
@section('content')
<div class="col-sm-9 padding-right">
	<div class="features_items">
		<!--features_items-->
		<div >
		<form action="{{url('/search/advanced')}}" method='post'>
		@csrf
		<ul class="user_info">
		<li ><input type="text" placeholder="Name" name='name'></li>
		<li >
		<select  name= 'price'>
			<option value="all">All</option>
			<option value='1-80'>10-50</option>
		</select>
		</li>
		<li>
		<select  name= 'category'>
		<option value="all">All</option>

		<?php
					foreach ($category as $value) { ?>
						<option value="<?php echo $value['name'] ?>" <?php echo $value['id']  ?>><?php echo $value['name'] ?></option>
					<?php } ?>
		</select></li>
		<li>
		<select  name='brand'>
		<option value="all">All</option>
		<?php
						foreach ($brand as $value) { ?>
							<option value="<?php echo $value['name'] ?>" <?php echo $value['id']  ?>><?php echo $value['name'] ?></option>
						<?php } ?>
		</select></li>
		<li>
		<select  name='status'>
			<option value="0">All</option>
			<option value="1">New</option>
			<option value="2">Sale</option>
		</select></li>
		<input type="submit" value="Search" class="btn btn-default get">
		</div>
		</ul>
		</form>
		<h2 class="title text-center">Features Items</h2>
		<?php foreach ($products as $value) { ?>
			<div class="col-sm-4">
				<div class="product-image-wrapper">
					<div class="single-products">
						<div class="productinfo text-center">
							<?php $a = json_decode($value['images']) ?>
							<img src="{{ asset('upload/user/'.Auth::id().'/'.array_slice($a, 0, 1)[0])}}" alt="" />
							<?php if ($value['sale'] == '1') { ?>
								<h2>$<?php echo $value['price'] ?></h2>
							<?php } else { ?>
								<h2>$<?php echo (100 - intval($value['amount_sale'])) / 100 * intval($value['price']) ?></h2>
								<h4 style="color: orange;text-decoration: line-through">$<?php echo $value['price'] ?></h4>
							<?php } ?>
							<p><?php echo $value['name'] ?></p>
							<a href="#" class="btn btn-default add-to-cart" id="<?php echo $value['id'] ?>"><i class="fa fa-shopping-cart"></i>Add to cart</a>
						</div>
						<div class="product-overlay">
							<div class="overlay-content">
								<?php if ($value['sale'] == '1') { ?>
									<h2>$<?php echo $value['price'] ?></h2>
								<?php } else { ?>
									<h2>$<?php echo (100 - intval($value['amount_sale'])) / 100 * intval($value['price']) ?></h2>
									<h4 style="color: white;text-decoration: line-through">$<?php echo $value['price'] ?></h4>
								<?php } ?>
								<p><?php echo $value['name'] ?></p>
								<a href="#" class="btn btn-default add-to-cart" id="<?php echo $value['id'] ?>"><i class="fa fa-shopping-cart"></i>Add to cart</a>
							</div>
						</div>
						<?php if ($value['sale'] == '1') { ?>
							<img src="{{ asset('frontend/images/home/new.png')}}" class="new" alt="" />
						<?php } else { ?>
							<img src="{{ asset('frontend/images/home/sale.png')}}" class="new" alt="" />
						<?php } ?>

					</div>
					<div class="choose">
						<ul class="nav nav-pills nav-justified">
							<li><a href="{{ url('member/products/details/' . $value['id']) }}"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
							<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
						</ul>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
	<!--features_items-->
</div>
<script type="text/javascript">
    $(document).ready(function() {
      $('.add-to-cart').click(function(){
		var productID=$(this).attr('id');
		$.ajax({
			method: "POST", // phương thức dữ liệu được truyền đi
					url: "/addToCart/ajax", // gọi đến file server show_data.php để xử lý
					// data: $("#fr_form").serialize(),//lấy toàn thông tin các fields trong form bằng hàm serialize của jquery
					data: {
						idProduct: productID,
						_token: '{{ csrf_token() }}'
					},
					success: function(response) {
						//kết quả trả về từ server nếu gửi thành công
						console.log(response);
					}
		});
	  })
    });
    
</script>
@endsection