<?


/*************** ENABLE META BOXES *********************/

add_filter('rwmb_meta_boxes', 'pg_register_venue_meta_boxes');
function pg_register_venue_meta_boxes($meta_boxes) {


		/****************** WHAT'S NEXT *************/

		$meta_boxes[] = array(
       		'title'    => 'Venue Information',
       		'pages'    => array('venue'),
			'priority' => 'high',
			'autosave' => true,
			'fields' => array(
                array (
                     'name' => __('Address', 'rwmb'),
                     'id'   => 'venue-address',
                     'type' => 'text',
                    ),

                array(
                     'id'            => 'loc',
                     'name'          => __('Location', 'rwmb'),
                     'type'          => 'map',
                     'std'           => '-6.233406, -35.049906, 15',     // 'latitude,longitude[,zoom]' (zoom is optional)
                     'style'         => 'width: 600px; height: 400px',
                     'address_field' => 'venue-address',
                     'api_key'       => 'AIzaSyBjvS-FtBe5Z1iR8mIJGLB3pEXB0F9Bmp4',
                    ),

                array (
                     'name' => __('Phone Number', 'rwmb'),
                     'id'   => 'venue-phone',
                     'type' => 'text',
                    ),

                array (
                     'name' => __('Email', 'rwmb'),
                     'id'   => 'venue-email',
                     'type' => 'text',
                    ),

                array (
                     'name' => __('Website', 'rwmb'),
                     'id'   => 'venue-website',
                     'type' => 'text',
                    ),

                array (
                     'name' => __('More info header', 'rwmb'),
                     'id'   => 'more-info-h2',
                     'type' => 'text',
                    ),

                array (
                    'name'  => __('Additional Images', 'rwmb'),
                    'id'    => 'venue-photos',
                    'type'  => 'image_advanced',
	     		   ),


				),
			);


        return $meta_boxes;
}
