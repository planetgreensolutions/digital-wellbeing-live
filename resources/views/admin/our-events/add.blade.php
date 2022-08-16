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
				<h2 class="pageheader-title">New Events
					<a class="float-sm-right" href="{{ apa('category_manager/create') }}">
						<button class="btn btn-success btn-flat">Create New Category</button>
					</a>
				</h2>
			</div>
		</div>
	</div> 
	{{ Form::open(array('url' => array(apa('post/'.$postType.'/add')),'files'=>true,'id'=>'add-form')) }}
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
						
							
						<?PHP /*	<section class="basic_settings">
								<div class="row"> 	
									<div class="col-sm-6 form-group">
										<label>Category</label>
										{!! $categoryDropDown !!}
									</div>
								</div>
							</section> */?>
							<section class="basic_settings">
								<div class="row"> 	
									<div class="col-sm-6 form-group">
										<label>Upload </label>
										{!! getSinglePlUploadControl('Image (Max 2 MB) (jpg,jpeg) 500*500 ','events_image',['jpg','jpeg'],'image','Select File',null,null,@Input::old('meta')['text']['events_image'],$postType) !!}
									</div>
									<div class="col-sm-6 form-group">
									<label>Events Category</label>
									
									
									<select class="form-control" id="events_category_id" name="post[category_id]">
										@foreach($EventsCategoryList as $nclist)
											<option  value="{{ $nclist->category_id }}">{{ $nclist->category_title }}</option>
										@endforeach
									</select>
								</div>
								</div>
								<div class="row"> 	
									<div class="col-sm-6 form-group">
										<label>Title</label>
										<input type="text" name="post[title]" id="post_title" class="form-control" placeholder="" value="{{ old('post_title') }}"  required/>
									</div>	
									<div class="col-sm-6 form-group">
										<label>Title [Arabic]</label>
										<input type="text" name="post[title_arabic]" id="post_title_arabic" dir="rtl" class="form-control" placeholder="" value="{{ old('post_title_arabic') }}"  required/>
									</div>	
								</div>
								<div class="row"> 	
									<div class="col-sm-6 form-group">
										<label>Sub Title</label>
										<input type="text" name="meta[text][subtitle]" id="subtitle" class="form-control" placeholder="" value="{{ old('subtitle') }}"  />
									</div>	
									<div class="col-sm-6 form-group">
										<label>Sub Title</label>
										<input type="text" name="meta[text][subtitle_arabic]" id="subtitle_arabic" dir="rtl" class="form-control" placeholder="" value="{{ old('subtitle_arabic') }}"  />
									</div>	
								</div>
								<div class="row"> 	
									<div class="col-sm-6 form-group">
										<label>Publish Date</label>
										<input type="text" name="meta[date][publish_date]" id="publish_date" class="form-control datepicker" placeholder="" value="{{ old('meta')['publish_date'] }}"  />
									</div>	
									
								</div>
								<div class="row"> 	
									<div class="col-sm-6 form-group">
										<label>Excerpt</label>
										<textarea id="description" name="meta[text][excerpt]" type="text"  class="form-control" >{{ old('meta')['excerpt'] }}</textarea>
									</div>	
									<div class="col-sm-6 form-group">
										<label>Excerpt [Arabic]</label>
										<textarea id="description" name="meta[text][excerpt_arabic]" type="text"  dir="rtl" class="form-control" >{{ old('meta')['excerpt_arabic'] }}</textarea>
									</div>	
								</div>
							</section>	
							<section class="basic_settings">
								<hr/>
								<div class="row"> 	
									
									<div class="col-sm-6 form-group">
										<label>Description</label>
										<textarea name="meta[text][description]" class="form-control ckeditorEn" id="description" placeholder="" >{{ old('meta')['description'] }}</textarea> 
									</div>
									<div class="col-sm-6 form-group">
										<label>Description [Arabic]</label>
										<textarea name="meta[text][description_arabic]" class="form-control ckeditorAr" id="description_arabic" placeholder="" >{{ old('meta')['description_arabic'] }}</textarea> 
									</div>	
								</div>						
							</section>
							
												
						
					</div>
				</div>
			</div>
		</div>
		
		<section class="basic_settings custom_section_block">
								<hr/>
								<div class="row"> 
									<div class="col-sm-12">											
										<label>Tags</label>
										<input type="text" name="post_tags" id="post_tags"  class="form-control" placeholder="" value="{{ old('post_tags') }}"  />												
									</div>
								</div>
							</section>
		@include('admin.common.media_gallery',['post_type'=>$postType])
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="post_status" class="col-form-label">Display Priority</label>
									<input type="number" min="1" name="post[priority]" id="post_priority"  class="form-control" placeholder="" value="{{ old('post')['priority']  }}" required />
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="post_status" class="col-form-label">Status</label>
									<select class="form-control" id="post_status" name="post[status]">
										<option <?php echo ( Input::old('post')['status'] == 1 )?'selected =="selected"':""; ?> value="1">Publish</option>
										<option <?php echo ( Input::old('post')['status'] == 2 )?'selected =="selected"':''; ?> value="2">Unpublish</option>
									</select>
								</div>
							</div>	 
						</div>
						<div class="row">
							<div class="col-sm-12">
								<div class="button-control-wrapper">
									<div class="form-group">
										<input class="btn btn-primary" type="submit" name="btnsubmit" value="Save"  />
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
	PGSADMIN.utils.createAjaxFileUploader("{{ route('post_media_create',['slug'=>$postType]) }}" ,"{{ apa('post_media_download') }}/", "{{ asset('storage/app/public/post') }}/" );
	
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

