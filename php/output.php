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
    return $content;
}

function _add_brewdectives_filter() {
	add_filter('the_content', 'the_brewdetective');
}
add_action('template_redirect', '_add_brewdectives_filter');

?>