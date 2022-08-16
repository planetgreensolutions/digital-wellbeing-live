<table border="0" cellspacing="20px" cellpadding="15px">
	<tr>
		<th colspan="2">
			{{ lang('best_gov_employee_info') }}
		</th>
	</tr>
	<tr>
		<td width="50%" class="title_">
			{{ lang('govt_entity_logo') }}				
		</td>
		<td width="50%"  class="img_box padding_0">
			<img width="300px" height="auto" src="{{ asset('storage/app/uploads/'.$preFilledForm['entity_logo_image']) }}" />
		</td>
		</tr>
</table>

<table border="0" cellspacing="20px" cellpadding="15px">
	<tr>
		<td width="50%" class="title_">
			{{ lang('candidate_name') }}				
		</td>
		<td width="50%"  class="ans_">
			{{ $preFilledForm['candidate_name'] }}
		</td>
	</tr>
	<tr>
		<td width="50%" class="title_">
			{{ lang('candidate_job_title') }}				
		</td>
		<td width="50%"  class="ans_">
			{{ $preFilledForm['candidate_job_title'] }}
		</td>
	</tr>
	<tr>
		<td width="50%" class="title_">
			{{ lang('candidate_employer') }}				
		</td>
		<td width="50%"  class="ans_">
			{{ $preFilledForm['candidate_employer'] }}
		</td>
	</tr>
	<tr>
		<td width="50%" class="title_">
			{{ lang('candidate_passport_number') }}				
		</td>
		<td width="50%"  class="ans_">
			{{ $preFilledForm['candidate_passport_number'] }}
		</td>
	</tr>
	<tr>
		<td width="50%" class="title_">
			{{ lang('candidate_id_number') }}				
		</td>
		<td width="50%"  class="ans_">
			{{ $preFilledForm['candidate_id_number'] }}
		</td>
	</tr>
	<tr>
		<td width="50%" class="title_">
			{{ lang('candidate_work_ph_no') }}				
		</td>
		<td width="50%"  class="ans_">
			{{ $preFilledForm['candidate_work_ph_no'] }}
		</td>
	</tr>
	<tr>
		<td width="50%" class="title_">
			{{ lang('candidate_mobile_ph_no') }}				
		</td>
		<td width="50%"  class="ans_">
			{{ $preFilledForm['candidate_mobile_ph_no'] }}
		</td>
	</tr>
	<tr>
		<td width="50%" class="title_">
			{{ lang('candidate_email') }}				
		</td>
		<td width="50%"  class="ans_">
			{{ $preFilledForm['candidate_email'] }}
		</td>
	</tr>

</table>


<table border="0" cellspacing="20px" cellpadding="15px">
	<tr>
		<th colspan="2">
			{{ lang('functional_tasks') }}
		</th>
	</tr>
	<tr>
		<td width="100%" class="title_">
			@include('frontend.form_view_partials.functional_task_table')
		</td>
		
		</tr>
</table>


<table border="0" cellspacing="20px" cellpadding="15px">
	<tr>
		<th colspan="2">
			{{ lang('first_criteria') }}
		</th>
	</tr>
	<tr>
		<td width="50%"  class="title_">
			{{ lang('peformance_achievement_job') }}
		</td>
		<td width="50%"  class="ans_">
			{{ $preFilledForm['peformance_achievement_job'] }}
		</td>
	</tr>
</table>

<table border="0" cellspacing="20px" cellpadding="15px">	
	<tr>
		<th class="smallTitle" >{{ lang('peformance_achievement_job_attachments') }}</th>
	</tr>
	<tr>
		<td  class="padding_0">
			<table id="peformance_achievement_job_attachments_table" class="table">
				<thead class="thead-light">
					<tr>
						<th class="cl_index" scope="col">#</th>
						<th class="cl_lg" scope="col">{{ lang('file_uploaded') }}</th>
						
					</tr>
				</thead>
				<tbody>

					@if(!empty($preFilledForm['peformance_achievement_job_attachments_upload']))
					@foreach($preFilledForm['peformance_achievement_job_attachments_upload'] as $key=>$vsFile)
					<tr>
						<td class="cl_index">{{ ($key+1) }}</td>
						<td class="cl_lg">
							<div><a href="{{ asset($lang.'/download_file/'.$vsFile['fileID'] ) }}">{{ $vsFile['fileOriginalName'] }}</a></div>
							<div class="size">{{ $vsFile['fileSize'] }}</div>
						</td>
					</tr>
					@endforeach
					@endif
				</tbody>
			</table>
		</td>
	</tr>
</table>

<table border="0" cellspacing="20px" cellpadding="15px">
	<tr>
		<th colspan="2">
			{{ lang('second_criteria') }}
		</th>
	</tr>
	<tr>
		<td width="50%"  class="title_">
			{{ lang('impact_work_society') }}
		</td>
		<td width="50%"  class="ans_">
			{{ $preFilledForm['impact_work_society'] }}
		</td>
	</tr>
</table>

<table border="0" cellspacing="20px" cellpadding="15px">	
	<tr>
		<th class="smallTitle" >{{ lang('impact_work_society_attachments') }}</th>
	</tr>
	<tr>
		<td  class="padding_0">
			<table id="impact_work_society_attachments_table" class="table">
				<thead class="thead-light">
					<tr>
						<th class="cl_index" scope="col">#</th>
						<th class="cl_lg" scope="col">{{ lang('file_uploaded') }}</th>
						
					</tr>
				</thead>
				<tbody>

					@if(!empty($preFilledForm['impact_work_society_attachments_upload']))
					@foreach($preFilledForm['impact_work_society_attachments_upload'] as $key=>$vsFile)
					<tr>
						<td class="cl_index">{{ ($key+1) }}</td>
						<td class="cl_lg">
							<div><a href="{{ asset($lang.'/download_file/'.$vsFile['fileID'] ) }}">{{ $vsFile['fileOriginalName'] }}</a></div>
							<div class="size">{{ $vsFile['fileSize'] }}</div>
						</td>
					</tr>
					@endforeach
					@endif
				</tbody>
			</table>
		</td>
	</tr>
</table>


<table border="0" cellspacing="20px" cellpadding="15px">
	<tr>
		<th colspan="2">
			{{ lang('third_criteria') }}
		</th>
	</tr>
	<tr>
		<td width="50%"  class="title_">
			{{ lang('initiative_and_innovation') }}
		</td>
		<td width="50%"  class="ans_">
			{{ $preFilledForm['initiative_and_innovation'] }}
		</td>
	</tr>
</table>

<table border="0" cellspacing="20px" cellpadding="15px">	
	<tr>
		<th class="smallTitle" >{{ lang('initiative_and_innovation_attachments') }}</th>
	</tr>
	<tr>
		<td  class="padding_0">
			<table id="initiative_and_innovation_attachments_table" class="table">
				<thead class="thead-light">
					<tr>
						<th class="cl_index" scope="col">#</th>
						<th class="cl_lg" scope="col">{{ lang('file_uploaded') }}</th>
						
					</tr>
				</thead>
				<tbody>

					@if(!empty($preFilledForm['initiative_and_innovation_attachments_upload']))
					@foreach($preFilledForm['initiative_and_innovation_attachments_upload'] as $key=>$vsFile)
					<tr>
						<td class="cl_index">{{ ($key+1) }}</td>
						<td class="cl_lg">
							<div><a href="{{ asset($lang.'/download_file/'.$vsFile['fileID'] ) }}">{{ $vsFile['fileOriginalName'] }}</a></div>
							<div class="size">{{ $vsFile['fileSize'] }}</div>
						</td>
					</tr>
					@endforeach
					@endif
				</tbody>
			</table>
		</td>
	</tr>
</table>



<table border="0" cellspacing="20px" cellpadding="15px">
	<tr>
		<th colspan="2">
			{{ lang('fourth_criteria') }}
		</th>
	</tr>
	<tr>
		<td width="50%"  class="title_">
			{{ lang('role_positive_model') }}
		</td>
		<td width="50%"  class="ans_">
			{{ $preFilledForm['role_positive_model'] }}
		</td>
	</tr>
</table>

<table border="0" cellspacing="20px" cellpadding="15px">	
	<tr>
		<th class="smallTitle" >{{ lang('role_positive_model_attachments') }}</th>
	</tr>
	<tr>
		<td  class="padding_0">
			<table id="role_positive_model_attachments_table" class="table">
				<thead class="thead-light">
					<tr>
						<th class="cl_index" scope="col">#</th>
						<th class="cl_lg" scope="col">{{ lang('file_uploaded') }}</th>
						
					</tr>
				</thead>
				<tbody>

					@if(!empty($preFilledForm['role_positive_model_attachments_upload']))
					@foreach($preFilledForm['role_positive_model_attachments_upload'] as $key=>$vsFile)
					<tr>
						<td class="cl_index">{{ ($key+1) }}</td>
						<td class="cl_lg">
							<div><a href="{{ asset($lang.'/download_file/'.$vsFile['fileID'] ) }}">{{ $vsFile['fileOriginalName'] }}</a></div>
							<div class="size">{{ $vsFile['fileSize'] }}</div>
						</td>
					</tr>
					@endforeach
					@endif
				</tbody>
			</table>
		</td>
	</tr>
</table>


<table border="0" cellspacing="20px" cellpadding="15px">
	<tr>
		<th colspan="2">
			{{ lang('fifth_criteria') }}
		</th>
	</tr>
	<tr>
		<td width="50%"  class="title_">
			{{ lang('continous_learning') }}
		</td>
		<td width="50%"  class="ans_">
			{{ $preFilledForm['continous_learning'] }}
		</td>
	</tr>
</table>

<table border="0" cellspacing="20px" cellpadding="15px">	
	<tr>
		<th class="smallTitle" >{{ lang('continous_learning_attachments') }}</th>
	</tr>
	<tr>
		<td  class="padding_0">
			<table id="continous_learning_attachments_table" class="table">
				<thead class="thead-light">
					<tr>
						<th class="cl_index" scope="col">#</th>
						<th class="cl_lg" scope="col">{{ lang('file_uploaded') }}</th>
						
					</tr>
				</thead>
				<tbody>

					@if(!empty($preFilledForm['continous_learning_attachments_upload']))
					@foreach($preFilledForm['continous_learning_attachments_upload'] as $key=>$vsFile)
					<tr>
						<td class="cl_index">{{ ($key+1) }}</td>
						<td class="cl_lg">
							<div><a href="{{ asset($lang.'/download_file/'.$vsFile['fileID'] ) }}">{{ $vsFile['fileOriginalName'] }}</a></div>
							<div class="size">{{ $vsFile['fileSize'] }}</div>
						</td>
						
					</tr>
					@endforeach
					@endif
				</tbody>
			</table>
		</td>
	</tr>
</table>

@section('scripts')
@parent
<script>
	
</script>
@stop