@extends('frontend.layouts.master') 
@section('metatags')
	<meta name="description" content="{{{@$websiteSettings->site_meta_description}}}" />
	<meta name="keywords" content="{{{@$websiteSettings->site_meta_keyword}}}" />
	<meta name="author" content="{{{@$websiteSettings->site_meta_title}}}" /> 
	<meta property="og:url"                content="{{InnerLink($digital_domain)}}" />
	<meta property="og:type"               content="article" />
	<meta property="og:title"              content="{{$digital_domain->getData('post_title')}}" />
	<meta property="og:description"        content="{{$digital_domain->getData('sub_title')}}" />
	<meta property="og:image"              content="{{ PP($digital_domain->getData('digital_domain_banner_inner')) }}" />
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
  <section class="banner_section ">
    <div class="container">
		
      <div class="section-block ">
        <div class="title_box ">
          <h1 class="section-title "> {{$digital_domain->getData('post_title')}}</h1>
          <h2 class="section-sub-title"><span>{{ $digital_domain->getData('sub_title')  }}</span></h2>
        </div>

        <div class="banner_img_box">
          <div class="shape_ fill_lightblue">
            <svg x="0px" y="0px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve"
              preserveAspectRatio="none">
              <polygon points="30,30 0,30 0,0 27.447,4.787 " />
            </svg>
          </div>
          <div class="img_box">
            <div class="img_ b-lazy" data-src="{{ PP($digital_domain->getData('digital_domain_banner_inner')) }}"></div>
          </div>
        </div>

      </div>
    </div>
  </section>
  
  <section class="page-section">
  
	<div class="container">
	<div class="breadCrumbWrap ">
			<ol class="breadcrumb">
				<li><a href="{{ asset('/')}}" class="homebrc">{{lang('home')}}</a></li>   
				<li><a href="{{ asset($lang.'/digital-domains')}}" class="homebrc">{{lang('digital_domain')}}</a></li>   				
				<li class="current">{{$digital_domain->getData('post_title') }}</li>
			</ol>
		</div>
	  <div class="degital_details_wrapper">
		<div class="content_box">

		  <div id="degital_tab">
				<ul>
				  <li><a href="#tab-1"><span>{{ lang('learn_it') }}</span></a></li>
				  <li><a href="#tab-2"><span>{{ lang('prevent_it') }}</span></a></li>
				  <li><a href="#tab-3"><span>{{ lang('act_on_it') }}</span></a></li>
				</ul>
				<div id="tab-1">
				  <div class="text_box">
				   <?php 
							$learnit =$digital_domain->getData('learnit');
							$regex = '#<oembed>(.*?)</oembed>#';
							$embedExist = preg_match($regex,  $learnit,$matches);
							if($embedExist && isset($matches[1])){
								$embeddCode = getEmbedCodeFromYoutubeURL($matches[1]);
								$learnit = preg_replace($regex , $embeddCode, $learnit);
							}
						?>
					{!! $learnit  !!}
				  </div>
				</div>
				<div id="tab-2">
				  <div class="text_box">
				        <?php 
							$preventit =$digital_domain->getData('preventit');
							$regex = '#<oembed>(.*?)</oembed>#';
							$embedExist = preg_match($regex,  $preventit,$matches);
							if($embedExist && isset($matches[1])){
								$embeddCode = getEmbedCodeFromYoutubeURL($matches[1]);
								$preventit = preg_replace($regex , $embeddCode, $preventit);
							}
						?>
					{!! $preventit !!}
				  </div>
				</div>
				<div id="tab-3">
				  <div class="text_box">
				  
				      <?php 
							$actonit =$digital_domain->getData('actonit');
							$regex = '#<oembed>(.*?)</oembed>#';
							$embedExist = preg_match($regex,  $actonit,$matches);
							if($embedExist && isset($matches[1])){
								$embeddCode = getEmbedCodeFromYoutubeURL($matches[1]);
								$actonit = preg_replace($regex , $embeddCode, $actonit);
							}
						?>
					   {!! $actonit !!}
				  </div>
				</div>
			  </div>
			 
				@if(isset($digital_domain->childPosts) && $digital_domain->childPosts->count() > 0)
					
					<div class="degital_slider">
						<div class="swiper-container">
							<div class="swiper-wrapper">
							@foreach($digital_domain->childPosts as $tips)
							  
								<div class="swiper-slide degital_slide">
								  <div class="inner_">
									 <div class="over_bg">
											<svg  x="0px" y="0px"viewBox="0 0 775 250" xml:space="preserve" preserveAspectRatio="none">
												<polygon fill="#EAEAEA" points="0,250 0,1.666 743.285,55.666 775.617,250 "/>
											</svg>
										</div>
										<div class="icon_box">
										  <div class="icon_wrap">
											<img class="img_auto b-lazy" data-src="{{getFrontendAsset('images/degital_svg.svg')}}" />
										  </div>
										</div>

										<div class="content_box">
										 

										  <div class="text_box">
											{!!$tips->getData('post_title')!!}
										  </div>
										</div>
									</div>
								</div>
								@endforeach
			 
							</div>
						</div>
						<!-- Add Navigation -->
						<div class="nav_box ">
						<div class="nav_ left_"><i class="icon icon-icon-arrow-left"></i></div>
						<div class="nav_ right_"><i class="icon icon-icon-arrow-right"></i></div>
						</div>
					</div>
	 				@endif

			</div>
			
			
            @if(!empty($digital_domain->media) && $digital_domain->media->count() > 0)
			<div class="side_box">
			  <div class="sharethis-inline-share-buttons"></div>
		
			  
			  
			  <!-- Swiper -->
				  <div class="swiper-container">
					<div class="swiper-wrapper">
					@foreach($digital_domain->media as $media)
								
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
						<div class="swiper-slide side_bar_gallery_item">
							<div class="inner_box">
								<a href="{{ $url }}" data-fancybox class="link_">
									<div class="shape_ {{!empty($fill_color)?$fill_color:'fill_orange'}}">
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
<script type="text/javascript">
    $(function() {
        
     
        $('#degital_tab').responsiveTabs({
            startCollapsed: 'accordion', 
            load: function(event, firstTab){
                // read more button event
                GAP.read_more_and_less();
                $('.side_box').stickit({top : 100, screenMinWidth : 1024});
            },          
            activate:function(){                               
                //$('.r-tabs-panel.r-tabs-state-active .moretext').hide();
                //$('.r-tabs-panel.r-tabs-state-active .moreless-button').text($('.r-tabs-panel .moreless-button').data('re-more'));
               
            }

        });

        
    })
</script>

@stop

