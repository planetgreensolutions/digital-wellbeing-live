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
		  <span>{{ lang('change_password') }}</span>
		</h3>
		<div class="form_box">
		  <div class="_block">
			<div id="userMessages"></div>
			@include('frontend.forms.change_password_form')
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
	
	$('#change_password').validate({
		'rules':{
			// 'old_password' : {'required':true},
			'password' : {'required':true},
			'password_confirmation' : { equalTo: "#password"},
			
		},
		'messages':{
			// 'old_password' : {'required':'{{ lang("field_required") }}'},
			'password' : {'required':'{{ lang("field_required") }}'},
			'password_confirmation' : {'required':'{{ lang("field_required") }}','equalTo':'{{ lang("password_mismatch") }}'},
		
		},
		submitHandler: function(form) {
			$('#ajaxLoader').show();
			$_form = $('#change_password');
			var _url = $_form.attr('action');
			var _data = $_form.serializeArray();

			sendAjax(_url,'POST',_data,function(responseData){
				$('#ajaxLoader').hide();
				
				
				
				/* Swal.fire({							
					text: responseData.message,
					type: responseData.type,
					confirmButtonText: okLang,
				}); */
				
				$('#message').removeClass('error_message').removeClass('success_message').removeClass('warning_message').removeClass('info_message');
				
				$('#message').addClass(responseData.type+'_message');
				
				$('#message').html('<p>'+responseData.message+'</p>');
				
				if(responseData.status && responseData.type == 'success'){
					$_form[0].reset();
				}
				
			},'#ajaxLoader');
			return false;
		}
	});	
	
});

</script>
@stop