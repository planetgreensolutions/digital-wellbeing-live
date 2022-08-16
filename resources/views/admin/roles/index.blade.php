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
				<h2 class="pageheader-title">User Roles
					<a class="float-sm-right" href="{{ apa('roles/create') }}">
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
						<div class="col-sm-6"><h5 class="">{{ $roles->count() }} results found.</h5></div>
						<?php /*<div class="col-sm-6"><h5 class="text-right">Showing {{ $hubList->currentPage() }} of {{  $hubList->total() }} pages</h5></div> */ ?>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive-md">
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
									
									<th scope="col">#</th>
									
									<th scope="col">Role Name</th>
									
									<th scope="col">Option</th>
									
									
								</tr>
							</thead>
							<tbody>
								@if (count($roles) > 0)
								<?php $inc = getPaginationSerial($roles); 	?>
								@foreach ($roles as $permission)
								<tr data-entry-id="{{ $permission->id }}">
									<td>{{ $inc++ }}</td>
									<td>{{ $permission->name }}</td>
									<td>
										<a href="{{ apa('roles/edit/'.$permission->id) }}" class="btn btn-xs btn-info">Edit</a>
										<a data-id="{{ $permission->id }}" href="{{ apa('roles/delete/'.$permission->id) }}" class="deleteRecord btn btn-xs btn-danger">Delete</a>
										
									</td>
									
								</tr>
								@endforeach
								@else
								<tr>
									<td colspan="3">@lang('global.app_no_entries_in_table')</td>
								</tr>
								@endif
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop