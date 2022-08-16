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
<?php 
	
	$changeLang = ($lang=='ar')?'en':'ar';
	$disableLanguage=@$websiteSettings->disable_language;

?>
<main class="page ">
	<section class="page-section">
		<div class="container">
		<div class="breadCrumbWrap ">
        <ol class="breadcrumb">
            <li><a href="{{ asset('/')}}" class="homebrc">{{lang('home')}}</a></li>            
             
            <li class="current">{{ lang('resources') }}</li>
        </ol>
    </div>
		   <div class="title_box with_tool">
			 <h1 class="section-title txt-up" >
				<div class="title_wr">
				   <span>{{ lang('resources') }}</span>
				</div>
			 </h1>
			 <div class="tool_box">
           
          <?php /*  <div class="tool_item">
              <div class="label_in"> <label>{{lang('filter')}}</label></div> 
			  <div class="input-field">  
                  <select name="filter_lang" id="filter_lang" class="filter ">
                    <option value="" selected>{{lang('language')}}</option>
					
                    <option value="en" data-targer="en">{{lang('english')}}</option>
                    <option value="ar" data-targer="ar">{{lang('arabic')}}</option>
                    			
                  </select>
                
                </div>
				
            </div> */ ?>
			 <a href="{{(asset('language/'.$changeLang.'/?redirect_url='.$currentURI))}}" class="link_ more l_rorund lang_switch"><span>{{ lang('view_arabic_resourses') }}</span></a>
						  
         </div>
		  </div>
		  <div class="resources_wrapper"  >
			<div class="tab_box">
				<div class="swiper-container resources-thumbs  mainCategorySlider">
					@if(!empty($resourceCategoryList) && $resourceCategoryList->count() > 0)
						<div class="swiper-wrapper">
							<div class="swiper-slide resources_sm_item swiper-slide-thumb-active swiper-slide-active">
								<div class="inner_">
									<div class="title_ ">{{ lang('all_resources') }}</div>
								</div>
							</div>
							<?php 
								$activeCatIndex = 0;
								$inc =0;
							?>
							@foreach($resourceCategoryList as $mainCat)
								<?php 
									if((!empty($activeCategory)) && ($mainCat->category_slug == $activeCategory->category_slug)){
										$activeCatIndex = $inc;
									}
								?>
								<div class="swiper-slide resources_sm_item {{ ((!empty($activeCategory)) && ($mainCat->category_slug == $activeCategory->category_slug))?'swiper-slide-thumb-active':'' }}"  >
									<div class="inner_">
										<div class="title_ mainCategory" data-id="{{ $mainCat->category_id}}">{{ $mainCat->getData('category_title')}}</div>
									</div>
								</div>
								<?php $inc++; ?>
							@endforeach
						</div>
					@endif
				</div>
				@if(!empty($resourceCategoryList) && $resourceCategoryList->count() > 0)
					<!-- Add Navigation -->
					<div class="nav_box box_v_center_">
						<div class="nav_ left_"><i class="icon icon-icon-arrow-left"></i></div>
						<div class="nav_ right_"><i class="icon icon-icon-arrow-right"></i></div>
					</div>
				@endif
				
				
			</div>
			<div class="content_box " id="render_html">
				@include('frontend.ajax.resources.tab_content')
			</div>
			
		  </div>
		</div>
	</section>
</main>

@stop
@section('scripts')
@parent
@include('frontend.script.inner_page_script')


<script>
function ajax_swiper_content_int(){


		resources_content = new Swiper('.resources-content', {
			spaceBetween: 0,
			effect: 'fade',
			autoHeight: false,
			
			
			on: {
				init: function() {
					window.bLazy.revalidate();

					$('.resources-content .resources_lg_content').each(function() {
						var this_ = $(this),
							el_ = this_.find('.swiper-container'),
							nav_right_ = this_.find('.nav_.right_'),
							nav_left_ = this_.find('.nav_.left_'),
							filter_first_btn = this_.find('.tab_inner_nav li:first-child >.tab_nav'),
							filter_btn = this_.find('.tab_nav'),
							resources_inner_slider = '';

						var sl_options = {
							slidesPerView: 3,
							slidesPerColumn: 2,
							spaceBetween: 50,
							slidesPerGroup: 1,
							navigation: {
								nextEl: nav_right_,
								prevEl: nav_left_,
							},
							breakpoints: {
								1025: {
									spaceBetween: 15,
								},
								991: {
									slidesPerView: 2,
									spaceBetween: 20,
								},
								640: {
									slidesPerView: 2,
									spaceBetween: 10,
								},
								320: {
									slidesPerView: 1,
									spaceBetween: 5,
								}
							},
							on: {
								init: function() {
									var min_h = $('.resources_wrapper .content_box > .resources-content').height();
									$('.resources_wrapper .content_box').css('height', min_h);
									window.bLazy.revalidate();
									$('.resources_wrapper .content_box').removeClass('loading_');
								},
							}
						};
						resources_inner_slider = new Swiper(el_, sl_options);


						filter_btn.on('click', function(e) {
							e.preventDefault();
							var click_btn = $(this),
								filter_targer = click_btn.data('targer');
							$('.content_box').addClass('loading_');
							filter_btn.removeClass('tab-active');
							click_btn.addClass('tab-active');

							el_.find('.resources_lg_inner_item').each(function() {
								var el_f = $(this),
									el_target = el_f.data('filter');
								el_f.removeClass('filter_v filter_h');

								if (filter_targer == 'all') {
									el_f.addClass('swiper-slide');
									el_f.removeClass('filter_v filter_h');
								} else if (el_target == filter_targer) {
									el_f.addClass('swiper-slide');
									el_f.addClass('filter_v');


								} else {
									el_f.removeClass('swiper-slide');
									el_f.addClass('filter_h');

								}
							});
							if (el_.find('.resources_lg_inner_item.filter_v').length == 0) {
								el_.find('.not-found').show();
								this_.addClass('slider_is_empty');
							} else {
								el_.find('.not-found').hide();
								this_.removeClass('slider_is_empty');
							}
							setTimeout(function() {
								resources_inner_slider.destroy();
								// resources_inner_slider.update();
								resources_inner_slider = new Swiper(el_, sl_options);
								$('.resources_wrapper .content_box').removeClass('loading_');

							}, 1000)

						});

						filter_first_btn.trigger('click');

						resources_inner_slider.on('slideChange', function() {
							window.bLazy.revalidate();
						});
					});
				},
			}
		});
		resources_content.on('slideChange', function() {
			window.bLazy.revalidate();
		});   
		$('.fancybox').fancybox();
}

function loadResourcesByCategoryId(){
	var catId;
	$('.resources_sm_item').each(function(){
		if($(this).hasClass("swiper-slide-thumb-active")){
			catId = $($(this).find('.mainCategory').get(0)).attr('data-id')
		}
	});
	
	var _data = {'cat_id':catId, lang: $('#filter_lang option:selected').val(),'_token':window._token.csrfToken};
	
	sendAjax('{{ asset($lang.'/resources') }}','POST',_data,function(responseData){
		if(responseData.status){ 
				$('#render_html').html(responseData.renderHtml);	
				ajax_swiper_content_int();
			}else{
				
				swal({
				  title: "{{ Lang::get('messages.error') }}",
				  text: "{{ Lang::get('messages.could_not_load_schedule') }}",
				  type: 'error',
				  showCancelButton: false,
				  confirmButtonColor: '#d33',
				  cancelButtonColor: '#fff',
				  cancelButtonText: "{{ Lang::get('messages.cancel') }}",
				  confirmButtonText: "{{ Lang::get('messages.ok') }}",
				  closeOnConfirm: false
				});
			}
		
	},'');
}
var resources_content , resources_Thumbs;

$(function() {
	$('.fancybox').fancybox();
    $('select').formSelect();

	if ($(window).width() > 767) {
		resources_Thumbs = new Swiper('.mainCategorySlider', {
			direction: 'vertical',
			spaceBetween: 30,
			slidesPerView: 5,
			navigation: {
				nextEl: '.resources_wrapper .tab_box .nav_.right_',
				prevEl: '.resources_wrapper .tab_box .nav_.left_',
			},
			freeMode: true,
			watchSlidesVisibility: true,
			watchSlidesProgress: true,

			breakpoints: {

				1300: {
					spaceBetween: 20,
				},
				640: {
					direction: 'horizontal',
					slidesPerView: 2,
					spaceBetween: 5,
				},
				320: {
					slidesPerView: 1,
					spaceBetween: 5,
				}
			}

		});
	} else {
		resources_Thumbs = new Swiper('.mainCategorySlider', {
			slidesPerView: 2,
			spaceBetween: 5,
			navigation: {
				nextEl: '.resources_wrapper .tab_box .nav_.right_',
				prevEl: '.resources_wrapper .tab_box .nav_.left_',
			},
			freeMode: true,
			watchSlidesVisibility: true,
			watchSlidesProgress: true,
			breakpoints: {
				320: {
					slidesPerView: 1,
					spaceBetween: 5,
				}
			}
		});
	}
	ajax_swiper_content_int();


	$('#filter_lang').on('change',function(){
		var _url="{{asset($lang.'/resources')}}";
		var filterlang=$(this).val();
		var dataToSend={'filterlang':filterlang};
		$('.loader_box').addClass('show');
		loadResourcesByCategoryId();
	});
 
	
	resources_Thumbs.on('click', function (e) {
		var id= $(e.target).attr('data-id');
		$('.resources_sm_item').removeClass('swiper-slide-thumb-active');
		$(e.target).parent().parent().addClass('swiper-slide-thumb-active');
		loadResourcesByCategoryId();
	});


	resources_Thumbs.slideTo({{ $activeCatIndex }})
	<?php if(!empty($activeSubCategory)){ ?>
			$("[data-targer='{{ $activeSubCategory }}']").trigger('click');
	<?php } ?>



});  
</script>
@stop

