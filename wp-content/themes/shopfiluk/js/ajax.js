// підключення кнопки load more
(function(jQuery) {
	var ppp = 4; // Post per page
	var pageNumber = 2;
	var prNumber = 8;
	var total = jQuery('#totalpages').val();
	jQuery("#more_posts").on("click", function ($) {
		jQuery("#more_posts").attr("disabled", true); // Disable the button, temp.
		pageNumber++;
		prNumber += ppp;
		var str = '&pageNumber=' + pageNumber + '&ppp=' + ppp + '&action=more_post_ajax';
		jQuery.ajax({
			type: "POST",
			dataType: "html",
			url: the_ajax_script.ajaxurl,
			data: str,

			success: function (data) {
				var $data = jQuery(data);
				if ($data.length) {
					jQuery("#ajax-posts").append($data);
					jQuery("#more_posts").attr("disabled", false);
				} else {
					jQuery("#more_posts").attr("disabled", true);
				}
				if (total <= prNumber) {
					jQuery("#more_posts").hide();
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				$loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
			}

		});
		return false;
	});
})(jQuery);