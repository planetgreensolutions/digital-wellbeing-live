@if(!empty($digitalCitizenship))
	<section class="home-section digital_citizenship-section" id="digital_citizenship">
	  <div class="container-fluid no_pad">
		<div class="digital_c_wrapper">
		  <div class="img_box">

			<div class="img_ b-lazy" data-src="{{  PP($digitalCitizenship->getData('digital_citizenship_banner') ) }}"></div>
		  </div>
		  <div class="content_box">
			<div class="shape_box">
			  <svg x="0px" y="0px" viewBox="0 0 61 47" enable-background="new 0 0 61 47" xml:space="preserve"
				preserveAspectRatio="none">
				<g>
				  <polygon class="shape_p p1" fill="#016ba7"
					points="55.976,42.599 6.188,44.469 6.188,0.437 60.149,4.034 " />
				  <polygon class="shape_p p2" fill="#016ba7"
					points="24.626,43.503 5.189,45.915 0.632,10.124 20.069,7.711 " />
				  <polygon fill="#FFFFFF" points="58.249,42.594 5.007,47 2.07,0 58.249,5.875 " />
				</g>
			  </svg>
			</div>

			<div class="content">
			  <div class="title_box">
				<h1 class="section-title txt-up"><span>{!! $digitalCitizenship->getData('post_title') !!}</span></h1>
			  </div>

			  <div class="text_box">
				{!! $digitalCitizenship->getData('excerpt') !!}
			  </div>
			  <div class="more-wrap">
				<a class="more " href="{{  PL( $lang,$digitalCitizenship->getData('post_slug') ) }}">
				  <div class="line_box">
					<span></span>
					<span></span>
				  </div>
				  <span class="text_">{{lang('read_more')}}</span>
				</a>
			  </div>
			</div>
		  </div>
		</div>

	  </div>
	</section>
@endif