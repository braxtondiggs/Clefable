/****************************************************/
/*Application JS - handles all of the basic applicationand WYSIWYG functions
*Note: All live and delegate methods need to be changed to use ON and/or OFF
/****************************************************/
var el_ck = 0;var el_img = 0;var SID;var iframe;var PID;var iframe_html;var keyword;var WISWIG_elem;var iframe_cms;var count_find = 0;
var jsonapp = (function () {//handles the import of all application JSON and stores themas a JS Object
    var jsonapp = null;
    $.ajax({
        'async': false,
        'global': false,
        'url': 'json/gritter/application-basic',
        'dataType': "json",
        'success': function (data) {
            jsonapp = data;
        }
    });
    return jsonapp;
})();
$(function() {

$("#frame_content").livequery(function() {// handles iframe and content
	$(this).load(function() {
	
		SID = $(this).attr("class");//SID is embedded in class
		iframe = $(this).contents();
		var iframe_src = $("#frame_content").attr("src");
		PID = iframe_src.substr((iframe_src.indexOf("PID=")+4), 7);//Grab PID
		iframe_html = iframe.find("html");
		$("#smoothmenu_container #cms_keyword").livequery(function() {//Grab keyword, from app menu
		keyword = "."+$(this).attr('title');//Needs to be before Rerun
	});
		if (iframe.find("style:contains('AdBlock')").exists()) {
			var AdBlock = iframe_html.clone(true);//AdBlock adds addtitional style tags
			iframe.find("style:contains('AdBlock')").remove();
			$.GritControl({'id':'PH1EM2bgOoi'});//Global function, controls Gritter plugin
			$(".adblock_revert").live('click', function() {//if user decides to revert ADBlock
				//iframe_html.html(iframe_html.html());
				Rerun();
				$.GritControl({'id':'V87dMEgHPN6'});
				return false;
			});
		}
		Rerun();
	});
});
	$("#dialog-confirm-app").livequery(function() {//Dialog with OK & cancel button
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
				if (y < 40) {//makes sure dialog doesn't go outside of windoew screen
					$(this).parents('.ui-dialog').css({'top':'40px'});
				}
				$(document).delegate('.ui-widget-overlay', 'click', function() {// close dialog if overlay is closed
					$("#dialog-confirm").dialog("close");
				});
			},
			beforeClose: function(event, ui) {
				$(this).fadeOut(1000, function() {$(this).remove();});
			},
			buttons: {
				"Ok": function() {
					var no_close = false;
					var hash = window.location.hash.substr(1);
					var param1 = $.rc4DecryptStr(hash, '').split('@')[1];//Pick the url hash and decode it and store them in a var
					var param2 = $.rc4DecryptStr(hash, '').split('@')[2];
					var param3 = $.rc4DecryptStr(hash, '').split('@')[3];
					switch($(this).children('span').attr('id')) {//based of the dialog span
						case 'page_properties'://Page Properties
							var title = $('#pages_prop_form #title').val();
							if (title != iframe.find("title").text()) {//only if something Changes 
								iframe.find("title").text(title);
								AjaxCall('include/functions/save/page?type=title&PID='+param1+'&'+$('#pages_prop_form').serialize(), 'N/A',  false, false, "POST");
								$.GritControl({'id':'CKkhWiwaTYB'});
							}
						break;
						case 'delete_page'://Delete Current Page
							History("close_app", "@"+SID);//Close App
							AjaxCall('include/functions/delete?PID='+param1, 'N/A',  false, false, "POST");
							$.GritControl({'id':'Us9S0v87yok'});
						break
						default:
							alert('Not Set');//Needs to change
						break;
					}
					if (no_close == false) {//Fro validation, don't allow close if false
						$(this).dialog("close");
					}
				},
				Cancel: function() {
					$(this).dialog("close");
				}
			}
		});
	});
	$("#save-dialog").livequery(function() {//Dialog for save and cancel button
		$.fx.speeds._default = 1000;
		$(this).dialog({
			resizable: false,
			modal: true,
			title: $(this).attr('title'),
			width: $(this).width(),
			height: $(this).height(),
			draggable: false,
			show: "fade",
			hide: "fade",
			autoOpen: false,//require open, will not open automatically
			buttons: [{
				text: "Save",
				click: function() {
					switch($(this).children('span').attr('id')) {
						case "source-modal"://Source Code
							iFrame('frame_content', 'set', source_editor.getValue());//Global.JS Function
							$("#frame_content").contentWindow.location.reload();//Doesn't work correctly
							Rerun();//if anything changes inside iframe, reinitialize iframe
							//you are going to have to refresh page or push html to DB then update src
						break
						default:
						alert('error');
						break;
					}
					$(this).dialog("close");
				}},{
				text: "Cancel",
				click: function() {
					$(this).dialog("close");
				}
			}],
			open: function() {
				$(document).delegate('.ui-widget-overlay', 'click', function() {
					$(this).dialog("close");
				});
			}
		});
	});
	
	function Rerun() {//Function rewraps elemnts w/e the iframe content changes
		iFrame_size($("#frame_content"));//Plugin to force iframe height
		iframe_cms = iframe.find(keyword);//Find all elements with keyword class

		$("#cymbitcms").html("");
		var wrapper = new Array();var frame_elem = new Array();var i =0;
		iframe_cms.each(function(index) {//Go through all elements with matching keyword
			$("#cymbitcms").append('<div class="cymbitcms-wrapper"><div class="cymbitcms-wrapper-top" style="top:'+(($(this).position().top - iframe_html.height())-10)+'px;left:'+$(this).offset().left+'px;width:'+$(this).width()+'px;"></div><div class="cymbitcms-wrapper-right" style="top:'+(($(this).position().top - iframe_html.height())-10)+'px;left:'+(($(this).offset().left +$(this).width())-10)+'px;height:'+($(this).height()+20)+'px;"></div><div class="cymbitcms-wrapper-bottom" style="top:'+(($(this).position().top + $(this).height()) - iframe_html.height())+'px;left:'+$(this).offset().left+'px;width:'+$(this).width()+'px;"></div><div class="cymbitcms-wrapper-left" style="top:'+(($(this).position().top - iframe_html.height())-10)+'px;left:'+($(this).offset().left-10)+'px;height:'+($(this).height()+20)+'px;"></div></div>');//Wrapper, all of this code might noy be needed. very ugly
			frame_elem[i] = $(this);
			wrapper[i] = $(".cymbitcms-wrapper:eq("+i+")");//store element for loc function
			i++;		
		});

	function loc(this_elem) {//function used to identify elements index in iframe
		var len=frame_elem.length;
		var el ="";
		for(var i=0; i<len; i++) {
			el = frame_elem[i];
			if ($(this_elem)[0] == el[0]){
				return(i);
			}
		}
	}

	
	iframe_cms.bind({//element with matching keyword
		mouseenter: function() {
			var j = loc($(this));//identify elements index
			wrapper[j].css({'display':'block'});//show wrapper
			$(this).bind({
				dblclick: function() { 
					wrapper[j].css({'border-color':'#CC0'}).addClass("selected");//making wrapper yellow
					editable($(this));//content is now editable
				},
				mousedown: function(event) {
					switch (event.which) {//capture all mouse click events
        				case 1:
						case 2:
						case 3:
						default:
							elem = $(this);
							$('#cymbitcms > .cymbitcms-wrapper').each(function(index) {//Deselected all but the wrapper selected
								if (j != index) {
									$(this).removeClass("cymbitcms-selected").css({'display':'none'}).children('.cymbitcms-wrapper-top, .cymbitcms-wrapper-right, .cymbitcms-wrapper-bottom, .cymbitcms-wrapper-left').css({'border-color':''});//hide all
								}
							});
							$(':not('+keyword+')').live("click", function(e) {//doesn't work, if click something but keyword element, hide all
								$('.cymbitcms-selected').removeClass("cymbitcms-selected").css({'display':'none'}).children('.cymbitcms-wrapper-top, .cymbitcms-wrapper-right, .cymbitcms-wrapper-bottom, .cymbitcms-wrapper-left').css({'border-color':''});
							});
							wrapper[j].addClass("cymbitcms-selected").children('.cymbitcms-wrapper-top, .cymbitcms-wrapper-right, .cymbitcms-wrapper-bottom, .cymbitcms-wrapper-left').css({'border-color':'#CC0', 'display':'block'}).show();//wrapper selected
							$(this).bind("contextmenu",function(e){//right click menu
								$('#cymbitcms-contextmenu').css({'position':'absolute', 'top': (e.pageY+20),'left': (e.pageX+5)}).hide();$('#cymbitcms-contextmenu').show();//initalize
								$(document).one('click', function() {$('#cymbitcms-contextmenu').hide();});
								return false;
							});
						break;
					}
				}
			});
		}, mouseleave:function(){
			if (!wrapper[loc($(this))].hasClass('cymbitcms-selected')) {
					wrapper[loc($(this))].css({'display':'none'});//not sure if working
			}
			
		}
	});
	}
	var clone, cut, is_cut, is_clone;
	$(".medit, .medit span").die().live('click', function() {//edit button, die is needed for close then reopen. kills live
		editable(elem);
		return false;
	});
	$(".mcut, .mcut span").die().live('click', function() {
		if((typeof elem != 'undefined') && $("#cymbitcms").children().hasClass("cymbitcms-selected")) {
			cut = elem;
			is_cut = true;is_clone=false;
			$.GritControl({'id':'QzorvGepRMb'});
		}else{
			$.GritControl({'id':'NW53Jua4TzQ'});//error
		}
		return false;
	});
	$(".mcopy, .mcopy span").die().live('click', function() {//copy button
		if((typeof elem != 'undefined') && $("#cymbitcms").children().hasClass("cymbitcms-selected")) {
			clone = elem.clone();is_cut = false;is_clone=true;
			$.GritControl({'id':'hP7aEgQZSAR'});
		}else{
			$.GritControl({'id':'NW53Jua4TzQ'});
		}
		return false;
	});
	$(".paste-mbefore, .paste-mbefore span").die().live('click', function() {//paste before button
		$(this).parents('ul:first').hide();//hide context menu
		if (is_clone) {//copy
			elem.before(clone);
			Rerun();clone.hide().fadeIn(2000);
		}else{
			if (is_cut) {//cut
				elem.before(cut);Rerun();cut.hide().fadeIn(2000);
			}else{	
				$.GritControl({'id':'QR76zl561oe'});//cut or copy fail
			}
		}
		delete elem;is_cut=false;is_clone=false;//reset vars
		return false;
	});
	$(".paste-mafter, .paste-mafter span, .mpaste, .mpaste span").die().live('click', function() {//paste and paste after button
		if ($(this).attr('class').indexOf("after") != -1) {//hide context menu
			$(this).parents('ul:first').hide();//sublevel of menu
		}else{
			$(this).siblings('ul').hide();
		}
		if (is_clone) {
			elem.after(clone);Rerun();clone.hide().fadeIn(2000);
		}else{
			if (is_cut) {
				elem.after(cut);Rerun();cut.hide().fadeIn(2000);
			}else{	
				$.GritControl({'id':'QR76zl561oe'});
			}
		}
		delete elem;is_cut=false;is_clone=false;
		return false;
	});
	$(".mdelete, .mdelete span").die().live('click', function() {//delete button
		if((typeof elem != 'undefined') && $("#cymbitcms").children().hasClass("cymbitcms-selected")) {
			elem.next('.cymbitcms-wrapper').remove().end().fadeOut(1500, function() {
				$(this).remove();Rerun();//delete element
			});
			$.GritControl({'id':'XNRtkb1QXfI'});
		}else{
			
		}
		return false;
	});
	$(".mopen").die().live('click', function() {//not finished, opens another file from app
		Loading(true);//Global.JS function, adds overlay
		$('body').prepend('<div id="dialog-confirm-app" style="display:none;width:400px;height:400px;" title="Open Page"><span id="open_page"></span></div>');//adding div with matching ID will open dialog
		('#open_page').fileTree({ root: $("#open_page").attr("rel"), script: 'include/dialog/app/openfile?SID='+SID, selected: true}, function(file) { /*do nothing*/});//Filetree initalize in dialog
		Loading(false);//close overlay
		return false;
	});
	
	$(".source_view").die().live('click', function() {//source code button
		Loading(true);
		if (!$("#save-dialog").exists()) {
			$('#modals').prepend('<div id="save-dialog" style="display:none;width:1000px;min-height:300px;height:'+($(window).height()-50)+'px;" title="Source Code"><span id="source-modal"></span></div>');}//initalize source code dialog
		loadResources("~/min/b=site/source/css&f=theme/default.css,codemirror.css;\
      ~/min/b=site&f=source/js/codemirror.js,source/js/xml.js,source/js/javascript.js,source/js/css.js,source/js/htmlmixed.js,source/js/beautify.js,source/js/beautify-html.js,js/jquery.htmlClean-min.js",'source',function(){$("#source-modal").html('<textarea id="code" name="code">'+style_html(iFrame('frame_content', 'get'), {'indent_size': 2,'max_char': 90})+"</textarea>");if (!$("#save-dialog").dialog("isOpen")) {$("#save-dialog").dialog("open");Loading(false);}});//Load resources fpr source code
		return false;
	});
	if (!$("#cymbitcms-contextmenu").exists()){//exist is a plugin, checks context menu
		$.ajax('include/menu/context', {//Pulls HTML for menu
		type: 'GET',
  		success: function(data) {
				$('body').append(data);
				ddsmoothmenu.init({mainmenuid: "cymbitcms-contextmenu", orientation: 'v', classname: 'ddsmoothmenu-v', /*customtheme: ["#1c5a80", "#18374a"], */ contentsource: "markup"});//plugin for menu, init the menu
		}
		});
		}

	function editable(content) {//handles all editable content
	if ((elem.get(0).tagName).toLowerCase() == "img") {//IMages
		if (el_img == 0) {//This code is obsolete needs to be re-written
			pixlr.settings.target = 'http://cymbit.com/site/js/pixlr/save.php?SID='+SID;
			pixlr.settings.exit = 'http://cymbit.com/site/js/pixlr/exit.php';
			pixlr.settings.credentials = true;
			pixlr.settings.method = 'GET';
			el_img = 1;
		}
			var url = "http://cymbit.com"+elem.attr("src");
			pixlr.overlay.show({image: url, title: url, service:'express'});//opens pixlr for image editing
		}
}

function CMS_History(change) {//Do not delete code is not finsihed yet
	//AjaxCall('include/functions/save?com=history&change='+change+'&HTML='+$("html").html(), 'N/A', false, false, 'POST', false);

}

});
function pixlr_image(UID, title, URL) {//May need to be deleted, used to refresh image from pixlr
	iframe.find('img[src="'+title+'"]').attr("src", URL);
}

/****************************************************/
/*Dead code that is no longer used, may be delete*/
/****************************************************/

/*function AdjustKick(type, top) {
	//var last_scroll = $(window).scrollTop();
	var last_scroll = 50; 
	switch(type) {
		case "scroll":
			if (scroll_count == 0) { 
				var new_top = (top-10) + (parseFloat($(window).scrollTop()) - last_scroll); 
				//if (new_top+$('.ui-dialog-sidekick').height())+":"+$(document).height());
				$('.ui-dialog-sidekick').stop().animate({'top': new_top}, 750);
				last_scroll = parseFloat($(window).scrollTop());scroll_count = 1;
			}	
		break;
		case "resize":
		break;
	}
}

$("#find-dialog").livequery(function() {
		$.fx.speeds._default = 1000;
		$(this).dialog({
			resizable: false,
			title: $(this).attr('title'),
			width: 500,
			show: "fade",
			hide: "fade"
		});
		
	}).disableSelection();

		/*$(window).scroll(function () {
		var t;
		scroll_count = 0;
		clearTimeout(t);
		t=setTimeout("AdjustKick(\"scroll\", "+parseFloat($('.ui-dialog-sidekick').css('top'))+")",1000);
	}).resize(function() {
		//var t;
		//clearTimeout(t);
		//t=setTimeout("AdjustKick(\"resize\")",1000);
	});

$(".msearch").die().live('click', function() {
		if (!$("#find-dialog").exists()) {
			$('#modals').prepend('<div id="find-dialog" style="display:none;" title="Find"><div id="find-content" class="left"><p>Find:<input id="find_input" name="find_input" type="text" class="text-rounded txt-l" style="margin-left:37px;" /></p><p>Replace:<input id="" name="" type="text" class="text-rounded txt-l" style="margin-left:10px;" /></p><br /><input id="" name="" type="checkbox" value="true"  />Match Case</div><div id="find-buttons" class="right"><a href="#" class="button save_site">Find Next</a><hr /><a href="#" class="button find_next" style="margin-bottom:10px;"></span>Replace</a><br /><a href="#" class="button save_site">Replace All</a><hr /><a href="#" class="button save_site">Cancel</a></div></div>');
			$("#find-buttons a").width(135);//.children('.cmsicon').css('float','right');
		}
		$("#find-dialog").html()
		
		return false;
	});

$('.sidekick_prop').click(function() {
		Loading(true);
		$('body').prepend('<div id="dialog-confirm-app" style="display:none;width:400px;height:400px;" title="Page Properties"><span id="page_properties"></span></div>');
		AjaxCall('include/dialog/app/page_properties?PID='+PID, '#page_properties');
		Loading(false);
		return false;
	});

$('.sidekick_delete').click(function() {
		$('body').prepend('<div id="dialog-confirm-app" style="display:none;width:400px;" title="Are you sure?"><br /><span id="delete_page" class="' +PID+'"><p>Are you sure you want to delete this page?</p><p><strong>*Note</strong>: Your page will still exist on your server.</p></span></div>');
		return false;
	});
$(document).delegate('.find_next', 'click', function() { 
		
		iframe.find('body > *:contains("No")').css('background-color', 'yellow');
		count_find++;
		return false;
	});

*/