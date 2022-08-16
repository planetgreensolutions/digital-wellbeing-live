<html>
<head>
	<style>
	body{
		font-family:'XB Riyaz'
	}	
	table {
		width: 100%;
		border:none;

	}
	table th {
	    font-size: 18px;
    	font-weight: bold;
    	    background: #b6922f;
    color: #FFF;
	}
	table .smallTitle {
	    background: transparent;
	    color: #b6922f;
	    text-align: right;
	        font-weight: bold;
    font-size: 18px;
	}
	table td.title_ {
		border-bottom:1px dashed #000;
		font-weight: 100;
		font-size: 13px;
	}
	table td.ans_lg {
		text-align: right !important;
		font-size: 12px;
		color: #4e4e4e;
    	font-weight: bold;	
	    border-bottom: 1px dashed #9e9e9e;
	}	
	table td.ans_ {
		font-size: 12px;
		color: #4e4e4e;
    	font-weight: bold;	
	    border-bottom: 1px dashed #9e9e9e;
	    text-align: center;
	}
	table td.padding_0 {
		padding: 0 !important;
	}
	table a span{
		color: #b6922f;
		text-decoration: none;
		font-weight: 100;
	}
	table .f_name {
		color: #b6922f;
		font-size: 12px;
		margin-bottom: 10px;
	}
	table .cl_lg  a {
		color: #b6922f;
		font-size: 12px;
	    margin-bottom: 10px;
    	display: block;
	}
	table .size {
	    display: inline-block;
	    background-color: #f0e9d5;
	    padding: .3em 1em;
	    border-radius: 1em;
	    font-size: 13px;
	    line-height: 1.2;
	    margin-top: .3em;
	    -webkit-box-shadow: 0 0 2px 0 #b6922f;
	    box-shadow: 0 0 2px 0 #b6922f;
	    font-weight: 600;
	    color: #000;
	
	}
	table.multi_table .al_center{
		text-align: center;
	}
	table.multi_table thead td{
		    background: #e0e0e0;
    	text-align: center;
	}
	table.table {
		    border: 1px solid #f3f3f3;
	}
	table.table th {
		    background: #bd921c;
	}
	table.table tbody tr:nth-child(even) {
		    background-color: #f3f3f3;
	}
	table.table .cl_lg {
		text-align: right;
	}
	table.table .cl_index {
		text-align: center;
	}
	</style>
</head>

<body dir="rtl">
	 @if( !empty($submissions) && $submissions->count() >0 )
		@foreach($submissions as $key => $submission)      
		<table border="0" width="100%" cellspacing="20px" cellpadding="10px">
			<tr>
				<td width="25%" class="title_">Name</td>
				<td width="25%" class="ans_">{{$submission->entity_name}}</td>
				<td width="25%" class="title_">User Entity</td>
				<td width="25%" class="ans_">{{ ($submission->entityCountry) ? $submission->entityCountry->country_name : '-' }}</td>
			</tr>
			<tr>
				<td width="25%" class="title_">Type</td>
				<td width="25%" class="ans_">{{ $submission->getFormType() }}</td>
				<td width="25%" class="title_">Date of submission</td>
				<td width="25%" class="ans_">{{ ($submission->estab_date) ? date('d M Y',strtotime($submission->form_created_at)) : '-' }}</td>
			</tr>
		</table>
		
		<?php
			$getDatamethodName = $submission->getMethodName(); 
			$preFilledForm = $submission->{$getDatamethodName}($submission->form_user_id,$submission->formManager->fm_category_slug,$submission->formManager->fm_form_slug);
		?>
		
		@if( $submission->form_type == 1)
			@include('admin.registrations.export.online.form_'.$submission->formManager->fm_form_type_id)
		@else
			@include('admin.registrations.export.offline.offline_submission_'.$submission->formManager->fm_form_type_id)
		@endif
				
		<div style="page-break-after: always;"></div>
		@endforeach
	 
	 @else
		<p>No Submission Data</p>
	 @endif
	
</body>
</html>