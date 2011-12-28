<?php
/*
Plugin Name: Brew Beer Recipe
Plugin URI: http://www.beerdetectives.com
Description: Create beer recipes in your blog with a clean interface and layout that are easy to organize.
Version: 0.1
Author: Martin Westwood
*/

/* 
Copyright (c) 2011, Martin Westwood
*/  

// The full path to the plugin directory
define( 'BEERRECIPE_DIR', WP_PLUGIN_DIR . '/' . basename( dirname( __FILE__ ) ) . '/' );
define( 'BEERRECIPE_URL', WP_PLUGIN_URL . '/' . basename( dirname( __FILE__ ) ) . '/' );

function get_beerrecipe_url() { return BEERRECIPE_URL; }

// Load plugin files
include_once(BEERRECIPE_DIR.'php/posttypes.php');
include_once(BEERRECIPE_DIR.'php/taxonomies.php');
include_once(BEERRECIPE_DIR.'php/shortcodes.php');

// Register taxonomies, shortcodes and insert terms on plugin activation
add_action( 'init', 'create_beer_recipe_post_type' );
add_action( 'init', 'register_taxonomy_grains' );
add_action( 'init', 'brew_add_shortcodes' );

register_activation_hook( __FILE__, 'activate_recipress_taxonomies' );

function activate_recipress_taxonomies() {
  // activate custom post types
  create_beer_recipe_post_type();
	// activate short codes
	brew_add_shortcodes();
	// activate taxonomies
  register_taxonomy_grains();
	$GLOBALS['wp_rewrite']->flush_rules();
}

?>