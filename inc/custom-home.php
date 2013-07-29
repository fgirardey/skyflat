<?php
//add_theme_support( 'post-thumbnails' );
function skyflat_register_home_post() {

   /**
	* Register a custom post type for home page
	*
	* Supplied is a "reasonable" list of defaults
	* @see register_post_type for full list of options for register_post_type
	* @see add_post_type_support for full descriptions of 'supports' options
	* @see get_post_type_capabilities for full list of available fine grained capabilities that are supported
	*/
   
	$labels = array(
		'name' => __('Sticky Posts'),
		'singular_name' => __('Sticky Post'),
		'add_new' => __('Add New'),
		'add_new_item' => __('Add New Sticky Post'),
		'edit_item' => __('Edit Sticky Post'),
		'new_item' => __('New Sticky Post'),
		'all_items' => __('All Sticky Posts'),
		'view_item' => __('View Sticky Post'),
		'search_items' => __('Search Sticky Post'),
		'not_found' =>  __('No Sticky Post found'),
		'not_found_in_trash' => __('No Sticky Posts found in Trash'), 
		'parent_item_colon' => '',
		'menu_name' => __('Sticky Posts')
	  );

	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => array( 'slug' => 'sticky' ),
		'capability_type' => 'post',
		'has_archive' => true, 
		'hierarchical' => false,
		'menu_position' => 5,
		'supports' => array( 'title', 'editor', 'author', 'thumbnail' ),
		'register_meta_box_cb' => 'skyflat_add_icons_metaboxes'
	  ); 

	  register_post_type( 'sticky', $args );
}
add_action( 'init', 'skyflat_register_home_post' );

function skyflat_add_icons_metaboxes(){
	add_meta_box('skyflat_wpt_icons_bootstrap', 'Sticky Icons', 'skyflat_wpt_icons_bootstrap', 'sticky', 'side', 'default');
}
add_action( 'add_meta_boxes', 'skyflat_add_icons_metaboxes' );

// The Event Location Metabox
function skyflat_wpt_icons_bootstrap() {
	global $post;
	
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="iconmeta_noncename" id="iconmeta_noncename" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	// Get the location data if its already been entered
	$location = get_post_meta($post->ID, '_icon', true);
	
	// Echo out the field
	echo '<p>'.__('Icon from Bootstrap').' :</p>';
	echo '<input type="text" name="_icon" value="' . $location  . '" class="widefat" id="icon" />';
}

// Save the Metabox Data

function skyflat_wpt_save_icons_meta($post_id, $post) {
	
	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	if ( !wp_verify_nonce( $_POST['iconmeta_noncename'], plugin_basename(__FILE__) )) {
	return $post->ID;
	}

	// Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	// OK, we're authenticated: we need to find and save the data
	// We'll put it into an array to make it easier to loop though.
	
	$events_meta['_icon'] = $_POST['_icon'];
	
	// Add values of $events_meta as custom fields
	
	foreach ($events_meta as $key => $value) { // Cycle through the $events_meta array!
		if( $post->post_type == 'revision' ) return; // Don't store custom data twice
		$value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
		if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
			update_post_meta($post->ID, $key, $value);
		} else { // If the custom field doesn't have a value
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
	}

}

add_action('save_post', 'skyflat_wpt_save_icons_meta', 1, 2); // save the custom fields
?>