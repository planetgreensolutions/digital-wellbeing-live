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
		<td width="50%" class="title_">
			{{ lang('peformance_achievement_job_attachments') }}
		</td>
	</tr>
	<tr>
		<td width="50%" class="ans_">		
			@include('frontend.form_view_partials.upload_table',['fieldName'=>'peformance_achievement_job_attachments_upload'])
		</td>
	</tr>
</table>

<table border="0" cellspacing="20px" cellpadding="15px">
	<tr>
		<td width="50%" class="title_">
			{{ lang('impact_work_society_attachments') }}
		</td>
	</tr>
	<tr>
		<td width="50%" class="ans_">		
			@include('frontend.form_view_partials.upload_table',['fieldName'=>'impact_work_society_attachments_upload'])
		</td>
	</tr>
</table>

<table border="0" cellspacing="20px" cellpadding="15px">
	<tr>
		<td width="50%" class="title_">
			{{ lang('initiative_and_innovation_attachments') }}
		</td>
	</tr>
	<tr>
		<td width="50%" class="ans_">		
			@include('frontend.form_view_partials.upload_table',['fieldName'=>'initiative_and_innovation_attachments_upload'])
		</td>
	</tr>
</table>


<table border="0" cellspacing="20px" cellpadding="15px">
	<tr>
		<td width="50%" class="title_">
			{{ lang('role_positive_model_attachments') }}
		</td>
	</tr>
	<tr>
		<td width="50%" class="ans_">		
			@include('frontend.form_view_partials.upload_table',['fieldName'=>'role_positive_model_attachments_upload'])
		</td>
	</tr>
</table>

<table border="0" cellspacing="20px" cellpadding="15px">
	<tr>
		<td width="50%" class="title_">
			{{ lang('continous_learning_attachments') }}
		</td>
	</tr>
	<tr>
		<td width="50%" class="ans_">		
			@include('frontend.form_view_partials.upload_table',['fieldName'=>'continous_learning_attachments_upload'])
		</td>
	</tr>
</table>
		
@section('scripts')
@parent
	<script>
		$(document).ready(function () {  
		});
	</script>
@stop