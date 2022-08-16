@extends('admin.layouts.master')
@section('styles')
@parent
<style>

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
                <h2 class="pageheader-title">Edit Banner
				<?php /*<a class="float-sm-right" href="{{ apa('banner') }}"><button class="btn btn-outline-dark btn-flat">Add New</button></a></h2> */ ?>
            </div>
        </div>
    </div>  
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="col-sm-12 card-header form-header">
                    <div class="row align-items-center">
						<h5>Fields marked (<em>*</em>) Are mandatory</h5> 
                    </div>
                </div>

                {{ Form::open(array('url' => route('post_edit',[$postType,$postDetails->post_id]),'files'=>true,'id'=>'post-form')) }}
				<input type="hidden" name="post[type]" value="{{$postType}}" />	
                    <div class="card-body">
                        <div class="col-sm-12">
                            @include('admin.common.user_message')
                            <div class="clearfix"></div>
                          	<?php /*  <div class="row">
									<div class="col-sm-6">
										<div class="form-group">
										 <label for="title" class="col-form-label">Select Link to go</label>
											<select class="form-control custom-select" name="post[parent_id]"  >
											<option value="">--Select One--</option>

											@foreach($allPost as $key=>$postL)
											<optgroup label="{{ $key}}">
											@foreach($postL as $post)
											<option value="{{ $post->post_id}}" {{ ($postDetails->post_parent_id==$post->post_id)?'selected':''}}>{{ $post->post_title}}</option>
											@endforeach
											</optgroup>
											@endforeach
											</select>
										</div>
									</div>
								</div> */?>
                                 <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="banner_title" class="col-form-label">Banner Title<em>*</em></label>
                                            <input id="banner_title" name="post[title]" type="text" value="{{ $postDetails->post_title }}" class="form-control" required>
                                        </div>
                                    </div>
									 <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="banner_title" class="col-form-label">Banner Title [Arabic]<em>*</em></label>
                                            <input id="banner_title" name="post[title_arabic]" type="text" value="{{ $postDetails->post_title_arabic }}" class="form-control" dir="rtl" required>
                                        </div>
                                    </div>
									
									
                                 </div>
								<div class="row">	
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="banner_title" class="col-form-label">Banner Sub Title <em>*</em></label>
                                            <input id="banner_title" name="meta[text][banner_title]" type="text" value="{{ $postDetails->getMeta('banner_title') }}" class="form-control " >
                                        </div>
                                    </div>
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="banner_title_arabic" class="col-form-label">Banner Sub Title [Arabic]<em>*</em></label>
                                            <input id="banner_title_arabic" name="meta[text][banner_title_arabic]" type="text" value="{{ $postDetails->getMeta('banner_title_arabic') }}" dir="rtl" class="form-control "   >
                                        </div>
                                    </div>
								</div>
								
                                 
								<?php /* <div class="row">
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="banner_video" class="col-form-label">Banner Video URL (Youtube URL)</label>
                                            <input id="banner_video" name="meta[text][banner_video]" type="text" value="{{  $postDetails->getMeta('banner_video') }}" class="form-control" >
                                        </div>
                                    </div>
								</div>
								 <div class="row">
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-group">
                                            <label for="banner_date" class="col-form-label">Banner Date</label>
                                            <input id="banner_date" name="meta[date][banner_date]" type="text" value="{{ formateDatePicker($postDetails->getMeta('banner_date')) }}" class="form-control datepicker" >
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                 
                                <div class="row">
									<div class="col-sm-6  fl fl-wrap fileUploadWrapper form-group">
										{!! getSinglePlUploadControl('Upload Banner Image (1487x923) (Max 2 MB)  (jpg,jpeg) ','banner_image',['jpeg','jpg'],'image','Select File',null,null,$postDetails->getMeta('banner_image'),$postType,1487,923) !!}
									</div>
									 <div class="col-sm-6  fl fl-wrap fileUploadWrapper form-group">
										{!! getMultiPlUploadControl('Upload Main Image (1487x923) (Max 2 MB)  (jpg,jpeg) ','gallery',['jpg','jpeg'],'image','Select File',null,null,$postDetails->getMeta('gallery'),$postType,1487,923) !!}
									</div>
								</div>*/?>
								<div class="row">
								     <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="post_priority" class="col-form-label">Priority</label>
                                            <input id="post_priority"  name="post[priority]" value="{{  $postDetails->post_priority }}" type="number" class="form-control hostBtnInputs" required />
                                        </div>
                                    </div> 
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="post_status" class="col-form-label">Status</label>
                                            <select class="form-control" id="post_status" name="post[status]">
                                                <option <?php echo ( $postDetails->post_status == 1 )?'selected =="selected"':""; ?> value="1">Publish</option>
                                                <option <?php echo ( $postDetails->post_status == 2 )?'selected =="selected"':''; ?> value="2">Unpublish</option>
                                            </select>
                                        </div>
                                    </div>	 
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
                {{ Form::close() }}
            </div>
        </div>
    </div>
 </div>  
@stop

@section('scripts')
@parent
<script>
 $(document).ready(function(){
	 createAjaxFileUploader("{{ route('post_media_create',['slug'=>'banners'])}}");
	 //createAjaxMultiFileUploader("{{ route('post_media_create',['slug'=>'banners'])}}","#galleryWrapper");
    $('#post-form').validate();
 });
</script>

@stop