<?php
// Add Beer Recipe Meta Box
add_action('admin_menu', 'beer_recipe_add_box');
function beer_recipe_add_box() {
    global $beer_recipe_meta_fields;
    add_meta_box('beer-recipe', 'Beer Recipe', 'beer_recipe_show_box', 'beer_recipe', 'normal', 'high');
}

// Beer Recipe Custom Fields
$beer_recipe_meta_fields = array(
	array(
		'name'	=> 'Author',
		'desc'	=> 'Who is the author for this recipe?',
		'place'	=> '',
		'size'	=> 'large',
		'id'	=> 'recipeauthor',
		'type'	=> 'text'
	),
    array(
		'name'	=> 'BJCP Style',
		'id'	=> 'bjcpstyles',
		'type'	=> 'tax_select'
	),
    array(
		'name'	=> 'Recipe Type',
		'id'	=> 'types',
		'type'	=> 'tax_select'
	),
    array(
		'name'	=> 'Yeast Starter',
		'desc'	=> 'Was a yeast starter used?',
		'id'	=> 'yeaststarter',
		'type'	=> 'checkbox'
	),
    array(
		'name'	=> 'Yeast',
		'id'	=> 'yeasts',
		'type'	=> 'tax_select'
	),
	array(
		'name'	=> 'Original Gravity',
		'desc'	=> 'What is the original gravity for this recipe?',
		'place'	=> '',
		'size'	=> 'small',
		'id'	=> 'originalgravity',
		'type'	=> 'text'
	),
	array(
		'name'	=> 'Final Gravity',
		'desc'	=> 'What is the final gravity for this recipe?',
		'place'	=> '',
		'size'	=> 'small',
		'id'	=> 'finalgravity',
		'type'	=> 'text'
	),
	array(
		'name'	=> 'Grains',
		'desc'	=> 'Click the plus icon to add another grain. <a href="'.get_bloginfo('url').'/wp-admin/edit-tags.php?taxonomy=grains">Manage Grains</a>',
		'id'	=> 'grain',
		'type'	=> 'grain'
	),
    array(
		'name'	=> 'Hops',
		'desc'	=> 'Click the plus icon to add another hop. <a href="'.get_bloginfo('url').'/wp-admin/edit-tags.php?taxonomy=hops">Manage Hops</a>',
		'id'	=> 'hop',
		'type'	=> 'hop'
	)
);


// The Beer Recipe Callback
function beer_recipe_show_box() {
	global $beer_recipe_meta_fields, $post;
	// Use nonce for verification
    echo '<input type="hidden" name="beer_recipe_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	echo '<div id="beer_recipe_table"><table class="form-table">';
    foreach ($beer_recipe_meta_fields as $field) {
	    // get current post meta data
        $meta = get_post_meta($post->ID, $field['id'], true);
        echo '<tr>',
                '<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
                '<td>';
				
        switch ($field['type']) {
			// Grain
            case 'grain':
                echo '<ul class="table" id="grains_table">',
						'<li class="thead"><ul class="tr">
							<li class="th left_corner"><span class="sort_label"></span></li>
							<li class="th cell-amount">Amount</li>
							<li class="th cell-measurement">Measurement</li>
							<li class="th cell-grain">Grain</li>
							<li class="th right_corner"><a class="grain_add" href="#"></a></li>
						</ul></li>',
						'<li class="tbody">';
				$i = 0;
				if($meta != '') {
					foreach($meta as $row) {
						echo '<ul class="tr">',
							'<li class="td"><span class="sort"></span></li>', // sort
							'<li class="td cell-amount"><input type="text" placeholder="0" name="grain['.$i.'][amount]" id="grain_amount_'.$i.'" value="', $row['amount'],'" size="3" /></li>', //amount
							'<li class="td cell-measurement"><input type="text" name="grain['.$i.'][measurement]" id="grain_measurement_'.$i.'" value="', $row['measurement'],'" size="30" /></li>', //measurement
							'<li class="td cell-grain"><input type="text" name="grain['.$i.'][grain]" id="grain_'.$i.'" onfocus="setSuggestGrain(\'grain_'.$i.'\');" value="', $row['grain'],'" size="30" class="grain" placeholder="start typing a grain" /></li>', // grain
							'<li class="td"><a class="grain_remove" href="#"></a></li>', // remove
							'<li class="clear"></li>', // clear
						'</ul>';
						$i++;
					}
				} else {
						echo '<ul class="tr">',
							'<li class="td"><span class="sort"></span></li>', // sort
							'<li class="td cell-amount"><input type="text" class="text-small" placeholder="0" name="grain['.$i.'][amount]" id="grain_amount_'.$i.'" value="" size="3" /></li>', //amount
							'<li class="td cell-measurement"><input type="text" name="grain['.$i.'][measurement]" id="grain_measurement_'.$i.'" value="" size="30" /></li>', //measurement
							'<li class="td cell-grain"><input type="text" name="grain['.$i.'][grain]" id="grain_'.$i.'" onfocus="setSuggestGrain(\'grain_'.$i.'\');" value="" size="30" class="grain" placeholder="start typing a grain" /></li>', // grain
							'<li class="td"><a class="grain_remove" href="#"></a></li>', // remove
							'<li class="clear"></li>', // clear
						'</ul>';
				}
				echo '</li></ul>',
					'<span class="description">', $field['desc'], '</span>';
                break;
            // Hops
            case 'hop':
                echo '<ul class="table" id="hops_table">',
						'<li class="thead"><ul class="tr">
							<li class="th left_corner"><span class="sort_label"></span></li>
							<li class="th cell-amount">Amount</li>
							<li class="th cell-measurement">Measurement</li>
							<li class="th cell-hop">Hop</li>
							<li class="th cell-boil">Boil</li>
							<li class="th cell-boil-measurement">Boil Meas.</li>
							<li class="th right_corner"><a class="hop_add" href="#"></a></li>
						</ul></li>',
						'<li class="tbody">';
				$i = 0;
				if($meta != '') {
					foreach($meta as $row) {
						echo '<ul class="tr">',
							'<li class="td"><span class="sort"></span></li>', // sort
							'<li class="td cell-amount"><input type="text" placeholder="0" name="hop['.$i.'][amount]" id="hop_amount_'.$i.'" value="', $row['amount'],'" size="3" /></li>', //amount
							'<li class="td cell-measurement"><input type="text" name="hop['.$i.'][measurement]" id="hop_measurement_'.$i.'" value="', $row['measurement'],'" size="30" /></li>', //measurement
							'<li class="td cell-hop"><input type="text" name="hop['.$i.'][hop]" id="hop_'.$i.'" onfocus="setSuggestHop(\'hop_'.$i.'\');" value="', $row['hop'],'" size="30" class="hop" placeholder="start typing a hop" /></li>', // hop
							'<li class="td cell-boil-time"><input type="text" name="hop['.$i.'][boil-time]" id="hop_boil-time_'.$i.'" value="', $row['boil-time'],'" size="3" /></li>', // boil-time
							'<li class="td cell-boil-measurement"><input type="text" name="hop['.$i.'][boil-measurement]" id="hop_boil-measurement_'.$i.'" value="', $row['boil-measurement'],'" size="30" /></li>', // boil-measurement
							'<li class="td"><a class="hop_remove" href="#"></a></li>', // remove
							'<li class="clear"></li>', // clear
						'</ul>';
						$i++;
					}
				} else {
						echo '<ul class="tr">',
							'<li class="td"><span class="sort"></span></li>', // sort
							'<li class="td cell-amount"><input type="text" class="text-small" placeholder="0" name="hop['.$i.'][amount]" id="hop_amount_'.$i.'" value="" size="3" /></li>', //amount
							'<li class="td cell-measurement"><input type="text" name="hop['.$i.'][measurement]" id="hop_measurement_'.$i.'" value="" size="30" /></li>', //measurement
							'<li class="td cell-hop"><input type="text" name="hop['.$i.'][hop]" id="hop_'.$i.'" onfocus="setSuggestHop(\'hop_'.$i.'\');" value="" size="30" class="hop" placeholder="start typing a hop" /></li>', // hop
							'<li class="td cell-boil-time"><input type="text" name="hop['.$i.'][boil-time]" id="hop_boil-time_'.$i.'" value="', $row['boil-time'],'" size="3" /></li>', // boil-time
							'<li class="td cell-boil-measurement"><input type="text" name="hop['.$i.'][boil-measurement]" id="hop_boil-measurement_'.$i.'" value="', $row['boil-measurement'],'" size="30" /></li>', // boil-measurement
                            '<li class="td"><a class="hop_remove" href="#"></a></li>', // remove
							'<li class="clear"></li>', // clear
						'</ul>';
				}
				echo '</li></ul>',
					'<span class="description">', $field['desc'], '</span>';
                break;
			// tax_select
            case 'tax_select':
                echo '<select name="', $field['id'], '" id="', $field['id'], '">',
						'<option value="">Select One</option>'; // Select One
				$terms = get_terms($field['id'], 'get=all');
				$selected = wp_get_object_terms($post->ID, $field['id']);
                foreach ($terms as $term) {
                    if (!is_wp_error($selected) && !empty($selected) && !strcmp($term->slug, $selected[0]->slug)) 
						echo '<option value="' . $term->slug . '" selected="selected">' . $term->name . '</option>'; 
					else
						echo '<option value="' . $term->slug . '">' . $term->name . '</option>'; 
                }
                echo '</select>', '&nbsp;&nbsp;<span class="description"><a href="'.get_bloginfo('url').'/wp-admin/edit-tags.php?taxonomy=', $field['id'], '&amp;post_type=beer_recipe">Manage ', $field['name'], 's</a></span>';
			    break;
            // text
            case 'text':
                echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ,'" class="text-', $field['size'] ,'" size="30" placeholder="', $field['place'], '" />', '&nbsp;&nbsp;<span class="description">', $field['desc'], '</span>';
                break;
            // checkbox
            case 'checkbox':
                echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' /> <label for="', $field['id'], '">', $field['desc'], '</label>';
		}
    }
    echo '</table></div>';
}


// Save the Beer Recipe Data
add_action('save_post', 'beer_recipe_save_data');
// Save data from meta box
function beer_recipe_save_data($post_id) {
    global $beer_recipe_meta_fields;
		// verify nonce
		if (!wp_verify_nonce($_POST['beer_recipe_meta_box_nonce'], basename(__FILE__))) 
			return $post_id;
		// check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
			return $post_id;
		// check permissions
		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id))
				return $post_id;
		} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}
		foreach ($beer_recipe_meta_fields as $field) {
            if($field['type'] == 'tax_select') continue;
			$old = get_post_meta($post_id, $field['id'], true);
			$new = $_POST[$field['id']];
			if ($new && $new != $old) {
				if ('grain' == $field['id']) 
					foreach ($new as &$grain) $grain['measurement'] = rtrim($grain['measurement']);
				if ('hop' == $field['id']) 
					foreach ($new as &$hop) $hop['measurement'] = rtrim($hop['measurement']);
				update_post_meta($post_id, $field['id'], $new);
			} elseif ('' == $new && $old) {
				delete_post_meta($post_id, $field['id'], $old);
			}
		}
		
		// save taxonomies
		$post = get_post($post_id);
		if (($post->post_type == 'beer_recipe')) { 
			$the_grains = $_POST['grain'];
			foreach($the_grains as $the_grains) {
					$grains[] = $the_grains['grain'];
			}
			wp_set_object_terms( $post_id, $grains, 'grains' );
            
			$the_hops = $_POST['hop'];
			foreach($the_hops as $the_hops) {
					$hops[] = $the_hops['hop'];
			}
			wp_set_object_terms( $post_id, $hops, 'hops' );
            
            $bjcpstyles = $_POST['bjcpstyles'];
			wp_set_object_terms( $post_id, $bjcpstyles, 'bjcpstyles' );
            
            $yeasts = $_POST['yeasts'];
			wp_set_object_terms( $post_id, $yeasts, 'yeasts' );
            
            $types = $_POST['types'];
			wp_set_object_terms( $post_id, $types, 'types' );
		}
}


// Add Beer Meta Box
add_action('admin_menu', 'beer_add_box');
function beer_add_box() {
    global $beer_meta_fields;
    add_meta_box('beer', 'Beer', 'beer_show_box', 'beer', 'normal', 'high');
}

// Beer Custom Fields
$beer_meta_fields = array(
    array(
		'name'	=> 'BJCP Style',
		'id'	=> 'bjcpstyles',
		'type'	=> 'tax_select'
	),
	array(
		'name'	=> 'Alchohol Content',
		'desc'	=> 'What is the alchohol content for this beer?',
		'place'	=> '',
		'size'	=> 'small',
		'id'	=> 'abv',
		'type'	=> 'text'
	),
	array(
		'name'	=> 'Restaurants',
		'desc'	=> 'Click the plus icon to add another Restaurant. <a href="'.get_bloginfo('url').'/wp-admin/edit-tags.php?taxonomy=restaurants">Manage Restaurants</a>',
		'id'	=> 'restaurant',
		'type'	=> 'restaurant'
	),
	array(
		'name'	=> 'Stores',
		'desc'	=> 'Click the plus icon to add another Store. <a href="'.get_bloginfo('url').'/wp-admin/edit-tags.php?taxonomy=stores">Manage Stores</a>',
		'id'	=> 'store',
		'type'	=> 'store'
	)
);


// The Beer Callback
function beer_show_box() {
	global $beer_meta_fields, $post;
	// Use nonce for verification
    echo '<input type="hidden" name="beer_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	echo '<div id="beer_table"><table class="form-table">';
    foreach ($beer_meta_fields as $field) {
	    // get current post meta data
        $meta = get_post_meta($post->ID, $field['id'], true);
        echo '<tr>',
                '<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
                '<td>';
				
        switch ($field['type']) {
			// Restaurant
            case 'restaurant':
                echo '<ul class="table" id="restaurants_table">',
						'<li class="thead"><ul class="tr">
							<li class="th left_corner"><span class="sort_label"></span></li>
							<li class="th cell-restaurant">Restaurant</li>
							<li class="th right_corner"><a class="restaurant_add" href="#"></a></li>
						</ul></li>',
						'<li class="tbody">';
				$i = 0;
				if($meta != '') {
					foreach($meta as $row) {
						echo '<ul class="tr">',
							'<li class="td"><span class="sort"></span></li>', // sort
							'<li class="td cell-restaurant"><input type="text" name="restaurant['.$i.'][restaurant]" id="restaurant_'.$i.'" onfocus="setSuggestRestaurant(\'restaurant_'.$i.'\');" value="', $row['restaurant'],'" size="30" class="restaurant" placeholder="start typing a restaurant" /></li>', // restaurant
							'<li class="td"><a class="restaurant_remove" href="#"></a></li>', // remove
							'<li class="clear"></li>', // clear
						'</ul>';
						$i++;
					}
				} else {
						echo '<ul class="tr">',
							'<li class="td"><span class="sort"></span></li>', // sort
							'<li class="td cell-restaurant"><input type="text" name="restaurant['.$i.'][restaurant]" id="restaurant_'.$i.'" onfocus="setSuggestRestaurant(\'restaurant_'.$i.'\');" value="" size="30" class="restaurant" placeholder="start typing a restaurant" /></li>', // restaurant
							'<li class="td"><a class="restaurant_remove" href="#"></a></li>', // remove
							'<li class="clear"></li>', // clear
						'</ul>';
				}
				echo '</li></ul>',
					'<span class="description">', $field['desc'], '</span>';
                break;
            // Store
            case 'store':
                echo '<ul class="table" id="stores_table">',
						'<li class="thead"><ul class="tr">
							<li class="th left_corner"><span class="sort_label"></span></li>
							<li class="th cell-store">Store</li>
							<li class="th right_corner"><a class="store_add" href="#"></a></li>
						</ul></li>',
						'<li class="tbody">';
				$i = 0;
				if($meta != '') {
					foreach($meta as $row) {
						echo '<ul class="tr">',
							'<li class="td"><span class="sort"></span></li>', // sort
							'<li class="td cell-store"><input type="text" name="store['.$i.'][store]" id="store_'.$i.'" onfocus="setSuggestStore(\'store_'.$i.'\');" value="', $row['store'],'" size="30" class="store" placeholder="start typing a store" /></li>', // store
							'<li class="td"><a class="store_remove" href="#"></a></li>', // remove
							'<li class="clear"></li>', // clear
						'</ul>';
						$i++;
					}
				} else {
						echo '<ul class="tr">',
							'<li class="td"><span class="sort"></span></li>', // sort
							'<li class="td cell-store"><input type="text" name="store['.$i.'][store]" id="store_'.$i.'" onfocus="setSuggestStore(\'store_'.$i.'\');" value="" size="30" class="store" placeholder="start typing a store" /></li>', // store
							'<li class="td"><a class="store_remove" href="#"></a></li>', // remove
							'<li class="clear"></li>', // clear
						'</ul>';
				}
				echo '</li></ul>',
					'<span class="description">', $field['desc'], '</span>';
                break;
			// tax_select
            case 'tax_select':
                echo '<select name="', $field['id'], '" id="', $field['id'], '">',
						'<option value="">Select One</option>'; // Select One
				$terms = get_terms($field['id'], 'get=all');
				$selected = wp_get_object_terms($post->ID, $field['id']);
                foreach ($terms as $term) {
                    if (!is_wp_error($selected) && !empty($selected) && !strcmp($term->slug, $selected[0]->slug)) 
						echo '<option value="' . $term->slug . '" selected="selected">' . $term->name . '</option>'; 
					else
						echo '<option value="' . $term->slug . '">' . $term->name . '</option>'; 
                }
                echo '</select>', '&nbsp;&nbsp;<span class="description"><a href="'.get_bloginfo('url').'/wp-admin/edit-tags.php?taxonomy=', $field['id'], '&amp;post_type=beer">Manage ', $field['name'], 's</a></span>';
			    break;
            // text
            case 'text':
                echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ,'" class="text-', $field['size'] ,'" size="30" placeholder="', $field['place'], '" />', '&nbsp;&nbsp;<span class="description">', $field['desc'], '</span>';
                break;
            // checkbox
            case 'checkbox':
                echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' /> <label for="', $field['id'], '">', $field['desc'], '</label>';
		}
    }
    echo '</table></div>';
}


// Save the Beer Data
add_action('save_post', 'beer_save_data');
// Save data from meta box
function beer_save_data($post_id) {
    global $beer_meta_fields;
		// verify nonce
		if (!wp_verify_nonce($_POST['beer_meta_box_nonce'], basename(__FILE__))) 
			return $post_id;
		// check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
			return $post_id;
		// check permissions
		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id))
				return $post_id;
		} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}
		foreach ($beer_meta_fields as $field) {
            if($field['type'] == 'tax_select') continue;
			$old = get_post_meta($post_id, $field['id'], true);
			$new = $_POST[$field['id']];
			if ($new && $new != $old) {
				update_post_meta($post_id, $field['id'], $new);
			} elseif ('' == $new && $old) {
				delete_post_meta($post_id, $field['id'], $old);
			}
		}
		
		// save taxonomies
		$post = get_post($post_id);
		if (($post->post_type == 'beer')) { 
			$the_restaurants = $_POST['restaurant'];
			foreach($the_restaurants as $the_restaurant) {
					$restaurants[] = $the_restaurant['restaurant'];
			}
			wp_set_object_terms( $post_id, $restaurants, 'restaurants' );
            
			$the_stores = $_POST['store'];
			foreach($the_stores as $the_store) {
					$stores[] = $the_store['store'];
			}
			wp_set_object_terms( $post_id, $stores, 'stores' );
                       
            $bjcpstyles = $_POST['bjcpstyles'];
			wp_set_object_terms( $post_id, $bjcpstyles, 'bjcpstyles' );
		}
}
?>