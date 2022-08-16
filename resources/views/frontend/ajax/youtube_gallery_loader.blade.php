@if(!empty($youtube_gallery) && $youtube_gallery->count() > 0)
	@foreach($youtube_gallery as  $videos)
	
			@php $class="btn_lightblue";$fillClass="fill_lightblue";	@endphp			
			
					
					@php
					    $class=(!empty($class)) ? '':'btn_lightblue';
					    $fillClass=($fillClass=='fill_lightblue') ? 'fill_blue':'fill_lightblue';
						if(!empty($videos->pm_file_hash)){
							$yimageW=PP($videos->pm_file_hash);
						}else{
							$yimageW= "https://img.youtube.com/vi/$videos->pm_name/hqdefault.jpg";

						}
					@endphp

					<div class=" video_item">
					  <a href="https://www.youtube.com/embed/{{$videos->pm_name}}" data-fancybox class="inner_">
						<div class="top_box">
						  <div class="shape_ {{$fillClass}}">
							<svg x="0px" y="0px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve"
							  preserveAspectRatio="none">
							  <polygon points="30,30 0,30 0,0 27.447,4.787 " />
							</svg>
						  </div>
						  <div class="img_box">
							<div class="img_ b-lazy" data-src="{{$yimageW}}"></div>
							@if(!empty($videos->getData('pm_source')) && $videos->getData('pm_source')!='NULL')
									<div class="meta_tag ">
					                    <ul>
					                      <li>{{$videos->getData('pm_source')}}</li>
					                    </ul>
					                  </div>
							@endif
						  </div>

						   <div class="play_icon {{ $class}}">
							<i class="icon icon-icon-arrow-right"></i>
						  </div>
						  <div class="text_box">
				              {{$videos->getData('pm_title')}}
				          </div>
						</div>
					   
					  </a>
					</div>

					
		
		
	@endforeach
@else
	<div class="col-sm-12 no_results text-center text-bold">{{ lang('no_results_found') }}</div>
@endif