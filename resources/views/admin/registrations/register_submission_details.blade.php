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
            <h2 class="pageheader-title">{{ lang('view') }} >> {{ $user->name }} 
               <a class="float-sm-right" href="{{ route('download_user_submission',['user'=>$submission->form_user_id,'submission'=>$submission->form_id]) }}">
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
                     <h5 class="">{{ lang('completed_applications') }}</h5>
                  </div>
                  <?php /*<div class="col-sm-6"><h5 class="text-right">Showing {{ $hubList->currentPage() }} of {{  $hubList->total() }} pages</h5></div> */ ?>
               </div>
            </div>
            <div class="card-body form_template_view_mode" >
               <div class="table-responsive-md" data-template="{{ $submission->formManager->fm_form_type_id }}">     
					@if( $submission->form_type == 1)
						@include('admin.registrations.online_submission_views.form_'.$submission->formManager->fm_form_type_id)
					@else
						@include('admin.registrations.offline_submission_views.offline_submission_'.$submission->formManager->fm_form_type_id)
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