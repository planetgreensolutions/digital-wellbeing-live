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
			<div class="page-header">
				<h2 class="pageheader-title">Educators Section Introduction</h2>
			</div>
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
										<input type="text" name="post[title_arabic]" id="post_title_arabic" dir="rtl" class="form-control" placeholder="" value="{{ $postDetails->getData('post_title_arabic') }}" required />
									</div>	
								</div>
							
							</section>	
							
							<section class="basic_settings">
								<hr/>
								<div class="row"> 	
									<div class="col-sm-6 form-group">
										{!! getSinglePlUploadControl('Upload Banner Image (Max 2 MB) (jpg,jpeg) 700x700','eg_banner_image',['jpg','jpeg'],'image','Select File',null,null,@$postDetails->getData('eg_banner_image'),$postType) !!}
									</div>
								</div>
								<div class="row"> 	
									
									<div class="col-sm-6 form-group">
										<label>Home Title</label>
										<input type="text" name="meta[text][eg_home_title]" class="form-control " id="eg_home_title" placeholder="" value="{{ $postDetails->getData('eg_home_title') }}" />
									</div>
									<div class="col-sm-6 form-group">
										<label>Home Title [Arabic]</label>
										<input type="text" name="meta[text][eg_home_title_arabic]" class="form-control " dir="rtl" id="eg_home_title_arabic" placeholder=""  value="{{ $postDetails->getData('eg_home_title_arabic') }}" />
									</div>	
								</div>						
							</section>	
							<section class="basic_settings">
								<hr/>
								<div class="row"> 	
									
									<div class="col-sm-6 form-group">
										<label>Landing Page Description</label>
										<textarea name="meta[text][landingpage_desc]" class="form-control ckeditorEn" id="landingpage_desc" placeholder="" >{{ $postDetails->getData('landingpage_desc') }}</textarea> 
									</div>
									<div class="col-sm-6 form-group">
										<label>Landing Page Description [Arabic]</label>
										<textarea name="meta[text][landingpage_desc_arabic]" class="form-control ckeditorAr" id="landingpage_desc_arabic" placeholder="" >{{ $postDetails->getData('landingpage_desc_arabic') }}</textarea> 
									</div>	
								</div>						
							</section>
							
							<section class="basic_settings">
								<hr/>
								<div class="row"> 	
									
									<div class="col-sm-6 form-group">
										<label>Educators Introduction</label>
										<textarea name="meta[text][educatorsintro_intro]" class="form-control ckeditorEn" id="educatorsintro_intro" placeholder="" >{{ $postDetails->getData('educatorsintro_intro') }}</textarea> 
									</div>
									<div class="col-sm-6 form-group">
										<label>Educators Introduction[Arabic]</label>
										<textarea name="meta[text][educatorsintro_intro_arabic]" class="form-control ckeditorAr" id="educatorsintro_intro_arabic" placeholder="" >{{ $postDetails->getData('educatorsintro_intro_arabic') }}</textarea> 
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
									<input type="number" min="1" name="post[priority]" id="post_priority"  class="form-control" placeholder="" value="{{ $postDetails->getData('post_priority')  }}"  required/>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="post_status" class="col-form-label">Status</label>
									<select class="form-control" id="post_status" name="post[status]">
										<option <?php echo ( $postDetails->getData('post_status') == 1 )?'selected =="selected"':""; ?> value="1">Publish</option>
										<option <?php echo ( $postDetails->getData('post_status') == 2 )?'selected =="selected"':''; ?> value="2">Unpublish</option>
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
<?php /*<script src="{{  asset('assets/admin/vendor/tagit/js/tag-it.min.js') }}" type="text/javascript"></script>*/ ?>
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