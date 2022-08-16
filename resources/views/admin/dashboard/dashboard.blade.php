@extends('admin.layouts.master')
@section('metatags')
	<meta name="description" content="{{{@$websiteSettings->site_meta_description}}}" />
	<meta name="keywords" content="{{{@$websiteSettings->site_meta_keyword}}}" />
	<meta name="author" content="{{@$websiteSettings->site_meta_title}}" />

@stop
@section('seoPageTitle')
 <title>{{{ $pageTitle }}}</title>
@stop
@section('styles')
@parent
<style>
#view-selector-container{
	display:none;
}	

.anchorWhite{
	color:#fff !important;
}
.anchorWhite:hover{
	color:#00000057 !important;
}
</style>
<link href="{{ asset('/assets/admin/vendor/apexchart/apexcharts.css') }}" rel="stylesheet" />
@stop

@section('content')
  @section('bodyClass')
    @parent
    hold-transition skin-blue sidebar-mini
  @stop
  
     <div class="container-fluid dashboard-content">           
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="page-header">
					<h2 class="pageheader-title">{{ lang('dashboard') }} - {{ date('d M, Y') }}</h2>
				</div>
				@if(!empty($userMessage))
					{!! $userMessage !!}
				@endif
			</div>
		</div>
	
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="card">
					<h5 class="card-header">{{@$websiteSettings->site_meta_title}}</h5>
					<div class="card-body">
						
					</div>
				</div>
			</div>
		</div>
		<div class="row">
		       @if(!empty($digital_domain_count))
				<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
					<div class="card">
						<div class="card-body">
							<h5 class="text-muted">Total Digital Domain</h5>
							<div class="metric-value d-inline-block">
								<h1 class="mb-1">{{$digital_domain_count}}</h1>
							</div>
							<div class="metric-label d-inline-block float-right text-success font-weight-bold">
								<a href="{{route('post_index',['digital_domains'])}}">View</a>
							</div>
						</div>
					</div>
				</div>
				@endif
				@if(!empty($resource_count))
				<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
					<div class="card">
					<div class="card-body">
						<h5 class="text-muted">Total Resource Count</h5>
						<div class="metric-value d-inline-block">
							<h1 class="mb-1">{{$resource_count}}</h1>
						</div>
						<div class="metric-label d-inline-block float-right text-success font-weight-bold">
							<a href="{{route('post_index',['resources'])}}">View</a>
						</div>
					</div>
					</div>
				</div>
				@endif
				
				
			</div>
		
		
     </div>
     
@stop

@section('scripts')
@parent	
 
 
 <script>
    $(document).ready(function(){
		
    });
 </script>
 @stop