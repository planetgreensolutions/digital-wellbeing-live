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
					<li><a href="{{ asset($lang.'/guides-tips')}}" class="homebrc">{{lang('guides_and_tips')}}</a></li>   				
					<li class="current">{!! $guides_and_tips_details->post_title !!}</li>
				</ol>
			</div>
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
                <div class="img_ b-lazy" data-src="{{ PP($guides_and_tips_details->getData('guides_tips_banner')) }}"></div>
                <div class="meta_tag color-lightblue">
                    <ul>
                    @foreach($guides_and_tips_details->tags as $tag) 

							<li>{{$tag->name}}</li>
						@endforeach
                    </ul>
                  </div>
              </div>
            </div>
          </div>
        </div>

        <div class="content_box">
          
          <div class="head_box">
            <div class="title_">{!! $guides_and_tips_details->post_title !!}</div>
          </div>
          <div class="text_box">
           {!! $guides_and_tips_details->getData('description')  !!}
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

@stop

