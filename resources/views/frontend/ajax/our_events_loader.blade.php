@if(!empty($our_events) && $our_events->count() > 0)
@foreach($our_events as $event)
@php 
$eventBannerImage=getFrontendAsset('images/default_tips_image.jpg');
if($event->getData('events_image')){
$eventBannerImage=$event->getPostImage('events_image','large');
}
@endphp
<div class="event_item">
	<div class="inner_ d_p_hover">
	  <div class="top_box">
		<a href="{{asset($lang.'/'.$event->getData('post_type').'/'.$event->getData('post_slug'))}}" class="full_link"></a>
		<div class="shape_ fill_lightblue">
		  <svg x="0px" y="0px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve"
			preserveAspectRatio="none">
			<polygon points="30,30 0,30 0,0 27.447,4.787 " />
		  </svg>
		</div>
		<div class="img_box">
		  <div class="img_ b-lazy" data-src="{{$eventBannerImage}}"></div>


			<div class="hover_box">
				<div class="date_box">
				<div class="d_">{{(!empty($event->getData('publish_date')))?date('d',strtotime($event->getData('publish_date'))):''}} {{(!empty($event->getData('publish_date')))? lang(strtolower(date('F',strtotime($event->getData('publish_date'))))):''}}</div>
				           
				  
				  <div class="y_">{{(!empty($event->getData('publish_date')))?date('Y',strtotime($event->getData('publish_date'))):''}}</div>
				</div>
				<div class="text_box">
				{{$event->getData('post_title')}}
				</div>

				
			</div>
		</div>
		<div class="more-wrap ">
		  <a class="more_dote_ btn_lightblue" href="{{asset($lang.'/'.$event->getData('post_type').'/'.$event->getData('post_slug'))}}">
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