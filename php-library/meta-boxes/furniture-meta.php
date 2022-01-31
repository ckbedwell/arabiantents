<?


/*************** ENABLE META BOXES *********************/

add_filter('rwmb_meta_boxes', 'pg_register_furniture_meta_boxes');
function pg_register_furniture_meta_boxes($meta_boxes) {


		/****************** WHAT'S NEXT *************/

		$meta_boxes[] = array(
       		'title'    => 'Furniture Information',
       		'pages'    => array('furniture'),
			'priority' => 'high',
			'autosave' => true,
			'fields' => array(
                 array (
                     'name' => __('Price (£):', 'rwmb'),
                     'id'   => 'furniture-price',
                     'type' => 'number',
                    ),

                 array (
                     'name' => __('Mark price as from?', 'rwmb'),
                     'id'   => 'from-prefix',
                     'type' => 'checkbox',
                    ),

                array (
                    'name'  => __('Gallery Images', 'rwmb'),
                    'id'    => 'photos',
                    'type'  => 'image_advanced',
	     		   ),

                array(
					'name'    => __('Which tents does this work well with?', 'rwmb'),
					'id'      => "specific-tents",
					'type'    => 'post',
					'post_type' => 'tent',
					'field_type' => 'select_advanced',
                    'multiple' => 'true',
					'placeholder' => __('Select an Item', 'rwmb'),
					'query_args' => array(
						'post_status' => 'publish',
						'posts_per_page' => '-1',
						),
					),
               ),
			);


        return $meta_boxes;
}
