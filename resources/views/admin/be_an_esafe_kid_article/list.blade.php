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
                    <h2 class="pageheader-title">Manage Articles 
						@if($buttons['add'] )
							<a class="float-sm-right" href="{{ route('post_create',$postType) }}">
								<button class="btn btn-success btn-flat">Create New</button>
							</a>
						@endif
					</h2>
                </div>
            </div>
        </div>
        <div class="row">
        <div class="card-header d-flex">
            {{Form::open([
                "url" => route('import-post-records', ['slug' => $postType]),
                "name" => "importform",
                "enctype" => "multipart/form-data",
                "style" => "text-align: left;margin: 0;"
            ])}}
                <div class="form-group">
                    <label>Upload List (.xlsx)</label>
                    <input style="opacity:1!important;" type="file" accept=".xlsx" name="post_import_file" class="form-control"/>
                    <button style="margin-top: 10px;" class="btn btn-md btn-primary">Import</button>
                </div>
            {{Form::close()}}
        </div>
    </div> 
		<div >
			{{ Form::open(array('name'=>'filter-reg','url'=>route('post_index',[$postType]),'method'=>'get' )) }}				
				 <div class="row">						
					<div class="col-sm-4 form-group">
						<input type="text" name="post_title" class="form-control border {{ !empty(Input::get('post_title')) ? 'border-green' : '' }}" value="{{Input::get('post_title')}}" placeholder="Filter by Title" /> 
					</div>
					<div class="col-sm-4 form-group">
						<input type="submit" class=" btn btn-success"  /> 
						<a href="{{ asset(Config::get('app.admin_prefix').'/post/be_an_esafe_kid_article') }}"><input type="button" name="filterNow" class=" btn btn-primary" value="Reset" /></a> 
					</div>
				</div>
				
			{{ Form::close()}}
				
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
                            <div class="col-sm-6"><h5 class="">{{ $post_items->total() }} results found.</h5></div>
                            <?php /*<div class="col-sm-6"><h5 class="text-right">Showing {{ $hubList->currentPage() }} of {{  $hubList->total() }} pages</h5></div> */ ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive-md">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        
                                        <th scope="col">Title</th>
										@if($buttons['status'] )
											<th scope="col">Current Status</th>
										@endif
                                        <th scope="col">Update</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if( !empty($post_items) && $post_items->count() >0 )
                                        <?php $inc = getPaginationSerial($post_items); 	?>
                                        @foreach($post_items as $item)
										<?php
											
											$statusChangeUrl = route('post_change_status',[$postType,$item->post_id,$item->post_status]);
										?>
                                            <tr>
                                                <th scope="row">{{ $inc++ }}</th>
                                                <td>{!!  $item->post_title !!}</td>
                                              <?php /*  <td>{!! $item->post_title_arabic !!}</td> */ ?>
												
												@if($buttons['status'] )
													<td>
														{!! getAdminStatusIcon($item->post_status,$statusChangeUrl) !!}
													</td>
												@endif
												
												{!! getAdminActionIcons($buttons,$postType,$item) !!}
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr class="no-records">
											<td colspan="7" class="text-center text-danger">No records found!</td>
										</tr>
                                    @endif
                                </tbody>
                            </table>
							@include('admin.common.pagination_links')
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end striped table -->
            <!-- ============================================================== -->
        </div>
        
            
                
     </div>
@stop