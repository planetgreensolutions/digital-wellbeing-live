@extends('admin.layouts.master')
@section('metatags')
	<meta name="description" content="{{{@$websiteSettings->site_meta_description}}}" />
	<meta name="keywords" content="{{{@$websiteSettings->site_meta_keyword}}}" />
	<meta name="author" content="{{{@$websiteSettings->site_meta_title}}}" />
@stop
@section('seoPageTitle')
 <title>{{{ $pageTitle }}}</title>
@stop
@section('styles')
@parent
<link href="{{asset('assets/admin/plugins/datepicker/datepicker3.css')}}" rel="stylesheet" type="text/css" />
	{{ HTML::style('assets/admin/plugins/iCheck/square/blue.css') }}
	 <style>
	.manage ul{
	padding: 0 !important;
		display: inline-block;
	}
	.manage li{
		float: left;
		width: 50px;
	}
	
	.news_meta{
		list-style-type: none;
		padding: 0;
	}
	.news_meta > li:first-child {
		font-size: 15px;
		letter-spacing: 0.02em;
		font-weight: 600;
	}
	.news_meta > li:last-child {
		margin-top: 8px;
	}
	.news_meta > li:last-child {
		padding: 0;
	}
	.news_meta > li:last-child .label{
		margin:0 2px;
		line-height: normal;
		padding: 0 10px;
	}
	.news_meta > li:last-child .label:first-child{
		margin-left: 0px;
	}
	.news_meta > li:last-child .label:last-child{
		margin-right: 0px;
	}
	.news_meta > li .label{
		font-weight: normal;
		font-size: 12px;
		
	}
	label , input  {
	border-radius: 0 !important;
	}
	.border-green{
		border:2px solid #00a65a;
	}.border-red{
		border:2px solid #ff0000;
	}
	
	.row-flex{
		display: -webkit-box;
		display: -ms-flexbox;
		display: flex;
		-ms-flex-wrap: wrap;
		    flex-wrap: wrap;
		-webkit-box-align: center;
		    -ms-flex-align: center;
		        align-items: center;
	}
	
	.btnflex{
		-ms-flex-item-align: end;
		    align-self: flex-end;
	}
  </style>
@stop

@section('content')
  @section('bodyClass')
    @parent
    hold-transition skin-blue sidebar-mini
  @stop
    <aside class="right-side">
		<section class="content">
				<?php if(!empty($userMessage)){?>
					<?php 		echo $userMessage; ?>
				<?php } ?>
		   
		   <div class="box box-warning">

				<div class="box-header with-border customHead">

					<h3 class="box-title">Transation Lists</h3>
					<a class="pull-right" href="{{ route('create_translation') }}"><button class="btn btn-success btn-flat">Create New Translation</button></a>
					
				</div><!-- /.box-header -->

				<div class="box-body no-padding">

					  <div class="filterNewsBlock col-sm-12">
						{{Form::open(array('method'=>'get','url'=>route('translate_index'),'id'=>"filterForm"))}}
							<div class="row-flex">
							
							
								<div class="col-sm-4">
									<label>Type </label>
									<select name="search_type" id="search_type" class="form-control">
										<option value="">All</option>
										<option value="messages" {{ Input::get('search_type') == 'messages' ? 'selected' : '' }}>Messages</option>
										<option value="validation" {{ Input::get('search_type') == 'validation' ? 'selected' : '' }}>Validation</option>
										<option value="months" {{ Input::get('search_type') == 'months' ? 'selected' : '' }}>Months</option>
								</select>
								</div>
								
								<div class="col-sm-4">
									<label>Locale </label>
									<select name="search_locale" id="search_locale" class="form-control">
										<option value="">All</option>
										@if(!empty($languages))
											@foreach($languages as $language)
												<option value="{{ $language->locale }}" {{ Input::get('search_locale') == $language->locale ? 'selected' : '' }}>{{ $language->name }}</option>
											@endforeach
										
										@endif
								</select>
								</div>
								
								
								<div class="col-sm-4">
								<label>Filter By Key</label>
									<input class="form-control" type="text" name="search_key" id="search_key" value="{{ Input::get('search_key') }}" placeholder="" />
								</div>
								
								<div class="col-sm-4">
									<label>Filter By Text</label>
									<input class="form-control" type="text" name="search_text" id="search_text" value="{{ Input::get('search_text') }}" placeholder="" />
								</div>
							
								<div class="col-sm-4 btnflex">
					
									<input type="submit" name="search" value="search" class="btn btn-success"/>
								</div>
								
								
								
							</div>
						</div>
						{{Form::close()}} 
						
							<?php if(!empty($translations) && is_object($translations)){ ?>
							<div class="row">
								<div class="col-sm-12">
									<div class="col-sm-6 pull-right" style="text-align:right;font-weight:bold">
										<?php /* Total {{ $translations->total()}} results found. Page {{ $translations->currentPage() }} of {{ $translations->lastPage() }}. */ ?>
									</div>
								</div>
							</div>
							<?php } ?>
						<div class="manageNews col-sm-12">
							<table id="example1" class="table table-bordered">

								 <thead>
									<tr>
										<th>Sl.No:</th>
										<th>Type</th>
										<th>Key</th>
										<th>Language</th>
										<th>Text</th>
										<th width="135px">Options</th>
									</tr>
								</thead>
								<tbody>
							 <?php if( !empty($translations) && !$translations->isEmpty() ){ ?>
									<?php foreach($translations as $key => $translation){
									?>
										<tr>
											<td> {{ $translations->firstItem() + $key }} </td>
											<td> {!! $translation->group !!}</td>
											<td> {!! $translation->item !!}</td>
											<td> {!! $translation->locale !!}</td>
											<td> <input class="form-control translate" data-id="{{ $translation->getId() }}" type="text" name="translation[{{ $translation->getId() }}]" value='{!! $translation->text !!}' dir="{{ ($translation->locale == 'ar') ? 'rtl' : 'ltr' }}" /></td>
							
											<td  class="manage">
												<ul>
																		
													<li>
														<a href="{{ route('delete_translation',$translation->getId()) }}" class="btn btn-danger btn-sm deleteRecord" title="Delete"><i class="fa fa-trash-o "></i></a> <br/>
														Delete
													</li>
												</ul>
											</td>
										</tr>
									<?php } ?>
										<td colspan="8">{{ $translations->links() }}</td>
								<?php }else{ ?>

									<tr>

										<td colspan="8" style="text-align:center">No records found!</td>

									</tr>
									<tr>
								
							</tr>

							<?php

								}

							 ?>
							
							 </tbody> 

							 </table>
						</div>
				</div><!-- /.box-body -->

      
      </div>
	  <div class="clearfix"></div>
	</section><!-- /.content -->
</aside>
@stop
@section('scripts')
@parent
<script>
	$(function(){
		
		$('.translate').on('change',function(){
			var _this = $(this);
			var _url = "{{ route('update_translation') }}";
			var _data = {
				token:'{{ csrf_token() }}',
				id:$(this).attr('data-id'),
				value:$(this).val(),
			}
			PGSADMIN.utils.sendAjax(_url,'GET',_data,function(response){
				if(response.status){
					_this.addClass('border-green');
				}else{
					_this.addClass('border-red');
				}
				
				setTimeout(function(){
					_this.removeClass('border-green border-red');
				},5000);
			});

		});
	})
</script>
@stop
