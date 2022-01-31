<?


/*************** ENABLE META BOXES *********************/

add_filter('rwmb_meta_boxes', 'pg_register_universal_meta_boxes');
function pg_register_universal_meta_boxes($meta_boxes) {


        $meta_boxes[] = array(
            'title'    => 'Specific blog or testimonial:',
            'pages'    => array('page', 'venue-dressing'),
            'priority' => 'high',
            'autosave' => true,
            'context' => 'side',
            'fields' => array(
                array(
                    'name' => 'Small header?',
                    'id' => 'small-header',
                    'type' => 'checkbox',
                    ),

                array(
                    'name' => 'Read More Text',
                    'id' => 'read-more-text',
                    'type' => 'text',
                    ),

                array(
                    'name' => 'Hide event on enquiry form?',
                    'id' => 'hide-event',
                    'type' => 'checkbox',
                    ),

                array(
                    'name'    => __('Specific blog post to show?', 'rwmb'),
                    'id'      => "specific-blog",
                    'type'    => 'post',
                    'post_type' => 'post',
                    'field_type' => 'select_advanced',
                    'multiple' => 'true',
                    'placeholder' => __('Select an Item', 'rwmb'),
                    'query_args' => array(
                        'post_status' => 'publish',
                        'posts_per_page' => '-1',
                        ),
                    ),

                array(
                    'name'    => __('Specific testimonial to show?', 'rwmb'),
                    'id'      => "specific-testimonial",
                    'type'    => 'post',
                    'post_type' => 'testimonial',
                    'field_type' => 'select_advanced',
                    'multiple' => 'true',
                    'placeholder' => __('Select an Item', 'rwmb'),
                    'query_args' => array(
                        'post_status' => 'publish',
                        'posts_per_page' => '-1',
                        ),
                    ),

                array(
                    'name' => 'Page Icon',
                    'id' => 'page-icon',
                    'type' => 'text',
                    ),


            ),
        );

    return $meta_boxes;
}
