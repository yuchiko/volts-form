<?php
/**
 * Plugin Name:         Consumption Form
 * Plugin URI:          https://google.com
 * Description:         Consumption Form for Volts
 * Version:             1.0.0
 * Author:              Yuriy Byts (MDVS.pro)
 * Author URI:          https://mdvs.pro
 * 
 */

//  Change on each build
function load_vuescripts() {
    wp_enqueue_style( 'vue_wp_styles', plugin_dir_url( __FILE__ ) . 'dist/css/app.9d1bbfc1.css' );
    wp_enqueue_style( 'vue_wp_styles_vendors', plugin_dir_url( __FILE__ ) . 'dist/css/chunk-vendors.a0490ac9.css' );

    wp_register_script( 'vue_wp_compiled', plugin_dir_url( __FILE__ ) . 'dist/js/app.e4eecc58.js', true );
    wp_register_script( 'vue_wp_dependencies', plugin_dir_url( __FILE__ ) . 'dist/js/chunk-vendors.d923bbbc.js', true );
}

add_action( 'wp_enqueue_scripts', 'load_vuescripts' );

function attach_vue() {
    wp_enqueue_script( 'vue_wp_compiled' );
    wp_enqueue_script( 'vue_wp_dependencies' );

    return "<div id='app'></div>";
}

add_shortcode( 'vue_volts_form', 'attach_vue' );

// Add the shortcode [vue_volts_form] to any page or post.
// The shorcode can be whatever. [vue_volts_form] is just an example.
?>