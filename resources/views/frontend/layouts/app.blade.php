<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    @if (!empty($meta_title))
    <title>{{$meta_title}}</title>
    @else
    <title>EX-Commerce online shop</title>
    @endif
    @if (!empty($meta_description))
	<meta name="description" content="{{$meta_description}}">
    @else
	<meta name="description" content="Lorem quamconsectetur, natus consequuntur quaerat iusto ab fugit sit maxime commodi alias atque!">
    @endif
    @if (!empty($meta_keywords))
	<meta name="meta_keywords" content="{{$meta_keywords}}">
    @else
	<meta name="meta_keywords" content="Lorem quamconsectetur, natus consequuntur quaerat iusto ab fugit sit maxime commodi alias atque!">
    @endif
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- Front style -->
	<link id="callCss" rel="stylesheet" href="{{asset('assets/frontend/css/front.min.css')}}" media="screen"/>
	<link href="{{asset('assets/frontend/css/base.css')}}" rel="stylesheet" media="screen"/>
	<!-- Front style responsive -->
	<link href="{{asset('assets/frontend/css/front-responsive.min.css')}}" rel="stylesheet"/>
	<link href="{{asset('assets/frontend/css/font-awesome.css')}}" rel="stylesheet" type="text/css">
	<!-- Google-code-prettify -->
	<link href="{{asset('assets/frontend/js/google-code-prettify/prettify.css')}}" rel="stylesheet"/>
	<!-- fav and touch icons -->
	<link rel="shortcut icon" href="{{asset('assets/frontend/images/ico/favicon.ico')}}">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('assets/frontend/images/ico/apple-touch-icon-144-precomposed.png')}}">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('assets/frontend/images/ico/apple-touch-icon-114-precomposed.png')}}">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('assets/frontend/images/ico/apple-touch-icon-72-precomposed.png')}}">
	<link rel="apple-touch-icon-precomposed" href="{{asset('assets/frontend/images/ico/apple-touch-icon-57-precomposed.png')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
	<style type="text/css" id="enject"></style>
	@stack('css')
    <style>
        form.cmxform label.error ,label.error{
            color: red;
        }
    </style>
</head>
<body>
    @include('frontend.layouts.header')
<!-- Header End====================================================================== -->

@include('frontend.layouts.carousel')
<!-- Footer ================================================================== -->
<div id="mainBody">
	<div class="container">
		<div class="row">
            <!-- Sidebar ================================================== -->
            @include('frontend.layouts.sidebar')
            <!-- Sidebar end=============================================== -->
            @yield('content')
		</div>
	</div>
</div>

@include('frontend.layouts.footer')
<!-- Placed at the end of the document so the pages load faster ============================================= -->
<script src="{{asset('assets/frontend/js/jquery.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/frontend/js/jquery.validate.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/frontend/js/front.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/frontend/js/google-code-prettify/prettify.js')}}"></script>

<script src="{{asset('assets/frontend/js/front.js')}}"></script>
<script src="{{asset('assets/frontend/js/front_script.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/frontend/js/jquery.lightbox-0.5.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

@include('sweetalert::alert')


</body>
</html>
