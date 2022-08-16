<div id="form5_wrapper">
	<div class="wiz-head">
		<h3>01</h3>
	</div>
	<section class="wiz-content">

		<div class="block_">
			<h3 class="sub-title text-colo-brand " data-number="01">
				<span>{{ lang('best_gov_employee_info') }}</span>
			</h3>
			<div class="row">

				@include('frontend.form_view_partials.fileupload',['fieldName'=>'entity_logo','fieldLabel'=>lang('candidate_pic'),'step'=>1,'required'=>true,'subQuestion'=> null,'helpText'=>null])

			</div>
			<div class="row">

				@include('frontend.form_view_partials.textbox',['fieldName'=>'candidate_name','fieldLabel'=>lang('candidate_name'),'step'=>1, 'required'=>true,'autoFocus'=>true])
				@include('frontend.form_view_partials.textbox',['fieldName'=>'candidate_job_title','fieldLabel'=>lang('candidate_job_title'),'step'=>1, 'required'=>true,'autoFocus'=>true])
				@include('frontend.form_view_partials.textbox',['fieldName'=>'candidate_employer','fieldLabel'=>lang('candidate_employer'),'step'=>1, 'required'=>true,'autoFocus'=>true])
				@include('frontend.form_view_partials.textbox',['fieldName'=>'candidate_passport_number','fieldLabel'=>lang('candidate_passport_number'),'step'=>1, 'required'=>true,'autoFocus'=>true])
				@include('frontend.form_view_partials.textbox',['fieldName'=>'candidate_id_number','fieldLabel'=>lang('candidate_id_number'),'step'=>1, 'required'=>true,'autoFocus'=>true])
				@include('frontend.form_view_partials.textbox',['fieldName'=>'candidate_work_ph_no','fieldLabel'=>lang('candidate_work_ph_no'),'step'=>1, 'required'=>true,'autoFocus'=>true])
				@include('frontend.form_view_partials.textbox',['fieldName'=>'candidate_mobile_ph_no','fieldLabel'=>lang('candidate_mobile_ph_no'),'step'=>1, 'required'=>true,'autoFocus'=>true])
				@include('frontend.form_view_partials.textbox',['fieldName'=>'candidate_email','fieldLabel'=>lang('candidate_email'),'step'=>1, 'required'=>true,'autoFocus'=>true])

			</div>

		</div>
	</section>

	<div class="wiz-head">
		<h3>02</h3>
	</div>
	<section class="wiz-content">
		<div class="block_">
			<h3 class="sub-title text-colo-brand " data-number="02">
				<span>{{ lang('functional_tasks') }}</span>
			</h3>


			
			@include('frontend.form_view_partials.functional_task_table')
			

		</div>
	</section>

	<div class="wiz-head">
		<h3>03</h3>
	</div>
	<section class="wiz-content">
		<div class="block_">
			<h3 class="sub-title text-colo-brand " data-number="03">
				<span>{{ lang('first_criteria') }}</span>
			</h3>

			<h3 class="sub-title text-colo-brand ">
				<span>{{ lang('peformance_achievement_job') }} <span>(200 كلمة)</span></span>
			</h3>
			<div class="row">
				@include('frontend.form_view_partials.textarea',['fieldName'=>'peformance_achievement_job','step'=>3,'fieldLabel'=>null,'maxWords'=>200,'helpText'=>null, 'required'=>true])
			</div>
			<div class="row">
				@include('frontend.form_view_partials.fileupload',['fieldName'=>'peformance_achievement_job_attachments','fieldLabel'=>lang('peformance_achievement_job_attachments'),'step'=>3,'required'=>true,'subQuestion'=> lang('peformance_achievement_job_attachments'),'helpText'=>null])
				<div class="tableWrapper {{ (empty($preFilledForm['peformance_achievement_job_attachments_upload']))?'init_hide':'' }}">
					<table id="peformance_achievement_job_attachments_table" class="table">
						<thead class="thead-light">
							<tr>
								<th class="cl_index" scope="col">#</th>
								<th class="cl_lg" scope="col">{{ lang('file_uploaded') }}</th>
								
							</tr>
						</thead>
						<tbody>

							@if(!empty($preFilledForm['peformance_achievement_job_attachments_upload']))
							@foreach($preFilledForm['peformance_achievement_job_attachments_upload'] as $key=>$vsFile)
							<tr>
								<td class="cl_index">{{ ($key+1) }}</td>
								<td class="cl_lg">
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
			<h3 class="sub-title text-colo-brand " data-number="04">
				<span>{{ lang('second_criteria') }}</span>
			</h3>

			<h3 class="sub-title text-colo-brand ">
				<span>{{ lang('impact_work_society') }} <span>(200 كلمة)</span></span>
			</h3>
			<div class="row">
				@include('frontend.form_view_partials.textarea',['fieldName'=>'impact_work_society','step'=>4,'fieldLabel'=>null,'maxWords'=>200,'helpText'=>null, 'required'=>true])
			</div>
			<div class="row">
				@include('frontend.form_view_partials.fileupload',['fieldName'=>'impact_work_society_attachments','fieldLabel'=>lang('impact_work_society_attachments'),'step'=>4,'required'=>true,'subQuestion'=> lang('impact_work_society_attachments'),'helpText'=>null])
				<div class="tableWrapper {{ (empty($preFilledForm['impact_work_society_attachments_upload']))?'init_hide':'' }}">
					<table id="impact_work_society_attachments_table" class="table">
						<thead class="thead-light">
							<tr>
								<th class="cl_index" scope="col">#</th>
								<th class="cl_lg" scope="col">{{ lang('file_uploaded') }}</th>
								
							</tr>
						</thead>
						<tbody>

							@if(!empty($preFilledForm['impact_work_society_attachments_upload']))
							@foreach($preFilledForm['impact_work_society_attachments_upload'] as $key=>$vsFile)
							<tr>
								<td class="cl_index">{{ ($key+1) }}</td>
								<td class="cl_lg">
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
			<h3 class="sub-title text-colo-brand " data-number="05">
				<span>{{ lang('third_criteria') }}</span>
			</h3>

			<h3 class="sub-title text-colo-brand ">
				<span>{{ lang('initiative_and_innovation') }} <span>(200 كلمة)</span></span>
			</h3>
			<div class="row">
				@include('frontend.form_view_partials.textarea',['fieldName'=>'initiative_and_innovation','step'=>5,'fieldLabel'=>null,'maxWords'=>200,'helpText'=>null, 'required'=>true])
			</div>
			<div class="row">
				@include('frontend.form_view_partials.fileupload',['fieldName'=>'initiative_and_innovation_attachments','fieldLabel'=>lang('initiative_and_innovation_attachments'),'step'=>5,'required'=>true,'subQuestion'=> lang('initiative_and_innovation_attachments'),'helpText'=>null])
				<div class="tableWrapper {{ (empty($preFilledForm['initiative_and_innovation_attachments_upload']))?'init_hide':'' }}">
					<table id="initiative_and_innovation_attachments_table" class="table">
						<thead class="thead-light">
							<tr>
								<th class="cl_index" scope="col">#</th>
								<th class="cl_lg" scope="col">{{ lang('file_uploaded') }}</th>
								
							</tr>
						</thead>
						<tbody>

							@if(!empty($preFilledForm['initiative_and_innovation_attachments_upload']))
							@foreach($preFilledForm['initiative_and_innovation_attachments_upload'] as $key=>$vsFile)
							<tr>
								<td class="cl_index">{{ ($key+1) }}</td>
								<td class="cl_lg">
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
			<h3 class="sub-title text-colo-brand " data-number="06">
				<span>{{ lang('fourth_criteria') }}</span>
			</h3>

			<h3 class="sub-title text-colo-brand ">
				<span>{{ lang('role_positive_model') }} <span>(200 كلمة)</span></span>
			</h3>
			<div class="row">
				@include('frontend.form_view_partials.textarea',['fieldName'=>'role_positive_model','step'=>6,'fieldLabel'=>null,'maxWords'=>200,'helpText'=>null, 'required'=>true])
			</div>
			<div class="row">
				@include('frontend.form_view_partials.fileupload',['fieldName'=>'role_positive_model_attachments','fieldLabel'=>lang('role_positive_model_attachments'),'step'=>6,'required'=>true,'subQuestion'=> lang('role_positive_model_attachments'),'helpText'=>null])
				<div class="tableWrapper {{ (empty($preFilledForm['role_positive_model_attachments_upload']))?'init_hide':'' }}">
					<table id="role_positive_model_attachments_table" class="table">
						<thead class="thead-light">
							<tr>
								<th class="cl_index" scope="col">#</th>
								<th class="cl_lg" scope="col">{{ lang('file_uploaded') }}</th>
								
							</tr>
						</thead>
						<tbody>

							@if(!empty($preFilledForm['role_positive_model_attachments_upload']))
							@foreach($preFilledForm['role_positive_model_attachments_upload'] as $key=>$vsFile)
							<tr>
								<td class="cl_index">{{ ($key+1) }}</td>
								<td class="cl_lg">
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
		<h3>07</h3>
	</div>
	<section class="wiz-content">
		<div class="block_">
			<h3 class="sub-title text-colo-brand " data-number="07">
				<span>{{ lang('fifth_criteria') }}</span>
			</h3>

			<h3 class="sub-title text-colo-brand ">
				<span>{{ lang('continous_learning') }} <span>(200 كلمة)</span></span>
			</h3>
			<div class="row">
				@include('frontend.form_view_partials.textarea',['fieldName'=>'continous_learning','step'=>7,'fieldLabel'=>null,'maxWords'=>200,'helpText'=>null, 'required'=>true])
			</div>
			<div class="row">
				@include('frontend.form_view_partials.fileupload',['fieldName'=>'continous_learning_attachments','fieldLabel'=>lang('continous_learning_attachments'),'step'=>7,'required'=>true,'subQuestion'=> lang('continous_learning_attachments'),'helpText'=>null])
				<div class="tableWrapper {{ (empty($preFilledForm['continous_learning_attachments_upload']))?'init_hide':'' }}">
					<table id="continous_learning_attachments_table" class="table">
						<thead class="thead-light">
							<tr>
								<th class="cl_index" scope="col">#</th>
								<th class="cl_lg" scope="col">{{ lang('file_uploaded') }}</th>
								
							</tr>
						</thead>
						<tbody>

							@if(!empty($preFilledForm['continous_learning_attachments_upload']))
							@foreach($preFilledForm['continous_learning_attachments_upload'] as $key=>$vsFile)
							<tr>
								<td class="cl_index">{{ ($key+1) }}</td>
								<td class="cl_lg">
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