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
			 				
				<li class="current">{{ lang('educators') }}</li>
			</ol>
		</div>
       <div class="title_box ">
         <h1 class="section-title txt-up " >
            <div class="title_wr">
               <span>{{ lang('educators') }}</span>
            </div>
         </h1>
      </div>
	  
	  <div class="educators_wrapper">

        <div class="edu-collpase-wraper">
            <ul class="collapsible">
			
			 @if(!empty($educatorIntro))
              <li class="active">
                <div class="collapsible-header">
                    <span class="c_icon"></span>
                    <h4>{{ lang('introduction') }}</h4>
                </div>
                <div class="collapsible-body">
                  <div class="inner_">
                    <div class="edu-text-box text_box">
                     
					   {!! $educatorIntro->getData('educatorsintro_intro') !!}
                    </div>

                    <div class="grid_shape ">
                          <div class="shape_ fill_blue">
                            <svg x="0px" y="0px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve" preserveAspectRatio="none">
                              <polygon points="30,30 0,30 0,0 27.447,4.787 "></polygon>
                            </svg>
                          </div>

                          <div class="img_box">
                            <div class="img_ b-lazy b-loaded" style="background-image: url({{ PP($educatorIntro->getData('eg_banner_image'))}});"></div>
                          </div>
                    </div>
                  </div>
                </div>
              </li>
			  @endif
			@if(!empty($educator_guides) && $educator_guides->count() > 0)
			@foreach($educator_guides as $pguides)
              <li class="">
                <div class="collapsible-header">
                    <span class="c_icon"></span>
                    <h4>{{ $pguides->getData('post_title')}}</h4>
                </div>
                <div class="collapsible-body">
                  <div class="inner_">
                    <div class="edu-text-box text_box">
                     {!! $pguides->getData('description') !!}
                    </div>

                    <div class="grid_shape ">
                          <div class="shape_ fill_blue">
                            <svg x="0px" y="0px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve" preserveAspectRatio="none">
                              <polygon points="30,30 0,30 0,0 27.447,4.787 "></polygon>
                            </svg>
                          </div>

                          <div class="img_box">
                            <div class="img_ b-lazy b-loaded" style="background-image: url({{ PP($pguides->getData('parentguide_banner'))}});"></div>
                          </div>
                    </div>
                  </div>
                </div>
              </li>
				@endforeach
					@endif

            
             
              
             
            </ul>
        </div>

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
   $(document).ready(function(){
            $('.collapsible').collapsible();
        });

  $(function() {
    // read more button event
    GAP.read_more_and_less();

    
    $('.tab_box').stickit({top : 100, screenMinWidth : 1024});
  })
</script>
@stop

