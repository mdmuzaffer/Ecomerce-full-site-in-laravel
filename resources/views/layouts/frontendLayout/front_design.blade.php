<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="">
    <title>@if(!empty($meta_title)){{$meta_title}}@else Home | E-Shopper @endif</title>
	@if(!empty($meta_description))<meta name="description" content="{{$meta_description}}">
@endif
	@if(!empty($meta_keywords))<meta name="meta_keywords" content="{{$meta_keywords}}">
@endif
    <link href="{{asset('frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('frontend/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('frontend/css/responsive.css')}}" rel="stylesheet">
	<link href="{{asset('frontend/css/easyzoom.css')}}" rel="stylesheet">
	<link href="{{asset('frontend/css/developer.css')}}" rel="stylesheet">
	<!-- -->
	<link href="{{asset('frontend/validate/cmx.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
<!--Header section layout start-->
@include('layouts.frontendLayout.front_header');
<!--Header section layout end -->

<!--Content section start -->
@yield('content')
<!--Content section start end -->

<!--Footer section start -->
@include('layouts.frontendLayout.front_footer');
<!--Footer section end -->

    <script src="{{asset('frontend/js/jquery.js')}}"></script>
	<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('frontend/js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{asset('frontend/js/price-range.js')}}"></script>
    <script src="{{asset('frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('frontend/js/main.js')}}"></script>
    <script src="{{asset('frontend/js/easyzoom.js')}}"></script>
	<!-- jquery for validation -->
    <script src="{{asset('frontend/validate/jquery.validation.js')}}"></script>
	<!-- Js loading according page define in controller -->
	@if(isset($page_type) && $page_type =='front')
	<script src="{{asset('frontend/developer/developer_front.js')}}"></script>
	@endif
	
	<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5d0141f926636163"></script>

	
	
	</body>
</html>