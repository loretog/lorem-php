<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); 

if( isset( $_POST ) ) {
    $_POST['data']['password'] = md5($_POST['data']['password']);
    $_POST['data']['usertype'] = "student";
	if( add_record( "users", $_POST[ 'data' ] ) ) {
        set_message( "Thank you for your registration.", "success" );
    } else {
        set_message( "Failed register.", "danger" );
    }
    redirect( "default" );
}	    