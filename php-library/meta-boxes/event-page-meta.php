<?

function pg_register_event_page_meta_boxes($meta_boxes)
{
    $post_id = post_id();
    $template_file = get_post_meta($post_id,'_wp_page_template',TRUE);

    if ($template_file == 'my-templates/event-sub-page.php' || $template_file == 'my-templates/additional-service-page.php') {
        $meta_boxes[] = [
            'title'    => 'Event Page',
            'pages'    => ['page'],
            'priority' => 'high',
            'autosave' => true,
            'fields' => [
                [
                    'name' => __('More info header', 'rwmb'),
                    'id'   => 'more-info-h2',
                    'type' => 'text',
                ],
                [
                    'name' => __('Singular description?', 'rwmb'),
                    'id'   => 'singular-desc',
                    'type' => 'text',
                ],
                [
                    'name'  => __('Gallery Images', 'rwmb'),
                    'id'    => 'photos',
                    'type'  => 'image_advanced',
                ],
                [
                    'name'  => __('Supporting videos', 'rwmb'),
                    'id'    => 'videos',
                    'type'  => 'text',
                    'clone' => true
                ],
            ],
        ];

        $meta_boxes[] = [
            'title' => 'Event Management Information',
            'pages'    => ['page'],
            'priority' => 'high',
            'autosave' => true,
            'fields' => [
                [
                    'name' => __('Title', 'rwmb'),
                    'id'   => 'event-management-h2',
                    'type' => 'text',
                ],
                [
                    'name' => __('Content', 'rwmb'),
                    'id'   => 'event-management-content',
                    'type' => 'wysiwyg',
                ],
                [
                    'name' => __('Event Managers', 'rwmb'),
                    'id'   => 'event-managers',
                    'type' => 'user',
                    'field_type' => 'select_advanced',
                    'multiple' => 'true',
                ],
                [
                    'name' => __('Event Management Services', 'rwmb'),
                    'id'   => 'additional-services',
                    'type'    => 'post',
                    'post_type' => 'page',
                    'field_type' => 'select_advanced',
                    'multiple' => 'true',
                    'placeholder' => __('Additional Services', 'rwmb'),
                    'query_args' => [
                        'post_status' => 'publish',
                        'posts_per_page' => '-1',
                        'tax_query' => [
                            [
                                'taxonomy' => 'page-type',
                                'field' => 'slug',
                                'terms' => 'additional-service'
                            ]
                        ]
                    ],
                ]
            ],
        ];

        $meta_boxes[] = [
            'title'    => 'Sticky CTA',
            'pages'    => ['page'],
            'priority' => 'high',
            'autosave' => true,
            'fields' => [
                [
                    'name' => __('Sticky CTA text', 'rwmb'),
                    'id'   => 'sticky-cta-text',
                    'type' => 'text',
                ],

            ],
        ];
    }

    return $meta_boxes;
}
add_filter('rwmb_meta_boxes', 'pg_register_event_page_meta_boxes');
