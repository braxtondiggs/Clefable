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
	/*if ($("#wrapper").height < $(window).height()) {
		$("#wrapper").height($(window).height());
	}*/
	$("#sidebar").height(function() {return $("#content").height()+60});
	$("#header .menu").css({"margin-top":function() {return ($("#header").height()-$(this).height())+14;}});
	$("#header .menu li").addClass("ui-default ui-corner-top");
		$('#header .menu li a[href="#"]').parent().addClass("ui-state-disabled");
	$("#header .menu li:not(.ui-state-disabled):not(.ui-tabs-selected)").hover(
  		function () {
    		$(this).addClass('ui-state-hover');
  		}, 
  		function () {
    		$(this).removeClass('ui-state-hover');
  		});
		
	$('.modal').live("click", function() {
		var html="";
		$.ajax({
			async: false,
			type: "GET",
			url: $('.modal').attr('href'),
			success: function(response) {
				html = response;
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
	
	$("#reset-submit").live('click', function() {
		if ($("#Form_Block").validationEngine('validate')) {
			$('#reset-submit').attr('disabled', 'disabled');
			$.ajax('include/pull/recover', {
				type: "POST",
				data: $("#recovery").serialize(),
				success: function(response) {
					$('#reset-submit').attr('disabled', '');
					$("#recov_response").text("");
					if(response=="OK") {
						$("#recov_response").text("A link to reset your password has been sent to your email address.").css("color","green").fadeIn("slow"); 
					}else{
						/*if (!$("#recovery .ui-widget div").hasClass("ui-state-error")) {
							$('#recovery .ui-widget').slideDown('slow', function() {$(this).prepend('<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"><p id="recov_response" style="margin:.5em 0;"><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span><strong>Alert:</strong> We could not find your account.</p></div>');
							});
						}else{
							$('#recovery .ui-widget .ui-state-error').fadeOut("fast", function() {$(this).fadeIn("fast");})
						}*/
						
						$("#recov_response").text("We could not find the specified email. Please try again.").css("color","red").fadeIn("slow"); 
					}
				}
				});
		}
	return false;
	});
	$('#recov_pass, #cancel-submit').live('click', function() {
		$('#login').validationEngine('hide');
		$('#recovery').validationEngine('hide');
		$('#login, #recovery').toggle();
		return false;
	});
});
$('#contact-submit').live('click', function() {
	if ($("#contact").validationEngine('validate')) {
		$.ajax('contact/submit', {
			type: "POST",
			data: $("#contact").serialize(),
			success: function(data) {
				if(data.status =="success") {
					$("#Form_Block").html(data.output);	
				}else if(data.status =="error") {
					$(".validate_errors").html(data.output).slideDown('slow');
				}else {
					alert("An internal error has occurred, the page will auto-refresh.")
					window.location = "contact/"
				}
			}
		});
	}
	return false;
});
$('#login-submit').live('click', function() {
	if ($("#Form_Block").validationEngine('validate')) {
		$('#login-submit').attr('disabled', 'disabled');
		$.ajax('login/submit', {
			type: "POST",
			data: $("#login").serialize(),
			success: function(data) {
				$('#login-submit').removeAttr('disabled');
				if(data.status == "success") {
					window.location.href = 'site/';
				}else if(data.status == "error") {
					$("#login .validate_errors").html(data.output).slideDown('slow');
				}else {
					alert("An internal error has occurred, the page will auto-refresh.")
					window.location = "login/"
				}
			}
		});
	}
	return false;
});
$('#signup-submit').live('click', function() {
	if ($("#Form_Block").validationEngine('validate')) {
		$('#signup-submit').attr('disabled', 'disabled');
		$.ajax('signup/submit', {
			type: "POST",
			data: $("#Form_Block").serialize()+"&type=CYMBITCMS",
			success: function(data) {
				$('#signup-submit').removeAttr('disabled');
				if(data.status == "success") {
					window.location.href= 'site/';
				}else if(data.status =="error") {
					$(".validate_errors").html(data.output).slideDown('slow');
				}else {
					alert("An internal error has occurred, the page will auto-refresh.")
					window.location = "signup/"
				}
			}
		});
        }
	return false;
});
jQuery.fn.fadeToggle = function(speed, easing, callback) { 
   return this.animate({opacity: 'toggle'}, speed, easing, callback); 
}; 
