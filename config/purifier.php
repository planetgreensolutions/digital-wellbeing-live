<?php 
return [
 
		'HTML.Doctype'             => 'HTML 4.01 Transitional',
		'HTML.Allowed'             => 'div,b,strong,i,em,u,a[href|title],ul,ol,li,p[style],br,span[style],img[width|height|alt|src]',
		'CSS.AllowedProperties'    => 'font,font-size,font-weight,font-style,font-family,text-decoration,padding-left,color,background-color,text-align',
		'AutoFormat.AutoParagraph' => true,
		'AutoFormat.RemoveEmpty'   => true,
       
        
        "HTML.SafeIframe"      => 'true',
        "URI.SafeIframeRegexp" => "%^(http://|https://|//)(www.youtube.com/embed/|player.vimeo.com/video/)%",
        
   
];
?>