@if((!empty($brought_to_you_by) && $brought_to_you_by->count() > 0) || (!empty($proudly_supported_by) && $proudly_supported_by->count() > 0))
<section class="home-section clients-section p_bottom" id="clients">
  <div class="container">
    <div class="clients_wrapper">
      <div id="client_tab">
        <ul>
		   @if(!empty($brought_to_you_by) && $brought_to_you_by->count() > 0)
				<li><a href="#tab-1"><span>{{$brought_to_you_by->getData('post_title')}}</span></a></li>
	       @endif

		  @if(!empty($supported_by) && $supported_by->count() > 0)
				<li><a href="#tab-2"><span>{{$supported_by->getData('post_title')}}</span></a></li>
	      @endif
		   @if(!empty($proudly_supported_by) && $proudly_supported_by->count() > 0)
				<li><a href="#tab-3"><span>{{$proudly_supported_by->getData('post_title')}}</span></a></li>
	      @endif
        </ul>

        <div id="tab-1" class="client_slider_wrapper">
          <div class="swiper-container">
            <div class="swiper-wrapper">
			@if(!empty($brought_to_you_by) && $brought_to_you_by->count() > 0)
            @foreach($brought_to_you_by->media as $bimage)
              <div class="swiper-slide client_item">
                <a href="{{!empty($bimage->getData('pm_source'))?$bimage->getData('pm_source'):'#'}}" class="inner_" {{!empty($bimage->getData('pm_source'))?'target=_blank':''}}>
                  <div class="img_box">
                    <div class="img_ b-lazy" data-src="{{ PP($bimage->pm_file_hash)}}"></div>
                  </div>
                </a>
              </div>
              @endforeach
			@endif
            </div>
          </div>
        </div>
		 <div id="tab-2" class="client_slider_wrapper">
          <div class="swiper-container">
            <div class="swiper-wrapper">
			@if(!empty($supported_by) && $supported_by->count() > 0)
            @foreach($supported_by->media as $spimage)
              <div class="swiper-slide client_item">
                <a  href="{{!empty($spimage->getData('pm_source'))?$spimage->getData('pm_source'):'#'}}" class="inner_" {{!empty($spimage->getData('pm_source'))?'target=_blank':''}} >
                  <div class="img_box">
                    <div class="img_ b-lazy" data-src="{{ PP($spimage->pm_file_hash)}}"></div>
                  </div>
                </a>
              </div>
              @endforeach
             @endif



            </div>
              <div class="nav_box">
						  <div class="nav_ left_"><i class="icon icon-icon-arrow-left"></i></div>
						  <div class="nav_ right_"><i class="icon icon-icon-arrow-right"></i></div>
						</div>
          </div>
        </div>
        <div id="tab-3" class="client_slider_wrapper">
          <div class="swiper-container">
            <div class="swiper-wrapper">
			@if(!empty($proudly_supported_by) && $proudly_supported_by->count() > 0)
            @foreach($proudly_supported_by->media as $pimage)
              <div class="swiper-slide client_item">
                <a  href="{{!empty($pimage->getData('pm_source'))?$pimage->getData('pm_source'):'#'}}" class="inner_" {{!empty($pimage->getData('pm_source'))?'target=_blank':''}} >
                  <div class="img_box">
                    <div class="img_ b-lazy" data-src="{{ PP($pimage->pm_file_hash)}}"></div>
                  </div>
                </a>
              </div>
              @endforeach
             @endif



            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>

@if(!empty($charter_pledge_popup))
<div class="min_popup" id="charterPledge" style="display:none">
   <div class="inner_">
    <h2>{{$charter_pledge_popup->getData('post_title')}}</h2>
    {!! $charter_pledge_popup->getData('description') !!}
    <div class="more-wrap text-center">
      <a class="more " href="{{asset($lang.'/charter-pledge')}}">
        <div class="line_box">
          <span></span>
          <span></span>
        </div>
        <span class="text_">{{lang('read_more')}}</span>
      </a>
    </div>
   </div>
</div>
@endif

@endif