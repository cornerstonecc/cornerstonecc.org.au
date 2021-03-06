<?php

/**
 * Enqueue scripts and style from parent theme
 *
 * See: https://kinsta.com/blog/twenty-twenty-theme/#child-theming
 */
function twentytwenty_styles() {
	wp_enqueue_style( 'parent', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'twentytwenty_styles');


/**
 * Include Dashicons for non-logged in users
 */
function load_dashicons(){
    wp_enqueue_style('dashicons');
}
add_action('wp_enqueue_scripts', 'load_dashicons');


/**
 * Add custom transpiled JS found in the ./build/ folder
 */
function add_transpiled_js() {
    wp_enqueue_script( 'script', get_stylesheet_directory_uri() . '/build/index.js');
}
add_action( 'wp_enqueue_scripts', 'add_transpiled_js');


/**
 * Include `.template-cover` class on homepage.
 *
 * Apply the default styles of "template-cover.php" to our lightly modified
 * "templates/template-homepage.php" by including the ".template-cover"
 * class.
 */
function add_custom_body_class( $classes ) {
    if ( is_page_template( 'templates/template-homepage.php' ) ) {
        $classes[] = 'template-cover';
    }

    return $classes;
}
add_filter( 'body_class', 'add_custom_body_class' );
