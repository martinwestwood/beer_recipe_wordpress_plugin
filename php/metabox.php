<?php
// Add Meta Box
add_action('admin_menu', 'recipe_add_box');
function recipe_add_box() {
    global $meta_fields;
    add_meta_box('beer-recipe', 'Beer Recipe', 'beer_recipe_show_box', 'brew_beer_recipe', 'normal', 'high');
}

// Custom Fields
$meta_fields = array(
	array(
		'name'	=> 'Grains',
		'desc'	=> 'Click the plus icon to add another grain. <a href="'.get_bloginfo('home').'/wp-admin/edit-tags.php?taxonomy=grains">Manage Grains</a>',
		'id'	=> 'grain',
		'type'	=> 'grain'
	)
);


// The Callback
function beer_recipe_show_box() {
	global $meta_fields, $post;
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
							<li class="th cell-notes">Notes</li>
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
							'<li class="td cell-grain"><input type="text" name="grain['.$i.'][grain]" id="grain_'.$i.'" onfocus="setSuggest(\'grain_'.$i.'\');" value="', $row['grain'],'" size="30" class="grain" placeholder="start typing a grain" /></li>', // grain
							'<li class="td cell-notes"><input type="text" name="grain['.$i.'][notes]" id="grain_notes_'.$i.'" value="', $row['notes'],'" size="30" placeholder="e.g., chopped, sifted, fresh" /></li>', // notes
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
							'<li class="td cell-grain"><input type="text" name="grain['.$i.'][grain]" id="grain_'.$i.'" onfocus="setSuggest(\'grain_'.$i.'\');" value="" size="30" class="grain" placeholder="start typing a grain" /></li>', // grain
							'<li class="td cell-notes"><input type="text" name="grain['.$i.'][notes]" id="grain_notes_'.$i.'" value="" size="30" class=" " placeholder="e.g., chopped, fresh, etc." /></li>', // notes
							'<li class="td"><a class="grain_remove" href="#"></a></li>', // remove
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
}
?>