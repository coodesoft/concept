<?php

$directorio = dirname( __FILE__ );
require_once $directorio.'/includes/helpers.php';
require_once $directorio.'/includes/render.php';
require_once $directorio.'/customize/index.php';

//##############################################################################
// Scripts correspondientes al tema
//##############################################################################
wp_register_script('jquery_coode', get_stylesheet_directory_uri().'/js/jquery-3.2.1.min.js', [], false, true );
wp_register_script('popper', get_stylesheet_directory_uri().'/js/popper.min.js', ['jquery_coode'], false, true );
wp_register_script('bootstrap', get_stylesheet_directory_uri().'/js/bootstrap.min.js', ['jquery_coode'], false, true );
wp_register_script('fontawesome-all', get_stylesheet_directory_uri().'/js/fontawesome-all.js', [], false, false );
wp_register_script('coode', get_stylesheet_directory_uri().'/js/style.js', ['jquery_coode'], false, true );

function add_scripts_front(){
    //wp_enqueue_script( 'jquery ');
    wp_enqueue_script( 'popper' );
    wp_enqueue_script( 'bootstrap' );
    wp_enqueue_script( 'fontawesome-all' );
    wp_enqueue_script( 'coode' );

}
add_action( 'wp_footer', 'add_scripts_front' );

add_theme_support( 'post-thumbnails' );
