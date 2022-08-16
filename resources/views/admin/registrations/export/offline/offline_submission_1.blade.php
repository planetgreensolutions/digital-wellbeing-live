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
			{{ lang('offline_form') }}
		</td>
		<td width="50%" class="ans_">
			<a class="more" href="{{ asset($lang.'/download_file/'.$preFilledForm['offline_form_fileid']) }}">
				<span>{{ $preFilledForm['offline_form_name'] }}</span>
			</a>
		</td>
	</tr>
</table>

<table border="0" cellspacing="20px" cellpadding="15px">	
	
	<tr>
		<th colspan="2">{{ lang('first_criteria') }}</th>
	</tr>
	<tr>
		<td class="smallTitle" colspan="2">{{ lang('vision_realization_attachments') }}</td>
	</tr>
	<tr>
		<td colspan="2" class="padding_0">
			<table  class="table" border="0" cellpadding="15px">
				<thead  class="thead-light">
					<tr>
						<th class="cl_index"  width="10%">#</th>
						<th class="cl_lg"  width="90%">{{ lang('file_uploaded') }}</th>									  
					</tr>
				</thead>
				<tbody>								
					@if(!empty($preFilledForm['visual_realization_attachments_upload']))
					@foreach($preFilledForm['visual_realization_attachments_upload'] as $key=>$vsFile)
					<tr>
						<td  class="cl_index"  width="10%">{{ ($key+1) }}</td>
						<td  class="cl_lg"  width="90%" >
							<div class="f_name">
								<a href="{{ asset($lang.'/download-file/'.$vsFile['fileID']) }}">
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
			
		</td>
	</tr>
</table>

<table border="0" cellspacing="20px" cellpadding="15px">		
	<tr>
		<th colspan="2">{{ lang('second_criteria') }}</th>
	</tr>
	<tr>
		<td class="smallTitle" colspan="2">{{ lang('task_innovation_attachments') }}</td>
	</tr>
	<tr>
		<td colspan="2" class="padding_0">
			<table class="table" border="0" cellpadding="15px">
				<thead  class="thead-light">
					<tr>
						<th class="cl_index"  width="10%">#</th>
						<th class="cl_lg" width="90%">{{ lang('file_uploaded') }}</th>
						
					</tr>
				</thead>
				<tbody>								
					@if(!empty($preFilledForm['task_innovation_attachments_upload']))
					@foreach($preFilledForm['task_innovation_attachments_upload'] as $key=>$vsFile)
					<tr>
						<td  class="cl_index" width="10%">{{ ($key+1) }}</td>
						<td  class="cl_lg" width="90%"  >
							<div class="f_name">
								<a href="{{ asset($lang.'/download-file/'.$vsFile['fileID']) }}">
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
		</td>
	</tr>
</table>


<table border="0" cellspacing="20px" cellpadding="15px">		
	<tr>
		<th colspan="2">{{ lang('third_criteria') }}</th>
	</tr>
	<tr>
		<td class="smallTitle" colspan="2">{{ lang('integrated_possibilities_attachments') }}</td>
	</tr>
	<tr>
		<td colspan="2" class="padding_0">
			<table class="table" border="0" cellpadding="15px">
				<thead  class="thead-light">
					<tr>
						<th class="cl_index" width="10%">#</th>
						<th class="cl_lg" width="90%">{{ lang('file_uploaded') }}</th>
						
					</tr>
				</thead>
				<tbody>
					@if(!empty($preFilledForm['integrated_possibilities_attachments_upload']))
					@foreach($preFilledForm['integrated_possibilities_attachments_upload'] as $key=>$vsFile)
					<tr>
						<td  class="cl_index" >{{ ($key+1) }}</td>
						<td  class="cl_lg" width="90%" >
							<div>
								<a href="{{ asset($lang.'/download-file/'.$vsFile['fileID']) }}">
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
		</td>
	</tr>
</table>