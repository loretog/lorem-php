<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); 

if( isset( $_POST[ 'data' ] ) ) {

	if( update_record( "todolist", [ "key" => "todoid", "val" => $_POST[ 'id' ] ], $_POST[ 'data' ] ) ) {
        set_message( "To-do has been updated.", "success" );
    } else {
        set_message( "Failed to update To-do.", "danger" );
    }
    redirect( "to-do-list" );
}	    