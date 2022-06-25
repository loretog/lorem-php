<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); 

if( isset( $_POST[ 'data' ] ) ) {
    if( isset($_POST[ 'data' ][ 'password' ]) && !empty($_POST[ 'data' ][ 'password' ]) ) {
        $_POST[ 'data' ][ 'password' ] = md5($_POST[ 'data' ][ 'password' ]);
    }  else {
        unset($_POST[ 'data' ][ 'password' ]);
    }
	if( update_record( "users", [ "key" => "userid", "val" => $_POST[ 'data' ][ 'userid' ] ], $_POST[ 'data' ] ) ) {
        set_message( "Profile has been updated.", "success" );
    } else {
        set_message( "Failed to update profile.", "danger" );
    }
    redirect( "profile" );
}	    