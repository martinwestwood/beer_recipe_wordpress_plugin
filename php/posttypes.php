<?php
// Add beer recipe post type
function create_beer_recipe_post_type() {
	$labels = array(
		'name' => _x('Beer Recipes', 'post type general name'),
		'singular_name' => _x('Book', 'post type singular name'),
		'add_new' => __('Add New'),
		'add_new_item' => __('Add New Beer Recipe'),
		'edit_item' => __('Edit Beer Recipe'),
		'new_item' => __('New Beer Recipe'),
		'all_items' => __('All Beer Recipes'),
		'view_item' => __('View Beer Recipe'),
		'search_items' => __('Search Beer Recipes'),
		'not_found' =>  __('No beer recipes found'),
		'not_found_in_trash' => __('No beer recipes found in Trash'), 
		'parent_item_colon' => '',
		'menu_name' => 'Beer Recipes'

	  );
	  $args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => array('slug' => 'beer-recipes'),
		'capability_type' => 'post',
		'has_archive' => true, 
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'comments', 'revisions' ),
		'taxonomies' => array( 'category' )
	  );
	register_post_type( 'beer_recipe', $args);
}

// Add beer post type
function create_beer_post_type() {
	$labels = array(
		'name' => _x('Beers', 'post type general name'),
		'singular_name' => _x('Beer', 'post type singular name'),
		'add_new' => __('Add New'),
		'add_new_item' => __('Add New Beer'),
		'edit_item' => __('Edit Beer'),
		'new_item' => __('New Beer'),
		'all_items' => __('All Beers'),
		'view_item' => __('View Beer'),
		'search_items' => __('Search Beer'),
		'not_found' =>  __('No beers found'),
		'not_found_in_trash' => __('No beers found in Trash'), 
		'parent_item_colon' => '',
		'menu_name' => 'Beers'

	  );
	  $args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => array('slug' => 'beer-recipes'),
		'capability_type' => 'post',
		'has_archive' => true, 
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'comments', 'revisions' ),
		'taxonomies' => array( 'category' )
	  );
	register_post_type( 'beer', $args);
}
?>