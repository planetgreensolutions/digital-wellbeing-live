
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
		  <span>{{ lang('impressive_achievement_attachments') }}</span>
		</h3>
		<div class="helper-text helper-text-top offline-helper-top">
		  <span>{{ lang('smartapp_impact') }}</span>
		</div>
		@include('frontend.form_view_partials.upload_table',['fieldName'=>'impressive_achievement_attachments_upload'])
	</div>


	<div class="block_">	
		<h3 class="sub-title text-colo-brand " data-number="03">
		  <span>{{ lang('leadership_building_attachments') }}</span>
		</h3>
		@include('frontend.form_view_partials.upload_table',['fieldName'=>'leadership_building_attachments_upload'])
	</div>

	<div class="block_">	
		<h3 class="sub-title text-colo-brand " data-number="04">
		  <span>{{ lang('strategic_thought_attachments') }}</span>
		</h3>
		@include('frontend.form_view_partials.upload_table',['fieldName'=>'strategic_thought_attachments_upload'])
	</div>
				
	@include('frontend.common.form_completed')
		
@section('scripts')
@parent
	<script>
		$(document).ready(function () {  
		});
	</script>
@stop