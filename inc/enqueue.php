<?php
/** 
 * Enqueue IMN scripts and styles.
 */
function imn_scripts_and_styles() {
    wp_enqueue_style( 'spectra-style', get_template_directory_uri() . '/style.css' ); // Loads Spectra CSS.
    wp_enqueue_style( 'imn-style', get_stylesheet_directory_uri() . '/css/imn.css' ); // Loads IMN CSS.
}

add_action( 'wp_enqueue_scripts', 'imn_scripts_and_styles' );