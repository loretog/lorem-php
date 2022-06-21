<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); 

if( isset( $_POST[ 'data' ] ) ) {

	if( update_record( "topics", [ "key" => "topicid", "val" => $_POST[ 'id' ] ], $_POST[ 'data' ] ) ) {
        set_message( "Topic has been updated.", "success" );
    } else {
        set_message( "Failed to update Topic.", "danger" );
    }
    redirect( "topics" );
}	    