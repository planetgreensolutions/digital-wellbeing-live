@extends('admin.layouts.master')
@section('content')
  @section('bodyClass')
    @parent
    hold-transition skin-blue sidebar-mini
  @stop
    <aside class="right-side">
                <!-- Content Header (Page header) -->
               
                <!-- Main content -->
                <section class="content">
  				       <div class="box container">
						<div class="row col-sm-6">	
								<h3>Manage Countries</h3>
						</div>
						<div class="col-sm-6">
							
							<div class="pull-right">	
								<a href="{{ asset(Config::get('app.admin_prefix').'/country/create') }}">
									<button class="btn bg-olive btn-flat margin">Add New</button>	
								</a>
							</div>
							
						</div>
						<div class="clearfix"></div>		
						<?php if(!empty($userMessage)) { echo $userMessage; } ?>	
						
						<div class="box-body table-responsive no-padding">	
						
						<?php  if(count($countryList)>0){ ?>												
							<table id="members1" class="table table-bordered table-hover">
							 <thead>
								<tr>
									<th>#</th>
									<th>Name</th>								
									<th>Name Arabic</th>								
									<th>Flag</th>								
                                    <th>Status</th>					
									<th>Manage</th>											
								</tr>
							</thead>								
								<tbody>	
								<?php 
									$inc=1;
									foreach ($countryList as $country){
                                        // pre($country);
									$activeUrl= asset( Config::get('app.admin_prefix').'/country/changestatus/'.$country->country_id.'/'.$country->country_status);
									$DeactiveUrl= asset(Config::get('app.admin_prefix').'/country/changestatus/'.$country->country_id.'/'.$country->country_status);
								
								?>
										<tr>
											<td>{{ $inc++ }}</td>
											<td>{!! $country->country_name !!}</td>
											<td><div style="text-align:right;direction:rtl"><strong>{!! $country->country_name_arabic !!}</strong></div></td>
											<td style="background:#ccc;text-align:center"><img src="{{ asset('assets/country-flags/svg/'.strtolower($country->iso).'.svg') }}" style="height:40px;width:80px"/></td>
                                            <td class="status">
                                                <?php echo ($country->country_status == 1)?"<a href='".$activeUrl."' class='btn btn-success btn-sm'><i class='fa fa-check-square'></i></a>":"<a href='".$DeactiveUrl."' class='btn btn-danger btn-sm'><i class='fa fa-times-circle'></i></a>"; ?>
                                            </td>
											
											<td class="manage">
												<ul>
                                                    <li>
                                                        <a href="<?php echo asset(Config::get('app.admin_prefix').'/country/edit/'.$country->country_id); ?>" class="btn btn-primary btn-sm" title="edit"><i class="fa fa-pencil"></i></a> <br/>
                                                        Edit
                                                    </li>
													<li>
														<a class="btn btn-danger btn-sm deleteRecord" href="<?php echo asset(Config::get('app.admin_prefix').'/country/delete/'.$country->country_id); ?>"  title="delete" ><i class="fa fa-trash-o"></i></a><br/>
														Delete
													</li>
												</ul>
											</td>
												
												
										</tr>
										<?php } ?>
										<tr><td colspan="5">{{ $countryList->links() }}</td></tr>
								   </tbody>                            
							</table>							
							<?php }else{ ?>
							<div class="row col-sm-12">
								<div class="alert alert-danger alert-dismissable">
									<i class="fa fa-ban"></i>
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<b>Alert!</b> No Records Found!.  
								</div> 
							</div>  
							<?php } ?>
				</div><!-- /.box-body -->                                
			</div> 	 
	</section><!-- /.content -->
</aside>   
@stop