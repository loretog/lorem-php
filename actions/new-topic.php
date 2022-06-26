<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); 

if( isset( $_POST ) ) {

	if( add_record( "topics", $_POST[ 'data' ] ) ) {
        set_message( "Topic has been added.", "success" );
    } else {
        set_message( "Failed to add Topic.", "danger" );
    }
    redirect( "topics" );
}	    