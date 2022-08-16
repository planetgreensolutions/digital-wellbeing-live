@extends('admin.layouts.master')
@section('content')
  @section('bodyClass')
    @parent
        hold-transition skin-blue sidebar-mini
  @stop
	
	
   <!--   used for coomon post view ; need custom changes here      -->
	@include('admin.common.post_list')
	
	
	
	
@stop