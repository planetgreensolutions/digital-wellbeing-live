<table border="0" cellspacing="20px" cellpadding="15px">
	<tr>
		<th colspan="2">
			{{ lang('smartphone_app_info') }}
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
			{{ lang('smart_app_name') }}
		</td>
		<td width="50%" class="ans_">
			{{ $preFilledForm['smart_app_name'] }}
		</td>
	</tr>
	<tr>
		<td width="50%" class="title_">
			{{ lang('smartapp_agency') }}
		</td>
		<td width="50%" class="ans_">
			{{ $preFilledForm['smartapp_agency'] }}
		</td>
	</tr>
	<tr>
		<td width="50%" class="title_">
			{{ lang('smartapp_publish_date') }}
		</td>
		<td width="50%" class="ans_">
			{{ date('d M Y',strtotime($preFilledForm['smartapp_publish_date'])) }}
		</td>
	</tr>
</table>
<table border="0" cellspacing="20px" cellpadding="15px">
	<tr>
		<td width="50%" class="title_">
			{{ lang('smartapp_website') }}
		</td>
		<td width="50%" class="ans_">
			{{ $preFilledForm['smartapp_website'] }}
		</td>
	</tr>
</table>
<table border="0" cellspacing="20px" cellpadding="15px">
	<tr>
		<td width="50%" class="title_">
			{{ lang('hovt_social_networks') }}
		</td>
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
		<th>
			{{ lang('smartapp_download_urls') }}
		</th>
	</tr>
	<tr>
		<td width="50%"  class="title_">
			{{ lang('android_app_url') }}
		</td>
		<td width="50%"  class="ans_">
			{{ $preFilledForm['android_app_url'] }}
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
			{{ lang('smartapp_impact') }}
		</td>
		<td width="50%"  class="ans_">
			{{ $preFilledForm['smartapp_impact'] }}
		</td>
	</tr>
</table>
<table border="0" cellspacing="20px" cellpadding="15px">	
	<tr>
		<th class="smallTitle" >{{ lang('smartapp_impact_attachments') }}</th>
	</tr>
	<tr>
		<td  class="padding_0">
			<table id="smartapp_impact_attachments_table" class="table">
				<thead  class="thead-light">
					<tr>
						<th class="cl_index" scope="col">#</th>
						<th class="cl_lg"  scope="col">{{ lang('file_uploaded') }}</th>
					</tr>
				</thead>
				<tbody>
					@if(!empty($preFilledForm['smartapp_impact_attachments_upload']))
					@foreach($preFilledForm['smartapp_impact_attachments_upload'] as $key=>$vsFile)
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
			{{ lang('smartapp_innovation') }}
		</td>
		<td width="50%"  class="ans_">
			{{ $preFilledForm['smartapp_innovation'] }}
		</td>
	</tr>
</table>
<table border="0" cellspacing="20px" cellpadding="15px">	
	<tr>
		<th class="smallTitle" >{{ lang('smartapp_innovation_attachments') }}</th>
	</tr>
	<tr>
		<td  class="padding_0">
			<table id="smartapp_innovation_attachments_table" class="table">
				<thead  class="thead-light">
					<tr>
						<th class="cl_index" scope="col">#</th>
						<th class="cl_lg"  scope="col">{{ lang('file_uploaded') }}</th>
					</tr>
				</thead>
				<tbody>
					@if(!empty($preFilledForm['smartapp_innovation_attachments_upload']))
					@foreach($preFilledForm['smartapp_innovation_attachments_upload'] as $key=>$vsFile)
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
			{{ lang('smartapp_service_delivery') }}
		</td>
		<td width="50%"  class="ans_">
			{{ $preFilledForm['smartapp_service_delivery'] }}
		</td>
	</tr>
</table>
<table border="0" cellspacing="20px" cellpadding="15px">	
	<tr>
		<th class="smallTitle" >{{ lang('smartapp_service_delivery_attachments') }}</th>
	</tr>
	<tr>
		<td  class="padding_0">
			<table id="smartapp_service_delivery_attachments_table" class="table">
				<thead  class="thead-light">
					<tr>
						<th class="cl_index" scope="col">#</th>
						<th class="cl_lg"  scope="col">{{ lang('file_uploaded') }}</th>
					</tr>
				</thead>
				<tbody>
					@if(!empty($preFilledForm['smartapp_service_delivery_attachments_upload']))
					@foreach($preFilledForm['smartapp_service_delivery_attachments_upload'] as $key=>$vsFile)
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