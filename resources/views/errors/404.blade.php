@extends('frontend.layouts.master')
	@section('seoPageTitle')
	<title>{{Lang::get('messages.page_not_found')}}</title>
	@stop
	@section('styles')
		@parent
		<style>
			.errorPage{text-align:center;margin-bottom:20px;padding-bottom:20px;}
			main#content {
				margin-top: 15%;
				min-height: 55vh;
			}
		</style>
	@stop
	@section('content')

		<main id="content">
				 <div id="content" style="pageContent dashboard">
					<div class="container">
						<div class="errorPage" >
							 <img  src="{{ asset('assets/frontend/error/'.$lang.'-404.jpg')}}" />						 
							 <div class="more-wrap">
								<a href="{{ asset('/') }}" class="more">{{ Lang::get('messages.home') }}</a>
							</div>
						</div>
					</div>
				</div>
			</section>
		</main>
			
		@stop
	
	@section('scripts')
	@parent
		<script>
			$(function(){
				$('body').removeClass('loading').addClass('is-loaded');
			})
		</script>

	@stop