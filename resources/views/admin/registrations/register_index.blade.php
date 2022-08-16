@extends('admin.layouts.master')
@section('styles')
@parent
@stop
@section('content')
@section('bodyClass')
@parent 
hold-transition skin-blue sidebar-mini
@stop
<div class="container-fluid dashboard-content">
   <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
         <div class="page-header">
            <h2 class="pageheader-title">Registration List
               <a class="float-sm-right" href="{{ apa('registration/download',true) }}">
               <button class="btn btn-success btn-flat">Download</button>
               </a> 
            </h2>
         </div>
		 </div>
   </div>
   <div>
      {!! $filterDOM !!}
   </div>
   <div class="row">
      <div class="col-sm-12">
         @include('admin.common.user_message')
      </div>
      <!-- ============================================================== -->
      <!-- striped table -->
      <!-- ============================================================== -->
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
         <div class="card">
            <div class="col-sm-12 card-header my-table-header">
               <div class="row align-items-center">
                  <div class="col-sm-6">
                     <h5 class="">{{ $users->total() }} {{ lang('results_found') }}</h5>
                  </div>
                  <?php /*<div class="col-sm-6"><h5 class="text-right">Showing {{ $hubList->currentPage() }} of {{  $hubList->total() }} pages</h5></div> */ ?>
               </div>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table class="table table-striped table-bordered">
                     <thead>
                        <tr>		
                           <th scope="col" width="50px">#</th>
                           <th scope="col" >{{ lang('user_details') }}</th>                           
                           <th scope="col" width="200px" style="text-align:center">{{ lang('completed_applications') }}</th>                          
                           <th scope="col" width="150px" style="text-align:center">{{ lang('date') }}</th>
                           <!-- <th scope="col">Manage</th> -->
                        </tr>
                     </thead>
                     <tbody>
                        @if( !empty($users) && $users->count() >0 )
                        <?php $inc = getPaginationSerial($users);   ?>
                        @foreach($users as $user)                               
                        <tr data-id="{{ $user->id }}">
                           <th scope="row">{{ $inc++ }}</th>
                           <td>
								<p><a  href="{!! $user->getSubmissionAnchor('',false) !!}">{{ $user->name }}</a></p>
								<p>{{ $user->email }}</p>
								<p>{{ $user->country_code.'-'.$user->user_phone_number }}</p>
								<p>
									<span><i class="flag-icon flag-icon-{{ strtolower($user->userNationality->iso) }}" title="{{ strtolower($user->userNationality->iso) }}" id="{{ strtolower($user->userNationality->iso) }}"></i></span>
									{{ $user->userNationality->country_name }}
								</p>
								
							</td>
                          
                           <td style="text-align:center">{!! $user->getSubmissionAnchor('btn btn-rounded btn-outline-brand') !!}</td>
						   <td >
								<div class="dateTimeWrapper">
									<i class="far fa-clock"></i>
									<span class="dateWrap">{{ date('d D, M Y', strtotime($user->created_at)) }}</span>
									<span class="timeWrap">{{ date('h:i a', strtotime($user->created_at)) }}</span>
								</div>
							</td>
    
                        </tr>
                        @endforeach
                        <tr>
                           <td colspan="10">{{ $users->links() }}</td>
                        </tr>
                        @else
                        <tr class="no-records">
                           <td colspan="10" class="text-center text-danger">{{ lang('no_records_found') }}</td>
                        </tr>
                        @endif
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
      <!-- ============================================================== -->
      <!-- end striped table -->
      <!-- ============================================================== -->
   </div>
</div>

@stop
@section('scripts')
@parent
<script>
   var applicantObj=[];
   downloadURLBase = "{{ apa('nominations') }}/"
   jQuery(function(){
		@if(Auth::user()->hasAnyRole(['Country Coordinator']))
			$('select[name="filter_user_nationality"]').closest('.col-sm-3').remove();
		@endif
		$('.modalTrigger').on('click',function(e){
			$('#messages').hide();
			$('.save_btn').hide();
			$('#registration').find('.container').css({'opacity':.1});
			var id = $(this).attr('data-id');
			//$('#domContent').html('<div style="text-align:center;min-height:100px;padding:100px;"><span class="dashboard-spinner spinner-info spinner-md"></span></div>')
			$.ajax({
				url:"",
				type:'post',
				async:true,
				data:{
					'_token':'{{csrf_token() }}',
					'id':id,
				},
				dataType:'json',
				statusCode: {
					302:function(){ console.log('Forbidden. Access Restricted'); },
					403:function(){ console.log('Forbidden. Access Restricted','403'); },
					404:function(){ console.log('Page not found','404'); },
					500:function(){ console.log('Internal Server Error','500'); }
				}
			}).done(function(responseData){
			if(responseData.status){
				$('#excelDownloadLink').attr('href',responseData.download_link);
				$.each(responseData.data,function(i,v){
					$('#'+i).html(v);
				});
				
			}else{
				alert(responseData.message);
			}
									
			}).always(function(){
				$('#registration').find('.container').css({'opacity':1});
			});
		
		});
   
	$('#evaluations_dom').on('change','#input_evaluation',function(e){
		$('#messages').hide();
		$('.save_btn').hide();
		if($(this).attr('data-val') != this.value){
			$('.save_btn').show();
		}
	});
	
	$('.save_btn').on('click',function(e){
		e.preventDefault();
		$('#messages').hide();	
		var id = $('#input_evaluation').attr('data-id');
		var marks = $('#input_evaluation').val();
		var URL = "";
		var data= {
			'id' : id,
			'marks' : marks,
			'_token':'{{csrf_token() }}'
		}
		sendAjax(URL,'POST',data,function(responseData){
			 $('#messages').html(responseData.userMessage).show();
            if(responseData.status){
				$('.save_btn').hide();
				$('#input_evaluation').attr('data-val',marks);
            }else{
                swal.fire('Error');
            }
        },'#saveLoader');
	})
    
    $('#registration').on('click','.changestatus',function(e){
        e.preventDefault();
        if(confirm('Are you sure ? ')){
        var URL = $(this).attr('href');
        var dataID = $(this).attr('data-id');
   
        sendAjax(URL,'POST',{'_token':'{{csrf_token() }}'},function(responseData){
            if(responseData.status){
                $('#no_status').html(responseData.status_dom);
                $('tr[data-id="'+dataID+'"] .status_td').html(responseData.status_dom)
            }else{
                swal.fire('Error');
            }
        },'#statusLoader');
        }
    });
    
   })
</script>
@stop