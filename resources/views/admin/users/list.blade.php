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
                    <h2 class="pageheader-title">Users List
						<a class="float-sm-right" href="{{ apa('users/create') }}">
							<button class="btn btn-success btn-flat">Create New</button>
						</a>
					</h2>
                </div>
            </div>
        </div> 
		<div>
			 @include('admin.users.list_filters')
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
                            <div class="col-sm-6"><h5 class="">{{ $users->count() }} results found.</h5></div>
                            <?php /*<div class="col-sm-6"><h5 class="text-right">Showing {{ $hubList->currentPage() }} of {{  $hubList->total() }} pages</h5></div> */ ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive-md">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
										
                                        <th scope="col">#</th>

                                        <th scope="col">Name</th>
                                        
                                        <th scope="col">Email</th>
                                        
                                        <th scope="col">User Role</th>

                                        <th scope="date">Date</th>                                            

										<th scope="col">Current Status</th>

                                        <th scope="col">Update</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if( !empty($users) && $users->count() >0 )
                                        <?php $inc = getPaginationSerial($users); 	?>
                                        @foreach($users as $user)
										<?php $statusChangeUrl = asset(Config::get('app.admin_prefix').'/users/changestatus/'.$user->id.'/'.$user->status); ?>
                                            <tr>
                                                <th scope="row">{{ $inc++ }}</th>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }} <br/> {{ $user->user_phone_number }}</td>
												<td>
													@if($user->roles->count())
													@foreach($user->getRoleNames() as $userRole)
																<span class="border-gray badge badge-light">{{ $userRole }}</span>
															@endforeach
													@else 
														NA 
													@endif  

												</td>
												<td>{{ date('dS F, Y H:i a',strtotime($user->created_at)) }}</td>
												<td>
													{!! getAdminStatusIcon($user->status,$statusChangeUrl) !!}
												</td>

												<td class="manage">
													<ul>
														<li>
															<a href="{{ apa('users/edit/'.$user->id) }}"  title="edit"><i class="far fa-edit"></i></a>
														</li>
														@if($user->is_system_account == 2)
															<li>
																<a class="deleteRecord" href="{{ apa('users/delete/'.$user->id) }}"  title="delete" ><i class="fa fa-trash"></i></a>
															</li>
														@endif
													</ul>
												</td>
												
                                            </tr>
                                        @endforeach
										<tr>
										<td colspan="7">{{ $users->links() }}</td>
										</tr>
                                    @else
                                        <tr class="no-records">
											<td colspan="7" class="text-center text-danger">No records found!</td>
										</tr>
                                    @endif
                                </tbody>
                            </table>
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