	<div id="form4_wrapper">
        <div class="wiz-head">
            <h3>01</h3>
        </div>
		<section class="wiz-content">
		
			<div class="block_">
				<h3 class="sub-title text-colo-brand " data-number="01">
				  <span>{{ lang('govt_agency_info') }}</span>
				</h3>	
				<div class="row">
					
					@include('frontend.form_view_partials.fileupload',['fieldName'=>'entity_logo','fieldLabel'=>lang('govt_entity_logo'),'step'=>1,'required'=>true,'subQuestion'=> null,'helpText'=>null])
					
					@include('frontend.form_view_partials.fileupload',['fieldName'=>'personal_photo','fieldLabel'=>lang('personal_photo'),'step'=>1,'required'=>true,'subQuestion'=> null,'helpText'=>null])
					
				</div>
				<h3 class="sub-title text-colo-brand " data-number="02">
				  <span>{{ lang('candidate_personal_data') }}</span>
				</h3>
				<div class="row">
					
					@include('frontend.form_view_partials.textbox',['fieldName'=>'person_name','fieldLabel'=>lang('person_name'),'step'=>1, 'required'=>true,'autoFocus'=>true])
					@include('frontend.form_view_partials.textbox',['fieldName'=>'person_job','fieldLabel'=>lang('person_job'),'step'=>1, 'required'=>true,'autoFocus'=>false])
					@include('frontend.form_view_partials.textbox',['fieldName'=>'person_workplace','fieldLabel'=>lang('person_workplace'),'step'=>1, 'required'=>true,'autoFocus'=>false])
					
					@include('frontend.form_view_partials.textbox',['fieldName'=>'person_passport_number','fieldLabel'=>lang('person_passport_number'),'step'=>1, 'required'=>true,'autoFocus'=>false])
					
					@include('frontend.form_view_partials.textbox',['fieldName'=>'person_id_number','fieldLabel'=>lang('person_id_number'),'step'=>1, 'required'=>true,'autoFocus'=>false])
					
					@include('frontend.form_view_partials.textbox',['fieldName'=>'person_work_phone','fieldLabel'=>lang('person_work_phone'),'step'=>1, 'required'=>true,'autoFocus'=>false])
					
					@include('frontend.form_view_partials.textbox',['fieldName'=>'person_mobile','fieldLabel'=>lang('person_mobile'),'step'=>1, 'required'=>true,'autoFocus'=>false])
					
					@include('frontend.form_view_partials.textbox',['fieldName'=>'person_email','fieldLabel'=>lang('person_mobile'),'step'=>1, 'required'=>true,'autoFocus'=>false])
				</div>				
			</div>
			
		</section>
		
		<div class="wiz-head">
            <h3>02</h3>
        </div>
		<section class="wiz-content">
			<div class="block_">
				<h3 class="sub-title text-colo-brand " data-number="03">
				  <span>{{ lang('functional_task') }}</span>
				</h3>	
				@include('frontend.form_view_partials.functional_task_table',['step'=>2])
			</div>
		</section>
		
		<div class="wiz-head">
            <h3>03</h3>
        </div>
		<section class="wiz-content">
			<div class="block_">
				<h3 class="sub-title text-colo-brand " data-number="04">
				  <span>{{ lang('first_criteria') }}</span>
				</h3>
				
				<h3 class="sub-title text-colo-brand " >
				  <span>{{ lang('impressive_achievement') }} <span>({{ trans('messages.x_words',['count'=>200]) }})</span></span>
				</h3>
				<div class="row">
					@include('frontend.form_view_partials.textarea',['fieldName'=>'impressive_achievement','step'=>3,'fieldLabel'=>null,'maxWords'=>200,'helpText'=>null, 'required'=>true])
				</div>	
				<div class="row">					
					@include('frontend.form_view_partials.fileupload',['fieldName'=>'impressive_achievement_attachments','fieldLabel'=>lang('impressive_achievement_attachments'),'step'=>3,'required'=>true,'subQuestion'=> lang('impressive_achievement_attachments'),'helpText'=>null])
					<div class="tableWrapper {{ (empty($preFilledForm['impressive_achievement_attachments_upload']))?'init_hide':'' }}">
						<table id="impressive_achievement_attachments_table" class="table">
							<thead  class="thead-light">
								<tr>
								  <th class="cl_index" scope="col">#</th>
								  <th class="cl_lg"  scope="col">{{ lang('file_uploaded') }}</th>
								 
								</tr>
							</thead>
							<tbody>
								
								@if(!empty($preFilledForm['impressive_achievement_attachments_upload']))
									@foreach($preFilledForm['impressive_achievement_attachments_upload'] as $key=>$vsFile)
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
				<h3 class="sub-title text-colo-brand " data-number="05">
				  <span>{{ lang('second_criteria') }}</span>
				</h3>
				
				<h3 class="sub-title text-colo-brand ">
				  <span>{{ lang('leadership_building') }} <span>({{ trans('messages.x_words',['count'=>200]) }})</span></span>
				</h3>
				<div class="row">
					@include('frontend.form_view_partials.textarea',['fieldName'=>'leadership_building','fieldLabel'=>null,'step'=>4,'maxWords'=>200,'helpText'=>null, 'required'=>true])
				</div>	
				<div class="row">					
					@include('frontend.form_view_partials.fileupload',['fieldName'=>'leadership_building_attachments','fieldLabel'=>lang('leadership_building_attachments'),'step'=>4,'required'=>true,'subQuestion'=> null,'helpText'=>null])
					<div class="tableWrapper {{ (empty($preFilledForm['leadership_building_attachments_upload']))?'init_hide':'' }}">
						<table id="leadership_building_attachments_table" class="table">
							<thead  class="thead-light">
								<tr>
								  <th class="cl_index" scope="col">#</th>
								  <th class="cl_lg"  scope="col">{{ lang('file_uploaded') }}</th>
								 
								</tr>
							</thead>
							<tbody>
								
								@if(!empty($preFilledForm['leadership_building_attachments_upload']))
									@foreach($preFilledForm['leadership_building_attachments_upload'] as $key=>$vsFile)
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
				  <span>{{ lang('strategic_thought') }} <span>({{ trans('messages.x_words',['count'=>200]) }})</span></span>
				</h3>
				
					
					<div class="row">				
						@include('frontend.form_view_partials.textarea',['fieldName'=>'strategic_thought','fieldLabel'=>null,'step'=>5,'maxWords'=>200,'helpText'=>null,'required'=>true,'subQuestion'=> null])
					</div>
					<div class="row">					
						@include('frontend.form_view_partials.fileupload',['fieldName'=>'strategic_thought_attachments','fieldLabel'=>lang('strategic_thought_attachments'),'step'=>5,'required'=>true,'subQuestion'=> null,'helpText'=>null])
						<div class="tableWrapper {{ (empty($preFilledForm['strategic_thought_attachments_upload']))?'init_hide':'' }}">
							<table id="strategic_thought_attachments_table" class="table">
								<thead  class="thead-light">
									<tr>
									  <th class="cl_index" scope="col">#</th>
									  <th class="cl_lg"  scope="col">{{ lang('file_uploaded') }}</th>
									 
									</tr>
								</thead>
								<tbody>
									
									@if(!empty($preFilledForm['strategic_thought_attachments_upload']))
										@foreach($preFilledForm['strategic_thought_attachments_upload'] as $key=>$vsFile)
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