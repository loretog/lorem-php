<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); 

if( isset( $_GET[ 'stat' ] ) ) {
    $data = [ 'status' => $_GET[ 'stat' ] ];
	if( update_record( "users", [ "key" => "userid", "val" => $_GET[ 'id' ] ], $data ) ) {
        set_message( "Professor status updated.", "success" );
    } else {
        set_message( "Failed to update Professor status.", "danger" );
    }
    redirect( "professors" );
}	    