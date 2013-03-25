$(function() {
    $('#frame_content').load(function() {
	var iframe = $(this);
	var iframe_contents = $(iframe).contents();
	var iframe_html = iframe_contents.find("html");
	$(iframe).height($(iframe_contents).height());
	var site_id = $(iframe).data('site-id');
    
    
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
    });
    $('.msource').bind('click', function() {
	$('#dialog-confirm').children('#dialog-confirm-body').html('<div id="source_view"><form><textarea id="code" name="code">Test Code</textarea></form></div>').find('#source_view').height('500px');
$('#dialog-confirm').dialog({ title: "Open File"}).dialog('open').dialog({buttons: {"Ok": function() {
			window.location = '../' + site_id + '/' + encodeURIComponent(base64_encode($('.jqueryFileTree .selected').attr('rel')));
                        $(this).dialog("close");
                    },
                    "Cancel": function() {
                        $(this).dialog("close");
                    }
		}
	    });
      var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
        lineNumbers: true,
        extraKeys: {"Ctrl-Space": "autocomplete"}
      });
      return false;
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