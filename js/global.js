var contact_passed = false;
var _gaq = _gaq || [];

function loadtracking() {
        window._gaq.push(['_setAccount', 'UA-28597479-1']);
        window._gaq.push(['_setDomainName', 'cymbit.com']);
		window._gaq.push(['_trackPageview']);

        $(function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        });
}

loadtracking();
$(function() {
	var internal_error = "An internal error has occurred, the page will auto-refresh.";
	$(".formular").validationEngine('attach');
	$(".button").button();
	$("#sidebar").height(function() {return $("#content").height()+60});
	$("#header .menu").find('li').addClass("ui-default ui-corner-top").not(".ui-state-disabled, .ui-tabs-selected").hover(
  		function () {
			$(this).addClass('ui-state-hover');
  		}, 
  		function () {
			$(this).removeClass('ui-state-hover');
  		}
	).show();
	$('.modal').live("click", function() {
		var html="";
		$.ajax({
			async: false,
			type: "GET",
			url: $('.modal').attr('href'),
			success: function(data) {
				html = data;
			}
		});
		if ($('#dialog-modal').length == 0) {$('body').append('<div id="dialog-modal" title="'+$('.modal').attr('title')+'">'+html+'</div>')}
		$( "#dialog-modal" ).dialog({
			height: 550,
			width:550,
			modal: true,
			draggable: false,
			resizable: false
				
		});
		return false;
	});
	$("#signup_btn").click(function(){
		window.location.href= 'Register';
		return false;
	});
	$('#recov_pass, #cancel-submit').live('click', function() {
		$('#login').validationEngine('hide');
		$('#recovery').validationEngine('hide');
		$('#login, #recovery').toggle();
		return false;
	});
	$('.formular').submit(function() {
		 var form = $(this);
		 if ($(form).validationEngine('validate')) {
			$.ajax($(form).attr('action'), {
				type: "POST",
				data: $(this).serialize(),
				success: function(data) {
					var form_output = $(form).find(".validate_errors");
					if(data.status =="success") {
						if (data.output != null) {
							$(data.location).html(data.output).addClass('alert-success');
							if ($(form_output).hasClass('alert-error')) {
								$(form_output).removeClass('alert-error');
							}
						}
						if (data.redirect != null) {
							window.location.href = data.redirect;
						}
					}else if(data.status == "error") {
						$(form_output).html(data.output).slideDown('slow');
						if ($(form_output).hasClass('alert-success')) {
							$(form_output).removeClass('alert-success');
						}
						if (!$(form_output).hasClass('alert-error')) {
							$(form_output).addClass('alert-error');
						}
					}else {
						alert(internal_error);
						window.location.reload();
					}
				}
			});
		}
		return false;
	});
});
jQuery.fn.fadeToggle = function(speed, easing, callback) { 
   return this.animate({opacity: 'toggle'}, speed, easing, callback); 
};