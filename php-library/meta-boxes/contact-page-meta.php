<?

function pg_register_contact_meta_boxes($meta_boxes)
{
    $post_id = post_id();
    $template_file = get_post_meta($post_id,'_wp_page_template',TRUE);

    if ($template_file == 'my-templates/contact-page.php') {
        $meta_boxes[] = [
            'title'    => 'Address for map',
            'pages'    => ['page'],
            'priority' => 'high',
            'autosave' => true,
            'fields' => [
                [
                    'name' => __('Complete Address', 'rwmb'),
                    'id' => "address",
                    'type' => 'text',
                ],
                [
                    'id' => 'loc',
                    'name' => __('Location', 'rwmb'),
                    'type' => 'map',
                    'std' => '-6.233406, -35.049906, 15',     // 'latitude,longitude[,zoom]' (zoom is optional)
                    'style' => 'width: 600px; height: 400px',
                    'address_field' => 'address',
                ],
            ]
        ];
    }

    return $meta_boxes;
}
add_filter('rwmb_meta_boxes', 'pg_register_contact_meta_boxes');
