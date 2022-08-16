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
				<h2 class="pageheader-title">New Blog
				<?php /*
					<a class="float-sm-right" href="{{ apa('category_manager/create') }}">
						<button class="btn btn-success btn-flat">Create New Category</button>
					</a> */ ?>
				</h2>
			</div>
		</div>
	</div> 
	{{ Form::open(array('url' => array(apa('post/'.$postType.'/add')),'files'=>true,'id'=>'post-form')) }}
		<input type="hidden" name="post[type]" value="{{$postType}}" />		
		<div class="row">
			<div class="col-sm-12 shamjas">
				@include('admin.common.user_message')
			</div>
			<!-- ============================================================== -->
			<!-- striped table -->
			<!-- ============================================================== -->
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="card">
					<div class="card-body">
						
							

								
								<div class="row"> 	
									<div class="col-sm-6 form-group">
										<label class="col-form-label" for="post_title">Title<em>*</em></label>
										<input type="text" name="post[title]" id="post_title" required="true" class="form-control"  placeholder="" value="{{ old('post_title') }}" required />
										
									</div>	
									
									<div class="col-sm-6 form-group">
										<label class="col-form-label" for="post_title">Title[Arabic]<em>*</em></label>
										<input type="text" name="post[title_arabic]" id="post_title_arabic" required="true" class="form-control "  placeholder="" value="{{ old('post_title_arabic') }}" required />
										
									</div>	
									
									
								</div>
								
								
								<div class="row"> 	
									
									<div class="col-sm-6 form-group">
										<label>Description</label>
										<textarea name="meta[text][description]" class="form-control  ckeditorEn" id="description" placeholder="" >{{ old('meta')['text']['description'] }}</textarea> 
									</div>
									
									<div class="col-sm-6 form-group">
										<label>Description[Arabic]</label>
										<textarea name="meta[text][description_arabic]" class="form-control  ckeditorEn" id="description_arabic" placeholder="" >{{ old('meta')['text']['description_arabic'] }}</textarea> 
									</div>
									
								</div>	

								<div class="row"> 	
									<div class="col-sm-6 form-group">
										<label>Tags</label>
										<input type="text" name="post_tags" id="post_tags"  class="form-control" placeholder="" value="{{ old('post_tags') }}"  />
										(Hit enter to add multiple tags)
									</div>	
										
								</div>								

								<div class="row"> 	
									<div class="col-sm-6 form-group">
										{!! getSinglePlUploadControl('Upload Image (Max 2 MB) (400x400) (jpg,jpeg,png) ','determination_blog_image',['jpg','jpeg','png'],'image','Select File',null,null,old('meta')['text']['determination_blog_image'],$postType) !!}
									</div>
								</div>	
								
				
							
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
									<input type="number" min="1" name="post[priority]" id="post_priority"  class="form-control" placeholder="" value="{{ old('post')['priority']  }}"  />
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
	
	//PGSADMIN.utils.copyData('#post_title','#post_title_arabic');
	
	/* $('#news_lang').on('change',function(e){
	if($('#news_lang option:selected').val() == 'ar'){
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

}); */
});



</script>




@stop

