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
	@if ($lang == 'ar')
        {{ HTML::style('assets/frontend/dist/styles/page-children-rtl.css') }}
    @endif
	{{ HTML::style('assets/frontend/dist/styles/developer.css') }}
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


                <!-- -->
                <div class="children-inner-menu r-tabs">
                    <ul class="r-tabs-nav">
                        <li class="r-tabs-tab"><a class="r-tabs-anchor" href="{{asset($lang.'/children')}}#tab-1">{{ lang('be_an_eSafe_kid') }}</a></li>
                        <li class="r-tabs-tab r-tabs-state-active "><a class="r-tabs-anchor"
                                href="{{asset($lang.'/children')}}#tab-2">{{ lang('i_want_help_with') }}</a></li>
			<?php /*<li class="r-tabs-tab"><a class="r-tabs-anchor" href="{{asset($lang.'/children')}}#tab-3">{{ lang('how_esafety_can_help') }}</a></li>*/ ?>
                    </ul>
                    <div class="r-tabs-state-active">
                        <div class="single-box list-tab children-tab">
                            <div class="container">

                                <div class="head-box safe-box ">





                                    <div class="stage  ">
                                        <a href="#">

                                            <svg preserveAspectRatio="xMinYMin" class="svg-solid" id="stage_1"
                                                width="451.17" height="324.216" viewBox="0 0 451.17 324.216">
                                                <path data-name="Path 11"
                                                    d="M308.478,168.915c-21.654,3.051-43.245,11.594-58.047,27.692-17.231,18.735-23.208,44.991-27.292,70.116a777.084,777.084,0,0,0-9.249,89.114c-1.527,33.391.3,70.134,22.641,94.994,19.079,21.231,49.516,28.93,78.049,28.048s56.237-9.138,84.194-14.89a485.158,485.158,0,0,1,132.834-8.654c19.573,1.425,39.222,4.041,58.745,2.055s39.394-9.208,52.094-24.168c11.982-14.113,16.13-33.16,18.609-51.507a403.107,403.107,0,0,0-6.546-143.59c-3.711-16.2-8.513-32.369-16.989-46.669s-20.974-26.711-36.565-32.48c-16.536-6.122-34.81-4.35-52.348-2.5-43.157,0-88.364,9.348-131.316,13.891C380.5,174.264,345.279,163.727,308.478,168.915Z"
                                                    transform="translate(-213.484 -154.732)" fill="#fa0" opacity="0.89" />
                                            </svg>

                                            <svg class="svg-border" id="Layer_1" x="0px" y="0px"
                                                viewBox="245 -151.5 463 351"
                                                style="enable-background:new 245 -151.5 463 351;" xml:space="preserve">
                                                <g id="Group_5" transform="translate(52.416) rotate(8)">
                                                    <path id="Path_10"
                                                        d="M301.5,153.4c-21.3,0-40.4-5.7-54.8-16.6c-27.6-21-36.2-57.5-40.9-90.5c-4.3-29.7-6.8-59.6-7.7-89.5
                    c-0.7-26.2,0.5-53.4,14-75.3c13.6-22,36.3-33.4,53-39.1c18.6-6.3,37.7-8.4,56.3-10.3c16.8-1.8,34.2-3.6,50.9-8.7
                    c13.7-4.1,27.8-8.9,41.4-13.6c27.9-9.5,56.7-19.3,85.2-24.8c16-4.9,34.4-10.4,52.7-7.4c15.6,2.6,30.9,11.8,43.3,25.8
                    c12,13.6,20.1,30.3,25.8,43.2c19.6,44.5,31,92.1,33.6,140.6c1,17.9,0.7,38.4-8.9,55.3c-8.9,15.7-25.9,28-47.9,34.6
                    c-15.2,4.5-31.1,6.2-46.5,7.8c-4,0.4-8,0.8-12,1.3c-44.1,5.1-87.2,16.3-128.2,33.3c-6.7,2.8-13.4,5.7-19.9,8.6
                    c-19.3,8.5-39.3,17.3-60.4,22C320.9,152.2,311.2,153.3,301.5,153.4z M266.5-153.3c-16,5.5-37.7,16.3-50.6,37.2
                    c-12.9,20.8-14,47.3-13.3,72.7c0.8,29.8,3.4,59.5,7.6,89c4.6,32.1,12.9,67.6,39.2,87.6c19.6,14.9,48.8,19.5,80.1,12.5
                    c20.6-4.6,40.4-13.3,59.5-21.7c6.5-2.9,13.3-5.8,20-8.6c41.4-17.1,85-28.4,129.5-33.6c4-0.5,8-0.9,12-1.3
                    c15.2-1.6,30.9-3.2,45.7-7.6c20.9-6.2,37-17.8,45.3-32.5c9-15.9,9.3-35.6,8.3-52.8c-2.6-48-13.8-95.1-33.2-139
                    c-5.6-12.7-13.5-28.9-25.1-42.1c-11.7-13.2-26.2-21.9-40.7-24.3c-17.2-2.9-35.1,2.5-50.9,7.3c-28.4,5.4-57.1,15.2-84.8,24.7
                    c-13.7,4.7-27.8,9.5-41.5,13.6c-17.2,5.2-34.8,7.1-51.8,8.9C303.5-161.5,284.6-159.5,266.5-153.3L266.5-153.3z" />
                                                </g>
                                            </svg>




                                            @if($articleDetails->getData('i_want_help_with_image'))
                                            <div class="img-wrapper">
                                                <div class="img_"
                                                    style="background-image: url({{ PP($articleDetails->getData('i_want_help_with_image')) }});">
                                                </div>
                                            </div>
                                            @endif

                                            <div class="text-box">
                                                <p>{{ $articleDetails->getData('post_title') }}</p>
                                            </div>
                                        </a>

                                    </div>


                                </div>
                            </div>

                        </div>
                    </div>



                    <div class="help-box">
                        <div class="container">
                            <h2 class="section-title sm_ text-center"><span>{{ $articleDetails->getData('help_with_desc_heading') }}</span></h2>

                            <div class="boxes">

                                @if($articleDetails->getData('help_with_desc_image'))
                                <div class="img_box_new ">
                                    <div class="i_m side_box" >

                                    <div class="shape_ fill_lightblue">
                                                        <svg x="0px" y="0px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve" preserveAspectRatio="none">
                                                        <polygon points="30,30 0,30 0,0 27.447,4.787 "></polygon>
                                                        </svg>
                                                    </div>
                                        @if(!empty($articleDetails->media) && $articleDetails->media->isNotEmpty())
                                        <div class="swiper-container">
                                            <div class="swiper-wrapper">
                                               @foreach($articleDetails->media as $media)
                                               @php
                                                    $url=PP($media->getData('pm_file_hash'));
                                                    $mediaBanner=PT($media->getData('pm_file_hash'));
                                                    if($media->pm_media_type=="video"){
                                                        $url=youtubeEmbedUrl($media->getData('pm_name')); 
                                                        if(!empty($media->getData('pm_file_hash'))){
                                                            $mediaBanner=PT($media->getData('pm_file_hash'));
                                                        }else{
                                                            $mediaBanner=youtubeImage($media->getData('pm_name'));
                                                        }
                                                    }
                                                @endphp
                                                <div class="swiper-slide">
                                                    <div class="img-box">
                                                        <a href="{{ $url }}" data-fancybox="gallery" class="link_" >
                                                            <div class="img_" style="background-image: url({{ $mediaBanner }});"></div>
                                                            @if($media->pm_media_type=="video")
                                                            <div class="play_icon">
                                                                <div class="icon icon-icon-arrow-right"></div>
                                                            </div>
                                                            @endif
                                                        </a>
                                                    </div>
                                                </div>

                                                @endforeach
                                            </div>

                                            <div class="swiper-pagination"></div>
                                        </div>
                                        
                                        @endif
                                    </div>
                                </div>
                                @endif
 
                                <div class="desc-box">
                                    <div class="text_box">
                                        {!! $articleDetails->getData('description') !!}
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>



                </div>


            </div>

        </section>


        <section class="page-section">
            <div class="container no-padding">

                @if($articleDetails->getData('help_with_step_heading'))
                <div class="title_box">
                    <h1 class="section-title  text-center"><span>{{ $articleDetails->getData('help_with_step_heading') }}</span></h1>
                </div>
                @endif

                <div class="to-do-boxes">

                    <?php
                    $x=0;
            for($i=1;$i<=10;$i++)
            {

                $step_desc = $articleDetails->getData('help_with_step'.$i);
                if($step_desc)
                {
                    $x++;
                
                    if($x%2 == 0 )
                        $step_color = 'fill_lightblue'; 
                    else
                        $step_color = 'fill_blue';
                
                ?>
                        <div class="box">
                            <div class="tex_box">
                                <span><?php echo sprintf('%02d', $x); ?></span>
                                <p>{!! $step_desc !!}</p>
                            </div>
                            <div class="shape_ {{ $step_color }}">
                                <svg x="0px" y="0px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve"
                                    preserveAspectRatio="none">
                                    <polygon points="30,30 0,30 0,0 27.447,4.787 "></polygon>
                                </svg>
                            </div>
                        </div>
                        <?php
                }
            }
            ?>

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
        var swiper = new Swiper(".side_box .swiper-container", {
            spaceBetween: 20,
            pagination: {
                el: ".side_box  .swiper-pagination",
            },
            on: {
              init: function(){
                window.bLazy.revalidate();
              },
              slideChange: function() {
                window.bLazy.revalidate();
              }
            }
        });
    </script>



@stop
