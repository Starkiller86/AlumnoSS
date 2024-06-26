$(document).ready(function() {
	$("#pane p.menu_head").click(function() {
		$(this).css({backgroundImage:"url(../images/flecha-arriba.png)"}).next("div.menu_body").slideDown(500).siblings("div.menu_body").slideUp("slow");
		$(this).siblings().css({backgroundImage:"url(../images/flecha-abajo.png)"});
	});
});