			<div class="block_">
				<h3 class="sub-title text-colo-brand " data-number="01">
				  <span>{{ lang('govt_agency_info') }}</span>
				</h3>	
				<div class="row">		
				
					@include('frontend.form_view_partials.offline_image',['fieldName'=>'entity_logo','fieldLabel'=>lang('govt_entity_logo'),'step'=>1,'required'=>true,'subQuestion'=> null,'helpText'=>null])					
					
					@include('frontend.form_view_partials.offline_document',['fieldName'=>'offline_form','fieldLabel'=>lang('offline_form'),'step'=>1,'required'=>true,'subQuestion'=> null,'helpText'=>null])
				
				</div>
				<div class="block_">	
					<h3 class="sub-title text-colo-brand " data-number="02">
					  <span>{{ lang('first_criteria') }}</span>
					</h3>
					<div class="helper-text helper-text-top offline-helper-top">
					  <span>{{ lang('vision_realization_attachments') }} </span>
					</div>
					<div class="row">					
						<div class="tableWrapper {{ (empty($preFilledForm['visual_realization_attachments_upload']))?'init_hide':'' }}">
							<table id="vision_realization_attachments_table" class="table">
								<thead  class="thead-light">
									<tr>
									  <th class="cl_index" scope="col">#</th>
									  <th class="cl_lg"  scope="col">{{ lang('file_uploaded') }}</th>									  
									</tr>
								</thead>
								<tbody>								
									@if(!empty($preFilledForm['visual_realization_attachments_upload']))
										@foreach($preFilledForm['visual_realization_attachments_upload'] as $key=>$vsFile)
											<tr>
												<td  class="cl_index" >{{ ($key+1) }}</td>
												<td  class="cl_lg"  >
													<div>
														<a href="{{ asset($lang.'/download_file/'.$vsFile['fileID']) }}">
															{{ $vsFile['fileOriginalName'] }}
														</a>
													</div>
													<div class="size">{{ $vsFile['fileSize'] }}</div>
												</td>
											</tr>
										@endforeach
									@endif
								</tbody>							
							</table>
						</div>
					</div>
				</div>
				
				<div class="block_">		
					<h3 class="sub-title text-colo-brand " data-number="03">
					  <span>{{ lang('second_criteria') }}</span>
					</h3>
					<div class="helper-text helper-text-top offline-helper-top">
					  <span>{{ lang('task_innovation_attachments') }} </span>
					</div>
					<div class="row">
						<div class="tableWrapper {{ (empty($preFilledForm['task_innovation_attachments_upload']))?'init_hide':'' }}">
							<table id="task_innovation_attachments_table" class="table">
								<thead  class="thead-light">
									<tr>
									  <th scope="col">#</th>
									  <th scope="col">{{ lang('file_uploaded') }}</th>
									 
									</tr>
								</thead>
								<tbody>								
									@if(!empty($preFilledForm['task_innovation_attachments_upload']))
										@foreach($preFilledForm['task_innovation_attachments_upload'] as $key=>$vsFile)
											<tr>
												<td  class="cl_index" >{{ ($key+1) }}</td>
												<td  class="cl_lg"  >
													<div>
														<a href="{{ asset($lang.'/download_file/'.$vsFile['fileID']) }}">
															{{ $vsFile['fileOriginalName'] }}
														</a>
													</div>
													<div class="size">{{ $vsFile['fileSize'] }}</div>
												</td>
											</tr>
										@endforeach
									@endif
								</tbody>							
							</table>
						</div>
					</div>	
				</div>	
				
				<div class="block_">		
					<h3 class="sub-title text-colo-brand " data-number="04">
					  <span>{{ lang('third_criteria') }}</span>
					</h3>
					<div class="helper-text helper-text-top offline-helper-top">
					  <span>{{ lang('integrated_possibilities_attachments') }} </span>
					</div>
					<div class="row">
						<div class="tableWrapper {{ (empty($preFilledForm['integrated_possibilities_attachments_upload']))?'init_hide':'' }}">
							<table id="integrated_possibilities_attachments_table" class="table">
								<thead  class="thead-light">
									<tr>
									  <th scope="col">#</th>
									  <th scope="col">{{ lang('file_uploaded') }}</th>
									 
									</tr>
								</thead>
								<tbody>
									@if(!empty($preFilledForm['integrated_possibilities_attachments_upload']))
										@foreach($preFilledForm['integrated_possibilities_attachments_upload'] as $key=>$vsFile)
											<tr>
												<td  class="cl_index" >{{ ($key+1) }}</td>
												<td  class="cl_lg"  >
													<div>
														<a href="{{ asset($lang.'/download_file/'.$vsFile['fileID']) }}">
															{{ $vsFile['fileOriginalName'] }}
														</a>
													</div>
													<div class="size">{{ $vsFile['fileSize'] }}</div>
												</td>
											</tr>
										@endforeach
									@endif
								</tbody>							
							</table>
						</div>
					</div>	
				</div>	
			</div>
@section('scripts')
@parent
	<script>
		$(document).ready(function () {  
		});
	</script>
@stop