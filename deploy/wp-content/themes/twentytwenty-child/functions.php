<?php

/*  Enqueue scripts and style from parent theme
    See: https://kinsta.com/blog/twenty-twenty-theme/#child-theming
*/
function twentytwenty_styles() {
	wp_enqueue_style( 'parent', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'twentytwenty_styles');
