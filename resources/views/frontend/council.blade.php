@extends('frontend.layouts.master') 
@section('metatags')
	<meta name="description" content="{{{@$websiteSettings->site_meta_description}}}" />
	<meta name="keywords" content="{{{@$websiteSettings->site_meta_keyword}}}" />
	<meta name="author" content="{{{@$websiteSettings->site_meta_title}}}" /> 
@stop 
@section('seoPageTitle')
	<title>
		<?php $title = ($lang == 'en') ? @$websiteSettings->sitename : @$websiteSettings->sitename_arabic; ?>
		{{ (!empty($pageTitle))? $pageTitle : @$title }}
	</title>
@stop 

@section('styles')
 @include('frontend.layouts.inner_cssfile')	
 {{ HTML::style('assets/frontend/dist/styles/council.css') }}  
@stop

@section('content')

<main class="page">

<section class="page-section cou_pge">
    <div class="container">
       <div class="title_box with_tool">
         <h1 class="section-title txt-up text-center" >
            <div class="title_wr">
               <span>{{$pageTitle}}</span>
            </div>
         </h1>
        </div>
        <div class="about_concil">
            <div class="hd_bx">
              <span>{{$about_council->getData('post_title')}}</span>
              <div class="text_box">
                {!! $about_council->getData('top_description') !!}
              </div>
            </div>
            <div class="abt_co_sl">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach($about_council_facts as $item)
                        <div class="swiper-slide">
                            <div class="sl_bx">
                                <div class="sl_bx_lf">
                                    <div class="sl_ico">
                                        <img src="{{PP($item->getData('ac_facts_image'))}}">
                                        <div class="shape_sl">                                        
                                            <svg version="1.0" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                viewBox="0 0 208 179" enable-background="new 0 0 208 179" xml:space="preserve">
                                            <polygon points="2,1.088 2,178 206.845,178 190.883,27.026 "/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="sl_bx_rt">
                                    <h4>0{{($loop->index++)+1}}</h4>
                                    {!! $item->getData('description') !!}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- Add Navigation -->
                <div class="nav_box">
                  <div class="nav_ left_"><i class="icon icon-icon-arrow-left"></i></div>
                  <div class="nav_ right_"><i class="icon icon-icon-arrow-right"></i></div>
                </div>
            </div>
            <div class="text_box">
              {!! $about_council->getData('bottom_description') !!}
            </div>
        </div>
    </div>
</section>

  <section class="page-section cou_pge">
    <div class="container">
       <div class="hd_bx">
          <span>{{lang('council_members')}}</span>
        </div>
       <div class="guide_wrapper" id="council_block">
           @include('frontend.ajax.council_members')   
        </div>
      
      {{-- @if((!empty($council_members->nextPageUrl())))
      <div class="more-wrap text-center">
         
        <a class="more " href="#" id="view_more">
          <div class="line_box">
            <span></span>
            <span></span>
          </div>
          <span class="text_" >{{lang('load_more')}}</span>
        </a>
      </div>
      @endif --}}
    </div>
  </section>

</main>

@stop
@section('scripts')
@parent
@include('frontend.script.inner_page_script')
<script type="text/javascript">

var ajaxRequestfinished = true;
{{-- // var nextPage = "{{(!empty($council_members->nextPageUrl()))?$council_members->nextPageUrl():''}}"; --}}
// $('body').on('click','#view_more',function(e){
//   e.preventDefault();
//   if(!nextPage){
//       return;
//     }
//     if(!ajaxRequestfinished){
//       return;
//     }
    
//     var _url=nextPage;
//     ajaxRequestfinished = false;
//     if(_url){
//       $('.loader_box').addClass('show');
//       sendAjax(_url,'get',{},function(data){
//         if(data.status){
//           $('#council_block').append(data.dataHTML);
//           nextPage=data.dataNext;
//           if(!nextPage){
//             $('#view_more').remove();
//           }
//           var bLazy = new Blazy();
//           setTimeout(function(){
//             $('.loader_box').removeClass('show');
//           },500)
          
//           ajaxRequestfinished = true;
//         }
//     });
//     } 
// });

    $(function() {
        
        $('#degital_tab').responsiveTabs({
            startCollapsed: 'accordion', 
            load: function(event, firstTab){
                // read more button event
                GAP.read_more_and_less();
            },          
            activate:function(){                               
               
            }

        });

        $('.side_box').stickit({top : 100, screenMinWidth : 1024});
    })

    $(document).ready(function(){
       $('.collapsible').collapsible();
    });
</script>
<script>
  $(function() {
    $('select').formSelect();
  })
  new Swiper(".abt_co_sl .swiper-container", {
        loop: !1,
        speed: 1e3,
        spaceBetween: 0,
        slidesPerView: 3,
        navigation: {
            nextEl: ".abt_co_sl .right_",
            prevEl: ".abt_co_sl .left_"
        },
        breakpoints: {
            767: {
                slidesPerView: 1
            }
        },
        on: {
            init: function() {
                1 == t(this)[0].snapGrid.length && (t(".abt_co_sl .right_").hide(), t(".abt_co_sl .left_").hide())
            }
        }
    });
</script>
@stop

