	<div id="form3_wrapper">
        <div class="wiz-head">
            <h3>01</h3>
        </div>
		<section class="wiz-content">
		
			<div class="block_">
				<h3 class="sub-title text-colo-brand " data-number="01">
				  <span>{{ lang('smartphone_app_info') }}</span>
				</h3>	
				<div class="row">
					
					@include('frontend.form_view_partials.fileupload',['fieldName'=>'entity_logo','fieldLabel'=>lang('govt_entity_logo'),'step'=>1,'required'=>true,'subQuestion'=> null,'helpText'=>null])
					
				</div>
				<div class="row">
					
					@include('frontend.form_view_partials.textbox',['fieldName'=>'smart_app_name','fieldLabel'=>lang('smart_app_name'),'step'=>1, 'required'=>true,'autoFocus'=>true])
					@include('frontend.form_view_partials.textbox',['fieldName'=>'smartapp_agency','fieldLabel'=>lang('smartapp_agency'),'step'=>1, 'required'=>true,'autoFocus'=>true])
					
				</div>
				<div class="row">
					@include('frontend.form_view_partials.datebox',['fieldName'=>'smartapp_publish_date','fieldLabel'=>lang('smartapp_publish_date'),'step'=>1, 'required'=>true,'className'=>'datepicker'])
				</div>
				
			</div>
			
			<div class="block_">
				<h3 class="sub-title text-colo-brand " data-number="02">
				  <span>{{ lang('smartapp_website') }}</span>
				</h3>	
				
				<div class="row">
					@include('frontend.form_view_partials.url',['fieldName'=>'smartapp_website','fieldLabel'=>null,'step'=>1, 'ltr'=>true,'fullLength'=>true])
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
			
			<div class="block_">
				<h3 class="sub-title text-colo-brand " data-number="04">
				  <span>{{ lang('smartapp_download_urls') }}</span>
				</h3>	
				
				<div class="row">
					@include('frontend.form_view_partials.url',['fieldName'=>'android_app_url','fieldLabel'=>lang('android_app_url'),'step'=>1,'ltr'=>true])
					@include('frontend.form_view_partials.url',['fieldName'=>'ios_app_url','fieldLabel'=>lang('ios_app_url'),'step'=>1,'ltr'=>true])
				</div>							
			</div>
		</section>
		
		<div class="wiz-head">
            <h3>02</h3>
        </div>
		<section class="wiz-content">
			<div class="block_">
				<h3 class="sub-title text-colo-brand " data-number="05">
				  <span>{{ lang('first_criteria') }}</span>
				</h3>
				
				<h3 class="sub-title text-colo-brand " >
				  <span>{{ lang('smartapp_impact') }} <span>(200 كلمة)</span></span>
				</h3>
				<div class="row">
					@include('frontend.form_view_partials.textarea',['fieldName'=>'smartapp_impact','step'=>2,'fieldLabel'=>null,'maxWords'=>200,'helpText'=>null, 'required'=>true])
				</div>	
				<div class="row">					
					@include('frontend.form_view_partials.fileupload',['fieldName'=>'smartapp_impact_attachments','fieldLabel'=>lang('smartapp_impact_attachments'),'step'=>2,'required'=>true,'subQuestion'=> lang('smartapp_impact_attachments'),'helpText'=>null])
					<div class="tableWrapper {{ (empty($preFilledForm['smartapp_impact_attachments_upload']))?'init_hide':'' }}">
						<table id="smartapp_impact_attachments_table" class="table">
							<thead  class="thead-light">
								<tr>
								  <th class="cl_index" scope="col">#</th>
								  <th class="cl_lg"  scope="col">{{ lang('file_uploaded') }}</th>
								 
								</tr>
							</thead>
							<tbody>
								
								@if(!empty($preFilledForm['smartapp_impact_attachments_upload']))
									@foreach($preFilledForm['smartapp_impact_attachments_upload'] as $key=>$vsFile)
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
				<h3 class="sub-title text-colo-brand " data-number="06">
				  <span>{{ lang('second_criteria') }}</span>
				</h3>
				
				<h3 class="sub-title text-colo-brand ">
				  <span>{{ lang('smartapp_innovation') }} <span>(200 كلمة)</span></span>
				</h3>
				<div class="row">
					@include('frontend.form_view_partials.textarea',['fieldName'=>'smartapp_innovation','fieldLabel'=>null,'step'=>3,'maxWords'=>200,'helpText'=>null, 'required'=>true])
				</div>	
				<div class="row">					
					@include('frontend.form_view_partials.fileupload',['fieldName'=>'smartapp_innovation_attachments','fieldLabel'=>lang('smartapp_innovation_attachments'),'step'=>3,'required'=>true,'subQuestion'=> null,'helpText'=>null])
					<div class="tableWrapper {{ (empty($preFilledForm['smartapp_innovation_attachments_upload']))?'init_hide':'' }}">
						<table id="smartapp_innovation_attachments_table" class="table">
							<thead  class="thead-light">
								<tr>
								  <th class="cl_index" scope="col">#</th>
								  <th class="cl_lg"  scope="col">{{ lang('file_uploaded') }}</th>
								 
								</tr>
							</thead>
							<tbody>
								
								@if(!empty($preFilledForm['smartapp_innovation_attachments_upload']))
									@foreach($preFilledForm['smartapp_innovation_attachments_upload'] as $key=>$vsFile)
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
				<h3 class="sub-title text-colo-brand " data-number="07">
				  <span>{{ lang('third_criteria') }}</span>
				</h3>
				<h3 class="sub-title text-colo-brand " >
				  <span>{{ lang('smartapp_service_delivery') }} <span>(200 كلمة)</span></span>
				</h3>
				
					
					<div class="row">				
						@include('frontend.form_view_partials.textarea',['fieldName'=>'smartapp_service_delivery','fieldLabel'=>null,'step'=>4,'maxWords'=>200,'helpText'=>null,'required'=>true,'subQuestion'=> null])
					</div>
					<div class="row">					
						@include('frontend.form_view_partials.fileupload',['fieldName'=>'smartapp_service_delivery_attachments','fieldLabel'=>lang('smartapp_service_delivery_attachments'),'step'=>4,'required'=>true,'subQuestion'=> null,'helpText'=>null])
						<div class="tableWrapper {{ (empty($preFilledForm['smartapp_service_delivery_attachments_upload']))?'init_hide':'' }}">
							<table id="smartapp_service_delivery_attachments_table" class="table">
								<thead  class="thead-light">
									<tr>
									  <th class="cl_index" scope="col">#</th>
									  <th class="cl_lg"  scope="col">{{ lang('file_uploaded') }}</th>
									  
									</tr>
								</thead>
								<tbody>
									
									@if(!empty($preFilledForm['smartapp_service_delivery_attachments_upload']))
										@foreach($preFilledForm['smartapp_service_delivery_attachments_upload'] as $key=>$vsFile)
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
		
		<?php /*
		<div class="wiz-head">
			<h3>05</h3>
		</div>
		<section class="wiz-content">
			<div class="block_">
				<h3 class="sub-title text-colo-brand " data-number="08">
				  <span>{{ lang('fourth_criteria') }}</span>
				</h3>
				
				<h3 class="sub-title text-colo-brand " >
				  <span>{{ lang('smartapp_distinctive_feature') }} <span>(200 كلمة)</span></span>
				</h3>
				<div class="row">				
					@include('frontend.form_view_partials.textarea',['fieldName'=>'smartapp_distinctive_feature','fieldLabel'=>null,'step'=>5,'maxWords'=>200,'helpText'=>null,'required'=>true,'subQuestion'=> null])
				</div>
				<div class="row">					
					@include('frontend.form_view_partials.fileupload',['fieldName'=>'smartapp_distinctive_feature_attachments','fieldLabel'=>lang('smartapp_distinctive_feature_attachments'),'step'=>5,'required'=>true,'subQuestion'=> null,'helpText'=>null])
					<div class="tableWrapper {{ (empty($preFilledForm['smartapp_distinctive_feature_attachments_upload']))?'init_hide':'' }}">
						<table id="smartapp_distinctive_feature_attachments_table" class="table">
							<thead  class="thead-light">
								<tr>
								  <th class="cl_index" scope="col">#</th>
								  <th class="cl_lg"  scope="col">{{ lang('file_uploaded') }}</th>
								
								</tr>
							</thead>
							<tbody>
								
								@if(!empty($preFilledForm['smartapp_distinctive_feature_attachments_upload']))
									@foreach($preFilledForm['smartapp_distinctive_feature_attachments_upload'] as $key=>$vsFile)
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
		*/ ?>
	</div>

@section('scripts')
@parent
	<script>
		
	</script>
@stop