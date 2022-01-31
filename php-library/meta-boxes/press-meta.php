<?


/*************** ENABLE META BOXES *********************/

add_filter('rwmb_meta_boxes', 'pg_register_press_meta_boxes');
function pg_register_press_meta_boxes($meta_boxes) {

		$meta_boxes[] = array(
       		'title'    => 'Related Tents',
       		'pages'    => array('press'),
			'priority' => 'high',
			'autosave' => true,
			'context' => 'side',
			'fields' => array(


				array(
					'name'    => __('What tents are mentioned in this post?', 'rwmb'),
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

		$meta_boxes[] = array(
       		'title'    => 'Press Information',
       		'pages'    => array('press'),
			'priority' => 'high',
			'autosave' => true,
			'fields' => array(

                array (
                     'name' => __('Where was it published?', 'rwmb'),
                     'id'   => 'published-location',
                     'type' => 'text',
                    ),

                array (
                    'name'  => __('When was it published?', 'rwmb'),
                    'id'    => 'publish-date',
                    'type'  => 'text',
	     		   ),

                 array (
                     'name' => __('Website', 'rwmb'),
                     'id'   => 'published-website',
                     'type' => 'text',
                    ),


				),
			);

    return $meta_boxes;
}
