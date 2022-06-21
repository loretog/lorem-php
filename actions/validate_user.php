<?php 

	$email = $_POST[ 'email' ];
	$password = md5( $_POST[ 'password' ] );
	$q = "SELECT * FROM users WHERE email = '$email' AND password = '$password' LIMIT 1";
	$check = $DB->query( $q );

	if( $check && $check->num_rows ) {
		$user = $check->fetch_assoc();
		$_SESSION[ AUTH_ID ] = $user[ 'userid' ];
		$_SESSION[ AUTH_NAME ] = $user[ 'email' ];
		$_SESSION[ AUTH_TYPE ] = $user[ 'usertype' ];
		set_message( "Welcome back {$user[ 'usertype' ]}!", 'success' );
		redirect();		
	} else {		
		set_message( "Invalid login, please try again." . $DB->error, "danger" );
	}