@extends('frontend.layouts.master')
@section('content')
<div class="col-sm-9">
					<div class="blog-post-area">
						<h2 class="title text-center">Latest From our Blog</h2>
						<?php foreach($blog as $key => $value){?>
						<div class="single-blog-post">
							<h3><?php echo $value['title'] ?></h3>
							<div class="post-meta">
								<ul>
									<li><i class="fa fa-user"></i> Mac Doe</li>
									<li><i class="fa fa-clock-o"></i> 1:33 pm</li>
									<li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
								</ul>
								<span>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-half-o"></i>
								</span>
							</div>
							<a href="">
							

								<img src= "{{ asset('avatar/img/'.$value['image']) }}" alt="">
							</a>
							<p><?php echo $value['description'] ?></p>
							<a  class="btn btn-primary" href="{{ url('/blog/detail/'.$value['id']) }}">Read More</a>
						</div>
							<?php }?>
					
						<div class="pagination-area">
							<ul class="pagination">
							{{$blog->links() }}

							</ul>
						</div>
					</div>
				</div>
@endsection