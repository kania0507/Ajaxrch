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

add_action( 'wp_enqueue_scripts', 'ajax_enqueue_scripts' );
function ajax_enqueue_scripts() {
	wp_enqueue_script( 'myajax', plugins_url( '/ajaxrch.js', __FILE__ ), array('jquery'), '1.0', true );
	
	wp_localize_script( 'myajax', 'admajax', array(
		'ajax_url' => admin_url( 'admin-ajax.php' )
	));	
		
	wp_enqueue_style( 'myajax_css', plugins_url( '/style.css', __FILE__ ) ); 		
} 

function my_search_form( $form ) { 
    $form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
    <div><label class="screen-reader-text" for="s">' . __( 'Search for:' ) . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" class="search-field"  />	
    </div>	
    </form><div id="ajax-result"></div>';
    return $form;
}
add_filter( 'get_search_form', 'my_search_form', 100 );


add_action("wp_ajax_get_result_ajax","get_result_ajax");
add_action("wp_ajax_nopriv_get_result_ajax","get_result_ajax");
function get_result_ajax(){		
	$value  = $_POST['s'];
	$output = "<div><ul>";
	$args = array(
		's'  => $value,
		'post_type'=>'post'
	);
	
	$wp_query = new WP_Query($args);
	if($wp_query->have_posts()):
		while ($wp_query->have_posts()) : $wp_query->the_post();
    
			$output .="<li><a href='".get_permalink()."'>".get_the_title()."</a></li>";

		endwhile;
		
    endif;
    wp_reset_query();   
	
	$output .= "</ul></div>";
	echo $output;
			
	wp_die(); 	
}