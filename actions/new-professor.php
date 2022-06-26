<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); 

if( isset( $_POST ) ) {
    $_POST[ 'data' ][ 'password' ] = md5( $_POST[ 'data' ][ 'password' ] );
	if( add_record( "users", $_POST[ 'data' ] ) ) {
        set_message( "Professor has been added.", "success" );
    } else {
        set_message( "Failed to add Professor." . $DB->error, "danger" );
    }
    redirect( "new-professor" );
}	    