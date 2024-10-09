<!DOCTYPE html>
<html lang="{{ @$lang }}" dir="{{ (@$lang=='ar')?'rtl':'ltr' }}" class="{{ (@$lang=='ar')?'rtl':'ltr' }}">
<head>
	
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	@section('seoPageTitle')
		<title>{{ (!empty($pageTitle))?trim($pageTitle):trim(@$seoPageTitle)  }}</title>
	@show
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1, user-scalable=no, maximum-scale=1.0">
	<link rel="preload" href="{{getFrontendAsset('images/logo.svg')}}" as="image">
    <link rel="shortcut icon" href="{{getFrontendAsset('images/favicon.ico')}}">
	@section('metatags')
    <meta name="description" content="{{{@$websiteSettings->site_meta_description}}}" />
	<meta name="keywords" content="{{{@$websiteSettings->site_meta_keyword}}}" />
	<meta name="author" content="{{{@$websiteSettings->site_meta_title}}}" /> 
    
	@show

	@if(config('app.env') == "production" && !empty(config('app.google_analytics')))
		<!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('app.google_analytics') }}">
        </script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', '{{ config('app.google_analytics') }}');
        </script>
	@endif

	@section('styles')
		@include('frontend.layouts.cssfiles')
	@show

	<script>
		
		window._token = {!! json_encode([
			'csrfToken' => csrf_token(),
		]) !!};
		window.baseURL = "{{ asset('/') }}";
		window.isMobile = {{ (Agent::isMobile() === true ) ? 'true' : 'false' }};
		window.siteLang = "{{ trim($lang) }}";
		window.request = "{{ asset('/'.$lang) }}/";
		var recaptcha = [];
		var recaptchaArr = [];
		var saveLang = "{{ lang('saving') }}";
		var saveDraftLang = "{{ lang('saving_draft') }}";
		var maxUploadLimitReached = "{{ lang('max_upload_limit_reached') }}";
		var fileSizeExceededLang = "{{ lang('file_size_exceeded') }}";
		var invalidFileFormatLang = "{{ lang('invalid_file_format') }}";
		var okLang = "{{ lang('ok') }}";
		function resetRecaptcha(){
			$(recaptchaArr).each(function(i,v){
			   grecaptcha.reset(v.obj);
			});
		}
		
		function haveRecaptchaResponse(elemID){
			var hasResponse = false;
			
			$(recaptchaArr).each(function(i,v){
			   if(v.ID == elemID){
					if(grecaptcha.getResponse(v.obj) != ''){
						hasResponse = true;
					}
			   }
			});
			return hasResponse;
		}
		
    </script>
</head>
<body  class="{{ @$lang }} {{ (!empty($isHomePage) ? ' home__page __index ' :' inner__page ') }} {{ (!empty($bodyClass))? $bodyClass:''}}" >
 <!--[if lt IE 8]>
	<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
	@include('frontend.layouts.preloader')
	@include('frontend.layouts.topnav')
    @include('frontend.layouts.social')
	@yield('content')	
	
	@include('frontend.layouts.footer')
	
	@section('scripts')
		@include('frontend.layouts.jsfiles')
	@show
	<script>
</script>
</body>
</html>