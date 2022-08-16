!function($) {
    window.bLazy = new Blazy({
        offset: 350,
        loadInvisible: !0
    }), $(window).scroll(function(e) {
        var scrollY = $(window).scrollTop();
        100 < scrollY ? $(".fl-social").addClass("fl-scrolled") : $(".fl-social").removeClass("fl-scrolled"), 
        5 < scrollY ? $("body").addClass("scrolled") : $("body").removeClass("scrolled");
        $("header").height();
        2 < scrollY ? $("body").addClass("stick_buttom") : $("body").removeClass("stick_buttom"), 
        $(".banner .summit_box").css({
            "transition-delay": "0s"
        });
    }), $(".sm_link").on("mouseenter", function(e) {
        var parentOffset = $(this).offset(), relX = e.pageX - parentOffset.left, relY = e.pageY - parentOffset.top;
        $(this).find(".mouse_hover").css({
            top: relY,
            left: relX
        });
    }).on("mouseout", function(e) {
        var parentOffset = $(this).offset(), relX = e.pageX - parentOffset.left, relY = e.pageY - parentOffset.top;
        $(this).find(".mouse_hover").css({
            top: relY,
            left: relX
        });
    }), $(document).ready(function() {
        "use strict";
        var progressPath = document.querySelector(".progress-wrap path"), pathLength = progressPath.getTotalLength();
        progressPath.style.transition = progressPath.style.WebkitTransition = "none", progressPath.style.strokeDasharray = pathLength + " " + pathLength, 
        progressPath.style.strokeDashoffset = pathLength, progressPath.getBoundingClientRect(), 
        progressPath.style.transition = progressPath.style.WebkitTransition = "stroke-dashoffset 10ms linear";
        var updateProgress = function() {
            var scroll = $(window).scrollTop(), height = $(document).height() - $(window).height(), progress = pathLength - scroll * pathLength / height;
            progressPath.style.strokeDashoffset = progress;
        };
        updateProgress(), $(window).scroll(updateProgress);
        jQuery(window).on("scroll", function() {
            50 < jQuery(this).scrollTop() ? jQuery(".progress-wrap").addClass("active-progress") : jQuery(".progress-wrap").removeClass("active-progress");
        }), jQuery(".progress-wrap").on("click", function(event) {
            return event.preventDefault(), jQuery("html, body").animate({
                scrollTop: 0
            }, 550), !1;
        }), $(".fixed-action-btn").on("click", function() {
            var this_ = $(this);
            this_.toggleClass("active"), this_.hasClass("active") ? this_.addClass("pulse") : this_.removeClass("pulse");
        }), $(window).width() < 992 && $("body").on("click", ".navbar-nav .nav-item.active", function(e) {
            $(".navbar-toggler").click();
        });
    }), $(document).ready(function() {
        var $search = $(".search_wrapper"), $input = $(".search-input"), animating = !1;
        $(document).on("click", ".search_switch", function() {
            animating || (animating = !0, $search.toggleClass("active"), $input.toggleClass("visible"), 
            $input.hasClass("visible") && $input.focus(), animating = !1);
        }), $(".help_line_tooltip").tooltipster({
            theme: [ "tooltipster-noir", "help_pop" ],
            position: "right",
            interactive: !0
        }), $(".tooltipbox").tooltipster({
            theme: [ "tooltipster-noir", "info_pop" ],
            position: "right",
            interactive: !1
        });
    });
}(jQuery);

var GAP = {
    read_more_and_less: function() {
        $(".moreless-button").click(function(e) {
            e.preventDefault();
            var this_ = $(this), txt_re_more = this_.data("re-more"), txt_re_less = this_.data("re-less");
            this_.find(".text_").text() == txt_re_more ? (this_.closest(".text_box").find(".moretext").slideDown(), 
            this_.find(".text_").text(txt_re_less)) : (this_.closest(".text_box").find(".moretext").slideUp(), 
            this_.find(".text_").text(txt_re_more));
        });
    }
};

function contactBanner() {
    google.maps.event.addDomListener(window, "load", function() {
        var mapOptions = {
            zoom: 16,
            center: new google.maps.LatLng(25.227185, 55.288806),
            styles: [ {
                featureType: "all",
                elementType: "all",
                stylers: [ {
                    hue: "#e7ecf0"
                } ]
            }, {
                featureType: "administrative.locality",
                elementType: "labels.text",
                stylers: [ {
                    visibility: "on"
                } ]
            }, {
                featureType: "administrative.locality",
                elementType: "labels.icon",
                stylers: [ {
                    visibility: "off"
                } ]
            }, {
                featureType: "administrative.neighborhood",
                elementType: "labels.text",
                stylers: [ {
                    visibility: "off"
                } ]
            }, {
                featureType: "poi",
                elementType: "all",
                stylers: [ {
                    visibility: "off"
                } ]
            }, {
                featureType: "road",
                elementType: "all",
                stylers: [ {
                    saturation: -70
                } ]
            }, {
                featureType: "road.highway",
                elementType: "geometry.stroke",
                stylers: [ {
                    visibility: "on"
                } ]
            }, {
                featureType: "road.highway",
                elementType: "labels",
                stylers: [ {
                    visibility: "off"
                } ]
            }, {
                featureType: "road.highway",
                elementType: "labels.text",
                stylers: [ {
                    visibility: "off"
                } ]
            }, {
                featureType: "road.highway",
                elementType: "labels.text.fill",
                stylers: [ {
                    visibility: "off"
                } ]
            }, {
                featureType: "road.highway",
                elementType: "labels.icon",
                stylers: [ {
                    visibility: "off"
                } ]
            }, {
                featureType: "road.highway.controlled_access",
                elementType: "labels",
                stylers: [ {
                    visibility: "on"
                } ]
            }, {
                featureType: "road.highway.controlled_access",
                elementType: "labels.text",
                stylers: [ {
                    visibility: "off"
                } ]
            }, {
                featureType: "road.highway.controlled_access",
                elementType: "labels.icon",
                stylers: [ {
                    visibility: "off"
                } ]
            }, {
                featureType: "road.arterial",
                elementType: "labels.text",
                stylers: [ {
                    visibility: "on"
                } ]
            }, {
                featureType: "road.arterial",
                elementType: "labels.icon",
                stylers: [ {
                    visibility: "off"
                } ]
            }, {
                featureType: "road.local",
                elementType: "geometry.stroke",
                stylers: [ {
                    visibility: "off"
                } ]
            }, {
                featureType: "road.local",
                elementType: "labels",
                stylers: [ {
                    visibility: "on"
                } ]
            }, {
                featureType: "road.local",
                elementType: "labels.text",
                stylers: [ {
                    visibility: "off"
                } ]
            }, {
                featureType: "road.local",
                elementType: "labels.text.stroke",
                stylers: [ {
                    visibility: "on"
                } ]
            }, {
                featureType: "transit",
                elementType: "all",
                stylers: [ {
                    visibility: "off"
                } ]
            }, {
                featureType: "water",
                elementType: "all",
                stylers: [ {
                    visibility: "simplified"
                }, {
                    saturation: -60
                } ]
            } ]
        }, mapElement = document.getElementById("map"), map = new google.maps.Map(mapElement, mapOptions);
        new google.maps.Marker({
            position: new google.maps.LatLng(25.227185, 55.288806),
            map: map,
            title: "World Trade Center"
        });
    });
}

!function($) {
    "use strict";
    var viewport = window.innerWidth;
    $(document).ready(function() {
        $(".page-section").viewportChecker({
            classToAdd: "inView"
        }), setTimeout(function() {
            $("body").addClass("is-loaded");
        }, 2e3), $(".search-toggle").click(function(e) {
            $(this).parent().toggleClass("search-open");
        });
        new Swiper(".resources .swiper-container", {
            direction: "horizontal",
            loop: !1,
            slidesPerView: 4,
            simulateTouch: !(991 < viewport),
            shortSwipes: !(991 < viewport),
            longSwipes: !(991 < viewport),
            spaceBetween: 10,
            pagination: {
                el: ".swiper-pagination",
                clickable: !0,
                dynamicBullets: !0
            },
            navigation: {
                nextEl: ".resources .swiper-button-next",
                prevEl: ".resources .swiper-button-prev"
            },
            breakpoints: {
                1300: {
                    spaceBetween: 10
                },
                1199: {
                    slidesPerView: 3,
                    spaceBetween: 0
                },
                991: {
                    slidesPerView: 2,
                    spaceBetween: 0
                },
                540: {
                    slidesPerView: 1,
                    spaceBetween: 0
                }
            }
        });
    }), $(window).scroll(function(e) {
        100 < $("html").scrollTop() ? $(".fl-social").addClass("fl-scrolled") : $(".fl-social").removeClass("fl-scrolled");
    }), $(window).resize(function() {});
}(jQuery);