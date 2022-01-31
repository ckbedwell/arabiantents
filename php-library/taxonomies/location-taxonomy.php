<?

/********************* CUSTOM TAXONOMIES ******************************************************************************/

function add_location_taxonomy() {

/********************* Type (Taxonomy: location_type) **********************/



    // Add new "Type" taxonomy to Posts
    register_taxonomy('location', 'venue', array(
        'show_admin_column' => true,
        'show_ui' => true,
        'hierarchical' => true,
        'public' => true,
        'rewrite'       =>  array('slug' => 'location'),
        '_builtin'      => false,
        'query_var'     => 'location',
        'labels' => array(
            'name' => _x('Location', 'taxonomy general name'),
            'singular_name' => _x('Location', 'taxonomy singular name'),
            'search_items' =>  __('Search locations'),
            'all_items' => __('All locations'),
            'parent_item' => __('Parent location'),
            'parent_item_colon' => __('Parent location:'),
            'edit_item' => __('Edit location'),
            'update_item' => __('Update location'),
            'add_new_item' => __('Add location'),
            'new_item_name' => __('New location'),
            'menu_name' => __('Location'),
        ),
    ));

/********************* ADD A SEARCH BY FILTER IN ADMIN *********/

    function restrict_location_by_genre() {
        global $typenow;
        $post_type = 'page'; // change HERE
        $taxonomy = 'location'; // change HERE
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

    add_action('restrict_manage_posts', 'restrict_location_by_genre');

    function convert_location_id_to_term_in_query($query) { // change here
        global $pagenow;
        $post_type = 'venue'; // change HERE
        $taxonomy = 'location'; // change HERE
        $q_vars = &$query->query_vars;
        if ($pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0) {
            $term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
            $q_vars[$taxonomy] = $term->slug;
        }
    }

    add_filter('parse_query', 'convert_location_id_to_term_in_query'); // change here


}

add_action('init', 'add_location_taxonomy', 0);

/*Filtro per modificare il permalink*/
add_filter('post_link', 'location_permalink', 1, 3);
add_filter('post_type_link', 'location_permalink', 1, 3);

function location_permalink($permalink, $post_id, $leavename) {
    //con %brand% catturo il rewrite del Custom Post Type
    if (strpos($permalink, '%location%') === FALSE) return $permalink;
        // Get post
        $post = get_post($post_id);
        if (!$post) return $permalink;

        // Get taxonomy terms
        $terms = wp_get_object_terms($post->ID, 'location');
        if (!is_wp_error($terms) && !empty($terms) && is_object($terms[0]))
            $taxonomy_slug = $terms[0]->slug;
        else $taxonomy_slug = 'no-brand';

    return str_replace('%location%', $taxonomy_slug, $permalink);
}
