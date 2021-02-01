@extends('frontend.layouts.masterHome')
@section('content')
<div class="col-sm-9 padding-right">
	<div class="features_items">
		<!--features_items-->

		<h2 class="title text-center">Find Items</h2>
		<?php foreach ($products as $value) { ?>
			<div class="col-sm-4">
				<div class="product-image-wrapper">
					<div class="single-products">
						<div class="productinfo text-center">
							<?php $a = json_decode($value['images']) ?>
							<img src="{{ asset('upload/user/'.Auth::id().'/'.$a[0])}}" alt="" />
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