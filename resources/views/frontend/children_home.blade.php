@extends('frontend.layouts.master')
@section('metatags')
    <meta name="description" content="{{ @$websiteSettings->site_meta_description }}" />
    <meta name="keywords" content="{{ @$websiteSettings->site_meta_keyword }}" />
    <meta name="author" content="{{ @$websiteSettings->site_meta_title }}" />
@stop
@section('seoPageTitle')
    <title>
        <?php $title = $lang == 'en' ? @$websiteSettings->sitename : @$websiteSettings->sitename_arabic; ?>
        {{ !empty($pageTitle) ? $pageTitle : @$title }}
    </title>
@stop

@section('styles')

    {{ HTML::style('assets/frontend/dist/styles/page-children.css') }}
    @if ($lang == 'ar')
        {{ HTML::style('assets/frontend/dist/styles/page-children-rtl.css') }}
    @endif
    @include('frontend.layouts.inner_cssfile')
@stop

@section('content')



    <main class="page ">
        <div class="body-bg">
            <div class="img_" style="background-image:url({{ asset('assets/frontend/dist/images/children_bg.svg') }})">
            </div>
        </div>

        <section class="page-section">
            <div class="container-fluid no-padding">
                <div class="title_box">
                    <h1 class="section-title  text-center"><span>{{ lang('children') }}</span></h1>
                </div>


                <!-- -->
                <div id="children_tab" class="children-tab-wrapper">
                    <ul class="tab-ul">
                        <li><a href="#tab-1">{{ lang('be_an_eSafe_kid') }}</a></li>
                        <li><a href="#tab-2">{{ lang('i_want_help_with') }}</a></li>
			<?php /*<li><a href="#tab-3">{{ lang('how_esafety_can_help') }}</a></li> */ ?>
                    </ul>

                    <div id="tab-1">
                        <div class="children-tab h_">
                            <div class="img-box">
                                <div class="img-wrapper">
                                    <div class="img_"
                                        style="background-image: url({{ getFrontendAsset('images/kid.png') }});"></div>
                                </div>
                            </div>
                            <div class="safe-box">
                                @include('frontend.esafe_kid_inner')
                            </div>
                        </div>

                    </div>
                    <div id="tab-2">
                        <div class="tab-2 list-tab children-tab">
                            <div class="container">
                                <div class="safe-box " id="articleWrapper">
                                    @include('frontend.ajax.children_help_with_loader')

                                    @php
                                        $article_loader_style = !empty($ArticleList->nextPageUrl()) ? '' : 'display:none;';
                                    @endphp
                                </div>

                                <div style="{{ $article_loader_style }}" id="load_more_articles"
                                    class="more-wrap text-center" data-redirect="{{ $ArticleList->nextPageUrl() }}">
                                    <a class="more " href="#">
                                        <div class="line_box">
                                            <span></span>
                                            <span></span>
                                        </div>
                                        <span class="text_">{{ lang('load_more') }}</span>
                                    </a>
                                </div>

                                <div class="loader_box">
                                    <div class="loader_wrapper">
                                        <div class="circle bot"></div>
                                        <div class="circle mid"></div>
                                        <div class="circle top"></div>
                                    </div>
                                </div>

                            </div>

                        </div>

		    </div>
		    <?php /*
                    <div id="tab-3">
                        <div class="container">

                            @if ($aboutEsafety)
                                <div class="inner-container fade-up">
                                    <h2 class="text-center">{!! $aboutEsafety->getData('post_title') !!}</h2>
                                    <div class="text_ text-center ">
                                        {!! $aboutEsafety->getData('description') !!}
                                    </div>
                                </div>
                            @endif


                            @include('frontend.kid_esafety_form')
                        </div>



			</div>*/ ?>
                </div>


            </div>

        </section>
		
		
		 @if(!empty($guides)  && $guides->isNotEmpty())
        <section class="page-section guide_sec">
            <div class="container">
                <div class="title_box with_tool ">
                    <h1 class="section-title txt-up ">
                    <div class="title_wr">
                        <span> {{lang('guides')}}</span>
                    </div>
                    </h1>
                </div>
                <div class="inner_" id="guideWrapper">
                    @include('frontend.ajax.kid_guides_loader')
                </div>
                @if(!empty($guides) && !empty($guides->nextPageUrl()))
                <div style="{{ $article_loader_style }}" id="load_more_guides" class="more-wrap text-center"
                    data-redirect="{{ $guides->nextPageUrl() }}">
                    <a class="more " href="#">
                        <div class="line_box">
                            <span></span>
                            <span></span>
                        </div>
                        <span class="text_">{{ lang('load_more') }}</span>
                    </a>
                </div>
                @endif

                <div class="loader_box">
                    <div class="loader_wrapper">
                        <div class="circle bot"></div>
                        <div class="circle mid"></div>
                        <div class="circle top"></div>
                    </div>
                </div>
            </div>
        </section>
        @endif

@if(!empty($blogList) && $blogList->count() > 0)

  	  <section class="page-section">
    <div class="container">
       <div class="title_box ">
         <h1 class="section-title txt-up text-center" >
            <div class="title_wr">
               <span>{{ lang('blogs') }}</span>
            </div>
         </h1>
      </div>
        <div class="guide_wrapper" id="blogWrapper">

        	@include('frontend.ajax.kid_blog_loader')

          @php
		  
		  
              $blog_loader_style = !empty($blogList->nextPageUrl()) ? '' : 'display:none;';
          @endphp
    

      </div>
      <div style="{{ $blog_loader_style }}" id="load_more_blogs" class="more-wrap text-center" data-redirect="{{ $blogList->nextPageUrl() }}">
	            <a class="more " href="#">
	              <div class="line_box">
	                <span></span>
	                <span></span>
	              </div>
	              <span class="text_">{{ lang('load_more') }}</span>
	            </a>
	      </div>

				<div class="loader_box">
						  <div class="loader_wrapper">
							<div class="circle bot" ></div>
							<div class="circle mid" ></div>
							<div class="circle top" ></div>
						  </div>
			  </div>
    </div>
  </section>

	@endif


    </main>



@stop
@section('scripts')
    @parent
    @include('frontend.script.inner_page_script')

    <script type="text/javascript" src="{{ asset('assets/frontend/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ getFrontendAsset('scripts/lib/jquery.steps.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#phone_number').mask('000000000000000');

            $.validator.addMethod("alphanumericMessageBox", function(value, element) {
                return this.optional(element) ||
                    /^[\u0600-\u065F\u066A-\u06EF\u06FA-\u06FFa-zA-Z0-9,_. \n-]*$/.test(value);
            }, "{{ trans('messages.no_spcl_char') }}");

            $.validator.addMethod("noSpace", function(value, element) {

                return !value.startsWith(" ");
            }, "{{ Lang::get('messages.no_blank_space') }}");

            $.validator.addMethod("myEmail", function(value, element) {
                return this.optional(element) ||
                    /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                    .test(value);
            }, "{{ trans('messages.invalid_email') }}");

            $.validator.addMethod("alphanumeric", function(value, element) {
                return this.optional(element) || !/[~`!#$%\^&*+=\[\]\\';,\/{}|\\":<>\?]/g.test(value);
        }, "{{ trans('messages.no_spcl_char') }}");

        $.validator.addMethod("textarea", function(value, element) {
            return this.optional(element) || !/[~`!%\^&*+=\[\]\\;\/{}|\\":<>\?]/g.test(value);
            }, "{{ trans('messages.no_spcl_char') }}");

            $('#campaign_submit').validate({

                ignore: '',
                rules: {
                    /*
                    'hiddenRecaptcha': {
                        required: function() {
                            var gotResponse = haveRecaptchaResponse('formCaptcha');

                            if (!gotResponse) {
                                $('#formCaptcha').find('iframe').addClass('error-border');
                            } else {
                                $('#formCaptcha').find('iframe').removeClass('error-border');
                            }
                            return !gotResponse;
                        }
                    },
                    */
                    'report_by': {
                        required: true,
                        //alphanumeric: true,
                        // noSpace: true
                    },
                },

                submitHandler: function(form) {

                    $('.aj_loader').addClass('show');

                    //if (grecaptcha.getResponse()) {
                    var _url = $(form).attr('action');
                    var _data = $(form).serializeArray();
                    _data.push({
                        name: "g-recaptcha-response",
                        // value: grecaptcha.getResponse()
                    });

                    sendAjax(_url, 'post', _data, function(responseData) {
                        $('.aj_loader').removeClass('show');

                        if (!responseData.status) {
                            Swal.fire({
                                type: 'error',
                                text: responseData.message,
                                confirmButtonText: "{{ lang('ok') }}",
                            });
                        } else {
                            $(form)[0].reset();
                            $('select').selectric('refresh');
                            Swal.fire({
                                type: 'success',
                                text: responseData.message,
                                confirmButtonText: "{{ lang('ok') }}",
                            });
                        }
                        grecaptcha.reset();

                    }, '.aj_loader');
                    // }
                    return false;
                },
                messages: {

                    "hiddenRecaptcha": {
                        // required: "{{ Lang::get('messages.field_required') }}",

                    },
                    'report_by': {
                        required: "{{ lang('field_required') }}",
                        //alphanumeric: "{{ lang('alphanumeric') }}",
                        //noSpace: "{{ lang('no_blank_space') }}"
                    },

                }

            });
        });
    </script>


    <script>
        $('#children_tab').responsiveTabs({
            startCollapsed: 'accordion'
        });

        $(document).ready(function() {

            banner_resize();

            $("#safety_form").steps({
                headerTag: "h3",
                bodyTag: "section",
                //  transitionEffect: "slideLeft",
                autoFocus: true,
                onStepChanged: function(event, currentIndex, priorIndex) {
                    //  console.log(priorIndex);
                    //$(".wizard>.steps>ul>li:eq(" + priorIndex + ")").addClass("finished");

                    $(".safety-form .shape_.counter span").text(('0' + (currentIndex + 1)).slice(-2));
                    $(".wizard>.steps>ul>li:eq(0)").addClass("finished");
                    $(".wizard>.steps>ul>li:eq(" + (currentIndex + 1) + ")").removeClass("done");
                },
                //onStepChanging: function(event, currentIndex, newIndex) {
                    //$("#campaign_submit").validate().settings.ignore = ":disabled,:hidden";
                    //return $("#campaign_submit").valid();
                //},
                onFinishing: function(event, currentIndex) {
                    $("#campaign_submit").submit();
                }

            })

        });
        window.onresize = function(event) {
            banner_resize();
        };

        function banner_resize() {
            $(".children-tab.h .safe-box .stage").height($(".children-tab.h .safe-box .stage .svg-border").height());
            var l_width = $(".children-tab.h .safe-box .stage .svg-border").width();
            var line_height = $(".children-tab.h .safe-box .stage .connecters svg").height();

            $(".children-tab.h_ .safe-box .stage").css("margin-bottom", line_height / 2);
            $(".children-tab .safe-box .stage .connecters").css("height", line_height);
            $(".children-tab .safe-box .stage:nth-child(3)").css("margin-right", "calc(10% + " + (l_width + line_height /
                2) + "px )");
        }
    </script>

    <script>
        $(function() {
            $('select').formSelect();
        });
    </script>

    <script>
        var articlesActiveTab = "articles";

        function fetchResults(_url, _data, _mode, _tab, _id) {
            $('.loader_box').addClass('show');
            setTimeout(function() {
                sendAjax(_url, 'get', _data, function(responseData) {
                    if (responseData.status) {
                        var bLazy = new Blazy();
                        var wrapperName = "";
                        var dataHTML = "";
                        var paginateURL = "";
                        var activeTab = "";

                        if (_tab == "articles") {
                            wrapperName = "articleWrapper";
                            dataHTML = responseData.articleHTML;
                            paginateURL = responseData.moreArticle;
                            activeTab = articlesActiveTab;

                            $("#load_more_" + articlesActiveTab).remove();

                        } else if (_tab == "guides") {
                            wrapperName = "guideWrapper";
                            dataHTML = responseData.guidesHTML;
                            paginateURL = responseData.moreGuides;
                            activeTab = 'guides';

                            $("#load_more_guides").remove();
                        }

                        switch (_mode) {
                            case "append":
                                $("#" + wrapperName).append(dataHTML);
                                break;
                            case "replace":
                                $("#" + wrapperName).html(dataHTML);
                                break;
                        }

                        setTimeout(function() {
                            window.bLazy.revalidate();
                        }, 250);

                        renderLoadMoreButton({
                            'paginateURL': paginateURL,
                            'activeTab': activeTab,
                            'text': "{{ lang('load_more') }}",
                            'wrapperName': wrapperName,
                        });

                        $('.loader_box').removeClass('show');
                        loaderButtonStatus('#' + _id, paginateURL);
                    }
                }, false);
            }, 1000);
        }

        // Image Load more
        $(document).on('click', "#load_more_articles", function(e) {
            e.preventDefault();

            var id = $(this).attr('id');
            var _url = $(this).attr('data-redirect');

            var _data = {
                "_token": "{{ csrf_token() }}",
                "_tab": "articles",
            };

            fetchResults(_url, _data, 'append', 'articles', id);
        });
		$(document).on('click', "#load_more_guides", function(e) {
            e.preventDefault();

            var id = $(this).attr('id');
            var _url = $(this).attr('data-redirect');

            var _data = {
                "_token": "{{ csrf_token() }}",
                "_tab": "guides",
            };

            fetchResults(_url, _data, 'append', 'guides', id);
        });

    </script>


    <script>
        $(document).ready(function() {
            $('select').selectric({
                disableOnMobile: false,
                nativeOnMobile: false
            });
        })
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.collapsible').collapsible();
        });
    </script>

@stop
