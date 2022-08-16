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
            <h2 class="pageheader-title">{{ $user->name}} {{ lang('submissions_details') }}
               <a class="float-sm-right" href="{{ route('download_user_submission',['user'=>$user->id,'submission'=>'']) }}">
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
                     <h5 class="">{{ $submissions->count() }} {{ lang('results_found') }}</h5>
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
                           <th scope="col">{{ lang('name') }}</th>
                           <th scope="col">{{ lang('entity_details') }}</th>
                           <th scope="col">{{ lang('category') }}</th>
                           <th scope="col">{{ lang('form_type') }}</th>
                           <th scope="col">{{ lang('date') }}</th>
                           <th scope="col">{{ lang('manage') }}</th>
                        </tr>
                     </thead>
                     <tbody>
                        @if( !empty($submissions) && $submissions->count() >0 )
                        <?php $inc = getPaginationSerial($submissions);   ?>
                        @foreach($submissions as $key => $submission)      
							<tr data-id="{{ $user->id }}">
							   <th scope="row">{{ $inc++ }}</th>
							   <td><a class="text-primary" href="{{ route('user_submission_details',[$submission->form_user_id,$submission->form_id]) }}">{{ $submission->entity_name }} </a></td>
							   <td>{{ ($submission->entityCountry) ? $submission->entityCountry->getData('country_name') : '-' }}</td>
							   <td dir="rtl" style="direction:rtl;text-align:right;">{{ $submission->formManager->getData('fm_category') }} <br/> {{ $submission->formManager->getData('fm_sub_category') }}</td>
							   <td>{!! $submission->getFormType(true) !!}</td>
							   <td>{{ ($submission->form_created_at) ? date('d M Y',strtotime($submission->form_created_at)) : '-' }}</td>
							   <td><a class="btn btn-outline-primary btn-rounded btn-xs" href="{{ route('user_submission_details',[$submission->form_user_id,$submission->form_id]) }}">{{ lang('view_details') }}</a></td>
							</tr>
                        @endforeach
                        <tr>
                           <td colspan="10">{{ $submissions->links() }}</td>
                        </tr>
                        @else
                        <tr class="no-records">
                           <td colspan="10" class="text-center text-danger">{{ lang('no_records_found') }}</td>
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
@section('scripts')
@parent
<script>
   var applicantObj=[];
   downloadURLBase = "{{ apa('nominations') }}/"
   jQuery(function(){
		@if(Auth::user()->hasAnyRole(['Country Coordinator']))
			$('select[name="filter_user_nationality"]').closest('.col-sm-3').remove();
		@endif
		
   
    
   })
</script>
@stop