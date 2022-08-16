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

      <div class="charter_wrapper">

        @if(!empty($postDetails) && $postDetails->count() > 0)
	<div class="count__"><span>{{$totalPledgers}}</span> {{lang('pledgers')}}</div>
        <div class="title_box with_tool">
           <h1 class="section-title txt-up text-center" >
              {!! $postDetails->getData('html_title') !!}
           </h1>
        </div>

        <div class="text-box text-center">
          {!! $postDetails->getData('description') !!}
        </div>
        @endif

        @if(!empty($pledge_list) && $pledge_list->count() > 0)
        <ul class="charter_list">
          @foreach($pledge_list as $item)
          <?php
$index = ($loop->index) + 1;
$x = $index < 10 ? "0" . $index : $index;
?>
          <li>
            <div class="no_">
              <span>{{$x}}</span>
            </div>
            <div class="para_">
              {!! $item->getData('html_title') !!}
            </div>
          </li>
          @endforeach
        </ul>
        @endif

        <div class="form_box">

                    {{Form::open([
                        'url' => route('submit-form', [$lang, 'formType' => 'charter-pledge']),
                        'class' => 'form-v3',
                        'id' => "charterPledgeForm"
                    ])}}
                    <div class="input_box">
                        <div class="col_box full_wd">
                          <div class="input-field ">
                            <input id="cpr_name" name="cpr_name" type="text" class="">
                            <label for="cpr_name" class="">{{lang('cp_name')}}</label>
                          </div>
                        </div>

                        <div class="col_box full_wd">
                          <div class="input-field ">
                            <input id="cpr_age" name="cpr_age" type="text" class="">
                            <label for="cpr_age" class="">{{lang('age')}}</label>
                          </div>
                        </div>

                        @if(!empty($countries))
                        <div class="col_box full_wd">
                          <div class="input-field ">
                            <select name="cpr_nationality" id="cpr_nationality">
                              @foreach($countries as $country)
                                <option value="{{$country->getId()}}">{{$country->getName()}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        @endif

                        <div class="col_box full_wd">
                          <div class="input-field ">
                            <input id="cpr_email_address" name="cpr_email_address" type="email" class="">
                            <label for="cpr_email_address" class="">{{lang('email_address')}}</label>
                          </div>
                        </div>

                         <div class="col_box full_wd">
                          <div class="input-field ">
                            <input id="cpr_email_address_confirmation" name="cpr_email_address_confirmation" type="email" class="">
                            <label for="cpr_email_address_confirmation" class="">{{lang('confirm_email_address')}}</label>
                          </div>
                        </div>

                        <div class="col_box full_wd">
                          <div class="term_">
                            <label>
                              <input id="cpr_is_agree" name="cpr_is_agree" type="checkbox" class="filled-in" />
                              <span>{{lang('agree_terms_and_condition')}}</span>
                            </label>
                          </div>
                        </div>

                        <div class="col_box full_wd">
                          <div class="input-field">
                              <div class="recaptcha" id="formCaptcha"></div>
                              <input type="hidden" class="hiddenCaptcha" name="hiddenRecaptcha">
                          </div>
                        </div>

                        <div class="col_box full_wd">
                            <div class="more-wrap">
                            <a id="cprSubmitBtn" style="cursor: pointer;" class="more " href="#">
                              <div class="line_box">
                                <span></span>
                                <span></span>
                              </div>
                              <span class="text_">{{lang('submit')}}</span>
                            </a>
                            <input type="submit" class="cprSubmit" style="display: none;" />

                          </div>
                        </div>

                    </div>


                    <div class="loader_box">
                      <div class="loader_wrapper">
                      <div class="circle bot"></div>
                      <div class="circle mid"></div>
                      <div class="circle top"></div>
                      </div>
                    </div>
                  {{Form::close()}}
        </div>
      </div>

    </div>
</section>

</main>

@stop
@section('scripts')
@parent
<script src="{{asset('assets/frontend/sweetalert2/sweetalert2.min.js')}}"  /></script>
@include('frontend.script.inner_page_script')
@include('frontend.script.charter_pledge_script')
@stop
