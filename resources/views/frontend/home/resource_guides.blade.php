@if(!empty($resourceCategoryList) && $resourceCategoryList->count() > 0)
<section class="home-section resources-section" id="resources">
  <div class="container">

    <div class="resources_wrapper">
      <div class="title_wrapper">
        <div class="title_box ">
          <h1 class="section-title txt-up"><span>{{lang('resources')}}</span></h1>
        </div>
        <div class="more-wrap system_view">
          <a class="more " href="{{ asset($lang.'/resources')}}">
            <div class="line_box">
              <span></span>
              <span></span>
            </div>
            <span class="text_">{{lang('view_all')}}</span>
          </a>
        </div>
      </div>

      <div class="middle_box">
        <div class="swiper-container resources-thumbs">
          <div class="swiper-wrapper">
			@foreach($resourceCategoryList as $mainCat)
            <div class="swiper-slide resources_sm_item">
              <div class="inner_">
                <div class="title_">{{ $mainCat->getData('category_title')}}</div>
              </div>
            </div>
			@endforeach
          </div>
        </div>
        <!-- Add Navigation -->
        <div class="nav_box box_v_center_">
          <div class="nav_ left_"><i class="icon icon-icon-arrow-left"></i></div>
          <div class="nav_ right_"><i class="icon icon-icon-arrow-right"></i></div>
        </div>
      </div>
      <div class="lg_slider_wrapper">

        <div class="swiper-container resources-top">
          <div class="swiper-wrapper">
		
		  @foreach($resourceCategoryList as $mainCat)
		 
					<div class="swiper-slide resources_lg_item">
					  <div class="small_title">
						<span>{{ $mainCat->getData('category_title')}}</span>
					  </div>
					  <div class="swiper-container">
						<div class="swiper-wrapper">
						@php  $divClass="bg_blue";$inKey=0; @endphp
						
					
							@foreach($mainCat->categoryList as $CatArr)
								@if(isset($CatArr->subCategory))
								<div class="swiper-slide resources_lg_inner_item">
									<a href="{{ asset($lang.'/resources/'.$CatArr->category->getData('category_slug').'?sc='.$CatArr->subCategory->getData('category_slug'))}}" class="inner_ {{$divClass}}">
									  <div class="icon_box">
										<img class="img_auto b-lazy" data-src="{{ $CatArr->subCategory->getPostImage('category_image')}}" />
									  </div>
									  <div class="title_">{{ $CatArr->subCategory->getData('category_title')}}</div>
									</a>
								</div>
								@endif								
								@if($inKey%2==0)
									@php $divClass=($divClass=="bg_lightblue")?"bg_blue":'bg_lightblue'; @endphp
								@endif
								@php  $inKey++; @endphp
							@endforeach
						
						</div>

						<!-- Add Navigation -->
						<div class="nav_box">
						  <div class="nav_ left_"><i class="icon icon-icon-arrow-left"></i></div>
						  <div class="nav_ right_"><i class="icon icon-icon-arrow-right"></i></div>
						</div>
					  </div>
					</div>
					
		@endforeach


          </div>
        </div>
      </div>
      <div class="more-wrap mobile_view text-center">
        <a class="more " href="{{ asset($lang.'/resources')}}">
          <div class="line_box">
            <span></span>
            <span></span>
          </div>
          <span class="text_">{{lang('view_all')}}</span>
        </a>
      </div>
    </div>
  </div>
</section>
@endif