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

$meta_tag = "";
if($postDetails->postTags)
{
    $meta_tag = $postDetails->postTags->tag_name;
}
else
{
    $meta_tag = dateWithLang($postDetails, 'post_created_at');
}

@endphp


<main class="page ">

  <section class="page-section">
    <div class="container">
      
      <div class="normal_details_wrapper">
        <div class="side_box">
          
          <div class="inner_box">
            <div class="link_">
              <div class="shape_ fill_lightblue">
                <svg x="0px" y="0px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve"
                  preserveAspectRatio="none">
                  <polygon points="30,30 0,30 0,0 27.447,4.787 " />
                </svg>
              </div>

              <div class="img_box">
                <div class="img_ b-lazy" data-src="{{ PP($postDetails->getData('young_people_blog_image')) }}"></div>
                <div class="meta_tag color-lightblue">
                    <ul>
                      <li>{!! $meta_tag !!}</li> 
                    </ul>
                  </div>
              </div>
            </div>
          </div>
        </div>

        <div class="content_box">
          
          <div class="head_box">
            <div class="title_">{!!  $postDetails->getData('post_title') !!}</div>
          </div>
          <div class="text_box">
            <p>{!! $postDetails->getData('description')  !!}</p>

<?php
/*
            <div class="moretext">
            <p>{!! $postDetails->getData('description')  !!}</p>
            </div>
            <a class="more  moreless-button" href="#" data-re-more="Read more" data-re-less="Read less">
                  <div class="line_box">
                    <span></span>
                    <span></span>
                  </div>
                  <span class="text_">{{lang('read_more')}}</span>
                </a>
*/?>
          </div>
          <div class="sharethis-inline-share-buttons"></div>
        </div>


      </div>
    </div>
  </section>
</main>


@stop
@section('scripts')
@parent
@include('frontend.script.inner_page_script')
<script>

  var maxLength = 100;
  var moretxt = "Read More";
  var lesstxt = "Read Less";
  var removeStr;
  var text = $('#post_desc').text();

  $("#post_desc").each(function() {



  var textlength = $(this).text().length;
  if (textlength > maxLength) {
    var myStr = $(this).text();
    var newStr = myStr.substring(0, maxLength);
    var removedStr = myStr.substring(1, maxLength);

    $(this).empty().html(newStr);
    $(this).append('<a class="more  moreless-button" href="#" data-re-more="' + moretxt + '" data-re-less="' + lesstxt + '"><div class="line_box"><span></span><span></span></div><span class="text_">' + moretxt + '</span></a>');
  } else {
    $(this).append('<a class="more  moreless-button" href="#" data-re-more="' + moretxt + '" data-re-less="' + lesstxt + '"><div class="line_box"><span></span><span></span></div><span class="text_">' + lesstxt + '</span></a>');
  }

});

$(".moreless-button").click(function() {
  if ($(this).hasClass("more")) {
    $(this).removeClass("more");
    $('#post_desc').empty();
    $('#post_desc').text(text);
  } else {
    $(this).addClass("more");
    $(this).text(moretxt);
    $(this).siblings(".moreless-button").hide();
  }
});

</script>
<script>
  $(function() {
    // read more button event
    //GAP.read_more_and_less();
  })
</script>
@stop

