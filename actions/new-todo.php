<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); 

if( isset( $_POST ) ) {

	if( add_record( "todolist", $_POST[ 'data' ] ) ) {
        set_message( "To-do has been added.", "success" );
    } else {
        set_message( "Failed to add To-do.", "danger" );
    }
    redirect( "to-do-list" );
}	    