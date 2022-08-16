@if(!empty($educatorGuide))
@php
	$educatorBanner=getFrontendAsset('images/educators_guides_img.jpg');
	if($educatorGuide->getData('eg_banner_image')){
		 $educatorBanner=$educatorGuide->getPostImage('eg_banner_image','large'); 
	}


@endphp	
<section class="home-section educators_guides-section" id="educators_guides">
  <div class="container-fluid no_pad">
    <div class="middle_guide_wrapper">

      <div class="grid_shape s2">
        <div class="shape_ fill_blue">
          <svg x="0px" y="0px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve"
            preserveAspectRatio="none">
            <polygon points="30,30 0,30 0,0 27.447,4.787 " />
          </svg>
        </div>

        <div class="img_box">
          <div class="img_ b-lazy" data-src="{{$educatorBanner}}"></div>

        </div>
      </div>

      <div class="title_box ">
        <h1 class="section-title"><span>{{$educatorGuide->getData('eg_home_title')}}</span></h1>
      </div>

      <div class="more-wrap ">
        <a class="more " href="{{asset($lang.'/educator_guides')}}">
          <div class="line_box">
            <span></span>
            <span></span>
          </div>
          <span>{{lang('know_more')}}</span>
        </a>
      </div>

    </div>
  </div>

</section>
@endif