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
					<li class="current">{{ lang('guides_and_tips') }}</li>
				</ol>
			</div>
			<div class="title_box with_tool">
			 <h1 class="section-title txt-up">
				<div class="title_wr">
				   <span>{{lang('guides_and_tips')}}</span>
				</div>
			 </h1>

			 <div class="tool_box">
			   
				<div class="tool_item">
				  <div class="label_in"> <label>{{lang('filter')}}</label></div> 
					<div class="input-field">  
					  <select name="tag_filter" id="tag_filter">
						<option value="" selected>{{lang('all_topic')}}</option>
						 @if(!empty($tags))
							@foreach($tags as $tag)
									  <option value="{{$tag->tag_name}}">{{$tag->tag_name}}</option>
							 @endforeach
						@endif
					  </select>
					
					</div>
				</div>
			 </div>
			</div>
			<div class="guide_wrapper" id="guide-block">
				@if(!empty($guides_and_tips) && $guides_and_tips->count() > 0)
				@foreach($guides_and_tips as $guidesTips)
				@php 
				$tipsBannerImage=getFrontendAsset('images/default_tips_image.jpg');
				if($guidesTips->getData('guides_tips_banner')){
				$tipsBannerImage=$guidesTips->getPostImage('guides_tips_banner','large');
				}
				@endphp
				<div class="tip_item">
					<div class="inner_ ">
						<div class="top_box">
							<a href="{{asset($lang.'/'.$guidesTips->getData('post_type').'/'.$guidesTips->getData('post_slug'))}}" class="full_link"></a>
							<div class="shape_ fill_lightblue">
								<svg x="0px" y="0px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve"
								preserveAspectRatio="none">
								<polygon points="30,30 0,30 0,0 27.447,4.787 " />
								</svg>
							</div>
							<div class="img_box">
								<div class="img_ b-lazy" data-src="{{ $tipsBannerImage}}"></div>
								<div class="meta_tag color-lightblue">
									<ul>
										@foreach($guidesTips->tags as $tag) 
										<li>{{$tag->name}}</li>
										@endforeach
									</ul> 
								</div>
							</div>
						</div>
						<div class="details_box">
							<div class="title_">{{$guidesTips->post_title}}</div>

							<div class="text_box">
								<p>{{$guidesTips->getMeta('subtitle')}} </p>
							</div>

							<div class="more-wrap ">
								<a class="more_dote_ btn_lightblue" href="{{asset($lang.'/'.$guidesTips->getData('post_type').'/'.$guidesTips->getData('post_slug'))}}">
									<span></span>
									<span></span>
									<span></span>
								</a>
							</div>
						</div>

					</div>
				</div>
				@endforeach
				@endif
			</div>
			{{-- <div class="loader_box">
			  <div class="loader_wrapper">
				<div class="circle bot" ></div>
				<div class="circle mid" ></div>
				<div class="circle top" ></div>
			  </div>
		    </div> --}}

			{{-- @if((!empty($guides_and_tips->nextPageUrl())))
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
<script>
  $(function() {
    $('select').formSelect();
  });
  
 $('#tag_filter').on('change',function(){
	    var _url="{{asset($lang.'/guides_and_tips')}}";
	    var tag=$(this).val();
		var dataToSend={'tag':tag};
	    $('.loader_box').addClass('show');
	    sendAjax(_url,'get',dataToSend,function(data){
			if(data.status){
					$('#guide-block').html(data.dataHTML);
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
var nextPage = "{{(!empty($guides_and_tips->nextPageUrl()))?$guides_and_tips->nextPageUrl():''}}";

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
		var tag=$('#tag_filter').val();
		var dataToSend={'tag':tag};
		if(_url){
			$('.loader_box').addClass('show');
			sendAjax(_url,'get',dataToSend,function(data){
				if(data.status){
					$('#guide-block').append(data.dataHTML);
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
					$('#guide-block').append(data.dataHTML);
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

