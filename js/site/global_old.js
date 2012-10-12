/****************************************************/
//Global.JS - handles all the basic needs for the web app to function. Always needed to be loaded for the site to work
/*Note* Important variables:
QID: Account Owner's ID
EID: Editor's ID
GID: Group ID
SID: Site ID
PID: Page ID
*/
/****************************************************/
var scoll_count;var is_reload = true;var t;var dscroll = 0;var user_language = "en";var source_editor;var init = 0;var json_merged;
pixlr.settings.exit = 'http://cymbit.com/site/js/pixlr/exit.php';
pixlr.settings.credentials = true;
pixlr.settings.method = 'GET';
var json_grit = (function () {//GEt JSON file and convert them to JS Object
    var json_grit = null;
    $.ajax({
        'async': false,
        'global': false,
        'url': 'json/gritter/basic',
        'dataType': "json",
        'success': function (data) {
            json_grit = data;
        }
    });
    return json_grit;
})(); 
$(function() {//Initialize staged functions
	Init();//Main Function
	Navigation();//Handles Navigation	
	Functions();//Holder for function
	Menu_Nav();
	ddsmooth();//Init Menu
	$('body').after('<img id="preload" src="../images/70.gif" />');//preload image
	$('#preload').remove();//remove preloaded image
});
function Init() {//All livequery calls should be located here
	$("#sidekick").dialog({//sidekick for app
		open: function(event, ui) { 
			$('#sidekick .drag_components li').draggable({//initalize draggable components 
				revert: 'invalid',
				appendTo: 'body',
				helper: function(event) {//customize ghost helper
					$(event.currentTarget).addClass("clone_listitem");
					return $(event.currentTarget.outerHTML).width(200);
				},
				zIndex: 1500,
				cursor: "move"
			});
			$(".ui-dialog-titlebar-close").hide().after('<a href="#" class="ui-corner-all ui-dialog-titlebar-min" role="button"><span class="ui-icon ui-icon-minusthick">minimize</span></a>');//change jQ close button to a minimize button 
			$('.ui-dialog-titlebar-min').live({//keep live, add native function to button
 			 	mouseover: function() {
					$(this).addClass('ui-state-hover');
  				},
				mouseout: function() {
					$(this).removeClass('ui-state-hover');
				}
			}).toggle(//function to maximize sidekick
				function () {
					$(this).parents('.ui-dialog').animate({"height": "34px"}, "slow");
					$(this).children().html("expand").removeClass("ui-icon-minusthick").addClass("ui-icon-plusthick");//change back
					$( "#sidekick" ).dialog( "option", "resizable", false );//return functionality
				},
				function() {
					$(this).parents('.ui-dialog').animate({"height": "500px"}, "slow");
					$(this).children().html("minimize").removeClass("ui-icon-plusthick").addClass("ui-icon-minusthick");
					$( "#sidekick" ).dialog( "option", "resizable", true );	
				}
			);
		},
		dragStart: function(event, ui) {//dragging sidekick gives it opacity
			$(this).parents('.ui-dialog').css({"opacity" : 0.7,"filter": "alpha(opacity=70)"});
			},
		dragStop: function(event, ui) {//make sure sidekick is inisde window view and return opacity
			if ($(this).parents('.ui-dialog').position().top < 40) {
				$(this).parents('.ui-dialog').animate({top: 40}, 'slow', function() {$(this).css({"opacity" : 1,"filter": "alpha(opacity=100)"});});
			}else{
				$(this).parents('.ui-dialog').css({"opacity" : 1,"filter": "alpha(opacity=100)"});
			}
		},	
		autoOpen: false,
		show: "fade",
		closeOnEscape: false,
		position: [($(window).width()-$(this).parents('.ui-dialog').width()), 'center'],
		title: "Sidekick",
		dialogClass: "ui-dialog-sidekick",
		width: 200,
		height:450,
		minWidth: 200,
		minHeight: 450
		
	});
	
	$(".asset_img_cont").livequery(function() {//Asset Manager images and documents
		$(this).hover(function() { 
                var asset = $(this);var img = asset.children('img');var position = asset.position();var img_src = img.attr("src");var w_img = img.width(); var h_img = img.height();var img_size = "Small";
				if(w_img <= 249)img_size = "Small";else if(w_img >=250 && w_img <= 499)img_size = "Medium";else if(w_img >=500)img_size = "Large";//declare vars
				$('#asset_helper').css({'top':function() {return (position.top+5);}, 'left':function() {return (position.left-($(this).width())-10);}}).show();//information window located next to the image
				if (img.attr('class') == "asset_img") {//insides for the helper, only images
					$('#asset_helper').html("<p class=\""+asset.attr('id')+"\">"+img_src.substring(img_src.lastIndexOf('/')+1)+"</p><a id=\"asset_img_src\" href=\""+img_src+"\" target=\"_blank\">view full size in new window</a><p>Size: "+img_size+" ("+w_img+"x"+h_img+")</p><div class=\"right\"><a href=\"#\" class=\"button edit-imgbtn\" title=\"Edit Image\" style=\"margin-right:6px;\"><span class=\"edit cmsicon\"></span>Edit</a><a href=\"#\" class=\"button dlt-imgbtn\" title=\"Delete Image\"><span class=\"delete cmsicon\"></span>Delete</a></div>");/*Maybe have this loaded on Dom already*/
				}else if (img.attr('class') == "asset_doc") {//info window for documents only
					$('#asset_helper').html("<p class=\""+asset.attr('id')+"\">"+$(this).find('#doc_title').text()+"</p><div class=\"right\"><a href=\"#\" class=\"button coming_soon\" title=\"Edit Image\" style=\"margin-right:6px;\"><span class=\"edit cmsicon\"></span>Edit</a><a href=\"#\" class=\"button coming_soon\" title=\"Delete Image\"><span class=\"delete cmsicon\"></span>Delete</a></div >");	
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
	$("#asset_helper .edit-imgbtn").livequery(function() {//edit button inside helper window
		$(this).click(function() {
			Loading(true);
			var src = $("#asset_helper .edit-imgbtn").parents('#asset_helper').children('a').attr('href');//src of image
			var select_img = $("#asset_helper .edit-imgbtn").parents('#asset_helper').children('p').attr('class');
			$('#assets #'+select_img+' img').addClass('img_changed');//addes class to tell pixlr to update
			$.ajax('include/ftp/file_get.php', {//grabs files off users server
			async: true,
			type: 'POST',
			data: 'SID='+$("#main").find('.push-cymbit').attr('id').split('_')[0]+'&src='+src,
  			success: function(data) {
				Loading(false);
				var src = $("#asset_helper .edit-imgbtn").parents('#asset_helper').children('a').attr('href');
				pixlr.settings.target = 'http://cymbit.com/site/js/pixlr/asset_save?SID='+$("#main").find('.push-cymbit').attr('id').split('_')[0]+'&src='+src;//place to save image posted back from pixlr
				pixlr.overlay.show({image: "http://cymbit.com/site/CMS/"+$('body').attr('class')+src.replace(/^[^\/]*(?:\/[^\/]*){2}/, ""), title: src.substring(src.lastIndexOf('/')+1), service:'express'})//init pixlr
				
			}
		});
			;
			return false;
		});
	});
	$("#asset_helper .dlt-imgbtn").livequery(function() {//delete button for asset helper
		$(this).click(function() {
			$('body').prepend('<div id="dialog-confirm" style="display:none;width:400px;" title="Are you sure?"><br /><span id="delete_img" class="' +$(this).parents('#asset_helper').children('p').attr('class') +'"><p>Are you sure you want to delete this image? This image will be permanently deleted.</p></span></div>');//open delete dialog
			return false;
		});
	});
	$("#breadCrumb").livequery(function() {
		$(this).jBreadCrumb();//init breadcrumb for menu mav
	});
	$(".button").livequery(function() {//applied to all elements with button as class
		$(this).button();//jquery native button
	});
	$(".jQTabs").livequery(function() {
		$(this).tabs();//jquery native tabs
		$(".jQTabs ul").removeClass('ui-widget-header').addClass('ui-widget-header-tab');
	});
	$(".jQAccordion").livequery(function() {
		$(this).accordion({autoHeight: false});//jquery native accordion
	});
	$("#usage_progressbar").livequery(function() {
		var progress = ((parseInt($('#usage_start').text()) / parseInt($('#usage_end').text())) * 100)
		//pull usage a mximums from DOM
		$(this).progressbar({
			value: progress
		});//jquery native progree bar
		if (progress <= 0) {$(this).children('.ui-progressbar-value').hide();}
	});
	$(".formular").livequery(function() {//formular class always refers toform tags
		$(this).validationEngine('attach');//attach validation to form
	});
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
	
	$("#code").livequery(function() {//source code
	source_editor = CodeMirror.fromTextArea(document.getElementById("code"), {//Gives CodeMirror, code element
		  mode: "text/html", 
		  tabMode: "indent",
		  lineNumbers: true,
		  onCursorActivity: function() {
			  source_editor.setLineClass(hlLine, null);
			  hlLine = source_editor.setLineClass(source_editor.getCursor().line, "activeline");
		},
		onKeyEvent: function(i, e) {
          // Hook into F11
          if ((e.keyCode == 122 || e.keyCode == 27) && e.type == 'keydown') {
            e.stop();
            return toggleFullscreenEditing();
          }
        }
			
		});//init code mirror plugin
			var hlLine = source_editor.setLineClass(0, "activeline");
			function toggleFullscreenEditing()
    {
        var editorDiv = $('.CodeMirror-scroll');
        if (!editorDiv.hasClass('fullscreen')) {
            toggleFullscreenEditing.beforeFullscreen = { height: editorDiv.height(), width: editorDiv.width() }
            editorDiv.addClass('fullscreen');
            editorDiv.height('100%');
            editorDiv.width('100%');
            source_editor.refresh();
        }
        else {
            editorDiv.removeClass('fullscreen');
            editorDiv.height(toggleFullscreenEditing.beforeFullscreen.height);
            editorDiv.width(toggleFullscreenEditing.beforeFullscreen.width);
            source_editor.refresh();
        }
    }
	});
	$(".listitems").livequery(function() {//listed items styled using jQuery UI
	$(this).delegate('li', 'mouseover mouseout', function() {
		if (!$(this).hasClass('ui-state-active')) {
			$(this).toggleClass('ui-state-default ui-state-hover');
		}
	}).delegate('li', 'click', function() {
		if (!$(this).parents('ul.listitems').hasClass('nodown_state')) {
			$('#groups_items li.ui-state-active').not($(this)).toggleClass('ui-state-active ui-state-default');//Still does work - can't undo select
			if ($(this).hasClass('ui-state-hover')) {
				$(this).removeClass('ui-state-hover').addClass('ui-state-active');
			}
			if ($(this).hasClass('ui-state-default')) {
				$(this).removeClass('ui-state-default').addClass('ui-state-active');
			}
		}
		}).disableSelection();
	});
	$('.img_button input[type="image"]').livequery(function() {//work around for submit button to remove the parameters when using GET
		$('form.img_button').submit(function() {
			$('input[type="image"]').attr('disabled',true); 
		});
	});
	$('.img_button input[type="image"]:disabled').livequery(function() {
		$(this).attr('disabled', false);//precaution, if page doesn't go anywhere
	});
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
	
	$("#dialog-confirm").livequery(function() {//Dialog with OK & Cancel button
		$.fx.speeds._default = 1000;//animation speed
		var x = (getScreenDimensions().screenWidth - $(this).width()) / 2;
		var y = (getScreenDimensions().screenHeight - $(this).height()) / 2;
		$(this).dialog({
			resizable: false,
			modal: true,
			title: $(this).attr('title'),
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
				/*if($(this).children('span').attr('id') == "new_page") {//doesn't work
					$("#dialog-confirm:not(:has(>input))").click(function(e) {
						if (!$(e.target).parent("ul").hasClass("listitems")) {
							$('.listitems li.ui-state-active').toggleClass('ui-state-active ui-state-default');
						}
					});
				}*/
			},
			beforeClose: function(event, ui) {
				if ($(this).children('span').attr('id') == "new_page") {// New Page only
					$('#new_page_form').validationEngine('hideAll');$('body').css({"overflow":""});$('#dialog-confirm').unbind();//hide validation and unlock scroll
				}
				$(this).fadeOut(1000, function() {$(this).remove();});
			},
			buttons: {
				"Ok": function() {
					var no_close = false;
					var hash = window.location.hash.substr(1);
					var param2 = $.rc4DecryptStr(hash, '').split('@')[2];//params are located in hash, needs to be decoded and split based on delimiter
					var param3 = $.rc4DecryptStr(hash, '').split('@')[3];
					switch($(this).children('span').attr('id')) {//based on dialog ID, type of dialog to open
						case 'delete_site':
							elem_class =$(this).children('span').attr('class');//SID pulled from DOM
							AjaxCall('include/functions/delete?SID='+elem_class, 'N/A',  false, false, "POST");
							$('#'+elem_class).fadeOut('slow', function() {$(this).remove();});
							proval = parseInt($('#usage_start').text()) - 1;//update progress bar
							$('#usage_start').text(proval);
							var progress = ((parseInt($('#usage_start').text()) / parseInt($('#usage_end').text())) * 100)
							$("#usage_progressbar").progressbar( "value" , progress);//re-init with new progress bar  							
							$.GritControl({'id':'tl6gVu2JEwK'});//notification
						break;
						case 'delete_page'://Delete Page
							elem_class =$(this).children('span').attr('class');
							AjaxCall('include/functions/delete?PID='+elem_class.split('_')[0], 'N/A',  false, false, "POST");
							$('#'+elem_class).fadeOut('slow', function() {$(this).remove();});
							$.GritControl({'id':'Us9S0v87yok'});
						break;
						case 'delete_user'://Delte User
							elem_class =$(this).children('span').attr('class');//DOM Class
							AjaxCall('include/functions/delete?EID='+elem_class, 'N/A',  false, false, "POST");
							$('#'+elem_class).fadeOut('slow', function() {$(this).remove();});
							$.GritControl({'id':'JNdLiw1gTGs'});
						break;
						////NOt bad Code -- needs to be moved to premium JS  --- this ability is not available to basic users
						/*case 'delete_group'://Dlete Group
							elem_class =$(this).children('span').attr('class');
							//AjaxCall('include/functions/delete?GID='+elem_class, 'N/A',  false, false, "POST");
							$.GritControl({'id':'mK2wx4nuWYV'});
						break;
						case 'delete_group_perm':
							elem_class =$(this).children('span').attr('class');
							AjaxCall('include/functions/delete?GID='+elem_class, 'N/A',  false, false, "POST");
							$('#groups_items_toolbar li[title="'+elem_class+'"]').fadeOut('fast', function() {$(this).remove()});
							$('#groups_items li[title="'+elem_class+'"]').fadeOut('fast', function() {$(this).remove()});
							$.GritControl({'id':'rn8hx0d4pZO'}); 
						break;*/
						case 'group_dialog'://Update Group
							elem_class =$(this).children('span').attr('class');
							var UID="",Create="", Read="", Modify="", Delete="", Publish="";
							var count = 1;var is_checked;
							$('#userTable input[type="checkbox"]').each(function(index) {//collecting checkbox value 
								if (count > 5) count = 1;//break, end if current site permissions
								if ($(this).is(':checked')) {
									is_checked = 1;
								}else {
									is_checked = 0;
								};
								switch(count) {//save all checked values
									case 1:
										Create = Create + is_checked + ",";
										UID = UID + $(this).parents("tr").attr("class") + ",";//User permission set to
									break;
									case 2:
										Read = Read + is_checked + ",";
									break;
									case 3:
										Modify = Modify + is_checked + ",";
									break;
									case 4:
										Delete = Delete + is_checked + ",";
									break;
									case 5:
										Publish = Publish + is_checked + ",";
									break;
								}
  								count++;
							});
							if (UID.substring(0, UID.length-1) != "") {//No UID info no entry
								AjaxCall('include/functions/save/group?GID='+elem_class+'&UID='+UID.substring(0, UID.length-1)+'&create='+Create.substring(0, Create.length-1)+'&read='+Read.substring(0, Read.length-1)+'&modify='+Modify.substring(0, Modify.length-1)+'&delete='+Delete.substring(0, Delete.length-1)+'&publish='+Publish.substring(0, Publish.length-1), 'N/A', false, false, "POST");
								$.GritControl({'id':'QRo6x6R2LEE'});
							}
						break;
						case 'browsesite'://Filler
						
						break;
						case 'new_page'://New Page
							$("#new_page_form").validationEngine('attach',{scroll: false});//attach validation
							if ($("#new_page_form").validationEngine('validate')) {//validate form
								//if($("#new_page_list li").hasClass("ui-state-active")) {
									param2 = (param3!="")?param2 = param2:params="";//Get directory
									var SID = $("#main").find('.push-cymbit').attr('id').split('_')[0];
									Loading(true);
									$.ajax('include/functions/save/page', {
										async: false,
										type: 'POST',
										data: 'SID='+SID+'&'+$("#new_page_form").serialize()+"&dir="+param2,
  										success: function(data) {
											$('span[id^="'+SID+'"]').after(data);//Add new page to select
										}
									});
									no_close = false;
									Loading(false);
								//}else{
									//$('#template_holder').validationEngine('showPrompt', '*Select template for new page')
								//}
							}else{//\fail validation
								/*if(!$("#new_page_list li").hasClass("ui-state-active")) {
									$('#template_holder').validationEngine('showPrompt', '*Select template for new page')
								}*/
								no_close = true;//deny close
							}
						break;
						case 'new_folder':// Add New Folder
						$("#new_folder_form").validationEngine('attach',{scroll: false});//Attach Validation
							if ($("#new_folder_form").validationEngine('validate')) {//validate form
								var SID = $("#main").find('.push-cymbit').attr('id').split('_')[0];
							$.ajax('include/functions/save/folder', {
										async: false,
										type: 'POST',
										data: 'SID='+SID+'&'+$("#new_folder_form").serialize()+"&dir="+param2,
  										success: function(data) {
											$('div.page_folder:last').after(data);//Add new folder to DOM at the end of all folder
										}
									});
							$.GritControl({'id':'GrHwam2yIlhPk'});//notify	
							no_close = false;
							}else{
							no_close = true;//deny close
							}
							
							
						break;
						case 'delete_img'://Delete Image from Assets
							if ($("#main").find('.push-cymbit').attr('id').split('_')[0] != "XOujlec") {// can't delete anything from the demo
								elem_class =$(this).children('span').attr('class');
								var img_todlt = $('#assets').children('#'+elem_class);
								AjaxCall('include/ftp/file_dlt?src='+img_todlt.children('img').attr('src')+"&SID="+$("#main").find('.push-cymbit').attr('id').split('_')[0], 'N/A',  false, false, "POST");
								img_todlt.fadeOut('slow', function() {
									$(this).remove();
									$.GritControl({'id':'uqBM6Vkr80F'});
								});
							}else {
								$.GritControl({'id':''});
							}
							
						break;
						case 'regpage':
						var SID = $("#main").find('.push-cymbit').attr('id').split('_')[0];
							$.ajax('include/functions/save/ftppage', {
								async: false,
								type: 'POST',
								data: 'SID='+SID+'&rel='+$('.jqueryFileTree a.selected').attr('rel'),
  								success: function(data) {
										$('span[id^="'+SID+'"]').after(data);
									}
								});
						break;
						default:
							alert('Not Set');
						break;
					}
					if (no_close == false) {
						$(this).dialog("close");
					}
				},
				Cancel: function() {
					$(this).dialog("close");
				}
			}
		});
	});
	$("#dialog").livequery(function() {//dialog w/o any buttons
		$.fx.speeds._default = 1000;//animation speed
		$(this).dialog({
			resizable: false,
			modal: true,
			title: $(this).attr('title'),
			width: $(this).width(),
			height: $(this).height(),
			draggable: false,
			show: "fade",
			hide: "fade",
			open: function() {
				//if($(this).parent().position().top < 40) {
				//	$(this).parent().css({"top":40});
				//}
				$(document).delegate('.ui-widget-overlay', 'click', function() {
					$("#dialog").dialog("close");
				});
			},
			beforeClose: function(event, ui) {
				$(this).fadeOut(1000, function() {$(this).remove();$('body').css("overflow", "");});
			}
		}).parents('.ui-dialog').center();
	});
	
	$("#dialog-inform").livequery(function() {//Dialog with just OK button, used to inform users
		$.fx.speeds._default = 1000;//animation speed
		$(this).dialog({
				resizable: false,
				modal: true,
				title: $(this).attr('title'),
				width: $(this).width(),
				draggable: false,
				show: "fade",
				hide: "fade",
				position: 'center',
				open: function() {
					//if($(this).parent().position().top < 40) {
					//	$(this).parent().css({"top":40});
					//}
					$(document).delegate('.ui-widget-overlay', 'click', function() {
						$("#dialog-confirm").dialog("close");
					});
				},
			beforeClose: function(event, ui) {
				$(this).fadeOut(1000, function() {$(this).remove();$('body').css("overflow", "");});
			},
			buttons: {
				"Ok": function() {
					var no_close = false;
					switch($(this).children('span').attr('id')) {
						case "max_site"://Inform users they have hit maximum number of sites
							History("manage_sitebtn", "");
							$(this).dialog("close");
						break;
						//NOt bad Code -- needs to be moved to premium JS
						/*case 'add_group':
							alert($(this).find("#group_items_add").attr('class'));
							elem_class =$(this).children('span').attr('class');
							if(!$(this).find("#group_items_add").children('li').hasClass("ui-state-active")) {
									$('#group_items_add').validationEngine('showPrompt', '*Select group to add to user');
							}else if($(this).find('#group_items_add li').attr('title') == $('#groups_items li').attr('title')) {
								$('#group_items_add').validationEngine('showPrompt', '*Selected group has already been applied');no_close = true;
							}
						break;*/
						default:
							alert('Not Set');//Needs to be changed
						break;
					}
					if (no_close == false) {
						$(this).dialog("close");
					}
				}
			}
			});
	});
	
	$("#user #groups_items").livequery(function() {//Under users group tabs, users have the ability to sort, dlete and rename groups this code needs to be moved to the newer JS
		var GID = "";
		$(this).sortable({
			/*placeholder: "ui-state-highlight"*/
			activate: function(event, ui) {//user starts interaction
				GID = "";
				$("#groups_items li").each(function(index) {//collect vital info
					GID = GID + ", " + $(this).attr("title");
				});
			},
			receive: function(event, ui) {//recive new group item
				sortableIn = 1;
				if (GID.search(ui.item.attr("title")) != -1) {
					$.GritControl({'id':'bjwUietmM8D'});
					$('#groups_items li[title="'+ui.item.attr("title")+'"]:last').remove()
				}
			},
			over: function(event, ui) {
				sortableIn = 1;
				if ($("#groups_items .ui-sortable-helper .groupimg").exists()){
					$("#groups_items .ui-sortable-helper .groupimg").remove();
				}
			},
			out: function(event, ui) {
				sortableIn = 0;
				$("#groups_items .ui-sortable-helper").prepend('<img class="groupimg" src="css/images/notify/cross-circle.png"/>');
			},
			beforeStop: function(event, ui) {
				if (sortableIn == 0) {
					ui.item.remove();
				}
			}
		}).disableSelection();
	});
	$("#groups_items_toolbar li").livequery(function() {//not sure what this does but it works
		$(this).draggable({
			connectToSortable: "#user #groups_items",
			helper: function(event) {return $(event.currentTarget.outerHTML).width(200);},
			revert: "invalid"
			
		});
	});
	
	$("#toolbar1").livequery(function() {//code relates to CKEditor, may not be used users are allowed to add/remove items inside their WYSIWYG. MErcury doesn't seem to have similar features
		var btnspace = "";
		$(this).sortable({
			//placeholder: "ui-state-highlight",
			activate: function(event, ui) {
				btnspace = "";
				$("#toolbar1 li").each(function(index) {
					btnspace = btnspace + " ," + $(this).attr("title");//on iteration save elements info into var
				});
			},
			receive: function(event, ui) {//allow organization of toolbar buttons
				sortableIn = 1;
				if (btnspace.search(ui.item.attr("title")+" ,") != -1) {
					$.GritControl({'id':'t0f2UTH88a2'});
					$('#toolbar1 li[title="'+ui.item.attr("title")+'"]:last').remove()
				}
			},
			over: function(event, ui) {//marked as just an organize
				sortableIn = 1;
			},
			out: function(event, ui) {//marked to be deleted 
				sortableIn = 0;
			},
			beforeStop: function(event, ui) {
				if (sortableIn == 0) {
					ui.item.remove();
				}
			}
		}).disableSelection();
	});
	$("#side_container .btn_holder li").livequery(function() {//gives the sidebar container the ability to drag toolbar buttons to the reciver, this is also in question to keep
		$(this).draggable({
			connectToSortable: "#toolbar1",
			helper: "clone",
			revert: "invalid"
			
		});
	});
	
	  $.extend($.gritter.options, { //Sets gritter plugin options, this needs to be moved to where gritter is being initialized
	  	position: 'top-left',
		time: 5000
	  });
}

function Navigation() {//handles all of the page navigation and stores it into page history
	var loc, param, classes;
	var selector = new Array("manage_sitebtn", "manage_userbtn", "add-sitebtn", "add-userbtn", "edit_user", "site_dashboard", "edit_site", "close_app", "sitemap", "page", "edit_page", "edit_user_menu","dashboard", "activate", "templates");//array of page names
	for(var i in selector) {
		$(document).delegate('.'+selector[i]+', .'+selector[i]+':not(.page_menu))', 'click', function(k) {//makes all selector array clickable
			return function() {
				param = '@';//delimiter
				var nav_class = $(this).parents('.push-cymbit').attr('id');//grab DOM SID/PID or UID
				if(typeof nav_class != 'undefined') {
					nav_class = nav_class + "_";
					classes = nav_class.split("_");
					for(i = 0; i < classes.length; i++){
						param = param+classes[i]+"@";//form param to store in url
					}
				}
				History(selector[k], param);//K is the index and param is an artifical param
				return false;
            }
        }(i));
	}
	/****************************************************************************************************/
	/*
	NavControl URL Builder Syntax - 
		1. Main Page URL path
		2. Sidebar URL path, add plus to have more
		3. Use question mark to start paramater for multiple params use the colon symbol
		
	Example:
	url_path/main_page+sidebar1+sidebar2?param1=soomething:param2=something+sidebar3
	*/
	/****************************************************************************************************/
	$.history.init(function(hash){//fires as soon as hash is found in URL
		if(hash != "") {//no empty hash
			var param1 = $.rc4DecryptStr(hash, '').split('@')[1];//decrypt hash and break
			var param2 = $.rc4DecryptStr(hash, '').split('@')[2];
			var param3 = $.rc4DecryptStr(hash, '').split('@')[3];
			switch(String($.rc4DecryptStr(hash, '').split('@', 1))) {//page name to load
				case "manage_sitebtn":
					NavControl('site/manage_sites+actions?site=true+usage+type');
				break;
				case "manage_userbtn":
					manage_user();//Shared
				break;
				case "add-sitebtn"://All sites
					NavControl('site/site');
				break;
				case "add-folderbtn":
					$('body').prepend('<div id="dialog-confirm" style="display:none;width:400px;" title="Create New Folder"><br /><span id="new_folder" class=""></span></div>');
					AjaxCall('include/dialog/newfolder', '#new_folder');
				break;
				case "add-userbtn"://New user page
					//NOt bad Code -- needs to be moved to premium JS
					//NavControl('user/users+group_toolbar');
					NavControl('user/users');//w/o group toolbar
				break;
				case "edit_user"://main user page
					//NOt bad Code -- needs to be moved to premium JS
					//NavControl('user/users?EID='+param1+'+group_toolbar');
					NavControl('user/users?EID='+param1);
				break;
				case "edit_user_menu"://editor's settings
					//NOt bad Code -- needs to be moved to premium JS
					//NavControl('user/users?EID='+$("body").attr("class")+'+group_toolbar');
					NavControl('user/users?EID='+$("body").attr("class"));
				break;
				case "edit_site"://site settings - remove WYSIWYG_toolbar
					NavControl('site/site?SID='+param1+'+WYSIWYG_toolbar');
				break;
				case "site_dashboard":// site main dashboard
					NavControl('site/site_dashboard?SID='+param1+'+published?SID='+param1+'+drafts?SID'+param1);
				break;
				case "sitemap"://handles site pages
					NavControl('page/manage_pages?SID='+param1+'+actions?cpage=true:mpage=true:folder=true');
				break;
				case "close_app"://Needs to be seperate -- start at last folder -- similar to sitemap but closes app
					NavControl('page/manage_pages?SID='+param1+'+actions?cpage=true:mpage=true:folder=true');

					$('#frame_content').remove();//remove iframe
					$("#sidekick").dialog("close");
					AjaxCall('include/menu/menu', '#smoothmenu1', true);ddsmooth();//add new menu and init it
					$('#wrapper, #wrapper #header').show();//shoe hidden headers
				break;
				case "page"://init app
					Loading(true);//add overlay
					$('#content').html("");//clear canvas
					AjaxCall('include/menu/menu?status=page&PID='+param1, '#smoothmenu1', true, false);//add app menu
					AjaxCall('include/ftp/page?PID='+param1, 'N/A', false, false);//FTP to server and get pages/dependents
					ddsmooth();//init app menu
					$('#header').slideUp(1000, function () {//hide header
						$('#smoothmenu_container').after('<iframe id="frame_content" class="'+param2+'"width="100%" frameborder="0" scrolling="no" src="include/ftp/source?PID='+param1+'"></iframe>').siblings('#wrapper').hide();//add iframe to DOM
						$("#sidekick").dialog("open").parent().css({position:"fixed", left: function(index, value) { return parseFloat(value) - 75;}}).disableSelection();//init sidekick
						$('#FTPManager').fadeIn("slow");
					});
					
				break;
				case "jump_folder"://Page Navigating
					NavControl('page/manage_pages?SID='+param1+':path='+param2+':dir='+param3+'+actions?cpage=true:mpage=true:folder=true');
				break;
				case "edit_page"://Page Settings
					NavControl('page/pages?PID='+param1);
				break;
				case "activate"://Activate Feature Page
					NavControl('site/activate?SID='+param1);
				break;
				case "dashboard"://Main Landing page and default page
				default:
					NavControl('dashboard+sites+help');
				break;
				case "templates"://template page
					NavControl('site/template/templates?SID='+param1);
				break;
			}
        } else {
        	NavControl('dashboard+sites+help');//dashboard and default
		}
		
	});
}
function Menu_Nav() {// HAndles the init of main menu and functionality
	Timer();//init Timer

	$("#smoothmenu1").hover(function () {
		clearTimeout(t);//timer for opactiry is inactive
		$("#smoothmenu1, #smoothmenu1 a").stop().animate({'opacity':'1.0'}, 'slow');
	}, function () {
		Timer();//reactivate timer
	  	$(window).scroll(function () {//on scroll fade menu
			if (dscroll!=0) {
				$('#smoothmenu1 , #smoothmenu1 a').stop().animate({'opacity':'0.4'}, 'slow');
			}
			dscroll++;
		});
    });
	$("#menu_arrow").live({
		click:function() {
			if ($(this).hasClass("ui-icon-circle-triangle-s")) {
				$(this).toggleClass("ui-icon-circle-triangle-s ui-icon-circle-triangle-e").css({"margin":"0 0 0 15px"}).siblings("ul").hide().parent().animate({"height": "16px"}, {duration: "slow" });
			}else if($(this).hasClass("ui-icon-circle-triangle-e")) {
				$(this).toggleClass("ui-icon-circle-triangle-e ui-icon-circle-triangle-s").css({"margin":""}).siblings("ul").show().parent().animate({"height": $(".menu_standard li:first").height()}, {duration: "slow" });
			}
		},
		mouseover: function() {//hover state
			if ($(this).hasClass("ui-icon-triangle-1-s")) {
				$(this).toggleClass("ui-icon-triangle-1-s ui-icon-circle-triangle-s");
			}else if($(this).hasClass("ui-icon-triangle-1-e")) {
				$(this).toggleClass("ui-icon-triangle-1-e ui-icon-circle-triangle-e");
			}
  		},
		mouseout: function() {
			if ($(this).hasClass("ui-icon-circle-triangle-s")) {
				$(this).toggleClass("ui-icon-circle-triangle-s ui-icon-triangle-1-s");
			}else if($(this).hasClass("ui-icon-circle-triangle-e")) {
				$(this).toggleClass("ui-icon-circle-triangle-e ui-icon-triangle-1-e");
			}
		}
	});
}
function Functions() {//Houses all click functions and other functions, used for organization
	$(document).delegate('.assets', 'click', function() {//Asset manager
		var SID = $("#content").find('.push-cymbit').attr('id');
		$('body').prepend('<div id="dialog" style="display:none;width:90%;height:90%;min-height:600px;width:'+($(document).width()-200)+'px;overflow-x: hidden;overflow-y: hidden;padding:.5em 0px;" title="Asset Mannger"><div id="ModalWindow"></div></div>');//insert div to activate dialog window
		AjaxCall('include/dialog/assets?SID='+SID, '#ModalWindow');//Get content
		$.ajax('include/dialog/include/dir?SID='+SID, {// get starting directory
			async: false,
			type: 'GET',
  			success: function(data) {
				$('#manager').fileTree({ root: $("#manager").attr("rel"), script: 'include/dialog/regpage?type=img&SID='+SID, multiFolder: false, getFolder: true}, function(file) { //once connection has been established 
					
					if (file !== null) {
						var img = file.substr(0, file.length-1).split(',');//array of files returned 
						var len=img.length;
						$("#assets").empty();//clear empty images
						for(var i=0; i<len; i++) {//go throughall files
							$("#assets").append('<div id="digitalimg_'+i+'"class="asset_img_cont"><img class="asset_img" src="'+jQuery.trim($(".breadCrumb").find("li:last").text())+img[i]+'" style="display:none;" /></div>');//Add images to DOM to choose from 
						}
						
					}
				});
				$("#assest_manager, #asset_body").height(function() { return ($("#ModalWindow").parent('#dialog').height() -5);});//custom fit dialog to size of window screen
				
			}
		});
		return false;
	});
	$(document).delegate('.doc_assets', 'click', function() {//Almost same exact code from asset manager --- This is the document manager
		var SID = $("#content").find('.push-cymbit').attr('id');
		$('body').prepend('<div id="dialog" style="display:none;width:90%;height:90%;min-height:600px;width:'+($(document).width()-200)+'px;overflow-x: hidden;overflow-y: hidden;padding:.5em 0px;" title="Document Asset Mannger"><div id="Doc_ModalWindow"></div></div>');//.css("overflow", "hidden");
		AjaxCall('include/dialog/doc_assets?SID='+SID, '#Doc_ModalWindow')
		$.ajax('include/dialog/include/dir?SID='+SID, {
			async: false,
			type: 'GET',
  			success: function(data) {
				$('#manager').fileTree({ root: $("#manager").attr("rel"), script: 'include/dialog/regpage?type=doc&SID='+SID, multiFolder: false, getFolder: true}, function(file) { 
					
					if (file !== null) {
						var img = file.substr(0, file.length-1).split(','); 
						var len=img.length;
						$("#assets").empty();
						for(var i=0; i<len; i++) {
							$("#assets").append('<div id="digitalimg_'+i+'"class="asset_img_cont"><img class="asset_doc" src="http://cymbit.com/site/css/images/documents/text-plain.png" style="display:none;margin:0 auto;" /><div id="doc_title" style="width: 300px;padding-left:5px;" title="'+img[i].substr(1)+'"><b>'+img[i].substr(1)+'</b></div></div>'); 
						}
						
					}
				});
				$("#assest_manager, #asset_body").height(function() { return ($("#Doc_ModalWindow").parent('#dialog').height() -5);});
				
			}
		});
		return false;
	});
	$(document).delegate('.disabled-link', 'click', function() {
		//Do Nothing
		return false;
	});
	$(document).delegate('.Site_Enable', 'click', function() {//Enable or disable site
		var is_enabled = $(this).children('span:last').text();var tdname = $(this).parent('td').siblings('.tdname').children('a');var tdurl = $(this).parent('td').siblings('.tdurl').children('span');var tdedit = $(this).parent('td').siblings('.tdedit').children('a');
		if((is_enabled == 'enabled')) {//to disable site
			$(tdname).addClass('disabled-link').removeClass('site_dashboard');
			$(tdurl).addClass('disabled-text');
			$(tdedit).hide();
		}else{
			$(tdname).removeClass('disabled-link').addClass('site_dashboard');
			$(tdurl).removeClass('disabled-text');
			$(tdedit).show();
		}
		$(this).html((is_enabled == 'enabled') ? '<span class="status-red cmsicon"></span><span>disabled</span>' : '<span class="status-green cmsicon"></span><span>enabled</span>');//add a red or green icon
		AjaxCall('include/functions/enable?SID='+ $(this).parents('.push-cymbit').attr('id') +'&type='+$(this).children('span:last').text(), 'N/A', false, false, 'POST');//save info
		return false;
	});
	$(document).delegate('.delete_site', 'click', function() {//confirmation to delete site
		$('body').prepend('<div id="dialog-confirm" style="display:none;width:400px;" title="Are you sure?"><br /><span id="delete_site" class="' +$(this).parents('.push-cymbit').attr('id') +'"><p>Are you sure you want to delete this site?</p><p><strong>*Note</strong>: Your entire site will still exist on your server.</p></span></div>');
		return false;
	});
	$(document).delegate('.delete_user', 'click', function() {//confirmation to delete user
		$('body').prepend('<div id="dialog-confirm" style="display:none;width:400px;" title="Are you sure?"><br /><span id="delete_user" class="' +$(this).parents('.push-cymbit').attr('id') +'"><p>Are you sure you want to delete this user?</p></span></div>');
		return false;
	});
	$(document).delegate('.delete_page', 'click', function() {//confirmation to delete page
		$('body').prepend('<div id="dialog-confirm" style="display:none;width:400px;" title="Are you sure?"><br /><span id="delete_page" class="' +$(this).parents('.push-cymbit').attr('id')+'"><p>Are you sure you want to delete this page?</p><p><strong>*Note</strong>: Your page will still exist on your server.</p></span></div>');
		return false;
	});
	$(document).delegate('#changepass', 'click', function() {//button to display textbox to show password or change it
		$(this).parent('div').hide().siblings('div').show();
	});
	$(document).delegate('.test-ftp', 'click', function() {//Tests out if FTP is OK
		$('.test-ftp').after('<img id="ajax-loading" src="../css/images/indicator.gif" class="ftp-alert" />');$('#ftp-msg').html("");
		AjaxCall('include/functions/testftp?address='+$('#address').val()+'&user='+$('#user').val()+'&password='+$('#password').val()+'&port='+$("#Port").val()+"&SFTP="+$("#SFTP").is(':checked'), '#ftp-msg', true, true);
		return false;
	});
	$(document).delegate('.browse-site', 'click', function() {//Activate file browser to view site files
		$('body').prepend('<div id="dialog" style="display:none;width:400px;height:600px;overflow-x:hidden;" title="FTP Browser"><span id="browsesite"><div id="fileTree"></div></span></div>');
		var server = $('#address').val();var user = $('#user').val();var pass = $('#password').val();var dir = $('#path').val();//From Form
		$('#fileTree').fileTree({ root: '/', script: 'include/jqueryFileTree?server='+server+'&user='+user+'&pass='+pass+'&path='+path }, function(file) { 
			$('#path').val(file);//selected file
			$('#dialog').dialog("close");
		});
		return false;
	});
	$(document).delegate('.WClose', 'click', function() {//close button for dialog
		$('#ModalWindow').fadeOut(1000, function() {
			$('#ModalWindow').remove();
			$("body").css("overflow", "");
		});
		return false;
	});
	$('.validaterror, .jQTabs li a, a').livequery(function() {//Possibly use delegate or live or on
		$(this).click(function() {
			$('form').validationEngine('hide');// if click on tabs close current tabs validation
		});
	});
	$(document).delegate('.save_user', 'click', function() {//POST is required for validation --- Save User
		$('form#user').submit();	
		return false;
	});
	$("form#user").livequery(function() {//Add validation for save user
		$(this).validationEngine({ajaxFormValidation: true, onAjaxFormComplete: UserCallBack})
	});
	function UserCallBack(status, form, json, options) {//Callback for save user
			if (status === true && Validate() === true) {//if validation passes
			var type = $('.gritter-loc').attr('id');
			AjaxCall('include/functions/save/user?EID='+$('#EID').val()+'&'+$("#user").serialize(), 'N/A', false, false, "POST");
			//getScript('js/archive/jquery.translate-1.3.9.js');//function
			//loadResources('js/archive/jquery.translate-1.3.9.js', 'translate', function() {
			AjaxCall('include/menu/menu', '#smoothmenu1', true);ddsmooth();//re-init menu if name changes
			if($('#EID').val() == $('body').attr("class")) {
				user_language = $("#language").val();//get translation code if changes
			}
			History("manage_userbtn", "");//go back to main page
			if (type == "edit") {
				$.GritControl({'id':'KIybYHbLt2B'});
			} else if(type== "add") {
				$.GritControl({'id':'iBK7mPsnYFI'});
			}
			}
		}

	$(document).delegate('.save_site', 'click', function() {//POST is required for save site
		$('form#site').submit();	
		return false;
	});
	$(document).delegate('.mng-pagebtn', 'click', function() {
        var SID = $("#content").find('.push-cymbit').attr('id').split('_')[0];
	    $.ajax('include/dialog/include/dir?SID='+SID, {
        async: false,
        type: 'GET',
        success: function(data) {
            $('body').prepend('<div id="dialog-confirm" style="display:none;width:400px;overflow-x:hidden;" title="Add Files to Site Map"><br /><span id="regpage" class=""></span><div id="fileTree" rel="'+data+'" style="height:400px!important;overflow-y: auto!important;"></div></div>');
        $('#fileTree').fileTree({ root: $("#fileTree").attr("rel"), script: 'include/dialog/regpage?type=file&SID='+SID, selected: true}, function(file) { /*do nothing*/});
        }
        });
        return false;
    });

	$("form#site").livequery(function() {//Add validation for Add site
		$(this).validationEngine({ajaxFormValidation: true, onAjaxFormComplete: SiteCallBack})
	});
	function SiteCallBack(status, form, json, options) {//Add site callback
		if (status === true && Validate() === true) {//if validdation passes
			var type = $('.gritter-loc').attr('id');//based on gritter id on DOM show Grit
			if (type == "edit") {
				$.GritControl({'id':'bnyu2zgjzKx'});
			} else if(type== "new") {
				$.GritControl({'id':'Ym85qbNIvIq'});
			}
			var toolbar1="";
			$("#toolbar1 li").each(function(index) {//get all toolbar buttons -- no longer used
				if ($(this).attr("title")) {
					toolbar1 = toolbar1 + ", " + $(this).attr("title");
				}
			});
			AjaxCall('include/functions/save/site?SID='+$('#SID').val()+'&'+$("#site").serialize()+'&toolbar1='+toolbar1.substr(2), 'N/A', false, false, "POST");
			History("manage_sitebtn", "");//Go back to main page
		}
	}
	
	$(document).delegate('.save_page', 'click', function() {//save page -- doesn't have callback but may in the future
		if (Validate()) {//if validation passes
			var SID = $('#content .push-cymbit').attr("id").split('_')[0];//grab from DOM
			var PID = $('#content .push-cymbit').attr("id").split('_')[1];
			var dir = $('#content .push-cymbit').attr("id").split('_')[2];
			AjaxCall('include/functions/save/page?PID='+PID+'&'+$("#pages").serialize(), 'N/A', false, false, "POST");
			if (dir != 0) {//this doesn't work, should go back to dir of page just edited
				NavControl('page/manage_pages?SID='+SID+':PID='+PID+':dir='+dir+'+actions?cpage=true:folder=true');
			}else{
				NavControl('page/manage_pages?SID='+SID+':dir='+dir+'+actions?cpage=true:folder=true');
			}
			$.GritControl({'id':'CKkhWiwaTYB'});
		}
		return false;
	});
	
	$(document).delegate('.form-item .help', 'click', function() {//helper gritter
		$.GritControl({'id':$(this).attr('id'), 'top':false});
		return false;
	});
	$(document).delegate('.nothing', 'click', function() {//does nothing
		return false;
	});
	$(document).delegate('.logout', 'click', function() {//logout button
		AjaxCall('include/functions/logout', 'N/A', false);
		window.location = "http://cymbit.com/Login";
		return false;
	});
	$(document).delegate('.impersonate_user', 'click', function() {//impersonate user
		AjaxCall('include/functions/impersonate?EID='+$(this).parents('.push-cymbit').attr('id'), 'N/A', false, false, 'POST');
		AjaxCall('include/menu/menu', '#smoothmenu1', true);ddsmooth();
		manage_user();
		$("#smoothmenu_container").after('<div class="impersonate_warning">You are currently in impersonate mode, <A href="#" class="impersonate_reset">click here to return to your original account.</A></div>'); //add warning bar
		$.GritControl({'id':'UtVkB6h1f06'});
		return false;
	});
	$(document).delegate('.impersonate_reset', 'click', function() {//Reset impersonate user
		AjaxCall('include/functions/impersonate?Type=reset', 'N/A', false, false, 'POST');
		AjaxCall('include/menu/menu', '#smoothmenu1', true);ddsmooth();
		manage_user();
		$(".impersonate_warning").remove(); 
		return false;
	});
	$(document).delegate('.coming_soon', 'click', function() {//Coming soon Grit
		$.GritControl({'id':'KmanQto2h5Z'});
		return false;
	});
	$(document).delegate('.add-pagebtn', 'click', function() {//Create new page dialog
		$('body').prepend('<div id="dialog-confirm" style="display:none;width:560px;" title="Create New Page"><br /><span id="new_page" class=""></span></div>');
		AjaxCall('include/dialog/newpage', '#new_page');
		return false;
	});
	$(document).delegate('.add-folderbtn', 'click', function() {//create new folder window
		$('body').prepend('<div id="dialog-confirm" style="display:none;width:400px;" title="Create New Folder"><br /><span id="new_folder" class=""></span></div>');
		AjaxCall('include/dialog/newfolder', '#new_folder');
		return false;
	});
	$(document).delegate('.live_view', 'click', function() {//App -- view live view
		window.open($(this).attr('href'));
		return false;
	});
	
	$(document).delegate('.page_folder', 'click', function() {//When user clicks a Folder dom on page manager
		
		var nav_class = $(this).parents('.push-cymbit').attr('id');
		if(typeof nav_class != 'undefined') {
			nav_class += "_";
			classes = nav_class.split("_");
		}
		
		History("jump_folder", "@"+classes[0]+"@"+encodeURIComponent($(this).children("p").text())+"@"+classes[1]);
		return false;
	});
	$(document).delegate('.page_crumb', 'click', function() {
		var path = encodeURIComponent($(this).attr('rel'));
		var nav_class = $(this).parents('.push-cymbit').attr('id');
		if(typeof nav_class != 'undefined') {
			nav_class += "_";
			classes = nav_class.split("_");
		}
		
		History("jump_folder", "@"+classes[0]+"@"+path+"@"+path.split("_").length);
		return false;
	});
}

function AjaxCall(url, loc, update, async, type, val) {//handles AJaxCalls, needs to be converted to a plugin and redone
	if (update == undefined)update=true;//horribly done
	if (async == undefined)async=false;
	if (type == undefined)type= "GET";
	
	var paramloc = url.search("\\?");//get params
	if (paramloc > 0) {
		var param = url.substr(paramloc+1);
		url = url.substr(0, paramloc);
	}
	
	if (update ==  true) {
		//$(loc).fadeOut("slow");
	}
	$.ajax(url, {
		async: async,
		type: type,
		data: param,
		success: function(data) {
    		if (update == true) {
				$(loc).html(data);
				Translate($(loc));//should translate any incoming pages, doesn't work very well
			}else if (val == true) {
				$(loc).attr("rel",data);
			}
			if ($('#ajax-loading').exists()) {$('#ajax-loading').remove();}//Not sure if needed
			//if ($('#overlay-loading').is(':visible')) {Loading(false);}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
        	window.location = "http://cymbit.com/site";
        }
	});
	return false;
}
function NavControl(url, type) {//handles all of the Ajaxcalls for page navigation
	if (type == undefined)type= "GET";
	if (url.search("\\+") > 0) {
		url = url.replace(/\+/g, "%2B").replace(/\=/g, "%3D").replace(/\?/g, "%3F");
	}
	url = "?page="+url;//build params
	var paramloc = url.search("\\?");
	if (paramloc > 0) {
		var param = url.substr(paramloc+1);
		url = url.substr(0, paramloc);
	}
	Loading(true);
	$('#main_container').fadeOut("slow", function () {
	$.ajax(url, {
		type: type,
		data: param,
		ifModified: true,
		success: function(data, status, jqXHR) {
			if (data.substring(data.length-7) !== "refresh") {
				$('#main_container').html(data)
				$('title').html("Cymbit CMS &raquo; " + $('#content:first').find('h3.underline').text());
				Translate($('#main_container'));
				$('#main_container').fadeIn("slow", function() {Loading(false);});
			}else{
				window.location = "http://cymbit.com/site";
			}
		}
	});
	});
}

/*
function Percent2PX(val, type) {
    var dim;
	if (type == "width") {
		dim = $(window).width();
	}else if(type == "height") {
		dim = $(window).height();
	}
	val = (val/100)*(dim);
	return val;
}*/
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

function Validate() {//returns false if validation fails
	var error = true;var tab;
	$('#content .jQTabs ul.ui-tabs-nav li').each(function(index) {//go through all tabs
		$(this).children('a').trigger('click');
		tab = $(this).parents('div');
		if (!(tab.children('#tabs-'+(index+1)).validationEngine('validate'))) {
			$('#content a').not('.button, li a').addClass('validaterror');
			error = false;
			return false;
		}
	});
	return error;
}

function History(el, param) {
		el = el + param;
		var loc = $.rc4EncryptStr(el.replace(/^.*#/, ''), '');
		$('form').validationEngine('hideAll');
		$.history.load(loc);
		return false;
	}
function iFrame_size(el) {
	el.height(el.contents().find("html").height());
}
function manage_user() {
	NavControl('user/manage_users');
}
function Translate(el) { 
	if (typeof user_language != 'undefined'){
		if (user_language !== "en") {
			$(el).translate('en', user_language, {fromOriginal:true, not: 'input, select'});
		}
	}
	return false;
}
function Loading(action) {
	if (action == true) {
		if (!$("#jq-mask-nav").exists()){
			$('body').prepend('<div id="jq-mask-nav" class="ui-widget-overlay" style="z-index:9999;display:none;"></div><div id="overlay-loading"style="z-index: 10000;position:absolute;display:none;"><img src="../images/70.gif" /><div style="font-size:32px;font-weight:bolder;padding: 20px 0 0 15px;color:#382D2C;">Loading...</div></div>');
		}
		$('#jq-mask-nav, #overlay-loading').fadeIn("fast");
		$('#jq-mask-nav').height($(document).height()).width($(document).width()).next('div').css({'top':function() { return ($(window).height() - $(this).outerHeight())/2; }, "left": function() {return ($(window).width() - $(this).outerWidth())/2;}});	
	}else if (action == false) {
		$('#jq-mask-nav, #overlay-loading').fadeOut("fast");
	}
	return false;
}
function ddsmooth() {
ddsmoothmenu.init({
	mainmenuid: "smoothmenu1", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
});
$("#smoothmenu1").height(function() {return $(".menu_standard li:first").height();}).disableSelection();
}
function Timer() {
	t=setTimeout(function() {$('#smoothmenu1').stop().animate({'opacity':'0.4'}, 'slow')}, 10000);
}
(function ($) {
    $.extend({
        GritControl: function (options) {
            var settings = $.extend( {
      			'id' : '',
      			'top' : true
    		}, options);
			//$.extend(jsonapp, json_grit);//Merge
			$.each(json_grit, function(k, v) {
			if (v.item.GritID === settings.id) {
				$.gritter.add({
					title: v.item.Title,
					text: v.item.Text,
					image: 'css/images/notify/'+v.item.Icon+'.png',
					sticky: false,
					before_open: function() {$('#gritter-notice-wrapper').css('top', 40);},
					after_open: function(e){if (settings.top == true){$.scrollTo(0, 300, false);}}
				});
			Translate($('#gritter-notice-wrapper'));
			}
		});
       }
    });
})(jQuery);



	var content_loaded = new Array(); var content_loading = 0;var content_started = false;
	function loadResources(res, type, callback) {
		if (!content_started) {
        	content_started = true;
        	if (jQuery.inArray(type, content_loaded) == -1) {
		content_loaded[content_loaded.length] = type;
	
			startLoadingResources(res);
			}
    	}
    	if (content_loading == 0) {
        	content_started = false;
		if (typeof (callback) == "function") callback();
    	} else {
        	window.setTimeout(function () { loadResources(res, type, callback) }, 50);
    	}
	}
function startLoadingResources(res) {
	var basePath="http://cymbit.com/";
    var resArr = res.split(';');
    for (i = 0; i < resArr.length; i++) {
		extension = resArr[i].split('.')[resArr[i].split('.').length-1]
        var resi = resArr[i].replace("~/", basePath);
        if (extension == "css") {
            document.createStyleSheet ? document.createStyleSheet(resi) : jQuery("head").append(jQuery("<link rel='stylesheet' href='" + resi + "' type='text/css' />"));
        } else if (extension == "js") {
            content_loading++;
            jQuery.getScript(resi, function () { content_loading--; });
        }
    }
}
function iFrame(id, type, content) {
	var ifrm = document.getElementById(id);
	//ifrm = (ifrm.contentWindow) ? ifrm.contentWindow : (ifrm.contentDocument.document) ? ifrm.contentDocument.document : ifrm.contentDocument;
	ifrm = ifrm.contentDocument;
	var serializer = new XMLSerializer();
	var ifrm_content = serializer.serializeToString(ifrm);
	if (type == 'get')  {
		alert('get');
		return ifrm_content;
	}else if (type == 'set') {
   		alert('set');
		ifrm.open();
		ifrm.write($.htmlClean(content, { format: true }));
		ifrm.close();
		return false;
	}else{
		alert('error');
	}
}
jQuery.fn.exists = function(){return jQuery(this).length>0;}

    $.fn.extend({
        center: function () {
            return this.each(function() {
                var top = ($(window).height() - $(this).outerHeight()) / 2;
                var left = ($(window).width() - $(this).outerWidth()) / 2;
                $(this).css({top: (top > 0 ? top : 0)+'px', left: (left > 0 ? left : 0)+'px'});
            });
        }
    });
