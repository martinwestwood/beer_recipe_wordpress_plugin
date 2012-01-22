<?php

// Brew Detective Output
function the_brewdetective($content) {
    $queried_post_type = get_query_var('post_type');
    if ($queried_post_type == 'beer_recipe')
    {
        $content .= '<p>';
        $content .= '<strong>Author: </strong>'.beer_recipe('recipeauthor').'<br />';
        $content .= '<strong>BJCP Style: </strong>'.beer_recipe('bjcpstyles').'<br />';
        $content .= '<strong>Recipe Type: </strong>'.beer_recipe('types').'<br />';
        $content .= '<strong>Yeast Starter: </strong>'.beer_recipe('yeaststarter').'<br />';
        $content .= '<strong>Yeast: </strong>'.beer_recipe('yeasts').'<br />';
        $content .= '<strong>Original Gravity: </strong>'.beer_recipe('originalgravity').'<br />';
        $content .= '<strong>Final Gravity: </strong>'.beer_recipe('finalgravity').'<br />';
        $content .= '</p>';
    }
    else if ($queried_post_type == 'beer')
    {
        $content .= '<p>';
        $content .= '<strong>Breweries: </strong>'.beer('breweries').'<br />';
        $content .= '<strong>BJCP Style(s): </strong>'.beer('bjcpstyles').'<br />';
        $content .= '<strong>ABV: </strong>'.beer('abv').'<br />';
        $content .= '<strong>UPC Number(s): </strong>'.beer('upcnumbers').'<br />';
        $content .= '<strong>Stores: </strong>'.beer('stores').'<br />';
        $content .= '<strong>Restaurants/Bars: </strong>'.beer('restaurants').'<br />';
        $content .= '</p>';
        
        $beer_review = beer('review'); 
        if ($beer_review != '')
        {
            $content .= '<p>';
            $content .= '<strong>Review: </strong></br>'.$beer_review.'<br />';
            $content .= '</p>';
        }
    }
    return $content;
}

function _add_brewdectives_filter() {
	add_filter('the_content', 'the_brewdetective');
}
add_action('template_redirect', '_add_brewdectives_filter');

function query_post_type($query) {
  if(is_category() || is_tag()) {
    $post_type = get_query_var('post_type');
	if($post_type)
	    $post_type = $post_type;
	else
	    $post_type = array('post','beer_recipe','beer'); // replace cpt to your custom post type
    $query->set('post_type',$post_type);
	return $query;
    }
}
add_filter('pre_get_posts', 'query_post_type');

?>