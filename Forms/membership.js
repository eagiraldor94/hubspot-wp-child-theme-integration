jQuery(document).ready(function($) {
	function sleep(milliseconds) {
	 var start = new Date().getTime();
	 for (var i = 0; i < 1e7; i++) {
	  if ((new Date().getTime() - start) > milliseconds) {
	   break;
	  }
	 }
	}
	var dataUrl = "/wp-content/themes/api-theme/Interaction/form_requests.php?queryType=return_user_data";
	jQuery.ajax({
		url: dataUrl,
		type: 'GET',
	})
	.done(function(answer) {
		var ans = JSON.parse(answer);
		if (ans != "" && ans != null) {
			jQuery('.name').val(ans.name);
			jQuery('.surname').val(ans.surname);
			jQuery('.company').val(ans.company);
			jQuery('.job').val(ans.job);
			jQuery('.email').val(ans.email);
			jQuery('.country').val(ans.country);
		}
	})
	.fail(function() {
		console.log("error retrieving user data");
	});
	jQuery('.wpcf7-submit').on('click',  function(event) {
		var name = jQuery('.name').val();
		var surname = jQuery('.surname').val();
		var company = jQuery('.company').val();
		var job = jQuery('.job').val();
		var email = jQuery('.email').val();
		var country = jQuery('.country').val();
		var countryCode = jQuery('.countryCode').val();
		var phoneNumber = jQuery('.phoneNumber').val();
		var event = jQuery('.event').val();
		var eventCode = jQuery('.eventCode').children('.et_pb_code_inner').html();
		var learn = jQuery('.learn').val();
		var message = jQuery('.message').val();
		var payment = jQuery('.payment').val();
		var jackUrl1 = "/wp-content/themes/api-theme/Interaction/form_requests.php?queryType=mem_reg&name="+name+"&surname="+surname+"&company="+company+"&email="+email+"&job="+job+"&country="+country+"&phone="+countryCode+" - "+phoneNumber+"&event="+event+"&eventCode="+eventCode+"&learn="+learn+"&message="+message+"&payment="+payment;
		jQuery.ajax({
			url: jackUrl1,
			type: 'GET',
		})
		.done(function(answer) {
			console.log(answer);
		})
		.fail(function() {
			console.log("error retrieving user data");
		});
	});
});