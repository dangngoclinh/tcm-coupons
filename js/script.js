jQuery(document).ready(function($) {
	$(".coupon-click").click(function(event) {
		event.preventDefault();

		var affiliatelink = $(this).attr('data-url-ref');
		var couponlink = '?c=' + $(this).attr('data-coupon-id');
		
		window.open(couponlink);
		window.location.href = affiliatelink;
	});

	$("#dialog_coupon").dialog({
		autoOpen: true,
		modal: true,
		draggable: false
	});


	$(".js-close").click(function() {
		$(this).closest(".modal").fadeOut();
	});

	$(".js-copy").click(function() {
		var code = $(this).attr('data-code');
		var $temp = $("<input>");
		var $jscopy = $(this);

		$("body").append($temp);
		$temp.val(code).select();
		document.execCommand("copy");
		$temp.remove();
		$(this).addClass("copied");
		$(this).html('Copied');

		setTimeout(function() {
			$jscopy.removeClass("copied");
			$jscopy.html('Copy');
		}, 2000);
	});

	
});