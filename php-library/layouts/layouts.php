<?

/************************ REGISTER CASE STUDIES ************************************************************************************/

function digicrab_three_fifty_layout_custom_posts() {
    $labels = array(
        'name'          => _x('Layouts', 'post type general name'),
        'singular_name' => _x('Layout', 'post type singular name'),
        'add_new'       => _x('Add New Layout', 'layout'),
        'add_new_item'       => __('Add New Layout'),
        'edit_item'          => __('Edit Layout'),
        'new_item'           => __('New Layout'),
        'all_items'          => __('All Layouts'),
        'view_item'          => __('View Layout'),
        'search_items'       => __('Search Layouts'),
        'not_found'          => __('No Layouts found'),
        'not_found_in_trash' => __('No Layouts found in the Trash'),
        'parent_item_colon'  => '',
        'menu_name'          => 'Layouts'
    );

    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds our layouts and layout-specific data',
        'public'        => true,
        'menu_position' => 4,
        'menu_icon'   => 'dashicons-layout',
        'supports'      => array('title', 'editor', 'thumbnail', 'revisions', 'author'),
        'taxonomies' => array('post_tag'),
        'has_archive'   => true,
        'rewrite'       => array(
            'slug' => 'event/layouts',
            'with_front' => false,
            ),

    );

    register_post_type('layout', $args);

}

add_action('init', 'digicrab_three_fifty_layout_custom_posts');


/********************* CUSTOM MESSAGES **********************/

function my_updated_layout_messages($messages) {
    global $post, $post_ID;

    $messages['layout'] = array(
        0 => '',
        1 => sprintf(__('Layout updated. <a href="%s">View Layout</a>'), esc_url(get_permalink($post_ID))),
        2 => __('Custom field updated.'),
        3 => __('Custom field deleted.'),
        4 => __('Layout updated.'),
        5 => isset($_GET['revision']) ? sprintf(__('Layouts restored to revision from %s'), wp_post_revision_title((int) $_GET['revision'], false)) : false,
        6 => sprintf(__('Layout published. <a href="%s">View Layout</a>'), esc_url(get_permalink($post_ID))),
        7 => __('Layouts saved.'),
        8 => sprintf(__('Layout submitted. <a target="_blank" href="%s">Preview Layout</a>'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
        9 => sprintf(__('Layout scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Layout</a>'), date_i18n(__('M j, Y @ G:i'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
        10 => sprintf(__('Layout draft updated. <a target="_blank" href="%s">Preview Layout</a>'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
    );

    return $messages;

}
add_filter('post_updated_messages', 'my_updated_layout_messages');
