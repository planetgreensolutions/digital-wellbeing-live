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
	
@stop

@section('content')
@section('bodyClass')
  @parent
  hold-transition skin-blue sidebar-mini
@stop
    <aside class="right-side">
                <!-- Content Header (Page header) -->
              
                <!-- Main content -->
                <section class="content">
  		  
                    <div class="col-sm-12"><h3 class="box-title">Post Category</h3>
                  
  					<!-- /.box-header -->
                  <div class="box box-warning"> {!! session('messages')!!} </div>

                 <table id="example1" class="table table-bordered table-hover">

							 <thead>
								<tr>
									<th>#</th>
									<th>Type English</th>
									<th>Type Arabic</th>
									<th></th>
								</tr>

							</thead>								

							<tbody>	
								<?php $inc=1;?>
								@foreach ($post_category as $type) 
										<tr class="list" id="list{{$type->category_id}}" >
											<td>{{$inc++}}</td>
											<td>{{$type->category_en}}</td>
											<td>{{$type->category_ar}}</td>
											<td class="edit" id="{{$type->category_id}}" title="Edit"><i class="fa fa-pencil"></i></td>
											<td ><a href="{{ asset('admin/post-category') }}?id={{$type->category_id}}&action=delete"><i class="fa fa-remove"></i></a></td>
										</tr>
										<tr class="update" id="update{{$type->category_id}}" style="display:none;" >
											<?php echo Form::open(array('url' => array(Config::get('app.admin_prefix').'/post-category'))); ?>
											<input type="hidden" name="category_id"  value="{{$type->category_id}}" >
											<td>{{$type->category_id}}</td>
											<td><input type="text" name="type_en" id="type_en" value="{{$type->category_en}}" class="form-control" ></td>
											<td><input type="text" name="type_ar" id="type_ar"  value="{{$type->category_ar}}"  class="form-control"  dir="rtl"></td>
											<td> <input type="submit" name="updatebtnsubmit" value="Update"  class="btn btn-success btn-flat"></td>
										    {{ Form::close() }}
										</tr>
                                                                          @endforeach
									
							 </tbody>                            

							</table>
			<div class="box-body admin">
			<?php  echo (!empty($messages))?$messages:'';	
			?>
			 <?php echo Form::open(array('url' => array(Config::get('app.admin_prefix').'/post-category'))); ?>		 										
				
				<div class="row">
					<div class="col-sm-6">
						<label>Post Category </label>
						<input type="text" name="type_en" id="type_en" class="form-control" placeholder="Post Category">
					</div>
					
					<div class="col-sm-6">
						<label>Post Category [ Arabic ]</label>
						<input type="text" name="type_ar" id="type_ar" class="form-control" placeholder="Post Category" dir="rtl">
					</div>
					
				</div>
				
			 
			  <div class="row">
				<div class="col-sm-12">
				<div class="form-group">
				 <input type="submit" name="addbtnsubmit" value="Add New"  class="btn btn-success btn-flat">
				
				</div>       
				</div>       
			 {{ Form::close() }}
		
		   				  
</div>
</section><!-- /.content -->
</aside>

@stop
@section('styles')
@parent

@stop
@section('scripts')
@parent
<script>
	$(document).ready(function() {

         $('.edit').on('click',function(){
            $(".list").fadeIn();
            $(".update").fadeOut();
            var id=$(this).attr('id');
            $("#list"+id).toggle();
            $("#update"+id).toggle();
         });
          $('.remove').on('click',function(){
            var id=$(this).attr('id');
            var dataToSend = {id:id, action:"delete",_token:"{{csrf_token()}}"};

             console.log("{{ asset('admin/post-category') }}");
            $.ajax({
            type: 'POST',
            url: "{{ asset('admin/post-category') }}",
            data: dataToSend,
            contentType: false,
            cache: false,
            processData:false,
           
            success: function(msg){
                $('#messages').html(msg.message);
            }
        });
        //     sendAjax("{{ asset($lang.'/post-type') }}",'post',dataToSend,function(data){
        //     if(data.status){
                
               
        //     }
        // });
       });

	});
</script>
 

@stop
 