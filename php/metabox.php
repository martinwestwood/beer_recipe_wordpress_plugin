<?php
// Add Meta Box
add_action('admin_menu', 'beer_recipe_add_box');
function beer_recipe_add_box() {
    global $meta_fields;
    add_meta_box('beer-recipe', 'Beer Recipe', 'beer_recipe_show_box', 'beer_recipe', 'normal', 'high');
}

// Custom Fields
$meta_fields = array(
	array(
		'name'	=> 'Grains',
		'desc'	=> 'Click the plus icon to add another grain. <a href="'.get_bloginfo('home').'/wp-admin/edit-tags.php?taxonomy=grains">Manage Grains</a>',
		'id'	=> 'grain',
		'type'	=> 'grain'
	),
    array(
		'name'	=> 'Hops',
		'desc'	=> 'Click the plus icon to add another hop. <a href="'.get_bloginfo('home').'/wp-admin/edit-tags.php?taxonomy=hops">Manage Hops</a>',
		'id'	=> 'hop',
		'type'	=> 'hop'
	)
);


// The Callback
function beer_recipe_show_box() {
	global $meta_fields, $post, $measurements_singular, $measurements_plural;
	// Use nonce for verification
    echo '<input type="hidden" name="beer_recipe_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	echo '<div id="beer_recipe_table"><table class="form-table">';
    foreach ($meta_fields as $field) {
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
							'<li class="td"><a class="hop_remove" href="#"></a></li>', // remove
							'<li class="clear"></li>', // clear
						'</ul>';
				}
				echo '</li></ul>',
					'<span class="description">', $field['desc'], '</span>';
            break;
		}
    }
    echo '</table></div>';
}


// Save the Data
add_action('save_post', 'beer_recipe_save_data');
// Save data from meta box
function beer_recipe_save_data($post_id) {
    global $meta_fields;
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
		foreach ($meta_fields as $field) {
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
		if (($post->post_type == 'beer-recipe')) { 
			$the_grains = $_POST['grain'];
			foreach($the_grains as $the_grains) {
					$grains[] = $the_grains['grain'];
			}
			wp_set_object_terms( $post_id, $grains, 'grain' );
            
			$the_hops = $_POST['hop'];
			foreach($the_hops as $the_hops) {
					$hops[] = $the_hops['hop'];
			}
			wp_set_object_terms( $post_id, $hops, 'hop' );
		}
}
?>