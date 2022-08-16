@extends('admin.layouts.master')
@section('styles')
@parent
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
            <h2 class="pageheader-title">Log Entries</h2>
         </div>
		 </div>
   </div>
   <div>
     
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
                  <div class="col-sm-6">
                     <h5 class="">{{ $auditList->total() }} entries found.</h5>
                  </div>
                  <?php /*<div class="col-sm-6"><h5 class="text-right">Showing {{ $hubList->currentPage() }} of {{  $hubList->total() }} pages</h5></div> */ ?>
               </div>
            </div>
            <div class="card-body">
               <div class="table-responsive">	
						
						<?php  if(count($auditList)>0){ ?>												
							<table id="members1" class="table table-bordered table-hover">
							 <thead>
								<tr>
									<th>#</th>
									<th>Action</th>								
									<th>Date Time</th>											
								</tr>
							</thead>								
								<tbody>	
								<?php 
									$inc=getPaginationSerial($auditList);
									foreach ($auditList as $audit){
								
								?>
										<tr>
											<td>{{ $inc++ }}</td>
											<td>
												<ul>
													<li>URL: {{ (substr($audit->url, -1) == "?")?substr($audit->url,0,-1):$audit->url }}</li>
													<li>IP: {{ $audit->ip_address }}</li>
													<li>ACTION: {{ ucfirst($audit->event) }}</li>
													@if(isset($audit->user))
														<li>USER: {{ ucfirst($audit->user->name) }}</li>
													@endif
												</ul>
											</td>
											<td>{{ date('d M,Y h:i a',strtotime($audit->created_at)) }}</td>
										</tr>
										<?php } ?>
										<tr><td colspan="5">{{ $auditList->links() }}</td></tr>
								   </tbody>                            
							</table>							
							<?php }else{ ?>
							<div class="row col-sm-12">
								<div class="alert alert-danger alert-dismissable">
									<i class="fa fa-ban"></i>
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<b>Alert!</b> No Records Found!.  
								</div>  
							</div>  
							<?php } ?>
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
@section('scripts')
@parent
@stop