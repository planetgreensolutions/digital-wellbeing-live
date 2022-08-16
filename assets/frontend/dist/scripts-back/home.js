(function ($) { 
    'use strict';
    var viewport = window.innerWidth; 
    

    
    $(document).ready(function(){
        $('.home-section').viewportChecker({
            classToAdd: 'inView'
        });

        setTimeout(function() {
            $('body').addClass('is-loaded');
        },4000);
                
        
        $('.search-toggle').click(function(e){
            $(this).parent().toggleClass('search-open')    
        });
                
        scrollToDiv(40); 
                   
    });

    
    $(window).resize(function () {

    });
    
    function scrollToDiv(offset){
        
        if(viewport < 992){
            $('body').on('click', 'a.scroll', function (e) {
                $('.navbar-toggler').click();
            });
        }
            
        $('body').on('click', 'a.scroll', function (e) {
            e.preventDefault();
            $(document).off("scroll");
            if($(this).closest('.navbar-nav').length){
                $('.navbar-nav a.scroll').each(function () {
                    $(this).parent().removeClass('active');
                });
                $(this).parent().addClass('active');
            }

            //  new scripts
            var target = $(this).attr('data-href');
            var $target = $(target);

            if (!$(target).length) {
                window.location.href = $(this).attr('href');
            }

            $('html, body').stop().animate({
                'scrollTop': $target.offset().top - offset
            }, 500, 'swing', function () {
                $(document).on("scroll");
            });
        });
    }
    
    /*--------------- MENU SCROLL ----------------------*/
    // Cache selectors
    var lastId, topMenu = $(".navbar-nav")
        , topMenuHeight = topMenu.outerHeight() + 30, // All list items
        menuItems = topMenu.find("a"), // Anchors corresponding to menu items
        scrollItems = menuItems.map(function () {
            var selector = $(this).attr("data-href");             
            if (typeof selector != "undefined") {
                if(selector.startsWith('#') || selector.startsWith('.')){
                    if($(selector).length){ 
                        return $(selector);
                    }
                }
            }
        });

    $(window).scroll(function () {
        
         // Get container scroll position
         var fromTop = $(this).scrollTop() + topMenuHeight;
         // Get id of current scroll item
         var cur = scrollItems.map(function () {
             if ($(this).offset().top < fromTop) return this;
         });
         // Get the id of the current element
         cur = cur[cur.length - 1];
         var id = cur && cur.length ? cur[0].id : "";
         if (lastId !== id) {
             lastId = id;
             // Set/remove active class
             menuItems.parent().removeClass("active").end().filter("[data-href='#" + id + "']").parent().addClass("active");
         }

         
     }); 
    
})(jQuery);


// var c = document.getElementById("c");
// var ctx = c.getContext("2d");
// var cH;
// var cW;
// var bgColor = "#FFF";
// var animations = [];
// var circles = [];

// var colorPicker = (function() {
//   var colors = ["#016ba7", "#ff3343", "#f9e867", "#f8ac59", "#5444ed"];
//   var index = 0;
//   function next() {
//     index = index++ < colors.length-1 ? index : 0;
//     return colors[index];
//   }
//   function current() {
//     return colors[index]
//   }
//   return {
//     next: next,
//     current: current
//   }
// })();

// function removeAnimation(animation) {
//   var index = animations.indexOf(animation);
//   if (index > -1) animations.splice(index, 1);
// }

// function calcPageFillRadius(x, y) {
//   var l = Math.max(x - 0, cW - x);
//   var h = Math.max(y - 0, cH - y);
//   return Math.sqrt(Math.pow(l, 2) + Math.pow(h, 2));
// }

// function addClickListeners() {
//   document.addEventListener("touchstart", handleEvent);
//   document.addEventListener("mousedown", handleEvent);
// };

// function handleEvent(e) {
//     if (e.touches) { 
//       e.preventDefault();
//       e = e.touches[0];
//     }
//     var currentColor = colorPicker.current();
//     var nextColor = colorPicker.next();
//     var targetR = calcPageFillRadius(e.clientX, e.clientY);
//     var rippleSize = Math.min(200, (cW * .4));
//     var minCoverDuration = 750;
 
//     var pageFill = new Circle({
//       x: e.clientY,
//       y: e.clientY,
//       r: 0,
//       fill: '#FFF'
//     });
//     var fillAnimation = anime({
//       targets: pageFill,
//       r: targetR,
//       duration:  Math.max(targetR / 2 , minCoverDuration ),
//       easing: "easeOutQuart",
//       complete: function(){
//         bgColor = '#FFF';
//         removeAnimation(fillAnimation);
//       }
//     });
    
//     var ripple = new Circle({
//       x: e.clientX,
//       y: e.clientY,
//       r: 0,
//       fill: '#FFF',
//       stroke: {
//         width: 3,
//         color: currentColor
//       },
//       opacity: 1
//     });
//     var rippleAnimation = anime({
//       targets: ripple,
//       r: rippleSize,
//       opacity: 0,
//       easing: "easeOutExpo",
//       duration: 900,
//       complete: removeAnimation
//     });
    
//     var particles = [];
//     for (var i=0; i<32; i++) {
//       var particle = new Circle({
//         x: e.clientX,
//         y: e.clientY,
//         fill: currentColor,
//         r: anime.random(24, 48)
//       })
//       particles.push(particle);
//     }
//     var particlesAnimation = anime({
//       targets: particles,
//       x: function(particle){
//         return particle.x + anime.random(rippleSize, -rippleSize);
//       },
//       y: function(particle){
//         return particle.y + anime.random(rippleSize * 1.15, -rippleSize * 1.15);
//       },
//       r: 0,
//       easing: "easeOutExpo",
//       duration: anime.random(1000,1300),
//       complete: removeAnimation
//     });
//     animations.push(fillAnimation, rippleAnimation, particlesAnimation);
// }

// function extend(a, b){
//   for(var key in b) {
//     if(b.hasOwnProperty(key)) {
//       a[key] = b[key];
//     }
//   }
//   return a;
// }

// var Circle = function(opts) {
//   extend(this, opts);
// }

// Circle.prototype.draw = function() {
//   ctx.globalAlpha = this.opacity || 1;
//   ctx.beginPath();
  
//   ctx.arc(this.x, this.y, this.r, 0, 2 * Math.PI, false);
//   if (this.stroke) {
    

//     ctx.strokeStyle = this.stroke.color;
//     ctx.lineWidth = this.stroke.width;
//     ctx.stroke();
//   }
//   if (this.fill) {
//     //ctx.rect(this.x, this.y, 50, 50);

//     ctx.fillStyle = this.fill;
//     ctx.fill();
//   }
//   ctx.closePath();
//   ctx.globalAlpha = 1;
// }

// var animate = anime({
//   duration: Infinity,
//   update: function() {
//     ctx.fillStyle = bgColor;
//     ctx.fillRect(0, 0, cW, cH);
//     animations.forEach(function(anim) {
//       anim.animatables.forEach(function(animatable) {
//         animatable.target.draw();
//       });
//     });
//   }
// });

// var resizeCanvas = function() {
//   cW = window.innerWidth;
//   cH = window.innerHeight;
//   c.width = cW * devicePixelRatio;
//   c.height = cH * devicePixelRatio;
//   ctx.scale(devicePixelRatio, devicePixelRatio);
// };

// (function init() {
//   resizeCanvas();
//   if (window.CP) {
//     // CodePen's loop detection was causin' problems
//     // and I have no idea why, so...
//     window.CP.PenTimer.MAX_TIME_IN_LOOP_WO_EXIT = 6000; 
//   }
//   window.addEventListener("resize", resizeCanvas);
//   addClickListeners();
//   if (!!window.location.pathname.match(/fullcpgrid/)) {
//     startFauxClicking();
//   }
//   handleInactiveUser();
// })();

// function handleInactiveUser() {
//   var inactive = setTimeout(function(){
//     fauxClick(cW - 200 , cH/3 );
//   }, 2000);
  
//   function clearInactiveTimeout() {
//     clearTimeout(inactive);
//     document.removeEventListener("mousedown", clearInactiveTimeout);
//     document.removeEventListener("touchstart", clearInactiveTimeout);
//   }
  
//   document.addEventListener("mousedown", clearInactiveTimeout);
//   document.addEventListener("touchstart", clearInactiveTimeout);
// }

// function startFauxClicking() {
//   setTimeout(function(){
//     fauxClick(anime.random( cW * .2, cW * .8), anime.random(cH * .2, cH * .8));
//     startFauxClicking();
//   }, anime.random(200, 900));
// }

// function fauxClick(x, y) {
//   var fauxClick = new Event("mousedown");
//   fauxClick.pageX = x;
//   fauxClick.pageY = y;
//   document.dispatchEvent(fauxClick);
// }