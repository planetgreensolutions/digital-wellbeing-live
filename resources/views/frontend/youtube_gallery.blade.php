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

<main class="page ">
   

   <section class="page-section"> 
      <div class="container">
		<div class="breadCrumbWrap ">
        <ol class="breadcrumb">
            <li><a href="{{ asset('/')}}" class="homebrc">{{lang('home')}}</a></li>            
             
            <li class="current">{{ lang('videos') }}</li>
        </ol>
    </div>
          <div class="title_box text-center with_tool">
          <h1 class="section-title txt-up" >
              <div class="title_wr">
                <span>{{ lang('videos') }}</span>
              </div>
          </h1>
			<div class="tool_box">
			   
				<div class="tool_item">
				  <div class="label_in"> <label>{{lang('filter')}}</label></div> 
					<div class="input-field">  
					  <select name="tag_filter" id="tag_filter">
						<option value="" selected>{{lang('all')}}</option>
						
						 @if(!empty($tags))
							@foreach($tags as $tag)
									  <option value="{{$tag->tag_name}}">{{$tag->tag_name}}</option>
							 @endforeach
						@endif
						
						@if(!empty($resourceSubCategoryList))
							@foreach($resourceSubCategoryList as $cat)
									  <option value="{{$cat->category_id}}">{{$cat->getData('category_title') }}</option>
							 @endforeach
						@endif
						
					  </select>
					
					</div>
				</div>
			 </div>
        </div>

       
        <div class="video_list_wrapper" id="content-block"> 
             
			@if(!empty($youtube_gallery) && $youtube_gallery->count() > 0)
			
				@foreach($youtube_gallery as  $videos)
				
					
						@php $class="";
						$fillClass="fill_blue";	@endphp			
						
							
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
			@endif

           
           
        </div>
 @if((!empty($youtube_gallery->nextPageUrl())))
        <div class="more-wrap text-center">
        <a class="more " href="#" id="view_more">
          <div class="line_box">
            <span></span>
            <span></span>
          </div>
          <span class="text_" >{{ lang('load_more')}}</span>
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
var ajaxRequestfinished = true;

var nextPage = "{{(!empty($youtube_gallery->nextPageUrl()))?$youtube_gallery->nextPageUrl():''}}"; 

$('document').ready(function(){
	$('#tag_filter').on('change',function(){
			var _url="{{asset($lang.'/youtube_gallery')}}";
			var tag=$(this).val();
			var dataToSend={'tag':tag};
			$('.loader_box').addClass('show');
			sendAjax(_url,'get',dataToSend,function(data){
				if(data.status){
						$('#content-block').html(data.dataHTML);
						
						var bLazy = new Blazy();
						setTimeout(function(){
							$('.loader_box').removeClass('show');
						},500)
						
						
					}
			});
	});
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
			var dataToSend={};
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
		
	});
	$('select').formSelect();
});
</script>
@stop

