<?


/*************** ENABLE META BOXES *********************/

add_filter('rwmb_meta_boxes', 'pg_register_photographer_meta_boxes');
function pg_register_photographer_meta_boxes($meta_boxes) {


		$meta_boxes[] = array(
       		'title'    => 'Photographer Information',
       		'pages'    => array('photographer'),
			'priority' => 'high',
			'autosave' => true,
			'fields' => array(
                 array (
                    'name'  => __('Gallery Images', 'rwmb'),
                    'id'    => 'photos',
                    'type'  => 'image_advanced',
	     		   ),

                array (
                     'name' => __('Photographer office?', 'rwmb'),
                     'id'   => 'photographer-office',
                     'type' => 'text',
                    ),

                array (
                     'name' => __('Photographer mobile?', 'rwmb'),
                     'id'   => 'photographer-mobile',
                     'type' => 'text',
                    ),

                array (
                    'name'  => __('Photographer email?', 'rwmb'),
                    'id'    => 'photographer-email',
                    'type'  => 'text',
	     		   ),

                 array (
                     'name' => __('Photographer website?', 'rwmb'),
                     'id'   => 'photographer-website',
                     'type' => 'text',
                    ),

				),
			);

            $meta_boxes[] = array(
                 'title'    => 'Photographer Questions',
                 'pages'    => array('photographer'),
                 'priority' => 'high',
                 'autosave' => true,
                 'fields' => array(

                     array (
                          'name' => __('How did you get into photography?', 'rwmb'),
                          'id'   => 'photographer-q1',
                          'type' => 'wysiwyg',
                         ),

                     array (
                          'name' => __('How would you describe your style?', 'rwmb'),
                          'id'   => 'photographer-q2',
                          'type' => 'wysiwyg',
                         ),

                     array (
                         'name'  => __('What is the best wedding youve ever shot?', 'rwmb'),
                         'id'    => 'photographer-q3',
                         'type'  => 'wysiwyg',
                        ),

                      array (
                          'name' => __('What tip would you give to Brides and Grooms when choosing a photographer?', 'rwmb'),
                          'id'   => 'photographer-q4',
                          'type' => 'wysiwyg',
                         ),

                    ),
                );

    return $meta_boxes;
}
