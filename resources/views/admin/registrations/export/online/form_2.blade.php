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
			{{ lang('initiative_project_name') }}
		</td>
		<td width="50%" class="ans_">
			{{ $preFilledForm['initiative_project_name'] }}
		</td>
	</tr>
	
	<tr>
		<td width="50%" class="title_">
			{{ lang('name_of_govt_authority') }}
		</td>
		<td width="50%" class="ans_">
			{{ $preFilledForm['name_of_govt_authority'] }}
		</td>
	</tr>
	
	<tr>
		<td width="50%" class="title_">
			{{ lang('initiative_project_state') }}
		</td>
		<td width="50%" class="ans_">
			{{ $preFilledForm['initiative_project_state'] }}
		</td>
	</tr>
	
	
</table>

<table border="0" cellspacing="20px" cellpadding="15px">
	<tr>
		<th colspan="2">
			{{ lang('info_on_initiative_or_exp_or_proj') }}
		</th>
	</tr>
	<tr>
		<td width="50%" class="title_">
			{{ lang('start_date') }}				
		</td>
		<td width="50%"  class="ans_">
			{{ date('d M Y',strtotime($preFilledForm['start_date'])) }}
		</td>
	</tr>
	<tr>
		<td width="50%" class="title_">
			{{ lang('end_date') }}				
		</td>

		<td width="50%"  class="ans_">
			{{ date('d M Y',strtotime($preFilledForm['end_date'])) }}
		</td>
	</tr>
	
</table>

<table border="0" cellspacing="20px" cellpadding="15px">
	<tr>
		<th colspan="2">
			{{ lang('parties_involved_in_implementation') }}
		</th>
	</tr>

	<tr>
		<td width="100%"  class="ans_">
			{{ $preFilledForm['parties_involved_in_implementation'] }}
		</td>
	</tr>
	
</table>

<table border="0" cellspacing="20px" cellpadding="15px">
	<tr>
		<th colspan="2">
			{{ lang('initiative_proj_website') }}
		</th>
	</tr>

	<tr>
		<td width="100%"  class="ans_">
			{{ $preFilledForm['initiative_proj_website'] }}
		</td>
	</tr>
	
</table>


<table border="0" cellspacing="20px" cellpadding="15px">
	<tr>
		<th colspan="2">
			{{ lang('hovt_social_networks') }}
		</th>
	</tr>

	<tr>
		<td width="25%"  class="ans_">
			{{ $preFilledForm['instagram'] }}
		</td>
		<td width="25%"  class="ans_">
			{{ $preFilledForm['twitter'] }}
		</td>
		<td width="25%"  class="ans_">
			{{ $preFilledForm['other'] }}
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
			{{ lang('project_idea') }}
		</td>
		<td width="50%"  class="ans_">
			{{ $preFilledForm['project_idea'] }}
		</td>
	</tr>
	
</table>

<table border="0" cellspacing="20px" cellpadding="15px">	
	<tr>
		<th class="smallTitle" >{{ lang('project_idea_attachments') }}</th>
	</tr>
	<tr>
		<td  class="padding_0">
			<table id="project_idea_attachments_table" class="table">
				<thead  class="thead-light">
					<tr>
					  <th class="cl_index" scope="col">#</th>
					  <th class="cl_lg"  scope="col">{{ lang('file_uploaded') }}</th>
					
					</tr>
				</thead>
				<tbody>
					
					@if(!empty($preFilledForm['project_idea_attachments_upload']))
						@foreach($preFilledForm['project_idea_attachments_upload'] as $key=>$vsFile)
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
			{{ lang('project_planning') }}
		</td>
		<td width="50%"  class="ans_">
			{{ $preFilledForm['project_planning'] }}
		</td>
	</tr>
	
</table>

<table border="0" cellspacing="20px" cellpadding="15px">	
	<tr>
		<th class="smallTitle" >{{ lang('project_planning_attachments') }}</th>
	</tr>
	<tr>
		<td  class="padding_0">
			<table id="project_planning_attachments_table" class="table">
				<thead  class="thead-light">
					<tr>
					  <th class="cl_index" scope="col">#</th>
					  <th class="cl_lg"  scope="col">{{ lang('file_uploaded') }}</th>
					 
					</tr>
				</thead>
				<tbody>
					
					@if(!empty($preFilledForm['project_planning_attachments_upload']))
						@foreach($preFilledForm['project_planning_attachments_upload'] as $key=>$vsFile)
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
			{{ lang('project_effectiveness') }}
		</td>
		<td width="50%"  class="ans_">
			{{ $preFilledForm['project_effectiveness'] }}
		</td>
	</tr>
	
</table>

<table border="0" cellspacing="20px" cellpadding="15px">	
	<tr>
		<th class="smallTitle" >{{ lang('project_effectiveness') }}</th>
	</tr>
	<tr>
		<td  class="padding_0">
			<table id="project_effectiveness_attachments_table" class="table">
				<thead  class="thead-light">
					<tr>
					  <th class="cl_index" scope="col">#</th>
					  <th class="cl_lg"  scope="col">{{ lang('file_uploaded') }}</th>
					 
					</tr>
				</thead>
				<tbody>
					
					@if(!empty($preFilledForm['project_effectiveness_attachments_upload']))
						@foreach($preFilledForm['project_effectiveness_attachments_upload'] as $key=>$vsFile)
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
			{{ lang('fourth_criteria') }}
		</th>
	</tr>

	<tr>
		<td width="50%"  class="title_">
			{{ lang('project_outcomes') }}
		</td>
		<td width="50%"  class="ans_">
			{{ $preFilledForm['project_outcomes'] }}
		</td>
	</tr>
	
</table>

<table border="0" cellspacing="20px" cellpadding="15px">	
	<tr>
		<th class="smallTitle" >{{ lang('project_outcomes_attachments') }}</th>
	</tr>
	<tr>
		<td  class="padding_0">
			<table id="project_outcomes_attachments_table" class="table">
				<thead  class="thead-light">
					<tr>
					  <th class="cl_index" scope="col">#</th>
					  <th class="cl_lg"  scope="col">{{ lang('file_uploaded') }}</th>
					
					</tr>
				</thead>
				<tbody>
					
					@if(!empty($preFilledForm['project_outcomes_attachments_upload']))
						@foreach($preFilledForm['project_outcomes_attachments_upload'] as $key=>$vsFile)
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
@section('scripts')
@parent
	<script>
		
	</script>
@stop