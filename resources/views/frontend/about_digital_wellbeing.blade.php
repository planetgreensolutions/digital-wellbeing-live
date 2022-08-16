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
				<li class="current">{{$about_digital_wellbeing->getData('post_title') }}</li>
				</ol>
			</div>
         <div class="normal_details_wrapper">
        <div class="side_box">
          
          <div class="inner_box">
            <div class="link_">
              <div class="shape_ fill_blue">
                <svg x="0px" y="0px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve"
                  preserveAspectRatio="none">
                  <polygon points="30,30 0,30 0,0 27.447,4.787 " />
                </svg>
              </div>

              <div class="img_box">
                <div class="img_ b-lazy" data-src="{{ PP($about_digital_wellbeing->getData('wellbeing_banner'))}}"></div>                
              </div>
            </div>
          </div>
        </div>

        <div class="content_box">
         
         
          <div class="title_box ">
          <h1 class="section-title txt-up" >
              <div class="title_wr">
                <span>{{$about_digital_wellbeing->getData('post_title') }}</span>
              </div>
          </h1>
        </div>
          <div class="text_box">
             {!!$about_digital_wellbeing->getData('description') !!}
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

