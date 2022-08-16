
<?php
$mainLogo = (($lang == 'en') ? @$websiteSettings->sitelogo_english : @$websiteSettings->sitelogo_arabic);
$subLogo = (($lang == 'en') ? @$websiteSettings->sublogo_english : @$websiteSettings->sublogo_arabic);
$changeLang = ($lang == 'ar') ? 'en' : 'ar';
$disableLanguage = @$websiteSettings->disable_language;

?>
    <header id="header">
        <nav class="navbar  navbar-expand-lg  navbar-light">
            <div class="barnd_box left_">
                <a class="navbar-brand-2 new_" href="{{asset($lang)}}" title=""><img src="{{getFrontendAsset('images/digital_logo.png')}}" alt=""></a>
                <a class="navbar-brand-2" href="{{asset($lang)}}" title=""><img src="{{getFrontendAsset('images/logo.svg')}}" alt=""></a>


            </div>


            <div class="nav_box">

                <div class="nav_small_box">
                    <div class="link_box">

					{!! str_replace("</ul>"," ",$menuTopHTML)  !!}

                           @if($disableLanguage==3)
                            <li><a href="{{(asset('language/'.$changeLang))}}" class="link_ lang_switch"><span>{{ (($lang=='ar')?'English':'العربية') }}</span></a></li>
						   @endif
                            <?php /* <li><a href="tel:80091" class="link_ call_switch"><div class="icon icon-icon-phone-icon"></div></a></li> */ ?>
                            <li class="search_wrapper">
                                <div class="search_box">

								      {{Form::open(array('url'=>route('search',[$lang]),'method'=>'GET') )}}
                                        <input type="text" name="search" class="search-input" />
                                        <button type="button" class="link_ search_switch">
                                            <div class="icon icon-icon-search-icon"></div>
                                        </button>
                                    {{ Form::close() }}
                                </div>

                            </li>
                        </ul>
                    </div>
                </div>
                 <div class="collapse navbar-collapse" id="navbar-main">
                    <div class="navbar-inner">

						@if($agent->isDesktop())
							{!! $menuHTML !!}
						@else
							{!! $menuMobileHTML !!}
						@endif
                    </div>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-main" aria-controls="navbar-main" aria-expanded="false" aria-label="Toggle navigation">
                    <div class="burger_box">
                        <span class="line_ top_"></span>
                        <span class="line_ center_"></span>
                        <span class="line_ bottom_"></span>
                    </div>                
                </button>
            </div>

            
            <div class="chat_support_box">
                <img class="img_auto b-lazy" data-src="{{getFrontendAsset('images/share_bg.svg')}}" >
                <?php /*<a href="javascript:void(0);" class="link_ tooltipbox" title="{{ lang('chat_tool_tip')}}"><div class="icon icon-icon-chat-icon"></div></a>*/ ?>
            </div>
             
            
        </nav>
    </header>

