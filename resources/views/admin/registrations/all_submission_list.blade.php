
@extends('admin.layouts.master')
@section('styles')
<style>

.bt-content i{ display:block;}
</style>

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
            <h2 class="pageheader-title">{{ lang('form_submission_list') }}</h2>
         </div>
		 </div>
   </div>
	<div>
      {!! $filterDOM !!}
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
                     <h5 class="">{{ $allSubmissions->total() }} {{ lang('results_found') }}</h5>
                  </div>
                  <?php /*<div class="col-sm-6"><h5 class="text-right">Showing {{ $hubList->currentPage() }} of {{  $hubList->total() }} pages</h5></div> */ ?>
               </div>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table class="table table-striped table-bordered" style="min-width:1500px">
                     <thead>
                        <tr>		
                           <th scope="col">#</th>
                           <th scope="col"  width="20%">{{ lang('category') }}</th>
                           <th scope="col"  width="20%">{{ lang('form_name') }}</th>
                           <th scope="col" width="10%">{{ lang('submission_type') }}</th>
                           <th scope="col" width="13%">{{ lang('entity_details') }}</th>
                           <th scope="col" width="10%">{{ lang('submitted_by') }}</th>
                          <?php /* <th scope="col">Attachment Count</th> */ ?>
                           <th scope="col" width="7%">{{ lang('status') }}</th>
                           <th scope="col" width="10%">{{ lang('date') }}</th>
                           <th scope="col">{{ lang('manage') }}</th>
                        </tr>
                     </thead>
                     <tbody>
                        @if( !empty($allSubmissions) && $allSubmissions->count() >0 )
                        <?php $inc = getPaginationSerial($allSubmissions);   ?>
                        @foreach($allSubmissions as $key => $submission)      
							<tr >
								<td scope="row">{{ $inc++ }}</td>
								<td>
									<div class="catFormWrapper">
										<span class="badge category_{{ $submission->formManager->fm_form_category_id }}">
											{{ ucWords($submission->formManager->fm_category_en) }}
										</span>
										<span class="badge category_{{ $submission->formManager->fm_form_category_id }}">
											{{ ucWords($submission->formManager->fm_category) }}
										</span>
																			
									</div>
									
								</td>
								<td>
									<div class="catFormWrapperAR">										
										<span class="badge2 category_{{ $submission->formManager->fm_form_category_id }} formType_{{ $submission->formManager->fm_form_type_id }}">
											{{ ucWords($submission->formManager->fm_sub_category_en) }}
										</span>	
										<span class="badge2  category_{{ $submission->formManager->fm_form_category_id }} formType_{{ $submission->formManager->fm_form_type_id }}">
											{{ ucWords( $submission->formManager->fm_sub_category) }}
										</span>
									</div>
								</td>
								<td>
									{!! ($submission->form_type == 1)?'<span><span class="badge-dot badge-success"></span>'.lang('online').'</span>': '<span><span class="badge-dot badge-light"></span>'.lang('offline').'</span>' !!}
								</td>
								<td>
									<div class="entityWrapper">
										<a data-fancybox="images" title="Click Me" href="{{ asset('storage/app/uploads/'.$submission->entityLogo->fl_file_hash) }}">
											<img  src="{{ asset('storage/app/uploads/'.$submission->entityLogo->fl_file_hash) }}" style="max-height:40px;"/>
										</a>
										<p>{{ $submission->entity_name }}</p>
											
											<?php /*
											@if(isset($submission->entityCountry))
												<p>
													<span><i class="flag-icon flag-icon-{{ strtolower($submission->entityCountry->iso) }}" title="{{ strtolower($submission->entityCountry->iso) }}" id="{{ strtolower($submission->entityCountry->iso) }}"></i></span>
													<span>{{ $submission->entityCountry->country_name }}</span>
												</p>
											@else
												<p>NA</p>
											@endif 
											*/ ?>
										
									</div>
								</td>
								<td>
									<div>{{ $submission->formOwner->name }}
										<?php 
											$countryIso = strtolower($submission->formOwner->userNationality->iso);
										?>
										<div class="flagWrapper">
											<span><i class="flag-icon flag-icon-{{ $countryIso }}" title="{{ $countryIso }}" id="{{ $countryIso }}"></i></span>
											<span>{{ $submission->formOwner->userNationality->country_name }}</span>
										</div>
									</div>
								</td>
								<?php /*<td style="text-align:right">{{ $submission->formAttachments->count() }}</td> */ ?>
								<td style="text-align:center">
									@if($submission->form_status ==1)
										<span><span class="badge-dot badge-success"></span>{{ lang('completed') }}</span>
										<?php /*<i style="font-size:24px;color:green" class="fas fa-check-circle"></i>
										<span class="bg-success text-white" style="padding:5px;display:inline-block;border-radius: 25px;"></span> */ ?>
									@else
										<span><span class="badge-dot badge-brand"></span>{{ lang('draft') }}</span>
										<?php /*<i style="font-size:24px;color:red" class="fas fa-newspaper"></i>
										<span class="bg-danger text-white" style="padding:5px;display:inline-block;border-radius: 25px;">Draft</span> */ ?>
									@endif
								</td>
								<td>
									<div class="dateTimeWrapper">
										
										<i class="far fa-clock"></i>
										<span class="dateWrap">{{ ($submission->form_created_at) ? date('D, d M, Y',strtotime($submission->form_created_at)) : '-' }}</span>
										<span class="timeWrap">{{ ($submission->form_created_at) ? date('h:i a',strtotime($submission->form_created_at)) : '-' }}</span>
										
									</div> 
								</td>
								<td class="tool_box">
									<div class="in_load"><span class="dashboard-spinner spinner-xs"></span></div>
									<div class="btn-group">
										@if($submission->form_status==1)
											<a class="btn btn-outline-primary btn-rounded btn-xs" href="{{ route('user_submission_details',[$submission->form_user_id,$submission->form_id]) }}">{{ lang('view_details') }}</a>
											
											@if($submission->shortlist_status == 2)
												<a class="btn btn-outline-success btn-rounded btn-xs shortlist_application" href="{{ route('shortlist_application',[$submission->form_id]) }}">{{ lang('add_to_short_list') }}</a>
											@else
												<a class="btn btn-outline-danger btn-rounded btn-xs shortlist_application" href="{{ route('shortlist_application',[$submission->form_id]) }}">{{ lang('remove_from_shortlist') }}</a>
											@endif
										@endif
										
										@if($submission->form_status==2)
											<a class="btn btn-warning btn-rounded btn-xs emailReminder" href="{{ route('complete_form_request',[$submission->form_user_id,$submission->form_id]) }}">{{ lang('send_form_completion_request_email') }}</a>
										@endif
									</div>
								</td>
							</tr>
                        @endforeach
                        <tr>
                           <td colspan="10">{{ $allSubmissions->links() }}</td>
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
   
   
   jQuery(function(){
		$(".custdatepicker").datepicker({dateFormat: 'yy-mm-dd'});
		$('.emailReminder').on('click',function(e){
			
			e.preventDefault();
			$(this).closest('tr').addClass('trAjaxLoader');
			sendAjax($(this).attr('href'),'GET',{},function(data){
				// console.log(data);
				if(data.status){
					swal.fire({title:data.message,type:'success'});
				}else{
					swal.fire({title:data.message,type:'error_get_last'});
				}
				$(this).closest('tr').removeClass('trAjaxLoader');
			});
		});
		
		$('.shortlist_application').on('click',function(e){
			e.preventDefault();
			$(this).closest('tr').addClass('trAjaxLoader');
			var $_elem = $(this);
			sendAjax($(this).attr('href'),'GET',{},function(data){
				console.log(data);
				if(data.status){
					// console.log(data);
					if(data.formStatus == 1){
						$_elem.removeClass('btn-outline-success').addClass('btn-outline-danger').html('{{ lang("remove_from_shortlist") }}');
					}else{
						$_elem.removeClass('btn-outline-danger').addClass('btn-outline-success').html('{{ lang("remove_from_shortlist") }}');
					}
					swal.fire({title:data.message,type:'success'});
					
				}else{
					swal.fire({title:data.message,type:'error'});
				}
				$(this).closest('tr').removeClass('trAjaxLoader');
			});
		});
   });
</script>
@stop