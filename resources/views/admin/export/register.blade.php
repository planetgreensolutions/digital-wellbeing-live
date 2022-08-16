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
  <style>
    
  </style>
@stop

@section('content')
  @section('bodyClass')
    @parent
    hold-transition skin-blue sidebar-mini
  @stop
    <aside class="right-side">

                <section class="content">

  				       <div class="box">
                            <div class="col-sm-6">
                                <h3>Registration List</h3>
                            </div>
							<div class="col-sm-6" >
								 <a class="pull-right" href="{{ asset(Config::get('app.admin_prefix').'/export/register?type=excel') }}">
                                    <button class="btn btn-success btn-flat">Export</button>
                                 </a>
							</div>
                            <div class="clearfix"></div>
						<div class="box-body table-responsive no-padding">	

						<?php  if(!empty($register)){  ?>												

							<table class="table table-bordered table-hover table-striped">

                                <thead>
									
                                    <tr>

                                        <th>Sl.No</th>

                                        <th>Name</th>
										
										<th>User Entity</th>
										
										<th>Email</th>
                                        
                                        <th>Mobile</th>
										
                                        <th>Country</th>
										
                                        <th>Registered Date</th>											

                                    </tr>
                                </thead>								

								<tbody>	

								<?php 

								$inc=getPaginationSerial($register);

								foreach ($register as $reg){ 

								?>

										<tr>

											<td><?php echo $inc++; ?></td>

											<td><?php echo $reg->user_first_name.' '. $reg->user_last_name; ?></td>
											<td><?php echo $reg->user_entity; ?></td>
											<td><?php echo $reg->email; ?></td>
											
											<td><?php echo $reg->user_phone_number; ?></td>
											
											<td><?php echo $reg->userNationality->country_name; ?></td>
											
										

											<td><?php echo date('dS F, Y H:i a',strtotime($reg->created_at)); ?></td>

										</tr>

										<?php } ?>
										<tr><td colspan="7" style="text-align: center">{{ $register->links() }}</td></tr>
								   </tbody>                            

							</table>							

							<?php }else{ ?><div clas="row col-sm-6">

								<div class="alert alert-danger alert-dismissable">

									<i class="fa fa-ban"></i>

									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

									<b>Alert!</b> No Records Found!.  

								</div> 

							</div>  <?php } ?>

				</div><!-- /.box-body -->                                

			</div> 	 

	</section><!-- /.content -->

</aside>           
@stop
@section('scripts')
@parent
@stop