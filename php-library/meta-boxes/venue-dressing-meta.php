<?

/*************** ENABLE META BOXES *********************/


add_filter('rwmb_meta_boxes', 'pg_register_venue_dressing_meta_boxes');
function pg_register_venue_dressing_meta_boxes($meta_boxes) {


     $meta_boxes[] = array(
       		'title'    => 'Venue Dressing Information',
       		'pages'    => array('venue-dressing'),
			'priority' => 'high',
			'autosave' => true,
			'fields' => array(


                array (
                     'name' => __('More info header', 'rwmb'),
                     'id'   => 'more-info-h2',
                     'type' => 'text',
                    ),

                array (
                    'name'  => __('Gallery Images', 'rwmb'),
                    'id'    => 'photos',
                    'type'  => 'image_advanced',
	     		   ),


               array(
					'name'    => __('Show specific tents?', 'rwmb'),
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
