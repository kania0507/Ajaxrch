<?php 
/**
 * Plugin Name: Ajaxrch
 * Plugin URI: 
 * Description: Plugin AJAX Search
 * Version: 1.0.0
 * Author: AKC
 * Author URI: 
 * License: GPL2
 */
 
add_action( 'wp_enqueue_scripts', 'ajax_test_enqueue_scripts' );
function ajax_test_enqueue_scripts() {
	wp_enqueue_script( 'ajax', plugins_url( '/ajax.js', __FILE__ ), array('jquery'), '1.0', true );
}