@extends('admin.layouts.master')
@section('styles')
@parent
{{ HTML::style('assets/admin/vendor/daterangepicker/daterangepicker.css') }}
{{ HTML::style('assets/admin/vendor/tagit/css/jquery.tagit.css') }}
{{ HTML::style('assets/admin/vendor/tagsinput/bootstrap-tagsinput.css') }}
@stop
@section('content')
@section('bodyClass')
@parent
hold-transition skin-blue sidebar-mini
@stop
<div class="container-fluid dashboard-content">
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
		<h2 class="pageheader-title">Charter Pledge - Banner</h2>
		</div>
	</div>
	{{ Form::open(array('url' => array(apa('post/'.$postType.'/edit/'.$postDetails->getData('post_id'))),'files'=>true,'id'=>'add-form')) }}
		<input type="hidden" name="post[type]" value="{{$postType}}" />
		<div class="row">
			<div class="col-sm-12">
				@include('admin.common.user_message')
			</div>
			<!-- ============================================================== -->
			<!-- striped table -->
			<!-- ============================================================== -->
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="card">
					<div class="card-body">
							<section class="basic_settings">
								<div class="row">
									<div class="col-sm-6 form-group">
										<label>Title</label>
										<input type="text" name="post[title]" id="post_title" class="form-control" placeholder="" value="{{ $postDetails->getData('post_title') }}"  required/>
									</div>
									<div class="col-sm-6 form-group">
										<label>Title</label>
										<input type="text" name="post[title_arabic]" id="post_title_arabic" dir="rtl" class="form-control" placeholder="" value="{{ $postDetails->getData('post_title_arabic') }}"  required/>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6 form-group">
										<label>HTML Title</label>
										<textarea id="html_title" name="meta[largetext][html_title]" type="text"  class="form-control ckeditorEn" >{{ $postDetails->getMeta('html_title') }}</textarea>
									</div>
									<div class="col-sm-6 form-group">
										<label>HTML Title [Arabic]</label>
										<textarea id="html_title_arabic" name="meta[largetext][html_title_arabic]" type="text"  dir="rtl" class="form-control ckeditorAr" >{{ $postDetails->getMeta('html_title_arabic') }}</textarea>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6 form-group">
										<label>Description</label>
										<textarea id="description" name="meta[largetext][description]" type="text"  class="form-control ckeditorEn" >{{ $postDetails->getMeta('description') }}</textarea>
									</div>
									<div class="col-sm-6 form-group">
										<label>Description [Arabic]</label>
										<textarea id="description_arabic" name="meta[largetext][description_arabic]" type="text"  dir="rtl" class="form-control ckeditorAr" >{{ $postDetails->getMeta('description_arabic') }}</textarea>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6 form-group">
										<label>Pop up Message</label>
										<textarea id="popup_msg" name="meta[largetext][popup_msg]" type="text"  class="form-control ckeditorEn" >{{ $postDetails->getMeta('popup_msg') }}</textarea>
									</div>
									<div class="col-sm-6 form-group">
										<label>Pop up Message [Arabic]</label>
										<textarea id="popup_msg_arabic" name="meta[largetext][popup_msg_arabic]" type="text"  dir="rtl" class="form-control ckeditorAr" >{{ $postDetails->getMeta('popup_msg_arabic') }}</textarea>
									</div>
								</div>
							</section>
					</div>
				</div>
			</div>
		</div>

		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="post_status" class="col-form-label">Display Priority</label>
									<input type="number" min="1" name="post[priority]" id="post_priority"  class="form-control" placeholder="" value="{{ $postDetails->getData('post_priority')  }}"  />
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="post_status" class="col-form-label">Status</label>
									<select class="form-control" id="post_status" name="post[status]">
										<option <?php echo ($postDetails->getData('post_status') == 1) ? 'selected =="selected"' : ""; ?> value="1">Publish</option>
										<option <?php echo ($postDetails->getData('post_status') == 2) ? 'selected =="selected"' : ''; ?> value="2">Unpublish</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<div class="button-control-wrapper">
									<div class="form-group">
										<input class="btn btn-primary" type="submit" name="updatebtnsubmit" value="Save"  />
										<a href="{{ route('post_index',$postType) }}" class="btn btn-danger">Close</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
		</div>
	{{ Form::close() }}
</div>
@stop

@section('scripts')
@parent
<?php /*<script src="{{  asset('assets/admin/vendor/tagit/js/tag-it.min.js') }}" type="text/javascript"></script>*/?>
<script src="{{  asset('assets/admin/vendor/tagsinput/bootstrap-tagsinput.min.js') }}" type="text/javascript"></script>
<script src="{{  asset('assets/editor/full/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
<script>

$(document).ready(function() {
	PGSADMIN.utils.createEnglishArticleEditor();
	PGSADMIN.utils.createArabicArticleEditor();
	PGSADMIN.utils.createMediaUploader("{{ route('post_media_create',['slug'=>$postType]) }}","#galleryWrapper" ,"{{ apa('post_media_download') }}/", "{{ asset('storage/app/public/post') }}/" );
	PGSADMIN.utils.createAjaxFileUploader("{{ route('post_media_create',['slug'=>$postType]) }}" ,"{{ apa('post_media_download') }}/", "{{ asset('storage/app/public/post/') }}/" );

	PGSADMIN.utils.youtubeVideoThumbUploader('changeImage',"{{ route('post_media_create',['slug'=>$postType]) }}", "{{ asset('storage/app/public/post/') }}/","#galleryWrapper");

	$('#post_tags').tagsinput({
		confirmKeys: [13, 188]
	});

	$('body').on('keydown','.bootstrap-tagsinput input' ,function(e) {
		var keyCode = e.keyCode || e.which;
		if (keyCode === 9 || keyCode === 13 ) {
			e.preventDefault();
			$("#post_tags").tagsinput('add',$(this).val());
			$(this).val('');
			return false;
		}
	});

});
</script>
@stop