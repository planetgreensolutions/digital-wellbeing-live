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
</table>

<table border="0" cellspacing="20px" cellpadding="15px">
	<tr>
		<th colspan="2">
			{{ lang('first_criteria') }}
		</th>
	</tr>
	<tr>
		<td width="50%" class="title_">		
			{{ lang('project_idea_attachments') }} 
		</td>
		<td width="50%" class="ans_">
			@include('frontend.form_view_partials.upload_table',['fieldName'=>'project_idea_attachments_upload'])
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
			{{ lang('project_planning_attachments') }}
		</td>
		<td width="50%" class="ans_">
			@include('frontend.form_view_partials.upload_table',['fieldName'=>'project_planning_attachments_upload'])
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
			{{ lang('project_effectiveness_attachments') }}
		</td>
		<td width="50%" class="ans_">
			@include('frontend.form_view_partials.upload_table',['fieldName'=>'project_effectiveness_attachments_upload'])
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
			{{ lang('project_outcomes_attachments') }}
		</td>
		<td width="50%" class="ans_">
			@include('frontend.form_view_partials.upload_table',['fieldName'=>'project_outcomes_attachments_upload'])
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