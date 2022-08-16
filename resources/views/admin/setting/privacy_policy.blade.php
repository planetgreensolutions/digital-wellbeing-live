@include('admin.common.header')
@include('admin.common.leftmenu') 
    <aside class="right-side">
                <!-- Content Header (Page header) -->
              
                <!-- Main content -->
                <section class="content">
  					<div class="box box-warning">
                         <div class="col-sm-12"><h3 class="box-title">Edit Privacy Policy</h3></div>
  					<!-- /.box-header -->
			<div class="box-body admin">
			<?php  echo (!empty($messages))?$messages:'';	
			?>
			 <?php echo Form::open(array('url' => array(Config::get('app.admin_prefix').'/privacy-policy'))); ?>		 										
				<input type="hidden" name="editid" value="<?php echo @$privacy->pp_id;?>" />  
				<div class="row">
					<div class="col-sm-6">
						<label>Privacy Policy</label>
						<textarea name="pp_content" id="editor1" class="form-control" placeholder="Privacy Policy"><?php echo @$privacy->pp_content;?></textarea>
					</div>
					<?php if($websiteSettings->disable_arabic != 2) { ?>
					<div class="col-sm-6">
						<label>Privacy Policy [ Arabic ]</label>
						<textarea name="pp_content_arabic" id="editor2" class="form-control" placeholder="Privacy Policy Arabic"><?php echo @$privacy->pp_content_arabic;?></textarea>
					</div>
					<?php } ?>
				</div>
				<div class="row">
				  <div class="col-sm-6">
					<label>Status</label>
					<select name="pp_status" class="form-control">
					  <option value="1" <?php echo ($privacy->pp_status==1)?' checked="checked" ':''; ?>>Activate</option>
					  <option value="0" <?php echo ($privacy->pp_status==0)?' checked="checked" ':''; ?>>Deactivate</option> 
					</select>
				  </div>    			        
			  </div> 
			  <div class="form-group"></div>
			  <div class="row">
				<div class="col-sm-12">
				<div class="form-group">
				 <input type="submit" name="updatebtnsubmit" value="Submit"  class="btn btn-success btn-flat">
				 <!--<a href="<?php echo URL::to(Config::get('app.admin_prefix').'/privacy-policy'); ?>" class="btn btn-danger btn-flat">Close</a>-->
				</div>       
				</div>       
			 {{ Form::close() }}
			 <?php //} ?>
		   				   <!-- /.box-body -->
</div>
</section><!-- /.content -->
</aside>
<script src="<?php echo URL::to('assets/admin/plugins/tinymce/tinymce.min.js'); ?>" type="text/javascript"></script>         
<script type="text/javascript">
$(function() {
	   tinymce.init({
			selector: '#editor1',
			plugins: ["link","paste","spellchecker","preview","fullscreen","code","table","filemanager","directionality"],
			toolbar: ["fullscreen | undo redo | ltr rtl  | filemanager  | bullist numlist |styleselect | bold italic | aligncenter alignright alignjustify | link"],
		});
		tinymce.init({
			selector: '#editor2',
			plugins: ["link","paste","spellchecker","preview","fullscreen","code","table","filemanager","directionality"],
			toolbar: ["fullscreen | undo redo | ltr rtl  | filemanager  | bullist numlist |styleselect | bold italic | aligncenter alignright alignjustify | link"],
		});
});
</script>
@include('admin.common.footer')