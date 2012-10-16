/*!
 * Contained Sticky Scroll v1.1
 * http://blog.echoenduring.com/2010/11/15/freebie-contained-sticky-scroll-jquery-plugin/
 *
 * Copyright 2010, Matt Ward
*/
(function( $ ){

  $.fn.containedStickyScroll = function( options ) {
  
	var defaults = {  
		unstick : true,
		easing: 'linear',
		duration: 500,
		queue: false,
		offset_top: 0/*,
		closeTop: 0,
		closeRight: 0  */
	} 
                  
	var options =  $.extend(defaults, options);
    var $getObject = $(this).selector;
    var last_scroll = 0; 
  	jQuery(window).scroll(function() {
        //Down
		if(jQuery(window).scrollTop() > (jQuery($getObject).parent().offset().top) &&
           (jQuery($getObject).parent().height() + jQuery($getObject).parent().position().top - 30) > (jQuery(window).scrollTop() + jQuery($getObject).height())){
        	lscroll = jQuery(window).scrollTop() - last_scroll;
			last_scroll = jQuery(window).scrollTop()
			elemtop =  (jQuery(window).scrollTop() - jQuery($getObject).offset().top) - lscroll ;
			alert(Math.abs(elemtop));
			jQuery($getObject).animate({ top: ((jQuery(window).scrollTop() - jQuery($getObject).parent().offset().top)) + Math.abs(elemtop)+"px" }, 
            { queue: options.queue, easing: options.easing, duration: options.duration });
        }
        //Up
		else if(jQuery(window).scrollTop() < (jQuery($getObject).parent().offset().top)){
        	//alert(jQuery(window).scrollTop()+"*"+ jQuery($getObject).parent().offset().top);
			jQuery($getObject).animate({ top:0},
            { queue: options.queue, easing: options.easing, duration: options.duration });
        }
	});

  };
})( jQuery );
