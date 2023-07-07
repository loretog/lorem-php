<?php

/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are connected within corresponding "menu navigation" which
| assigned in every "pages" group. Now create more routes!
|
*/

if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' );

if (!function_exists('generate_menu_link')) {
    function generate_menu_link($current_url, $menu_url, $default_link) {
        if (strpos($current_url, $menu_url) !== false) {
            return $current_url;
        } else {
            return $default_link;
        }
    }
}

$current_url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

/* Dashboard */
$home_url = '/home/dashboard';
$home_link = (strpos($current_url, $home_url) !== false) ? $current_url : '../home/dashboard';
