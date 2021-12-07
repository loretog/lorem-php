<?php 

	$email = $_POST[ 'username' ];
	$password = md5( $_POST[ 'password' ] );
	$q = "SELECT * FROM users WHERE email = '$email' AND password = '$password' LIMIT 1";
	$check = $DB->query( $q );

	if( $check->num_rows ) {
		$user = $check->fetch_assoc();
		$approved = $user[ 'approved' ];
		if( $approved ) {
			$_SESSION[ AUTH_ID ] = $user[ 'userid' ];
			$_SESSION[ AUTH_NAME ] = $user[ 'email' ];
			$_SESSION[ AUTH_TYPE ] = $user[ 'usertype' ];
			set_message( "Welcome back {$user[ 'usertype' ]}!", 'success' );
			redirect( $restricted_pages[ $_SESSION[ AUTH_TYPE ] ][ 'default_page' ] );
		} else {
			set_message( "Your account hasn't been approved yet.", 'warning' );
		}
	} else {		
		set_message( "Invalid login, please try again." . $DB->error, "danger" );
	}