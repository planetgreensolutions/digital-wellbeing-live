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
                <h2 class="pageheader-title">Add Article</h2>
            </div>
        </div>
    </div>
    {{ Form::open(['url' => [apa('post/' . $postType . '/add')], 'files' => true, 'id' => 'add-form']) }}
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
                                <label>Category</label>
                                <select class="form-control" id="esafe_category_id"
                                    name="meta[text][esafe_category_id]">
                                    @foreach ($CategoryList as $category)
                                        <option value="{{ $category->post_id }}" <?php echo old('esafe_category_id') == $category->post_id ? 'selected =="selected"' : ''; ?>>
                                            {{ $category->post_title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label>Title</label>
                                <input type="text" name="post[title]" id="post_title" class="form-control"
                                    placeholder="" value="{{ old('post_title') }}" required />
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Title [Arabic]</label>
                                <input type="text" name="post[title_arabic]" id="post_title_arabic" dir="rtl"
                                    class="form-control" placeholder="" value="{{ old('post_title_arabic') }}"
                                    required />
                            </div>
                        </div>


                    </section>

                    <hr>

                    <h4>Slide 1</h4>


                    <section class="basic_settings">

                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label>Heading</label>
                                <input type="text" name="meta[text][esafe_kid_heading1]" id="esafe_kid_heading1"
                                    class="form-control" placeholder=""
                                    value="{{ old('meta')['esafe_kid_heading1'] }}" required />
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Heading [Arabic]</label>
                                <input type="text" name="meta[text][esafe_kid_heading1_arabic]"
                                    id="esafe_kid_heading1_arabic" class="form-control" placeholder=""
                                    value="{{ old('meta')['esafe_kid_heading1_arabic'] }}" required />
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-sm-6 form-group">
                                <label>Description</label>
                                <textarea name="meta[text][esafe_kid_description1]" class="form-control "
                                    id="esafe_kid_description1"
                                    placeholder="">{{ old('meta')['text']['esafe_kid_description1'] }}</textarea>
                            </div>

                            <div class="col-sm-6 form-group">
                                <label>Description[Arabic]</label>
                                <textarea name="meta[text][esafe_kid_description1_arabic]" class="form-control"
                                    id="esafe_kid_description1_arabic"
                                    placeholder="">{{ old('meta')['text']['esafe_kid_description1_arabic'] }}</textarea>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label>Upload Image</label>
                                {!! getSinglePlUploadControl(' (Max 2 MB) (jpg,jpeg,png) 425x285 ', 'esafe_kid_image1', ['jpg', 'jpeg', 'png'], 'image', 'Select File', null, null, @Input::old('meta')['text']['esafe_kid_image1'], $postType) !!}
                            </div>
                        </div>

                    </section>

                    <hr>

                    <h4>Slide 2</h4>


                    <section class="basic_settings">

                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label>Heading</label>
                                <input type="text" name="meta[text][esafe_kid_heading2]" id="esafe_kid_heading2"
                                    class="form-control" placeholder=""
                                    value="{{ old('meta')['esafe_kid_heading2'] }}" required />
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Heading [Arabic]</label>
                                <input type="text" name="meta[text][esafe_kid_heading2_arabic]"
                                    id="esafe_kid_heading2_arabic" class="form-control" placeholder=""
                                    value="{{ old('meta')['esafe_kid_heading2_arabic'] }}" required />
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-sm-6 form-group">
                                <label>Description</label>
                                <textarea name="meta[text][esafe_kid_description2]" class="form-control "
                                    id="esafe_kid_description2"
                                    placeholder="">{{ old('meta')['text']['esafe_kid_description2'] }}</textarea>
                            </div>

                            <div class="col-sm-6 form-group">
                                <label>Description[Arabic]</label>
                                <textarea name="meta[text][esafe_kid_description2_arabic]" class="form-control"
                                    id="esafe_kid_description2_arabic"
                                    placeholder="">{{ old('meta')['text']['esafe_kid_description2_arabic'] }}</textarea>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label>Upload Image</label>
                                {!! getSinglePlUploadControl(' (Max 2 MB) (jpg,jpeg,png) 425x285 ', 'esafe_kid_image2', ['jpg', 'jpeg', 'png'], 'image', 'Select File', null, null, @Input::old('meta')['text']['esafe_kid_image2'], $postType) !!}
                            </div>
                        </div>

                    </section>

                    <hr>

                    <h4>Slide 3</h4>


                    <section class="basic_settings">

                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label>Heading</label>
                                <input type="text" name="meta[text][esafe_kid_heading3]" id="esafe_kid_heading3"
                                    class="form-control" placeholder=""
                                    value="{{ old('meta')['esafe_kid_heading3'] }}" required />
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Heading [Arabic]</label>
                                <input type="text" name="meta[text][esafe_kid_heading3_arabic]"
                                    id="esafe_kid_heading3_arabic" class="form-control" placeholder=""
                                    value="{{ old('meta')['esafe_kid_heading3_arabic'] }}" required />
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-sm-6 form-group">
                                <label>Description</label>
                                <textarea name="meta[text][esafe_kid_description3]" class="form-control "
                                    id="esafe_kid_description3"
                                    placeholder="">{{ old('meta')['text']['esafe_kid_description3'] }}</textarea>
                            </div>

                            <div class="col-sm-6 form-group">
                                <label>Description[Arabic]</label>
                                <textarea name="meta[text][esafe_kid_description3_arabic]" class="form-control"
                                    id="esafe_kid_description3_arabic"
                                    placeholder="">{{ old('meta')['text']['esafe_kid_description3_arabic'] }}</textarea>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label>Upload Image</label>
                                {!! getSinglePlUploadControl(' (Max 2 MB) (jpg,jpeg,png) 425x285 ', 'esafe_kid_image3', ['jpg', 'jpeg', 'png'], 'image', 'Select File', null, null, @Input::old('meta')['text']['esafe_kid_image3'], $postType) !!}
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
                                placeholder="" value="{{ old('post')['priority'] }}" required />
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="post_status" class="col-form-label">Status</label>
                            <select class="form-control" id="post_status" name="post[status]">
                                <option <?php echo Input::old('post')['status'] == 1 ? 'selected =="selected"' : ''; ?> value="1">Publish</option>
                                <option <?php echo Input::old('post')['status'] == 2 ? 'selected =="selected"' : ''; ?> value="2">Unpublish</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="button-control-wrapper">
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="btnsubmit" value="Save" />
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
            "{{ apa('post_media_download') }}/", "{{ asset('storage/app/public/post') }}/");

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
