<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>March Edukit online Shopping cart</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	
	<!-- Front style -->
	<link id="callCss" rel="stylesheet" href="{{ url('frontend/css/front.min.css') }}" media="screen"/>
	<link href="{{ url('frontend/css/base.css') }}" rel="stylesheet" media="screen"/>
	<!-- Front style responsive -->
	<link href="{{ url('frontend/css/front-responsive.min.css') }}" rel="stylesheet"/>
	<link href="{{ url('frontend/css/font-awesome.css') }}" rel="stylesheet" type="text/css">
	<!-- Google-code-prettify -->
	<link href="{{ url('frontend/js/google-code-prettify/prettify.css') }}" rel="stylesheet"/>
	<!-- fav and touch icons -->
	<link rel="shortcut icon" href="{{ url('frontend/images/ico/favicon.ico') }}">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ url('frontend/images/ico/apple-touch-icon-144-precomposed.png') }}">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ url('frontendimages/ico/apple-touch-icon-114-precomposed.png') }}/">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ url('frontend/images/ico/apple-touch-icon-72-precomposed.png') }}">
	<link rel="apple-touch-icon-precomposed" href="{{ url('frontend/images/ico/apple-touch-icon-57-precomposed.png') }}">
	<style type="text/css" id="enject"></style>
</head>
<body>
@include('frontend.layouts.front_header')
<!-- Header End====================================================================== -->
@if (isset($pageName) && $pageName=="index")
<div id="carouselBlk">
	<div id="myCarousel" class="carousel slide">
		<div class="carousel-inner">
			<div class="item active">
				<div class="container">
					<a href="javascript:void(0)"><img style="width:100%" src="frontend/images/carousel/1.png" alt="special offers"/></a>
					<div class="carousel-caption">
						<h4>First Thumbnail label</h4>
						<p>Banner text</p>
					</div>
				</div>
			</div>
			<div class="item">
				<div class="container">
					<a href="register.html"><img style="width:100%" src="frontend/images/carousel/2.png" alt=""/></a>
					<div class="carousel-caption">
						<h4>Second Thumbnail label</h4>
						<p>Banner text</p>
					</div>
				</div>
			</div>
			<div class="item">
				<div class="container">
					<a href="register.html"><img src="frontend/images/carousel/3.png" alt=""/></a>
					<div class="carousel-caption">
						<h4>Third Thumbnail label</h4>
						<p>Banner text</p>
					</div>
					
				</div>
			</div>
		</div>
		<a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
	</div>
</div>
@endif

<div id="mainBody">
	<div class="container">
		<div class="row">
            <!-- Sidebar ================================================== -->
            @include('frontend.layouts.front_sidebar')
			<!-- Sidebar end=============================================== -->
			@yield('content')
		</div>
	</div>
</div>
<!-- Footer ================================================================== -->
@include('frontend.layouts.front_footer')
<!-- Placed at the end of the document so the pages load faster ============================================= -->
<script src="{{ url('frontend/js/jquery.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/js/front.min.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/js/google-code-prettify/prettify.js') }}"></script>

<script src="{{ url('frontend/js/front.js') }}"></script>
<script src="{{ url('frontend/js/jquery.lightbox-0.5.js') }}"></script>

</body>
</html>