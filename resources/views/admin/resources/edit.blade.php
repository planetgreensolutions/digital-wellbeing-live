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
				<h2 class="pageheader-title">New Resources
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

								<label >Language</label>
								<select class="form-control" id="resource_lang" name="meta[text][resource_lang]">
									<option <?php echo ($postDetails->getData('resource_lang') == 'en' )?'selected =="selected"':""; ?> value="en">English</option>
									<option <?php echo ( $postDetails->getData('resource_lang') == 'ar' )?'selected =="selected"':''; ?> value="ar">Arabic</option>
								</select>
								
								</div>	
								</div>	
								<div class="row"> 	
									
										<div class="col-sm-6 form-group">
											<label>Main Category</label>
											
											
											<select class="form-control" id="resource_category_id" name="post[category_id]">
												@foreach($resourceSubCategoryList as $rcSlist)
													<option  value="{{ $rcSlist->category_id }}" <?php echo ( $postDetails->getData('post_category_id') == $rcSlist->category_id )?'selected =="selected"':""; ?>>{{ $rcSlist->category_title }}</option>
												@endforeach
											</select>
										</div>
								
									<div class="col-sm-6 form-group">
										<label>Sub Category</label>
										
										<select class="form-control" id="resource_sub_category_id" name="post[sub_category_id]">
												@foreach($resourceCategoryList as $rclist)
													<option  value="{{ $rclist->category_id }}" <?php echo ( $postDetails->getData('post_sub_category_id') == $rclist->category_id )?'selected =="selected"':""; ?>>{{ $rclist->category_title }}</option>
												@endforeach
										</select>
									</div>
								</div>
							</section>
							<section class="basic_settings">
								<div class="row"> 	
									<div class="col-sm-6 form-group">
									{!! getSinglePlUploadControl('Upload  Image 500x500 (Max 2 MB) (jpg,jpeg) ','resources_image',['jpg','jpeg'],'image','Select File',null,null,@$postDetails->getData('resources_image'),$postType) !!}
								

									</div>
								</div>
								<div class="row"> 	
									<div class="col-sm-6 form-group">
										<label>Title</label>
										<input type="text" name="post[title]" id="post_title" class="form-control" placeholder="" dir="{{ ( $postDetails->getData('resource_lang') == 'ar' )?'rtl':'ltr' }}" value="{{ $postDetails->getData('post_title') }}"  required/>
										<input type="hidden" name="post[title_arabic]" id="post_title_arabic" class="form-control" placeholder="" value="{{ $postDetails->getData('post_title') }}"  required/>
								
									
									</div>	
									
								</div>
								<div class="row"> 	
									<div class="col-sm-6 form-group">
										<label>Sub Title</label>
										<input type="text" name="meta[text][subtitle]" id="subtitle" class="form-control" placeholder="" dir="{{ ( $postDetails->getData('resource_lang') == 'ar' )?'rtl':'ltr' }}" value="{{ $postDetails->getData('subtitle') }}"  />
									</div>	
									
								</div>
								<div class="row"> 	
									<div class="col-sm-6 form-group">
										<label>Excerpt</label>
										<textarea id="excerpt" name="meta[text][excerpt]" type="text"  dir="{{ ( $postDetails->getData('resource_lang') == 'ar' )?'rtl':'ltr' }}" class="form-control" >{{ $postDetails->getData('excerpt') }}</textarea>
									</div>	
									
								</div>
								<div class="row"> 	
									<div class="col-sm-6 form-group">
										<label>Android Link</label>
										<input type="text" name="meta[text][android_link]" id="android_link" class="form-control" placeholder="" value="{{ $postDetails->getData('android_link') }}"  />
									</div>	
									<div class="col-sm-6 form-group">
										<label>Iphone Link</label>
										<input type="text" name="meta[text][iphone_link]" id="iphone_link" class="form-control" placeholder="" value="{{ $postDetails->getData('iphone_link') }}"  />
									</div>	
								</div>
								<div class="row"> 	
									<div class="col-sm-6 form-group">
										<label>Resource Link</label>
										<input type="url" name="meta[text][website_link]" id="website_link" class="form-control" placeholder="" value="{{ $postDetails->getData('website_link') }}"  />
									</div>	
									<div class="col-sm-6 form-group">
									{!! getSinglePlUploadControl('Upload Attachment  (Max 2 MB) (doc,docx,pdf) ','resources_file',['doc','docx','pdf'],'file','Select File',null,null,@$postDetails->getData('resources_file'),$postType) !!}
								

									</div>
								</div>
							</section>	
							
							
							
							<section class="basic_settings">
								<hr/>
								<div class="row"> 	
									
									<div class="col-sm-6 form-group">
										<label>Description</label>
										<textarea name="meta[text][description]" class="form-control ckeditorEn" id="description" placeholder="" >{{ $postDetails->getData('description') }}</textarea> 
									</div>
									
								</div>						
							</section>
					</div>
				</div>
			</div>
		</div>
		
								<hr/>
								<div class="row"> 
									<div class="col-sm-12">											
										<label> Tags</label>
										<?php 
											$postTags = [];
											if(!empty($postDetails->tags)){
												foreach($postDetails->tags as $sTag){
													if(isset($sTag->name)){
														$postTags[] = $sTag->name;
													}
												}
												
											}
										?>
										<input type="text" name="post_tags" id="post_tags"  class="form-control" placeholder="" value="{{ (old('post_tags'))?old('post_tags'):implode(',',$postTags) }}"  />												
									</div>
								</div>
							</section>
		
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
	
	PGSADMIN.utils.copyData('#post_title','#post_title_arabic');
	
});
</script>
@stop