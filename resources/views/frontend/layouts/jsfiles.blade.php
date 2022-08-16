<script src="{{ asset('assets/frontend/dist/scripts/lib/modernizr.min.js') }}"></script>  
<script src="{{ asset('assets/frontend/dist/scripts/lib/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('assets/frontend/dist/scripts/lib/jquery-migrate-3.0.1.min.js') }}"></script>

<script src="{{ asset('assets/frontend/validator/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src='https://www.google.com/recaptcha/api.js?onload=myCaptchaCallBack&render=explicit&hl={{$lang}}' async defer></script>
<?php /* <script src="{{ asset('assets/frontend/dist/scripts/min/page_plugins.js') }}"></script>
<script src="{{ asset('assets/frontend/dist/scripts/min/page.js') }}"></script> 

<script src="{{ asset('assets/frontend/dist/plupload/plupload.full.min.js') }}"></script>

<script src="{{ asset('assets/frontend/dist/customUploader.js?456') }}"></script>
<script src="{{ asset('assets/frontend/sweetalert2/sweetalert2.min.js') }}"></script> */ ?>
<script src="{{ asset('assets/frontend/bound/bounds.js') }}"></script> 

{{-- <script id="happiness-meter-widget-web-script"
async
src="{{getFrontendAsset('scripts/external/web.js')}}"
data-container-id="happiness-meter-widget-container"
data-language="en"
data-key="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6ODZ9.jfiUNw7230FngueDpqe73bfa34.hayeGTSB7103mfnay"
data-on-finish=""
data-entity-sequence-id="391"
data-customer-id="0"
data-email="happinessmeter@happinessmeter.gov.ae"
data-phone="+971000000000"
data-transaction-id="0"
data-emirates-id="0"
data-version="latest"
data-delay="0"
data-mode="click"
data-mode-click-id="happiness-meter-widget-button"
data-css-url="https://happinessmeter.gov.ae/webwidget/web.css"></script> --}}

<script type="text/javascript">


	var myCaptchaCallBack = function() { 
      $('.recaptcha').each(function(){
        var id = $(this).attr('id');
            if(id){
                var tmp = grecaptcha.render( $(this).attr('id'), {
                  'sitekey' : '{{ Config::get('captcha.sitekey') }}',
                  'theme' : 'light',
                  'lang':'en'
                });
                recaptchaArr.push({ID:$(this).attr('id'),obj:tmp});
            }
      })
        
    };  

 $(document).ready(function(){

	$("header .navbar .nav-item .arrow-submenu").on( "click",   function() {
		$(this).siblings(".dropdown-menu").toggleClass("active-menu");
  //console.log( $(this).closest(".dropdown-menu") );
}); 
	
	
	//jQuery.validator.setDefaults({ 
	//	 ignore:''
//	});

	// $('.phone').mask('0000000000000000');
	@if(!empty($errorMessage))
		Swal.fire({
			text: "{{ $errorMessage }}",
			type: 'error',
			confirmButtonText: '{{ lang("ok")}}',
		});
	@endif
	$.validator.addMethod( "isvalidfile", function( value, element ) {
		var _isValidFile = true,
		_name = $(element).attr('name'),
		_isMultiple = ($('[name="'+_name+'_upload[]"]').length > 0)?true:false; 
		
				
		if(!_isMultiple && !$('#'+_name+'_file').val()){
			_isValidFile = false;
		}
		
		return _isValidFile;	
		
	}, "{{ trans('messages.field_required')}}"  );
	
	
	$.validator.addMethod( "isvaliddate", function( value, element ) {
		
		var dateObj = moment(value);
		if(!dateObj) return false;
		return dateObj.isValid();
	}, "{{ trans('messages.fill_atleast_one')}}"  );
	
	$.validator.addMethod( "isvalidindicator", function( value, element ) {
		var valid = false, inputEntered = false;
		$('[name="indicator[title][]"]').each(function(i, v){
			
			if($(v).val()){ 
				valid = true;
			}
		});
		
		
		return valid;
	}, "{{ trans('messages.fill_atleast_one')}}"  ); 
	
	$.validator.addMethod( "isvalidtask", function( value, element ) {
		var valid = false, inputEntered = false;
		$('[name="functional_task[]"]').each(function(i, v){
			if($(v).val()){ 
				valid = true;
			}
		});
		
		
		return valid;
	}, "{{ trans('messages.fill_atleast_one')}}"  ); 
	
	$.validator.addMethod( "wordlimit", function( value, element ) {
		var wom = value.match(/\S+/g),
		wordCount = wom ? wom.length : 0,
		ln = $(element).attr('data-length');
		if(!ln) return false;
		return wordCount <= ln;
		
	}, "{{ trans('messages.word_limit_exceeded')}}"  );
	
	
	$.validator.addMethod( "alphanumeric", function( value, element ) {
		return this.optional( element ) || !/[~`!#$%\^&*+=\[\]\\';,\/{}|\\":<>\?]/g.test( value );
	}, "{{ trans('messages.enter_no_special_char')}}"  );
	
	$.validator.addMethod( "textarea", function( value, element ) {
		return this.optional( element ) || !/[~`!%\^&*+=\[\]\\;\/{}|\\":<>\?]/g.test( value );
	}, "{{ trans('messages.enter_no_special_char')}}"  );
	
	
	
	$.validator.addMethod( "textbox", function( value, element ) {
		return this.optional( element ) || !/[~`!#$%\^&*+=\[\]\\';,\/{}|\\":<>\?]/g.test( value );
	}, "{{ trans('messages.enter_no_special_char')}}"  );
	
	$.validator.addMethod( "freetext", function( value, element ) {
		return this.optional( element ) || !/[~`!$%\^&*+=\[\]\\';\/{}|\\"<>\?]/g.test( value );
	}, "{{ trans('messages.enter_no_special_char')}}"  );
	
	$.validator.addMethod( "integer", function( value, element ) {
		return this.optional( element ) || /^-?\d+$/.test( value );
	}, "{{Lang::get('messages.please_enter_number')}}" );

	$.validator.addMethod( "myemail", function( value, element ) {
	return this.optional( element ) || /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test( value );
	}, "{{ Lang::get('messages.invalid_email') }}"); 

	$('.changeLang').on('click',function(e){
			e.preventDefault();
			var url = $(this).attr('href');
			url += '?redirect_url='+window.location.href;
			$(this).attr('href',url);
			window.location.href = url;
	}); 
 }); 


function sendAjax(url,type,dataToSend,func,loaderDivID){

		if(loaderDivID){ $(loaderDivID).addClass('show_'); }

		$.ajax({
			url:url,
			type:type,
			async:true,
			data:dataToSend,
			dataType:'json',
			statusCode: {
				302:function(){ console.log('Forbidden. Access Restricted'); },
				403:function(){ console.log('Forbidden. Access Restricted','403'); },
				404:function(){ console.log('Page not found','404'); },
				500:function(){ console.log('Internal Server Error','500'); }
			}
		}).done(function(responseData){
			if(loaderDivID){$(loaderDivID).removeClass('show_');}								
			func(responseData);	
								
		});
 }


     function renderLoadMoreButton(obj) {
	  	var loaderStyle = (obj.paginateURL != "") ? "" : "display:none;";

	  	var button = [
	      '<div style="' + loaderStyle + '" class="more-wrap text-center" id="load_more_'+ obj.activeTab +'" data-redirect="' + obj.paginateURL + '"><a class="more " href="#"><div class="line_box"><span></span><span></span></div><span class="text_">' + obj.text + '</span></a></div>',
	    ];

	    $("#" + obj.wrapperName).after(button.join(''));
	}

    function loaderButtonStatus(el, paginateURL) {
	  	if(paginateURL === "") {
	         $(el).hide();
	      } else {
	         $(el).show();
	         $(el).attr("data-redirect", paginateURL);
	      }
	} 
 
 @if(Auth::user())
	$(function() {
		$('.dropdown-trigger').dropdown({
			alignment : 'right'
		});
	});
 @endif


</script>
<?php /*
<script>
  !function() {
  var t; if (t = window.botsify = window.botsify = window.botsify || [], !t.init) return t.invoked ? void (window.console && console.error && console.error("Botsify snippet included twice.")) : (
  t.load =function(e){	var o,n;	o=document.createElement("script"); e.type="text/javscript"; o.async=!0; o.crossorigin="anonymous";
  o.src="https://botsify.com/web-bot/script/frame/"+e+"/botsify.js";	n=document.getElementsByTagName("script")[0];	n.parentNode.insertBefore(o,n); });
  }(); botsify.load('xSBWkUSfQPYopYogBKeCm3k2errHRX70uk8lo0Dg');
</script> */?>
