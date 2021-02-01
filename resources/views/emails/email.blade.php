@extends('frontend.layouts.master')
@section('content')
<section id="cart_items">
		<div class="container">
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
								<a href="#"><img  width="60px" height="60px" src="{{ asset('upload/user/'.$userId.'/'.$i)}}" alt=""></a>
								<?php } ?>
							</td>
							<td class="cart_description">
								<h4><a href=""><?php echo $value['price']?></a></h4>
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
    @endsection
