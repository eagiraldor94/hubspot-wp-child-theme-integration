jQuery(document).ready(function($) {
	function sleep(milliseconds) {
	 var start = new Date().getTime();
	 for (var i = 0; i < 1e7; i++) {
	  if ((new Date().getTime() - start) > milliseconds) {
	   break;
	  }
	 }
	}
	function total(adminFee,eventFee,assistantNumber,promo,multi){
		var subtotal = (eventFee)*assistantNumber;
		var discount = (promo+multi)/100;
		var total = Math.floor((1-discount)*subtotal)+(adminFee*assistantNumber);
		return total;
	}
	function tEvent(eventFee,assistantNumber){
		var event = (eventFee)*assistantNumber;
		return event;
	}
	function admin(adminFee,assistantNumber){
		var admin = (adminFee)*assistantNumber;
		return admin;
	}
	function discount(adminFee,eventFee,assistantNumber,promo,multi){
		var subtotal = (eventFee)*assistantNumber;
		var discount = (promo+multi)/100;
		discount = subtotal*discount;
		discount = Math.ceil(discount);
		return discount;
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
	var emailBody = jQuery('.emailBody').children('.et_pb_text_inner').html();
	var learn = "";
	var message = "";
	var translation ="";
	var promoCode = "";
	var promo = 0;
	var multi = 0;
	var assistantNumber = 0;
	var totalPayment = 0;
	var totalEvent = 0;
	var totalAdmin = 0;
	var totalDiscount = 0;
	var assistantList = [];
	var adminFee = 0;
	var eventFee = 0;
	var mainAttending = "";
	var dl = parseInt(jQuery('.dl').children('.et_pb_code_inner').html());
	var da = parseInt(jQuery('.da').children('.et_pb_code_inner').html());
	var billingCompany = "";
	var billingAddress = "";
	var taxId = "";
	var billingCity = "";
	var billingRegion = "";
	var zipCode = "";
	var billingCountry = "";
	var billingMessage = "";
	var haveCode = "";
	var purchaseDetails = "";
	var purchaseDetails2 = "";
	var ticketName = "";
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
	jQuery('.passSelect1').on('click',  function(event) {
		jQuery(this).empty();
		jQuery(this).text('Selected');
		jQuery('.passSelect2').empty();
		jQuery('.passSelect2').text('Select');
		ticketName = "Industry Delegate";
		adminFee = parseFloat(jQuery('.adminFee1').children('.et_pb_code_inner').html());
		eventFee = parseFloat(jQuery('.eventFee1').children('.et_pb_code_inner').html());
	});
	jQuery('.passSelect2').on('click',  function(event) {
		jQuery(this).empty();
		jQuery(this).text('Selected');
		jQuery('.passSelect1').empty();
		jQuery('.passSelect1').text('Select');
		ticketName = "Vendor Delegate";
		adminFee = parseFloat(jQuery('.adminFee2').children('.et_pb_code_inner').html());
		eventFee = parseFloat(jQuery('.eventFee2').children('.et_pb_code_inner').html());
	});
	jQuery('.attendeeNumber').on('change',  function(event) {
		assistantNumber = parseInt(jQuery('.attendeeNumber').val());
		if (assistantNumber >= dl) {
			multi = da;
		}else{
			multi = 0;
		}
		totalPayment = total(adminFee,eventFee,assistantNumber,promo,multi);
		totalEvent = tEvent(eventFee,assistantNumber);
		totalAdmin = admin(adminFee,assistantNumber);
		totalDiscount = discount(adminFee,eventFee,assistantNumber,promo,multi);
	});
	jQuery('.nextPass').on('click',  function(event) {
		if (adminFee != 0 && assistantNumber != 0) {
			jQuery('.firstText').css("display", "none");
			jQuery('.passSelect').css("display", "none");
			jQuery('.quantityContainer').css("display", "none");
			jQuery('.quantityButtonContainer').css("display", "none");
			jQuery('.mainAttending').css("display", "block");
			window.location.href = '#mainContentPage';
		}else{
			alert('Please select a pass and attendees number');
		}
	});
	jQuery('.backForm').on('click',  function(event) {
		jQuery('.firstText').css("display", "block");
		jQuery('.passSelect').css("display", "block");
		jQuery('.quantityContainer').css("display", "block");
		jQuery('.quantityButtonContainer').css("display", "block");
		jQuery('.mainAttending').css("display", "none");
		jQuery('.secretaryAdvice').css("display", "none");
		jQuery('#form-container').css("display", "none");
    	jQuery('input[name=mainAttending]').removeAttr('checked');
		window.location.href = '#mainContentPage';
	});
	jQuery('input[name=mainAttending]').on('change',  function(event) {
		mainAttending = jQuery(this).val();
		jQuery('.mainAttending').css("display", "none");
		if (mainAttending == "NO") {
			jQuery('.secretaryAdvice').css("display", "block");
		}
		jQuery('#form-container').css("display", "block");
		jQuery('span.ajax-loader').parent().children('.wpcf7-submit[type=submit]').val('Next');
	});
	jQuery('.wpcf7-submit[type=submit]').on('click',  function(event) {
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
	});
	document.addEventListener( 'wpcf7submit', function( event ) {
		jQuery('#form-container').css("display", "none");
		jQuery('.secretaryAdvice').css("display", "none");
		jQuery('.attendeeTitle').css("display", "block");
		jQuery('#assistant-container').css("display", "block");
		jQuery('.assistant-form').empty();
		for (var i = 1; i < assistantNumber+1; i++) {
            jQuery('.assistant-form').append('<form class="wpcf7 wpcf7-form assistant assistant'+i+'">'+
                '<div class="alert alert-jack"> Attendee '+i+' </div>'+
                '<p><label>Name*<br>'+
                    '<span class="wpcf7-form-control-wrap Name2"><input type="text" name="Name2" value="" size="40" class="wpcf7-form-control wpcf7-text name2" aria-required="true" aria-invalid="false"></span> </label></p>'+
                '<p><label>Surname*<br>'+
                    '<span class="wpcf7-form-control-wrap Surname2"><input type="text" name="Surname2" value="" size="40" class="wpcf7-form-control wpcf7-text surname2" aria-required="true" aria-invalid="false"></span> </label></p>'+
                '<p><label>Company/Organisation*<br>'+
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
                    '<span class="wpcf7-form-control-wrap Phone2"><input type="number" name="Phone2" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-tel w-70 phoneNumber2" aria-required="true" aria-invalid="false"></span> </label></p>'+
                    '<p><label> Do you need simultaneous translation English - Spanish: </label><br>'+
    			'<span class="wpcf7-form-control-wrap Translation"><span class="wpcf7-form-control wpcf7-radio translation"><span class="wpcf7-list-item first"><input type="radio" name="Translation'+i+'" value="YES"><span class="wpcf7-list-item-label">YES</span></span><span class="wpcf7-list-item last"><input type="radio" name="Translation'+i+'" value="NO" checked="checked"><span class="wpcf7-list-item-label">NO</span></span></span></span></p>'+
                '</form>');
		} 
		if (mainAttending == "YES") {
			jQuery('.name2').eq(0).val(name);
			jQuery('.surname2').eq(0).val(surname);
			jQuery('.company2').eq(0).val(company);
			jQuery('.job2').eq(0).val(job);
			jQuery('.email2').eq(0).val(email);
			jQuery('.country2').eq(0).val(country);
			jQuery('.countryCode2').eq(0).val(parseInt(countryCode));
			jQuery('.phoneNumber2').eq(0).val(parseInt(phoneNumber));
		}	
		window.location.href = '#mainContentPage';
		jQuery('span.ajax-loader').parent().children('.wpcf7-submit[type=submit]').val('Next');
	}, false );
	jQuery('.backAttendees').on('click',  function(event) {
		jQuery('.mainAttending').css("display", "block");
		jQuery('.attendeeTitle').css("display", "none");
		jQuery('#assistant-container').css("display", "none");
    	jQuery('input[name=mainAttending]').removeAttr('checked');
		jQuery('.wpcf7-response-output').css("display", "none");
		jQuery('span.ajax-loader').parent().children('.wpcf7-submit[type=submit]').val('Next');
		window.location.href = '#mainContentPage';
	});
	jQuery('.nextAttendees').on('click',  function(event) {
		jQuery('.attendeeTitle').css("display", "none");
		jQuery('#assistant-container').css("display", "none");
		jQuery('.billingTitle').css("display", "block");
		jQuery('.billingDetails').css("display", "block");
		window.location.href = '#mainContentPage';
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
	      					"phoneNumber":jQuery(phoneNumber2[i]).val(),
	                        "translation":jQuery('input[name=Translation'+j+']:checked').val()});
	    }
	});
	jQuery('.backBilling').on('click',  function(event) {
		jQuery('.attendeeTitle').css("display", "block");
		jQuery('#assistant-container').css("display", "block");
		jQuery('.billingTitle').css("display", "none");
		jQuery('.billingDetails').css("display", "none");
		window.location.href = '#mainContentPage';
	});
	jQuery('.nextBilling').on('click',  function(event) {
		jQuery('.billingTitle').css("display", "none");
		jQuery('.billingDetails').css("display", "none");
		jQuery('.paymentTitle').css("display", "block");
		jQuery('.discountCheck').css("display", "block");
		jQuery('.paymentDetails').css("display", "block");
		window.location.href = '#mainContentPage';
		billingCompany = jQuery('.billCompany').val();
		billingAddress = jQuery('.billAddress').val();
		taxId = jQuery('.taxId').val();
		billingCity = jQuery('.city').val();
		billingRegion = jQuery('.region').val();
		zipCode = jQuery('.zipCode').val();
		billingCountry = jQuery('.billCountry').val();
		billingMessage = jQuery('.billMessage').val();
		purchaseDetails = "Passes: "+assistantNumber+" x "+eventFee+" USD \nPrice: "+totalEvent+" USD \nDiscount: "+totalDiscount+" USD\nAdmin Fee: "+assistantNumber+" x "+adminFee+" = "+totalAdmin+" USD \nVAT:  0.00 USD \nTotal: "+totalPayment+" USD";
		purchaseDetails2 = "Passes: "+assistantNumber+" x "+eventFee+" USD <br>Price: "+totalEvent+" USD <br>Discount: "+totalDiscount+" USD<br>Admin Fee: "+assistantNumber+" x "+adminFee+" = "+totalAdmin+" USD <br>VAT:  0.00 USD <br>Total: "+totalPayment+" USD";
		jQuery('.totalAmount').html(purchaseDetails);
		haveCode = jQuery('input[name=discount]:checked').val();
		if (haveCode == "YES") {
			jQuery('#promo-container').css("display", "block");
		}else if (haveCode == "NO") {
			jQuery('#promo-container').css("display", "none");
		}
	});
	jQuery('input[name=discount]').on('change',  function(event) {
		haveCode = jQuery(this).val();
		if (haveCode == "YES") {
			jQuery('#promo-container').css("display", "block");
		}else if (haveCode == "NO") {
			jQuery('#promo-container').css("display", "none");
		}
	});
	jQuery('.verifyCode').on('click',  function(event) {
		promoCode = jQuery('.promoCode').val();
		alert('Please wait a moment. We are checking the code.');
		var codeUrl = "/wp-content/themes/api-theme/Interaction/form_requests.php?queryType=promo_code&promoCode="+promoCode+"&email="+email+"&number="+assistantNumber;
		jQuery.ajax({
			url: codeUrl,
			type: 'GET',
		})
		.done(function(answer) {
			var ans = JSON.parse(answer);
			jQuery('.promoDescription').html(ans.promoDescription);
			promo = parseFloat(ans.promoValue);
			totalPayment = total(adminFee,eventFee,assistantNumber,promo,multi);
			totalEvent = tEvent(eventFee,assistantNumber);
			totalAdmin = admin(adminFee,assistantNumber);
			totalDiscount = discount(adminFee,eventFee,assistantNumber,promo,multi);
			purchaseDetails = "Passes: "+assistantNumber+" x "+eventFee+" USD \nPrice: "+totalEvent+" USD \nDiscount: "+totalDiscount+" USD\nAdmin Fee: "+assistantNumber+" x "+adminFee+" = "+totalAdmin+" USD \nVAT:  0.00 USD \nTotal: "+totalPayment+" USD";
			purchaseDetails2 = "Passes: "+assistantNumber+" x "+eventFee+" USD <br>Price: "+totalEvent+" USD <br>Discount: "+totalDiscount+" USD<br>Admin Fee: "+assistantNumber+" x "+adminFee+" = "+totalAdmin+" USD <br>VAT:  0.00 USD <br>Total: "+totalPayment+" USD";
			jQuery('.totalAmount').html(purchaseDetails);
		})
		.fail(function() {
			console.log("error retrieving code data");
		});
	});
	jQuery('.backPayment').on('click',  function(event) {
		jQuery('.billingTitle').css("display", "block");
		jQuery('.billingDetails').css("display", "block");
		jQuery('.paymentTitle').css("display", "none");
		jQuery('.discountCheck').css("display", "none");
		jQuery('.paymentDetails').css("display", "none");
		jQuery('#promo-container').css("display", "none");
		window.location.href = '#mainContentPage';
	});
	jQuery('input.finishRegister').on('click',  function(event) {
		paymentMethod = jQuery('.payment').val();
		payMessage = jQuery('.payMessage').val();
		var terms = jQuery('input[name=Terms]').prop('checked');
		if (terms == true) {
		    var data = new FormData();
		    data.append("queryType", "reg_deal");
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
		    data.append("message", payMessage);
		    data.append("promoCode", promoCode);
		    data.append("assistantNumber", assistantNumber);
		    data.append("totalPayment", totalPayment);
		    data.append("billingCompany", billingCompany);
		    data.append("billingAddress", billingAddress);
		    data.append("taxId", taxId);
		    data.append("billingCity", billingCity);
		    data.append("billingRegion", billingRegion);
		    data.append("zipCode", zipCode);
		    data.append("billingCountry", billingCountry);
		    data.append("billingMessage", billingMessage);
		    data.append("emailBody", emailBody);
		    data.append("purchaseDetails", purchaseDetails2);
		    data.append("ticketName", ticketName);
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
			jQuery('.paymentTitle').css("display", "none");
			jQuery('.discountCheck').css("display", "none");
			jQuery('.paymentDetails').css("display", "none");
			jQuery('#promo-container').css("display", "none");
			jQuery('#success-register').css("display", "block");
			window.location.href = '#mainContentPage';
		}else{
			alert("You must accept our terms & conditions.")
		}
	});
});