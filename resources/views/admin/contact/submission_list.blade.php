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
            <h2 class="pageheader-title">Contact Request List
               <a class="float-sm-right" href="{{ route('contact-download') }}"> 
               <button class="btn btn-success btn-flat">{{ lang('download') }}</button>
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
                  <div class="col-sm-6">
                     <h5 class="">{{ $contactUsDetails->total() }} {{ lang('results_found') }}</h5>
                  </div>
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
                           <th scope="col">Phone Number</th>
                           <th scope="col">Subject</th>
                           <th scope="col">Message</th>
                           <th scope="col">Submission Date</th>
                        </tr>
                     </thead>
                     <tbody>
                        @if( !empty($contactUsDetails) && $contactUsDetails->count() >0 )
                        <?php $inc = getPaginationSerial($contactUsDetails);   ?>
                        @foreach($contactUsDetails as $key => $submission)      
							<tr>
							   <th scope="row">{{ $inc++ }}</th>
							   <td>{{$submission->contact_name}}</td>
							   <td>{{$submission->contact_email}}</td>
							   <td>{{$submission->contact_phone}}</td>
							   <td>{{$submission->contact_subject}}</td>
							   <td>{{$submission->contact_message}}</td>
							   <td>{{ ($submission->contact_created_at) ? date('d M Y',strtotime($submission->contact_created_at)) : '-' }}</td>
							  
							</tr>
                        @endforeach
                        <tr>
                           <td colspan="10">{{ $contactUsDetails->links() }}</td>
                        </tr>
                        @else
                        <tr class="no-records">
                           <td colspan="10" class="text-center text-danger">{{ lang('no_records_found') }}</td>
                        </tr>
                        @endif
                     </tbody>
                  </table>
					@if($contactUsDetails instanceof \Illuminate\Pagination\LengthAwarePaginator )
						<div class="row">
							<div class="col-sm-12">
								{!! $contactUsDetails->links() !!}
							</div>
						</div>
					@endif
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