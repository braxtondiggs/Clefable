$(function() {
    
    $('#frame_content').load(function() {
	var iframe = $(this);
	var iframe_contents = $(iframe).contents();
	var iframe_html = iframe_contents.find("html");
	$(iframe).height($(iframe_contents).height());
	var site_id = $(iframe).data('site-id');
	var page_path = $(iframe).data('path');
	var cms_keyword = $(iframe).data('keyword');
	//var account_id = $(iframe).data
	Rerun(iframe);
	ddsmoothmenu.init({mainmenuid: "cymbitcms-contextmenu", orientation: 'v', classname: 'ddsmoothmenu-v', /*customtheme: ["#1c5a80", "#18374a"], */ contentsource: "markup"});//plugin for menu, init the menu
	
    $('.mopen').bind('click', function() {
	var action = $(this);
	$('#dialog-confirm').children('#dialog-confirm-body').html('<div id="fileTree"></div>').find('#fileTree').height('500px');
	$('#dialog-confirm').dialog({ title: "Open File"}).dialog('open').dialog({buttons: {"Ok": function() {
			window.location = '../' + site_id + '/' + encodeURIComponent(base64_encode($('.jqueryFileTree .selected').attr('rel')));
                        $(this).dialog("close");
                    },
                    "Cancel": function() {
                        $(this).dialog("close");
                    }
		}
	    });
	    $('#fileTree').fileTree({ root: $(iframe).data('root'), script: $(action).attr('href'), server: 'local', selected: true}, function(file) {/*empty*/});
	return false;
	});
    $('.mpreview').bind('click', function() {
	var newWindow = window.open();
newWindow.document.write(iFrame('frame_content', 'get'));
newWindow.document.close();
	return false;
    });
    $('.mlive').bind('click', function() {
	window.open('../../source/' + site_id + '/' + page_path, '_blank');
	return false;
    });
    
    $('.msource').bind('click', function() {
	$('#dialog-confirm').css({'padding': 0}).children('#dialog-confirm-body').html('<div id="source_view"><form><textarea id="code" name="code">' + style_html(iFrame('frame_content', 'get'), {'indent_size': 2,'max_char': 90}) + '</textarea></form></div>').find('#source_view').height('500px');
$('#dialog-confirm').dialog({ title: "Edit Source", width:800}).dialog('open').dialog({buttons: {"Ok": function() {
			iFrame('frame_content', 'set', editor.getValue());
			
                        $(this).dialog("close");
                    },
                    "Cancel": function() {
                        $(this).dialog("close");
                    }
		}
	    });

	    var mixedMode = {
        name: "htmlmixed",
        scriptTypes: [{matches: /\/x-handlebars-template|\/x-mustache/i,
                       mode: null},
                      {matches: /(text|application)\/(x-)?vb(a|script)/i,
                       mode: "vbscript"}]
      };
      
      CodeMirror.on(window, "resize", function() {
      var showing = document.body.getElementsByClassName("CodeMirror-fullscreen")[0];
      if (!showing) return;
      showing.CodeMirror.getWrapperElement().style.height = winHeight() + "px";
    });
      var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
        mode: mixedMode,
	lineNumbers: true,
	lineWrapping: true,
	tabMode: "indent",
	autoCloseTags: true,
	extraKeys: {
        "F11": function(cm) {
          setFullScreen(cm, !isFullScreen(cm));
        },
        "Esc": function(cm) {
          if (isFullScreen(cm)) setFullScreen(cm, false);
        }
      }
      });
      return false;
    });
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
    function Rerun() {//Function rewraps elemnts w/e the iframe content changes
		cms_keyword= "."+cms_keyword;//iFrame_size($("#frame_content"));//Plugin to force iframe height
		iframe_cms = iframe_html.find(cms_keyword);//Find all elements with keyword class

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
		
		iframe_assets = iframe_html.find('img');
		//iframe_assets.each(function(index) {
		     //alert($(this).attr('src'));
		$(iframe_html).find('img').error(function() {
		    alert(1);
		});
		$(iframe_html).find('img').each(function(index) {
		    var http = jQuery.ajax({
			type:"HEAD",
			url: PathCheck($(this).attr('src')),
			async: false
		    });
		    if (http.status == 200) {
			
		    }
		});
		function PathCheck(path) {
		    var f_path = path.substring(0,1);
		    if(f_path === '.' || f_path === '/') {
			return '../CMS/';
		    }else {
			return path;
		    }
		}
		///*.load(function() { console.log("image loaded correctly");}).error(function() {
		     //alert($(this).attr('src'));
		    //alert($(this).html());
		//});*/
		//});
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
							$(':not('+cms_keyword+')').live("click", function(e) {//doesn't work, if click something but keyword element, hide all
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
    
    });
});
function base64_encode (data) {
  var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
  var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
    ac = 0,
    enc = "",
    tmp_arr = [];

  if (!data) {
    return data;
  }

  do { // pack three octets into four hexets
    o1 = data.charCodeAt(i++);
    o2 = data.charCodeAt(i++);
    o3 = data.charCodeAt(i++);

    bits = o1 << 16 | o2 << 8 | o3;

    h1 = bits >> 18 & 0x3f;
    h2 = bits >> 12 & 0x3f;
    h3 = bits >> 6 & 0x3f;
    h4 = bits & 0x3f;

    // use hexets to index into b64, and append result to encoded string
    tmp_arr[ac++] = b64.charAt(h1) + b64.charAt(h2) + b64.charAt(h3) + b64.charAt(h4);
  } while (i < data.length);

  enc = tmp_arr.join('');

  var r = data.length % 3;

  return (r ? enc.slice(0, r - 3) : enc) + '==='.slice(r || 3);

}

function isFullScreen(cm) {
      return /\bCodeMirror-fullscreen\b/.test(cm.getWrapperElement().className);
    }
    function winHeight() {
      return window.innerHeight || (document.documentElement || document.body).clientHeight;
    }
    function setFullScreen(cm, full) {
      var wrap = cm.getWrapperElement();
      if (full) {
        wrap.className += " CodeMirror-fullscreen";
        wrap.style.height = winHeight() + "px";
        document.documentElement.style.overflow = "hidden";
      } else {
        wrap.className = wrap.className.replace(" CodeMirror-fullscreen", "");
        wrap.style.height = "";
        document.documentElement.style.overflow = "";
      }
      cm.refresh();
    }
    
    function iFrame(id, type, content) {
	var ifrm = document.getElementById(id);
	ifrm = ifrm.contentDocument;
	var serializer = new XMLSerializer();
	var ifrm_content = serializer.serializeToString(ifrm);
	if (type == 'get')  {
		return ifrm_content;
	}else if (type == 'set') {
		ifrm.open();
		ifrm.write($.htmlClean(content, { format: true }));
		ifrm.close();
		//Rerun();//if anything changes inside iframe, reinitialize iframe
		return false;
	}
}

    