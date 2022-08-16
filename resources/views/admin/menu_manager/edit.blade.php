@extends('admin.layouts.master')
@section('styles')
@parent
<style>
 .trdisabled{ color:#b5b5b5}
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
                <h2 class="pageheader-title">Edit
					<a class="float-sm-right btn btn-outline-dark btn-flat" href="{{ route('menu_manager') }}"><span>Back</span></a></h2>
            </div>
        </div>
    </div>  
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="col-sm-12 card-header form-header">
                    <div class="row align-items-center">
                        <h5>Fields marked (<em>*</em> ) are mandatory</h5> 
                    </div>
                </div>
                
				{{ Form::open(array('url' => route('edit_menu',$menuDetails->mm_id),'files'=>true)) }}										
				<div class="card-body">
					 <div class="col-sm-12">
                            @include('admin.common.user_message')
							<section class="">
								<div class="row"> 	
									<div class="col-sm-12 form-group">
										<label>Parent Menu<em class="red">*</em></label>
										{!! $menuList !!}
									</div>
								</div>
								<div class="row"> 	
									<div class="col-sm-6 form-group">
										<label>Menu Name<em class="red">*</em></label>
										<input type="text" name="mm_title" class="form-control" placeholder="" value="{{ $menuDetails->mm_title }}"  required /> 
									</div>	
									
									<div class="col-sm-6 form-group">
										<label>Menu Name [Arabic]<em class="red">*</em></label>
										<input type="text" name="mm_title_arabic" class="form-control" placeholder="" value="{{ $menuDetails->mm_title_arabic }}"  dir="rtl" required /> 
									</div>
								</div>
								<div class="row"> 	
									<div class="col-sm-6 form-group">
										<label>Menu Large Name</label>
										<input type="text" name="mm_large_title" class="form-control" placeholder="" value="{{ $menuDetails->mm_large_title }}"  /> 
									</div>	
									
									<div class="col-sm-6 form-group">
										<label>Menu Large Name [Arabic]</label>
										<input type="text" name="mm_large_title_arabic" class="form-control" placeholder="" value="{{ $menuDetails->mm_large_title_arabic }}"  dir="rtl"/> 
									</div>
								</div>
									
								
								<div class="row"> 	
									<div class="col-sm-6 form-group">
										<label>Menu Icon Class</label>
										<input type="text" name="mm_icon_class" class="form-control" placeholder="" value="{{ $menuDetails->mm_icon_class }}"  /> 
									</div>	
									
									<div class="col-sm-4 form-group">
										<label>Menu Icon [svg,png]</label>
										<input type="file" name="mm_icon_file" class="form-control" placeholder="" value=""  /> 
									</div>	
									<div class="col-sm-2 form-group">
									@if(!empty($menuDetails->mm_icon_file))
										<br/>
										<img style="padding:2px; margin-top:10px;" width = "35px" src="{{ asset('storage/app/public/uploads/menu/'.$menuDetails->mm_icon_file) }}" />
									@endif
									</div>
								</div>
									
								
								
							</section>
							<section class="basic_settings">
								<h3>Menu Settings</h3>
								<div class="row"> 	
									<div class="col-sm-6"> 	
										<table class="table table-striped table-bordered">
											<thead>
												<tr>
													<th style="width: 10px;text-align:center">Select</th>
													<th>Setting</th>
												</tr>
											</thead>
											<tbody>
												<tr>
												   <td class="text-center">
														{{ Form::checkbox('mm_show_in_main_menu',  1 , ($menuDetails->mm_show_in_main_menu == 1)) }}
												   </td>
												   <td>
													   {{ Form::label('mm_show_in_main_menu', 'Show in main menu') }}<br>
												   </td>
												   
												</tr>
												<tr>
												   <td class="text-center">
														{{ Form::checkbox('mm_show_in_footer_menu',  1 , ($menuDetails->mm_show_in_footer_menu == 1) ) }}
												   </td>
												   <td>
													   {{ Form::label('mm_show_in_footer_menu', 'Show in footer menu') }}<br>
												   </td>
												</tr>
												 
												<tr>
												   <td class="text-center">
														{{ Form::checkbox('mm_show_in_mobile_menu',  1 , ($menuDetails->mm_show_in_mobile_menu == 1) ) }}
												   </td>
												   <td>
													   {{ Form::label('mm_show_in_mobile_menu', 'Show in mobile menu') }}<br>
												   </td>
												</tr>
												<tr>
												   <td class="text-center">
														{{ Form::checkbox('mm_is_hash_link',  1 , ($menuDetails->mm_is_hash_link == 1), ['id'=>'fullHash']) }}
												   </td>
												   <td>
													   {{ Form::label('mm_is_hash_link', 'Set hash link') }}<br>
												   </td>
												</tr>
												<tr id="homeHashTR">
												   <td class="text-center">
														{{ Form::checkbox('mm_is_hash_link_in_home_only',  1 ,($menuDetails->mm_is_hash_link_in_home_only == 1),['id'=>'homehash']) }}
												   </td>
												   <td>
													   {{ Form::label('mm_is_hash_link_in_home_only', 'Show hash link in home only') }}<br>
												   </td>
												</tr>
												<tr id="mmTop_menu">
												   <td class="text-center">
														{{ Form::checkbox('mm_top_menu',  1 ,($menuDetails->mm_top_menu == 1),['id'=>'topmenu']) }}
												   </td>
												   <td>
													   {{ Form::label('mm_top_menu', 'Show menu in top only') }}<br>
												   </td>
												</tr>
											</tbody>
										 </table>
									</div>
								</div>
							</section>
							<section class="basic_settings">					
								<div class="row"> 
									 <div class="col-sm-6 form-group">
										<label>Menu Display Priority</label>
										<input type="number" name="mm_priority" class="form-control" placeholder="" value="{{ $menuDetails->mm_priority  }}"  min="1" /> 
									</div>	
									<div class="col-sm-6 form-group">
										<label>Status<em class="red">*</em></label>
										<select name="mm_status" class="form-control">
										  <option value="1" {!! ($menuDetails->mm_status == '1' ) ? 'selected="selected"' : '' !!}>Activate</option>
										  <option value="2" {!! ($menuDetails->mm_status  == '2' ) ? 'selected="selected"' : '' !!}>Deactivate</option>
										 </select>
									</div>
								</div>
							</section>
				
						<div class="form-group">
							 <input type="submit" name="updatebtnsubmit" value="Submit"  class="btn btn-success btn-flat">
							 <a href="{{  route('menu_manager') }}" class="btn btn-danger btn-flat">Close</a>
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
     $('#post-form').validate();
	 $('#fullHash').on('change',function(){
        if($('#fullHash').is(':checked')){
            $('#homehash').attr('disabled',true); 
            $('#homeHashTR').addClass('trdisabled'); 
        }else{
            $('#homehash').attr('disabled',false); 
             $('#homeHashTR').removeClass('trdisabled'); 
        }
    });
	
	$('select[name="categories"]').val('{{$menuDetails->mm_parent_id}}')
});

</script>
@stop