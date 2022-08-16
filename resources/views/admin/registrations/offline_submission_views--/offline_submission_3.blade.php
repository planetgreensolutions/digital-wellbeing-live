
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
	  <span>{{ lang('smartapp_impact') }}</span>
	</div>
	@include('frontend.form_view_partials.upload_table',['fieldName'=>'smartapp_impact_attachments_upload'])
	</div>


	<div class="block_">	
	<h3 class="sub-title text-colo-brand " data-number="03">
	  <span>{{ lang('second_criteria') }}</span>
	</h3>
	<div class="helper-text helper-text-top offline-helper-top">
	  <span>{{ lang('smartapp_innovation') }} </span>
	</div>
	@include('frontend.form_view_partials.upload_table',['fieldName'=>'smartapp_innovation_attachments_upload'])
	</div>

	<div class="block_">	
	<h3 class="sub-title text-colo-brand " data-number="04">
	  <span>{{ lang('third_criteria') }}</span>
	</h3>
	<div class="helper-text helper-text-top offline-helper-top">
	  <span>{{ lang('smartapp_service_delivery') }} </span>
	</div>
	@include('frontend.form_view_partials.upload_table',['fieldName'=>'smartapp_service_delivery_attachments_upload'])
	</div>

	<div class="block_">	
	<h3 class="sub-title text-colo-brand " data-number="05">
	  <span>{{ lang('fourth_criteria') }}</span>
	</h3>
	<div class="helper-text helper-text-top offline-helper-top">
	  <span>{{ lang('smartapp_distinctive_feature') }} </span>
	</div>
	@include('frontend.form_view_partials.upload_table',['fieldName'=>'smartapp_distinctive_feature_attachments_upload'])
	</div>
	
	@include('frontend.common.form_completed')
		
@section('scripts')
@parent
	<script>
		$(document).ready(function () {  
		});
	</script>
@stop