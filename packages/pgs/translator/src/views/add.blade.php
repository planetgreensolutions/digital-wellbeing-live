@extends('admin.layouts.master') 
@section('metatags')
<meta name="description" content="{{{@$websiteSettings->site_meta_description}}}" />
<meta name="keywords" content="{{{@$websiteSettings->site_meta_keyword}}}" />
<meta name="author" content="{{{@$websiteSettings->site_meta_title}}}" /> 
@stop 
@section('seoEventTitle')
<title>Add Policy</title>
@stop @section('styles') 
@parent 
{{ HTML::style('assets/admin/plugins/iCheck/square/blue.css') }} 
{{ HTML::style('assets/admin/dist/css/sweetalert.css') }} 
<style>
ul.EventCheckboxUL {
    list-style: none;
    padding: 0;
    margin: 0;
}
ul.EventCheckboxUL li{ padding:0 0 5px 0;font-weight:bold}
.errorInput{border:1px solid red;}
</style>
<style>
	#EventTypeLoader img{max-height: 24px; margin-left: 10px;}
	.manage ul{
		padding: 0 !important;
		display: inline-block;
	}
	.manage li{
		float: left;
		width: 50px;
	}
	.Event_meta{
		list-style-type: none;
		padding: 0;
	}
	.Event_meta > li:first-child {
		font-size: 15px;
		letter-spacing: 0.02em;
		font-weight: 600;
	}
	.Event_meta > li:last-child {
		margin-top: 8px;
	}
	.Event_meta > li:last-child {
		padding: 0;
	}
	.Event_meta > li:last-child .label{
		margin:0 2px;
		line-height: normal;
		padding: 0 10px;
	}
	.Event_meta > li:last-child .label:first-child{
		margin-left: 0px;
	}
	.Event_meta > li:last-child .label:last-child{
		margin-right: 0px;
	}
	.Event_meta > li .label{
		font-weight: normal;
		font-size: 12px;
	}
	label , input  {
	border-radius: 0 !important;
	}
  </style>
@stop 
@section('content') 
	@section('bodyClass') 
		@parent 
		hold-transition skin-blue sidebar-mini
	@stop
<aside class="right-side">
	<section class="content">
		<div class="box box-warning">
			<div class="box-header">
				<h3 class="col-sm-6 box-title">Create Translation</h3>
				<a class="pull-right" href="{{ route('translate_index') }}"><button class="btn btn-success btn-flat">View Translation List</button></a>
			</div>
			<!-- /.box-header -->
			<div class="box-body admin">
				<div class="col-sm-12">
					<p style="margin-top: 10px;" class="text-muted well well-sm no-shadow">
						NB: <em class="red">*</em> denoted fields are mandatory
					</p>
				</div>
				<div class="col-sm-12">
				@if (!empty($userMessage))
				<div>
					{!! $userMessage !!}
				</div>
				@endif
         
					{{ Form::open(['url'=>route('create_translation'),'id'=>'createEventForm']) }}
					<section class="basic_settings">
						@if(!empty($languages))
							<div class="row">
						
								<div class="col-sm-6">
									<label>Key<em class="red">*</em></label>
									<input type="text" name="key" value="{{ old('key') }}" class="form-control" placeholder="" />
								</div>
							
								<div class="col-sm-6">
									<label>Type<em class="red">*</em></label>
									<select name="type" class="form-control">
										<option value="messages">Messages</option>
										<option value="validation">Validation</option>
										<option value="months">Months</option>
									</select>
								</div>
							
							</div>
							<div class="row">
								@foreach($languages as $language)
											<?php $oldText = old('text'); ?>
											<div class="col-sm-6">
												<label> {{ $language->name }} Text<em class="red">*</em></label>
												<input type="text" name="text[{{ $language->locale }}]" dir="{{ ($language->locale == 'ar') ? 'rtl' : 'ltr' }}" value="{{ $oldText[$language->locale] }}" class="form-control " placeholder="" />
											</div>
								
									
								@endforeach
							</div>
						@endif
						
					</section>
					<div class="form-group"></div>
					<div class="form-group">
						<input type="submit" name="createbtnsubmit" id="createbtnsubmit" value="Publish" class="btn btn-success btn-flat">
						<a href="{{ route('translate_index') }}" class="btn btn-danger  btn-flat">Close</a>
					</div>
					{{ Form::close() }}
				</div>
				<!-- /.col-sm-12 -->
			</div>
			<!-- /.box-body -->
		</div>
	</section>
	<!-- /.content -->
</aside>
@stop
@section('styles')
@parent
@stop
@section('scripts') 
@parent
<script src="<?php echo asset('assets/admin/plugins/flatdatetimepicker/flatpickr.min.js'); ?>" type="text/javascript"></script>
<script>
	$(function(){
		$('.datetimepicker').datetimepicker({
			format:"DD-MM-YYYY hh:mm A",
		});
	});
	
</script>
@stop