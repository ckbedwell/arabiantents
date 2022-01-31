<?


/*************** ENABLE META BOXES *********************/

add_filter('rwmb_meta_boxes', 'pg_register_layout_meta_boxes');
function pg_register_layout_meta_boxes($meta_boxes) {


		/****************** WHAT'S NEXT *************/

		$meta_boxes[] = array(
       		'title'    => 'Layout Information',
       		'pages'    => array('layout'),
			'priority' => 'high',
			'autosave' => true,
			'fields' => array(
                array (
                     'name' => __('Example Price Title', 'rwmb'),
                     'id'   => 'example-title',
                     'type' => 'text',
                    ),

                array (
                     'name' => __('Max capacity', 'rwmb'),
                     'id'   => 'max-capacity',
                     'type' => 'number',
                    ),

                 array (
                     'name' => __('Dining guests capacity', 'rwmb'),
                     'id'   => 'max-dining-capacity',
                     'type' => 'number',
                    ),

                 array (
                     'name' => __('Example Price', 'rwmb'),
                     'id'   => 'example-price',
                     'type' => 'number',
                    ),
                ),


			);


        return $meta_boxes;
}
