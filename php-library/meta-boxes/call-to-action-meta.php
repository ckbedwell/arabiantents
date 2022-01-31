<?


/*************** ENABLE META BOXES *********************/

add_filter('rwmb_meta_boxes', 'pg_register_cta_meta_boxes');
function pg_register_cta_meta_boxes($meta_boxes) {

		$meta_boxes[] = array(
       		'title'    => 'Call to Action Information',
       		'pages'    => array('cta'),
			'priority' => 'high',
			'autosave' => true,
			'fields' => array(

                array (
                     'name' => __('Link to', 'rwmb'),
                     'id'   => 'link-to',
                     'type' => 'text',
                    ),

                array (
                    'name'  => __('Button text', 'rwmb'),
                    'id'    => 'button-text',
                    'type'  => 'text',
	     		   ),
				),
			);

    return $meta_boxes;
}
