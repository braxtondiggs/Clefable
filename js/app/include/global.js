$(function() {
    var internal_error = "An internal error has occurred, the page will auto-refresh.";
    Init();
    //ddsmooth();
    $('.menu .logout').bind('click', function() {
	var _this = $(this);
	bootbox.confirm("Are you sure you want to logout?", function(result) {
	    if (result) {
		 $.ajax($(this).attr('href'), {
		    type: "GET",
		    success: function(data) {
			if(data.status == "success") {
			    if (data.dialog != null) {
			    
				$('#dialog-' + data.dialog).attr('title', data.output.title).children('#dialog-' + data.dialog + '-body').html(data.output.text).end().dialog("open").data('listID', data.modal_redirect);
			    }
			}
		    }
		 });
		window.location.href = $(_this).attr('href');
	    }
	}); 
	return false;
    });
    $('.formular .delete').bind('click', function() {
	var _this = $(this);
	var output;
	if($(_this).hasClass('delete-site')) {
	    output = "Are you sure you want to delete your site? All the pages and information related to this site will be removed.<p>&nbsp;</p><p><strong>*Note</strong>: Your site still exists on your server.";
	//}else if($(_this).hasClass('delete-site') {
	 //   output = 
	}
	bootbox.confirm(output, function(result) {
	    if (result) {
		Ajax_Action(_this);
	    }
	}); 
	return false;
    });
    $('.fileTree a').bind('click', function() {
	return false;
    });
     $(".wizard_next, .wizard_previous").unbind("click").bind("click", function() {
	var total = $('.bwizard-steps li').length;
	var current = $('.bwizard-steps .active').index() + 1;
	var form = $(this).parents('form');
	var _this = $(this);
	if ($(".formular").validationEngine('validate')) {
	    if (current != total || ($('.alert-error').is(':visible') && $(_this).hasClass('wizard_previous'))){
		$('.tab-content .active').slideUp('slow', function() {
	    if ($(_this).hasClass('wizard_next')) {
		 $('.bwizard-steps .active').removeClass('active').next('li').addClass('active');
		 $('.tab-content .active').removeClass('active').next('.tab-pane').slideDown().addClass('active');
		 var percent = ((current+1) / total) * 100;
		 $('#wizard_name').find('.bar').css({width : percent + '%'});
		 if(current >= 1) {$('.wizard_previous').show();}
	   }else if($(_this).hasClass('wizard_previous')) {
		 $('.bwizard-steps .active').removeClass('active').prev('li').addClass('active');
		 $('.tab-content .active').removeClass('active').prev('.tab-pane').slideDown().addClass('active');
		 if(current <= 2) {$('.wizard_previous').hide();}
	   }
	   });
	    }else{
		Form_Submit(_this, form);
	    }
	}
     });
    $(".submit").bind("click", function() {
        var form = $(this).parents('form');
        if ($(".formular").validationEngine('validate')) {
            var _this = $(this);
	    $(this).attr('disabled', 'disabled');
            Form_Submit(_this, form);
	}
        return false;
    });
    function Form_Submit(_this, form) {
	$.ajax($(form).attr('action'), {
                type: "POST",
                data: $(".formular").serialize(),
		success: function(data) {
		    $(_this).removeAttr('disabled');
		    if(data.status == "success") {
			window.location.href= data.redirect;
		    }else if(data.status =="error") {
			$(".alert-error p").html(data.output).parent().slideDown('slow');
			$("html, body").animate({
                            scrollTop: 0
                        }, 1100);
			 
		    } else {
			alert(internal_error);
			//window.location.reload();
		    }
		}
	    });
    }
    $(".ajax-action").bind("click", function() {
        var _this = $(this);
	Ajax_Action(_this);
        return false;
    });
    function Ajax_Action(_this) {
	$.ajax($(_this).attr('href'), {
            type: "GET",
            success: function(data) {
                if(data.status == "success") {
                    if (data.output != null) {
			//if (data.output.gritter != null) {
			//    $.GritControl({'title': data.output.gritter.title, 'text': data.output.gritter.text, 'icon': data.output.gritter.icon});
			//}
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
    }
    /*
    $('.ghost').livequery(function() {
	$(this).each(function(index) {// Adds the Ghost effect on textbox, this could be converted to a plugin
	    if ($(this).val() === "" || $(this).val() === $(this).attr("title")) {
		$(this).attr("value", $(this).attr("title")).css({"color": "#999"});
		$(this).focusin(function() {
		    if ($(this).val() === $(this).attr("title")) {
			$(this).val("").css({"color": "#000000"});
		    }
		}).focusout(function() {
		    if ($(this).val() === "") {
			$(this).val($(this).attr("title")).css({"color": "#999"});
		    }
		});
	    }
	});
    });
    $(".asset_img_cont").livequery(function() {//Asset Manager images and documents
        $(this).hover(function() { 
        var asset = $(this);var img = asset.children('img');var position = asset.position();var img_src = img.attr("src");var w_img = img.width(); var h_img = img.height();var img_size = "Small";
	if(w_img <= 249)img_size = "Small";else if(w_img >=250 && w_img <= 499)img_size = "Medium";else if(w_img >=500)img_size = "Large";//declare vars
            $('#asset_helper').css({'top':function() {return (position.top+5);}, 'left':function() {return (position.left-($(this).width())-11);}}).show().data("pixlr", {src: img_src, file: $(img).attr('data-file')});//information window located next to the image
	    if (img.attr('class') == "asset_img") {//insides for the helper, only images
                $("#asset_helper").find('.asset_helper_title').addClass(asset.attr('id')).find('.img_title').text(img_src.substring(img_src.lastIndexOf('/')+1)).end().end().find('#asset_img_src').attr('href', img_src).end().find('.size .img_size').text(img_size).end().find('.size .img_width').text(w_img).end().find('.size .img_height').text(h_img);
	    }else if (img.attr('class') == "asset_doc") {//info window for documents only
		//$('#asset_helper').html("<p class=\""+asset.attr('id')+"\">"+$(this).find('#doc_title').text()+"</p><div class=\"right\"><a href=\"#\" class=\"button coming_soon\" title=\"Edit Image\" style=\"margin-right:6px;\"><span class=\"edit cmsicon\"></span>Edit</a><a href=\"#\" class=\"button coming_soon\" title=\"Delete Image\"><span class=\"delete cmsicon\"></span>Delete</a></div >");	
	    }
        }, function() {                
            $('#asset_helper').hide();
	});
    });
    $("#asset_helper").livequery(function() {//functionality for assest helper 
	$(this).hover(function() { 
	    $(this).show();
	    $(this).stop().fadeTo("fast", 1.0);
        }, function() {
	    $(this).stop().fadeTo("fast",0.75);
	    $('#asset_helper').hide();
        });
    });
    
    $("img.asset_img, img.asset_doc").livequery(function() {//image block, gives cool transition effect once image has loaded
	$(this).one('load',function() {
  	    $(this).fadeIn(700).css('display',"block");
	}).each(function() {
 	    if (this.complete) $(this).trigger('load');
	});
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
    }*/
    
    function Init() {
        $(".formular").validationEngine('attach');
	$("#breadCrumb").jBreadCrumb();
	$(".geticon").livequery(function() {//refers to icons for Manage Websites page, grabs the favicon
	    $('<img>',{'src':'http://g.etfv.co/'+$(this).attr('data-url')+'?defaulticon=lightpng'}).addClass('cmsicon').prependTo($(this));//handles favicon of the site
	});
    }
        /*$("#dialog-confirm").livequery(function() {//Dialog with OK & Cancel button
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
                            type: "POST",
			    data: $('#dialog-confirm form').serialize(),
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
				}else if (data.status == "relcate") {
				    window.location = data.location;
				} else{
                                    alert(internal_error);
                                    //window.location.reload();
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
    }*/

});