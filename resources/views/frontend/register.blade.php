<?php 
		$mainLogo = (($lang=='en')?@$websiteSettings->sitelogo_english:@$websiteSettings->sitelogo_arabic);
		$subLogo = (($lang=='en')?@$websiteSettings->sublogo_english:@$websiteSettings->sublogo_arabic);
		$changeLang = ($lang=='ar')?'en':'ar';
?>
@extends('frontend.layouts.master') 
@section('metatags')
	<meta name="description" content="{{{@$websiteSettings->site_meta_description}}}" />
	<meta name="keywords" content="{{{@$websiteSettings->site_meta_keyword}}}" />
	<meta name="author" content="{{{@$websiteSettings->site_meta_title}}}" /> 
@stop 
@section('seoPageTitle')
	<title>
		{{ $pageTitle }}
	</title>
@stop 
@section('styles')
<link rel="stylesheet" href="{{ asset('assets/frontend/selectric/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/frontend/dist/flagcss/custom_flag.css') }}"> <?php /**/ ?>
@parent

@stop

@section('content')
<div class="award_bg">
    <div class="img_" style="background-image: url({{ asset('assets/frontend/dist/images/award.png') }})"></div>
  </div>
   @include('frontend.common.inner_banner')
  <section class="page-section ">
    <div class="container">     
      <div class="section-block rowfadeUpBlock">
        <div class="section-content">
          <h3 class="sub-title text-colo-brand text-center" >
            <span>{{ lang('registration') }}</span>
          </h3>
          <div class="form_box">
				@include('frontend.forms.register_form')
				@include('frontend.common.form_loader')        
          </div>
        </div>
      </div>
    </div>
  </section>
@stop
@section('scripts')
@parent
<script src="{{ asset('assets/frontend/selectric/js/select2.min.js') }}"></script>
<script>
	
	function customTemplateFlags(entry){
		var iso = $(entry.element).attr('data-iso');		
		return $('<div class="customCountryFlagWrapper"><div class="iti__flag iti__'+iso+'"></div><div class="iti__ccode">'+entry.id+'</div></div>');
	}
	
	$(document).ready(function () {   
		$('body').addClass('black_body');
		$('.select').formSelect();
		
		$("#country_code").select2({
			templateResult: customTemplateFlags
		});
		$('#country_code').on('change', function (e) {
		  $('#mobile_number').focus();
		});
		
		$('#registerForm').validate({
			rules:{
				
				'fname':{
					required:true,
					alphanumeric:true,
				},
				'lname':{
					required:true,
					alphanumeric:true,
				},				
				'email':{
					required:true,
					email:true
				},				
				'password':{
					required:true,
				},
				'entity_name':{
					required:true,
					freetext:true,
				},
				'country':{
					required:true,
					min:1
				},				
				'country_code':{
					required:true,
				},
				'mobile_number':{
					required:true,
				}				
			},
			messages:{
				'fname':{
					required:"{{ lang('field_required') }}",
					alphanumeric:"{{ lang('enter_no_special_char') }}"
				},
				'lname':{
				   required:"{{ lang('field_required') }}",
				   alphanumeric:"{{ lang('enter_no_special_char') }}"
				},
				/* 'username':{
					required:"{{ lang('field_required') }}"
				}, */
				
				'password':{
					required:"{{ lang('field_required') }}"
				},
				'entity_name':{
					required:"{{ lang('field_required') }}"
				},
				'country':{
					required:"{{ lang('field_required') }}",
					min:"{{ lang('field_required') }}"
				},	
				'email':{
					required:"{{ lang('field_required') }}",
					email:'الرجاء إدخال البريد الإلكتروني الصحيح'
				},
				'mobile_number':{
					required:"{{ lang('field_required') }}"
				}
				
			},
			submitHandler: function(form) {
				$('#register_errors').hide();
				$('#register_errors').html('');
				sendAjax("{{ asset($lang.'/register') }}",'post',$(form).serializeArray(),function(responseData){
					$('#register_errors').html(responseData.message);
					$('#register_errors').show();
					// resetRecaptcha();
					if(responseData.status){
						$('#registerForm')[0].reset();
						$('#signupForm').hide();
						$('#register_errors').hide();
						$('#registerSuccess').show();
						$(form).find('.message_box').addClass('success_message');
						$(form).find('.message_box').html(responseData.message);
						setTimeout(function(){ window.location = "<?php echo asset($lang.'/arab-government-excellence-award-categories'); ?>"; }, 3000);
					}else{
						$(form).find('.message_box').addClass('error_message');
						$(form).find('.message_box').html(responseData.message);
					}
					
				},'.aj_loader');
				return false;
			}
		})
	});
</script>
@stop