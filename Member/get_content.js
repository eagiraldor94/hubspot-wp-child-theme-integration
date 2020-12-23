jQuery(document).ready(function($) {
	var dataUrl = "/wp-content/themes/api-theme/Interaction/form_requests.php?queryType=return_user_data";
	var button = "";
	jQuery.ajax({
		url: dataUrl,
		type: 'GET',
	})
	.done(function(answer) {
		var ans = JSON.parse(answer);
		if (ans != "" && ans != null) {
			for (var i = ans.member_links.length - 1; i >= 0; i--) {
				button = '<div class="row jack-premium-container"><div class="jack-premium-button"><a class="jack-premium-anchor" href="'+ans.member_links[i]+'">'+ans.member_texts[i]+'</a></div></div>';
				jQuery('#jack-button-container').append(button);
			}
		}
	})
	.fail(function() {
		console.log("error retrieving user data");
	});
});