@if(!empty($guides_and_tips) && $guides_and_tips->count() > 0)
@foreach($guides_and_tips as $guidesTips)
@php 
	$tipsBannerImage=getFrontendAsset('images/default_tips_image.jpg');
	if($guidesTips->getData('guides_tips_banner')){
	   $tipsBannerImage = str_replace('http://172.21.19.103', 'https://digitalwellbeing.ae', $guidesTips->getPostImage('guides_tips_banner','large'));
	}
@endphp
<div class="tip_item">
	<div class="inner_ ">
		<div class="top_box">
			<a href="{{str_replace('http://172.21.19.103', 'https://digitalwellbeing.ae', asset($lang.'/'.$guidesTips->getData('post_type').'/'.$guidesTips->getData('post_slug')))}}" class="full_link"></a>
			<div class="shape_ fill_lightblue">
				<svg x="0px" y="0px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve"
				preserveAspectRatio="none">
				<polygon points="30,30 0,30 0,0 27.447,4.787 " />
				</svg>
			</div>
			<div class="img_box">
				<div class="img_ b-lazy" data-src="{{ $tipsBannerImage}}"></div>
				<div class="meta_tag color-lightblue">
					<ul>
						@foreach($guidesTips->tags as $tag) 
						<li>{{$tag->name}}</li>
						@endforeach
					</ul> 
				</div>
			</div>
		</div>
		<div class="details_box">
			<div class="title_">{{$guidesTips->post_title}}</div>

			<div class="text_box">
				<p>{{$guidesTips->getMeta('subtitle')}} </p>
			</div>

			<div class="more-wrap ">
				<a class="more_dote_ btn_lightblue" href="{{str_replace('http://172.21.19.103', 'https://digitalwellbeing.ae', asset($lang.'/'.$guidesTips->getData('post_type').'/'.$guidesTips->getData('post_slug')))}}">
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
