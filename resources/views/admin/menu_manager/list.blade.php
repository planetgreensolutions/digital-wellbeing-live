@extends('admin.layouts.master')
@section('styles')
@parent
<link href="{{asset('assets/admin/vendor/menubuilder/menubuilder.css')}}" rel="stylesheet">
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
                    <h2 class="pageheader-title">Menu 
						@if(\Config::get('app.debug'))
						<a class="float-sm-right" href="{{ route('create_menu') }}">
							<button class="btn btn-success btn-flat">Create New</button>
						</a>
						@endif
						

					</h2>
                </div>
            </div>
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
								<h4>Menu Items</h4>
								<p>Click and drag to re-order menu items. To edit a menu item click <i class="fa fa-toggle-down"></i></p>
							</div>
                            <?php /*<div class="col-sm-6"><h5 class="text-right">Showing {{ $hubList->currentPage() }} of {{  $hubList->total() }} pages</h5></div> */ ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive-md">

							<div class="box-body table-responsive no-padding">	
							   
									
									
									<div class="col-sm-6">
										<div class="box box-info">
											
											<div class="box-body">
												<div class="cf nestable-lists">

													<div class="dd" id="nestable">
														{!! $menuHTML !!}
													</div>
													
												   
												</div>
											</div>
										</div>
									</div>
								
									  
								<div class="clearfix"></div>
								
							</div>
							
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
<script type="text/javascript" src="{{asset('assets/admin/vendor/menubuilder/jquery.nestable.js')}}"></script>
<script>
function hideMenuDetails(){
	$('.dd-item').each(function(i,v){
		$(this).removeClass('opened');
		$(this).find('.menuDetails').remove();
	});
}


$(document).ready(function(){
    $('#nestable').nestable({
        group: 1
    });
	
	$('#nestable').on('change', function(e) {
		var _sortedMenu = $(this).nestable('serialize');
		var _data = {
			_token:"{{ csrf_token() }}",
			menu : _sortedMenu
		} 

		var _url = "{{ route('sort_menu') }}";
		PGSADMIN.utils.sendAjax(_url,'POST',_data,function(response){
            if(!response.status){
				Swal.fire('Error!');
			}
        });

	});
	
	$('body').on('click','.menuDetails',function(e){
		e.stopPropagation();
        e.preventDefault();
	});
    
	
});
</script>
@stop