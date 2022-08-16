@extends('admin.layouts.master')
@section('styles')
    @parent
    {{ HTML::style('assets/admin/vendor/daterangepicker/daterangepicker.css') }}
    {{ HTML::style('assets/admin/vendor/tagit/css/jquery.tagit.css') }}
    {{ HTML::style('assets/admin/vendor/tagsinput/bootstrap-tagsinput.css') }}
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
                <h2 class="pageheader-title">Edit {{ $postDetails->getData('post_title') }}
                    <?php /*
                                                            					<a class="float-sm-right" href="{{ apa('post/'.$postType.'create') }}">
                                                            						<button class="btn btn-success btn-flat">Create New</button>
                                                            					</a> */
                    ?>
                </h2>
            </div>
        </div>
    </div>
    {{ Form::open(['url' => [apa('post/' . $postType . '/edit/' . $postDetails->getData('post_id'))], 'files' => true, 'id' => 'add-form']) }}
    <input type="hidden" name="post[type]" value="{{ $postType }}" />
    <div class="row">
        <div class="col-sm-12">
            @include('admin.common.user_message')
        </div>
        <!-- ============================================================== -->
        <!-- striped table -->
        <!-- ============================================================== -->
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">

                    <section class="basic_settings">

                        <div class="row">
                            <div class="col-sm-6 form-group">
                                {!! getSinglePlUploadControl('Upload Image 425x285 (Max 2 MB) (jpg,jpeg,png) ', 'i_want_help_with_image', ['jpg', 'jpeg', 'png'], 'image', 'Select File', null, null, @$postDetails->getData('i_want_help_with_image'), $postType) !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label>Title</label>
                                <input type="text" name="post[title]" id="post_title" class="form-control"
                                    placeholder="" value="{{ $postDetails->getData('post_title') }}" />
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Title [Arabic]</label>
                                <input type="text" name="post[title_arabic]" id="post_title_arabic" dir="rtl"
                                    class="form-control" placeholder=""
                                    value="{{ $postDetails->getData('post_title_arabic') }}" />
                            </div>
                        </div>


                    </section>

                    <hr>

                    <h4>Description</h4>

                    <section class="basic_settings">

                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label>Heading</label>
                                <input type="text" name="meta[text][help_with_desc_heading]" id="help_with_desc_heading"
                                    class="form-control" placeholder=""
                                    value="{{ $postDetails->getData('help_with_desc_heading') }}" />
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Heading [Arabic]</label>
                                <input type="text" name="meta[text][help_with_desc_heading_arabic]"
                                    id="help_with_desc_heading_arabic" dir="rtl" class="form-control" placeholder=""
                                    value="{{ $postDetails->getData('help_with_desc_heading_arabic') }}" />
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-sm-6 form-group">
                                <label>Description</label>
                                <textarea name="meta[text][description]" class="form-control ckeditorEn"
                                    id="description"
                                    placeholder="">{{ $postDetails->getData('description') }}</textarea>
                            </div>


                            <div class="col-sm-6 form-group">
                                <label>Description[Arabic]</label>
                                <textarea name="meta[text][description_arabic]" class="form-control ckeditorAr"
                                    id="description_arabic" dir="rtl"
                                    placeholder="">{{ $postDetails->getData('description_arabic') }}</textarea>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-sm-6 form-group">
                                {!! getSinglePlUploadControl('Upload Image 694x712 (Max 2 MB) (jpg,jpeg,png) ', 'help_with_desc_image', ['jpg', 'jpeg', 'png'], 'image', 'Select File', null, null, @$postDetails->getData('help_with_desc_image'), $postType) !!}
                            </div>
                        </div>


                    </section>

                    <hr>

                    <h4>Steps</h4>

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>Heading</label>
                            <input type="text" name="meta[text][help_with_step_heading]" id="help_with_step_heading"
                                class="form-control" placeholder=""
                                value="{{ $postDetails->getData('help_with_step_heading') }}" />
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>Heading [Arabic]</label>
                            <input type="text" name="meta[text][help_with_step_heading_arabic]"
                                id="help_with_step_heading_arabic" dir="rtl" class="form-control" placeholder=""
                                value="{{ $postDetails->getData('help_with_step_heading_arabic') }}" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>Step1</label>
                            <input type="text" name="meta[text][help_with_step1]" id="help_with_step1"
                                class="form-control" placeholder=""
                                value="{{ $postDetails->getData('help_with_step1') }}" />
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>Step1 [Arabic]</label>
                            <input type="text" name="meta[text][help_with_step1_arabic]" id="help_with_step1_arabic"
                                dir="rtl" class="form-control" placeholder=""
                                value="{{ $postDetails->getData('help_with_step1_arabic') }}" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>Step2</label>
                            <input type="text" name="meta[text][help_with_step2]" id="help_with_step2"
                                class="form-control" placeholder=""
                                value="{{ $postDetails->getData('help_with_step2') }}" />
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>Step2 [Arabic]</label>
                            <input type="text" name="meta[text][help_with_step2_arabic]" id="help_with_step2_arabic"
                                dir="rtl" class="form-control" placeholder=""
                                value="{{ $postDetails->getData('help_with_step2_arabic') }}" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>Step3</label>
                            <input type="text" name="meta[text][help_with_step3]" id="help_with_step3"
                                class="form-control" placeholder=""
                                value="{{ $postDetails->getData('help_with_step3') }}" />
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>Step1 [Arabic]</label>
                            <input type="text" name="meta[text][help_with_step3_arabic]" id="help_with_step3_arabic"
                                dir="rtl" class="form-control" placeholder=""
                                value="{{ $postDetails->getData('help_with_step3_arabic') }}" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>Step4</label>
                            <input type="text" name="meta[text][help_with_step4]" id="help_with_step4"
                                class="form-control" placeholder=""
                                value="{{ $postDetails->getData('help_with_step4') }}" />
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>Step4 [Arabic]</label>
                            <input type="text" name="meta[text][help_with_step4_arabic]" id="help_with_step4_arabic"
                                dir="rtl" class="form-control" placeholder=""
                                value="{{ $postDetails->getData('help_with_step4_arabic') }}" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>Step5</label>
                            <input type="text" name="meta[text][help_with_step5]" id="help_with_step5"
                                class="form-control" placeholder=""
                                value="{{ $postDetails->getData('help_with_step5') }}" />
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>Step5 [Arabic]</label>
                            <input type="text" name="meta[text][help_with_step5_arabic]" id="help_with_step5_arabic"
                                dir="rtl" class="form-control" placeholder=""
                                value="{{ $postDetails->getData('help_with_step5_arabic') }}" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>Step6</label>
                            <input type="text" name="meta[text][help_with_step6]" id="help_with_step6"
                                class="form-control" placeholder=""
                                value="{{ $postDetails->getData('help_with_step6') }}" />
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>Step6 [Arabic]</label>
                            <input type="text" name="meta[text][help_with_step6_arabic]" id="help_with_step6_arabic"
                                dir="rtl" class="form-control" placeholder=""
                                value="{{ $postDetails->getData('help_with_step6_arabic') }}" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>Step7</label>
                            <input type="text" name="meta[text][help_with_step7]" id="help_with_step7"
                                class="form-control" placeholder=""
                                value="{{ $postDetails->getData('help_with_step7') }}" />
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>Step7 [Arabic]</label>
                            <input type="text" name="meta[text][help_with_step7_arabic]" id="help_with_step7_arabic"
                                dir="rtl" class="form-control" placeholder=""
                                value="{{ $postDetails->getData('help_with_step7_arabic') }}" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>Step8</label>
                            <input type="text" name="meta[text][help_with_step8]" id="help_with_step8"
                                class="form-control" placeholder=""
                                value="{{ $postDetails->getData('help_with_step8') }}" />
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>Step8 [Arabic]</label>
                            <input type="text" name="meta[text][help_with_step8_arabic]" id="help_with_step8_arabic"
                                dir="rtl" class="form-control" placeholder=""
                                value="{{ $postDetails->getData('help_with_step8_arabic') }}" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>Step9</label>
                            <input type="text" name="meta[text][help_with_step9]" id="help_with_step9"
                                class="form-control" placeholder=""
                                value="{{ $postDetails->getData('help_with_step9') }}" />
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>Step9 [Arabic]</label>
                            <input type="text" name="meta[text][help_with_step9_arabic]" id="help_with_step9_arabic"
                                dir="rtl" class="form-control" placeholder=""
                                value="{{ $postDetails->getData('help_with_step9_arabic') }}" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>Step10</label>
                            <input type="text" name="meta[text][help_with_step10]" id="help_with_step1"
                                class="form-control" placeholder=""
                                value="{{ $postDetails->getData('help_with_step10') }}" />
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>Step10 [Arabic]</label>
                            <input type="text" name="meta[text][help_with_step10_arabic]" id="help_with_step10_arabic"
                                dir="rtl" class="form-control" placeholder=""
                                value="{{ $postDetails->getData('help_with_step10_arabic') }}" />
                        </div>
                    </div>

                    </section>

                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="post_status" class="col-form-label">Display Priority</label>
                            <input type="number" min="1" name="post[priority]" id="post_priority" class="form-control"
                                placeholder="" value="{{ $postDetails->getData('post_priority') }}" />
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="post_status" class="col-form-label">Status</label>
                            <select class="form-control" id="post_status" name="post[status]">
                                <option <?php echo $postDetails->getData('post_status') == 1 ? 'selected =="selected"' : ''; ?> value="1">Publish</option>
                                <option <?php echo $postDetails->getData('post_status') == 2 ? 'selected =="selected"' : ''; ?> value="2">Unpublish</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="button-control-wrapper">
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="updatebtnsubmit" value="Save" />
                                <a href="{{ route('post_index', $postType) }}" class="btn btn-danger">Close</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ Form::close() }}
</div>
@stop

@section('scripts')
@parent
<?php /*<script src="{{  asset('assets/admin/vendor/tagit/js/tag-it.min.js') }}" type="text/javascript"></script>*/
?>
<script src="{{ asset('assets/admin/vendor/tagsinput/bootstrap-tagsinput.min.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/editor/full/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        PGSADMIN.utils.createEnglishArticleEditor();
        PGSADMIN.utils.createArabicArticleEditor();
        PGSADMIN.utils.createMediaUploader("{{ route('post_media_create', ['slug' => $postType]) }}",
            "#galleryWrapper", "{{ apa('post_media_download') }}/",
            "{{ asset('storage/app/public/post') }}/");
        PGSADMIN.utils.createAjaxFileUploader("{{ route('post_media_create', ['slug' => $postType]) }}",
            "{{ apa('post_media_download') }}/", "{{ asset('storage/app/public/post/') }}/");

        PGSADMIN.utils.youtubeVideoThumbUploader('changeImage',
            "{{ route('post_media_create', ['slug' => $postType]) }}",
            "{{ asset('storage/app/public/post/') }}/", "#galleryWrapper");

        $('#post_tags').tagsinput({
            confirmKeys: [13, 188]
        });

        $('body').on('keydown', '.bootstrap-tagsinput input', function(e) {
            var keyCode = e.keyCode || e.which;
            if (keyCode === 9 || keyCode === 13) {
                e.preventDefault();
                $("#post_tags").tagsinput('add', $(this).val());
                $(this).val('');
                return false;
            }
        });

    });
</script>
@stop
