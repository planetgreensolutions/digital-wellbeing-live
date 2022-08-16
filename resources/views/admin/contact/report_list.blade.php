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
            <h2 class="pageheader-title">Report List
               <a class="float-sm-right" href="{{ route('report-download') }}"> 
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
                     <h5 class="">{{ $reportDetails->total() }} {{ lang('results_found') }}</h5>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <div class="table-responsive-md">
                  <table class="table table-striped table-bordered">
                     <thead>
                        <tr>		
                           <th scope="col">#</th>
                           <th scope="col">Report By</th>
                           <th scope="col">Message</th>
                           <th scope="col">Report Date</th>
                        </tr>
                     </thead>
                     <tbody>
                        @if( !empty($reportDetails) && $reportDetails->count() >0 )
                        <?php $inc = getPaginationSerial($reportDetails);   ?>
                        @foreach($reportDetails as $key => $report)      
							<tr>
							   <th scope="row">{{ $inc++ }}</th>
							   <td>{{$report->report_by}}</td>
							   <td>{{$report->report_message}}</td>
							   <td>{{ ($report->report_created_at) ? date('d M Y',strtotime($report->report_created_at)) : '-' }}</td>
							  
							</tr>
                        @endforeach
                        <tr>
                           <td colspan="10">{{ $reportDetails->links() }}</td>
                        </tr>
                        @else
                        <tr class="no-records">
                           <td colspan="10" class="text-center text-danger">{{ lang('no_records_found') }}</td>
                        </tr>
                        @endif
                     </tbody>
                  </table>
					@if($reportDetails instanceof \Illuminate\Pagination\LengthAwarePaginator )
						<div class="row">
							<div class="col-sm-12">
								{!! $reportDetails->links() !!}
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