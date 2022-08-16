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
	
	<tr>
		<td width="50%" class="title_">
			{{ lang('govt_agency_name') }}
		</td>
		<td width="50%" class="ans_">
			{{ $preFilledForm['govt_agency'] }}
		</td>
	</tr>
	
	
	<tr>
		<td width="50%" class="title_">
			{{ lang('agency_estab_date') }}
		</td>
		<td width="50%" class="ans_">
			{{ $preFilledForm['agency_estab_date'] }}
		</td>
	</tr>
	
	<tr>
		<td width="50%" class="title_">
			{{ lang('no_of_govt_emp') }}
		</td>
		<td width="50%" class="ans_">
			{{ $preFilledForm['no_of_govt_emp'] }}
		</td>
	</tr>
		
	<tr>
		<td width="50%" class="title_">
			{{ lang('govt_head_address') }}
		</td>
		<td width="50%" class="ans_">
			{{ $preFilledForm['govt_head_address'] }}
		</td>
	</tr>
		
	<tr>
		<td width="50%" class="title_">
			{{ lang('agency_branch_count') }}
		</td>
		<td width="50%" class="ans_">
			{{ $preFilledForm['agency_branch_count'] }}
		</td>
	</tr>
		
	<tr>
		<td width="50%" class="title_">
			{{ lang('govt_service_centre_count') }}
		</td>
		<td width="50%" class="ans_">
			{{ $preFilledForm['govt_service_centre_count'] }}
		</td>
	</tr>
			
	<tr>
		<td width="50%" class="title_">
			{{ lang('govt_email') }}
		</td>
		<td width="50%" class="ans_">
			{{ $preFilledForm['govt_email'] }}
		</td>
	</tr>
	<tr>
		<td width="50%" class="title_">
			{{ lang('govt_website') }}
		</td>
		<td width="50%" class="ans_">
			@include('frontend.form_view_partials.url',['fieldName'=>'govt_website','fieldLabel'=>null,'step'=>1, 'ltr'=>true,'fullLength'=>true])
		</td>
	</tr>
	
</table>



<table border="0" cellspacing="20px" cellpadding="15px">
	<tr>
		<th colspan="4">
			{{ lang('hovt_social_networks') }}
		</th>
	</tr>
	
	<tr>
		<td width="25%" class="title_">
			{{ lang('instagram') }}
		</td>
		
		<td width="25" class="ans_">
			{{ $preFilledForm['instagram'] }}
		</td>
		
		<td width="25%" class="title_">
			{{ lang('twitter') }}
		</td>
		
		<td width="25" class="ans_">
			{{ $preFilledForm['twitter'] }}
		</td>
		
	</tr>
	<tr>
		
		<td width="25%" class="title_">
			{{ lang('other') }}
		</td>
		
		<td width="25" class="ans_">
			{{ $preFilledForm['other'] }}
		</td>
		<td></td>
		<td></td>
	</tr>
</table>


<table border="0" cellspacing="20px" cellpadding="15px">
	<tr>
		<th >
			{{ lang('about_govt_develop_since_estab') }}
		</th>
	</tr>
	
	<tr>
		<td  class="title_">			
			{{ lang('about_govt_develop_since_estab_help_text') }}
		</td>
	
	</tr>
	<tr>
		<td  class="ans_lg">
			{{ $preFilledForm['about_govt_develop_since_estab'] }}
		</td>
	</tr>
</table>



<table border="0" cellspacing="20px" cellpadding="15px">
	<tr>
		<th>
			{{ lang('govt_agency_main_task') }}
		</th>
	</tr>
	
	<tr>
		<td  class="title_">			
			{{ lang('govt_agency_main_task_help_text') }}
		</td>
	
	</tr>
	<tr>
		<td  class="ans_lg">
			{{ $preFilledForm['govt_agency_main_task'] }}
		</td>
	</tr>

</table>

<table border="0" cellspacing="20px" cellpadding="15px">
	<tr>
		<th >
			{{ lang('important_govt_services') }}
		</th>
	</tr>
	
	<tr>
		<td  class="title_">			
			{{ lang('important_govt_services_help_text') }}
		</td>
	
	</tr>
	<tr>
		<td  class="ans_lg">
			{{ $preFilledForm['important_govt_services'] }}
		</td>
	</tr>
</table>

<table border="0" cellspacing="20px" cellpadding="15px">
	<tr>
		<th>
			{{ lang('govt_partner_dealer') }}
		</th>
	</tr>
	
	

	<tr>
		<td  class="title_">			
			{{ lang('govt_partner_dealer_help_text') }}
		</td>
	
	</tr>
	<tr>
		<td  class="ans_lg">
			{{ $preFilledForm['govt_partner_dealer'] }}
		</td>
	</tr>
</table>

<table border="0" cellspacing="20px" cellpadding="15px" >
	<tr>
		<th>
			{{ lang('govt_strategy_doc') }}
		</th>
	</tr>
	<tr>
		<td class="title_">			
			{{ lang('vision') }}
		</td>
	
	</tr>
	<tr>
		<td class="ans_lg">
			{{ $preFilledForm['vision'] }}
		</td>
	</tr>

	<tr>
		<td class="title_">			
			{{ lang('the-message') }}
		</td>
	
	</tr>
	<tr>
		<td class="ans_lg">
			{{ $preFilledForm['the_message'] }}
		</td>
	</tr>

	<tr>
		<td class="title_">			
			{{ lang('strategic-goals') }}
		</td>
	
	</tr>
	<tr>
		<td class="ans_lg">
			{{ $preFilledForm['strategic_goals'] }}
		</td>
	</tr>
	
</table>

<table border="0" cellspacing="20px" cellpadding="15px">
	<tr>
		<th>
			{{ lang('first_criteria') }}
		</th>
	</tr>

	<tr>
		<td class="title_">			
			{{ lang('achieving_vision') }}
		</td>
	
	</tr>
	<tr>
		<td class="ans_lg">
			{{ $preFilledForm['achieving_vision'] }}
		</td>
	</tr>

	<tr>
		<td class="title_">			
			{{ lang('impact_performance_of_vision') }}
		</td>
	
	</tr>
	<tr>
		<td class="ans_lg">
			{{ $preFilledForm['impact_performance_of_vision'] }}
		</td>
	</tr>


</table>
<table border="0" cellspacing="20px" cellpadding="15px">	
	<tr>
		<th class="smallTitle" >{{ lang('vision_realization_attachments') }}</th>
	</tr>
	<tr>
		<td  class="padding_0">
			<table class="table" border="0" cellpadding="15px">
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
									<td class="cl_index"  width="10%">{{ ($key+1) }}</td>
									<td class="cl_lg"  width="90%">
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
		<th >
			{{ lang('second_criteria') }}
		</th>
	</tr>
	
	<tr>
		<td class="title_">			
			{{ lang('key_tasks_and_innovation') }}
		</td>
	
	</tr>
	<tr>
		<td class="ans_lg">
			{{ $preFilledForm['key_tasks_and_innovation'] }}
		</td>
	</tr>

	<tr>
		<td class="title_">			
			{{ lang('task_innovation_impact_performance') }}
		</td>
	
	</tr>
	<tr>
		<td class="ans_lg">
			{{ $preFilledForm['task_innovation_impact_performance'] }}
		</td>
	</tr>
</table>
<table  border="0" cellspacing="20px" cellpadding="15px">	
	<tr>
		<th class="smallTitle" >{{ lang('task_innovation_attachments') }}</th>
	</tr>
	<tr>
		<td class="padding_0">
			<table class="table" border="0" cellpadding="15px">
				<thead  class="thead-light">
					<tr>
					  <th class="cl_index" width="10%">#</th>
					  <th class="cl_lg" width="90%">{{ lang('file_uploaded') }}</th>					 
					</tr>
				</thead>
				<tbody>
				
					@if(!empty($preFilledForm['task_innovation_attachments_upload']))
						@foreach($preFilledForm['task_innovation_attachments_upload'] as $key=>$vsFile)
							<tr>
								<td class="cl_index" width="10%">{{ ($key+1) }}</td>
								<td class="cl_lg" width="90%">
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
		<th>
			{{ lang('third_criteria') }}
		</th>
	</tr>
	<tr>
		<td class="title_">			
			{{ lang('integrated_possibilities') }}
		</td>
	
	</tr>
	<tr>
		<td class="ans_lg">
			{{ $preFilledForm['integrated_possibilities'] }}
		</td>
	</tr>

	<tr>
		<td class="title_">			
			{{ lang('integrated_possibilities_performance_and_results') }}
		</td>
	
	</tr>
	<tr>
		<td class="ans_lg">
			{{ $preFilledForm['integrated_possibilities_performance_and_results'] }}
		</td>
	</tr>
</table>
<table border="0" cellspacing="20px" cellpadding="15px">

	
	<tr>
		<th class="smallTitle" >{{ lang('integrated_possibilities_attachments') }}</th>
	</tr>
	<tr>
		<td class="padding_0">
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
								<td class="cl_index" width="10%">{{ ($key+1) }}</td>
								<td class="cl_lg" width="90%">
									<div class="link_"><a href="{{ asset($lang.'/download_file/'.$vsFile['fileID'] ) }}">{{ $vsFile['fileOriginalName'] }}</a></div>
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
		<th >
			{{ lang('main_govt_indicators') }}
		</th>
	</tr>
	
	<tr>
		<td class="padding_0">
			<table class="table multi_table" border="0" cellspacing="0" cellpadding="15px">
				<thead>
					<tr>
						<th rowspan="2">م</th>
						<th rowspan="2">المؤشر</th>
						<th colspan="2">2016</th>
						<th colspan="2">2017</th>
						<th colspan="2">2018</th>
					</tr>
					
					<tr>
						<td>المستهدف</td>
						<td>المحقق</td>
						<td>المستهدف</td>
						<td>المحقق</td>
						<td>المستهدف</td>
						<td>المحقق</td>
					</tr>
				</thead>
				<tbody>
					<?php 
						$j = (!empty($preFilledForm['indicator']))?count($preFilledForm['indicator']):0;
					?>
					
					@for($i=0;$i<$j;$i++)
							
					<tr>
						<td>{{ ($i+1) }}</td>
						<td>{{ 	(!empty($preFilledForm['indicator'][$i]['title']))?$preFilledForm['indicator'][$i]['title']: ''}}</td>
						
						<td class="al_center">{{ (!empty($preFilledForm['indicator'][$i]['2016_target']))?$preFilledForm['indicator'][$i]['2016_target']: ''}}</td>
						<td class="al_center">{{ (!empty($preFilledForm['indicator'][$i]['2016_achieved']))?$preFilledForm['indicator'][$i]['2016_achieved']: ''}}</td>
						
						<td class="al_center">{{ (!empty($preFilledForm['indicator'][$i]['2017_target']))?$preFilledForm['indicator'][$i]['2017_target']: ''}}</td>
						<td class="al_center">{{ (!empty($preFilledForm['indicator'][$i]['2017_achieved']))?$preFilledForm['indicator'][$i]['2017_achieved']: ''}}</td>
						
						<td class="al_center">{{ (!empty($preFilledForm['indicator'][$i]['2018_target']))?$preFilledForm['indicator'][$i]['2018_target']: ''}}</td>
						<td class="al_center">{{ (!empty($preFilledForm['indicator'][$i]['2018_achieved']))?$preFilledForm['indicator'][$i]['2018_achieved']: ''}}</td>						
					</tr>
				
				@endfor
					
				</tbody>
				
			</table>
		</td>
	</tr>
</table>