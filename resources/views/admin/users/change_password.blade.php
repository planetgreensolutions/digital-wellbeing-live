@extends('admin.layouts.master')
@section('styles')
@parent

{{ HTML::style('assets/admin/vendor/multi-select/css/multi-select.css') }}

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
                <h2 class="pageheader-title">Edit {{ $user->name }}
					<a class="float-sm-right" href="{{ apa('dashboard') }}"><button class="btn btn-outline-dark btn-flat">Dashboard</button></a>
				</h2>
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

                {{ Form::open(array('url' => apa('change_password') ,'files'=>true,'id'=>'form')) }}
		
                    <div class="card-body">
                        <div class="col-sm-12">
                            @include('admin.common.user_message')
                            <div class="clearfix"></div>
                            
                                 <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="name" class="col-form-label">Full Name[English]<em>*</em></label>
                                            <input id="name" name="name" type="text" value="{{ $user->name }}" class="form-control" required>
                                        </div>
                                    </div>
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email" class="col-form-label">Email<em>*</em></label>
                                            <input disabled id="email" name="email" value="{{  $user->email }}" type="email" class="form-control" required>
                                        </div>
                                    </div>
                                 </div>
								 
								 
								 <div class="row">
                                    
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="password" class="col-form-label">Password</label>
                                            <input id="password" name="password" type="password" value="" class="form-control editor">
                                        </div>
                                    </div>
									
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="phone" class="col-form-label">Phone<em>*</em></label>
                                            <input id="phone" name="user_phone_number" type="number" value="{{ $user->user_phone_number }}" class="form-control editorAr" required>
                                        </div>
                                    </div>
                                     
                                 </div>
								 
								 <div class="row">
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="current_admin_pass" class="col-form-label">Current Admin Password<em>*</em></label>
                                            <input id="current_admin_pass" name="current_admin_pass" type="password" value="" class="form-control" required>
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
                                    <a href="{{ apa('dashboard') }}" class="btn btn-danger">Close</a>
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
<script type="text/javascript" src="{{ asset('assets/admin/vendor/multi-select/js/jquery.multi-select.js') }}"></script>
<script>
	
 $(document).ready(function(){
    $('#form').validate();
 });
</script>

@stop