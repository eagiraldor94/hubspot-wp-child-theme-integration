<?php
date_default_timezone_set('Europe/Bratislava');
require_once("../../../../wp-load.php");
$day = date('d');
$month = date('m');
if (isset($_REQUEST["queryType"])) {
	switch ($_REQUEST["queryType"]) {
		case 'spe_form_reg':
			// var_dump($_REQUEST);
			$url = "https://api.hubapi.com/contacts/v1/contact/createOrUpdate/email/".$_REQUEST["email"]."/?";
			$ch = curl_init( $url );
			# Setup request to send json via POST.
			$data = '{"properties": [{"property": "firstname","value": "'.$_REQUEST["name"].'"},{"property": "lastname","value": "'.$_REQUEST["surname"].'"},{"property": "company","value": "'.$_REQUEST["company"].'"},{"property": "email","value": "'.$_REQUEST["email"].'"},{"property": "jobtitle","value": "'.$_REQUEST["job"].'"},{"property": "country","value": "'.$_REQUEST["country"].'"},{"property": "phone","value": "'.$_REQUEST["phone"].'"},{"property": "event","value": "'.$_REQUEST["event"].'"}]}';
			curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
			curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			# Return response instead of printing.
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
			# Send request.
			$result = curl_exec($ch);
			$result = json_decode($result, true);
			$vid = $result["vid"];
			curl_close($ch);
			if ($vid != null && $vid != "") {
				echo 'contact Ok!';
			}
			$url2 = "https://api.hubapi.com/deals/v1/deal/?";
			$ch2 = curl_init( $url2 );
			$data2 = '{"associations":{"associatedVids":['.$vid.']},"properties":[{"value":"'.$month.'.'.$day.' '.$_REQUEST["eventCode"].' SD '.$_REQUEST["name"].' '.$_REQUEST["surname"].' - '.$_REQUEST["company"].'","name":"dealname"},{"value":"'.$_REQUEST["eventCode"].'","name":"event"},{"value":"qualifiedtobuy","name":"dealstage"}]}';
			curl_setopt( $ch2, CURLOPT_POSTFIELDS, $data2 );
			curl_setopt( $ch2, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			# Return response instead of printing.
			curl_setopt( $ch2, CURLOPT_RETURNTRANSFER, true );
			# Send request.
			$result2 = curl_exec($ch2);
			$result2 = json_decode($result2, true);
			$vid2 = $result2["dealId"];
			curl_close($ch2);
			if ($vid2 != null && $vid2 != "") {
				echo '<br>deal Ok!';
			}
			$url3 = "https://api.hubapi.com/engagements/v1/engagements?";
			$ch3 = curl_init( $url3 );
			$data3 = '{"engagement":{"active":true,"type":"NOTE"},"associations":{"contactIds":[],"companyIds":[],"dealIds":['.$vid2.'],"ownerIds":[]},"metadata":{"body":"Become a Speaker Form<br><br>Name: '.$_REQUEST["name"].' <br> Suname: '.$_REQUEST["surname"].'<br> Phone number: '.$_REQUEST["phone"].' <br> Email: '.$_REQUEST["email"].'<br> Country: '.$_REQUEST["country"].'<br><br> Company: '.$_REQUEST["company"].' <br>Jobtitle: '.$_REQUEST["job"].' <br><br> Event: '.$_REQUEST["event"].'<br> Event Code: '.$_REQUEST["eventCode"].'<br> How did you learn about the event? <br> '.$_REQUEST["learn"].'<br><br> Message:<br>'.$_REQUEST["message"].'"}}';
			curl_setopt( $ch3, CURLOPT_POSTFIELDS, $data3 );
			curl_setopt( $ch3, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			# Return response instead of printing.
			curl_setopt( $ch3, CURLOPT_RETURNTRANSFER, true );
			# Send request.
			$result3 = curl_exec($ch3);
			$finalCheck = json_decode($result3,true);
			$finalCheck = $finalCheck["engagement"]["id"];
			curl_close($ch3);
			if ($finalCheck != null && $finalCheck != "") {
				echo '<br>note Ok!';
			}
			break;
		case 'agenda_reg':
			// var_dump($_REQUEST);
			$url = "https://api.hubapi.com/contacts/v1/contact/createOrUpdate/email/".$_REQUEST["email"]."/?";
			$ch = curl_init( $url );
			# Setup request to send json via POST.
			$data = '{"properties": [{"property": "firstname","value": "'.$_REQUEST["name"].'"},{"property": "lastname","value": "'.$_REQUEST["surname"].'"},{"property": "company","value": "'.$_REQUEST["company"].'"},{"property": "email","value": "'.$_REQUEST["email"].'"},{"property": "jobtitle","value": "'.$_REQUEST["job"].'"},{"property": "country","value": "'.$_REQUEST["country"].'"},{"property": "phone","value": "'.$_REQUEST["phone"].'"},{"property": "event","value": "'.$_REQUEST["event"].'"}]}';
			curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
			curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			# Return response instead of printing.
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
			# Send request.
			$result = curl_exec($ch);
			$result = json_decode($result, true);
			$vid = $result["vid"];
			curl_close($ch);
			if ($vid != null && $vid != "") {
				echo 'contact Ok!';
			}
			$url2 = "https://api.hubapi.com/deals/v1/deal/?";
			$ch2 = curl_init( $url2 );
			$data2 = '{"associations":{"associatedVids":['.$vid.']},"properties":[{"value":"'.$month.'.'.$day.' '.$_REQUEST["eventCode"].' AD '.$_REQUEST["name"].' '.$_REQUEST["surname"].' - '.$_REQUEST["company"].'","name":"dealname"},{"value":"'.$_REQUEST["eventCode"].'","name":"event"},{"value":"qualifiedtobuy","name":"dealstage"}]}';
			curl_setopt( $ch2, CURLOPT_POSTFIELDS, $data2 );
			curl_setopt( $ch2, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			# Return response instead of printing.
			curl_setopt( $ch2, CURLOPT_RETURNTRANSFER, true );
			# Send request.
			$result2 = curl_exec($ch2);
			$result2 = json_decode($result2, true);
			$vid2 = $result2["dealId"];
			curl_close($ch2);
			if ($vid2 != null && $vid2 != "") {
				echo '<br>deal Ok!';
			}
			$url3 = "https://api.hubapi.com/engagements/v1/engagements?";
			$ch3 = curl_init( $url3 );
			$data3 = '{"engagement":{"active":true,"type":"NOTE"},"associations":{"contactIds":[],"companyIds":[],"dealIds":['.$vid2.'],"ownerIds":[]},"metadata":{"body":"Agenda Form<br><br>Name: '.$_REQUEST["name"].' <br> Suname: '.$_REQUEST["surname"].'<br> Phone number: '.$_REQUEST["phone"].' <br> Email: '.$_REQUEST["email"].'<br> Country: '.$_REQUEST["country"].'<br><br> Company: '.$_REQUEST["company"].' <br>Jobtitle: '.$_REQUEST["job"].' <br><br> Event: '.$_REQUEST["event"].'<br> Event Code: '.$_REQUEST["eventCode"].'<br> How did you learn about the event? <br> '.$_REQUEST["learn"].'<br><br> Message:<br>'.$_REQUEST["message"].'"}}';
			curl_setopt( $ch3, CURLOPT_POSTFIELDS, $data3 );
			curl_setopt( $ch3, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			# Return response instead of printing.
			curl_setopt( $ch3, CURLOPT_RETURNTRANSFER, true );
			# Send request.
			$result3 = curl_exec($ch3);
			$finalCheck = json_decode($result3,true);
			$finalCheck = $finalCheck["engagement"]["id"];
			curl_close($ch3);
			if ($finalCheck != null && $finalCheck != "") {
				echo '<br>note Ok!';
			}
			break;
		case 'promo_code':
			$code = $_REQUEST['promoCode'];
			$email = $_REQUEST['email'];
			$assNumber = $_REQUEST['number'];
			$regEmails = "";
			$lastInscript = "";
			$dealId = "";
			// var_dump($_REQUEST);
			$url = "https://api.hubapi.com/crm-associations/v1/associations/2487901/HUBSPOT_DEFINED/4?&limit=100";
			$ch = curl_init( $url );
			# Return response instead of printing.
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
			# Send request.
			$result = curl_exec($ch);
			$result = json_decode($result, true);
			curl_close($ch);
			$valid = false;
			$validationResult["promoValue"]=0;
			$validationResult["promoDescription"]="Invalid code.";
			foreach ($result["results"] as $validCode) {
				$url = "https://api.hubapi.com/deals/v1/deal/".$validCode."?";
				$ch = curl_init( $url );
				# Return response instead of printing.
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
				# Send request.
				$result2 = curl_exec($ch);
				$result2 = json_decode($result2, true);
				if ($result2["properties"]["dealname"]["value"] == $code) {
					if ($result2["properties"]["code_type"]["value"] == "D") {
						if (intval($result2["properties"]["limit"]["value"])>intval($result2["properties"]["inscriptors"]["value"])+intval($assNumber)) {
							$valid = true;
							$validationResult["promoValue"]=intval($result2["properties"]["code_discount_amount"]["value"]);
							$validationResult["promoDescription"]=$result2["properties"]["code_message"]["value"];
							$regEmails = $result2["properties"]["inscriptor_emails"]["value"].",".$email;
							$lastInscript = intval($result2["properties"]["inscriptors"]["value"])+intval($assNumber);
							$lastInscript = (string)$lastInscript;
							$dealId = $validCode;
							break;
						}
					}
				}
			}
			curl_close($ch);
			if ($valid == true) {
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => "https://api.hubapi.com/deals/v1/deal/".$dealId."?",
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 0,
				  CURLOPT_FOLLOWLOCATION => true,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "PUT",
				  CURLOPT_POSTFIELDS =>"{\r\n  \"properties\": [\r\n    {\r\n      \"value\": ".$lastInscript.",\r\n      \"name\": \"inscriptors\"\r\n    },\r\n    {\r\n      \"value\": \"".$regEmails."\",\r\n      \"name\": \"inscriptor_emails\"\r\n    }\r\n  ]\r\n}\r\n",
				  CURLOPT_HTTPHEADER => array(
				    "Content-Type: application/json",
				    "Cookie: __cfduid=d8c8ffc8fdce8a01b0926f0e75e30966d1600361635"
				  ),
				));
				$response = curl_exec($curl);
				curl_close($curl);
			}
			echo json_encode($validationResult);
			break;
		case 'free_code':
			$code = $_REQUEST['promoCode'];
			$email = $_REQUEST['email'];
			$regEmails = "";
			$lastInscript = "";
			$dealId = "";
			// var_dump($_REQUEST);
			$url = "https://api.hubapi.com/crm-associations/v1/associations/2487901/HUBSPOT_DEFINED/4?&limit=100";
			$ch = curl_init( $url );
			# Return response instead of printing.
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
			# Send request.
			$result = curl_exec($ch);
			$result = json_decode($result, true);
			curl_close($ch);
			$valid = false;
			$validationResult["promoValue"]=false;
			$validationResult["promoDescription"]="This is not a valid code or has too many uses.";
			foreach ($result["results"] as $validCode) {
				$url = "https://api.hubapi.com/deals/v1/deal/".$validCode."?";
				$ch = curl_init( $url );
				# Return response instead of printing.
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
				# Send request.
				$result2 = curl_exec($ch);
				$result2 = json_decode($result2, true);
				if ($result2["properties"]["code_type"]["value"] == "F") {
					if (intval($result2["properties"]["limit"]["value"])>intval($result2["properties"]["inscriptors"]["value"])) {
						$valid = true;
						$validationResult["promoValue"]=true;
						$validationResult["promoDescription"]=$result2["properties"]["code_message"]["value"];
						$regEmails = $result2["properties"]["inscriptor_emails"]["value"].",".$email;
						$lastInscript = intval($result2["properties"]["inscriptors"]["value"])+1;
						$lastInscript = (string)$lastInscript;
						$dealId = $validCode;
						break;
					}
				}
			}
			curl_close($ch);
			if ($valid == true) {
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => "https://api.hubapi.com/deals/v1/deal/".$dealId."?",
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 0,
				  CURLOPT_FOLLOWLOCATION => true,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "PUT",
				  CURLOPT_POSTFIELDS =>"{\"properties\": [{\"value\": ".$lastInscript.", \"name\": \"inscriptors\"},{\"value\": ".$regEmails.",\"name\": \"inscriptor_emails\"}]}",
				  CURLOPT_HTTPHEADER => array(
				    "Content-Type: application/json"
				  ),
				));
				$response = curl_exec($curl);
				curl_close($curl);
			}
			echo json_encode($validationResult);
			break;
		case 'spo_form_reg':
			// var_dump($_REQUEST);
			$url = "https://api.hubapi.com/contacts/v1/contact/createOrUpdate/email/".$_REQUEST["email"]."/?";
			$ch = curl_init( $url );
			# Setup request to send json via POST.
			$data = '{"properties": [{"property": "firstname","value": "'.$_REQUEST["name"].'"},{"property": "lastname","value": "'.$_REQUEST["surname"].'"},{"property": "company","value": "'.$_REQUEST["company"].'"},{"property": "email","value": "'.$_REQUEST["email"].'"},{"property": "jobtitle","value": "'.$_REQUEST["job"].'"},{"property": "country","value": "'.$_REQUEST["country"].'"},{"property": "phone","value": "'.$_REQUEST["phone"].'"},{"property": "event","value": "'.$_REQUEST["event"].'"}]}';
			curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
			curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			# Return response instead of printing.
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
			# Send request.
			$result = curl_exec($ch);
			$result = json_decode($result, true);
			$vid = $result["vid"];
			curl_close($ch);
			if ($vid != null && $vid != "") {
				echo 'contact Ok!';
			}
			$url2 = "https://api.hubapi.com/deals/v1/deal/?";
			$ch2 = curl_init( $url2 );
			$data2 = '{"associations":{"associatedVids":['.$vid.']},"properties":[{"value":"'.$month.'.'.$day.' '.$_REQUEST["eventCode"].' SP '.$_REQUEST["name"].' '.$_REQUEST["surname"].' - '.$_REQUEST["company"].'","name":"dealname"},{"value":"'.$_REQUEST["eventCode"].'","name":"event"},{"value":"qualifiedtobuy","name":"dealstage"}]}';
			curl_setopt( $ch2, CURLOPT_POSTFIELDS, $data2 );
			curl_setopt( $ch2, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			# Return response instead of printing.
			curl_setopt( $ch2, CURLOPT_RETURNTRANSFER, true );
			# Send request.
			$result2 = curl_exec($ch2);
			$result2 = json_decode($result2, true);
			$vid2 = $result2["dealId"];
			curl_close($ch2);
			if ($vid2 != null && $vid2 != "") {
				echo '<br>deal Ok!';
			}
			$url3 = "https://api.hubapi.com/engagements/v1/engagements?";
			$ch3 = curl_init( $url3 );
			$data3 = '{"engagement":{"active":true,"type":"NOTE"},"associations":{"contactIds":[],"companyIds":[],"dealIds":['.$vid2.'],"ownerIds":[]},"metadata":{"body":"Become a Sponsor Form<br><br>Name: '.$_REQUEST["name"].' <br> Suname: '.$_REQUEST["surname"].'<br> Phone number: '.$_REQUEST["phone"].' <br> Email: '.$_REQUEST["email"].'<br> Country: '.$_REQUEST["country"].'<br><br> Company: '.$_REQUEST["company"].' <br>Jobtitle: '.$_REQUEST["job"].' <br><br> Event: '.$_REQUEST["event"].'<br> Event Code: '.$_REQUEST["eventCode"].'<br> How did you learn about the event? <br> '.$_REQUEST["learn"].'<br><br> Message:<br>'.$_REQUEST["message"].'"}}';
			curl_setopt( $ch3, CURLOPT_POSTFIELDS, $data3 );
			curl_setopt( $ch3, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			# Return response instead of printing.
			curl_setopt( $ch3, CURLOPT_RETURNTRANSFER, true );
			# Send request.
			$result3 = curl_exec($ch3);
			$finalCheck = json_decode($result3,true);
			$finalCheck = $finalCheck["engagement"]["id"];
			curl_close($ch3);
			if ($finalCheck != null && $finalCheck != "") {
				echo '<br>note Ok!';
			}
			break;
		case 'contact_form':
			// var_dump($_REQUEST);
			$url = "https://api.hubapi.com/contacts/v1/contact/createOrUpdate/email/".$_REQUEST["email"]."/?";
			$ch = curl_init( $url );
			# Setup request to send json via POST.
			$data = '{"properties": [{"property": "firstname","value": "'.$_REQUEST["name"].'"},{"property": "lastname","value": "'.$_REQUEST["surname"].'"},{"property": "company","value": "'.$_REQUEST["company"].'"},{"property": "email","value": "'.$_REQUEST["email"].'"},{"property": "jobtitle","value": "'.$_REQUEST["job"].'"},{"property": "country","value": "'.$_REQUEST["country"].'"},{"property": "phone","value": "'.$_REQUEST["phone"].'"}]}';
			curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
			curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			# Return response instead of printing.
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
			# Send request.
			$result = curl_exec($ch);
			$result = json_decode($result, true);
			$vid = $result["vid"];
			curl_close($ch);
			if ($vid != null && $vid != "") {
				echo 'contact Ok!';
			}
			$url2 = "https://api.hubapi.com/deals/v1/deal/?";
			$ch2 = curl_init( $url2 );
			$data2 = '{"associations":{"associatedVids":['.$vid.']},"properties":[{"value":"'.$month.'.'.$day.' CU '.$_REQUEST["name"].' '.$_REQUEST["surname"].' - '.$_REQUEST["company"].'","name":"dealname"}]}';
			curl_setopt( $ch2, CURLOPT_POSTFIELDS, $data2 );
			curl_setopt( $ch2, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			# Return response instead of printing.
			curl_setopt( $ch2, CURLOPT_RETURNTRANSFER, true );
			# Send request.
			$result2 = curl_exec($ch2);
			$result2 = json_decode($result2, true);
			$vid2 = $result2["dealId"];
			curl_close($ch2);
			if ($vid2 != null && $vid2 != "") {
				echo '<br>deal Ok!';
			}
			$url3 = "https://api.hubapi.com/engagements/v1/engagements?";
			$ch3 = curl_init( $url3 );
			$data3 = '{"engagement":{"active":true,"type":"NOTE"},"associations":{"contactIds":[],"companyIds":[],"dealIds":['.$vid2.'],"ownerIds":[]},"metadata":{"body":"Become a Sponsor Form<br><br>Name: '.$_REQUEST["name"].' <br> Suname: '.$_REQUEST["surname"].'<br> Phone number: '.$_REQUEST["phone"].' <br> Email: '.$_REQUEST["email"].'<br> Country: '.$_REQUEST["country"].'<br><br> Company: '.$_REQUEST["company"].' <br>Jobtitle: '.$_REQUEST["job"].' <br><br> Message:<br>'.$_REQUEST["message"].'"}}';
			curl_setopt( $ch3, CURLOPT_POSTFIELDS, $data3 );
			curl_setopt( $ch3, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			# Return response instead of printing.
			curl_setopt( $ch3, CURLOPT_RETURNTRANSFER, true );
			# Send request.
			$result3 = curl_exec($ch3);
			$finalCheck = json_decode($result3,true);
			$finalCheck = $finalCheck["engagement"]["id"];
			curl_close($ch3);
			if ($finalCheck != null && $finalCheck != "") {
				echo '<br>note Ok!';
			}
			break;
		case 'reg_deal':
			// var_dump($_REQUEST);
			$assistantList = json_decode( html_entity_decode( stripslashes ($_REQUEST["assistantList"]) ), true );
			$url = "https://api.hubapi.com/contacts/v1/contact/createOrUpdate/email/".$_REQUEST["email"]."/?";
			$ch = curl_init( $url );
			# Setup request to send json via POST.
			$data = '{"properties": [{"property": "firstname","value": "'.$_REQUEST["name"].'"},{"property": "lastname","value": "'.$_REQUEST["surname"].'"},{"property": "company","value": "'.$_REQUEST["company"].'"},{"property": "email","value": "'.$_REQUEST["email"].'"},{"property": "jobtitle","value": "'.$_REQUEST["job"].'"},{"property": "country","value": "'.$_REQUEST["country"].'"},{"property": "phone","value": "'.$_REQUEST["countryCode"].' - '.$_REQUEST["phoneNumber"].'"},{"property": "event","value": "'.$_REQUEST["event"].'"}]}';
			curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
			curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			# Return response instead of printing.
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
			# Send request.
			$result = curl_exec($ch);
			$result = json_decode($result, true);
			$vid = $result["vid"];
			curl_close($ch);
			if ($vid != null && $vid != "") {
				echo 'contact Ok!';
			}
			$url2 = "https://api.hubapi.com/deals/v1/deal/?";
			$ch2 = curl_init( $url2 );
			$data2 = '{"associations":{"associatedVids":['.$vid.']},"properties":[{"value":"'.$month.'.'.$day.' '.$_REQUEST["eventCode"].' ID '.$_REQUEST["name"].' '.$_REQUEST["surname"].' - '.$_REQUEST["company"].'","name":"dealname"},{"value":"'.$_REQUEST["eventCode"].'","name":"event"},{"value":"qualifiedtobuy","name":"dealstage"}]}';
			curl_setopt( $ch2, CURLOPT_POSTFIELDS, $data2 );
			curl_setopt( $ch2, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			# Return response instead of printing.
			curl_setopt( $ch2, CURLOPT_RETURNTRANSFER, true );
			# Send request.
			$result2 = curl_exec($ch2);
			$result2 = json_decode($result2, true);
			$vid2 = $result2["dealId"];
			curl_close($ch2);
			if ($vid2 != null && $vid2 != "") {
				echo '<br>deal Ok!';
			}
			$url3 = "https://api.hubapi.com/engagements/v1/engagements?";
			$ch3 = curl_init( $url3 );
			$data3 = '{"engagement":{"active":true,"type":"NOTE"},"associations":{"contactIds":[],"companyIds":[],"dealIds":['.$vid2.'],"ownerIds":[]},"metadata":{"body":"Registration Form<br><br>Name: '.$_REQUEST["name"].' <br> Suname: '.$_REQUEST["surname"].'<br> Phone number: '.$_REQUEST["countryCode"].' - '.$_REQUEST["phoneNumber"].' <br> Email: '.$_REQUEST["email"].'<br> Country: '.$_REQUEST["country"].'<br><br> Company: '.$_REQUEST["company"].' <br>Jobtitle: '.$_REQUEST["job"].'<br> Promo Code: '.$_REQUEST["promoCode"].' <br>Payment Method: '.$_REQUEST["paymentMethod"].'<br>Assistant Number: '.$_REQUEST["assistantNumber"].'<br>Total Payment: '.$_REQUEST["totalPayment"].'<br><br> Event: '.$_REQUEST["event"].'<br> Event Code: '.$_REQUEST["eventCode"].'<br> How did you learn about the event? <br> '.$_REQUEST["learn"].'<br><br> Message:<br>'.$_REQUEST["message"].'"}}';
			curl_setopt( $ch3, CURLOPT_POSTFIELDS, $data3 );
			curl_setopt( $ch3, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			# Return response instead of printing.
			curl_setopt( $ch3, CURLOPT_RETURNTRANSFER, true );
			# Send request.
			$result3 = curl_exec($ch3);
			$finalCheck = json_decode($result3,true);
			$finalCheck = $finalCheck["engagement"]["id"];
			$verified = true;
			if ($finalCheck == null && $finalCheck == "") {
				$verified = false;
			}
			curl_close($ch3);
			$ch3 = curl_init( $url3 );
			$data3 = '{"engagement":{"active":true,"type":"NOTE"},"associations":{"contactIds":[],"companyIds":[],"dealIds":['.$vid2.'],"ownerIds":[]},"metadata":{"body":"Billing Details<br><br>Company: '.$_REQUEST["billingCompany"].' <br>Ticket: '.$_REQUEST["ticketName"].' <br> Address: '.$_REQUEST["billingAddress"].'<br> Tax Identificaton Number: '.$_REQUEST["taxId"].' <br> Billing City: '.$_REQUEST["billingCity"].'<br> State/Province/Region: '.$_REQUEST["billingRegion"].'<br><br> Postal/Zip Code: '.$_REQUEST["zipCode"].' <br>Country: '.$_REQUEST["billingCountry"].'<br> Message: '.$_REQUEST["billingMessage"].'"}}';
			curl_setopt( $ch3, CURLOPT_POSTFIELDS, $data3 );
			curl_setopt( $ch3, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			# Return response instead of printing.
			curl_setopt( $ch3, CURLOPT_RETURNTRANSFER, true );
			# Send request.
			$result3 = curl_exec($ch3);
			$finalCheck = json_decode($result3,true);
			$finalCheck = $finalCheck["engagement"]["id"];
			if ($finalCheck == null && $finalCheck == "") {
				$verified = false;
			}
			curl_close($ch3);
			$i = 1;
			$body = "<b>Registration Details for: ".$_REQUEST["name"]." ".$_REQUEST["surname"]." - ".$_REQUEST["email"]."</b><br><br><br><b>Billing Details:</b><br>Promo Code: ".$_REQUEST["promoCode"]."<br>Payment Method: ".$_REQUEST["paymentMethod"]."<br>Company: ".$_REQUEST["billingCompany"]."<br>Ticket: ".$_REQUEST["ticketName"]." <br>Address: ".$_REQUEST["billingAddress"]."<br>Tax Identificaton Number: ".$_REQUEST["taxId"]." <br>Billing City: ".$_REQUEST["billingCity"]."<br>State/Province/Region: ".$_REQUEST["billingRegion"]."<br>Postal/Zip Code: ".$_REQUEST["zipCode"]." <br>Country: ".$_REQUEST["billingCountry"]."<br>Message: ".$_REQUEST["billingMessage"]."<br><br><b>Purchase Details:</b><br>".$_REQUEST['purchaseDetails']."<br><br>";
			foreach ($assistantList as $assistant) {
				$ch3 = curl_init( $url3 );
				$data3 = '{"engagement":{"active":true,"type":"NOTE"},"associations":{"contactIds":[],"companyIds":[],"dealIds":['.$vid2.'],"ownerIds":[]},"metadata":{"body":"Attendee'.$i.'<br><br>Name: '.$assistant["name"].' <br> Suname: '.$assistant["surname"].'<br> Phone number: '.$assistant["countryCode"].' - '.$assistant["phoneNumber"].' <br> Email: '.$assistant["email"].'<br> Country: '.$assistant["country"].'<br><br> Company: '.$assistant["company"].' <br>Jobtitle: '.$assistant["job"].'<br> Translation: '.$assistant["translation"].'"}}';
				curl_setopt( $ch3, CURLOPT_POSTFIELDS, $data3 );
				curl_setopt( $ch3, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
				# Return response instead of printing.
				curl_setopt( $ch3, CURLOPT_RETURNTRANSFER, true );
				# Send request.
				$result3 = curl_exec($ch3);
				$finalCheck = json_decode($result3,true);
				$finalCheck = $finalCheck["engagement"]["id"];
				if ($finalCheck == null && $finalCheck == "") {
					$verified = false;
				}
				$body.='<b>Attendee '.$i.':</b><br>Name: '.$assistant["name"].' <br> Suname: '.$assistant["surname"].'<br> Phone number: '.$assistant["countryCode"].' - '.$assistant["phoneNumber"].' <br> Email: '.$assistant["email"].'<br> Country: '.$assistant["country"].'<br><br> Company: '.$assistant["company"].' <br>Jobtitle: '.$assistant["job"].'<br> Translation: '.$assistant["translation"].'<br><br>';
				curl_close($ch3);
			}
			$headers = array('Content-Type: text/html; charset=UTF-8');
			$to = "german.huertas@jackleckerman.com";
			$subject = "Register Form Attendees";
			wp_mail( $to, $subject, $body, $headers);
			$to = "biosimilarslatam@jackleckerman.com";
			wp_mail( $to, $subject, $body, $headers);
			$headers = array('Content-Type: text/html; charset=UTF-8; From: "Jackleckerman" <register@jackleckerman.com>\r\n;');
			$to = $_REQUEST['email'];
			$subject = "Succesfully Registered";
			$body = $_REQUEST['emailBody']."<br>".$_REQUEST['purchaseDetails'];
			wp_mail( $to, $subject, $body, $headers);
			if ($verified == true) {
				echo '<br>reg Ok!';
			}
			
			break;
		case 'free_reg':
			// var_dump($_REQUEST);
			$url = "https://api.hubapi.com/contacts/v1/contact/createOrUpdate/email/".$_REQUEST["email"]."/?";
			$ch = curl_init( $url );
			# Setup request to send json via POST.
			$data = '{"properties": [{"property": "firstname","value": "'.$_REQUEST["name"].'"},{"property": "lastname","value": "'.$_REQUEST["surname"].'"},{"property": "company","value": "'.$_REQUEST["company"].'"},{"property": "email","value": "'.$_REQUEST["email"].'"},{"property": "jobtitle","value": "'.$_REQUEST["job"].'"},{"property": "country","value": "'.$_REQUEST["country"].'"},{"property": "phone","value": "'.$_REQUEST["countryCode"].' - '.$_REQUEST["phoneNumber"].'"},{"property": "event","value": "'.$_REQUEST["event"].'"}]}';
			curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
			curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			# Return response instead of printing.
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
			# Send request.
			$result = curl_exec($ch);
			$result = json_decode($result, true);
			$vid = $result["vid"];
			curl_close($ch);
			if ($vid != null && $vid != "") {
				echo 'contact Ok!';
			}
			$url2 = "https://api.hubapi.com/deals/v1/deal/?";
			$ch2 = curl_init( $url2 );
			$data2 = '{"associations":{"associatedVids":['.$vid.']},"properties":[{"value":"'.$month.'.'.$day.' '.$_REQUEST["eventCode"].' ID '.$_REQUEST["name"].' '.$_REQUEST["surname"].' - '.$_REQUEST["company"].'","name":"dealname"},{"value":"'.$_REQUEST["eventCode"].'","name":"event"},{"value":"qualifiedtobuy","name":"dealstage"}]}';
			curl_setopt( $ch2, CURLOPT_POSTFIELDS, $data2 );
			curl_setopt( $ch2, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			# Return response instead of printing.
			curl_setopt( $ch2, CURLOPT_RETURNTRANSFER, true );
			# Send request.
			$result2 = curl_exec($ch2);
			$result2 = json_decode($result2, true);
			$vid2 = $result2["dealId"];
			curl_close($ch2);
			if ($vid2 != null && $vid2 != "") {
				echo '<br>deal Ok!';
			}
			$url3 = "https://api.hubapi.com/engagements/v1/engagements?";
			$ch3 = curl_init( $url3 );
			$data3 = '{"engagement":{"active":true,"type":"NOTE"},"associations":{"contactIds":[],"companyIds":[],"dealIds":['.$vid2.'],"ownerIds":[]},"metadata":{"body":"Free Event Registration Form<br><br>Name: '.$_REQUEST["name"].' <br> Suname: '.$_REQUEST["surname"].'<br> Phone number: '.$_REQUEST["countryCode"].' - '.$_REQUEST["phoneNumber"].' <br> Email: '.$_REQUEST["email"].'<br> Country: '.$_REQUEST["country"].'<br><br> Company: '.$_REQUEST["company"].' <br>Jobtitle: '.$_REQUEST["job"].'<br> Promo Code: '.$_REQUEST["promoCode"].'<br><br> Event: '.$_REQUEST["event"].'<br> Event Code: '.$_REQUEST["eventCode"].'<br> Translation: '.$_REQUEST["translation"].'<br> How did you learn about the event? <br> '.$_REQUEST["learn"].'<br><br> Message:<br>'.$_REQUEST["message"].'"}}';
			curl_setopt( $ch3, CURLOPT_POSTFIELDS, $data3 );
			curl_setopt( $ch3, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			# Return response instead of printing.
			curl_setopt( $ch3, CURLOPT_RETURNTRANSFER, true );
			# Send request.
			$result3 = curl_exec($ch3);
			$finalCheck = json_decode($result3,true);
			$finalCheck = $finalCheck["engagement"]["id"];
			$verified = true;
			if ($finalCheck == null && $finalCheck == "") {
				$verified = false;
			}
			curl_close($ch3);
			if ($verified == true) {
				echo '<br>reg Ok!';
			}
			break;
		case 'virtual_reg':
			// var_dump($_REQUEST);
			$assistantList = json_decode( html_entity_decode( stripslashes ($_REQUEST["assistantList"]) ), true );
			$url = "https://api.hubapi.com/contacts/v1/contact/createOrUpdate/email/".$_REQUEST["email"]."/?";
			$ch = curl_init( $url );
			# Setup request to send json via POST.
			$data = '{"properties": [{"property": "firstname","value": "'.$_REQUEST["name"].'"},{"property": "lastname","value": "'.$_REQUEST["surname"].'"},{"property": "company","value": "'.$_REQUEST["company"].'"},{"property": "email","value": "'.$_REQUEST["email"].'"},{"property": "jobtitle","value": "'.$_REQUEST["job"].'"},{"property": "country","value": "'.$_REQUEST["country"].'"},{"property": "phone","value": "'.$_REQUEST["countryCode"].' - '.$_REQUEST["phoneNumber"].'"},{"property": "event","value": "'.$_REQUEST["event"].'"}]}';
			curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
			curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			# Return response instead of printing.
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
			# Send request.
			$result = curl_exec($ch);
			$result = json_decode($result, true);
			$vid = $result["vid"];
			curl_close($ch);
			if ($vid != null && $vid != "") {
				echo 'contact Ok!';
			}
			$url2 = "https://api.hubapi.com/deals/v1/deal/?";
			$ch2 = curl_init( $url2 );
			$data2 = '{"associations":{"associatedVids":['.$vid.']},"properties":[{"value":"'.$month.'.'.$day.' '.$_REQUEST["eventCode"].' ID '.$_REQUEST["name"].' '.$_REQUEST["surname"].' - '.$_REQUEST["company"].'","name":"dealname"},{"value":"'.$_REQUEST["eventCode"].'","name":"event"},{"value":"qualifiedtobuy","name":"dealstage"}]}';
			curl_setopt( $ch2, CURLOPT_POSTFIELDS, $data2 );
			curl_setopt( $ch2, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			# Return response instead of printing.
			curl_setopt( $ch2, CURLOPT_RETURNTRANSFER, true );
			# Send request.
			$result2 = curl_exec($ch2);
			$result2 = json_decode($result2, true);
			$vid2 = $result2["dealId"];
			curl_close($ch2);
			if ($vid2 != null && $vid2 != "") {
				echo '<br>deal Ok!';
			}
			$url3 = "https://api.hubapi.com/engagements/v1/engagements?";
			$ch3 = curl_init( $url3 );
			$data3 = '{"engagement":{"active":true,"type":"NOTE"},"associations":{"contactIds":[],"companyIds":[],"dealIds":['.$vid2.'],"ownerIds":[]},"metadata":{"body":"Virtual Event Registration Form<br><br>Name: '.$_REQUEST["name"].' <br> Suname: '.$_REQUEST["surname"].'<br> Phone number: '.$_REQUEST["countryCode"].' - '.$_REQUEST["phoneNumber"].' <br> Email: '.$_REQUEST["email"].'<br> Country: '.$_REQUEST["country"].'<br><br> Company: '.$_REQUEST["company"].' <br>Jobtitle: '.$_REQUEST["job"].'<br>Payment Method: '.$_REQUEST["paymentMethod"].'<br>Assistant Number: '.$_REQUEST["assistantNumber"].'<br>Total Payment: '.$_REQUEST["totalPayment"].'<br><br> Event: '.$_REQUEST["event"].'<br> Event Code: '.$_REQUEST["eventCode"].'<br> How did you learn about the event? <br> '.$_REQUEST["learn"].'<br><br> Message:<br>'.$_REQUEST["message"].'"}}';
			curl_setopt( $ch3, CURLOPT_POSTFIELDS, $data3 );
			curl_setopt( $ch3, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			# Return response instead of printing.
			curl_setopt( $ch3, CURLOPT_RETURNTRANSFER, true );
			# Send request.
			$result3 = curl_exec($ch3);
			$finalCheck = json_decode($result3,true);
			$finalCheck = $finalCheck["engagement"]["id"];
			$verified = true;
			if ($finalCheck == null && $finalCheck == "") {
				$verified = false;
			}
			curl_close($ch3);
			$i = 1;
			$body = "<b>(Virtual Event) Attendees Registered for: ".$_REQUEST["name"]." ".$_REQUEST["surname"]." - ".$_REQUEST["email"]."</b><br><br><br>";
			foreach ($assistantList as $assistant) {
				$ch3 = curl_init( $url3 );
				$data3 = '{"engagement":{"active":true,"type":"NOTE"},"associations":{"contactIds":[],"companyIds":[],"dealIds":['.$vid2.'],"ownerIds":[]},"metadata":{"body":"Attendee'.$i.'<br><br>Name: '.$assistant["name"].' <br> Suname: '.$assistant["surname"].'<br> Phone number: '.$assistant["countryCode"].' - '.$assistant["phoneNumber"].' <br> Email: '.$assistant["email"].'<br> Country: '.$assistant["country"].'<br><br> Company: '.$assistant["company"].' <br>Jobtitle: '.$assistant["job"].'"}}';
				curl_setopt( $ch3, CURLOPT_POSTFIELDS, $data3 );
				curl_setopt( $ch3, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
				# Return response instead of printing.
				curl_setopt( $ch3, CURLOPT_RETURNTRANSFER, true );
				# Send request.
				$result3 = curl_exec($ch3);
				$finalCheck = json_decode($result3,true);
				$finalCheck = $finalCheck["engagement"]["id"];
				if ($finalCheck == null && $finalCheck == "") {
					$verified = false;
				}
				$body.='<b>Attendee '.$i.':</b><br>Name: '.$assistant["name"].' <br> Suname: '.$assistant["surname"].'<br> Phone number: '.$assistant["countryCode"].' - '.$assistant["phoneNumber"].' <br> Email: '.$assistant["email"].'<br> Country: '.$assistant["country"].'<br><br> Company: '.$assistant["company"].' <br>Jobtitle: '.$assistant["job"].'<br><br>';
				curl_close($ch3);
			}
			$headers = array('Content-Type: text/html; charset=UTF-8');
			$to = "german.huertas@jackleckerman.com";
			$subject = "Virtual Event Register Form Attendees";
			wp_mail( $to, $subject, $body, $headers);

			if ($verified == true) {
				echo '<br>reg Ok!';
			}
			break;
		case 'mem_reg':
			// var_dump($_REQUEST);
			$url = "https://api.hubapi.com/contacts/v1/contact/createOrUpdate/email/".$_REQUEST["email"]."/?";
			$ch = curl_init( $url );
			# Setup request to send json via POST.
			$data = '{"properties": [{"property": "firstname","value": "'.$_REQUEST["name"].'"},{"property": "lastname","value": "'.$_REQUEST["surname"].'"},{"property": "company","value": "'.$_REQUEST["company"].'"},{"property": "email","value": "'.$_REQUEST["email"].'"},{"property": "jobtitle","value": "'.$_REQUEST["job"].'"},{"property": "country","value": "'.$_REQUEST["country"].'"},{"property": "phone","value": "'.$_REQUEST["phone"].'"},{"property": "event","value": "'.$_REQUEST["event"].'"}]}';
			curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
			curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			# Return response instead of printing.
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
			# Send request.
			$result = curl_exec($ch);
			$result = json_decode($result, true);
			$vid = $result["vid"];
			curl_close($ch);
			if ($vid != null && $vid != "") {
				echo 'contact Ok!';
			}
			$url2 = "https://api.hubapi.com/deals/v1/deal/?";
			$ch2 = curl_init( $url2 );
			$data2 = '{"associations":{"associatedVids":['.$vid.']},"properties":[{"value":"'.$month.'.'.$day.' '.$_REQUEST["eventCode"].' MS '.$_REQUEST["name"].' '.$_REQUEST["surname"].' - '.$_REQUEST["company"].'","name":"dealname"},{"value":"'.$_REQUEST["eventCode"].'","name":"event"},{"value":"qualifiedtobuy","name":"dealstage"}]}';
			curl_setopt( $ch2, CURLOPT_POSTFIELDS, $data2 );
			curl_setopt( $ch2, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			# Return response instead of printing.
			curl_setopt( $ch2, CURLOPT_RETURNTRANSFER, true );
			# Send request.
			$result2 = curl_exec($ch2);
			$result2 = json_decode($result2, true);
			$vid2 = $result2["dealId"];
			curl_close($ch2);
			if ($vid2 != null && $vid2 != "") {
				echo '<br>deal Ok!';
			}
			$url3 = "https://api.hubapi.com/engagements/v1/engagements?";
			$ch3 = curl_init( $url3 );
			$data3 = '{"engagement":{"active":true,"type":"NOTE"},"associations":{"contactIds":[],"companyIds":[],"dealIds":['.$vid2.'],"ownerIds":[]},"metadata":{"body":"Membership Form<br><br>Name: '.$_REQUEST["name"].' <br> Suname: '.$_REQUEST["surname"].'<br> Phone number: '.$_REQUEST["phone"].' <br> Email: '.$_REQUEST["email"].'<br> Country: '.$_REQUEST["country"].'<br><br> Company: '.$_REQUEST["company"].' <br>Jobtitle: '.$_REQUEST["job"].' <br>Payment Method: '.$_REQUEST["payment"].'<br><br> Event: '.$_REQUEST["event"].'<br> Event Code: '.$_REQUEST["eventCode"].'<br> How did you learn about the event? <br> '.$_REQUEST["learn"].'<br><br> Message:<br>'.$_REQUEST["message"].'"}}';
			curl_setopt( $ch3, CURLOPT_POSTFIELDS, $data3 );
			curl_setopt( $ch3, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			# Return response instead of printing.
			curl_setopt( $ch3, CURLOPT_RETURNTRANSFER, true );
			# Send request.
			$result3 = curl_exec($ch3);
			$finalCheck = json_decode($result3,true);
			$finalCheck = $finalCheck["engagement"]["id"];
			curl_close($ch3);
			if ($finalCheck != null && $finalCheck != "") {
				echo '<br>note Ok!';
			}
			break;
		case 'return_user_data':
			echo json_encode($_SESSION);
			break;
		default:
			// code...
			break;
	}
}else{
	throw new Exception('Method not allowed');
}