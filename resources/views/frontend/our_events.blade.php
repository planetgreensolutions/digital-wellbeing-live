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
@stop

@section('content')


<main class="page">

  <section class="page-section">
    <div class="container">
		<div class="breadCrumbWrap ">
        <ol class="breadcrumb">
            <li><a href="{{ asset('/')}}" class="homebrc">{{lang('home')}}</a></li>            
                   
            <li class="current">{{lang('our_initiative')}}</li>
        </ol>
    </div>
       <div class="title_box with_tool">
         <h1 class="section-title txt-up text-center" >
            <div class="title_wr">
               <span>{{lang('our_initiative')}} </span>
            </div>
         </h1>
            <div class="tool_box">
           
            <div class="tool_item">
              <div class="label_in"> <label>{{lang('filter')}}</label></div> 
			  <div class="input-field">  
                  <select name="filter_cat" id="filter_cat" class="filter">
                    <option value="" selected>{{lang('category')}}</option>
					@foreach($EventsCategoryList as $cat)
                    <option value="{{$cat->category_id}}">{{ $cat->getData('category_title')}}</option>
                    @endforeach					
                  </select>
                
                </div>
				
                <div class="input-field">  
                  <select name="filter_month" id="filter_month" class="filter">
                    <option value="" selected>{{lang('all_months')}}</option>
					@foreach($monthNames as $key=>$month)
                    <option value="{{$key+1}}">{{(!empty($month[$lang]))?$month[$lang]:''}}</option>
                    @endforeach					
                  </select>
                
                </div>
            </div>
         </div>
      </div>
	   @if(!empty($our_events) && $our_events->count() > 0)
        <div class="events_wrapper" id="content-block">
	    @foreach($our_events as $event)
		@php 
		$eventBannerImage=getFrontendAsset('images/default_tips_image.jpg');
		if($event->getData('events_image')){
		$eventBannerImage=$event->getPostImage('events_image','large');
		}
		@endphp
        <div class="event_item">
            <div class="inner_ d_p_hover">
              <div class="top_box">
                <a href="{{asset($lang.'/'.$event->getData('post_type').'/'.$event->getData('post_slug'))}}" class="full_link"></a>
                <div class="shape_ fill_lightblue">
                  <svg x="0px" y="0px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve"
                    preserveAspectRatio="none">
                    <polygon points="30,30 0,30 0,0 27.447,4.787 " />
                  </svg>
                </div>
                <div class="img_box">
                  <div class="img_ b-lazy" data-src="{{$eventBannerImage}}"></div>


                    <div class="hover_box">
                        <div class="date_box">
                            <div class="d_">{{(!empty($event->getData('publish_date')))?date('d',strtotime($event->getData('publish_date'))):''}} {{(!empty($event->getData('publish_date')))? lang(strtolower(date('F',strtotime($event->getData('publish_date'))))):''}}</div>
				            <div class="y_">{{(!empty($event->getData('publish_date')))?date('Y',strtotime($event->getData('publish_date'))):''}}</div>
                        </div>
                        <div class="text_box">
						{{$event->getData('post_title')}}
                        </div>

                        
                    </div>
                </div>
                <div class="more-wrap ">
                  <a class="more_dote_ btn_lightblue" href="{{asset($lang.'/'.$event->getData('post_type').'/'.$event->getData('post_slug'))}}">
                    <span></span>
                    <span></span>
                    <span></span>
                  </a>
                </div>
              </div>
            

            </div>
          </div>
		  @endforeach

      </div>
	  @endif
        @if((!empty($our_events->nextPageUrl())))
			<div class="more-wrap text-center">
			   
				<a class="more " href="#" id="view_more">
					<div class="line_box">
						<span></span>
						<span></span>
					</div>
					<span class="text_" >{{lang('load_more')}}</span>
				</a>
			</div>
			@endif
    </div>
  </section>
</main>


@stop
@section('scripts')
@parent
@include('frontend.script.inner_page_script')
<script>
  $(function() {
    $('select').formSelect();
  });
  
 $('.filter').on('change',function(){
	    var _url="{{asset($lang.'/our-events')}}";
	    var month=$('#filter_month').val();
	    var cat=$('#filter_cat').val();
		var dataToSend={
			'month':month,
			'cat':cat
		
		};
	    $('.loader_box').addClass('show');
	    sendAjax(_url,'get',dataToSend,function(data){
			if(data.status){
					$('#content-block').html(data.dataHTML);
					
					nextPage=data.dataNext;
					if(!nextPage){
						$('#view_more').remove();
					}
					var bLazy = new Blazy();
					setTimeout(function(){
						$('.loader_box').removeClass('show');
					},500)
					
					
				}
		});
 }) 
  
  
 
var ajaxRequestfinished = true;
var nextPage = "{{(!empty($our_events->nextPageUrl()))?$our_events->nextPageUrl():''}}";

$('body').on('click','#view_more',function(e){
	e.preventDefault();
	if(!nextPage){
			return;
		}
		if(!ajaxRequestfinished){
			return;
		}
		
		var _url=nextPage;
		ajaxRequestfinished = false;
		 var month=$('#filter_month').val();
	    var cat=$('#filter_cat').val();
		var dataToSend={
			'month':month,
			'cat':cat
		
		};
		if(_url){
			$('.loader_box').addClass('show');
			sendAjax(_url,'get',dataToSend,function(data){
				if(data.status){
					$('#content-block').append(data.dataHTML);
					nextPage=data.dataNext;
					if(!nextPage){
						$('#view_more').remove();
					}
					var bLazy = new Blazy();
					setTimeout(function(){
						$('.loader_box').removeClass('show');
					},500)
					
					ajaxRequestfinished = true;
				}
		});
		}
	
})
</script>
@stop

