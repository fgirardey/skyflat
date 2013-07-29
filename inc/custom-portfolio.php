<?php

add_action( 'init', 'skyflat_register_portfolio' );
function skyflat_register_portfolio() {
	skyflat_register_portfolio_post();
	skyflat_portfolio_taxonomy();
}

function skyflat_register_portfolio_post() {

   /**
	* Register a custom post type for home page
	*
	* Supplied is a "reasonable" list of defaults
	* @see register_post_type for full list of options for register_post_type
	* @see add_post_type_support for full descriptions of 'supports' options
	* @see get_post_type_capabilities for full list of available fine grained capabilities that are supported
	*/

	$labels = array(
		'name' => __('Portfolio Projects'),
		'singular_name' => __('Portfolio Project'),
		'add_new' => __('Add New'),
		'add_new_item' => __('Add New Portfolio Project'),
		'edit_item' => __('Edit Portfolio Project'),
		'new_item' => __('New Portfolio Project'),
		'all_items' => __('All Portfolio Project'),
		'view_item' => __('View Portfolio Project'),
		'search_items' => __('Search Portfolio Project'),
		'not_found' =>  __('No Portfolio Project found'),
		'not_found_in_trash' => __('No Portfolio Projects found in Trash'), 
		'parent_item_colon' => '',
		'menu_name' => __('Portfolio Projects')
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => array( 'slug' => 'portfolio' ),
		'capability_type' => 'post',
		'has_archive' => true, 
		'hierarchical' => false,
		'menu_position' => 5,
		'supports' => array( 'title', 'editor', 'author', 'thumbnail' )
	); 
	register_post_type( 'portfolio', $args );
}

// Register Custom Taxonomy
function skyflat_portfolio_taxonomy()  {

	$labels = array(
		'name'                       => _x( 'Technologies', 'Taxonomy General Name', 'skyflat' ),
		'singular_name'              => _x( 'Technologie', 'Taxonomy Singular Name', 'skyflat' ),
		'menu_name'                  => __( 'Technology', 'skyflat' ),
		'all_items'                  => __( 'All Technologies', 'skyflat' ),
		'parent_item'                => __( 'Parent Technology', 'skyflat' ),
		'parent_item_colon'          => __( 'Parent Technology:', 'skyflat' ),
		'new_item_name'              => __( 'New Technology Name', 'skyflat' ),
		'add_new_item'               => __( 'Add New Technology', 'skyflat' ),
		'edit_item'                  => __( 'Edit Technology', 'skyflat' ),
		'update_item'                => __( 'Update Technology', 'skyflat' ),
		'separate_items_with_commas' => __( 'Separate technology with commas', 'skyflat' ),
		'search_items'               => __( 'Search technology', 'skyflat' ),
		'add_or_remove_items'        => __( 'Add or remove technologies', 'skyflat' ),
		'choose_from_most_used'      => __( 'Choose from the most used technologies', 'skyflat' ),
	);
	$args = array(
		'labels'					=> $labels,
		'hierarchical'				=> true,
		'public'					=> true,
		'show_ui'					=> true,
		'show_admin_column'			=> true,
		'show_tagcloud'				=> true,
		'query_var'					=> 'techno',
		'rewrite'					=> array( 'slug' => 'portfolio'),
	);
	register_taxonomy( 'techno', array('portfolio'), $args );

}

function skyflat_get_terms_list($term) {
	$taxs = array();
	$taxonomies = get_terms($term);
	foreach ($taxonomies as $taxonomy) {
		array_push($taxs, $taxonomy->slug);
	}
	return $taxs;
}

add_action('init','wptuts_custom_tags');
function wptuts_custom_tags() {
	add_rewrite_rule("^portfolio/([^/]+)/([^/]+)/?",'index.php?post_type=portfolio&techno=$matches[1]&portfolio=$matches[2]','top');  
	add_rewrite_rule("^portfolio/([^/]+)/?",'index.php?post_type=portfolio&techno=$matches[1]','top');
}  


add_filter( 'post_type_link', 'wptuts_book_link');
function append_query_string( $url, $post ) {
    if ( 'portfolio' == get_post_type( $post ) ) {
        home_url( "portfolio/$post->ID" );
    }
    return $url;
}
function wptuts_book_link( $post_link, $id = 0 ) {  
  
	$post = get_post($id);  
  
	if ( is_wp_error($post) || 'portfolio' != $post->post_type || empty($post->post_name) )  
		return $post_link;  
  
	// Get the techno:  
	$terms = get_the_terms($post->ID, 'techno');  
  
	if( is_wp_error($terms) || !$terms ) {  
		$genre = 'uncategorised';  
	}  
	else {  
		$genre_obj = array_pop($terms);  
		$genre = $genre_obj->slug;  
	}  
  
	return home_url("portfolio/$genre/$post->post_name");  
}  

add_action('skyflat-before-header', 'skyflat_non_duplicate_content' );
function skyflat_non_duplicate_content() {
	global $wp_query;
	$term = $wp_query->get('techno');
	if(!has_term($term, 'techno')) {
		$wp_query->set_404();
		status_header( 404 );
		get_template_part( 404 ); exit();
	}
}