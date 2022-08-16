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
				<h2 class="pageheader-title">New Youtube Gallery
				<?php /*
					<a class="float-sm-right" href="{{ apa('category_manager/create') }}">
						<button class="btn btn-success btn-flat">Create New Category</button>
					</a> */ ?>
				</h2>
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
										<input type="text" name="post[title]" id="post_title" class="form-control" placeholder="" value="{{ $postDetails->getData('post_title') }}"  />
									</div>	
									<div class="col-sm-6 form-group">
										<label>Title</label>
										<input type="text" name="post[title_arabic]" id="post_title_arabic" dir="rtl" class="form-control" placeholder="" value="{{ $postDetails->getData('post_title_arabic') }}"  />
									</div>
									<div class="col-sm-6 form-group">
										<label>Main Category</label>
										<select class="form-control" id="resource_category_id" name="post[category_id]">
											@foreach($resourceSubCategoryList  as $rcSlist)
												<option  value="{{ $rcSlist->category_id }}" <?php echo ( $postDetails->getData('post_category_id') == $rcSlist->category_id )?'selected =="selected"':""; ?>>{{ $rcSlist->category_title }}</option>
											@endforeach
										</select>
									</div>
									<div class="col-sm-6 form-group">
										<label for="display_on_home" class="col-form-label">Display on Homepage?<em>*</em></label>
										<select class="form-control" id="display_on_home" name="meta[text][display_on_home]" required>
											<option value="">Select Option</option>
											<option @if($postDetails->getData('display_on_home') == 'yes') selected @endif value="yes">Yes</option>
											<option @if($postDetails->getData('display_on_home') == 'no') selected @endif value="no">No</option>
										</select>
									</div>
								</div>
								
								
							</section>	
				
							@include('admin.common.video_gallery',['post_type'=>$postType])
							
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