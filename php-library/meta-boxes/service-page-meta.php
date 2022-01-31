<?

function hide__service_page_editor()
{
    $post_id = post_id();

    if(!isset($post_id)) {
        return;
    }

    // Get the name of the Page Template file.
    $template_file = get_post_meta($post_id, '_wp_page_template', true);

    // edit the template name
    if ($template_file == 'my-templates/service-page.php') {
        remove_post_type_support('page', 'editor');
    }
}
add_action('admin_init', 'hide__service_page_editor');

function register_service_meta_boxes($meta_boxes)
{
    $post_id = post_id();
    $template_file = get_post_meta($post_id, '_wp_page_template', true);

    if ($template_file == 'my-templates/service-page.php') {
        $meta_boxes[] = [
            'title'    => 'Header',
            'pages'    => ['page'],
            'priority' => 'high',
            'autosave' => true,
            'fields' => [
                [
                    'name'  => __('Byline', 'rwmb'),
                    'id'    => "byline",
                    'type' => 'text',
                ],
                [
                    'name' => __('Introduction', 'rwmb'),
                    'id'   => "introduction",
                    'type' => 'wysiwyg',
                    // Set the 'raw' parameter to true to prevent data being passed through wpautop() on save
                    'raw'  => false,
                    'std'  => __('WYSIWYG default value', 'rwmb'),

                    // Editor settings, see wp_editor() function: look4wp.com/wp_editor
                    'options' => [
                        'textarea_rows' => 4,
                        'teeny'         => false,
                        'media_buttons' => false,
                    ]
                ],
            ],
        ];

        $meta_boxes[] = [
            'title'    => 'Opening columns',
            'pages'    => ['page'],
            'priority' => 'high',
            'autosave' => true,
            'fields' => [
                [
                    'name'  => __('Opening Text H2', 'rwmb'),
                    'id'    => "opening-text-h2",
                    'type' => 'text',
                ],
                [
                    'name' => __('Opening text', 'rwmb'),
                    'id'   => "opening-text",
                    'type' => 'wysiwyg',
                    'raw'  => false,
                    'std'  => __('WYSIWYG default value', 'rwmb'),
                    'options' => [
                        'textarea_rows' => 8,
                        'teeny'         => false,
                        'media_buttons' => false,
                    ],
                ],
                [
                    'name' => __('Quote', 'rwmb'),
                    'id'   => "quote",
                    'type' => 'wysiwyg',
                    'raw'  => true,
                    'std'  => __('WYSIWYG default value', 'rwmb'),
                    'options' => [
                        'textarea_rows' => 4,
                        'teeny'         => false,
                        'media_buttons' => false,
                    ],
                ],
                [
                    'name' => __('Quote attribution', 'rwmb'),
                    'id'   => "quote-attributed",
                    'type' => 'text'
                ]
            ]
        ];

        $meta_boxes[] = [
            'title'    => 'How we can help',
            'pages'    => ['page'],
            'priority' => 'high',
            'autosave' => true,
            'fields' => [
                [
                    'name'  => __('How we can help H2', 'rwmb'),
                    'id'    => "help-h2",
                    'type' => 'text',
                ],
                [
                    'name' => __('How we can help intro text', 'rwmb'),
                    'id'   => "help-text",
                    'type' => 'wysiwyg',
                    'raw'  => false,
                    'std'  => __('WYSIWYG default value', 'rwmb'),
                    'options' => [
                        'textarea_rows' => 8,
                        'teeny'         => false,
                        'media_buttons' => false,
                    ],
                ],
                [
                    'name'  => __('Help point one title', 'rwmb'),
                    'id'    => "help-point-one-title",
                    'type' => 'text',
                ],
                [
                    'name' => __('Help point one', 'rwmb'),
                    'id'   => "help-point-one",
                    'type' => 'wysiwyg',
                    'raw'  => false,
                    'std'  => __('WYSIWYG default value', 'rwmb'),
                    'options' => [
                        'textarea_rows' => 8,
                        'teeny'         => false,
                        'media_buttons' => false,
                    ],
                ],
                [
                    'name'  => __('Help point two title', 'rwmb'),
                    'id'    => "help-point-two-title",
                    'type' => 'text',
                ],
                [
                    'name' => __('Help point two', 'rwmb'),
                    'id'   => "help-point-two",
                    'type' => 'wysiwyg',
                    'raw'  => false,
                    'std'  => __('WYSIWYG default value', 'rwmb'),
                    'options' => [
                        'textarea_rows' => 8,
                        'teeny'         => false,
                        'media_buttons' => false,
                    ],
                ],
                [
                    'name'  => __('Help point three title', 'rwmb'),
                    'id'    => "help-point-three-title",
                    'type' => 'text',
                ],
                [
                    'name' => __('Help point three', 'rwmb'),
                    'id'   => "help-point-three",
                    'type' => 'wysiwyg',
                    'raw'  => false,
                    'std'  => __('WYSIWYG default value', 'rwmb'),
                    'options' => [
                        'textarea_rows' => 8,
                        'teeny'         => false,
                        'media_buttons' => false,
                    ],
                ],

            ]
        ];

        $meta_boxes[] = [
            'title'    => 'The Process',
            'pages'    => ['page'],
            'priority' => 'high',
            'autosave' => true,
            'fields' => [
                [
                    'name'  => __('The Process H2', 'rwmb'),
                    'id'    => "the-process-h2",
                    'type' => 'text',
                ],
                [
                    'name' => __('Opening text', 'rwmb'),
                    'id'   => "the-process-intro",
                    'type' => 'wysiwyg',
                    'raw'  => false,
                    'std'  => __('WYSIWYG default value', 'rwmb'),
                    'options' => [
                        'textarea_rows' => 8,
                        'teeny'         => false,
                        'media_buttons' => false,
                    ],
                ],
                [
                    'name'  => __('Bullet process one title', 'rwmb'),
                    'id'    => "bullet-process-one-title",
                    'type' => 'text',
                ],
                [
                    'name' => __('Bullet process one', 'rwmb'),
                    'id'   => "bullet-process-one",
                    'type' => 'wysiwyg',
                    'raw'  => false,
                    'std'  => __('WYSIWYG default value', 'rwmb'),
                    'options' => [
                        'textarea_rows' => 8,
                        'teeny'         => false,
                        'media_buttons' => false,
                    ],
                ],
                [
                    'name'  => __('Bullet process two title', 'rwmb'),
                    'id'    => "bullet-process-two-title",
                    'type' => 'text',
                ],
                [
                    'name' => __('Bullet process twp', 'rwmb'),
                    'id'   => "bullet-process-two",
                    'type' => 'wysiwyg',
                    'raw'  => false,
                    'std'  => __('WYSIWYG default value', 'rwmb'),
                    'options' => [
                        'textarea_rows' => 8,
                        'teeny'         => false,
                        'media_buttons' => false,
                    ],
                ],
                [
                    'name'  => __('Bullet process three title', 'rwmb'),
                    'id'    => "bullet-process-three-title",
                    'type' => 'text',
                ],
                [
                    'name' => __('Bullet process three', 'rwmb'),
                    'id'   => "bullet-process-three",
                    'type' => 'wysiwyg',
                    'raw'  => false,
                    'std'  => __('WYSIWYG default value', 'rwmb'),
                    'options' => [
                        'textarea_rows' => 8,
                        'teeny'         => false,
                        'media_buttons' => false,
                    ],
                ],
                [
                    'name'  => __('Bullet process four title', 'rwmb'),
                    'id'    => "bullet-process-four-title",
                    'type' => 'text',
                ],
                [
                    'name' => __('Bullet process four', 'rwmb'),
                    'id'   => "bullet-process-four",
                    'type' => 'wysiwyg',
                    'raw'  => false,
                    'std'  => __('WYSIWYG default value', 'rwmb'),
                    'options' => [
                        'textarea_rows' => 8,
                        'teeny'         => false,
                        'media_buttons' => false,
                    ],
                ],
                [
                    'name'  => __('Bullet process five title', 'rwmb'),
                    'id'    => "bullet-process-five-title",
                    'type' => 'text',
                ],
                [
                    'name' => __('Bullet process five', 'rwmb'),
                    'id'   => "bullet-process-five",
                    'type' => 'wysiwyg',
                    'raw'  => false,
                    'std'  => __('WYSIWYG default value', 'rwmb'),
                    'options' => [
                        'textarea_rows' => 8,
                        'teeny'         => false,
                        'media_buttons' => false,
                    ],
                ],
                [
                    'name'  => __('Bullet process six title', 'rwmb'),
                    'id'    => "bullet-process-six-title",
                    'type' => 'text',
                ],
                [
                    'name' => __('Bullet process six', 'rwmb'),
                    'id'   => "bullet-process-six",
                    'type' => 'wysiwyg',
                    'raw'  => false,
                    'std'  => __('WYSIWYG default value', 'rwmb'),
                    'options' => [
                        'textarea_rows' => 8,
                        'teeny'         => false,
                        'media_buttons' => false,
                    ],
                ],

            ]
        ];

        $meta_boxes[] = [
            'title'    => 'Tools/techniques',
            'pages'    => ['page'],
            'priority' => 'high',
            'autosave' => true,
            'fields' => [
                [
                    'name'  => __('Tools and techniques H2', 'rwmb'),
                    'id'    => "tools-and-techniques-h2",
                    'type' => 'text',
                ],
                [
                    'name' => __('Tools and techniques text', 'rwmb'),
                    'id'   => "tools-and-techniques",
                    'type' => 'wysiwyg',
                    'raw'  => false,
                    'std'  => __('WYSIWYG default value', 'rwmb'),
                    'options' => [
                        'textarea_rows' => 8,
                        'teeny'         => false,
                        'media_buttons' => false,
                    ],
                ],
                [
                    'name'  => __('Tool or technique 1', 'rwmb'),
                    'id'    => "tool-or-technique-1",
                    'type' => 'text',
                ],
                [
                    'name'  => __('Tool or technique 2', 'rwmb'),
                    'id'    => "tool-or-technique-2",
                    'type' => 'text',
                ],
                [
                    'name'  => __('Tool or technique 3', 'rwmb'),
                    'id'    => "tool-or-technique-3",
                    'type' => 'text',
                ],
                [
                    'name'  => __('Tool or technique 4', 'rwmb'),
                    'id'    => "tool-or-technique-4",
                    'type' => 'text',
                ],
                [
                    'name'  => __('Tool or technique 5', 'rwmb'),
                    'id'    => "tool-or-technique-5",
                    'type' => 'text',
                ],
                [
                    'name'  => __('Tool or technique 6', 'rwmb'),
                    'id'    => "tool-or-technique-6",
                    'type' => 'text',
                ],
                [
                    'name'  => __('Tool or technique 7', 'rwmb'),
                    'id'    => "tool-or-technique-7",
                    'type' => 'text',
                ],
                [
                    'name'  => __('Tool or technique 8', 'rwmb'),
                    'id'    => "tool-or-technique-8",
                    'type' => 'text',
                ],
            ]
        ];
    }

    return $meta_boxes;
}
add_filter('rwmb_meta_boxes', 'register_service_meta_boxes');
