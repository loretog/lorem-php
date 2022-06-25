<?php 
	if( !empty( $_POST[ 'email' ] ) && !empty( $_POST[ 'password' ] ) ) {
		$email = $_POST[ 'email' ];
		$password = md5( $_POST[ 'password' ] );
		$q = "SELECT * FROM users WHERE email = '$email' AND password = '$password' LIMIT 1";		
		$check = $DB->query( $q );

		if( $check && $check->num_rows ) {
			$user = $check->fetch_assoc();			
			if( $user[ 'status' ] == 0 ) {
				set_message( "Your account is not yet activated." . $DB->error, "danger" );
				redirect( LOGIN_REDIRECT );
			}
			$_SESSION[ AUTH_ID ] = $user[ 'userid' ];
			$_SESSION[ AUTH_NAME ] = $user[ 'username' ];			
			$_SESSION[ AUTH_EMAIL ] = $user[ 'email' ];
			$_SESSION[ AUTH_TYPE ] = $user[ 'usertype' ];
			set_message( "Welcome back {$user[ 'usertype' ]}!", 'success' );
			redirect();		
		} else {		
			set_message( "Invalid login, please try again." . $DB->error, "danger" );
		}
	} else {		
		set_message( "You must specify the username and password." . $DB->error, "danger" );
	}