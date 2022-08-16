(function ($) {
  window.bLazy = new Blazy({
    offset: 350,
    loadInvisible: true
});
  $(window).scroll(function (e) {
    var scrollY = $(window).scrollTop();
    scrollY > 100 ? $('.fl-social').addClass('fl-scrolled') : $('.fl-social').removeClass('fl-scrolled');
    scrollY > 5 ? $('body').addClass('scrolled') : $('body').removeClass('scrolled');

    var menu_height = $('header').height();

    if (2 < scrollY) {
      //  console.log(($(window).height() - menu_height),scrollY,menu_height); 

      $('body').addClass('stick_buttom');
      $('.banner .summit_box').css({

        'transition-delay': '0s'
      })
    } else {
      $('body').removeClass('stick_buttom');
      $('.banner .summit_box').css({

        'transition-delay': '0s'
      })
    }

  });

  $('.sm_link')
    .on('mouseenter', function (e) {
      var parentOffset = $(this).offset(),
        relX = e.pageX - parentOffset.left,
        relY = e.pageY - parentOffset.top;
      $(this).find('.mouse_hover').css({
        top: relY,
        left: relX
      })
    })
    .on('mouseout', function (e) {
      var parentOffset = $(this).offset(),
        relX = e.pageX - parentOffset.left,
        relY = e.pageY - parentOffset.top;
      $(this).find('.mouse_hover').css({
        top: relY,
        left: relX
      })
    });

  $(document).ready(function () {
    "use strict";

    //Scroll back to top

    var progressPath = document.querySelector('.progress-wrap path');
    var pathLength = progressPath.getTotalLength();
    progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
    progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
    progressPath.style.strokeDashoffset = pathLength;
    progressPath.getBoundingClientRect();
    progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 10ms linear';
    var updateProgress = function () {
      var scroll = $(window).scrollTop();
      var height = $(document).height() - $(window).height();
      var progress = pathLength - (scroll * pathLength / height);
      progressPath.style.strokeDashoffset = progress;
    }
    updateProgress();
    $(window).scroll(updateProgress);
    var offset = 50;
    var duration = 550;
    jQuery(window).on('scroll', function () {
      if (jQuery(this).scrollTop() > offset) {
        jQuery('.progress-wrap').addClass('active-progress');
      } else {
        jQuery('.progress-wrap').removeClass('active-progress');
      }
    });
    jQuery('.progress-wrap').on('click', function (event) {
      event.preventDefault();
      jQuery('html, body').animate({
        scrollTop: 0
      }, duration);
      return false;
    })

    $('.fixed-action-btn').on('click', function() {
      var this_  = $(this);
        
      this_.toggleClass('active');

      if(this_.hasClass('active')) {
        this_.addClass('pulse');
      }else{
        this_.removeClass('pulse');
      }

    });
    if($(window).width() < 992){

      $('body').on('click', '.navbar-nav .nav-item.active', function (e) {
        $('.navbar-toggler').click();
      });
    }

  });


  /*document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.fixed-action-btn');
    var instances = M.FloatingActionButton.init(elems,  {
      direction: 'bottom',
      hoverEnabled: false
    });
  });*/





  var viewport = window.innerWidth;
  var pgs_ = {
  burgger_menu : function() {
    // Bugger Menu click
    $('body').on('click', '.menu_trigger', function (e) {
     var this_ = $(this),
         target_ = this_.data('traget');

     this_.toggleClass('active_');
     $('body').toggleClass('menu_open');
     $('#'+target_).toggleClass('show');

   });
 }
  }







  $(document).ready(function() {
    pgs_.burgger_menu();
    var $search = $(".search_wrapper"),
        $input = $(".search-input"),    
        animating = false;
    
    $(document).on("click", ".search_switch", function() {
      if (animating) return;
      animating = true;
     
      $search.toggleClass("active");
      $input.toggleClass("visible");
      if($input.hasClass('visible')) {
        $input.focus();
      }      
      animating = false;      
    });      
    
    $('.help_line_tooltip').tooltipster({
      theme: ['tooltipster-noir', 'help_pop'],
      position: 'right',
      interactive: true,
          
  });
  $('.tooltipbox').tooltipster({
    theme: ['tooltipster-noir', 'info_pop'], 
    position: 'right',
    interactive: false,
        
});

  });

})(jQuery);


var GAP = {
  read_more_and_less : function() {
    $('.moreless-button').click(function(e) {
      e.preventDefault();            
      var this_ = $(this),
           txt_re_more = this_.data('re-more'),
           txt_re_less = this_.data('re-less');
      
       if (this_.find('.text_').text() == txt_re_more) {                        
           this_.closest('.text_box').find('.moretext').slideDown();
           this_.find('.text_').text(txt_re_less);
           
       } else {
           this_.closest('.text_box').find('.moretext').slideUp();                        
           this_.find('.text_').text(txt_re_more);
       }
   });
  }
}