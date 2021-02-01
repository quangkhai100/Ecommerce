@extends('frontend.layouts.master')
@section('content')

<div class="col-sm-9">
	<div class="blog-post-area">
		<h2 class="title text-center">Latest From our Blog</h2>
		<div class="single-blog-post">

			<h3><?php echo $blog['title'] ?></h3>
			<div class="post-meta">
				<ul>
					<li><i class="fa fa-user"></i> Mac Doe</li>
					<li><i class="fa fa-clock-o"></i> 1:33 pm</li>
					<li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
				</ul>
				<span >
					<div class="rate" id='<?php echo $blog['id'] ?>'>
						<div class="vote">
							@for($i=1; $i <=5; $i++) 
								<div class="star_{{$i}} ratings_star2 
								<?php echo ($tbc >= $i) ? 'ratings_over' :'' ?>">
								<input value="{{$i}}" type="hidden">
								</div>
							@endfor

					</div>
			</div>
			</span>
		</div>
		<a href="">
			<img src="{{ asset('avatar/img/'.$blog['image'])}}" alt="">
		</a>
		<p>
			<?php echo $blog['description'] ?></p>

		<p>
			<?php echo $blog['content'] ?></p>

		<div class="pager-area">
			<ul class="pager pull-right">
				<li><a href="#">Pre</a></li>
				<li><a href="#">Next</a></li>
			</ul>
		</div>
	</div>
</div>
<!--/blog-post-area-->

<div class="rating-area">
	<ul class="ratings">
		<li class="rate-this">Rate this item:</li>
		<li>
			<div class="rate" id='<?php echo $blog['id'] ?>'>
				<div class="vote" >
					@for($i=1; $i <=5; $i++) 
					<div class="star_{{$i}} ratings_stars ">
						<input value="{{$i}}" type="hidden">
					</div>
					@endfor
			</div>
</div>
</li>
<li class="color">(6 votes)</li>
</ul>
<ul class="tag">
	<li>TAG:</li>
	<li><a class="color" href="">Pink <span>/</span></a></li>
	<li><a class="color" href="">T-Shirt <span>/</span></a></li>
	<li><a class="color" href="">Girls</a></li>
</ul>
</div>
<!--/rating-area-->

<div class="socials-share">
	<a href=""><img src="{{ asset('frontend/images/blog/socials.png') }}" alt=""></a>
</div>
<!--/socials-share-->

<div class="media commnets">
	<a class="pull-left" href="#">
		<img class="media-object" src="{{ asset('frontend/images/blog/man-one.jpg') }}" alt="">
	</a>
	<div class="media-body">
		<h4 class="media-heading">Annie Davis</h4>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
		<div class="blog-socials">
			<ul>
				<li><a href=""><i class="fa fa-facebook"></i></a></li>
				<li><a href=""><i class="fa fa-twitter"></i></a></li>
				<li><a href=""><i class="fa fa-dribbble"></i></a></li>
				<li><a href=""><i class="fa fa-google-plus"></i></a></li>
			</ul>
			<a class="btn btn-primary" href="">Other Posts</a>
		</div>
	</div>
</div>
<!--Comments-->
<div class="response-area">
	<h2 class='respones'><?php echo count($commentUser) ?> RESPONSES</h2>
	<ul class="media-list">
	<?php foreach ($commentUser as  $value) {
		if ($value['level']==0){ ?>
		
		<li class="media">
			<a class="pull-left" href="#">
				<img class="media-object" width="100px" height="100px" src="{{ asset('avatar/img/'.$value['comment_user']['avatar']) }}" alt="">
			</a>
			<div class="media-body">
				<ul class="sinlge-post-meta">
					<li><i class="fa fa-user"></i><?php echo $value['comment_user']['name'] ?></li>
					<li><i class="fa fa-clock-o"></i> 1:33 pm</li>
					<li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
				</ul>
				<p><?php echo $value['comment'] ?></p>
				<a class="btn btn-primary replyComment" id='<?php echo $value['id'] ?>' href="###"><i class="fa fa-reply"></i>Replay</a>
			</div>

		</li>
		<?php 
			}foreach ($commentUser as  $x) {
				if ($x['level']!=0  && $x['level']==$value['id']){
			?>
		<li class="media second-media">
			<a class="pull-left" href="#">
				<img class="media-object" width="100px" height="100px"  src="{{ asset('avatar/img/'.$x['comment_user']['avatar']) }}" alt="">
			</a>
			<div class="media-body">
				<ul class="sinlge-post-meta">
					<li><i class="fa fa-user"></i><?php echo $x['comment_user']['name'] ?></li>
					<li><i class="fa fa-clock-o"></i> 1:33 pm</li>
					<li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
				</ul>
				<p><?php echo $x['comment'] ?></p>
				<a class="btn btn-primary" href="###"><i class="fa fa-reply"></i>Replay</a>
			</div>
		</li>
		<?php }}}?>

	</ul>
</div>
<!--/Response-area-->
<div class="replay-box">
	<div class="row">
		<div class="col-sm-4">
			<h2>Leave a replay</h2>
			<form>
				<div class="blank-arrow">
					<label>Your Name</label>
				</div>
				<span>*</span>
				<input type="text" placeholder="write your name...">
				<div class="blank-arrow">
					<label>Email Address</label>
				</div>
				<span>*</span>
				<input type="email" placeholder="your email address...">
				<div class="blank-arrow">
					<label>Web Site</label>
				</div>
				<input type="email" placeholder="current city...">
			</form>
		</div>
		<div class="col-sm-8">
			<div class="text-area">
				<div class="blank-arrow">
					<label>Your Name</label>
				</div>
				<span>*</span>
				<textarea name="message" rows="11" class="commentBlog"></textarea>
			
				<a class="btn btn-primary comment" id =''href="">post comment</a>
			</div>
		</div>
	</div>
</div>
<!--/Repaly Box-->
</div>

<script type="text/javascript">
	$(document).ready(function() {
		//vote
		$('.ratings_stars').hover(
			// Handles the mouseover
			function() {
				$(this).prevAll().andSelf().addClass('ratings_hover');
				// $(this).nextAll().removeClass('ratings_vote'); 
			},
			function() {
				$(this).prevAll().andSelf().removeClass('ratings_hover');
				// set_votes($(this).parent());
			}
		);



		$('.ratings_stars').click(function() {
			var Values = $(this).find("input").val();
			var idBlog = $(".rate").attr("id");
			var getId = '{{Auth::check()}}';
			if (getId==false) {
				alert('đăng nhập để được đánh giá bài');
			} else {
				if ($(this).hasClass('ratings_over')) {
					$('.ratings_stars').removeClass('ratings_over');
					$(this).prevAll().andSelf().addClass('ratings_over');
				} else {
					$(this).prevAll().andSelf().addClass('ratings_over');
				}
				$.ajax({
					method: "POST", // phương thức dữ liệu được truyền đi
					url: "/rate/ajax", // gọi đến file server show_data.php để xử lý
					// data: $("#fr_form").serialize(),//lấy toàn thông tin các fields trong form bằng hàm serialize của jquery
					data: {
						rate: Values,
						idBlog: idBlog,
						_token: '{{ csrf_token() }}'
					},
					success: function(response) {
						//kết quả trả về từ server nếu gửi thành công
						console.log(response);
					}
				});
			}
		});

		//comment
		$('.comment').click(function() {
			var text= $('.commentBlog').val();
			console.log(text);
			var idBlog = $(".rate").attr("id");
			var getId = '{{Auth::check()}}';
			var level= $(this).attr('id');
			if (level==''){
				level=0;
			}
			if (getId==false) {
				alert('đăng nhập để được binh luan bài');
			}
			else{
				$.ajax({
					method: "POST", // phương thức dữ liệu được truyền đi
					url: "/comment/ajax", // gọi đến file server show_data.php để xử lý
					// data: $("#fr_form").serialize(),//lấy toàn thông tin các fields trong form bằng hàm serialize của jquery
					data: {
						commentBlog: text,
						idBlog: idBlog,
						level:level,
						_token: '{{ csrf_token() }}'
					},
					success: function(response) {
						//kết quả trả về từ server nếu gửi thành công
						console.log(response);
					}
				});
			}
		});
		$('.replyComment').click(function() {
			var getId = '{{Auth::check()}}';
			var level = $(this).attr('id');
			if (getId==false) {
				alert('đăng nhập để được binh luan bài');
			}
			else{
				$('.comment').attr('id',level)
			}
		});
	});
</script>
@endsection