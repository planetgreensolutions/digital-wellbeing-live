@if(!empty($digitalWellbeing))
	<section class="home-section digital_issues-section" id="digital_domains">
	  <div class="container">
		<div class="digital_wrapper">
		  <div class="content_box {{ ($lang=='en')?'text-right':'' }}">
			<div class="text_box">
				{!! $digitalWellbeing->getData('excerpt') !!}
			</div>
			<div class="more-wrap">
			  <a class="more" href="{{  PL( $lang,$digitalWellbeing->getData('post_type') ) }}">
				<div class="line_box">
				  <span></span>
				  <span></span>
				</div>
				<span class="text_">{{ lang('read_more') }}</span>
			  </a>
			</div>
		  </div>
		@if(!empty($aboutUsQuestionsList) && $aboutUsQuestionsList->count() > 0)	
		  <div class="issue_box">
			<div class="issue_list">
			  <ul>
				@foreach($aboutUsQuestionsList as $abQuestion)
					<li><div class="text_">{!! $abQuestion->getData('post_title') !!}</div></li>
				@endforeach
			  </ul>
			</div>
		  </div>
		@endif
		</div>

	  </div>
	</section>
@endif