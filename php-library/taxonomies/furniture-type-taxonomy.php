<?

function add_furniture_taxonomy() {
    register_taxonomy('furniture_type', 'furniture', [
        'show_admin_column' => true,
        'show_ui' => true,
        'hierarchical' => true,
        'public' => true,
        'rewrite' =>  ['slug' => 'furniture-decoration'],
        '_builtin' => false,
        'query_var' => 'furniture_type',
        'labels' => [
            'name' => _x('Type of furniture', 'taxonomy general name'),
            'singular_name' => _x('Type of furniture', 'taxonomy singular name'),
            'search_items' =>  __('Search Types of furniture'),
            'all_items' => __('All Types of furniture'),
            'parent_item' => __('Parent Type of furniture'),
            'parent_item_colon' => __('Parent Type of furniture:'),
            'edit_item' => __('Edit Type of furniture'),
            'update_item' => __('Update Type of furniture'),
            'add_new_item' => __('Add Type of furniture'),
            'new_item_name' => __('New Type of furniture'),
            'menu_name' => __('Type of furniture'),
        ],
    ]);
}
add_action('init', 'add_furniture_taxonomy', 0);

// ADD A SEARCH BY FILTER IN ADMIN
function restrict_furniture_by_genre() {
    global $typenow;

    $post_type = 'page';
    $taxonomy = 'furniture';

    if ($typenow == $post_type) {
        $selected = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
        $info_taxonomy = get_taxonomy($taxonomy);

        wp_dropdown_categories([
            'show_option_all' => __("Show All {$info_taxonomy->label}s"),
            'taxonomy' => $taxonomy,
            'name' => $taxonomy,
            'orderby' => 'name',
            'selected' => $selected,
            'show_count' => true,
            'hide_empty' => true,
        ]);
    };
}
add_action('restrict_manage_posts', 'restrict_furniture_by_genre');

function convert_furniture_id_to_term_in_query($query) {
    global $pagenow;

    $post_type = 'furniture';
    $taxonomy = 'furniture_type';
    $q_vars = &$query->query_vars;

    if ($pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0) {
        $term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
        $q_vars[$taxonomy] = $term->slug;
    }
}
add_filter('parse_query', 'convert_furniture_id_to_term_in_query');

function furniture_permalink($permalink, $post_id, $leavename) {
    if (strpos($permalink, '%furniture_type%') === FALSE) {
        return $permalink;
    }

    $post = get_post($post_id);
    if (!$post) {
        return $permalink;
    }

    $terms = wp_get_object_terms($post->ID, 'furniture_type');
    if (!is_wp_error($terms) && !empty($terms) && is_object($terms[0])) {
        $taxonomy_slug = $terms[0]->slug;
    } else {
        $taxonomy_slug = 'no-brand';
    }

    return str_replace('%furniture_type%', $taxonomy_slug, $permalink);
}
add_filter('post_link', 'furniture_permalink', 1, 3);
add_filter('post_type_link', 'furniture_permalink', 1, 3);
