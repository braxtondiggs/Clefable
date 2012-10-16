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
		}
        return false;
    });
    
    function Init() {
        $("#breadCrumb").jBreadCrumb();
        $(".jQTabs").tabs().children('ul').removeClass('ui-widget-header').addClass('ui-widget-header-tab');
        $(".button").button();
        $(".formular").validationEngine('attach');
    }
});