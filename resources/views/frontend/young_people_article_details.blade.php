@extends('frontend.layouts.master') 
@section('metatags')
	<meta name="description" content="{{{@$websiteSettings->site_meta_description}}}" />
	<meta name="keywords" content="{{{@$websiteSettings->site_meta_keyword}}}" />
	<meta name="author" content="{{{@$websiteSettings->site_meta_title}}}" /> 
@stop 
@section('seoPageTitle')
	<title>
		<?php $title = ($lang == 'en') ? @$websiteSettings->sitename : @$websiteSettings->sitename_arabic; ?>
		{{ (!empty($pageTitle))? $pageTitle : @$title }}
	</title>
@stop 

@section('styles')
 @include('frontend.layouts.inner_cssfile')	 
@stop

@section('content')

@php 

$meta_tag = "";
if($postDetails->postTags)
{
    $meta_tag = $postDetails->postTags->tag_name;
}
else
{
    $meta_tag = dateWithLang($postDetails, 'post_created_at');
}
@endphp

<main class="page ">

<section class="page-section article_detail">
    <div class="container">
      
      <div class="normal_details_wrapper">
        

        <div class="content_box">
          
          <div class="head_box">
            <div class="title_">{!!  $postDetails->getData('post_title') !!}</div>
          </div>
<?php /*<span class="small_title">Digital Citizenship</span>*/ ?>
          <div class="text_box">
            <p>{!! $postDetails->getData('description')  !!}</p>
            <?php
            /*
              <div class="moretext">
            <p>{!! $postDetails->getData('description')  !!}</p>
            </div>
            <a class="more  moreless-button" href="#" data-re-more="Read more" data-re-less="Read less">
                  <div class="line_box">
                    <span></span>
                    <span></span>
                  </div>
                  <span class="text_">{{lang('read_more')}}</span>
                </a>
                */
                ?>
          </div>
          
          
        </div>

        @if (!empty($tags))
        <div class="side_box">
          <div class="inner_box">
            <ul class="art_ul">
              
              @foreach ($tags as $tag)

              @php
              if(@in_array($tag->tag_name, $postDetails->articleTags()))
              {
                $active_tag="active_";
              }
              else
              {
                $active_tag=""; 
              }
              @endphp
              <li class="art_li {{ $active_tag }}">
                <a href="{{asset($lang.'/young-people/article/tag/'.$tag->tag_slug)}}">{{ $tag->tag_name }} <span class="nmbr_">0{{ $loop->index+1 }}</span> </a>
              </li>
              @endforeach

            </ul>
          </div>
        </div>
        @endif

      </div>
    </div>
  </section>
<?php /*
  <section class="page-section guide_sec">
    <div class="container">
      <div class="title_box with_tool ">
        <h1 class="section-title txt-up ">
          <div class="title_wr">
            <span>Guides</span>
          </div>
        </h1>
      </div>
      <div class="inner_">
        <div class="item_">
          <div class="img_box">
            <div class="img_ b-lazy" data-src="{{getFrontendAsset('images/guid-img1.jpg') }}"></div>
            <a href="#">
            <div class="dwnload_">
              <div class="icon_">
                <img src="{{getFrontendAsset('images/download-icon.svg') }}" />
              </div>
              <div class="text_">Download</div>
            </div>
            </a>
            
          </div>
          <div class="name_">The series "It is your right, you know your right", the first episode</div>
        </div>
        <div class="item_">
          <div class="img_box">
            <div class="img_ b-lazy" data-src="{{getFrontendAsset('images/guid-img1.jpg') }}"></div>
            <a href="#">
              <div class="dwnload_">
                <div class="icon_">
                  <img src="{{getFrontendAsset('images/download-icon.svg') }}" />
                </div>
                <div class="text_">Download</div>
              </div>
              </a>

          </div>
          <div class="name_">The series "It is your right, you know your right", the first episode</div>
        </div>
        <div class="item_">
          <div class="img_box">
            <div class="img_ b-lazy" data-src="{{getFrontendAsset('images/guid-img1.jpg') }}"></div>
            <a href="#">
            <div class="dwnload_">
              <div class="icon_">
                <img src="{{getFrontendAsset('images/download-icon.svg') }}" />
              </div>
              <div class="text_">Download</div>
            </div>
            </a>
          </div>
          <div class="name_">The series "It is your right, you know your right", the first episode</div>
        </div>
        <div class="item_">
          <div class="img_box">
            <div class="img_ b-lazy" data-src="{{getFrontendAsset('images/guid-img1.jpg') }}"></div>
            <a href="#">
            <div class="dwnload_">
              <div class="icon_">
                <img src="{{getFrontendAsset('images/download-icon.svg') }}" />
              </div>
              <div class="text_">Download</div>
            </div>
            </a>
          </div>
          <div class="name_">The series "It is your right, you know your right", the first episode</div>
        </div> 
      </div>
    </div>
  </section>


  <section class="page-section">
    <div class="container">
      <div class="title_box with_tool ">
        <h1 class="section-title txt-up ">
          <div class="title_wr">
            <span>Related Articles</span>
          </div>
        </h1>
      </div>
      <div class="article-box">
        <div class="guide_wrapper">
          <div class="box_item tip_item">
            <div class="inner_ ">
              <div class="top_box">
                    <a href="#" class="full_link"></a>
                    <div class="shape_ fill_lightblue">
                    <svg x="0px" y="0px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve"
                    preserveAspectRatio="none">
                    <polygon points="30,30 0,30 0,0 27.447,4.787 " />
                    </svg>
                    </div>
                    <div class="img_box">
                    <div class="meta_tag color-lightblue">
                    <ul>
                      <li>Educators</li>
                    </ul>
                  </div>
                    <div class="img_ b-lazy" data-src="{{getFrontendAsset('images/related-1.jpg') }}"></div>
                    
                    </div>
              </div>
              <div class="details_box">
                    <div class="title_">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed  </div>

              

                    <div class="more-wrap ">
                    <a class="more_dote_ btn_lightblue" href="#">
                    <span></span>
                    <span></span>
                    <span></span>
                    </a>
                    </div>
              </div>

              </div>
          </div>
          <div class="box_item tip_item">
            <div class="inner_ ">
              <div class="top_box">
                    <a href="#" class="full_link"></a>
                    <div class="shape_ fill_lightblue">
                    <svg x="0px" y="0px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve"
                    preserveAspectRatio="none">
                    <polygon points="30,30 0,30 0,0 27.447,4.787 " />
                    </svg>
                    </div>
                    <div class="img_box">
                    <div class="meta_tag color-lightblue">
							<ul>
								<li>Educators</li>
							</ul>
						</div>
                    <div class="img_ b-lazy" data-src="{{getFrontendAsset('images/related-1.jpg') }}"></div>
                    
                    </div>
              </div>
              <div class="details_box">
                    <div class="title_">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed  </div>

              

                    <div class="more-wrap ">
                    <a class="more_dote_ btn_lightblue" href="#">
                    <span></span>
                    <span></span>
                    <span></span>
                    </a>
                    </div>
              </div>

              </div>
          </div>
          <div class="box_item tip_item">
            <div class="inner_ ">
              <div class="top_box">
                    <a href="#" class="full_link"></a>
                    <div class="shape_ fill_lightblue">
                    <svg x="0px" y="0px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve"
                    preserveAspectRatio="none">
                    <polygon points="30,30 0,30 0,0 27.447,4.787 " />
                    </svg>
                    </div>
                    <div class="img_box">

                    <div class="meta_tag color-lightblue">
							<ul>
								<li>Educators</li>
							</ul>
						</div>
                    <div class="img_ b-lazy" data-src="{{getFrontendAsset('images/related-1.jpg') }}"></div>
                    
                    </div>
              </div>
              <div class="details_box">
                    <div class="title_">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed  </div>

              

                    <div class="more-wrap ">
                    <a class="more_dote_ btn_lightblue" href="#">
                    <span></span>
                    <span></span>
                    <span></span>
                    </a>
                    </div>
              </div>

              </div>
          </div>
        </div>
      </div>
      
    </div>
  </section>
 */ ?>

</main>


@stop
@section('scripts')
@parent
@include('frontend.script.inner_page_script')

@stop
