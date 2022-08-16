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

@php 
$determinationImage=getFrontendAsset('images/default_tips_image.jpg');
if($determination->getData('determination_image')){
$determinationImage=PP($determination->getData('determination_image'));
}
@endphp


<main class="page ">

  <section class="page-section">
	  <div class="container">
		  <div class="dt-box">
			  <div class="content-box">
				   <div class="title_box">
						<h1 class="section-title txt-up"><span>{{$determination->getData('post_title')}}</span></h1>
					</div>
					<div class="desc">
						{!! $determination->getData('description') !!}
					</div>
			  </div>
			  <div class="image-box">

				  <div class="dt-image">
                <a href="#" class="full_link"></a>
                <div class="shape_ fill_lightblue">
                  <svg x="0px" y="0px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve" preserveAspectRatio="none" >
                    <polygon points="30,30 0,30 0,0 27.447,4.787 "></polygon>
                  </svg>
                </div>
                <div class="img_box">
                  <div class="img_ b-lazy b-loaded" style="background-image: url({{ $determinationImage }});"></div>
                  <div class="meta_tag color-lightblue">
                    <ul>
                      <li>Educators</li>
                    </ul>
                  </div>
                </div>
              </div>


			  </div>
		  </div>
		 
	  </div>

	    </section>


@if(!empty($determination_articles) && $determination_articles->count() > 0)
		  <section class="page-section">
    <div class="container">
       <div class="title_box ">
         <h1 class="section-title txt-up text-center" >
            <div class="title_wr">
               <span>{{ lang('articles') }}</span>
            </div>
         </h1>
      </div>
        
        <div class="guide_wrapper" id="articleWrapper">

        	@include('frontend.ajax.determination_articles_loader')

          @php
              $article_loader_style = !empty($determination_articles->nextPageUrl()) ? '' : 'display:none;';
          @endphp

      	</div>

	      <div style="{{ $article_loader_style }}" id="load_more_articles" class="more-wrap text-center" data-redirect="{{ $determination_articles->nextPageUrl() }}">
	            <a class="more " href="#">
	              <div class="line_box">
	                <span></span>
	                <span></span>
	              </div>
	              <span class="text_">{{ lang('load_more') }}</span>
	            </a>
	      </div>

				<div class="loader_box">
						  <div class="loader_wrapper">
							<div class="circle bot" ></div>
							<div class="circle mid" ></div>
							<div class="circle top" ></div>
						  </div>
			  </div>

    </div>
  </section>

  @endif

  	@if(!empty($determination_blogs) && $determination_blogs->count() > 0)

  	  <section class="page-section">
    <div class="container">
       <div class="title_box ">
         <h1 class="section-title txt-up text-center" >
            <div class="title_wr">
               <span>{{ lang('blogs') }}</span>
            </div>
         </h1>
      </div>
        <div class="guide_wrapper" id="blogWrapper">

        	@include('frontend.ajax.determination_blogs_loader')

          @php
              $blog_loader_style = !empty($determination_blogs->nextPageUrl()) ? '' : 'display:none;';
          @endphp
    

      </div>
      <div style="{{ $blog_loader_style }}" id="load_more_blogs" class="more-wrap text-center" data-redirect="{{ $determination_blogs->nextPageUrl() }}">
	            <a class="more " href="#">
	              <div class="line_box">
	                <span></span>
	                <span></span>
	              </div>
	              <span class="text_">{{ lang('load_more') }}</span>
	            </a>
	      </div>

				<div class="loader_box">
						  <div class="loader_wrapper">
							<div class="circle bot" ></div>
							<div class="circle mid" ></div>
							<div class="circle top" ></div>
						  </div>
			  </div>
    </div>
  </section>

	@endif

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
	    var _url="{{asset($lang.'/determination_articles')}}";
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
var nextPage = "{{(!empty($determination_articles->nextPageUrl()))?$determination_articles->nextPageUrl():''}}";

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

/*
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
*/
</script>

<script>
        var articlesActiveTab = "articles";
        var blogsActiveTab = "blogs";

        function fetchResults(_url, _data, _mode, _tab, _id) {
            $('.loader_box').addClass('show');
            setTimeout(function() {
                sendAjax(_url, 'get', _data, function(responseData) {
                    if (responseData.status) {
                        var bLazy = new Blazy();
                        var wrapperName = "";
                        var dataHTML = "";
                        var paginateURL = "";
                        var activeTab = "";

                        if (_tab == "articles") {
                            wrapperName = "articleWrapper";
                            dataHTML = responseData.articleHTML;
                            paginateURL = responseData.moreArticle;
                            activeTab = articlesActiveTab;

                            $("#load_more_" + articlesActiveTab).remove();

                        } else if (_tab == "blogs") {
                            wrapperName = "blogWrapper";
                            dataHTML = responseData.blogHTML;
                            paginateURL = responseData.moreBlog;
                            activeTab = blogsActiveTab;

                            $("#load_more_" + blogsActiveTab).remove();
                        }

                        switch (_mode) {
                            case "append":
                                $("#" + wrapperName).append(dataHTML);
                                break;
                            case "replace":
                                $("#" + wrapperName).html(dataHTML);
                                break;
                        }

                        setTimeout(function() {
                            window.bLazy.revalidate();
                        }, 250);

                        renderLoadMoreButton({
                            'paginateURL': paginateURL,
                            'activeTab': activeTab,
                            'text': "{{ lang('load_more')}}",
                            'wrapperName': wrapperName,
                        });

                        $('.loader_box').removeClass('show');
                        loaderButtonStatus('#' + _id, paginateURL);
                    }
                }, false);
            }, 1000);
        }

        // Image Load more
        $(document).on('click', "#load_more_articles", function(e) {
            e.preventDefault();

            var id = $(this).attr('id');
            var _url = $(this).attr('data-redirect');

            var _data = {
                "_token": "{{ csrf_token() }}",
                "_tab": "articles",
            };

            fetchResults(_url, _data, 'append', 'articles', id);
        });

        // Video Load more
        $(document).on('click', "#load_more_blogs", function(e) {
            e.preventDefault();

            var id = $(this).attr('id');
            var _url = $(this).attr('data-redirect');

            var _data = {
                "_token": "{{ csrf_token() }}",
                "_tab": "blogs",
            };

            fetchResults(_url, _data, 'append', 'blogs', id);
        });

    </script>

@stop

