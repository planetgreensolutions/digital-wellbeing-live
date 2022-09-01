<script src="{{ asset('assets/frontend/dist/scripts/min/home_plugins.js') }}"></script>
<script src="{{ asset('assets/frontend/dist/scripts/min/home.js') }}"></script>


<script>

    /*  $(function() {
        $.fancybox.open({
            src : '#charterPledge',
            wrapCSS  : 'fancybox-custom' 
        });
    }); */


    var isVideoPlaying = false;
    var currentVideoID = "";
    var currentFrameID = "";

    $(document).on('click', '.play_btn .link_', function(e){
        e.preventDefault();
        e.stopPropagation();

        var frameID = $(this).attr('data-farme_id');
        var videoID = $(this).attr('data-video_id');

        if(!isVideoPlaying){
            
            isVideoPlaying = true;
            currentVideoID = videoID;
            currentFrameID = frameID;

            if($(window).width() <= 1024){
                $.fancybox.open({
                    src: 'https://www.youtube.com/embed/' + currentVideoID + "?autoplay=1&autohide=1&border=0&wmode=opaque&controls=0&rel=0&modestbranding=1",
                    type: 'iframe',
                    iframe: {
                        preload: false
                    },
                    autoSize: true,
                    opts: {
                        afterShow: function(instance, current) {
                            console.info('done!');
                        },
                        afterClose: function() {
                            closePlayer();
                        }
                    }
                });
            }
            else {
                var iframe = document.createElement("iframe");
                iframe.setAttribute("src", "https://youtube.com/embed/" + videoID + "?autoplay=1&autohide=1&border=0&wmode=opaque&controls=0&rel=0&modestbranding=1");

                iframe.setAttribute("onload", "playVideo();")

                iframe.style.width = "100%";    
                iframe.style.height = "100%";
                iframe.style.position = "absolute";
                iframe.style.zIndex = "999";

                $('body').addClass('video_p');
                $(this).closest('.v_gallery_item').addClass('video_playing');

                $("#" + frameID).html(iframe);
            }

            $(this).parent().closest('.content_box').hide();
            $(this).parent().hide();
        }  
    });

    function playVideo(){
        $('.ytp-large-play-button').click();
    }

    function closePlayer() {
        currentFrameID = "";
        currentVideoID = "";
        isVideoPlaying = false;
        $('.content_box').show();
        $('.play_btn').show();   
    }

    $(document).on('click', '.close_btn_wrapper .link_', function(e){
        e.preventDefault();

        $("#" + currentFrameID).html('');
        
        closePlayer();

        $(this).closest('.v_gallery_item').removeClass('video_playing');
        $('body').removeClass('video_p');
    });
</script>

<script defer>
var home_banner_slider = new Swiper('.banner_slider_wrapper .swiper-container', {
    slidesPerView: 2,
    slidesPerColumn: 2,
    spaceBetween: 50,
	pagination: {
            el: '.banner_slider_wrapper .swiper-pagination',
            clickable: true,
          },
    //navigation: {
      //  nextEl: '.banner_slider_wrapper .nav_.right_',
        //prevEl: '.banner_slider_wrapper .nav_.left_',
    //},
    breakpoints: {
        1500: {
            spaceBetween: 40,
        },
        1300: {
            spaceBetween: 20,
        },
        1025: {
            slidesPerView: 3,
        },
        768: {
            slidesPerView: 2,
            spaceBetween: 20,
        },
        640: {
            slidesPerView: 2,
            spaceBetween: 20,
        },
        320: {
            slidesPerView: 1,
            spaceBetween: 10,
        }
    },
    on: {
        init: function() {
            window.bLazy.revalidate();
        },
    }
});
var home_banner_text_slider = new Swiper('.banner_text_box .swiper-container', { 
     effect: 'fade',
     //loop: true,
     autoplay: {
        delay: 10000,
        disableOnInteraction: false,
      },  
});


home_banner_slider.on('slideChange', function() {
    window.bLazy.revalidate();
});

var guides_and_tips_slider = new Swiper('.guides_and_tips-section .swiper-container', {
    slidesPerView: 3,
    spaceBetween: 50,
    navigation: {
        nextEl: '.guides_and_tips-section .nav_.right_',
        prevEl: '.guides_and_tips-section .nav_.left_',
    },
    breakpoints: {
        1500: {
            spaceBetween: 40,
        },
        1025: {
            slidesPerView: 2,
        },
        768: {
            slidesPerView: 2,
            spaceBetween: 30,
        },
        767: {
            slidesPerView: 1,
            spaceBetween: 10,
        }
    },
    on: {
        init: function() {
            window.bLazy.revalidate();
        },
    }
});

/*
guides_and_tips_slider.on('slideChange', function() {
    window.bLazy.revalidate();
});
*/

var news_and_opinion_slider = new Swiper('.news_and_opinion-section .swiper-container', {
    slidesPerView: 3,
    spaceBetween: 50,
    navigation: {
        nextEl: '.news_and_opinion-section .nav_.right_',
        prevEl: '.news_and_opinion-section .nav_.left_',
    },
    breakpoints: {
        1500: {
            spaceBetween: 40,
        },
        1025: {
            slidesPerView: 2,
        },
        768: {
            slidesPerView: 2,
            spaceBetween: 30,
        },
        767: {
            slidesPerView: 1,
            spaceBetween: 10,
        }
    },
    on: {
        init: function() {
            window.bLazy.revalidate();
        },
    }
});

news_and_opinion_slider.on('slideChange', function() {
    window.bLazy.revalidate();
});

var video_gallery_Thumbs = new Swiper('.video_gallery_wrapper .gallery-thumbs .swiper-container', {
    spaceBetween: 10,
    slidesPerView: 6,
    freeMode: true,
    watchSlidesVisibility: true,
    watchSlidesProgress: true,
    breakpoints: {

        768: {
            slidesPerView: 4,

        },
        400: {
            slidesPerView: 3,
            spaceBetween: 5,
        }
    },
    on: {
        init: function() {
            window.bLazy.revalidate();
        },
    }
});
video_gallery_Thumbs.on('slideChange', function() {
    window.bLazy.revalidate();
});
var video_gallery_Top = new Swiper('.video_gallery_wrapper .gallery-top', {
    spaceBetween: 0,
    effect: 'fade',
    navigation: {
        nextEl: '.video_gallery_wrapper .nav_.right_',
        prevEl: '.video_gallery_wrapper .nav_.left_',
    },
    thumbs: {
        swiper: video_gallery_Thumbs
    },
    on: {
        init: function() {
            window.bLazy.revalidate();
        },
    }
});
video_gallery_Top.on('slideChange', function() {
    window.bLazy.revalidate();
});


var news_slider = new Swiper('.news_slider_wrapper .swiper-container', {
    // direction: 'vertical', 
    slidesPerView: 1,
    slidesPerColumn: 2,
    spaceBetween: 50,
    navigation: {
        nextEl: '.news_slider_wrapper .nav_.right_',
        prevEl: '.news_slider_wrapper .nav_.left_',
    },
    breakpoints: {
        1500: {
            spaceBetween: 40,
        },
        1300: {
            spaceBetween: 20,
        },
        768: {

            spaceBetween: 30,
        },
        640: {
            slidesPerView: 1,
            slidesPerColumn: 1,
            spaceBetween: 20,
        }
    },
    on: {
        init: function() {
            window.bLazy.revalidate();
        },
    }
});

news_slider.on('slideChange', function() {
    window.bLazy.revalidate();
});

if ($(window).width() > 767) {
    var resources_Thumbs = new Swiper('.resources-section .resources-thumbs', {
        direction: 'vertical',
        spaceBetween: 30,
        slidesPerView: 6,
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
            }
        },
        on: {
            init: function() {
                window.bLazy.revalidate();

                var height_ = $('.resources-section .middle_box .resources_sm_item').outerHeight(true);

                $('.middle_box').css('--h_off', height_);
            },
        }
    });

} else {
    var resources_Thumbs = new Swiper('.resources-section .resources-thumbs', {
        slidesPerView: 2,
        spaceBetween: 5,
        freeMode: false,
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
        on: {
            init: function() {
                window.bLazy.revalidate();

                var height_ = $('.resources-section .middle_box .resources_sm_item').outerHeight(true);

                $('.middle_box').css('--h_off', height_);
            },
        }
    });
}

resources_Thumbs.on('slideChange', function() {
	// console.log('asd');
    window.bLazy.revalidate();
});

var vresources_Top = new Swiper('.resources-section .resources-top', {
    spaceBetween: 0,
    effect: 'fade',
    thumbs: {
        swiper: resources_Thumbs
    },
    navigation: {
        nextEl: '.resources-section .middle_box .nav_.right_',
        prevEl: '.resources-section .middle_box .nav_.left_',
    },
    on: {
        init: function() {
            window.bLazy.revalidate();

            $('.resources-section .resources-top .resources_lg_item').each(function() {
                var this_ = $(this),
                    el_ = this_.find('.swiper-container'),
                    nav_right_ = this_.find('.nav_.right_'),
                    nav_left_ = this_.find('.nav_.left_');

                var resources_inner_slider = new Swiper(el_, {
                    slidesPerView: 2,
                    slidesPerColumn: 2,
                    spaceBetween: 5,
                    slidesPerGroup: 2,
                    navigation: {
                        nextEl: nav_right_,
                        prevEl: nav_left_,
                    },
                    breakpoints: {

                        /* 991: {
                             slidesPerView: 3,
                             spaceBetween: 30,
                         },
                         640: {
                             slidesPerView: 2,
                             spaceBetween: 20,
                         },
                         320: {
                             slidesPerView: 1,
                             spaceBetween: 10,
                         }*/
                    },
                    on: {
                        init: function() {
                            window.bLazy.revalidate();
                        },
                    }
                });
                resources_inner_slider.on('slideChange', function() {
                    window.bLazy.revalidate();
                });
            });
        },
    }
});
vresources_Top.on('slideChange', function() {
    window.bLazy.revalidate();
});
</script>
<script>
$(document).ready(function() {
    setTimeout(function() {
        $('body').addClass('loaded');
    },4500);

      
var rtl_direction = $('html').attr('dir');
console.log(rtl_direction);
var footer = $('.digital_issues-section .issue_box .issue_list');

setTimeout(function () {
					 
		var footer_scroll = footer.niceScroll(
		{
			cursorcolor: "#0085c9",
			cursorwidth: "5px",
			cursoropacitymin: 1,
			cursorborder: 'none',
	
		}
		);
		footer_scroll.cursor.parent().css({
			'background-color': '#b4c2ce',
			'border-radius': '5px',
			'padding': '1px 0px'
		});
		
			if( rtl_direction == "rtl"){
					footer_scroll.cursor.parent().css({
						'left':footer.offset().left
					});
			}
    }, 1000);



	
	/*$(".digital_issues-section .issue_box .issue_list").niceScroll({
                cursorcolor: "#000",
                cursoropacitymin: 0.3,
                background: "#cedbec",
                cursorborder: "0",
                autohidemode: false,
                cursorminheight: 30
    });
    

    
    $(".digital_issues-section .issue_box .issue_list").getNiceScroll().resize();
    $("html").mouseover(function() {
        $(".digital_issues-section .issue_box .issue_list").getNiceScroll().resize();
    });*/

    $('#client_tab').responsiveTabs({
        startCollapsed: 'accordion',
        activate: function() {
            var client_slider = new Swiper('.client_slider_wrapper.r-tabs-state-active .swiper-container', {
                slidesPerView: 3,
                spaceBetween: 50,
                navigation: {
                    nextEl: '#tab-2 .right_',
                    prevEl: '#tab-2 .left_',
                  },
                breakpoints: {

                    991: {
                        slidesPerView: 3,
                        spaceBetween: 30,
                    },
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 20,
                    }
                },
                on: {
                    init: function() {
                        window.bLazy.revalidate();
                        setTimeout(function() {
                            var slider_h = $('.client_slider_wrapper.r-tabs-state-active').outerHeight(true);
                            $('.client_slider_wrapper').css('max-height', slider_h);
                        }, 1000)

                    },
                }
            });


        },

    });
});

    $(window).resize(function () {
        setTimeout(function () {
            footer_scroll.cursor.parent().css({
                'left':footer.offset().left
            });
        }, 100);
    });

</script>