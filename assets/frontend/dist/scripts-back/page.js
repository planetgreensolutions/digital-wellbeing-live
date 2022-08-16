(function ($) {
    'use strict';
    var viewport = window.innerWidth;
    

    $(document).ready(function(){
        $('.page-section').viewportChecker({
            classToAdd: 'inView'
        });
        
        setTimeout(function() {
            $('body').addClass('is-loaded');
        },2000);
        
        $('.search-toggle').click(function(e){
            $(this).parent().toggleClass('search-open')    
        });
        
         var resourceSlider = new Swiper('.resources .swiper-container', {
            direction: 'horizontal',
            loop: false,
            slidesPerView: 4,
            simulateTouch: viewport > 991 ? false : true,
            shortSwipes: viewport > 991 ? false : true,
            longSwipes: viewport > 991 ? false : true,
            spaceBetween: 10,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                dynamicBullets: true, 
            },
            navigation: {
                nextEl: '.resources .swiper-button-next',
                prevEl: '.resources .swiper-button-prev',
            },
            breakpoints: {
                1300: {
                    spaceBetween: 10
                },
                1199: {
                    slidesPerView: 3, 
                    spaceBetween: 0, 
                },
                991: {
                    slidesPerView: 2,
                    spaceBetween: 0,
                },
                540: {
                    slidesPerView: 1,
                    spaceBetween: 0,
                }
            }
        });
        
    });

    $(window).scroll(function (e) {
        var scrollY = $('html').scrollTop();
        scrollY > 100 ? $('.fl-social').addClass('fl-scrolled') : $('.fl-social').removeClass('fl-scrolled');
    });
    
    $(window).resize(function () {

    });
    
    var counc_sli = new Swiper('.abt_co_sl .swiper-container', {
        loop: false,
        speed:1000,
        spaceBetween: 0,
        slidesPerView: 3,
        // autoplay: {
        //     delay: 6000,
        // },
        navigation: {
            nextEl: '.abt_co_sl .right_',
            prevEl: '.abt_co_sl .left_',
          },
          breakpoints: {
            767: {
                slidesPerView: 1,
            },
           
        },
          on: {
            init: function() {
                1 == $(this)[0].snapGrid.length && ($(".abt_co_sl .right_").hide(), 
                $(".abt_co_sl .left_").hide());
            }
        }
    });
    banner_slide.on('slideChange', function() {
      // revalidate b-lazy      
      window.bLazy.revalidate();
    });
    
  
})(jQuery);  

function contactBanner(){
	google.maps.event.addDomListener(window, 'load', init);
        
            function init() {
                // Basic options for a simple Google Map
                // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
                var mapOptions = {
                    // How zoomed in you want the map to start at (always required)
                    zoom: 16,

                    // The latitude and longitude to center the map (always required)
                    center: new google.maps.LatLng(25.227185, 55.288806), // New York

                    // How you would like to style the map. 
                    // This is where you would paste any style found on Snazzy Maps.
                    styles: [{"featureType":"all","elementType":"all","stylers":[{"hue":"#e7ecf0"}]},{"featureType":"administrative.locality","elementType":"labels.text","stylers":[{"visibility":"on"}]},{"featureType":"administrative.locality","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative.neighborhood","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-70}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"visibility":"on"}]},{"featureType":"road.highway","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"labels.text.fill","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road.highway.controlled_access","elementType":"labels","stylers":[{"visibility":"on"}]},{"featureType":"road.highway.controlled_access","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"road.highway.controlled_access","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"labels.text","stylers":[{"visibility":"on"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"labels","stylers":[{"visibility":"on"}]},{"featureType":"road.local","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"labels.text.stroke","stylers":[{"visibility":"on"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"visibility":"simplified"},{"saturation":-60}]}]
                };

                // Get the HTML DOM element that will contain your map 
                // We are using a div with id="map" seen below in the <body>
                var mapElement = document.getElementById('map');

                // Create the Google Map using our element and options defined above
                var map = new google.maps.Map(mapElement, mapOptions);

                // Let's also add a marker while we're at it
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(25.227185, 55.288806),
                    map: map,
                    title: 'World Trade Center'
                });
            }
}