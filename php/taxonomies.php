<?php
// Add beer recipe taxonomies
function register_taxonomy_grains() {
	$labels = array( 
	'name' 				=> _x( 'Grains', 'grains' ),
	'singular_name' 	=> _x( 'Grain', 'grain' ),
	'search_items'		=> _x( 'Search Grains', 'grain' ),
	'popular_items' 	=> _x( 'Popular Grains', 'grain' ),
	'all_items'			=> _x( 'All Grains', 'grain' ),
	'parent_item' 		=> _x( 'Parent Grain', 'grain' ),
	'parent_item_colon' => _x( 'Parent Grain:', 'grain' ),
	'edit_item' 		=> _x( 'Edit Grain', 'grain' ),
	'update_item' 		=> _x( 'Update Grain', 'grain' ),
	'add_new_item' 		=> _x( 'Add New Grain', 'grain' ),
	'new_item_name' 	=> _x( 'New Grain Name', 'grain' ),
	'add_or_remove_items' => _x( 'Add or remove grains', 'grain' ),
	'menu_name' 		=> _x( 'Grains', 'grains' ),
	);
	$args = array( 
	'labels' 			=> $labels,
	'public'			=> true,
	'show_in_nav_menus' => true,
	'show_ui' 			=> false,
	'show_tagcloud' 	=> false,
	'hierarchical'	 	=> true,
	
	'rewrite' 			=> true,
	'query_var' 		=> true
	);
	register_taxonomy( 'grains', 'brew_beer_recipe', $args );
}
?>