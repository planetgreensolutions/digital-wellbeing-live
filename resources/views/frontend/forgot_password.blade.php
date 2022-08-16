@extends('frontend.layouts.master') 
@section('metatags')
	<meta name="description" content="{{{@$websiteSettings->site_meta_description}}}" />
	<meta name="keywords" content="{{{@$websiteSettings->site_meta_keyword}}}" />
	<meta name="author" content="{{{@$websiteSettings->site_meta_title}}}" /> 
@stop 
@section('seoPageTitle')
	<title>
		{{ $page_title }}
	</title>
@stop 
@section('styles')
@parent
@stop
@section('content')
@include('frontend.common.inner_banner')
	
	<section class="page-section login_box small-center-box">
	  <div class="container">
		<div class="section-block rowfadeUpBlock">
		  <div class="section-content forget_password_wrapper">
			<h3 class="sub-title text-colo-brand text-center">
			  <span>{{ lang('forgot_password') }}</span>
			</h3>
			<div class="form_box">
			  <div class="_block">
				<div id="userMessages"></div>
				@include('frontend.forms.forgot_password_form')
			  </div>
			</div>
		  </div>
		</div>
	  </div>
	</section>
@stop
@section('scripts')
@parent
<script type="text/javascript" src="{{asset('assets/frontend/dist/scripts/vendor/general/jquery.validate.min.js')}}"></script>
<script type="text/javascript">
window.addEventListener('beforeunload', function(event) {
	document.body.scrollTop = 0; 
	document.documentElement.scrollTop = 0;   
}); 

$(document).ready(function(e) {
	$('body').addClass('__login_ar');
	
	$('#forgotForm').validate({
		'rules':{
			'forgot_email' : {'required':true,'myemail':true},
		
		},
		'messages':{
			'forgot_email' : {'required':'{{ lang("field_required") }}','myemail':'{{ lang("invalid_email")}}' },
		
		},
		submitHandler: function(form) {
			$('#ajaxLoader').show();
			$_form = $('#forgotForm');
			var _url = $_form.attr('action');
			var _data = $_form.serializeArray();
			sendAjax(_url,'POST',_data,function(responseData){
				$('#ajaxLoader').hide();
				grecaptcha.reset();
				
				if(responseData.errorMessage){
					$('#userMessages').addClass('message_box').addClass('error_message').html(responseData.errorMessage).show();
				}
				if(responseData.successMessage){
					console.log(responseData.successMessage);
					$('#userMessages').addClass('message_box').addClass('success_message').html(responseData.successMessage).show();
				}
				
				if(responseData.status){
					$('#forgot_email').val('');
				}
				
				$('#userMessages').show();
				/* if(responseData.status){
					$_form[0].reset();
					setTimeout(function(){
						window.location.href="{{ route('home',[$lang]) }}";
					},3000);
				} */
				setTimeout(function(){
					$('#userMessages').hide();
				},10000);
			},'#ajaxLoader');
			return false;
		}
	});
	
	$('.submit').on('click',function(e){
		$('#forgotForm').submit();
		e.preventDefault();
	});
});

</script>
@stop