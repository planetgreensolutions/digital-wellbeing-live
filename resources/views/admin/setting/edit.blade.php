@extends('admin.layouts.master')
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
 <div class="container-fluid dashboard-content">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Website Settings </h2> 
				<div class=""></div>
            </div>
        </div>
    </div>  
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="col-sm-12 card-header form-header">
                    <div class="row align-items-center">
						<h5>Fields marked (<em>*</em>) Are mandatory</h5> 
                    </div>
                </div>

                {{ Form::open(array('url' => apa('setting'),'files'=>true,'id'=>'post-form')) }}
				<input type="hidden" name="editid" value="{{ @$rssetting->id }}" />
				<input type="hidden" name="old_location_map" value="{{ @$rssetting->location_map }}" />

                    <div class="card-body">
                        <div class="col-sm-12">
                            @include('admin.common.user_message')
                            <div class="clearfix"></div>
                            
                                 <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="title" class="col-form-label">Website Name<em>*</em></label>
                                            <input type="text" name="sitename" value="{{ @$rssetting->sitename }}" class="form-control" placeholder=""  required="" />
                                        </div>
                                    </div>
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="title_arabic" class="col-form-label">Email Recipient<em>*</em></label>
                                            <input type="text" name="enquiry_send_email" class="form-control" value="{{ @$rssetting->enquiry_send_email }}" placeholder=""  required="" />
                                        </div>
                                    </div>
                                 </div>
								 
								<div class="row"> 
									<div class="col-sm-12">
									<h4>Website Language</h4>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label>Default Language</label>
											<select class="form-control"  name="setting[default_lang]">
												<option value="en" {!! ($rssetting->default_lang=='en')?' selected="selected"':''; !!}>English</option>

													<option value="ar" {!! ($rssetting->default_lang=='ar')?' selected="selected"':''; !!}>Arabic</option>
											</select>
										</div>
									</div>
									<div class="col-sm-6">
										<label>Disable Language</label>
										<div class="col-sm-4 custom-control custom-radio">
											<input type="radio" name="setting[disable_language]" id="customRadio1" class="custom-control-input" value="1" <?php echo ($rssetting->disable_language==1)?' checked="checked"':''; ?>>
											<label class="custom-control-label w-100" for="customRadio1">English</label>
										</div>
										<div class="col-sm-4 custom-control custom-radio">
											<input type="radio" name="setting[disable_language]" id="customRadio2" class="custom-control-input" value="2" <?php echo ($rssetting->disable_language==2)?' checked="checked"':''; ?>>
											<label class="custom-control-label w-100" for="customRadio2">Arabic</label>
										</div>
										<div class="col-sm-4 custom-control custom-radio">
											<input type="radio" name="setting[disable_language]" id="customRadio3" class="custom-control-input" value="3" <?php echo ($rssetting->disable_language==3)?' checked="checked"':''; ?>>
											<label class="custom-control-label w-100" for="customRadio3">None</label>
										</div>
									</div>
								
								
								</div> 
								
								<?php /**/ ?>
								<div class="row"> 
									<div class="col-sm-12">
									<h4>Social Media Links</h4>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label>Facebook Link</label>
											<input type="text" name="setting[facebook_link]" value="<?php echo @$rssetting->facebook_link;?>" class="form-control" placeholder=""  />
										</div>
									</div> 
									<div class="col-sm-6">
										<div class="form-group">
											<label>Twitter Link</label>
											<input type="text" name="setting[twitter_link]" class="form-control" value="<?php echo @$rssetting->twitter_link;?>" placeholder=""  />
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>Youtube Link</label>
											<input type="text" name="setting[youtube_link]" value="<?php echo @$rssetting->youtube_link;?>" class="form-control" placeholder=""  />
										</div>
									</div>
									<?php /*<div class="col-sm-6">
										<div class="form-group">
											<label>Google + Link</label>
											<input type="text" name="setting[google_plus_link]" value="<?php echo @$rssetting->google_plus_link;?>" class="form-control" placeholder=""  />
										</div>
									</div>*/ ?>
									<div class="col-sm-6">
										<div class="form-group">
											<label>Instagram Link</label>
											<input type="text" name="setting[instagram_link]" value="<?php echo @$rssetting->instagram_link;?>" class="form-control" placeholder=""  />
										</div>
									</div>
									<?php /*<div class="col-sm-6">
										<div class="form-group">
											<label>LinkedIn Link</label>
											<input type="text" name="setting[linkedin_link]" value="<?php echo @$rssetting->linkedin_link;?>" class="form-control" placeholder=""  />
										</div>
									</div>*/ ?>
								
								</div>
								
								
								<div class="row"> 
									<div class="col-sm-12">
									<h4>Settings</h4>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Home Page Title</label>
											<textarea name="setting[home_page_title]" class="form-control" placeholder="SEO Keywords">{{ @$rssetting->home_page_title }}</textarea>
                                        </div>
										
                                    </div>
									
									<div class="col-sm-6">
										<div class="form-group">
                                            <label>Home Page Title [arabic]</label>
											<textarea name="setting[home_page_title_arabic]" class="form-control" placeholder="SEO Keywords">{{ @$rssetting->home_page_title_arabic }}</textarea>
                                        </div>
                                   </div>
                                </div>
								 <div class="row">  
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Home Page Meta Description</label>
											<textarea type="text" name="setting[site_meta_description]" class="form-control" >{{ @$rssetting->site_meta_description }}</textarea>
                                        </div>
										
                                    </div>
									<div class="col-sm-6">
										<div class="form-group">
                                            <label>Home Page Meta Description [arabic]</label>
											<textarea type="text" name="setting[site_meta_description_arabic]" class="form-control" >{{ @$rssetting->site_meta_description_arabic }}</textarea>
                                        </div>
                                    </div>
                                 </div>
									 <div class="row">  
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Home PageMeta Keywords</label>
											<textarea name="setting[site_meta_keyword]" class="form-control" placeholder="SEO Keywords">{{ @$rssetting->site_meta_keyword }}</textarea>
                                        </div>
										
                                    </div>
									<div class="col-sm-6">
										<div class="form-group">
                                            <label>Home PageMeta Keywords [arabic]</label>
											<textarea name="setting[site_meta_keyword_arabic]" class="form-control" placeholder="SEO Keywords">{{ @$rssetting->site_meta_keyword_arabic }}</textarea>
                                        </div>
                                    </div>
                                    </div>
									 <div class="row">  
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Home Page Meta Author Tag</label>
											<textarea type="text" name="site_meta_title" class="form-control" placeholder=""  >{{ @$rssetting->site_meta_title }}</textarea>
                                        </div>
                                    </div>
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Home Page Meta Author Tag  [arabic]</label>
											<textarea type="text" name="site_meta_title_arabic" class="form-control" placeholder=""  >{{ @$rssetting->site_meta_title_arabic }}</textarea>
                                        </div>
                                    </div>

								</div>

                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="button-control-wrapper">
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="updatebtnsubmit" value="Save"  />
                                    <a href="{{ apa('dashboard') }}" class="btn btn-danger">Close</a>
                                </div>
                            </div>
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
 </div>  
@stop

@section('scripts')
@parent
<script>
 $(document).ready(function(){
     $('#post-form').validate();

 });
</script>

@stop