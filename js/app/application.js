$(function() {
    $('#frame_content').load(function() {
	var iframe = $(this);
	var iframe_contents = $(iframe).contents();
	$(iframe).height($(iframe_contents).height());
    });
});