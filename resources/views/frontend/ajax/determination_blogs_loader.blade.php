@if(!empty($determination_blogs) && $determination_blogs->count() > 0)
				@foreach($determination_blogs as $blogs)
				@php 
				$blogImage=getFrontendAsset('images/default_tips_image.jpg');
				if($blogs->getData('determination_blog_image')){
				$blogImage=PP($blogs->getData('determination_blog_image'));
				}

                $meta_tag = "";
                if($blogs->postTags)
                {
                    $meta_tag = $blogs->postTags->tag_name;
                }
                else
                {
                    $meta_tag = dateWithLang($blogs, 'post_created_at');
                }
				@endphp

                    <div class="blog_box box_item tip_item">
                        <div class="inner_ ">
                            <div class="top_box">
                                <a href="{{asset($lang.'/determination/blog/'.$blogs->getData('post_slug'))}}" class="full_link"></a>
                                <div class="img_box">
                                    <div class="img_ b-lazy" data-src="{{ $blogImage }}"></div>
                                    <div class="meta_tag date-meta color-blue">
                                        <ul>
                                            <li>{!! $meta_tag !!}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="details_box">
                                <div class="title_">{{$blogs->getData('post_title')}}</div>
                            </div>
                        </div>
                    </div>

	
				@endforeach
				@endif