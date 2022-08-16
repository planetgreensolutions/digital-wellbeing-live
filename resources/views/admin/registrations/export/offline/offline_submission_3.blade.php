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
		<th colspan="2">
			{{ lang('first_criteria') }}
		</th>
	</tr>
	<tr>
		<td width="50%" class="title_">		
			{{ lang('smartapp_impact') }}
		</td>
		<td width="50%" class="ans_">
			@include('frontend.form_view_partials.upload_table',['fieldName'=>'smartapp_impact_attachments_upload'])
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
		<td width="50%" class="title_">		
			{{ lang('smartapp_innovation') }}
		</td>
		<td width="50%" class="ans_">
			@include('frontend.form_view_partials.upload_table',['fieldName'=>'smartapp_innovation_attachments_upload'])
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
		<td width="50%" class="title_">		
			{{ lang('smartapp_service_delivery') }}
		</td>
		<td width="50%" class="ans_">
			@include('frontend.form_view_partials.upload_table',['fieldName'=>'smartapp_service_delivery_attachments_upload'])
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
		<td width="50%" class="title_">		
			{{ lang('smartapp_distinctive_feature') }}
		</td>
		<td width="50%" class="ans_">
			@include('frontend.form_view_partials.upload_table',['fieldName'=>'smartapp_distinctive_feature_attachments_upload'])
		</td>
	</tr>
</table>