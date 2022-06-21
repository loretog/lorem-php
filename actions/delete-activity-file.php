<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); 

if( isset( $_GET[ 'activityid' ] ) && isset( $_GET[ 'activityfileid' ] ) ) {
    $file = $DB->query( "SELECT * FROM activityfiles" );
	if( delete_record( "activityfiles", "activityfilesid", $_GET[ 'activityfileid' ] ) ) {
        set_message( "File has been deleted.", "success" );
    } else {
        set_message( "Failed to file Activity. " . $DB->error, "danger" );
    }
    redirect( "view-activity&id=" . $_GET[ 'activityid' ] );
}	    