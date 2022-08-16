@extends('admin.layouts.master')
@section('styles')
@parent
{{ HTML::style('assets/admin/vendor/daterangepicker/daterangepicker.css') }}
{{ HTML::style('assets/admin/vendor/tagit/css/jquery.tagit.css') }}
{{ HTML::style('assets/admin/vendor/tagsinput/bootstrap-tagsinput.css') }}
<style>
#tips{display:none}
</style>
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
				<h2 class="pageheader-title">New Digital Domain
				<?php /*
					<a class="float-sm-right" href="{{ apa($postType.'/add') }}">
						<button class="btn btn-success btn-flat">Create New</button>
					</a>
				*/ ?>
				</h2>
			</div>
		</div>
	</div> 
	{{ Form::open(array('url' => array(apa('post/digital_domains/edit/'.$postDetails->getData('post_id'))),'files'=>true,'id'=>'add-form')) }}
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
										<label>Upload Home Banner</label>
										{!! getSinglePlUploadControl(' (500x500)(Max 2 MB) (jpg,jpeg) ','digital_domain_banner',['jpg','jpeg'],'image','Select File',null,null,@$postDetails->getData('digital_domain_banner'),$postType) !!}
									</div>
									<div class="col-sm-6 form-group">
										<label>Upload Page Banner</label>
										{!! getSinglePlUploadControl(' (1100x500)(Max 2 MB) (jpg,jpeg) ','digital_domain_banner_inner',['jpg','jpeg'],'image','Select File',null,null,@$postDetails->getData('digital_domain_banner_inner'),$postType) !!}
									</div>
								</div>
								<div class="row"> 	
									<div class="col-sm-6 form-group">
										<label>Title</label>
										<input type="text" name="post[title]" id="post_title" class="form-control" placeholder="" value="{{ $postDetails->getData('post_title') }}"  required/>
									</div>	
									<div class="col-sm-6 form-group">
										<label>Title [Arabic]</label>
										<input type="text" name="post[title_arabic]" id="post_title_arabic" dir="rtl" class="form-control" placeholder="" value="{{ $postDetails->getData('post_title_arabic') }}"  required/>
									</div>	
								</div>
								<div class="row"> 	
									<div class="col-sm-6 form-group">
										<label>Sub Title</label>
										<input type="text" name="meta[text][sub_title]" id="sub_title" class="form-control" placeholder="" value="{{ $postDetails->getData('sub_title') }}"  />
									</div>	
									<div class="col-sm-6 form-group">
										<label>Sub Title [Arabic]</label>
										<input type="text" name="meta[text][sub_title_arabic]" id="sub_title_arabic" dir="rtl" class="form-control" placeholder="" value="{{ $postDetails->getData('sub_title_arabic') }}"  />
									</div>	
								</div>
								<div class="row"> 	
									<div class="col-sm-6 form-group">
										<label>Excerpt</label>
										<textarea id="description" name="meta[text][excerpt]" type="text"  class="form-control" >{{ $postDetails->getData('excerpt') }}</textarea>
									</div>	
									<div class="col-sm-6 form-group">
										<label>Excerpt [Arabic]</label>
										<textarea id="description" name="meta[text][excerpt_arabic]" type="text"  dir="rtl" class="form-control" >{{ $postDetails->getData('excerpt_arabic') }}</textarea>
									</div>	
								</div>
							</section>	
							<section class="basic_settings">
								<hr/>
								<div class="row"> 	
									
									<div class="col-sm-6 form-group">
										<label>Learn It</label>
										<textarea name="meta[text][learnit]" class="form-control ckeditorEn" id="learnIt" placeholder="" >{{ $postDetails->getData('learnit') }}</textarea> 
									</div>
									<div class="col-sm-6 form-group">
										<label>Learn It [Arabic]</label>
										<textarea name="meta[text][learnit_arabic]" class="form-control ckeditorAr" id="learnItAr" placeholder="" >{{ $postDetails->getData('learnit_arabic') }}</textarea> 
									</div>	
								</div>						
							</section>
							<section class="basic_settings">
								<hr/>
								<div class="row"> 	
									
									<div class="col-sm-6 form-group">
										<label>Prevent It</label>
										<textarea name="meta[text][preventit]" class="form-control ckeditorEn" id="preventit" placeholder="" >{{ $postDetails->getData('preventit') }}</textarea> 
									</div>
									<div class="col-sm-6 form-group">
										<label>Prevent It [Arabic]</label>
										<textarea name="meta[text][preventit_arabic]" class="form-control ckeditorAr" id="preventitAr" placeholder="" >{{ $postDetails->getData('preventit_arabic') }}</textarea> 
									</div>	
								</div>						
							</section>	
							<section class="basic_settings">
								<hr/>
								<div class="row"> 	
									<div class="col-sm-6 form-group">
										<label>Act On It</label>
										<textarea name="meta[text][actonit]" class="form-control ckeditorEn" id="actonit" placeholder="" >{{ $postDetails->getData('actonit') }}</textarea> 
									</div>
									<div class="col-sm-6 form-group">
										<label>Act On It [Arabic]</label>
										<textarea name="meta[text][actonit_arabic]" class="form-control ckeditorAr" id="actonitAr" placeholder="" >{{ $postDetails->getData('actonit_arabic') }}</textarea> 
									</div>	
								</div>						
							</section>									
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
							
							
							</hr>
																
						
					</div>
				</div>
			</div>
		</div>
		
		@include('admin.common.media_gallery',['post_type'=>$postType])
		
		
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-sm-12">
								<h3>Tips</h3>
							</div>
						</div>
						<div class="row" id="tips">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="post_status" class="col-form-label">English Tip</label>
									<textarea name="postChild[title][] " class="form-control" id="tipEN" placeholder=""></textarea>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="post_status" class="col-form-label">Arabic Tip</label>
									<textarea name="postChild[title_arabic][] " dir="rtl" class="form-control" id="tipAR" placeholder=""></textarea>
								</div>
							</div>								 
						</div>
						<div id="tipResults">
							@if(isset($postDetails->childPosts))							
								@foreach($postDetails->childPosts as $childPost)
										<div class="row tipsWrapper">
											<div class="col-sm-6">
												<div class="form-group">
													<label for="post_status" class="col-form-label">English Tip</label>
													<textarea name="postChild[title][]" class="form-control ckeditorEn" placeholder="" >{{ $childPost->getData('post_title')  }}</textarea>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label for="post_status" class="col-form-label">Arabic Tip</label>
													<textarea min="1" name="postChild[title_arabic][]" dir="rtl" class="form-control ckeditorAr" placeholder="">{{ $childPost->getData('post_title_arabic')  }}</textarea>
												</div>
											</div>	
											<a class="deleteTip"><i class="fas fa-times"></i></a>
										</div>
								@endforeach
							@endif
						</div>
						
						<div class="row">
							<div class="col-sm-12">
								<div class="button-control-wrapper">
									<div class="form-group">
										<a href="#" class="btn btn-info" id="addTips" ><i class="fa fa-plus"></i> Add More</a>
									</div>
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
	
	
	$('#addTips').on('click' ,function(e) {
		e.preventDefault();
		var tips = $('#tips').clone(false);
		tips.removeAttr('id').addClass('tipsWrapper');
		tips.find('#tipEN').attr('id','ckeditor_'+PGSADMIN.utils.getRand()).addClass('ckeditorEn');
		tips.find('#tipAR').attr('id','ckeditor_'+PGSADMIN.utils.getRand()).addClass('ckeditorAr');
		tips.append('<a class="deleteTip"><i class="fas fa-times"></i></a>');
		$('#tipResults').append(tips);
		PGSADMIN.utils.createEnglishArticleEditor();
		PGSADMIN.utils.createArabicArticleEditor();	
		
	});
	
	$('#tipResults').on('click','.deleteTip' ,function(e) {
		$(this).closest('.tipsWrapper').remove();
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