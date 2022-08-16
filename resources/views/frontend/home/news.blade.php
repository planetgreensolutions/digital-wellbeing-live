@if(!empty($newsList) && $newsList->count() > 0)

<section class="home-section news_and_opinion-section guides_and_tips-section"  id="news_and_opinion">
  <div class="container">
    <div class="title_box text-center">
      <h1 class="section-title"><span>{{lang('news_and_opinions')}}</span></h1>
    </div>

    <div class="news_and_opinion_wrapper guides_and_tips_wrapper">

      <div class="swiper-container">
        <div class="swiper-wrapper">
		 @php  $divClass="fill_lightblue"; @endphp
		 @foreach($newsList as $news)
		 @php 
		    $newsBannerImage=getFrontendAsset('images/default_tips_image');
			if($news->getData('news_banner')){
				$newsBannerImage=PP($news->getData('news_banner'));
			}
		 @endphp
          <div class="swiper-slide tip_item">
            <div class="inner_ ">
              <div class="top_box">
                <a href="{{InnerLink($news)}}" class="full_link"></a>
                <div class="shape_ {{$divClass}}">
                  <svg x="0px" y="0px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve"
                    preserveAspectRatio="none">
                    <polygon points="30,30 0,30 0,0 27.447,4.787 " />
                  </svg>
                </div>
                <div class="img_box">
                  <div class="img_ b-lazy" data-src="{{$newsBannerImage}}"></div>
                  <div class="meta_tag color-lightblue">
                    <ul>										
					@if(isset($news->category))	
						  <li>{{ $news->category->getData('category_title')}}</li>
					 @endif                    
                    </ul>
                  </div>
                </div>
              </div>
              <div class="details_box">
                <div class="title_">{!! $news->getData('post_title')!!}</div>

                <div class="text_box">
                  <p>{!! $news->getMeta('excerpt')!!} 
                  </p>
                </div>

                <div class="more-wrap ">
                  <a class="more_dote_ btn_lightblue" href="{{InnerLink($news)}}">
                    <span></span>
                    <span></span>
                    <span></span>
                  </a>
                </div>
              </div>

            </div>
          </div>
		   @php  $divClass=($divClass=="fill_blue")?"fill_lightblue":"fill_blue" ; @endphp
		  @endforeach
         

        </div>

      </div>

    </div>
    <!-- Add Navigation -->
    <div class="nav_box box_center_">
      <div class="nav_ left_"><i class="icon icon-icon-arrow-left"></i></div>
      <div class="nav_ right_"><i class="icon icon-icon-arrow-right"></i></div>
    </div>

    <div class="more-wrap text-center">
      <a class="more " href="{{ asset($lang.'/news_and_opinions')}}">
        <div class="line_box">
          <span></span>
          <span></span>
        </div>
        <span class="text_">{{ lang('view_all')}}</span>
      </a>
    </div>

  </div>
</section>
@endif
