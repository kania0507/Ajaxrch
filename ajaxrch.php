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
 
 /*
 add_filter('template_include','my_custom_search_template');

function my_custom_search_template($template){
    global $wp_query;
    if ($wp_query->is_search || $wp_query->found_posts>0)
        return $template;

    return dirname( __FILE__ ) . '/my_search_template.php';

}
*/ 



//add_action( 'wp_enqueue_scripts', 'ajax_enqueue_scripts' );

function ajax_enqueue_scripts() {
	
	
	wp_localize_script( 'admajax', 'admajax', array(
		'ajax_url' => admin_url( 'admin-ajax.php' )
	));
	wp_enqueue_script( 'admajax' );
	
	wp_enqueue_script( 'myajax', plugins_url( '/ajax.js', __FILE__ ), array('jquery'), '1.0', true );
	
	wp_enqueue_style( 'myajax_css', plugins_url( '/style.css', __FILE__ ) ); 
	
	
} 


function my_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
    <div><label class="screen-reader-text" for="s">' . __( 'Search for:' ) . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" class="search-field"  />
	
    </div>
	
    </form><div id="ajax-result"></div>';
 //<!--<input type="submit" id="searchsubmit" value="'. esc_attr__( 'Search' ) .'" />	-->
    return $form;
}

add_filter( 'get_search_form', 'my_search_form', 100 );


function get_result_ajax(){
	
	//if (has_action('ajax_enqueue_scripts')===false)
	add_action( 'wp_enqueue_scripts', 'ajax_enqueue_scripts' );
	
	//$value  = esc_attr($_POST['s']);
	$value  = $_POST['s'];
	$output = "<ul>";

	$args = array(
		's'  => $value
//        'posts_per_page'=>-1,
//		'post_type'=>'post'
//		'post_status' => 'publish'
	);
	
	$wp_query = new WP_Query($args);
	if($wp_query->have_posts()):
		while ($wp_query->have_posts()) : $wp_query->the_post();
    
			$output .="<li><a href='".get_permalink()."'>".get_the_title()."</a></li>";

		endwhile;
		
	//else:
	//	echo "No results";
	wp_reset_query();
   endif;
   
   
	
	$output .= "</ul> dupa";
	echo $output;
	return $output;
	//if (is_search() && $wp_query->found_posts>0){
		//return $output;
	//die();
	//}
}
add_action("wp_ajax_get_result_ajax","get_result_ajax");
add_action("wp_ajax_nopriv_get_result_ajax","get_result_ajax");

