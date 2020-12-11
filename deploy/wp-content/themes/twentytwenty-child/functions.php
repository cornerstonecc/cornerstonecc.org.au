<?php

/*  Enqueue scripts and style from parent theme
    See: https://kinsta.com/blog/twenty-twenty-theme/#child-theming
*/
function twentytwenty_styles() {
	wp_enqueue_style( 'parent', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'twentytwenty_styles');


/*  Add custom transpiled JS found in the ./build/ folder
*/
function add_transpiled_js() {
    wp_enqueue_script( 'script', get_stylesheet_directory_uri() . '/build/index.js');
}
add_action( 'wp_enqueue_scripts', 'add_transpiled_js');


/*  Apply the default styles of "template-cover.php" to our lightly modified
    "templates/template-homepage.php" by including the ".template-cover"
    class.
*/
function add_custom_body_class( $classes ) {
    if ( is_page_template( 'templates/template-homepage.php' ) ) {
        $classes[] = 'template-cover';
    }

    return $classes;
}
add_filter( 'body_class', 'add_custom_body_class' );


/*  Add homepage text option to Customizer

*/
// function create_homepage_customizer_options( $wp_customize ) {
//     $wp_customize->add_section( 'custom_css', array(
//         'title' => __( 'Custom CSS!' ),
//         'description' => __( 'Add custom CSS here' ),
//         'panel' => '', // Not typically needed.
//         'priority' => 160,
//         'capability' => 'edit_theme_options',
//         'theme_supports' => '', // Rarely needed.
//     ) );
// }
// add_action( 'customize_register', 'create_homepage_customizer_options');
