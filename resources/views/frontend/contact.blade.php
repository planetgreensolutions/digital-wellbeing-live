@extends('frontend.layouts.master') 
@section('metatags')
	<meta name="description" content="{{{@$websiteSettings->site_meta_description}}}" />
	<meta name="keywords" content="{{{@$websiteSettings->site_meta_keyword}}}" />
	<meta name="author" content="{{{@$websiteSettings->site_meta_title}}}" /> 
@stop 
@section('seoPageTitle')
	<title>
		<?php $title = ($lang == 'en') ? @$websiteSettings->sitename : @$websiteSettings->sitename_arabic; ?>
		{{ (!empty($pageTitle))? $pageTitle : @$title }}
	</title>
@stop 

@section('styles')
 @include('frontend.layouts.inner_cssfile')	 
@stop

@section('content')

<main class="page ">
   

   <section class="page-section contact-section"> 
      <div class="container">
		<div class="breadCrumbWrap ">
			<ol class="breadcrumb">
				<li><a href="{{ asset('/')}}" class="homebrc">{{lang('home')}}</a></li>            			 
				<li class="current">{{lang('contact_us')}}</li>
			</ol>
		</div>
        <div class="contact_wrapper">
           <div class="title_box text-center">
            <h1 class="section-title txt-up" >
                <div class="title_wr">
                  <span>{{lang('contact_us')}}</span>
                </div>
            </h1>
          </div>

          <div class="contact_form_wrap">
            <div class="shape_ fill_blue">
                <svg x="0px" y="0px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve"
                  preserveAspectRatio="none">
                  <polygon points="30,30 0,30 0,0 27.447,4.787 " />
                </svg>
              </div>

              <div class="logo_bg">
                <img class="img_auto b-lazy" data-src="{{getFrontendAsset('images/logo.svg')}}" />
              </div>
              <div class="img_box">
                  <div class="img_ b-lazy" data-src="{{getFrontendAsset('images/contact_bg.jpg')}}"></div> 
              </div>

              <div class="form_box">
                
                  {{Form::open(array('url'=>route('contact',[$lang]),'name'=>'contact-form','id'=>'contact-form','role'=>'form','class'=>'form-v3 ') )}}
                    <div class="input_box">
                        <div class="col_box full_wd">
                          <div class="input-field ">
                            <input id="name"  name="name" type="text" class="">
                            <label for="name">{{lang('name')}} <em>*</em></label>
                          </div>
                        </div>
                        <div class="col_box full_wd">
                          <div class="input-field ">
                            <input  id="email" name="email" type="email" class="">
                            <label for="email">{{lang('email')}} <em>*</em></label>
                          </div>
                        </div>

                        <div class="col_box full_wd">
                          <div class="input-field ">
                            <input id="phone_number" name="phone_number" type="text" class="phone_number">
                            <label for="phone_number">{{lang('phone_number')}} <em>*</em></label>
                          </div>
                        </div>
						
						
						 <div class="col_box full_wd">
                         	<div class="input-field ">
                         		<label for="subject" class="normal_">{{lang('subject')}}<em>*</em></label>
								<select name="subject" id="subject">
									<option value="General Inquiry">{{lang('general_inquiry')}}</option>
									<option value="Media Inquiry">{{lang('media_inquiry')}}</option>
									<option value="Parnter Inquiry">{{lang('partner_inquiry')}}</option>
								</select>
                         	</div>
						  	
                            
                          
                        </div>
						
						
                         <div class="col_box full_wd">
                          <div class="input-field ">
                            <textarea id="message" name="message" class="materialize-textarea" maxlength="900"></textarea>
                            <label for="message">{{lang('message')}}<em>*</em></label>
                          </div>
                        </div>


                    </div>

                    <div class="submit-wrap">
                      <div class="capcha_wrap">
                         <div class="recaptcha" id="contactCaptcha"></div>
						<input type="hidden" class="hiddenCaptcha" name="hiddenRecaptcha" >
                      </div>
                        <button class="more" type="submit" > 
                            <div class="line_box">
                              <span></span>
                              <span></span>
                            </div>
                            <span class="text_">{{lang('submit')}}</span>
                        </button>
                    </div>
					<div class="loader_box">
						  <div class="loader_wrapper">
							<div class="circle bot" ></div>
							<div class="circle mid" ></div>
							<div class="circle top" ></div>
						  </div>
					  </div>
                  {{ Form::close() }}
              </div>
          </div>
        </div>
        
      </div>
   </section>
</main>

@stop
@section('scripts')
@parent
@include('frontend.script.inner_page_script')
@include('frontend.script.validation_script')
<script>

	$(function() {
		// select box init
		$('select').formSelect();
	});

$('#contact-form').validate({
		
	ignore: ':hidden:not(.hiddenCaptcha)',
	rules: {  
		"hiddenRecaptcha": {
			
			required: function () {
			var gotResponse = haveRecaptchaResponse('contactCaptcha');
			
			if(!gotResponse){
			$('#contactCaptcha').find('iframe').addClass('error-border');
			}else{
			$('#contactCaptcha').find('iframe').removeClass('error-border');
			}
			return !gotResponse; 
			}
		}, 
		'name':{
			required:true,
			alphanumeric:true,
			noSpace:true
		},
		'subject':{
			required:true,
			alphanumeric:true
		},
		'email':{
			required:true,
			email:true,
			myEmail:true,
		},
		'phone_number':{
			required:true,
			minlength:9
		},
							
		'message':{
			alphanumericMessageBox:true,
			noSpace:true,
			required:true
		}
	},


	submitHandler: function(form) {
		
		var _url = $(form).attr('action');
		var _data = $(form).serializeArray();
		$('.loader_box').addClass('show');
		sendAjax(_url,'post',_data, function(responseData){
		   
		    resetRecaptcha();
			if(!responseData.status){
				Swal.fire({
				 type: 'error',
				 text: responseData.message,
				 confirmButtonText: "{{ lang('ok') }}",
				})
			}else{
				$(form)[0].reset();
				Swal.fire({
					 type: 'success',
					 text: responseData.message,
					 confirmButtonText: "{{ lang('ok') }}",
				});
				
				
			}
			$('.loader_box').removeClass('show');
			
		},'#contact-loader');
		return false;
	},
	messages: {            
		"hiddenRecaptcha" : {
			required : "{{ Lang::get('messages.field_required') }}",
			
		}, 
		"email" : {
			 required : "{{ Lang::get('messages.field_required') }}",
			 email:"{{ Lang::get('messages.invalid_email') }}"
		}, 
		"phone_number" : {
			required : "{{ Lang::get('messages.field_required') }}",
			minlength:"{{ Lang::get('messages.mob_no_min_length') }}",
		}, 
		"message" : {
			required : "{{ Lang::get('messages.field_required') }}",
			
		}, 
		
	} 

}); 

</script>

@stop

