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
<main class="page digital_page">
	<section class="content-section">
		<div class="container">
			<div class="breadCrumbWrap ">
				<ol class="breadcrumb">
					<li><a href="{{ asset('/')}}" class="homebrc">{{lang('home')}}</a></li>            			 
					<li class="current">{!! lang('digital_domain') !!}</li> 
				</ol>
			</div>
			<div class="title_box ">
				<h1 class="section-title txt-up" data-number="{{ (!empty($digital_domainsList))?str_pad($digital_domainsList->count(),2,0, STR_PAD_LEFT):'' }}">
					<div class="title_wr">
					   {!! encloseWordSpan(lang('digital_domain')) !!}</span>
					</div>
				</h1>
			</div>
			<div class="issues_wrapper">
			   
				@php
				    $divClass="fill_blue";  
				    $divIndex=0;  
					$i=0;	  
					$itemArr=$digital_domainsList->chunk(2); 
                    $posArr=[[1,4],[2,3],[3,2],[4,1]];	
                    $posSt=0;					
				@endphp
				@foreach($itemArr as $key=>$ArrList)
					<div class="colum_ ">
					    @php $pos=0; @endphp
						@foreach($ArrList as $digitalDomain)
							@php $i++; @endphp
							<div class="issues_item">
								<a href="{{ asset($lang.'/digital-domains/'.$digitalDomain->post_slug.'?color='.$divClass) }}" class="inner_ s{{$posArr[$posSt][$pos]}}">
								  <div class="shape_ {{$divClass}}">
									<svg x="0px" y="0px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve"
									  preserveAspectRatio="none">
									  <polygon points="30,30 0,30 0,0 27.447,4.787 " />
									</svg>
								  </div>
								  <div class="img_box">
									<div class="img_ b-lazy" data-src="{{ PP($digitalDomain->getData('digital_domain_banner')) }}"></div>
									<div class="hover_box">
									  <div class="number_">{{ str_pad($i,2,0,STR_PAD_LEFT)}}</div>
									  <div class="title_">
										{!! encloseWordSpan( $digitalDomain->getData('post_title') ) !!}
									  </div>
									</div>
								  </div> 
								</a>
							</div>
							@if($divIndex%2==0)
						        @php $divClass=($divClass=="fill_lightblue")?"fill_blue":'fill_lightblue'; @endphp
					        @endif
							@php $divIndex++;$pos++; @endphp
						@endforeach
					</div>
					
					@php $posSt=($posSt===3)? 0 : $posSt+1;  @endphp
				@endforeach
			</div>
		</div>
	</section>
</main>
@stop
@section('scripts')
@parent
@include('frontend.script.inner_page_script')

@stop