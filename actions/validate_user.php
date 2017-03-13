<?php 

	$username = $_POST[ 'username' ];
	$password = md5( $_POST[ 'password' ] );

	if( $DB->query( "SELECT * FROM users WHERE username = '$username' AND password = '$password'" ) ) {
		
	}