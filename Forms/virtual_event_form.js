jQuery(document).ready(function($) {
	function sleep(milliseconds) {
	 var start = new Date().getTime();
	 for (var i = 0; i < 1e7; i++) {
	  if ((new Date().getTime() - start) > milliseconds) {
	   break;
	  }
	 }
	}
	function totalAmount(adminFee,eventFee,assistantNumber,promo,multi){
		var total = (adminFee+eventFee)*assistantNumber;
		return total;
	}
	var name = "";
	var surname = "";
	var company = "";
	var job = "";
	var email = "";
	var country = "";
	var countryCode = "";
	var phoneNumber = "";
	var eventName = "";
	var paymentMethod = "";
	var eventCode = jQuery('.eventCode').children('.et_pb_code_inner').html();
	var learn = "";
	var message = "";
	var assistantNumber = 0;
	var totalPayment = 0;
	var assistantList = [];
	var adminFee = parseFloat(jQuery('.adminFee').children('.et_pb_code_inner').html());
	var eventFee = parseFloat(jQuery('.eventFee').children('.et_pb_code_inner').html());
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
	});
	jQuery('.assistantNumber').on('change',  function(event) {
		assistantNumber = parseInt(jQuery('.assistantNumber').val());
		totalPayment = totalAmount(adminFee,eventFee,assistantNumber);
		jQuery('.totalAmount').val(totalPayment);
	});
	jQuery('.assistantDetails').on('click',  function(event) {
		paymentMethod = jQuery('.payment').val();
		jQuery('#promo-container').css("display", "none");
		jQuery('#assistant-container').css("display", "block");
		jQuery('.assistant-form').empty();
		for (var i = 1; i < assistantNumber+1; i++) {
            jQuery('.assistant-form').append('<form class="wpcf7 wpcf7-form assistant assistant'+i+'">'+
                '<div class="alert alert-jack"> Attendee '+i+' </div>'+
                '<p><label>Name*<br>'+
                    '<span class="wpcf7-form-control-wrap Name2"><input type="text" name="Name2" value="" size="40" class="wpcf7-form-control wpcf7-text name2" aria-required="true" aria-invalid="false"></span> </label></p>'+
                '<p><label>Surname*<br>'+
                    '<span class="wpcf7-form-control-wrap Surname2"><input type="text" name="Surname2" value="" size="40" class="wpcf7-form-control wpcf7-text surname2" aria-required="true" aria-invalid="false"></span> </label></p>'+
                '<p><label>Company Name*<br>'+
                    '<span class="wpcf7-form-control-wrap Company2"><input type="text" name="Company2" value="" size="40" class="wpcf7-form-control wpcf7-text company2" aria-required="true" aria-invalid="false"></span> </label></p>'+
                '<p><label>Job Title*<br>'+
                    '<span class="wpcf7-form-control-wrap Job2"><input type="text" name="Job2" value="" size="40" class="wpcf7-form-control wpcf7-text job2" aria-required="true" aria-invalid="false"></span> </label></p>'+
                '<p><label> Corporate Email Address*<br>'+
                    '<span class="wpcf7-form-control-wrap Email2"><input type="email" name="Email2" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email email2" aria-required="true" aria-invalid="false"></span> </label></p>'+
                '<p><label> Country*<br>'+
                    '<span class="wpcf7-form-control-wrap Country2"><input type="text" name="Country2" value="" size="40" class="wpcf7-form-control wpcf7-text country2" aria-required="true" aria-invalid="false"></span> </label></p>'+
                '<p><label> Country Code*<br>'+
                    '<span class="wpcf7-form-control-wrap Code2"><input type="number" name="Code2" value="" class="wpcf7-form-control wpcf7-number w-30 countryCode2" aria-required="true" aria-invalid="false"></span> </label></p>'+
                '<p><label> Phone Number*<br>'+
                    '<span class="wpcf7-form-control-wrap Phone2"><input type="tel" name="Phone2" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-tel w-70 phoneNumber2" aria-required="true" aria-invalid="false"></span> </label></p>'+
                '</form>');
		} 	
	});
	jQuery('input.final-form').on('click',  function(event) {
        var name2 = jQuery('.name2');
	  	var surname2 = jQuery('.surname2');
	  	var company2 = jQuery('.company2');
	  	var job2 = jQuery('.job2');
	  	var email2 = jQuery('.email2');
	  	var country2 = jQuery('.country2');
	  	var countryCode2 = jQuery('.countryCode2');
	  	var phoneNumber2 = jQuery('.phoneNumber2');
	  	assistantList = [];
	    for (var i = 0; i < name2.length; i++) {
	    	j = i+1;
	      assistantList.push({"name":jQuery(name2[i]).val(),
	      					"surname":jQuery(surname2[i]).val(),
	      					"company":jQuery(company2[i]).val(),
	      					"job":jQuery(job2[i]).val(),
	      					"email":jQuery(email2[i]).val(),
	      					"country":jQuery(country2[i]).val(),
	      					"countryCode":jQuery(countryCode2[i]).val(),
	      					"phoneNumber":jQuery(phoneNumber2[i]).val()});
	    }
	    var data = new FormData();
	    data.append("queryType", "virtual_reg");
	    data.append("assistantList", JSON.stringify(assistantList));
	    data.append("name", name);
	    data.append("surname", surname);
	    data.append("company", company);
	    data.append("job", job);
	    data.append("email", email);
	    data.append("country", country);
	    data.append("countryCode", countryCode);
	    data.append("phoneNumber", phoneNumber);
	    data.append("event", eventName);
	    data.append("paymentMethod", paymentMethod);
	    data.append("eventCode", eventCode);
	    data.append("learn", learn);
	    data.append("message", message);
	    data.append("assistantNumber", assistantNumber);
	    data.append("totalPayment", totalPayment);
		var dealUrl = "/wp-content/themes/api-theme/Interaction/form_requests.php";
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
		jQuery('#assistant-container').css("display", "none");
		jQuery('#success-register').css("display", "block");
	});
});