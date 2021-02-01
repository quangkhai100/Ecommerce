@extends('frontend.layouts.master')
@section('content')
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($products as $key => $value) {
					?>
						<tr>
							<td class="cart_product">
							<?php foreach(json_decode($value['images']) as $i){ ?>
								<a href="#"><img  width="60px" height="60px" src="{{ asset('upload/user/'.Auth::id().'/'.$i)}}" alt=""></a>
								<?php } ?>
							</td>
							<td class="cart_description">
								<h4><a href=""><?php echo $value['name']?></a></h4>
								<p>Web ID: 1089772</p>
							</td>
							<td class="cart_price" id="<?php echo $value['price']?>">
								<p>$ <?php echo $value['price']?></p>
							</td>
							<td class="cart_quantity" id= "<?php echo $value['id'] ?>">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" href="#"> + </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="<?php echo $value['quality'] ?>" autocomplete="off" size="2">
									<a class="cart_quantity_down" href="#"> - </a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price " id='<?php  $total= $value['price']*$value['quality']; echo $total?>'>$ <?php echo $total?></p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="#"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Use Coupon Code</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Use Gift Voucher</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Estimate Shipping & Taxes</label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Country:</label>
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								
							</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
							
							</li>
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span>$59</span></li>
							<li>Eco Tax <span>$2</span></li>
							<li>Shipping Cost <span>Free</span></li>
							<?php $total=0?>	
							<?php foreach ($products as $key => $value) { 
								$total += $value['price'] * $value['quality']; }?>

							<li>Total <span class='total_product' id ='<?php  echo $total ?>'>$<?php echo $total  ?></span></li>
						</ul>
							<?php if(Auth::check()){ ?>
							<form action="" method='post'>
								@csrf
							<input type="hidden" name="price" value='<?php echo $total ?>'>

							<input class="btn btn-default check_out" type="submit" value="CheckOut">
							</form>
							<?php }else{?>
							<a class="btn btn-default check_out" href="{{ url('member/register') }}">Check Out</a>
							<?php }?>
					</div>
				</div>
			</div>
		</div>
    </section><!--/#do_action-->
	<script>
	$(document).ready(function() {

		$(".cart_quantity_up").click(function() {
			var quantity = $(this).closest('tr').find('.cart_quantity_input').attr('value');
			var convertINt = parseInt(quantity)
			var up=convertINt += 1;
			var idProduct = $(this).closest('tr').find('.cart_quantity').attr('id')

			$(this).closest('tr').find('.cart_quantity_input').attr('value', up);
			var price = $(this).closest('tr').find('.cart_price').attr('id');

			$(this).closest('tr').find('.cart_total_price').text('$' + price * convertINt)

			var getTong = $('.total_product').attr('id');
			getTong = parseInt(getTong) + parseInt(price);

			$('.total_product').text('$' + getTong)
			$('.total_product').attr('id',getTong);

			$.ajax({
				method: "POST", // phương thức dữ liệu được truyền đi
				url: "/caculate/ajax", // gọi đến file server show_data.php để xử lý
				// data: $("#fr_form").serialize(),//lấy toàn thông tin các fields trong form bằng hàm serialize của jquery
				data: {
					qtyUpdate: up,
					productId: idProduct,
					_token: '{{ csrf_token() }}'
				},
				success: function(response) {
					//kết quả trả về từ server nếu gửi thành công
					console.log(response);
				}
			});
			

		})
		$(".cart_quantity_down").click(function() {
			var idProduct = $(this).closest('tr').find('.cart_quantity').attr('id')
			var quantity = $(this).closest('tr').find('.cart_quantity_input').attr('value');
			var price = $(this).closest('tr').find('.cart_price').attr('id');
			var convertINt = parseInt(quantity)
			var down=convertINt -= 1;

			var getTong = $('.total_product').attr('id');
			getTong = parseInt(getTong) - parseInt(price);
			$('.total_product').text('$' + getTong)
			$('.total_product').attr('id',getTong)
			if (down > 0) {
				$(this).closest('tr').find('.cart_quantity_input').attr('value', down)
				$(this).closest('tr').find('.cart_total_price').text('$' + convertINt * price)
				$.ajax({
					method: "POST", // phương thức dữ liệu được truyền đi
					url: "/caculate/ajax", // gọi đến file server show_data.php để xử lý
					// data: $("#fr_form").serialize(),//lấy toàn thông tin các fields trong form bằng hàm serialize của jquery
					data: {
						qtyUpdate: down,
						productId: idProduct,
						_token: '{{ csrf_token() }}'
					},
					success: function(response) {
						//kết quả trả về từ server nếu gửi thành công

						console.log(response);
					}
				});

			}
			
		})
		$(".cart_quantity_delete").click(function() {
			$(this).closest('tr').remove()
			var objDeleted = $(this).attr('id')
			var quantity = $(this).closest('tr').find('.cart_quantity_input').attr('value');
			var idProduct = $(this).closest('tr').find('.cart_quantity').attr('id')
			var price = $(this).closest('tr').find('.cart_price').attr('id');
			var convertINt = parseInt(quantity)
			var getTong = $('.total_product').attr('id');
			var tongCon= convertINt * price
			getTong = parseInt(getTong) - parseInt(tongCon);

			$('.total_product').text('$' + getTong)
			$('.total_product').attr('id',getTong);
			$.ajax({
				method: "POST", // phương thức dữ liệu được truyền đi
				url: "/delete/ajax", // gọi đến file server show_data.php để xử lý
				// data: $("#fr_form").serialize(),//lấy toàn thông tin các fields trong form bằng hàm serialize của jquery
				data: {
					deleteProduct: idProduct,
					_token: '{{ csrf_token() }}'
				},
				success: function(response) {
					//kết quả trả về từ server nếu gửi thành công

					console.log(response);
				}
			});


		})

	})
</script>
    @endsection