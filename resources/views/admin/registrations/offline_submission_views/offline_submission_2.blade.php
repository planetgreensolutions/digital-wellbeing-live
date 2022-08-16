
			<div class="block_">
				<h3 class="sub-title text-colo-brand " data-number="01">
				  <span>{{ lang('govt_agency_info') }}</span>
				</h3>	
				<div class="row">		
					<?php /*pre($preFilledForm); */ ?>
					@include('frontend.form_view_partials.offline_image',['fieldName'=>'entity_logo','fieldLabel'=>lang('govt_entity_logo'),'step'=>1,'required'=>true,'subQuestion'=> null,'helpText'=>null])					
					@include('frontend.form_view_partials.offline_document',['fieldName'=>'offline_form','fieldLabel'=>lang('offline_form'),'step'=>1,'required'=>true,'subQuestion'=> null,'helpText'=>null])
				
				</div>
			</div>		
				<div class="block_">	
					<h3 class="sub-title text-colo-brand " data-number="02">
					  <span>{{ lang('first_criteria') }}</span>
					</h3>
					<div class="helper-text helper-text-top offline-helper-top">
					  <span>{{ lang('project_idea_attachments') }} </span>
					</div>
					@include('frontend.form_view_partials.upload_table',['fieldName'=>'project_idea_attachments_upload'])
				</div>
				
				
				<div class="block_">	
					<h3 class="sub-title text-colo-brand " data-number="03">
					  <span>{{ lang('second_criteria') }}</span>
					</h3>
					<div class="helper-text helper-text-top offline-helper-top">
					  <span>{{ lang('project_planning_attachments') }} </span>
					</div>
					@include('frontend.form_view_partials.upload_table',['fieldName'=>'project_planning_attachments_upload'])
				</div>
				
				<div class="block_">	
					<h3 class="sub-title text-colo-brand " data-number="04">
					  <span>{{ lang('third_criteria') }}</span>
					</h3>
					<div class="helper-text helper-text-top offline-helper-top">
					  <span>{{ lang('project_effectiveness_attachments') }} </span>
					</div>
					@include('frontend.form_view_partials.upload_table',['fieldName'=>'project_effectiveness_attachments_upload'])
				</div>
				
				<div class="block_">	
					<h3 class="sub-title text-colo-brand " data-number="05">
					  <span>{{ lang('fourth_criteria') }}</span>
					</h3>
					<div class="helper-text helper-text-top offline-helper-top">
					  <span>{{ lang('project_outcomes_attachments') }} </span>
					</div>
					@include('frontend.form_view_partials.upload_table',['fieldName'=>'project_outcomes_attachments_upload'])
				</div>
				
			
			
			
		
		
		@include('frontend.common.form_completed')
		

@section('scripts')
@parent
	<script>
		$(document).ready(function () {  
		});
	</script>
@stop