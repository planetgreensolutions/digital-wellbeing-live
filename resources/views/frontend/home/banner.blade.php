<section class="home-banner" id="home">

<div class="container">
       @include('frontend.home.banner_digital_domain')
		@if(!empty($bannerList) && $bannerList->count()>0)

				 <div class="banner_text_box">

					<div class="swiper-container">
						<div class="swiper-wrapper">
						  @php $class=''; @endphp
							@foreach($bannerList as $banner)
								<div class="swiper-slide small_text banner_text_item {{$class}}">
								   <h1>{!! $banner->getData('post_title') !!}</h1>
									<div class="more-wrap">
									
									   <?php /*  <a class="more l_r" href="{{InnerLink($banner->bannerPost)}}"> */ ?>
										<a class="more l_r btn-banner" > 
										<!-- 	<span>{{ $banner->getData('banner_title')}}</span>    -->
											<span>{{lang('learn')}}</span><span>{{lang('prevent')}}</span><span>{{lang('act')}}</span></span>                     
										</a>									
									</div>
								</div>
								@php $class='small_text'; @endphp
							@endforeach
						</div>
					</div>
					
				</div>
		@endif	
		
</section>
<div class="floating_helpline">
  <a href="#" class="link_">
    @if($lang=='en')
    <img class="img_auto b-lazy" data-src="{{ asset('assets/frontend/dist/images/number-circle-01.svg') }}">
    @else
	<img class="img_auto b-lazy" data-src="{{ asset('assets/frontend/dist/images/number-circle-01-ar.svg') }}">
     @endif
  </a>
</div>




