<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Account</h2>
						<div class="panel-group category-products" id="accordian">
							<!--category-productsr-->
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="{{ url('member/'.Auth::id()) }}">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											Account
										</a>
									</h4>
								</div>
								<div id="sportswear" class="panel-collapse collapse">

								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a href="{{ url('member/products') }}">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											My Products
										</a>
									</h4>
								</div>
								<div id="mens" class="panel-collapse collapse">

								</div>
							</div>

						</div>
						<!--/category-products-->
					</div>
				</div>