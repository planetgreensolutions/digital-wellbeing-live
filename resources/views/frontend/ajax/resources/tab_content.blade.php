
<div class="swiper-container resources-content">
	<div class="swiper-wrapper">
		
			<div class="swiper-slide resources_lg_content">
				@if(!empty($resourceSubCategoryList) && $resourceSubCategoryList->count() > 0)
					<div class="tab_inner_nav">
					  <ul>   
						@foreach($resourceSubCategoryList as $subCat)
						   @if(isset($subCat->subCategory))
							<li>
								<a href="#" class="tab_nav" data-targer="{{ (isset($subCat->subCategory))?$subCat->subCategory->getData('category_slug'):'' }}"><span>{{ (isset($subCat->subCategory))?$subCat->subCategory->getData('category_title'):'' }}</span></a>
							</li>
							@endif
						@endforeach                  
					  </ul>
					</div>
				@endif
				<div class="swiper-container">
				@if(!empty($resourceList) && $resourceList->count() > 0)
					<div class="swiper-wrapper">
						@foreach($resourceList as $resource)
							
							<div class="swiper-slide resources_lg_inner_item" data-filter="{{ (isset($resource->subCategory))?$resource->subCategory->getData('category_slug'):'' }}">
								<div class="inner_ ">
									<div class="img_box">
										<div  class="img_ b-lazy" data-src="{{ str_replace('http://172.21.19.103', 'https://digitalwellbeing.ae', PP($resource->getData('resources_image'))) }}" ></div>
										<div class="link_box">
										  <ul>
										    @if(!empty($resource->getData('android_link')))
											<li>
											  <a href="{{ $resource->getData('android_link') }}" class="link_icon">
												<div class="icon icon-icon-android"></div>
											  </a>
											</li>
											@endif
											 @if(!empty($resource->getData('iphone_link')))
											<li>
											  <a href="{{ $resource->getData('iphone_link') }}" class="link_icon">
												<div class="icon icon-icon-apple"></div>
											  </a>
											</li>
											@endif
											 @if(!empty($resource->getData('website_link')))
												 <?php 
														$videoId = getYoutubeVideoID($resource->getData('website_link'));
												  ?> 
												  @if(empty($videoId))
														<li>
														  <a href="{{ $resource->getData('website_link') }}" target="_blank" class="link_icon">
															<div class="icon icon-icon-globe"></div>
														  </a>
														</li>
													@else
														<li>
														  <a href="https://www.youtube.com/embed/{{ $videoId }}?autoplay=1&enablejsapi=1" class="link_icon fancybox iframe">
															<div class="icon icon-icon-youtube-icon"></div>
														  </a>
														</li>
													@endif
											@endif
										  </ul>
										</div>
										<div class="meta_tag">
										  <ul>
											@foreach($resource->tags as $tag) 

												<li>{{$tag->name}}</li>
											@endforeach
										  </ul>
										</div>
									</div>
									<div class="title_">{{ $resource->getData('post_title')}}</div>
								</div>
							</div>						  
						@endforeach
						
					</div>
					@else 
					  <div class="not-found" >
						<div class="inner_ ">                             
						  <div class="title_">{{ lang('no_resourses_yet') }}</div>
						</div>
					  </div>
					  @endif
				</div>
				@if(!empty($resourceSubCategoryList) && $resourceSubCategoryList->count() > 0)
					<!-- Add Navigation -->
					<div class="nav_box">
					  <div class="nav_ left_"><i class="icon icon-icon-arrow-left"></i></div>
					  <div class="nav_ right_"><i class="icon icon-icon-arrow-right"></i></div>
					</div>
					  @endif
			</div>
		
	</div>
</div>        
