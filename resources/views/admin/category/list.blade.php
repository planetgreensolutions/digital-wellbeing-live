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
						<div class="col-sm-6"><h5 class="">{{ $categoryList->count() }} results found.</h5></div>
						<?php /*<div class="col-sm-6"><h5 class="text-right">Showing {{ $hubList->currentPage() }} of {{  $hubList->total() }} pages</h5></div> */ ?>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive-md">						
						{!! $categoryTree !!}							
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop