<?

/************** HIDE INITIAL EDITOR *********************/
function hide_editor() {
    $post_id = post_id();

    if(!isset($post_id)) {
        return;
    }

// Get the name of the Page Template file.
    $template_file = get_post_meta($post_id, '_wp_page_template', true);
}
add_action('admin_init', 'hide_editor');

/*************** ENABLE META BOXES *********************/
function pg_register_super_meta_boxes($meta_boxes) {
    $post_id = post_id();

    $template_file = get_post_meta($post_id, '_wp_page_template', true);

    if ($template_file == 'my-templates/page-home.php') {
        $meta_boxes[] = [
            'title' => 'Slider',
            'pages' => ['page'],
            'priority' => 'high',
            'autosave' => true,
            'fields' => [
                [
                    'name' => __('Slide Image', 'rwmb'),
                    'id' => "slide-image-one",
                    'type' => 'image_advanced',
                    'max_file_uploads' => 1,
                ],
                [
                    'name' => __('Slide Image', 'rwmb'),
                    'id' => "slide-image-two",
                    'type' => 'image_advanced',
                    'max_file_uploads' => 1,
                ],
                [
                    'name' => __('Slide Image', 'rwmb'),
                    'id' => "slide-image-three",
                    'type' => 'image_advanced',
                    'max_file_uploads' => 1,
                ],
                [
                    'name' => __('Slide Image', 'rwmb'),
                    'id' => "slide-image-four",
                    'type' => 'image_advanced',
                    'max_file_uploads' => 1,
                ],
                [
                    'name' => __('Slide Image', 'rwmb'),
                    'id' => "slide-image-five",
                    'type' => 'image_advanced',
                    'max_file_uploads' => 1,
                ],
                [
                    'name' => __('Slide Image', 'rwmb'),
                    'id' => "slide-image-six",
                    'type' => 'image_advanced',
                    'max_file_uploads' => 1,
                ]
            ]
        ];

        $meta_boxes[] = [
            'title'    => 'Slider Text',
            'pages'    => ['page'],
            'priority' => 'high',
            'autosave' => true,
            'fields' => [
                [
                    'name' => __('Slider H2', 'rwmb'),
                    'id' => "intro-h2",
                    'type' => 'text',
                ],
                [
                    'name' => __('Slider Text', 'rwmb'),
                    'id' => "intro-text",
                    'type' => 'wysiwyg',
                    'raw' => false,
                    'std' => __('WYSIWYG default value', 'rwmb'),
                    'options' => [
                        'textarea_rows' => 4,
                        'teeny' => false,
                        'media_buttons' => false,
                    ]
                ],
                [
                    'name' => __('CTA Image', 'rwmb'),
                    'id' => "intro-cta-text",
                    'type' => 'image_advanced',
                    'max_file_uploads' => 1,
                ],
                [
                    'name' => __('CTA Link', 'rwmb'),
                    'id' => "intro-cta-link",
                    'type' => 'text',
                ],
                [
                    'name' => __('Video', 'rwmb'),
                    'id' => "video",
                    'type' => 'file_advanced',
                    'max_file_uploads' => 1,
                ],
                [
                    'name' => __('Backup Image', 'rwmb'),
                    'id' => "video-cover",
                    'type' => 'image_advanced',
                    'max_file_uploads' => 1,
                ],
            ]
        ];
    }

    return $meta_boxes;
}
add_filter('rwmb_meta_boxes', 'pg_register_super_meta_boxes');
