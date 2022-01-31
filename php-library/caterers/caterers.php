<?

/************************ REGISTER CASE STUDIES ************************************************************************************/

function digicrab_three_fifty_caterers_custom_posts() {
    $labels = array(
        'name'          => _x('Caterers', 'post type general name'),
        'singular_name' => _x('Caterer', 'post type singular name'),
        'add_new'       => _x('Add New Caterer', 'caterer'),
        'add_new_item'       => __('Add New Caterer'),
        'edit_item'          => __('Edit Caterer'),
        'new_item'           => __('New Caterer'),
        'all_items'          => __('All Caterers'),
        'view_item'          => __('View Caterer'),
        'search_items'       => __('Search Caterers'),
        'not_found'          => __('No Caterers found'),
        'not_found_in_trash' => __('No Caterers found in the Trash'),
        'parent_item_colon'  => '',
        'menu_name'          => 'Caterers'
    );

    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds our caterer and caterer-specific data',
        'public'        => true,
        'menu_position' => 4,
        'menu_icon'   => 'dashicons-carrot',
        'supports'      => array('title', 'editor', 'thumbnail', 'revisions', 'author'),
        'taxonomies' => array('post_tag'),
        'has_archive'   => false,
        'rewrite'       => array(
            'slug' => 'event-design/catering',
            'with_front' => false,
            ),

    );

    register_post_type('caterer', $args);

}

add_action('init', 'digicrab_three_fifty_caterers_custom_posts');


/********************* CUSTOM MESSAGES **********************/

function my_updated_caterers_messages($messages) {
    global $post, $post_ID;

    $messages['caterers'] = array(
        0 => '',
        1 => sprintf(__('Caterers updated. <a href="%s">View Caterers</a>'), esc_url(get_permalink($post_ID))),
        2 => __('Custom field updated.'),
        3 => __('Custom field deleted.'),
        4 => __('Caterers updated.'),
        5 => isset($_GET['revision']) ? sprintf(__('Caterers restored to revision from %s'), wp_post_revision_title((int) $_GET['revision'], false)) : false,
        6 => sprintf(__('Caterers published. <a href="%s">View Caterers</a>'), esc_url(get_permalink($post_ID))),
        7 => __('Caterers saved.'),
        8 => sprintf(__('Caterers submitted. <a target="_blank" href="%s">Preview Caterers</a>'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
        9 => sprintf(__('Caterers scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Caterers</a>'), date_i18n(__('M j, Y @ G:i'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
        10 => sprintf(__('Caterers draft updated. <a target="_blank" href="%s">Preview Caterers</a>'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
    );

    return $messages;

}
add_filter('post_updated_messages', 'my_updated_caterers_messages');
