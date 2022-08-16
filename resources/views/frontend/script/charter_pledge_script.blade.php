<script>

$(function() {
    // select box init
    $('select').formSelect();
});

$('#cpr_age').mask('00');

$('#cprSubmitBtn').click(function(e){
    e.preventDefault();
    $('.cprSubmit').submit();
});

$(document).ready(function() {

    var formRules = {
        "hiddenRecaptcha": {
            required: function () {
            var gotResponse = haveRecaptchaResponse('formCaptcha');

            if(!gotResponse){
                $('#formCaptcha').find('iframe').addClass('error-border');
            }else{
                $('#formCaptcha').find('iframe').removeClass('error-border');
            }
            return !gotResponse;
            }
        },
        'cpr_email_address':{
            required:true,
            email:true,
            remote: {
                url: "{{route('check-if-registered', [$lang])}}",
                type: "POST",
                data: {
                    email: function(){
                        return $("#cpr_email_address").val();
                    },
                    _token: window._token.csrfToken
                },
            },
        },
        'cpr_email_address_confirm':{
            required:true,
            email:true,
            equalTo: 'input[name=cpr_email_address]',
            remote: {
                url: "{{route('check-if-registered', [$lang])}}",
                type: "POST",
                data: {
                    email: function(){
                        return $("#cpr_email_address").val();
                    },
                    _token: window._token.csrfToken
                },
            },
        },
        'cpr_name' : {
            required: true,
            alphanumeric: true,
        },
        'cpr_is_agree' : {
            required: true,
        },
        'cpr_nationality': {
            required: true,
        },
        'cpr_age': {
            required: true,
        }
    };

    $.validator.messages.required = "{{ trans('messages.field_required') }}";

    var formMessages = {
        "hiddenCaptcha" : {
            required : "{{ trans('messages.field_required') }}"
        },

        'cpr_email_address': {
            required : "{{ trans('messages.field_required') }}",
            email: "{{ trans('messages.invalid_email') }}",
            remote: "{{ trans('messages.email_exists') }}",
        },

        'cpr_email_address_confirm': {
            required : "{{ trans('messages.field_required') }}",
            email: "{{ trans('messages.invalid_email') }}",
            equalTo: "{{ trans('messages.email_mismatch') }}",
            remote: "{{ trans('messages.email_exists') }}",
        },

        'cpr_name' : {
            required : "{{ trans('messages.field_required') }}",
            alphanumeric : "{{ trans('messages.no_spcl_char') }}"
        },

        'cpr_is_agree' : {
            required: "{{trans('messages.field_required') }}",
        },

        'cpr_nationality' : {
            required: "{{trans('messages.field_required') }}",
        },

        'cpr_age' : {
            required: "{{trans('messages.field_required') }}",
        }
    };

    $('#charterPledgeForm').validate({
        ignore: ':hidden:not(.hiddenCaptcha,.filename, select)',
        errorPlacement: function(error, element) {
            if($(element).attr('type') == 'radio' || $(element).attr('type') == 'checkbox'){
                error.insertBefore(element);
            }else{
                error.insertAfter(element);
            }
        },
        rules: formRules,
        messages: formMessages,
        submitHandler: function(form) {
            var _url = $(form).attr('action');
            var _data = $(form).serializeArray();

            $('.loader_box').addClass('show');
            sendAjax(_url,'post',_data, function(responseData){
               $('.loader_box').removeClass('show');

                resetRecaptcha();

                if(!responseData.status){
                    Swal.fire({
                     type: 'error',
                     text: responseData.message,
                     showCloseButton: true,
                    })
                }
                else {
                    $(form)[0].reset();
                    Swal.fire({
                         type: 'success',
                         // text: responseData.message,
                         html: `{!!$postDetails->getData('popup_msg')!!}`,
                         showCloseButton: true,
                    });
                }
            });
            return false;
        },
    });
});
</script>

