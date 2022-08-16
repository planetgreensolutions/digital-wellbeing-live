@if(!empty($elderly_people))
	@foreach($elderly_people as $item)
	<li>
	<?php
$videoUrl = $item->getData('youtube_link');
$ytID = getYoutubeVideoID($videoUrl);
$ytImage = youtubeImage($ytID);
?>
	  <a href="{{$videoUrl}}" class="link_" data-fancybox>
	    <div class="img_box">
	      <div class="img_ b-lazy" data-src="{{$ytImage}}"></div>
	      <span><i class="icon icon-icon-arrow-right"></i></span>
	    </div>
	    <div class="name_">{{$item->getData('post_title')}}</div>
	  </a>
	</li>
	@endforeach
@endif