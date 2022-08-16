@if(!empty($parentGuide))
@php
   $bannerImage=getFrontendAsset('images/parents_guides_img.jpg');
   if(!empty($parentGuide->getData('pg_banner_image'))){
	   $bannerImage=$parentGuide->getPostImage('pg_banner_image','large'); 
   }
@endphp
<section class="home-section parents_guides-section" id="parents_guides">
  <div class="container-fluid no_pad">
    <div class="middle_guide_wrapper re_order">
      <div class="grid_shape s1">
        <div class="shape_ fill_lightblue">
          <svg x="0px" y="0px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve"
            preserveAspectRatio="none">
            <polygon points="30,30 0,30 0,0 27.447,4.787 " />
          </svg>
        </div>

        <div class="img_box">
          <div class="img_ b-lazy" data-src="{{$bannerImage}}"></div>

        </div>
      </div>

      <div class="title_box ">
        <h1 class="section-title"><span>{{$parentGuide->getData('pg_home_title')}}</span></h1>
      </div>

      <div class="more-wrap ">
        <a class="more " href="{{asset($lang.'/parent_guides')}}">
          <div class="line_box">
            <span></span>
            <span></span>
          </div>
          <span class="text_">{{lang('know_more')}}</span>
        </a>
      </div>

    </div>
  </div>

</section>
@endif
