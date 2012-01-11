<?php
// Add grain taxonomy
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
	'show_ui' 			=> true,
	'show_tagcloud' 	=> false,
	'hierarchical'	 	=> true,
	
	'rewrite' 			=> true,
	'query_var' 		=> true
	);
	register_taxonomy( 'grains', 'beer_recipe', $args );
}

// Add BJCP Styles taxonomy
function register_taxonomy_BJCPStyles() {
	$labels = array( 
	'name' 				=> _x( 'BJCP Styles', 'taxonomy general name' ),
	'singular_name' 	=> _x( 'BJCP Style', 'taxonomy singular name' ),
	'search_items'		=> __( 'Search BJCP Styles' ),
	'popular_items' 	=> __( 'Popular BJCP Styles' ),
	'all_items'			=> __( 'All BJCP Styles' ),
	'parent_item' 		=> __( 'Parent BJCP Style' ),
	'parent_item_colon' => __( 'Parent BJCP Style:' ),
	'edit_item' 		=> __( 'Edit BJCP Style' ),
	'update_item' 		=> __( 'Update BJCP Style' ),
	'add_new_item' 		=> __( 'Add New BJCP Style' ),
	'new_item_name' 	=> __( 'New BJCP Style Name' ),
	'add_or_remove_items' => __( 'Add or remove BJCP styles' ),
	'menu_name' 		=> __( 'BJCP Styles' ),
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
	register_taxonomy( 'bjcpstyles', 'beer_recipe', $args );
	register_taxonomy( 'bjcpstyles', 'beer', $args );
}

// Add yeast taxonomy
function register_taxonomy_yeasts() {
	$labels = array( 
	'name' 				=> _x( 'Yeasts', 'taxonomy general name' ),
	'singular_name' 	=> _x( 'Yeast', 'taxonomy singular name' ),
	'search_items'		=> __( 'Search Yeasts' ),
	'popular_items' 	=> __( 'Popular Yeasts' ),
	'all_items'			=> __( 'All Yeasts' ),
	'parent_item' 		=> __( 'Parent Yeast' ),
	'parent_item_colon' => __( 'Parent Yeast:' ),
	'edit_item' 		=> __( 'Edit Yeast' ),
	'update_item' 		=> __( 'Update Yeast' ),
	'add_new_item' 		=> __( 'Add New Yeast' ),
	'new_item_name' 	=> __( 'New Yeast Name' ),
	'add_or_remove_items' => __( 'Add or remove yeasts' ),
	'menu_name' 		=> __( 'Yeasts' ),
	);
	$args = array( 
	'labels' 			=> $labels,
	'public'			=> true,
	'show_in_nav_menus' => true,
	'show_ui' 			=> true,
	'show_tagcloud' 	=> false,
	'hierarchical'	 	=> true,
	
	'rewrite' 			=> true,
	'query_var' 		=> true
	);
	register_taxonomy( 'yeasts', 'beer_recipe', $args );
}

// Add yeast taxonomy
function register_taxonomy_types() {
	$labels = array( 
	'name' 				=> _x( 'Types', 'taxonomy general name' ),
	'singular_name' 	=> _x( 'Type', 'taxonomy singular name' ),
	'search_items'		=> __( 'Search Types' ),
	'popular_items' 	=> __( 'Popular Types' ),
	'all_items'			=> __( 'All Types' ),
	'parent_item' 		=> __( 'Parent Type' ),
	'parent_item_colon' => __( 'Parent Type:' ),
	'edit_item' 		=> __( 'Edit Type' ),
	'update_item' 		=> __( 'Update Type' ),
	'add_new_item' 		=> __( 'Add New Type' ),
	'new_item_name' 	=> __( 'New Type Name' ),
	'add_or_remove_items' => __( 'Add or remove types' ),
	'menu_name' 		=> __( 'Types' ),
	);
	$args = array( 
	'labels' 			=> $labels,
	'public'			=> true,
	'show_in_nav_menus' => true,
	'show_ui' 			=> true,
	'show_tagcloud' 	=> false,
	'hierarchical'	 	=> false,
	
	'rewrite' 			=> true,
	'query_var' 		=> true
	);
	register_taxonomy( 'types', 'beer_recipe', $args );
}

// Add hop taxonomy
function register_taxonomy_hops() {
	$labels = array( 
	'name' 				=> _x( 'Hops', 'hops' ),
	'singular_name' 	=> _x( 'Hop', 'hop' ),
	'search_items'		=> _x( 'Search Hops', 'hop' ),
	'popular_items' 	=> _x( 'Popular Hops', 'hop' ),
	'all_items'			=> _x( 'All Hops', 'hop' ),
	'parent_item' 		=> _x( 'Parent Hop', 'hop' ),
	'parent_item_colon' => _x( 'Parent Hop:', 'hop' ),
	'edit_item' 		=> _x( 'Edit Hop', 'hop' ),
	'update_item' 		=> _x( 'Update Hop', 'hop' ),
	'add_new_item' 		=> _x( 'Add New Hop', 'hop' ),
	'new_item_name' 	=> _x( 'New Hop Name', 'hop' ),
	'add_or_remove_items' => _x( 'Add or remove hops', 'hop' ),
	'menu_name' 		=> _x( 'Hops', 'hops' ),
	);
	$args = array( 
	'labels' 			=> $labels,
	'public'			=> true,
	'show_in_nav_menus' => true,
	'show_ui' 			=> true,
	'show_tagcloud' 	=> false,
	'hierarchical'	 	=> true,
	
	'rewrite' 			=> true,
	'query_var' 		=> true
	);
	register_taxonomy( 'hops', 'beer_recipe', $args );
}

// Add brewery taxonomy
function register_taxonomy_breweries() {
	$labels = array( 
	'name' 				=> _x( 'Breweries', 'taxonomy general name' ),
	'singular_name' 	=> _x( 'Brewery', 'taxonomy singular name' ),
	'search_items'		=> __( 'Search Breweries' ),
	'popular_items' 	=> __( 'Popular Breweries' ),
	'all_items'			=> __( 'All Breweries' ),
	'edit_item' 		=> __( 'Edit Brewery' ),
	'update_item' 		=> __( 'Update Brewery' ),
	'add_new_item' 		=> __( 'Add New Brewery' ),
	'new_item_name' 	=> __( 'New Brewery Name' ),
	'add_or_remove_items' => __( 'Add or remove breweries' ),
	'menu_name' 		=> __( 'Breweries' ),
	);
	$args = array( 
	'labels' 			=> $labels,
	'public'			=> true,
	'show_in_nav_menus' => true,
	'show_ui' 			=> true,
	'show_tagcloud' 	=> false,
	'hierarchical'	 	=> false,
	
	'rewrite' 			=> true,
	'query_var' 		=> true
	);
	register_taxonomy( 'breweries', 'beer', $args );
}

// Remove Taxonomy Boxes
function brewdetectives_remove_taxonomy_boxes() {
	remove_meta_box('grainsdiv', 'beer_recipe', 'side');
	remove_meta_box('bjcpstylesdiv', 'beer_recipe', 'side');
	remove_meta_box('hopsdiv', 'beer_recipe', 'side');
	remove_meta_box('yeastsdiv', 'beer_recipe', 'side');
	remove_meta_box('tagsdiv-types', 'beer_recipe', 'side');
    
	remove_meta_box('bjcpstylesdiv', 'beer', 'side');
    remove_meta_box('tagsdiv-breweries', 'beer', 'side');
}
add_action( 'admin_menu' , 'brewdetectives_remove_taxonomy_boxes' );
?>