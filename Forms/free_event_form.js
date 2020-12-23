jQuery(document).ready(function($) {
	function sleep(milliseconds) {
	 var start = new Date().getTime();
	 for (var i = 0; i < 1e7; i++) {
	  if ((new Date().getTime() - start) > milliseconds) {
	   break;
	  }
	 }
	}
	jQuery('.sendForm').css("display", "none");
	var name = "";
	var surname = "";
	var company = "";
	var job = "";
	var email = "";
	var country = "";
	var countryCode = "";
	var phoneNumber = "";
	var eventName = "";
	var eventCode = jQuery('.eventCode').children('.et_pb_code_inner').html();
	var learn = "";
	var message = "";
	var translation ="";
	var promoCode = "";
	var codeValidation = false;
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
	jQuery('.verifyCode').on('click',  function(event) {
		promoCode = jQuery('.promoCode').val();
		var codeUrl = "/wp-content/themes/api-theme/Interaction/form_requests.php?queryType=free_code&promoCode="+promoCode+"&email="+email;
		jQuery.ajax({
			url: codeUrl,
			type: 'GET',
		})
		.done(function(answer) {
			var ans = JSON.parse(answer);
			jQuery('.promoDescription').html(ans.promoDescription);
			if (ans.promoValue == true) {
				codeValidation = true
			}
		})
		.fail(function() {
			console.log("error retrieving user data");
		});
		sleep(1000);
	    var data = new FormData();
	    data.append("queryType", "free_reg");
	    data.append("name", name);
	    data.append("surname", surname);
	    data.append("company", company);
	    data.append("job", job);
	    data.append("email", email);
	    data.append("country", country);
	    data.append("countryCode", countryCode);
	    data.append("phoneNumber", phoneNumber);
	    data.append("event", eventName);
	    data.append("eventCode", eventCode);
	    data.append("learn", learn);
	    data.append("message", message);
	    data.append("translation", translation);
	    data.append("promoCode", promoCode);
		var dealUrl = "/wp-content/themes/api-theme/Interaction/form_requests.php";
		if (codeValidation == true) {
		    jQuery.ajax({
		      url:dealUrl,
		      method: "POST",
		      data: data,
		      cache: false,
		      contentType: false,
		      processData: false,
		      success:function(answer){
		      	console.log('deal sent');
		      }
			});

			jQuery('#promo-container').css("display", "none");
			jQuery('#success-register').css("display", "block");
		}
	});
	jQuery('.wpcf7-submit[type=submit]').on('click',  function(event) {
		jQuery('#form-container').css("display", "none");
		jQuery('#promo-container').css("display", "block");
		name = jQuery('.name').val();
		surname = jQuery('.surname').val();
		company = jQuery('.company').val();
		job = jQuery('.job').val();
		email = jQuery('.email').val();
		country = jQuery('.country').val();
		countryCode = jQuery('.countryCode').val();
		phoneNumber = jQuery('.phoneNumber').val();
		eventName = jQuery('.event').val();
		learn = jQuery('.learn').val();
		message = jQuery('.message').val();
		translation = jQuery('input[name=Translation]:checked').val();
	});
});