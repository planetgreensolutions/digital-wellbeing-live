<?php
$mainLogo = (($lang == 'en') ? @$websiteSettings->sitelogo_english : @$websiteSettings->sitelogo_arabic);
$subLogo = (($lang == 'en') ? @$websiteSettings->sublogo_english : @$websiteSettings->sublogo_arabic);
$changeLang = ($lang == 'ar') ? 'en' : 'ar';
?>
@extends('frontend.layouts.master')
@section('metatags')
	<meta name="description" content="{{{@$websiteSettings->site_meta_description}}}" />
	<meta name="keywords" content="{{{@$websiteSettings->site_meta_keyword}}}" />
	<meta name="author" content="{{{@$websiteSettings->site_meta_title}}}" />
@stop
@section('seoPageTitle')
	<title>
		{{ $home_page_title }}
	</title>
@stop
@section('styles')
@parent

@stop


@section('content')

@include('frontend.home.banner')
@include('frontend.home.digital_wellbeing')
@include('frontend.home.digital_citizenship')
@include('frontend.home.news')
@include('frontend.home.sannif_online')
@include('frontend.home.parent_guides')
@include('frontend.home.educator_guides')
@include('frontend.home.guides_tips')
@include('frontend.home.video_guides')
@include('frontend.home.resource_guides')
@include('frontend.home.social_feeds')
@include('frontend.home.partners')



@stop
@section('scripts')
@parent
@include('frontend.script.home_script')

<script>
	$(document).ready(function(){
		/* $('.YTPlayer').each(function(){

		}); */
	});
</script>
@stop