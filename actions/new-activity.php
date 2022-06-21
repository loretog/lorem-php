<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); 

if( isset( $_POST ) ) {

	if( add_record( "activities", $_POST[ 'data' ] ) ) {
        set_message( "Activity has been added.", "success" );
    } else {
        set_message( "Activity to add Topic.", "danger" );
    }
    redirect( "activities" );
}	    