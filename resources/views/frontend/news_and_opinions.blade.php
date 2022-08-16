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
					<li class="current">{{ lang('news_and_opinions') }}</li>
				</ol>
			</div>
			<div class="title_box with_tool">
			 <h1 class="section-title txt-up">
				<div class="title_wr">
				   <span>{{lang('news_and_opinions')}}</span>
				</div>
			 </h1>

			 <div class="tool_box">
			   
				<div class="tool_item">
				  <div class="label_in"> <label>{{lang('filter')}}</label></div> 
					<div class="input-field">  
					  <select name="tag_filter" id="tag_filter">
						<option value="" selected>{{lang('all')}}</option>
						 <?php /*
						 @if(!empty($tags))
							@foreach($tags as $tag)
									  <option value="{{$tag->tag_name}}">{{$tag->tag_name}}</option>
							 @endforeach
						@endif
						*/ ?>
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
			<div class="guide_wrapper" id="news-block">
				@if(!empty($news_and_opinions) && $news_and_opinions->count() > 0)
				@foreach($news_and_opinions as $newsOpinions)
				@php 
				$newsBannerImage=getFrontendAsset('images/default_tips_image.jpg');
				if($newsOpinions->getData('news_banner')){
				$newsBannerImage=PP($newsOpinions->getData('news_banner'));
				}
				@endphp
				<div class="tip_item">
					<div class="inner_ ">
						<div class="top_box">
							<a href="{{asset($lang.'/'.$newsOpinions->getData('post_type').'/'.$newsOpinions->getData('post_slug'))}}" class="full_link"></a>
							<div class="shape_ fill_lightblue">
								<svg x="0px" y="0px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve"
								preserveAspectRatio="none">
								<polygon points="30,30 0,30 0,0 27.447,4.787 " />
								</svg>
							</div>
							<div class="img_box">
								<div class="img_ b-lazy" data-src="{{ $newsBannerImage}}"></div>
								@if(isset($newsOpinions->category))
								<div class="meta_tag color-lightblue">
									<ul><li>{{ $newsOpinions->category->getData('category_title') }}</li></ul>
								</div>
								@endif
							</div>
						</div>
						<div class="details_box">
							<div class="title_">{{$newsOpinions->getData('post_title')}}</div>

							<div class="text_box">
								<p>{{$newsOpinions->getData('subtitle')}} </p>
							</div>

							
						</div>

					</div>
				</div>
				@endforeach
				@endif
			</div>


			{{-- @if((!empty($news_and_opinions->nextPageUrl())))
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
		<div class="loader_box">
		  <div class="loader_wrapper">
			<div class="circle bot" ></div>
			<div class="circle mid" ></div>
			<div class="circle top" ></div>
		  </div>
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
  
 $('#tag_filter').on('change',function(){
	    var _url="{{asset($lang.'/news_and_opinions')}}";
	    var tag=$(this).val();
		var dataToSend={'tag':tag};
	    $('.loader_box').addClass('show');
	    sendAjax(_url,'get',dataToSend,function(data){
			if(data.status){
					$('#news-block').html(data.dataHTML);
					
					var bLazy = new Blazy();
					setTimeout(function(){
						$('.loader_box').removeClass('show');
					},500)
					
					
				}
		});
 }) 
  
  
 
var ajaxRequestfinished = true;
var nextPage = "{{(!empty($news_and_opinions->nextPageUrl()))?$news_and_opinions->nextPageUrl():''}}";

// $('body').on('click','#view_more',function(e){
// 	e.preventDefault();
// 	if(!nextPage){
// 			return;
// 		}
// 		if(!ajaxRequestfinished){
// 			return;
// 		}
		
// 		var _url=nextPage;
// 		ajaxRequestfinished = false;
// 		var tag=$('#tag_filter').val();
// 		var dataToSend={'tag':tag};
// 		if(_url){
// 			$('.loader_box').addClass('show');
// 			sendAjax(_url,'get',dataToSend,function(data){
// 				if(data.status){
// 					$('#news-block').append(data.dataHTML);
// 					nextPage=data.dataNext;
// 					if(!nextPage){
// 						$('#view_more').remove();
// 					}
// 					var bLazy = new Blazy();
// 					setTimeout(function(){
// 						$('.loader_box').removeClass('show');
// 					},500)
					
// 					ajaxRequestfinished = true;
// 				}
// 		});
// 		}
	
// });

$(window).scroll(function(e){
	if (($(window).scrollTop()+100) >= ($(document).height() - $(window).height())) {
			if(!nextPage){
				return;
			}
			if(!ajaxRequestfinished){
				return;
			}
			
			var _url=nextPage;
			ajaxRequestfinished = false;
			var tag=$('#tag_filter').val();
			var dataToSend={'tag':tag};
			if(_url){
				$('.loader_box').addClass('show');
				sendAjax(_url,'get',dataToSend,function(data){
					if(data.status){
						$('#news-block').append(data.dataHTML);
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
	}
	
});
</script>
@stop

