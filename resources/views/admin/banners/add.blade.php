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
                <h2 class="pageheader-title">Add Banner
				<?php /*<a class="float-sm-right" href="{{ apa('') }}"><button class="btn btn-outline-dark btn-flat">Back To List</button></a></h2> */ ?>
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
                
                {{ Form::open(array('url' => route('post_create',$postType),'files'=>true,'id'=>'post-form')) }}
				 <input type="hidden" name="post[type]" value="{{$postType}}" />		
                    <div class="card-body">
                        <div class="col-sm-12">
                            @include('admin.common.user_message')
                            <div class="clearfix"></div>
							<?php /*	<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
										 <label for="title" class="col-form-label">Select Link to go</label>
											<select class="form-control custom-select" name="post[parent_id]"  >
											<option value="">--Select One--</option>

											@foreach($allPost as $key=>$postL)
											<optgroup label="{{ $key}}">
											@foreach($postL as $post)
											<option value="{{ $post->post_id}}">{{ $post->post_title}}</option>
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
                                            <label for="title" class="col-form-label">Title<em>*</em></label>
                                            <input id="title" name="post[title]" type="text" value="{{ Input::old('post')['title'] }}" class="form-control" required>
                                        </div>
                                    </div>
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="title" class="col-form-label">Title [Arabic]<em>*</em></label>
                                            <input id="title" name="post[title_arabic]" type="text" value="{{ Input::old('post')['title_arabic'] }}" class="form-control" dir="rtl" required>
                                        </div>
                                    </div>
                                   
                                </div>
								<div class="row">	
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="banner_title" class="col-form-label">Banner Sub Title <em>*</em></label>
                                            <input id="banner_title" name="meta[text][banner_title]" type="text" value="{{ @Input::old('meta')['banner_title'] }}" class="form-control editor" >
                                        </div>
                                    </div>
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="banner_title_arabic" class="col-form-label">Banner Sub Title [Arabic]<em>*</em></label>
                                            <input id="banner_title_arabic" name="meta[text][banner_title_arabic]" type="text" value="{{ @Input::old('meta')['banner_title_arabic'] }}" class="form-control editorAr"   >
                                        </div>
                                    </div>
								</div>
								
								
                                 
                           
                             <?php /*   <div class="row">
									<div class="col-sm-6  fl fl-wrap fileUploadWrapper form-group">
										{!! getSinglePlUploadControl('Upload Main Image (1487x923) (Max 2 MB)  (jpg,jpeg) ','banner_image',['jpg','jpeg'],'image','Select File',null,null,@Input::old('meta')['text']['banner_image'],$postType,1487,923) !!}
									</div>
									
									 <div class="col-sm-6  fl fl-wrap fileUploadWrapper form-group">
										{!! getMultiPlUploadControl('Upload Main Image (1487x923) (Max 2 MB)  (jpg,jpeg) ','gallery',['jpg','jpeg'],'image','Select File',null,null,@Input::old('meta')['text']['gallery'],$postType,1487,923) !!}
									</div>
									
								</div> */?>
								<div class="row">
								     <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="post_priority" class="col-form-label">Priority</label>
                                            <input id="post_priority"  name="post[priority]" value="{{ Input::old('post')['priority'] }}" type="number" class="form-control hostBtnInputs"  required />
                                        </div>
                                    </div> 
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="post_status" class="col-form-label">Status</label>
                                            <select class="form-control" id="post_status" name="post[status]">
                                                <option <?php echo ( @Input::old('post')['status'] == 1 )?'selected =="selected"':""; ?> value="1">Publish</option>
                                                <option <?php echo ( @Input::old('post')['status'] == 2 )?'selected =="selected"':''; ?> value="2">Unpublish</option>
                                            </select>
                                        </div>
                                    </div>	 
								</div>
                        </div>
                    </div>
                    <div id="galleryWrapper" class="myFileLister"></div>
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