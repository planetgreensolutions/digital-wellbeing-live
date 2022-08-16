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
 <style>
 .search_result_wrapper .not-found{
	 display: none;
    position: relative;
    left: 0;
    top: 0;
    width: 100%;
    min-height: 50vh;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    z-index: 10;
    background-color: #f3f3f3;
 }
 .search_result_wrapper .not-found .title_ {
    font-family: DCCAsh,Droid Arabic Kufi,sans-serif;
    font-size: 37.4px;
    font-size: 2.2rem;
    color: #000;
    position: relative;
    padding-bottom: 15px;
    opacity: .3;
}
 
 </style>
@stop

@section('content')

<main class="page">

  <section class="page-section">
    <div class="container">
	<div class="breadCrumbWrap ">
        <ol class="breadcrumb">
            <li><a href="{{ asset('/')}}" class="homebrc">{{lang('home')}}</a></li>            
             
            <li class="current">{{ lang('search') }}</li>
        </ol>
    </div>
       <div class="title_box text-center">
         <h1 class="section-title txt-up " >
            <div class="title_wr">
               <span>{{lang('search') }} </span>
            </div>
         </h1>
      </div>
      <div class="search_wrapper">

        <div class="search_form_box">
              {{Form::open(array('url'=>route('search',[$lang]), 'method'=>'GET') )}}
                  <div class="input_wrapper">
                      <input type="text" name="search" class="search-input" value="{{ $searchTerm }}"/> 
                      <button type="submit" class="s_btn">
                          <div class="icon icon-icon-search-icon"></div>
                      </button>
					  
                  </div>
            {{ Form::close() }}
          </div>


          <div class="search_result_wrapper">
			@if(!empty($searchList) && $searchList->count() > 0)
				@php $i= getPaginationSerial($searchList); @endphp
				@foreach($searchList as $slist)
					
						
						<div class="s_item">
							<a href="{{InnerLink($slist)}}" class="link_">
								<div class="number_">
									{{ str_pad($i,'2','0',STR_PAD_LEFT)}}
								</div>
								<div class="content_box">
									<div class="text_box">
										<p>{!! highlight_text($slist->getData('post_title'),$searchTerm) !!}</p>
									</div>
								</div>
							</a>
						</div>
						@php $i++; @endphp
					
					
				@endforeach
			@else
             <div class="not-found" >
						<div class="inner_ ">                             
						  <div class="title_">{{ lang('nothing_to_show') }}</div>
						</div>
					  </div>			
			@endif
			@if($searchList instanceof \Illuminate\Pagination\LengthAwarePaginator )
			<div class="pagination_wrapper ">							
				{!! $searchList->appends(Input::except('page'))->links() !!}
			</div>	
			@endif
			
			
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

