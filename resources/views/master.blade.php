<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="{{asset("public/favicon.ico")}}">
		<title>Renda - clean blog theme based on Bootstrap</title>
		<!-- Bootstrap core CSS -->
	<link href="{{asset("public/css/bootstrap.min.css")}}" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<!-- Custom styles for this template -->
		<link href="{{asset("public/css/jquery.bxslider.css")}}" rel="stylesheet">
		<link href="{{asset("public/css/style.css")}}" rel="stylesheet">
                <link href="{{asset('public/css/app.css')}}" /> 
                <link href="{{asset('public/assets/css/styles.css')}}" rel="stylesheet">
                <link href="{{asset('public/assets/css/responsive.css')}}" rel="stylesheet">
	</head>
	<body>
		<!-- Navigation -->
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
					</button>
				</div>
				<div id="navbar" class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="{{URL::to('/')}}">Home</a></li>
						<li><a href="{{URL::to('/lifeStyle')}}">Lifestyle</a></li>
						<li><a href="{{URL::to('/travel')}}">Travel</a></li>
						<li><a href="{{URL::to('/fashion')}}">Fashion</a></li>
						<li><a href="{{URL::to('/aboutMe')}}">About Me</a></li>
					<li><a href="{{URL::to('/contact')}}">Contact</a></li>
					<li><a href="#">Category</a></li>
					</ul>

					<ul class="nav navbar-nav navbar-right">
						<li><a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a></li>
						<li><a href="#"><i class="fa fa-twitter"></i></a></li>
						<li><a href="#"><i class="fa fa-instagram"></i></a></li>
						<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                                @guest
                                                <li><a href="{{route('login')}}">Login</a></li>
						<li><a href="{{URL::to('/register')}}">Register</a></li>
                                                @else
                                                <li>
                                                  <a class="dropdown-item" href="{{ route('logout') }}"
                                                        onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                                         {{ __('Logout') }}
                                                  </a>
                                                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                         @csrf
                                                     </form>
                                               </li>
                                               @endguest
                                                
					</ul>

				</div>
				<!--/.nav-collapse -->
			</div>
		</nav>

		<div class="container">


			

		<section>
			<div class="row">
				<div class="col-md-8">

					<!-- article -->
                @yield('content_test')
					<!-- article -->

				</div>
				<div class="col-md-4 sidebar-gutter">
					<aside>
					<!-- sidebar-widget -->
					<div class="sidebar-widget">
						<h3 class="sidebar-title">About Me</h3>
						<div class="widget-container widget-about">
							<a href="post.html"><img src="images/author.jpg" alt=""></a>
							<h4>Jamie Mooz</h4>
							<div class="author-title">Designer</div>
							<p>While everyone’s eyes are glued to the runway, it’s hard to ignore that there are major fashion moments on the front row too.</p>
						</div>
					</div>
					<!-- sidebar-widget -->
					<div class="sidebar-widget">
						<h3 class="sidebar-title">Featured Posts</h3>
						<div class="widget-container">
                            <?php
                            use Illuminate\Support\Facades\DB;
                            $recent_blog = DB::table('blogs')
                                            ->orderBy('blog_id')
                                            ->limit(5)
                                            ->get();
                            ?>
                            @foreach($recent_blog as $v_blog)
							<article class="widget-post">
								<div class="post-image">
									<a href="post.html"><img src="images/90x60-1.jpg" alt=""></a>
								</div>
								<div class="post-body">
									<h2><a href="{{ URL::to('/blog-details/'.$v_blog->blog_id) }}">{{$v_blog->blog_title}}</a></h2>
									<div class="post-meta">
										<span><i class="fa fa-clock-o"></i> {{ $v_blog->created_at }}</span> <span><a href="post.html">
                                                                                        <i class="fa fa-comment-o"></i>
                                                      
                                                                                    </a></span>
									</div>
								</div>
							</article>
                                @endforeach

						</div>
					</div>
                        <div class="sidebar-widget">
                            <h3 class="sidebar-title">Popular Posts</h3>
                            <div class="widget-container">
                                <?php

                                $popular_blog = DB::table('blogs')
                                    ->where('publication_status',1)
                                    ->orderBy('hit_counter','desc')
                                    ->limit(5)
                                    ->get();
                                ?>
                                @foreach($popular_blog as $v_blog)
                                    <article class="widget-post">
                                        <div class="post-image">
                                            <a href="post.html"><img src="images/90x60-1.jpg" alt=""></a>
                                        </div>
                                        <div class="post-body">
                                            <h2><a href="{{ URL::to('/blog-details/'.$v_blog->blog_id) }}">{{$v_blog->blog_title}}</a>&nbsp;&nbsp;({{$v_blog->hit_counter}})</h2>
                                            <div class="post-meta">
                                                <span><i class="fa fa-clock-o"></i> {{ $v_blog->created_at }}</span> 
                                                <span><a href="post.html">
                                                        <i class="fa fa-comment-o"></i>
              
                                                        <span style="display: inline-block; color: black; margin-left: 4px;">
                                                              <?php 
                                                         echo DB::table('comments')
                                                                  ->where('blog_id',$v_blog->blog_id)
                                                                  ->count();
                                                          ?></span>
                                                    </a>
                                                </span>
                                            </div>
                                        </div>
                                    </article>
                                @endforeach

                            </div>
                        </div>
					<!-- sidebar-widget -->
					<div class="sidebar-widget">
						<h3 class="sidebar-title">Socials</h3>
						<div class="widget-container">
							<div class="widget-socials">
								<a href="#"><i class="fa fa-facebook"></i></a>
								<a href="#"><i class="fa fa-twitter"></i></a>
								<a href="#"><i class="fa fa-instagram"></i></a>
								<a href="#"><i class="fa fa-google-plus"></i></a>
								<a href="#"><i class="fa fa-dribbble"></i></a>
								<a href="#"><i class="fa fa-reddit"></i></a>
							</div>
						</div>
					</div>
					<!-- sidebar-widget -->
					<div class="sidebar-widget">
						<h3 class="sidebar-title">Categories</h3>
						<div class="widget-container">
                            <?php
                               $all_category_info = DB::table('category')
                                                    ->where('publication_status',1)
                                                     ->get();
                            ?>
							<ul style="list-style-type: none;">
                                @foreach($all_category_info as $vcategory)
								<li style="display:block;"><a href="{{ URL::to('/category-blog/'.$vcategory->category_id) }}">{{$vcategory->category_name}}</a></li>
                                    @endforeach
							</ul>
						</div>
					</div>
					</div>
					</aside>
				</div>
			</div>
		</section>
		</div><!-- /.container -->

		<footer class="footer">

			<div class="footer-socials">
				<a href="#"><i class="fa fa-facebook"></i></a>
				<a href="#"><i class="fa fa-twitter"></i></a>
				<a href="#"><i class="fa fa-instagram"></i></a>
				<a href="#"><i class="fa fa-google-plus"></i></a>
				<a href="#"><i class="fa fa-dribbble"></i></a>
				<a href="#"><i class="fa fa-reddit"></i></a>
			</div>

			<div class="footer-bottom">
				<i class="fa fa-copyright"></i> Copyright 2015. All rights reserved.<br>
				Theme made by <a href="http://www.moozthemes.com">MOOZ Themes</a>
			</div>
		</footer>

		<!-- Bootstrap core JavaScript
			================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="{{asset("https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js")}}"></script>
		<script src="{{asset("public/js/bootstrap.min.js")}}"></script>
		<script src="{{asset("public/js/jquery.bxslider.js")}}"></script>
		<script src="{{asset("public/js/mooz.scripts.min.js")}}"></script>
                <script src='{{asset('public/js/app.js')}}'></script>

	</body>
</html>
