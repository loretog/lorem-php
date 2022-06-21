<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); 

if( isset( $_GET[ 'id' ] ) ) {

	if( delete_record( "activities", "activityid", $_GET[ 'id' ] ) ) {
        set_message( "Activity has been deleted.", "success" );
    } else {
        set_message( "Failed to delete Activity.", "danger" );
    }
    redirect( "activities" );
}	    