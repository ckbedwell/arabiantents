<?


/*************** ENABLE META BOXES *********************/

add_filter('rwmb_meta_boxes', 'pg_register_tent_meta_boxes');
function pg_register_tent_meta_boxes($meta_boxes) {


		/****************** WHAT'S NEXT *************/

		$meta_boxes[] = array(
       		'title'    => 'Tent Information',
       		'pages'    => array('tent'),
			'priority' => 'high',
			'autosave' => true,
			'fields' => array(
                 array (
                     'name' => __('Max Capacity', 'rwmb'),
                     'id'   => 'max-capacity',
                     'type' => 'number',
                    ),

                array (
                     'name' => __('Minimum Area Required (metres)', 'rwmb'),
                     'id'   => 'min-size',
                     'type' => 'text',
                    ),

                 array (
                     'name' => __('Build Time', 'rwmb'),
                     'id'   => 'build-time',
                     'type' => 'text',
                    ),

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
					'name'    => __('Show specific testimonial?', 'rwmb'),
					'id'      => "specific-testimonial",
					'type'    => 'post',
					'post_type' => 'testimonial',
					'field_type' => 'select_advanced',
					'placeholder' => __('Select an Item', 'rwmb'),
					'query_args' => array(
						'post_status' => 'publish',
						'posts_per_page' => '-1',
						),
					),

                 array (
                     'name' => __('Interactive tour URL:', 'rwmb'),
                     'id'   => 'tour-url',
                     'type' => 'text',
                    ),


				),
			);

        $meta_boxes[] = array(
               'title' => 'How Previous Customers',
               'pages'    => array('tent'),
               'priority' => 'high',
               'autosave' => true,
               'fields' => array(
               // Group
               array(
                    'name' => 'How Previous Customers have Used this Tent', // Optional
                    'id' => 'previous_customers',
                    'type' => 'group',
                    'clone'  => true,
                    'sort_clone' => true,
                    'fields' => array(
                         array(
                              'name' => 'This tent tag image',
                              'id' => 'tent-tag-image',
                              'type' => 'image_advanced',
                             ),

                         array(
                              'name'    => 'Which tag?',
                              'id'      => 'specific-tag',
                              'type'    => 'taxonomy_advanced',
                              'taxonomy' => 'post_tag',
                              'placeholder' => 'Select an Item',
                             ),
                        ),
                   ),
              ),
         );


        return $meta_boxes;
}
