<?

/************************ REGISTER CASE STUDIES ************************************************************************************/

function digicrab_three_fifty_product_custom_posts() {
    $labels = array(
        'name'          => _x('Furniture', 'post type general name'),
        'singular_name' => _x('Furniture', 'post type singular name'),
        'add_new'       => _x('Add New Product', 'product'),
        'add_new_item'       => __('Add New Product'),
        'edit_item'          => __('Edit Product'),
        'new_item'           => __('New Product'),
        'all_items'          => __('All Products'),
        'view_item'          => __('View Product'),
        'search_items'       => __('Search Product'),
        'not_found'          => __('No Product found'),
        'not_found_in_trash' => __('No Product found in the Trash'),
        'parent_item_colon'  => '',
        'menu_name'          => 'Products'
    );

    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds our product and product-specific data',
        'public'        => true,
        'menu_position' => 4,
        'menu_icon'   => 'dashicons-admin-appearance',
        'supports'      => array('title', 'editor', 'thumbnail', 'revisions', 'author'),
        'has_archive'   => true,
        'rewrite'       => array(
            'slug' => 'galleries/furniture-gallery',
            ),

    );

    register_post_type('product', $args);

}

add_action('init', 'digicrab_three_fifty_product_custom_posts');


/********************* CUSTOM MESSAGES **********************/

function my_updated_product_messages($messages) {
    global $post, $post_ID;

    $messages['product'] = array(
        0 => '',
        1 => sprintf(__('Product updated. <a href="%s">View Product</a>'), esc_url(get_permalink($post_ID))),
        2 => __('Custom field updated.'),
        3 => __('Custom field deleted.'),
        4 => __('Product updated.'),
        5 => isset($_GET['revision']) ? sprintf(__('Product restored to revision from %s'), wp_post_revision_title((int) $_GET['revision'], false)) : false,
        6 => sprintf(__('Product published. <a href="%s">View Product</a>'), esc_url(get_permalink($post_ID))),
        7 => __('Product saved.'),
        8 => sprintf(__('Product submitted. <a target="_blank" href="%s">Preview Product</a>'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
        9 => sprintf(__('Product scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Product</a>'), date_i18n(__('M j, Y @ G:i'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
        10 => sprintf(__('Product draft updated. <a target="_blank" href="%s">Preview Product</a>'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
    );

    return $messages;

}
add_filter('post_updated_messages', 'my_updated_product_messages');
