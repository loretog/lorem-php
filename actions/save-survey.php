<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' );

if( add_record( "surveys", $_POST[ 'data' ]) )
    set_message( "Thank you for answering our surveys!", "success" );
else
set_message( "Apologize! Something went wrong, please try again.", "danger" );