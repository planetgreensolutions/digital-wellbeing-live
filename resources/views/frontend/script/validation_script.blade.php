
<script>
$('.phone_number').mask('000000000000000');
$.validator.addMethod( "emailSpecialChar", function( value, element ) {
		return this.optional( element ) || !/[~`!#$%\^&*+=\-\[\]\\';\/{}|\\":<>\?]/g.test( value );        
	 }, "{{ Lang::get('messages.enter_no_special_char') }}" );
	 
	 
	 $.validator.addMethod( "myEmail", function( value, element ) {
		return this.optional( element ) || /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test( value );
	}, "{{ Lang::get('messages.invalid_email') }}"); 
	
    $.validator.addMethod( "alphanumeric", function( value, element ) {
		//return this.optional( element ) || !/[~`!#$@%\^&*+=\-\[\]\\';,\/{}|\\":<>\?]/g.test( value );
		return this.optional( element ) || /^[\u0600-\u065F\u066A-\u06EF\u06FA-\u06FFa-zA-Z0-9_. -]*$/.test( value );
	}, "{{ trans('messages.enter_no_special_char') }}" );

	$.validator.addMethod( "alphanumericMessageBox", function( value, element ) {
		return this.optional( element ) || /^[\u0600-\u065F\u066A-\u06EF\u06FA-\u06FFa-zA-Z0-9,_. \n-]*$/.test( value );
	}, "{{ trans('messages.enter_no_special_char') }}" );

	$.validator.addMethod( "integer", function( value, element ) {
		return this.optional( element ) || /^-?\d+$/.test( value );
	}, "Only numbers are allowed" );

	$.validator.addMethod( "dateFormat", function( value, element ) {
		var pattern = /^[A-Za-z]{3} \d{2}, \d{4}$/;
		return this.optional( element ) || pattern.test(value)
	}, "{{ trans('messages.invalid_date') }}" );

	

	$.validator.addMethod( "noSpace", function( value, element ) {

        return !value.startsWith(" ");
	}, "messages.no_blank_space");
	
	
	
</script>