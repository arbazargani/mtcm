<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge" />
		<meta name="Development" content="Alireza Bazargani." />
		<meta name="author" content="Alireza Bazargani" />

		@yield('meta')

		<link rel="stylesheet" href="{{ asset('assets/css/uikit-rtl.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" />
		<link rel="canonical" href="{{ urldecode(url()->current()) }}" />
		<script src="{{ asset('assets/js/uikit.min.js') }}"></script>
		<script src="{{ asset('assets/js/uikit-icons.min.js') }}"></script>

		<style media="screen">
		@media screen and (max-width: 479px) {
			/* start of phone styles */
			h1 {
				font-size: 24px!important;
			}
			h2 {
				font-size: 20px!important;
			}
			h3 {
				font-size: 16px!important;
			}
			h4 {
				font-size: 16px!important;
			}
		}
		</style>
</head>
<body class="uk-background-muted" id="top">
	<div class="uk-section-primary uk-preserve-color">
		<div uk-sticky="animation: uk-animation-slide-top; sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky; cls-inactive: uk-navbar-transparent uk-light; top: 200">
			@include('public.template-parts.header')
		</div>
		</div>
		
		<div style="padding: 1% 5% 1% 5%;" uk-grid>
			<!-- main -->
			<div class="uk-width-2-3@m">
				@yield('content')
			</div>
			<!-- main -->

			<!-- sidebar -->
			<div class="uk-width-expand@m">
			 @include('public.template-parts.sidebar')
			</div>
			<!-- sidebar -->
		</div>
		
		<div class="uk-position-small uk-padding-remove uk-position-fixed uk-position-bottom-right" id="top-btn-wrapper">
			<a href="#top" id="top-btn" uk-totop uk-scroll></a>
		</div>
		<script>
			//Get the button:
			mybutton = document.getElementById("top-btn-wrapper");

			// When the user scrolls down 20px from the top of the document, show the button
			window.onscroll = function() {scrollFunction()};

			function scrollFunction() {
			if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
				mybutton.style.display = "block";
			} else {
				mybutton.style.display = "none";
			}
			}

			// When the user clicks on the button, scroll to the top of the document
			function topFunction() {
			document.body.scrollTop = 0; // For Safari
			document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
			}
		</script>
		
		@include('public.template-parts.footer')
		@include('public.template-parts.scripts')
</body>
</html>
