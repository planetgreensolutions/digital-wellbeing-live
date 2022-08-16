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
				<h2 class="pageheader-title">New Guides And Tips
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
					
					<?php /* <section class="basic_settings">
								<div class="row"> 	
									<div class="col-sm-6 form-group">
										<label>Category</label>
										{!! $categoryDropDown !!}
									</div>
								</div>
							</section> */ ?>
							<section class="basic_settings">
								<div class="row"> 	
									<div class="col-sm-6 form-group">
										<label >Language</label>
										<select class="form-control" id="guide_lang" name="meta[text][guide_lang]">
										<option <?php echo ($postDetails->getData('guide_lang') == 'en' )?'selected =="selected"':""; ?> value="en">English</option>
										<option <?php echo ( $postDetails->getData('guide_lang') == 'ar' )?'selected =="selected"':''; ?> value="ar">Arabic</option>
										</select>
									</div>	
								</div>	 	
							
								<div class="row"> 	
									<div class="col-sm-6 form-group">
									{!! getSinglePlUploadControl('Upload Banner Image 500x500 (Max 2 MB) (jpg,jpeg) ','guides_tips_banner',['jpg','jpeg'],'image','Select File',null,null,@$postDetails->getData('guides_tips_banner'),$postType) !!}
								

									</div>
								</div>
								<div class="row"> 	
									<div class="col-sm-6 form-group">
										<label>Title</label>
										<input type="text" name="post[title]" id="post_title" class="form-control" placeholder="" dir="{{ ( $postDetails->getData('guide_lang') == 'ar' )?'rtl':'ltr' }}" value="{{ $postDetails->getData('post_title') }}"  required/>
										<input type="hidden" name="post[title_arabic]" id="post_title_arabic"  value="{{ $postDetails->getData('post_title') }}"  />
								
									</div>	
									
								</div>
								<div class="row"> 	
									<div class="col-sm-6 form-group">
										<label>Sub Title</label>
										<input type="text" name="meta[text][subtitle]" id="subtitle" class="form-control" dir="{{ ( $postDetails->getData('guide_lang') == 'ar' )?'rtl':'ltr' }}" placeholder="" value="{{ $postDetails->getData('subtitle') }}"  />
									</div>	
										
								</div>
								<?php /*
								<div class="row"> 	
									<div class="col-sm-6 form-group">
										<label>Excerpt</label>
										<textarea id="excerpt" name="meta[text][excerpt]" type="text"  class="form-control" dir="{{ ( $postDetails->getData('guide_lang') == 'ar' )?'rtl':'ltr' }}" >{{ $postDetails->getData('excerpt') }}</textarea>
									</div>	
									
								</div>*/ ?>
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
						
						<section class="basic_settings custom_section_block">
								<hr/>
								<div class="row"> 
									<div class="col-sm-12">											
										<label>Article Tags</label>
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
	
	@if($postDetails->getData('news_lang')=='en')
		PGSADMIN.configs.CKconfig.contentsLangDirection = 'ltr';
		PGSADMIN.configs.CKconfig.contentsLanguage = 'en';
		PGSADMIN.configs.CKconfig.language = 'en';
		$('.language').attr('dir','ltr');
	
	@else 
		PGSADMIN.configs.CKconfig.contentsLangDirection = 'rtl';
		PGSADMIN.configs.CKconfig.contentsLanguage = 'ar';
		PGSADMIN.configs.CKconfig.language = 'ar';
		$('.language').attr('dir','rtl');
	@endif
	
	CKEDITOR.instances['description'].destroy(true);
	CKEDITOR.replace( 'description', PGSADMIN.configs.CKconfig);
		
	$('#guide_lang').on('change',function(e){ 
		if($('#guide_lang option:selected').val() == 'ar'){
			PGSADMIN.configs.CKconfig.contentsLangDirection = 'rtl';
			PGSADMIN.configs.CKconfig.contentsLanguage = 'ar';
			PGSADMIN.configs.CKconfig.language = 'ar';
			$('.language').attr('dir','rtl');
		}else{
			PGSADMIN.configs.CKconfig.contentsLangDirection = 'ltr';
			PGSADMIN.configs.CKconfig.contentsLanguage = 'en';
			PGSADMIN.configs.CKconfig.language = 'en';
			$('.language').attr('dir','ltr');
		}
		CKEDITOR.instances['description'].destroy(true);
		CKEDITOR.replace( 'description', PGSADMIN.configs.CKconfig);

	});
});


</script>
@stop