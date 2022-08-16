	<div id="form1_wrapper">
        <div class="wiz-head">
            <h3>01</h3>
        </div>
		<section class="wiz-content">
		
			<div class="block_">
				<h3 class="sub-title text-colo-brand " data-number="01">
				  <span>{{ lang('govt_agency_info') }}</span>
				</h3>	
				<div class="row">
					@include('frontend.form_view_partials.textbox',['fieldName'=>'entity_country_name','fieldLabel'=>lang('entity_country'),'step'=>1, 'required'=>true,'autoFocus'=>false])
					@include('frontend.form_view_partials.offline_image',['fieldName'=>'entity_logo','fieldLabel'=>lang('govt_entity_logo'),'step'=>1,'required'=>true,'subQuestion'=> null,'helpText'=>null])					
					@include('frontend.form_view_partials.textbox',['fieldName'=>'entity_namee','fieldLabel'=>lang('govt_agency_name'),'step'=>1, 'required'=>true,'autoFocus'=>false])
					
				</div>
				<h3 class="sub-title text-colo-brand " data-number="02">
				  <span>{{ lang('govt_agency_info') }}</span>
				</h3>
				<div class="row">
					
					<?php /*@include('frontend.form_view_partials.textbox',['fieldName'=>'govt_agency','fieldLabel'=>lang('govt_agency_name'),'step'=>1, 'required'=>true,'autoFocus'=>true]) */ ?>
					@include('frontend.form_view_partials.datebox',['fieldName'=>'agency_estab_date','fieldLabel'=>lang('agency_estab_date'),'step'=>1, 'required'=>true,'className'=>'datepicker'])
					@include('frontend.form_view_partials.textbox',['fieldName'=>'govt_head_address','fieldLabel'=>lang('govt_head_address'),'step'=>1, 'required'=>true])
				</div>
				<div class="row">
					@include('frontend.form_view_partials.numberbox',['fieldName'=>'no_of_govt_emp','fieldLabel'=>lang('no_of_govt_emp'),'step'=>1, 'required'=>true])
					@include('frontend.form_view_partials.numberbox',['fieldName'=>'agency_branch_count','step'=>1,'fieldLabel'=>lang('agency_branch_count')])
				</div>
				<div class="row">					
					@include('frontend.form_view_partials.numberbox',['fieldName'=>'govt_service_centre_count','step'=>1, 'fieldLabel'=>lang('govt_service_centre_count')])
					@include('frontend.form_view_partials.email',['fieldName'=>'govt_email','step'=>1, 'fieldLabel'=>lang('govt_email') , 'required'=>true])
				</div>
				<div class="row">
					
					@include('frontend.form_view_partials.textbox',['fieldName'=>'govt_phone','step'=>1, 'fieldLabel'=>lang('govt_phone'), 'required'=>true,'className'=>'phone'])
				</div>
			</div>
			
			<div class="block_">
				<h3 class="sub-title text-colo-brand " data-number="02">
				  <span>{{ lang('govt_website') }}</span>
				</h3>	
				
				<div class="row">
					@include('frontend.form_view_partials.url',['fieldName'=>'govt_website','fieldLabel'=>null,'step'=>1, 'ltr'=>true,'fullLength'=>true])
				</div>
			</div>
			
			<div class="block_">
				<h3 class="sub-title text-colo-brand " data-number="03">
				  <span>{{ lang('hovt_social_networks') }}</span>
				</h3>	
				
				<div class="row">
					@include('frontend.form_view_partials.url',['fieldName'=>'instagram','fieldLabel'=>lang('instagram'),'step'=>1,'ltr'=>true])
					@include('frontend.form_view_partials.url',['fieldName'=>'twitter','fieldLabel'=>lang('twitter'),'step'=>1,'ltr'=>true])
				</div>				
				<div class="row">
					@include('frontend.form_view_partials.url',['fieldName'=>'other','fieldLabel'=>lang('other'),'step'=>1,'ltr'=>true,'fullLength'=>true])
				</div>				
			</div>
		</section>
		
		<div class="wiz-head">
            <h3>02</h3>
        </div>
		<section class="wiz-content">
			<div class="block_">
				<h3 class="sub-title text-colo-brand " data-number="04">
				  <span>{{ lang('about_govt_develop_since_estab') }} </span>
				</h3>
				<div class="row">
					@include('frontend.form_view_partials.textarea',['fieldName'=>'about_govt_develop_since_estab','step'=>2,'fieldLabel'=>null,'maxWords'=>200,'helpText'=>lang('about_govt_develop_since_estab_help_text'), 'required'=>true])
				</div>				
			</div>
			<div class="block_">
				<h3 class="sub-title text-colo-brand " data-number="05">
				  <span>{{ lang('govt_agency_main_task') }} </span>
				</h3>
				<div class="row">
					@include('frontend.form_view_partials.textarea',['fieldName'=>'govt_agency_main_task','fieldLabel'=>null,'step'=>2,'maxWords'=>100,'helpText'=>lang('govt_agency_main_task_help_text'), 'required'=>true])
				</div>				
			</div>
			
			<div class="block_">
				<h3 class="sub-title text-colo-brand " data-number="06">
				  <span>{{ lang('important_govt_services') }} </span>
				</h3>
				<div class="row">
					@include('frontend.form_view_partials.textarea',['fieldName'=>'important_govt_services','fieldLabel'=>null,'step'=>2,'maxWords'=>100,'helpText'=>lang('important_govt_services_help_text'),'required'=>true])
				</div>				
			</div>
			
			<div class="block_">
				<h3 class="sub-title text-colo-brand " data-number="07">
				  <span>{{ lang('govt_partner_dealer') }} </span>
				</h3>
				<div class="row">
					@include('frontend.form_view_partials.textarea',['fieldName'=>'govt_partner_dealer','fieldLabel'=>null,'step'=>2,'maxWords'=>100,'helpText'=>lang('govt_partner_dealer_help_text'),'required'=>true])
				</div>				
			</div>
			
			<div class="block_">
				<h3 class="sub-title text-colo-brand " data-number="08">
				  <span>{{ lang('govt_strategy_doc') }}</span>
				</h3>
				<div class="row">				
					@include('frontend.form_view_partials.textarea',['fieldName'=>'vision','fieldLabel'=>null,'step'=>2,'maxWords'=>200,'helpText'=>null,'required'=>true,'subQuestion'=> lang('vision')])
				</div>
				<div class="row">			
					@include('frontend.form_view_partials.textarea',['fieldName'=>'the_message','fieldLabel'=>null,'step'=>2,'maxWords'=>200,'helpText'=>null,'required'=>true,'subQuestion'=> lang('the-message')])
				</div>
				<div class="row">	 
					@include('frontend.form_view_partials.textarea',['fieldName'=>'strategic_goals','fieldLabel'=>null,'step'=>2,'maxWords'=>200,'helpText'=>null,'required'=>true,'subQuestion'=> lang('strategic-goals')])
				</div>				
			</div>
		</section>
		
		
		<div class="wiz-head">
			<h3>03</h3>
		</div>
		<section class="wiz-content">
			<div class="block_">
				<h3 class="sub-title text-colo-brand " data-number="09">
				  <span>{{ lang('first_criteria') }}</span>
				</h3>
				<div class="row">
					@include('frontend.form_view_partials.textarea',['fieldName'=>'achieving_vision','fieldLabel'=>null,'step'=>3,'maxWords'=>200,'helpText'=>null,'required'=>true,'subQuestion'=> lang('achieving_vision')])
				</div>
				<div class="row">
					@include('frontend.form_view_partials.textarea',['fieldName'=>'impact_performance_of_vision','fieldLabel'=>null,'step'=>3,'maxWords'=>200,'helpText'=>null,'required'=>true,'subQuestion'=> lang('impact_performance_of_vision')])
				</div>
				<div class="row">					
					@include('frontend.form_view_partials.fileupload',['fieldName'=>'vision_realization_attachments','fieldLabel'=>null,'step'=>3,'required'=>true,'subQuestion'=> lang('vision_realization_attachments'),'helpText'=>lang('vision_realization_attachments_help_text')])
					<div class="tableWrapper {{ (empty($preFilledForm['visual_realization_attachments_upload']))?'init_hide':'' }}">
						<table id="vision_realization_attachments_table" class="table">
							<thead  class="thead-light">
								<tr>
								  <th class="cl_index" scope="col">#</th>
								  <th class="cl_lg"  scope="col">{{ lang('file_uploaded') }}</th>
								</tr>
							</thead>
							<tbody>
								
								@if(!empty($preFilledForm['visual_realization_attachments_upload']))
									@foreach($preFilledForm['visual_realization_attachments_upload'] as $key=>$vsFile)
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
					</div>
				</div>				
			</div>			
		</section>


		<div class="wiz-head">
			<h3>04</h3>
		</div>
		<section class="wiz-content">
			<div class="block_">
				<h3 class="sub-title text-colo-brand " data-number="10">
				  <span>{{ lang('second_criteria') }}</span>
				</h3>
				<div class="row">
					@include('frontend.form_view_partials.textarea',['fieldName'=>'key_tasks_and_innovation','fieldLabel'=>null,'step'=>4,'maxWords'=>200,'helpText'=>null,'required'=>true,'subQuestion'=> lang('key_tasks_and_innovation')])
				</div>
				<div class="row">
					
					@include('frontend.form_view_partials.textarea',['fieldName'=>'task_innovation_impact_performance','step'=>4,'fieldLabel'=>null,'maxWords'=>200,'helpText'=>null,'required'=>true,'subQuestion'=> lang('task_innovation_impact_performance')])
				</div>
				<div class="row">
					
					@include('frontend.form_view_partials.fileupload',['fieldName'=>'task_innovation_attachments','fieldLabel'=>null,'step'=>4,'required'=>true,'subQuestion'=> lang('task_innovation_attachments'), 'helpText'=>lang('task_innovation_attachments_help_text')])
					<div class="tableWrapper {{ (empty($preFilledForm['task_innovation_attachments_upload']))?'init_hide':'' }}">
						<table id="task_innovation_attachments_table" class="table">
							<thead  class="thead-light">
								<tr>
								  <th scope="col">#</th>
								  <th scope="col">{{ lang('file_uploaded') }}</th>
								 
								</tr>
							</thead>
							<tbody>
							
								@if(!empty($preFilledForm['task_innovation_attachments_upload']))
									@foreach($preFilledForm['task_innovation_attachments_upload'] as $key=>$vsFile)
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
					</div>
				</div>				
			</div>			
		</section>
		
		<div class="wiz-head">
			<h3>05</h3>
		</div>
		<section class="wiz-content">
			<div class="block_">
				<h3 class="sub-title text-colo-brand " data-number="11">
				  <span>{{ lang('third_criteria') }}</span>
				</h3>
				<div class="row">
					@include('frontend.form_view_partials.textarea',['fieldName'=>'integrated_possibilities','fieldLabel'=>null,'step'=>5,'maxWords'=>200,'helpText'=>null,'required'=>true,'subQuestion'=> lang('integrated_possibilities')])
				</div>
				<div class="row">
					@include('frontend.form_view_partials.textarea',['fieldName'=>'integrated_possibilities_performance_and_results','step'=>5,'fieldLabel'=>null,'maxWords'=>200,'helpText'=>null,'required'=>true,'subQuestion'=> lang('integrated_possibilities_performance_and_results')])
				</div>
				<div class="row">
					
					@include('frontend.form_view_partials.fileupload',['fieldName'=>'integrated_possibilities_attachments','fieldLabel'=>null,'step'=>5,'required'=>true,'subQuestion'=> lang('integrated_possibilities_attachments'),
					'helpText'=>lang('integrated_possibilities_attachments_help_text')])
					<div class="tableWrapper {{ (empty($preFilledForm['integrated_possibilities_attachments_upload']))?'init_hide':'' }}">
						<table id="integrated_possibilities_attachments_table" class="table">
							<thead  class="thead-light">
								<tr>
								  <th scope="col">#</th>
								  <th scope="col">{{ lang('file_uploaded') }}</th>
								 
								</tr>
							</thead>
							<tbody>
								@if(!empty($preFilledForm['integrated_possibilities_attachments_upload']))
									@foreach($preFilledForm['integrated_possibilities_attachments_upload'] as $key=>$vsFile)
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
					</div>
				</div>				
			</div>			
		</section>


		<div class="wiz-head">
			<h3>06</h3>
		</div>
		<section class="wiz-content">
			<div class="block_">
				<h3 class="sub-title text-colo-brand " data-number="12">
				  <span>{{ lang('main_govt_indicators') }}</span>
				</h3>
				
				<span class="helper-text" data-error="wrong" data-success="right">{{ lang('main_govt_indicators_help_text') }}</span>
				@include('frontend.form_view_partials.main_indicator_table',['step'=>6]) 
				
			</div>			
		</section>

		
	</div>


@section('scripts')
@parent
	<script>
		
	</script>
@stop