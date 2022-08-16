<ol class="fl-social">
    {{-- <li><a href="#" class="help_line_tooltip" data-tooltip-content="#help_line_options" ><i class="icon icon-icon-alarm-icon"></i></a></li> --}}
	@if(!empty(@$websiteSettings->facebook_link))
    <li><a href="{{@$websiteSettings->facebook_link}}" target="_blank"><i class="icon icon-icon-fb-icon"></i></a></li>
    @endif
	@if(!empty(@$websiteSettings->instagram_link))
    <li><a href="{{@$websiteSettings->instagram_link}}"  target="_blank"><i class="icon icon-icon-instagram-icon"></i></a></li>
    @endif
	@if(!empty(@$websiteSettings->twitter_link))
    <li><a href="{{@$websiteSettings->twitter_link}}" target="_blank"><i class="icon icon-icon-twitter-icon"></i></a></li>
    @endif
	@if(!empty(@$websiteSettings->youtube_link))
    <li><a href="{{@$websiteSettings->youtube_link}}" target="_blank"><i class="icon icon-icon-youtube-icon"></i></a></li>
	@endif
  {{-- <li><a href="#" id="happiness-meter-widget-button"><img src="{{getFrontendAsset('images/smily-logo.png')}}" /></a></li> --}}
</ol>
  <div class="tooltip_templates">
         <div class="help_line_popup" id="help_line_options">
         <div class="help_line_share">
               <ul>
                  <li><a href="tel:80091" class="help_line_icon"><div class="icon icon-icon-phone-icon"></div></a></li>
                  <li><a href="#" class="help_line_icon" data-toggle="tooltip" data-placement="top" title="{{ lang('chat_tool_tip') }}" ><div class="icon icon-icon-chat-icon"></div></a></li>
                  <li><a href="{{ asset($lang.'/search') }}" class="help_line_icon"><div class="icon icon-icon-search-icon"></div></a></li>
               </ul>
         </div>
      </div>
  </div>

{{-- <div id="happiness-meter-widget-container"></div> --}}