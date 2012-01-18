<?php
/*
Plugin Name: Brew Detectives
Plugin URI: http://www.brewdetectives.com
Description: Create beer recipes in your blog with a clean interface and layout that are easy to organize.
Version: 0.1
Author: Martin Westwood
*/

/* 
Copyright (c) 2011, Martin Westwood
*/  

// The full path to the plugin directory
define( 'BREWDETECTIVES_DIR', WP_PLUGIN_DIR . '/' . basename( dirname( __FILE__ ) ) . '/' );
define( 'BREWDETECTIVES_URL', WP_PLUGIN_URL . '/' . basename( dirname( __FILE__ ) ) . '/' );

function get_brewdetectives_url() { return BREWDETECTIVES_URL; }

// Load plugin files
include_once(BREWDETECTIVES_DIR.'php/functions.php');
include_once(BREWDETECTIVES_DIR.'php/posttypes.php');
include_once(BREWDETECTIVES_DIR.'php/taxonomies.php');
include_once(BREWDETECTIVES_DIR.'php/shortcodes.php');
include_once(BREWDETECTIVES_DIR.'php/metabox.php');
include_once(BREWDETECTIVES_DIR.'php/output.php');

// Styles and Scripts
function brewdetectives_enqueue_scripts() {
    if (is_admin()) {
	    wp_enqueue_script('jquery-ui-sortable');
	    wp_enqueue_script( 'suggest' );
	    wp_enqueue_script('brewdetectives_back', BREWDETECTIVES_URL.'js/back.js');
	    wp_enqueue_style('brewdetectives_back', BREWDETECTIVES_URL.'css/back.css');
    }
}
add_action('init', 'brewdetectives_enqueue_scripts');

// Admin Head Script
add_action('admin_head', 'add_brewdetectives_script_config');
function add_brewdetectives_script_config() {
?>
    <script type="text/javascript" >
    // Function to add auto suggest for Grains
    function setSuggestGrain(id) {
        jQuery('#' + id).suggest("<?php echo get_bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php?action=ajax-tag-search&tax=grains");
    }
	
    // Function to add auto suggest for Hops
    function setSuggestHop(id) {
        jQuery('#' + id).suggest("<?php echo get_bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php?action=ajax-tag-search&tax=hops");
    }
    
    // Function to add auto suggest for Restaurants
    function setSuggestRestaurant(id) {
        jQuery('#' + id).suggest("<?php echo get_bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php?action=ajax-tag-search&tax=restaurants");
    }
    
    // Function to add auto suggest for Stores
    function setSuggestStore(id) {
        jQuery('#' + id).suggest("<?php echo get_bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php?action=ajax-tag-search&tax=stores");
    }
    
    var pluginDir = '<?php echo get_brewdetectives_url() ?>';
    </script>
	<!--[if lt IE 9]>
        <link rel="stylesheet" type="text/css" href="<?php echo get_brewdetectives_url() ?>css/ie.css" />
	<![endif]-->
<?php
}

// Register taxonomies, shortcodes and insert terms on plugin activation
add_action( 'init', 'create_beer_recipe_post_type' );
add_action( 'init', 'create_beer_post_type' );
add_action( 'init', 'register_taxonomy_grains' );
add_action( 'init', 'register_taxonomy_hops' );
add_action( 'init', 'register_brewdetectives_shortcodes' );
add_action( 'init', 'register_taxonomy_BJCPStyles' );
add_action( 'init', 'register_taxonomy_yeasts' );
add_action( 'init', 'register_taxonomy_types' );
add_action( 'init', 'register_taxonomy_breweries' );
add_action( 'init', 'register_taxonomy_stores' );
add_action( 'init', 'register_taxonomy_restaurants' );
add_action( 'init', 'register_taxonomy_beer_descriptor' );
add_action( 'init', 'register_taxonomy_upcnumbers' );

register_activation_hook( __FILE__, 'activate_brewdetectives_taxonomies' );

function activate_brewdetectives_taxonomies() {
    // activate custom post types
    create_beer_recipe_post_type();
    create_beer_post_type();
	// activate short codes
	register_brewdetectives_shortcodes();
	// activate taxonomies
    register_taxonomy_grains();
    register_taxonomy_hops();
    register_taxonomy_BJCPStyles();
    register_taxonomy_yeasts();
    register_taxonomy_types();
    register_taxonomy_breweries();
    register_taxonomy_stores();
    register_taxonomy_restaurants();
    register_taxonomy_beer_descriptor();
    register_taxonomy_upcnumbers();
	$GLOBALS['wp_rewrite']->flush_rules();
}

?>