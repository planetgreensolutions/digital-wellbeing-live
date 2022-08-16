	<div id="form2_wrapper">
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
					@include('frontend.form_view_partials.textbox',['fieldName'=>'entity_namee','fieldLabel'=>lang('name_of_govt_authority'),'step'=>1, 'required'=>true,'autoFocus'=>false])
					
					
				</div>
				<h3 class="sub-title text-colo-brand " data-number="02">
				  <span>{{ lang('info_on_initiative_or_exp_or_proj') }}</span>
				</h3>	
				<div class="row">
					
					@include('frontend.form_view_partials.textbox',['fieldName'=>'initiative_project_name','fieldLabel'=>lang('initiative_project_name'),'step'=>1, 'required'=>true,'autoFocus'=>true])
					<?php /*@include('frontend.form_view_partials.textbox',['fieldName'=>'name_of_govt_authority','fieldLabel'=>lang('name_of_govt_authority'),'step'=>1, 'required'=>true,'autoFocus'=>true]) */ ?>
					@include('frontend.form_view_partials.textbox',['fieldName'=>'initiative_project_state','fieldLabel'=>lang('initiative_project_state'),'step'=>1, 'required'=>true,'autoFocus'=>true])
				</div>
				
			</div>
			
			<div class="block_">
				<h3 class="sub-title text-colo-brand " data-number="02">
				  <span>{{ lang('info_on_initiative_or_exp_or_proj') }}</span>
				</h3>	
				
				<div class="row">
					@include('frontend.form_view_partials.datebox',['fieldName'=>'start_date','fieldLabel'=>lang('start_date'),'step'=>1, 'required'=>true,'className'=>'datepicker'])
					@include('frontend.form_view_partials.datebox',['fieldName'=>'end_date','fieldLabel'=>lang('end_date'),'step'=>1, 'required'=>true,'className'=>'datepicker'])
				</div>
			</div>
			
			<div class="block_">
				<h3 class="sub-title text-colo-brand ">
				  <span>{{ lang('parties_involved_in_implementation') }} <span>({{ trans('messages.x_words',['count'=>100]) }})</span></span>
				</h3>
				<div class="row">
					@include('frontend.form_view_partials.textarea',['fieldName'=>'parties_involved_in_implementation','fieldLabel'=>null,'step'=>1,'maxWords'=>100,'helpText'=>'', 'required'=>true])
				</div>		
				
				<h3 class="sub-title text-colo-brand ">
				  <span>{{ lang('initiative_proj_website') }}</span>
				</h3>	
				
				<div class="row">
					@include('frontend.form_view_partials.url',['fieldName'=>'initiative_proj_website','fieldLabel'=>null,'step'=>1, 'ltr'=>true,'fullLength'=>true])
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
				  <span>{{ lang('first_criteria') }}</span>
				</h3>
				
				<h3 class="sub-title text-colo-brand " >
				  <span>{{ lang('project_idea') }}</span>
				</h3>
				<div class="row">
					@include('frontend.form_view_partials.textarea',['fieldName'=>'project_idea','step'=>2,'fieldLabel'=>null,'maxWords'=>200,'helpText'=>null, 'required'=>true])
				</div>	
				<div class="row">					
					@include('frontend.form_view_partials.fileupload',['fieldName'=>'project_idea_attachments','fieldLabel'=>lang('project_idea_attachments'),'step'=>2,'required'=>true,'subQuestion'=> lang('project_idea_attachments'),'helpText'=>null])
					<div class="tableWrapper {{ (empty($preFilledForm['project_idea_attachments_upload']))?'init_hide':'' }}">
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
					</div>
				</div>	
			</div>
			
			
			
		</section>
		
		
		<div class="wiz-head">
			<h3>03</h3>
		</div>
		<section class="wiz-content">
			<div class="block_">
				<h3 class="sub-title text-colo-brand " data-number="05">
				  <span>{{ lang('second_criteria') }}</span>
				</h3>
				
				<h3 class="sub-title text-colo-brand ">
				  <span>{{ lang('project_planning') }}</span></span>
				</h3>
				<div class="row">
					@include('frontend.form_view_partials.textarea',['fieldName'=>'project_planning','fieldLabel'=>null,'step'=>3,'maxWords'=>200,'helpText'=>null, 'required'=>true])
				</div>	
				<div class="row">					
					@include('frontend.form_view_partials.fileupload',['fieldName'=>'project_planning_attachments','fieldLabel'=>lang('project_planning_attachments'),'step'=>3,'required'=>true,'subQuestion'=> null,'helpText'=>null])
					<div class="tableWrapper {{ (empty($preFilledForm['project_planning_attachments_upload']))?'init_hide':'' }}">
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
					</div>
				</div>
				
			</div>			
		</section>


		<div class="wiz-head">
			<h3>04</h3>
		</div>
		<section class="wiz-content">
			<div class="block_">
				<h3 class="sub-title text-colo-brand " data-number="06">
				  <span>{{ lang('third_criteria') }}</span>
				</h3>
				<h3 class="sub-title text-colo-brand " >
				  <span>{{ lang('project_effectiveness') }}</span>
				</h3>
				
					
					<div class="row">				
						@include('frontend.form_view_partials.textarea',['fieldName'=>'project_effectiveness','fieldLabel'=>null,'step'=>4,'maxWords'=>200,'helpText'=>null,'required'=>true,'subQuestion'=> null])
					</div>
					<div class="row">					
						@include('frontend.form_view_partials.fileupload',['fieldName'=>'project_effectiveness_attachments','fieldLabel'=>lang('project_effectiveness_attachments'),'step'=>4,'required'=>true,'subQuestion'=> null,'helpText'=>null])
						<div class="tableWrapper {{ (empty($preFilledForm['project_effectiveness_attachments_upload']))?'init_hide':'' }}">
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
						</div>
					</div>			
				
						
			</div>			
		</section>
		
		<div class="wiz-head">
			<h3>05</h3>
		</div>
		<section class="wiz-content">
			<div class="block_">
				<h3 class="sub-title text-colo-brand " data-number="07">
				  <span>{{ lang('fourth_criteria') }}</span>
				</h3>
				
				<h3 class="sub-title text-colo-brand " >
				  <span>{{ lang('project_outcomes') }}</span>
				</h3>
				<div class="row">				
					@include('frontend.form_view_partials.textarea',['fieldName'=>'project_outcomes','fieldLabel'=>null,'step'=>5,'maxWords'=>200,'helpText'=>null,'required'=>true,'subQuestion'=> null])
				</div>
				<div class="row">					
					@include('frontend.form_view_partials.fileupload',['fieldName'=>'project_outcomes_attachments','fieldLabel'=>lang('project_outcomes_attachments'),'step'=>5,'required'=>true,'subQuestion'=> null,'helpText'=>null])
					<div class="tableWrapper {{ (empty($preFilledForm['project_outcomes_attachments_upload']))?'init_hide':'' }}">
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
					</div>
				</div>			
						
			</div>			
		</section>
	</div>
@section('scripts')
@parent
	<script>
		
	</script>
@stop