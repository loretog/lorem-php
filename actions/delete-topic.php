<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); 

if( isset( $_GET[ 'id' ] ) ) {

	if( delete_record( "topics", "topicid", $_GET[ 'id' ] ) ) {
        set_message( "Topic has been deleted.", "success" );
    } else {
        set_message( "Failed to delete Topic.", "danger" );
    }
    redirect( "topics" );
}	    