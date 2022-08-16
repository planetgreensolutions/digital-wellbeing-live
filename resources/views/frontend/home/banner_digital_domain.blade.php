@if(!empty($digitalDomainList) && $digitalDomainList->count() > 0)
	<div class="banner_slider_wrapper">
		<div class="swiper-container">
			<div class="swiper-wrapper">
			    @php  
				    $divClass="fill_lightblue";  
				    $divIndex=1;  
				
				@endphp
				@foreach($digitalDomainList as $key=>$digitalDomain)
					<div class="swiper-slide banner_item">
						<div class="inner_ s{{$divIndex}}">
							<div class="shape_ {{$divClass}}">
								<svg x="0px" y="0px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve" preserveAspectRatio="none">
									<polygon  points="30,30 0,30 0,0 27.447,4.787 " />
								</svg>
							</div>
							<div class="img_box">
								<div class="img_ b-lazy" data-src="{{ PP($digitalDomain->getData('digital_domain_banner')) }}"></div>

								<div class="hover_box">
									<div class="title_">
										{!! encloseWordSpan( $digitalDomain->getData('post_title') ) !!}
									</div>
									 <div class="more-wrap">
										<a class="more " href="{{ asset($lang.'/digital-domains/'.$digitalDomain->post_slug.'?color='.$divClass) }}">
											<span>{{ lang('read_more') }}</span>                                        
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					@if($divIndex==4)
						@php  $divIndex=1;   @endphp
					@endif
					@if($key%2==0)
						@php $divClass=($divClass=="fill_lightblue")?"fill_blue":'fill_lightblue'; @endphp
					@endif
					@php $divIndex++; @endphp
				@endforeach				
			</div> 
			<!-- Add Navigation -->
			{{-- <div class="nav_box">
				<div class="nav_ left_"><i class="icon icon-icon-arrow-left"></i></div>
				<div class="nav_ right_"><i class="icon icon-icon-arrow-right"></i></div>
			</div> --}}
			<div class="swiper-pagination"></div>
		</div>
	</div>
@endif