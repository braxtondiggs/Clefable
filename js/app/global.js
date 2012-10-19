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
                if(data.status == "success") {
                    if (data.dialog != null) {
                        $('#dialog-' + data.dialog).attr('title', data.output.title).children('#dialog-' + data.dialog + '-body').html(data.output.text).end().dialog("open").data('listID', data.redirect);
                    }
		    if (data.output != null) {
			if (data.output.gritter != null) {
			    $.GritControl({'title': data.output.gritter.title, 'text': data.output.gritter.text, 'icon': data.output.gritter.icon});
			}
		    }
		    if (data.redirect != null) {
			window.location.href = data.redirect;
		    }
                }else if(data.status == "reload") {
                    window.location.reload();
                }else if(data.status =="error") {
                }
            }
        });
        return false;
    });
    $(".gritter-notify").livequery(function() {
	$.GritControl({'title': $(this).children('.gritter-title').text(), 'text':$(this).children('.gritter-text').text(), 'icon':$(this).children('.gritter-icon').text()});
    });
    function getScreenDimensions (){
        if (window.innerHeight) {
          screenWidth = window.innerWidth;
          screenHeight = window.innerHeight;
        } 
       else if ( document.documentElement.clientHeight ) {
          screenWidth = document.documentElement.clientWidth;
          screenHeight = document.documentElement.clientHeight;
        }
        else if ( document.body.clientHeight ) {
          screenWidth = document.body.clientWidth;
          screenHeight = document.body.clientHeight;
        }
        return {
          "screenWidth": screenWidth, 
          "screenHeight": screenHeight 
        }
    }
    
    function Init() {
        $("#breadCrumb").jBreadCrumb();
        $(".jQTabs").tabs().children('ul').removeClass('ui-widget-header').addClass('ui-widget-header-tab');
        $(".button").button();
        $(".formular").validationEngine('attach');
        $("#dialog-confirm").livequery(function() {//Dialog with OK & Cancel button
	    $.fx.speeds._default = 1000;//animation speed
	    var x = (getScreenDimensions().screenWidth - $(this).width()) / 2;
	    var y = (getScreenDimensions().screenHeight - $(this).height()) / 2;
	    $(this).dialog({
                autoOpen: false,
		resizable: false,
		modal: true,
		width: $(this).width(),
		draggable: false,
		show: "fade",
		hide: "fade",
		position: 'center',
		open: function() {
                    if (y < 40) {//Mke sure the dialog doesn't go outside window
                        $(this).parents('.ui-dialog').css({'top':'40px'});
                    }
                    $(document).delegate('.ui-widget-overlay', 'click', function() {//close dialog if overlay is closed
                        $("#dialog-confirm").dialog("close");
                    });
                    $(this).dialog( "option" , "title" ,$(this).attr('title'));
		},
		beforeClose: function(event, ui) {
		    $(this).fadeOut(1000);
		},
                buttons : {
                    "Ok": function() {
                         $.ajax($(this).data('listID'), {
                            type: "GET",
                            success: function(data) {
                                if(data.status == "success") {
                                    if (data.action != null) {
                                        if (data.action == "delete") {
                                            $('#' + data.output.id).fadeOut("slow", function() {$(this).remove();});
                                        }
                                    }
                                    if (data.output.gritter.title != null || data.output.gritter.text != null) {
                                        $.GritControl({'title': data.output.gritter.title, 'text': data.output.gritter.text, 'icon': data.output.gritter.icon});
                                    }
                                } else if(data.status == "reload") {
                                    window.location.reload();
                                } else{
                                    alert(internal_error);
                                    window.location.reload();
                                }
                            }
                         });
                         $(this).dialog("close");
                    },
                    "Cancel": function() {
                        $(this).dialog("close");
                    }
                }
		});
	});
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
		image: 'http://' + document.domain +'/igniter/css/app/images/notify/'+settings.icon+'.png',
		sticky: false,
		before_open: function() {$('#gritter-notice-wrapper').css('top', 40);},
		after_open: function(){$.scrollTo(0, 300, false);},
		time: 5000,
		
	    });
	}
    });
})(jQuery);