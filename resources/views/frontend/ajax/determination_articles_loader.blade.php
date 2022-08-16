@if(!empty($determination_articles) && $determination_articles->count() > 0)
				@foreach($determination_articles as $articles)
				@php 
				$articleImage=getFrontendAsset('images/default_tips_image.jpg');
				if($articles->getData('determination_article_image')){
				$articleImage=PP($articles->getData('determination_article_image'));
				}
				@endphp

		        <div class="box_item tip_item">
		            <div class="inner_ ">
		              <div class="top_box">
		                <a href="{{asset($lang.'/determination/article/'.$articles->getData('post_slug'))}}" class="full_link"></a>
		                <div class="shape_ fill_lightblue">
		                  <svg x="0px" y="0px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve"
		                    preserveAspectRatio="none">
		                    <polygon points="30,30 0,30 0,0 27.447,4.787 " />
		                  </svg>
		                </div>
		                <div class="img_box">
		                  <div class="img_ b-lazy" data-src="{{ $articleImage }}"></div>
		                  
		                </div>
		              </div>
		              <div class="details_box">
		                <div class="title_">{{$articles->getData('post_title')}}</div>

		            

		                <div class="more-wrap ">
		                  <a class="more_dote_ btn_lightblue" href="{{asset($lang.'/determination/article/'.$articles->getData('post_slug'))}}">
		                    <span></span>
		                    <span></span>
		                    <span></span>
		                  </a>
		                </div>
		              </div>

		            </div>
		          </div>
				@endforeach
				@endif