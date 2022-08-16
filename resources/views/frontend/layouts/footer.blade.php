<footer>

  <div class="container-fluid">
    
    <div class="inner">
        <ol class="social-footer">
            @if(!empty(@$websiteSettings->facebook_link))
			<li><a href="{{@$websiteSettings->facebook_link}}"><i class="icon icon-icon-fb-icon"></i></a></li>
			@endif
			@if(!empty(@$websiteSettings->instagram_link))
			<li><a href="{{@$websiteSettings->instagram_link}}"><i class="icon icon-icon-instagram-icon"></i></a></li>
			@endif
			@if(!empty(@$websiteSettings->twitter_link))
			<li><a href="{{@$websiteSettings->twitter_link}}"><i class="icon icon-icon-twitter-icon"></i></a></li>
			@endif
			@if(!empty(@$websiteSettings->youtube_link))
			<li><a href="{{@$websiteSettings->youtube_link}}"><i class="icon icon-icon-youtube-icon"></i></a></li>
			@endif
        </ol>
        <div class="copy_box text-center">
          <p>{{str_replace("{year}",date('Y'), Lang::get('messages.copyright'))}}</p>
        </div>
        <div class="content_box">
          <ul class="nave_link_box">
              <li><a href="{{ asset($lang.'/digital_laws_in_uae')}}" class="link_" >{{lang('laws_and_regulations_in_uae')}}</a></li>    
			 <li><a href="{{ asset($lang.'/contact-us')}}" class="link_" >{{lang('partner_with_us')}}</a></li>    			  
               <?php /*<li><a href="{{ asset($lang.'/terms_of_use')}}" class="link_" >{{lang('terms_of_use')}}</a></li>          
              <li><a href="#" class="link_" >{{lang('glossary')}}</a></li>        */       ?>       
          </ul>      
      </div>
    </div>
  </div>

<div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
        </svg>
    </div>
</footer>