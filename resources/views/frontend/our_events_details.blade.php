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

@php 
$eventBannerImage=getFrontendAsset('images/default_tips_image.jpg');
if($our_events_details->getData('events_image')){
$eventBannerImage=$our_events_details->getPostImage('events_image','large');
}
@endphp


<main class="page ">

  <section class="page-section">
    <div class="container">
      <div class="breadCrumbWrap ">
        <ol class="breadcrumb">
            <li><a href="{{ asset('/')}}" class="homebrc">{{lang('home')}}</a></li>            
            <li><a href="{{ asset($lang.'/our-events') }}" class="homebrc">{{ lang('our_initiative') }}</a></li>            
            <li class="current">{!!  $our_events_details->getData('post_title') !!}</li>
        </ol>
    </div>
      <div class="normal_details_wrapper">
	   <?php /* ?>
        <div class="side_box">
          
          <div class="inner_box">
            <div class="link_">
              <div class="shape_ fill_lightblue">
                <svg x="0px" y="0px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve"
                  preserveAspectRatio="none">
                  <polygon points="30,30 0,30 0,0 27.447,4.787 " />
                </svg>
              </div>

              <div class="img_box">
                <div class="img_ b-lazy" data-src="{{ $eventBannerImage }}"></div>
                <div class="meta_tag color-lightblue">
                    <ul>
                    @foreach($our_events_details->tags as $tag) 

							<li>{{$tag->name}}</li>
						@endforeach
                    </ul>
                  </div>
              </div>
            </div>
          </div>
        </div>
		<?php */ ?>
		
		@if(!empty($our_events_details->media) && $our_events_details->media->count() > 0)
			<div class="side_box">
			  <!-- <div class="sharethis-inline-share-buttons degital_slider"></div>
		 -->
			  
			  
			  <!-- Swiper -->
				  <div class="swiper-container">
					<div class="swiper-wrapper">
					@foreach($our_events_details->media as $media)
								
						@php
						
						
							$url=PP($media->getData('pm_file_hash'));
							$mediaBanner=PT($media->getData('pm_file_hash'));
							if($media->pm_media_type=="video"){
								$url=youtubeEmbedUrl($media->getData('pm_name')); 
								$mediaBanner=youtubeImage($media->getData('pm_name'));
							}
						@endphp
						<div class="swiper-slide side_bar_gallery_item">
							<div class="inner_box">
								<a href="{{ $url }}" data-fancybox class="link_">
									<div class="shape_ fill_lightblue">
										<svg x="0px" y="0px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve"
										preserveAspectRatio="none">
										<polygon points="30,30 0,30 0,0 27.447,4.787 " />
										</svg>
									</div>
                                    @if($media->pm_media_type=="video")
									<div class="play_icon">
										<div class="icon icon-icon-arrow-right"></div>
									</div>
									@endif
									<div class="img_box">
										<div class="img_ b-lazy" data-src="{{ $mediaBanner }}"></div>
									</div>
								</a>
							</div>
						</div>
					  @endforeach
					  
					</div>
					<!-- Add Pagination -->
					<div class="swiper-pagination"></div>
				  </div>
			</div>
			@endif

        <div class="content_box">
          
          <div class="head_box">
            <div class="title_">{!! ( $our_events_details->getData('post_title') ) !!}</div>
          </div>
          <div class="text_box">
           {!! $our_events_details->getData('description')  !!}
          </div>
          <div class="sharethis-inline-share-buttons"></div>
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
 var d_slider = new Swiper('.degital_slider .swiper-container', {
     spaceBetween: 10,
     autoHeight : true,
     effect : 'fade',
      navigation: {
        nextEl: '.degital_slider .nav_box .right_',
        prevEl: '.degital_slider .nav_box .left_',
      },
    });
    d_slider.on('slideChange', function() {
    window.bLazy.revalidate();
});

   var swiper_gallery = new Swiper('.side_box .swiper-container', {
   		watchOverflow: true,
	      pagination: {
	        el: '.side_box .swiper-pagination',
	        clickable : true,

	      },
       on: {
		    init: function () {
		      	if($('.side_box .swiper-container .side_bar_gallery_item').length == 1) {
		      		$('.side_box .swiper-container .swiper-pagination').hide();
		      	}
		    },
		  },
    });
	swiper_gallery.on('slideChange', function() {
		window.bLazy.revalidate();
	});

</script>
@stop

