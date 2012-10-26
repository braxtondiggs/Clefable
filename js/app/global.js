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
                        $('#dialog-' + data.dialog).attr('title', data.output.title).children('#dialog-' + data.dialog + '-body').html(data.output.text).end().dialog("open").data('listID', data.modal_redirect);
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
                    alert(internal_error);
                    //window.location.reload();
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
	$(".geticon").livequery(function() {//refers to icons for Manage Websites page, grabs the favicon
		var prependto, href, iconclass = "cmsicon";
		if ($('#cymbitcms-page').hasClass('dashboard')) {
			href = $(this).attr("title");
			iconclass = iconclass + "iconpadding";
			prependto = $(this);
		}else if($('#cymbitcms-page').hasClass('manage_sites') || $('#cymbitcms-page').hasClass('users')) {
			href= 'http://'+$(this).text();
			prependto = $(this).parent('td').prev('td').find('.icon_home, .groupname');
		}
		$('<img>',{'src':'http://g.etfv.co/'+href+'?defaulticon=lightpng'})
        .addClass(iconclass)
        .prependTo(prependto);//handles favicon of the site
		
	});
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
                    var _this = $(this);
                    if (parseInt($(this).parent('.ui-dialog').css('top')) < 0) {//Mke sure the dialog doesn't go outside window
                        $(this).parent('.ui-dialog').css('top', 0);
                    }
                    $('.ui-widget-overlay').click(function() {//close dialog if overlay is closed
                        $(_this).dialog("close");
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
	$("#dialog-buttonless").livequery(function() {//dialog w/o any buttons
	    $.fx.speeds._default = 1000;//animation speed
	    var x = (getScreenDimensions().screenWidth - $(this).width()) / 2;
	    var y = (getScreenDimensions().screenHeight - $(this).height()) / 2;
	    $(this).dialog({
		autoOpen: false,
		resizable: false,
		modal: true,
		width: $(this).width(),
                height: $(this).height(),
		draggable: false,
		show: "fade",
		hide: "fade",
		position: 'center',
		open: function() {
                    var _this = $(this);
                    if (parseInt($(this).parent('.ui-dialog').css('top')) < 0) {//Mke sure the dialog doesn't go outside window
                        $(this).parent('.ui-dialog').css('top', 0);
                    }
                    $('.ui-widget-overlay').click(function() {//close dialog if overlay is closed
                        $(_this).dialog("close");
                    });
                    $(this).dialog( "option" , "title" ,$(this).attr('title'));
		},
		beforeClose: function(event, ui) {
		    $(this).fadeOut(1000);
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