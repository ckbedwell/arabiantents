<?

/********************* CUSTOM TAXONOMIES ******************************************************************************/

function add_tents_taxonomy() {

/********************* Type (Taxonomy: tent_type) **********************/



    // Add new "Type" taxonomy to Posts
    register_taxonomy('tent_type', array('tent', 'layout', 'product'), array(
        'show_admin_column' => true,
        'show_ui' => true,
        'hierarchical' => true,
        'public' => true,
        'rewrite'       =>  array('slug' => 'tents'),
        '_builtin'      => false,
        'query_var'     => 'tent_type',
        'labels' => array(
            'name' => _x('Type of tent', 'taxonomy general name'),
            'singular_name' => _x('Type of tent', 'taxonomy singular name'),
            'search_items' =>  __('Search Types of tent'),
            'all_items' => __('All Types of tent'),
            'parent_item' => __('Parent Type of tent'),
            'parent_item_colon' => __('Parent Type of tent:'),
            'edit_item' => __('Edit Type of tent'),
            'update_item' => __('Update Type of tent'),
            'add_new_item' => __('Add Type of tent'),
            'new_item_name' => __('New Type of tent'),
            'menu_name' => __('Type of tent'),
        ),
    ));

/********************* ADD A SEARCH BY FILTER IN ADMIN *********/

    function restrict_tent_by_genre() {
        global $typenow;
        $post_type = 'page'; // change HERE
        $taxonomy = 'tent'; // change HERE
        if ($typenow == $post_type) {
            $selected = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
            $info_taxonomy = get_taxonomy($taxonomy);
            wp_dropdown_categories(array(
                'show_option_all' => __("Show All {$info_taxonomy->label}s"),
                'taxonomy' => $taxonomy,
                'name' => $taxonomy,
                'orderby' => 'name',
                'selected' => $selected,
                'show_count' => true,
                'hide_empty' => true,
            ));
        };
    }

    add_action('restrict_manage_posts', 'restrict_tent_by_genre');

    function convert_tent_id_to_term_in_query($query) { // change here
        global $pagenow;
        $post_type = 'tent'; // change HERE
        $taxonomy = 'tent_type'; // change HERE
        $q_vars = &$query->query_vars;
        if ($pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0) {
            $term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
            $q_vars[$taxonomy] = $term->slug;
        }
    }

    add_filter('parse_query', 'convert_tent_id_to_term_in_query'); // change here


}

add_action('init', 'add_tents_taxonomy', 0);

/*Filtro per modificare il permalink*/
add_filter('post_link', 'brand_permalink', 1, 3);
add_filter('post_type_link', 'brand_permalink', 1, 3);

function brand_permalink($permalink, $post_id, $leavename) {
    //con %brand% catturo il rewrite del Custom Post Type
    if (strpos($permalink, '%tent_type%') === FALSE) return $permalink;
        // Get post
        $post = get_post($post_id);
        if (!$post) return $permalink;

        // Get taxonomy terms
        $terms = wp_get_object_terms($post->ID, 'tent_type');
        if (!is_wp_error($terms) && !empty($terms) && is_object($terms[0]))
            $taxonomy_slug = $terms[0]->slug;
        else $taxonomy_slug = 'no-brand';

    return str_replace('%tent_type%', $taxonomy_slug, $permalink);
}
