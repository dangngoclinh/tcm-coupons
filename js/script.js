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

	$("button.email-mc-subscriber").click(function() {
		var button = $(this);
		var coupon_form = button.closest('.coupon-form');
		coupon_form.addClass('send');

		button.attr('disabled', 'disabled');
		var input_to_email = $("#to_email");
		input_to_email.attr('disabled', 'disabled');

		var ajax_admin = td_ajax_url;
		var to_email = input_to_email.val();
		var coupon = button.attr('data-coupon');
		$.ajax({
			url: ajax_admin,
			type: "POST",
			data: {
				'action': 'coupon_to_email',
				'to': to_email,
				'coupon': coupon
			},
			success: function(data) {
				alert('thanh cong', data.success);
				coupon_form.removeClass('send');
				coupon_form.addClass('complete');
				button.html("Đã Gửi");
			}
		});
	});

});