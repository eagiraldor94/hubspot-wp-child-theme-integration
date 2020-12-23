<?php
/*================================================
Session Start
================================================*/
function jack_init_session() {
  session_start();
}
add_action('init', 'jack_init_session', 1);

/*================================================
Session Destroy
================================================*/
function jack_destroy_session() {
    session_destroy();
}
add_action( 'wp_logout', 'jack_destroy_session' );

/*================================================
Login get Info and redirect
================================================*/
function jack_login_redirect( $redirect_to, $request, $user ) {
    //is there a user to check?
    if ( isset( $user->roles ) && is_array( $user->roles ) ) {
        //check for admins
		$url = "https://api.hubapi.com/contacts/v1/contact/email/".$user->user_email."/profile?";
		$ch = curl_init( $url );
		# Return response instead of printing.
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		# Send request.
		$result = curl_exec($ch);
		$result = json_decode($result, true);
		curl_close($ch);
        if ( in_array( 'administrator', $user->roles ) ) {
            // redirect them to the default place
            return $redirect_to;
        } else {
			if (isset($result["properties"])) {
				$result = $result["properties"];
				$_SESSION["name"] = $result["firstname"]["value"];
				$_SESSION["surname"] = $result["lastname"]["value"];
				$_SESSION["company"] = $result["company"]["value"];
				$_SESSION["job"] = $result["jobtitle"]["value"];
				$_SESSION["email"] = $result["email"]["value"];
				$_SESSION["country"] = $result["country"]["value"];
				$_SESSION["member_codes"] = explode(";", $result["member_codes"]["value"]);
				$_SESSION["member_links"] = explode(";", $result["member_links"]["value"]);
				$_SESSION["member_texts"] = explode(";", $result["member_texts"]["value"]);
			}
            return home_url('/my-content');
        }
    } else {
        return $redirect_to;
    }
}
add_filter( 'login_redirect', 'jack_login_redirect', 10, 3 );

/*================================================
#1 Load parent Styles
================================================*/
function dc_enqueue_styles() {
	wp_enqueue_style( 'divi-parent', get_template_directory_uri() . '/style.css');
}
add_action( 'wp_enqueue_scripts', 'dc_enqueue_styles' );
function wpc_remove_height_cropping($height) {
	return '9999';
}
function wpc_remove_width_cropping($width) {
	return '9999';
}

add_filter( 'et_pb_blog_image_height', 'wpc_remove_height_cropping' );
add_filter( 'et_pb_blog_image_width', 'wpc_remove_width_cropping' );

/*=============================================
= 	Proper ob_end_flush() for all levels      =
=============================================*/
remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );
add_action( 'shutdown', function() {
   while ( @ob_end_flush() );
} );

/*=============================
=  	  Content restriction      =
=============================*/
function restricted_jack_content( $content ) {

    if( !is_admin() && is_main_query()){
    	$user = wp_get_current_user();
		global $post;
		if (isset(get_post_custom($post->id)["restricted"][0])){
    		if (get_post_custom($post->id)["restricted"][0] == "true"){
    			if (is_user_logged_in()) {
    				if (!in_array( 'administrator', (array) $user->roles )) {
		    			if (isset(get_post_custom($post->id)["event_code"][0])){
			    			$eventCode = get_post_custom($post->id)["event_code"][0];
			    			$authorized = false;
			    			foreach ($_SESSION["member_codes"] as $code) {
			    				if ($eventCode == $code) {
			    					$authorized = true;
			    				}
			    			}
			    			if ($authorized == true) {
			    				return $content;
			    			}else{
		    					wp_redirect(home_url());
			    			}
			    		}else{
			    			wp_redirect(home_url());
			    		}
			    	}else{
			    		return $content;
			    	}
	    		}else{
	    			wp_redirect(home_url());
	    		}
    		}else {
    			return $content;
    		}
    		
    	}else {
    		return $content;
    	}
    }

}
add_filter( 'the_content', 'restricted_jack_content' );

