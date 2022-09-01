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
    @include('frontend.layouts.inner_cssfile')
    {{ HTML::style('assets/frontend/dist/styles/page-children.css') }}
@stop

@section('content')


    <main class="page ">
        <div class="body-bg">
            <div class="img_" style="background-image:url({{ asset('assets/frontend/dist/images/children_bg.svg') }})">
            </div>
        </div>

        <section class="page-section">
			
			<div class="container">
				<div class="breadCrumbWrap ">
				        <ol class="breadcrumb">
				            <li><a href="{{asset($lang.'/')}}" class="homebrc">{{ lang('home') }}</a></li>   
				            <li><a href="{{asset($lang.'/children')}}" class="homebrc">{{ lang('children') }}</a></li> 
				            <li class="current">{{ $articleDetails->getData('post_title') }}</li>
				        </ol>
				    </div>
			</div>
			
            <div class="container-fluid no-padding">
                <div class="title_box">
                    <h1 class="section-title  text-center"><span>{{ lang('children') }}</span></h1>
                </div>


                <div class="children-inner-menu r-tabs">
                    
                    <ul class="r-tabs-nav">
                        <li class="r-tabs-tab r-tabs-state-active"><a class="r-tabs-anchor"
                                href="#tab-1">{{ lang('be_an_eSafe_kid') }}</a></li>
                        <li class="r-tabs-tab "><a class="r-tabs-anchor" href="{{asset($lang.'/children')}}#tab-2">{{ lang('i_want_help_with') }}</a></li>
                        <?php /* <li class="r-tabs-tab"><a class="r-tabs-anchor" href="{{asset($lang.'/children')}}#tab-3">{{ lang('how_esafety_can_help') }}</a></li> */ ?>
                    </ul>

                    <div class="r-tabs-state-active">
                        <div class=" list-tab children-tab ">
                            <div class="container">

                                <div class="head-box safe-box ">

                                    @include('frontend.esafe_kid_article_inner')

                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="r-tabs-state-active">
                        <div class=" list-tab children-tab">
                            <div class="container">
                                <h2 class="text-center">{{ lang('related_articles') }}</h2>

                                <div class="safe-box ">
                                    @include('frontend.esafe_kid_related_article')
                                </div>
                            </div>

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

    <script>
        $(document).ready(function() {

            banner_resize();

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
        var swiper = new Swiper(".article-slide", {
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },

            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },

        });
    </script>



@stop
