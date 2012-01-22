<?php
// Shorten Any Text
function beer_short($text, $limit)
{
	$chars_limit = $limit;
	$chars_text = strlen($text);
	$text = strip_tags($text);
	$text = $text." ";
	$text = substr($text,0,$chars_limit);
	$text = substr($text,0,strrpos($text,' '));
	if ($chars_text > $chars_limit)
	{
		$text = $text."..";
	}
	return $text;
}

// function for outputting a beer recipe
function beer_recipe($field, $attr = null) {
	global $post;
	$meta = get_post_custom($post->ID);
	
	switch($field) {
        case 'recipeauthor':
			$recipeauthor = $meta['recipeauthor'][0];
			return $recipeauthor;
		break;
        
        case 'types':
			$types = get_the_term_list( $post->ID, 'types', '', ', ', '');
			return $types;
		break;
        
        case 'yeaststarter':
			$yeaststarter = $meta['yeaststarter'][0];
			return $yeaststarter;
		break;
        
        case 'yeasts':
			$yeasts = get_the_term_list( $post->ID, 'yeasts', '', ', ', '');
			return $yeasts;
		break;
        
        case 'originalgravity':
			$originalgravity = $meta['originalgravity'][0];
			return $originalgravity;
		break;
        
        case 'finalgravity':
			$finalgravity = $meta['finalgravity'][0];
			return $finalgravity;
		break;
        
        case 'abv':
			$abv = $meta['abv'][0];
			return $abv;
		break;
    } // end switch
}

// function for outputting a beer
function beer($field, $attr = null) {
	global $post;
	$meta = get_post_custom($post->ID);
	
	switch($field) {
        case 'bjcpstyles':
			$bjcpstyles = get_the_term_list( $post->ID, 'bjcpstyles', '', ', ', '');
			return $bjcpstyles;
		break;
        
        case 'breweries':
			$breweries = get_the_term_list( $post->ID, 'breweries', '', ', ', '');
			return $breweries;
		break;
        
        case 'upcnumbers':
			$upcnumbers = get_the_term_list( $post->ID, 'upcnumbers', '', ', ', '');
			return $upcnumbers;
		break;
        
        case 'stores':
			$stores = get_the_term_list( $post->ID, 'stores', '', ', ', '');
			return $stores;
		break;
        
        case 'restaurants':
			$restaurants = get_the_term_list( $post->ID, 'restaurants', '', ', ', '');
			return $restaurants;
		break;
        
        case 'abv':
			$abv = $meta['abv'][0];
			return $abv;
		break;
        
        case 'review':
			$review = $meta['review'][0];
			return $review;
		break;
    } // end switch
}
?>