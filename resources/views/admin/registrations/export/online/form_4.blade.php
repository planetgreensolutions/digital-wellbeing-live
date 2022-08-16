<table border="0" cellspacing="20px" cellpadding="15px">
	<tr>
		<th colspan="2">
			{{ lang('govt_agency_info') }}
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
	<tr>
		<td width="50%" class="title_">
			{{ lang('personal_photo') }}				
		</td>
		<td width="50%"  class="img_box padding_0">
			<img width="300px" height="auto" src="{{ asset('storage/app/uploads/'.$preFilledForm['personal_photo_image']) }}" />
		</td>
	</tr>
</table>


<table border="0" cellspacing="20px" cellpadding="15px">
	<tr>
		<th colspan="2">
			{{ lang('candidate_personal_data') }}
		</th>
	</tr>
	<tr>
		<td width="50%" class="title_">
			{{ lang('person_name') }}				
		</td>
		<td width="50%"  class="ans_">
			{{ $preFilledForm['person_name'] }}
		</td>
	</tr>
	<tr>
		<td width="50%" class="title_">
			{{ lang('person_job') }}				
		</td>
		<td width="50%"  class="ans_">
			{{ $preFilledForm['person_job'] }}
		</td>
	</tr>
	<tr>
		<td width="50%" class="title_">
			{{ lang('person_workplace') }}				
		</td>
		<td width="50%"  class="ans_">
			{{ $preFilledForm['person_workplace'] }}
		</td>
	</tr>
	<tr>
		<td width="50%" class="title_">
			{{ lang('person_passport_number') }}				
		</td>
		<td width="50%"  class="ans_">
			{{ $preFilledForm['person_passport_number'] }}
		</td>
	</tr>
	<tr>
		<td width="50%" class="title_">
			{{ lang('person_id_number') }}				
		</td>
		<td width="50%"  class="ans_">
			{{ $preFilledForm['person_id_number'] }}
		</td>
	</tr>
	<tr>
		<td width="50%" class="title_">
			{{ lang('person_work_phone') }}				
		</td>
		<td width="50%"  class="ans_">
			{{ $preFilledForm['person_work_phone'] }}
		</td>
	</tr>
	<tr>
		<td width="50%" class="title_">
			{{ lang('person_mobile') }}				
		</td>
		<td width="50%"  class="ans_">
			{{ $preFilledForm['person_mobile'] }}
		</td>
	</tr>
	<tr>
		<td width="50%" class="title_">
			{{ lang('person_email') }}				
		</td>
		<td width="50%"  class="ans_">
			{{ $preFilledForm['person_email'] }}
		</td>
	</tr>

</table>


<table border="0" cellspacing="20px" cellpadding="15px">
	<tr>
		<th colspan="2">
			{{ lang('functional_task') }}
		</th>
	</tr>
	<tr>
		<td width="50%" class="title_">
			@include('frontend.form_view_partials.functional_task_table',['step'=>2])
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
			{{ lang('impressive_achievement') }}
		</td>
		<td width="50%"  class="ans_">
			{{ $preFilledForm['impressive_achievement'] }}
		</td>
	</tr>
</table>
<table border="0" cellspacing="20px" cellpadding="15px">	
	<tr>
		<th class="smallTitle" >{{ lang('impressive_achievement_attachments') }}</th>
	</tr>
	<tr>
		<td  class="padding_0">
			<table id="impressive_achievement_attachments_table" class="table">
				<thead  class="thead-light">
					<tr>
					  <th class="cl_index" scope="col">#</th>
					  <th class="cl_lg"  scope="col">{{ lang('file_uploaded') }}</th>
					 
					</tr>
				</thead>
				<tbody>
					
					@if(!empty($preFilledForm['impressive_achievement_attachments_upload']))
						@foreach($preFilledForm['impressive_achievement_attachments_upload'] as $key=>$vsFile)
							<tr>
								<td  class="cl_index" >{{ ($key+1) }}</td>
								<td  class="cl_lg"  >
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
			{{ lang('leadership_building') }}
		</td>
		<td width="50%"  class="ans_">
			{{ $preFilledForm['leadership_building'] }}
		</td>
	</tr>
</table>
<table border="0" cellspacing="20px" cellpadding="15px">	
	<tr>
		<th class="smallTitle" >{{ lang('leadership_building_attachments') }}</th>
	</tr>
	<tr>
		<td  class="padding_0">
			<table id="leadership_building_attachments_table" class="table">
				<thead  class="thead-light">
					<tr>
					  <th class="cl_index" scope="col">#</th>
					  <th class="cl_lg"  scope="col">{{ lang('file_uploaded') }}</th>
					 
					</tr>
				</thead>
				<tbody>
					
					@if(!empty($preFilledForm['leadership_building_attachments_upload']))
						@foreach($preFilledForm['leadership_building_attachments_upload'] as $key=>$vsFile)
							<tr>
								<td  class="cl_index" >{{ ($key+1) }}</td>
								<td  class="cl_lg"  >
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
			{{ lang('strategic_thought') }}
		</td>
		<td width="50%"  class="ans_">
			{{ $preFilledForm['strategic_thought'] }}
		</td>
	</tr>
</table>
<table border="0" cellspacing="20px" cellpadding="15px">	
	<tr>
		<th class="smallTitle" >{{ lang('strategic_thought_attachments') }}</th>
	</tr>
	<tr>
		<td  class="padding_0">
			<table id="strategic_thought_attachments_table" class="table">
				<thead  class="thead-light">
					<tr>
					  <th class="cl_index" scope="col">#</th>
					  <th class="cl_lg"  scope="col">{{ lang('file_uploaded') }}</th>
					 
					</tr>
				</thead>
				<tbody>
					
					@if(!empty($preFilledForm['strategic_thought_attachments_upload']))
						@foreach($preFilledForm['strategic_thought_attachments_upload'] as $key=>$vsFile)
							<tr>
								<td  class="cl_index" >{{ ($key+1) }}</td>
								<td  class="cl_lg"  >
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