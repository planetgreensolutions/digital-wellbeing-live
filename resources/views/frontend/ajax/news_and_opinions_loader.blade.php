@if(!empty($news_and_opinions) && $news_and_opinions->count() > 0)
				@foreach($news_and_opinions as $newsOpinions)
				@php 
				$newsBannerImage=getFrontendAsset('images/default_tips_image.jpg');
				if($newsOpinions->getData('news_banner')){
				$newsBannerImage=PP($newsOpinions->getData('news_banner'));
				}
				@endphp
				<div class="tip_item">
					<div class="inner_ ">
						<div class="top_box">
							<a href="{{asset($lang.'/'.$newsOpinions->getData('post_type').'/'.$newsOpinions->getData('post_slug'))}}" class="full_link"></a>
							<div class="shape_ fill_lightblue">
								<svg x="0px" y="0px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve"
								preserveAspectRatio="none">
								<polygon points="30,30 0,30 0,0 27.447,4.787 " />
								</svg>
							</div>
							<div class="img_box">
								<div class="img_ b-lazy" data-src="{{ $newsBannerImage}}"></div>
								@if(isset($newsOpinions->category))
								<div class="meta_tag color-lightblue">
									<ul><li>{{ $newsOpinions->category->getData('category_title') }}</li></ul>
									<?php /*
									<ul>
										@foreach($newsOpinions->tags as $tag) 
										<li>{{$tag->name}}</li>
										@endforeach
									</ul> 
									*/ ?>
								</div>
								@endif
							</div>
						</div>
						<div class="details_box">
							<div class="title_">{{$newsOpinions->getData('post_title')}}</div>

							<div class="text_box">
								<p>{{$newsOpinions->getData('subtitle')}} </p>
							</div>

							
						</div>

					</div>
				</div>
				@endforeach
				@endif