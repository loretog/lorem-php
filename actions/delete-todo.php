<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); 

if( isset( $_GET[ 'id' ] ) ) {

	if( delete_record( "todolist", "todoid", $_GET[ 'id' ] ) ) {
        set_message( "To-do has been deleted.", "success" );
    } else {
        set_message( "Failed to delete To-do.", "danger" );
    }
    redirect( "to-do-list" );
}	    