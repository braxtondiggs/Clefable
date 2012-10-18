$(function() {
    var internal_error = "An internal error has occurred, the page will auto-refresh.";
    Init();
    $(".submit").bind("click", function() {
        var form = $(this).parents('form');
        if ($(".formular").validationEngine('validate')) {
            $(this).attr('disabled', 'disabled');
            $.ajax($(form).attr('action'), {
                type: "POST",
                data: $(".formular").serialize(),
		success: function(data) {
		    $(this).removeAttr('disabled');
		    if(data.status == "success") {
			window.location.href= data.redirect;
		    }else if(data.status =="error") {
			$(".validate_errors").html(data.output).slideDown('slow');
		    } else {
			alert(internal_error);
			//window.location.reload();
		    }
		}
	    });
	}
        return false;
    });
    $(".ajax-action").bind("click", function() {
        $.ajax($(this).attr('href'), {
            type: "GET",
            success: function(data) {
                                    //$(this).removeAttr('disabled');
				    ///if(data.status == "success") {
					//window.location.href= 'app/';
				    //}else if(data.status =="error") {
					  //  $(".validate_errors").html(data.output).slideDown('slow');
				    //}//else {
					//alert(internal_error);
					//window.location = "/app";
				    //}
				}
			});
		
        return false;
    });
    $(".gritter-notify").livequery(function() {
	$.GritControl({'title': $(this).children('.gritter-title').text(), 'text':$(this).children('.gritter-text').text(), 'icon':$(this).children('.gritter-icon').text()});
    }); 
    
    function Init() {
        $("#breadCrumb").jBreadCrumb();
        $(".jQTabs").tabs().children('ul').removeClass('ui-widget-header').addClass('ui-widget-header-tab');
        $(".button").button();
        $(".formular").validationEngine('attach');
    }
});

(function ($) {
    $.extend({
        GritControl: function (options) {
            var settings = $.extend({
			'title'  : '',
      			'text' : '',
			'icon'  : null
    	    }, options);
	    $.gritter.options.position = 'top-left';
	    $.gritter.add({
		title: settings.title,
		text: settings.text,
		image: '../css/app/images/notify/'+settings.icon+'.png',
		sticky: false,
		before_open: function() {$('#gritter-notice-wrapper').css('top', 40);},
		after_open: function(){$.scrollTo(0, 300, false);},
		time: 5000,
		
	    });
	}
    });
})(jQuery);