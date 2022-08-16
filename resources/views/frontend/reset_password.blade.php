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
<section class="page-section login_box small-center-box">
  <div class="container">
	<div class="section-block rowfadeUpBlock">
	  <div class="section-content forget_password_wrapper">
		<h3 class="sub-title text-colo-brand text-center">
		  <span>{{ lang('reset_password') }}</span>
		</h3>
		<div class="form_box">
		  <div class="_block">
			<div id="message" class="message_box"></div>
			@include('frontend.forms.reset_password_form')
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
	
	$('#resetForm').validate({
		'rules':{
			'password' : {'required':true},
			'password_confirmation' : { equalTo: "#password"},
			
		},
		'messages':{
			'password' : {'required':'{{ lang("field_required") }}'},
			'password_confirmation' : {'required':'{{ lang("field_required") }}','equalTo':'{{ lang("password_mismatch") }}'},
		
		},
		submitHandler: function(form) {
			$('#ajaxLoader').show();
			$_form = $('#resetForm');
			var _url = $_form.attr('action');
			var _data = $_form.serializeArray();

			sendAjax(_url,'POST',_data,function(responseData){
				$('#ajaxLoader').hide();
				grecaptcha.reset();
				
				$('#message').removeClass('error_message').removeClass('success_message').removeClass('warning_message').removeClass('info_message');
				
				$('#message').addClass(responseData.type+'_message');
				
				$('#message').html('<p>'+responseData.message+'</p>');
				
				if(responseData.status){
					$('#message').html('<p>'+responseData.message+'</p>').show();
					$_form[0].reset();
					 setTimeout(function(){
						window.location.href="{{ route('frontend_login',[$lang]) }}";
					},3000); 
				}else{
					$('#message').addClass('message_box').addClass('error_message').html(responseData.errorMessage).show();
				}
				 setTimeout(function(){
					$('#message').hide();
				},10000); 
			},'#ajaxLoader');
			return false;
		}
	});
	
	$('.submit').on('click',function(e){
		$('#resetForm').submit();
		e.preventDefault();
	});
});

</script>
@stop