@extends('admin.layouts.master')
@section('content')
@section('bodyClass')
@parent 
hold-transition skin-blue sidebar-mini
@stop
<div class="container-fluid dashboard-content">
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="page-header">
				<h2 class="pageheader-title">Category Manager
					<a class="float-sm-right" href="{{ apa('category_manager/create') }}">
						<button class="btn btn-success btn-flat">Create New</button>
					</a>
				</h2>
			</div>
		</div>
	</div> 
	
	<div class="row">
		<div class="col-sm-12">
			@include('admin.common.user_message')
		</div>
		<!-- ============================================================== -->
		<!-- striped table -->
		<!-- ============================================================== -->
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="card">
				<div class="col-sm-12 card-header my-table-header">
					<div class="row align-items-center">
						<div class="col-sm-6"><h5 class="">Add category</h5></div>
						<?php /*<div class="col-sm-6"><h5 class="text-right">Showing {{ $hubList->currentPage() }} of {{  $hubList->total() }} pages</h5></div> */ ?>
					</div>
				</div>
				<div class="card-body">
  						{{ Form::open(array('url' => apa('category_manager/create'),'files' => true,'role'=>'form','name'=>'CategoryCreate')) }}


	        				<div class="row">
								<div class="col-sm-6">
	        						<label>Parent Category</label>									
	        						{!! @$categoryDropDownHTML !!}
	        					</div>
							</div>
							
							<div class="row">

	        					<div class="col-sm-6">
	        						<label>Category Title</label>
	        						<input type="text" name="category_title"  value= "{{ Input::old('category_title') }}" class="form-control" placeholder=""   required />
	        					</div>
								
								<div class="col-sm-6">
	        						<label>Category Title [Arabic]</label>
	        						<input type="text" name="category_title_arabic"   dir="rtl" value= "{{ Input::old('category_title_arabic') }}" class="form-control" placeholder=""   required />
	        					</div>

	        					
	        				</div>
								<div class="row"> 	
									<div class="col-sm-6 form-group">
										<label>Upload Svg</label>
										{!! getNormalSinglePlUploadControl('Upload Banner Image (Max 2 MB) (svg) ','cat_image',['svg'],'image','Select File',null,null,@Input::old('cat_image'),null) !!}
									</div>
								</div>
        					<div class="row">
								<div class="col-sm-6">
	        						<label>Category Priority</label>
	        						<input type="number" name="category_priority"   value= "{{ Input::old('category_priority') }}" class="form-control" placeholder=""   required />
	        					</div>
        						<div class="col-sm-6">
        							<label>Status</label>
        							<select name="category_status" class="form-control">
        								<option value="1">Activate</option>
        								<option value="2">Deactivate</option>
        							</select>
        						</div>
        					</div>

        					<div class="row">
        						<div class="col-sm-6">
        							<div class="form-group"></div>
        							<div class="form-group">
        								<input type="submit" name="createbtnsubmit" value="Submit"  class="btn btn-success  btn-flat">
        								<a href="<?php echo apa('category_manager'); ?>" class="btn btn-danger  btn-flat">Close</a>
        							</div>
        						</div>
        					</div>
        			{{ Form::close() }}
  					</div>
			</div>
		</div>
	</div>
</div>
@stop

@section('scripts') 
@parent

<script>

$(document).ready(function() {	
	PGSADMIN.utils.createAjaxFileUploader("{{ route('post_media_create',['slug'=>'category']) }}" ,"{{ apa('post_media_download') }}/", "{{ asset('storage/app/public/post') }}/" );
	
	

});
</script>
@stop