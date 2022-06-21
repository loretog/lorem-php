<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); 

if( isset( $_POST[ 'data' ] ) ) {

	if( update_record( "activities", [ "key" => "activityid", "val" => $_POST[ 'id' ] ], $_POST[ 'data' ] ) ) {
        set_message( "Activity has been updated.", "success" );
    } else {
        set_message( "Failed to update Activity.", "danger" );
    }
    redirect( "activities" );
}	    