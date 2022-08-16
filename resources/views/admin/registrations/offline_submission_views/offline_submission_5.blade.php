
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
					  <span>{{ lang('peformance_achievement_job_attachments') }}</span>
					</h3>
					@include('frontend.form_view_partials.upload_table',['fieldName'=>'peformance_achievement_job_attachments_upload'])
				</div>
				
				
				<div class="block_">	
					<h3 class="sub-title text-colo-brand " data-number="03">
					  <span>{{ lang('impact_work_society_attachments') }}</span>
					</h3>
					@include('frontend.form_view_partials.upload_table',['fieldName'=>'impact_work_society_attachments_upload'])
				</div>
				
				<div class="block_">	
					<h3 class="sub-title text-colo-brand " data-number="04">
					  <span>{{ lang('initiative_and_innovation_attachments') }}</span>
					</h3>
					@include('frontend.form_view_partials.upload_table',['fieldName'=>'initiative_and_innovation_attachments_upload'])
				</div>
				
				<div class="block_">	
					<h3 class="sub-title text-colo-brand " data-number="05">
					  <span>{{ lang('role_positive_model_attachments') }}</span>
					</h3>
					@include('frontend.form_view_partials.upload_table',['fieldName'=>'role_positive_model_attachments_upload'])
				</div>
				
			
				<div class="block_">	
					<h3 class="sub-title text-colo-brand " data-number="05">
					  <span>{{ lang('continous_learning_attachments') }}</span>
					</h3>
					@include('frontend.form_view_partials.upload_table',['fieldName'=>'continous_learning_attachments_upload'])
				</div>
				
			
			
			
		
		
		@include('frontend.common.form_completed')
		

@section('scripts')
@parent
	<script>
		$(document).ready(function () {  
		});
	</script>
@stop