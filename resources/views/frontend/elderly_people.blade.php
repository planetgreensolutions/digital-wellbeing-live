@extends('frontend.layouts.master')
@section('metatags')
	<meta name="description" content="{{{@$websiteSettings->site_meta_description}}}" />
	<meta name="keywords" content="{{{@$websiteSettings->site_meta_keyword}}}" />
	<meta name="author" content="{{{@$websiteSettings->site_meta_title}}}" />
@stop
@section('seoPageTitle')
	<title>
		<?php $title = ($lang == 'en') ? @$websiteSettings->sitename : @$websiteSettings->sitename_arabic;?>
		{{ (!empty($pageTitle))? $pageTitle : @$title }}
	</title>
@stop

<link type="text/css" rel="stylesheet" href="{{asset('assets/frontend/sweetalert2/sweetalert2.min.css')}}">
@section('styles')
 @include('frontend.layouts.inner_cssfile')
@stop

@section('content')

<main class="page">

<section class="page-section cou_pge">
    <div class="container">

      @if(!empty($postDetails))
      <div class="charter_wrapper no_border">

         <div class="title_box with_tool">
           <h1 class="section-title txt-up text-center" >
              {{$postDetails->getData('post_title')}}
           </h1>
        </div>
        <div class="text-box text-center">
          {!! $postDetails->getData('description') !!}
        </div>
      </div>
      @endif

      <div class="elder_main_wrapper">
        <div class="title_box with_tool ">
         <h2 class="section-title txt-up text-center" >
            {{lang('videos_alt')}}
         </h2>

         <div class="searh_input">
          {{Form::open([
              'id' => 'search_form',
              'class' => 'search_form',
          ])}}
          <input type="text" name="search_keywords" placeholder="{{lang('search')}}">
          <input style="display:none;" type="submit">
          <i class="icon icon-icon-search-icon"></i>
          {{Form::close()}}
         </div>

      </div>

      <ul class="elder_image_wrapper" id="videoWrapper">
        @include('frontend.ajax.elderly_people_videos')
      </ul>
      </div>

    </div>
</section>

</main>

@stop
@section('scripts')
@parent
<script src="{{asset('assets/frontend/sweetalert2/sweetalert2.min.js')}}"  /></script>
@include('frontend.script.inner_page_script')
<script type="text/javascript">
  $("#search_form").on('submit', function(e){
      e.preventDefault();

      var url = "{{asset($lang.'/elderly-people')}}";
      var type = "POST";
      var dataToSend = {
        '_token': "{{csrf_token()}}",
        'action': "search",
        'search_keywords': $('input[name="search_keywords"]').val(),
      };

      $.ajax({
          url:url,
          type:type,
          async:false,
          data:dataToSend,
          dataType:'json',
          statusCode: {
              302:function(){ console.log('Forbidden. Access Restricted'); },
              403:function(){ console.log('Forbidden. Access Restricted','403'); },
              404:function(){ console.log('Page not found','404'); },
              500:function(){ console.log('Internal Server Error','500'); }
          },
          error: function(res) {
              console.log(res.responseText);
          }
      }).done(function(responseData){
          if(responseData.dataCount> 0) {
            var bLazy = new Blazy();
            $("#videoWrapper").html(responseData.dataHTML);
          }
          else {
            $("#videoWrapper").html('<div><p>'+'{{lang('no_results_found')}}'+'</p></div>');

          }
      });
  });
</script>
@stop