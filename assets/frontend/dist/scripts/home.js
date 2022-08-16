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

!function($) {
    "use strict";
    var viewport = window.innerWidth;
    $(document).ready(function() {
        $(".home-section").viewportChecker({
            classToAdd: "inView"
        }), setTimeout(function() {
            $("body").addClass("is-loaded");
        }, 4e3), $(".search-toggle").click(function(e) {
            $(this).parent().toggleClass("search-open");
        }), function(offset) {
            viewport < 992 && $("body").on("click", "a.scroll", function(e) {
                $(".navbar-toggler").click();
            });
            $("body").on("click", "a.scroll", function(e) {
                e.preventDefault(), $(document).off("scroll"), $(this).closest(".navbar-nav").length && ($(".navbar-nav a.scroll").each(function() {
                    $(this).parent().removeClass("active");
                }), $(this).parent().addClass("active"));
                var target = $(this).attr("data-href"), $target = $(target);
                $(target).length || (window.location.href = $(this).attr("href")), $("html, body").stop().animate({
                    scrollTop: $target.offset().top - offset
                }, 500, "swing", function() {
                    $(document).on("scroll");
                });
            });
        }(40);
    }), $(window).resize(function() {});
    var lastId, topMenu = $(".navbar-nav"), topMenuHeight = topMenu.outerHeight() + 30, menuItems = topMenu.find("a"), scrollItems = menuItems.map(function() {
        var selector = $(this).attr("data-href");
        if (void 0 !== selector && (selector.startsWith("#") || selector.startsWith(".")) && $(selector).length) return $(selector);
    });
    $(window).scroll(function() {
        var fromTop = $(this).scrollTop() + topMenuHeight, cur = scrollItems.map(function() {
            if ($(this).offset().top < fromTop) return this;
        }), id = (cur = cur[cur.length - 1]) && cur.length ? cur[0].id : "";
        lastId !== id && (lastId = id, menuItems.parent().removeClass("active").end().filter("[data-href='#" + id + "']").parent().addClass("active"));
    });
}(jQuery);