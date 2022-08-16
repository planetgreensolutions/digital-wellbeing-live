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
				<h2 class="pageheader-title">New News And Opinions
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
						
							
							
							<section class="basic_settings">
							<div class="row"> 	
							   <div class="col-sm-6 form-group">
									<label >Language</label>
									<select class="form-control" id="news_lang" name="meta[text][news_lang]">
										<option <?php echo (  old('news_lang')  == 1 )?'selected =="selected"':""; ?> value="en">English</option>
										<option <?php echo ( old('news_lang') == 2 )?'selected =="selected"':''; ?> value="ar">Arabic</option>
									</select>								
								</div>	
								
								<div class="col-sm-6 form-group">
									<label>Main Category</label>
									<select class="form-control" id="resource_category_id" name="post[category_id]">
										@foreach($resourceSubCategoryList  as $rcSlist)
											<option  value="{{ $rcSlist->category_id }}" <?php echo ( old('category_id') == $rcSlist->category_id )?'selected =="selected"':""; ?>>{{ $rcSlist->category_title }}</option>
										@endforeach
									</select>
								</div>
																				
							<?php /*	<div class="col-sm-6 form-group">
									<label>News Category</label>
									
									
									<select class="form-control" id="news_category_id" name="post[category_id]">
										@foreach($NewsCategoryList as $nclist)
											<option  value="{{ $nclist->category_id }}">{{ $nclist->category_title }}</option>
										@endforeach
									</select>
								</div> */?>
							</div>	 
								<div class="row"> 	
									<div class="col-sm-6 form-group">
										<label>Upload Page Banner</label>
										{!! getSinglePlUploadControl('Upload Banner Image (Max 2 MB) (jpg,jpeg) 400*400 ','news_banner',['jpg','jpeg'],'image','Select File',null,null,@Input::old('meta')['text']['news_banner'],$postType) !!}
									</div>
								</div> 
								<div class="row"> 	
									<div class="col-sm-6 form-group">
										<label class="col-form-label" for="post_title">Title<em>*</em></label>
										<input type="text" name="post[title]" id="post_title" required="true" class="form-control language"  placeholder="" value="{{ old('post_title') }}" required />
										<input type="hidden" id="post_title_arabic" name="post[title_arabic]" id="title_arabic" class="form-control language"  placeholder="" value="{{ old('post_title') }}"  />
									</div>	
									<div class="col-sm-6 form-group">
										<label class="col-form-label" for="publish_date">Publish Date <em>*</em></label>
										<input type="text" name="meta[date][publish_date]" id="publish_date" required="true" class="form-control  datepicker" placeholder="" value="{{ old('publish_date') }}"  />
									</div>
									
								</div>
								<div class="row"> 	
									<div class="col-sm-12 form-group">
										<label>Sub Title</label>
										<input type="text" name="meta[text][subtitle]" id="subtitle" class="form-control language" placeholder="" value="{{ old('subtitle') }}"  />
									</div>	
									
								</div>
								<div class="row"> 	
									<div class="col-sm-12 form-group">
										<label>Excerpt</label>
										<textarea id="excerpt" name="meta[text][excerpt]" type="text"  class="form-control language" >{{ old('meta')['text']['excerpt'] }}</textarea>
									</div>	
									
								</div>
							</section>	
							<section class="basic_settings">
								<hr/>
								<div class="row"> 	
									
									<div class="col-sm-12 form-group">
										<label>Description</label>
										<textarea name="meta[text][description]" class="form-control language ckeditorEn" id="description" placeholder="" >{{ old('meta')['text']['description'] }}</textarea> 
									</div>
									
								</div>						
							</section>
							<?php /*
							<section class="basic_settings custom_section_block">
								<hr/>
								<div class="row"> 
									<div class="col-sm-12">											
										<label>Article Tags</label>
										<input type="text" name="post_tags" id="post_tags"  class="form-control" placeholder="" value="{{ old('post_tags') }}"  />												
									</div>
								</div>
							</section>
							*/ ?>					
							
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
	
	PGSADMIN.utils.copyData('#post_title','#post_title_arabic');
	
	$('#news_lang').on('change',function(e){
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

});
});



</script>


@stop

