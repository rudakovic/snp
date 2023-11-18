<?php

/*
@package ur_theme_bgnocnipolumaraton

	==========================
    FRONT-END MUST-LOADS FILES
	==========================
*/

function ur_load_scripts(){
	wp_enqueue_style( 'slick', get_template_directory_uri() . '/css/slick.css', array(), '1.8.1', 'all' );
	wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/css/slick-theme.css', array(), '1.8.1', 'all' );
	wp_enqueue_style( 'style', get_template_directory_uri() . '/css/style.css', array(), '1.0.1', 'all' );

	wp_enqueue_style( 'monserrat', 'https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,700,800,900&display=swap' );
	wp_enqueue_style( 'dashicons' );




	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery' , get_template_directory_uri() . '/js/jquery-3.4.1.min.js', false, '3.3.1', true );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'slick', get_template_directory_uri() . '/js/slick.js', array(), '1.0.0', true );

	wp_enqueue_script( 'video', get_template_directory_uri() . '/js/video.js', array(), '1.0.1', true );

	wp_localize_script( 'video', 'dateOfEvent', get_field( 'datum', 10 ));


}
add_action( 'wp_enqueue_scripts', 'ur_load_scripts' );


function load_custom_wp_admin_style() {

	wp_enqueue_style('wp-admin-style', get_template_directory_uri() . '/css/wp-admin-style.css', array(), '1.0.0', 'all');


}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );

function inserting_favicon(){


	$favicon_url = get_field( 'favicon', 10 );
	echo '<link rel="shortcut icon" href="' . $favicon_url . '" />';

}
add_action('admin_head', 'inserting_favicon');
add_action('login_head', 'inserting_favicon');



function ur_add_admin_page() {

	add_menu_page('Welcome', 'Welcome', 'edit_posts', 'home_page', 'ur_theme_create_page', 'dashicons-welcome-widgets-menus', 2 );


}
add_action( 'admin_menu', 'ur_add_admin_page' );

function ur_theme_create_page() {
	//mainSub
	require_once(get_template_directory() . '/inc/bgnocniadmin.php');
}