@section('styles')
@parent
<style>
.imageHolder{
	margin:5px;
}	
</style>
@stop

<section class="form-group basic_settings multipuploader">
	<h2>Image Gallery <small>( 2MB ) (jpg,jpeg,png)</small> </h2>
	<div class="row form-group">
		<div class="col-sm-12">
			<div id="old_gallery" class="row">
				
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="row" id="container">
		<div class="col-sm-12"><div id="no-image"></div></div>
		<div class="fileUploadBtnWrap col-sm-3 pull-right">
			<button id="pickfiles" class="btn btn-primary ">Select Photos</button>	
			<button id="start" class="btn btn-success">Upload <div id="loader" style="display:none;float:right;margin-left:5px;"><img width="25px;"src="{{ asset('assets/admin/images/loader.gif') }}" /></div></button>
			<input type="hidden" name="imageGalleryID" id="imageGalleryID" value="" />
			<div id="console"></div>
			<div id="upProgWrapper fileUploadProgressBtnWrap">
				<div id="upProg"></div>
			</div>		
		</div>	
	</div>
	@if($hasYoutubeGallery)
	<div class="row form-group">
		<div class="col-sm-12">				
			<h2>Youtube Gallery</h2>
		</div>
		<div class="col-sm-12">									
			<div class="form-group clearfix video_gallery">
				<label>Add Youtube Video Link</label>
			
					<table class="table responsive-table youtube" style="width:100%">	
					<thead>
						<tr>
							<th>Video</th>
							<th>URL</th>
							<?php /*
							<th>Thumb Image</th>
							*/ ?>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>
					
					<?php if(!empty($galleryVideos)) { ?>
						 <?php foreach ($galleryVideos as $video ){ ?>	
							 <tr id="{{ $video->gallery_image_name }}">
							 
								 <td><img src="http://img.youtube.com/vi/{{ $video->gallery_image_name }}/1.jpg"/></td>
								 <td>{{ $video->gallery_image_title }}</td>  	
								
									 <td > 
										<button class="delGalImg" data-id="{{$video->gallery_id}}" >Delete</button> <br/>
										{{ date('D d,M Y',strtotime($video->gallery_image_date))}}
									 </td>	
							 </tr>
						 <?php } ?>
					<?php }else{ ?>
						<tr>
							 <td><img src="{{ asset('assets/admin/images/no-youtube-thumb.png') }}" /></td>
							 <td><input type="text" name="shows_link[]" class="form-control" placeholder="Enter the Youtube link  here" />  	</td> 
							 
							 <td></td>  
							 
						 </tr> 
					 <?php } ?>
					</tbody>
					</table>
					<div class="col-sm-4  addVideo">+ Add More Link</div>
					
				 
				
			</div>			
		</div> 
	</div> 
	@endif
</section>
@section('styles')
@parent
<style>
.border-green{
	border:2px solid #049208;
}
.border-red{
	border:2px solid #ff0101;
}	
</style>
@stop
@section('scripts')
@parent
<script src="<?php echo asset('assets/admin/plugins/plupload/plupload.full.min.js');?>" type="text/javascript"></script>
<script>
	<?php $editID = empty($postDetails->post_id) ? '-1' : $postDetails->post_id; ?>
	function delete_gallery_image(id,elem){
		$.ajax({
			url:'<?php echo asset(Config::get('app.admin_prefix').'/image-gallery/delete/'); ?>/'+id,
			type:'get',
			async:false,
			data:{},
			dataType:'json',
			statusCode: {
				302:function(){ alert('Forbidden. Access Restricted'); },
				403:function(){ alert('Forbidden. Access Restricted','403'); },
				404:function(){ alert('Page not found','404'); },
				500:function(){ alert('Internal Server Error','500'); }
			}
			}).done(function(responseData){
			if(responseData.status==true){
				var el=  elem.closest('.imageHolder');
				el.parent().remove();
			}				
			}).fail(function(jqXHR,textStatus){
			t = false;
		});
	}
	
	function get_Image_gallery(){
		$('#old_gallery').html('');	
		$('#loader').show();
		$.ajax({
			url:'<?php echo asset(Config::get('app.admin_prefix').'/image-gallery/get_old_files/?type='.$postType.'&post='.$editID); ?>',
			type:'post',
			async:false,
			data:{_token:window.Laravel.csrfToken},
			dataType:'json',
			statusCode: {
				302:function(){ alert('Forbidden. Access Restricted'); 	$('#loader').hide();},
				403:function(){ alert('Forbidden. Access Restricted','403'); 	$('#loader').hide();},
				404:function(){ alert('Page not found','404'); 	$('#loader').hide();},
				500:function(){ alert('Internal Server Error','500'); 	$('#loader').hide();}
			}
			}).fail(function(jqXHR,textStatus){
				t = false;
				$('#loader').hide();
			})
			.done(function(responseData){
			if(responseData.status==true){
				
				var images = responseData.gallery;
				if(images.length==0){
					$('#no-image').html('No Images found!');
				}
				for(var kk=0,ll=images.length;kk<ll;kk++){
					var _title = (images[kk].gallery_image_title) ? images[kk].gallery_image_title : '';
					var _title_ar = (images[kk].gallery_image_title_arabic) ? images[kk].gallery_image_title_arabic : '';
					$('#old_gallery').append(
						'<div class="col-sm-3">'+
							'<div class="imageHolder">'+
								'<img src="<?php echo asset('storage/app/public/uploads/gallery/small/')?>/'+images[kk].gallery_image_name+'"/><div class="tool_box">'+
									'<a class="downImg" href="<?php echo asset(Config::get('app.admin_prefix').'/image-gallery/download/')?>/'+images[kk].gallery_image_name+'">'+
										'<i class="fa fa-download"></i>'+
									'</a>'+
									'<span class="delGalImg" data-id="'+images[kk].gallery_id+'">x</span></div>'+
							'</div>'+
							/*'<div class="form-group">'+
								'<input type="text" class="form-control imageTitle" name="title" value="'+_title+'" data-id="'+images[kk].gallery_id+'" data-field="title" placeholder="Title in English" />'+
								'<br/>'+
								'<input dir="rtl" type="text" class="form-control imageTitle" name="title_arabic" value="'+_title_ar+'"  data-id="'+images[kk].gallery_id+'" data-field="title_ar" placeholder="Title in Arabic" />'+
							'</div>'+*/
						'</div>'
						);
					}
			}	
			$('#loader').hide();				
			});
	}
	
	$(document).ready(function(){
		
		$('.addVideo').on('click',function(){
			
			$('.table tbody').append('<tr><td><img width="100px" src="{{ asset("assets/admin/images/no-youtube-thumb.png") }}" /></td>'+
			'<td><input type="text" name="shows_link[]" class="form-control" placeholder="Enter the Youtube link  here" /></td>'+
			'<td><a href="#" class="deleteTableRow">Delete</a></td></tr>');	
		});
		
		$('.table').on('click','.deleteTableRow',function(e){
			e.preventDefault();
			$(this).parent().parent().remove();
		});
		var cusBaseURL = '<?php echo asset('/'); ?>';
		
		
		$('#old_gallery').on('click','.delGalImg',function(e){
			Swal.fire({
			title: 'Are you sure ?',
			text: 'Are you sure you want to delete?',
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes !'
			}).then((result) => {
				if (result.value) {
					delete_gallery_image($(this).attr('data-id'),$(this));
				}
			});
		});
		$('.video_gallery').on('click','.delGalImg',function(e){
			Swal.fire({
			title: 'Are you sure ?',
			text: 'Are you sure you want to delete?',
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes !'
			}).then((result) => {
				if (result.value) {
					delete_gallery_image($(this).attr('data-id'),$(this));
				}
			});
			
		});
		
		get_Image_gallery();
		
		var uploader = new plupload.Uploader({
			runtimes : 'html5,flash,silverlight,html4',
			browse_button : 'pickfiles', // you can pass in id...
			container: document.getElementById('container'), // ... or DOM Element itself
			url : '<?php echo asset(Config::get('app.admin_prefix').'/image-gallery/file-upload?type='.$postType.'&post='.$editID)?>',
			flash_swf_url : '<?php echo asset('assets/admin/js/fu/Moxie.swf')?>',
			silverlight_xap_url :  '<?php echo asset('assets/admin/js/fu/Moxie.xap')?>',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			filters : {
				max_file_size : '10mb',
				mime_types: [
				{
                    title : "Image files", extensions : "jpg,gif,png,jpeg,bmp"},
				]
			},
			multipart_params : {
				"ImageIDE" : '',
			},
			init: {
				PostInit: function() {
					document.getElementById('start').onclick = function() {
						uploader.start();
						return false;
					};
					
					
				},
				BeforeUpload:function (up,files){
					var status_before = files.status;
					$('#loader').show();
					uploader.settings.url = '<?php echo asset(Config::get('app.admin_prefix').'/image-gallery/file-upload?type='.$postType.'&post='.$editID)?>';	
				},										
				FilesAdded: function(up, files) {

				},
				
				UploadProgress: function(up, file) {

				},
				FileUploaded:function(up,file,response){
					var t = response.response;
					var rt  = $.parseJSON(t);
					if(!rt.uploadDetails){
						alert('Upload Failed');
						return false;
					}
					rt = rt.uploadDetails;
					if(rt.status == true ){
						$('#no-image').hide();
						// $('#old_gallery').prepend('<div class="col-sm-3"><div class="imageHolder"><img src="<?php echo asset('storage/app/public/uploads/gallery/small/')?>/'+rt.fileName+'"/><a class="downImg" href="<?php echo asset('admin/gallery/download/')?>'+rt.fileName+'"><i class="fa fa-download"></i></a> <span class="delGalImg" data-id="'+rt.id+'">x</span></div></div>');
						$('#old_gallery').prepend('<div class="col-sm-3"><div class="imageHolder"><img src="<?php echo asset('storage/app/public/uploads/gallery/small/')?>/'+rt.fileName+'"/><a class="downImg" href="<?php echo asset(Config::get('app.admin_prefix').'/image-gallery/download/')?>'+rt.fileName+'"><i class="fa fa-download"></i></a><input type="hidden" name="gallaryImages[]" value="'+rt.id+'"/> <span class="delGalImg" data-id="'+rt.id+'">x</span></div></div>');
					}
				},
				UploadComplete:function(up,files){
					$('#loader').hide();
				},
				Error: function(up, err) {
					document.getElementById('console').innerHTML += "\nError #" + err.code + ": " + err.message;
				}
			}
		});
		
		uploader.init();
		
		$('.multipuploader').on('blur','.imageTitle',function(){
			$this = $(this);
			var _data = {
				'field':$this.attr('data-field'),
				'id':$this.attr('data-id'),
				'value':$this.val(),
				'_token':window.Laravel.csrfToken
			}
			$.ajax({
				url:'<?php echo asset(Config::get('app.admin_prefix').'/image-gallery/save-image-title/'); ?>',
				type:'post',
				async:false,
				data:_data,
				dataType:'json',
				statusCode: {
					302:function(){ alert('Forbidden. Access Restricted'); 	$('#loader').hide();},
					403:function(){ alert('Forbidden. Access Restricted','403'); 	$('#loader').hide();},
					404:function(){ alert('Page not found','404'); 	$('#loader').hide();},
					500:function(){ alert('Internal Server Error','500'); 	$('#loader').hide();}
				}
			}).done(function(responseData){
				if(responseData.status){
					$this.addClass('border-green');
					setTimeout(function(){
						$this.removeClass('border-green');
					},5000)
				}else{
					alert(responseData.userMessage);
					$this.addClass('border-red');
				}
			}).fail(function(jqXHR,textStatus){
			
			});
		});
	});
</script> 
	@include('admin.common.common_gallery_scripts')
@stop