 <!-- Styles -->       
<noscript id="deferred-styles">
</noscript>

<script>
    var loadDeferredStyles = function() {
    var addStylesNode = document.getElementById("deferred-styles");
    var replacement = document.createElement("div");
    replacement.innerHTML = addStylesNode.textContent;
    document.body.appendChild(replacement)
    addStylesNode.parentElement.removeChild(addStylesNode);
    };
    var raf = window.requestAnimationFrame || window.mozRequestAnimationFrame ||
        window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;
    if (raf) raf(function() { window.setTimeout(loadDeferredStyles, 0); });
    else window.addEventListener('load', loadDeferredStyles);
</script>



<!-- Scripts -->
<script src="{{ asset('assets/frontend/dist/scripts/lib/modernizr.min.js') }}"></script>  
<script src="{{ asset('assets/frontend/dist/scripts/lib/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('assets/frontend/dist/scripts/lib/jquery-migrate-3.0.1.min.js') }}"></script>
<script src="{{ asset('assets/frontend/dist/scripts/min/page_plugins.js') }}"></script>
<script src="{{ asset('assets/frontend/dist/scripts/min/page.js') }}"></script> 

<!-- Scripts -->

<script type='text/javascript' src='{{asset('assets/frontend/dist/scripts/external/sharethis.js')}}#property=5bb5e4b1752ef70011efd34c&product=inline-share-buttons' async='async'></script>
<script type="text/javascript">
    $(function() {
        
        
        $('#degital_tab').responsiveTabs({
            startCollapsed: 'accordion', 
            load: function(event, firstTab){
                // read more button event
                GAP.read_more_and_less();
            },          
            activate:function(){                               
                //$('.r-tabs-panel.r-tabs-state-active .moretext').hide();
                //$('.r-tabs-panel.r-tabs-state-active .moreless-button').text($('.r-tabs-panel .moreless-button').data('re-more'));
               
            }

        });

        $('.side_box').stickit({top : 100, screenMinWidth : 1024});
    })
</script>