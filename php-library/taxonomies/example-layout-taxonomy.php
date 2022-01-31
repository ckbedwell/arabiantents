<?

/********************* CUSTOM TAXONOMIES ******************************************************************************/

function add_example_layout_taxonomy() {

/********************* Type (Taxonomy: tent_type) **********************/



    // Add new "Type" taxonomy to Posts
    register_taxonomy('example_layout', array('layout'), array(
        'show_admin_column' => true,
        'show_ui' => true,
        'hierarchical' => true,
        'public' => true,
        'rewrite'       =>  array('slug' => 'examples'),
        '_builtin'      => false,
        'query_var'     => 'example_layout',
        'labels' => array(
            'name' => _x('Example Layouts', 'taxonomy general name'),
            'singular_name' => _x('Example Layout', 'taxonomy singular name'),
            'search_items' =>  __('Search Example Layouts'),
            'all_items' => __('All Example Layouts'),
            'parent_item' => __('Parent Example Layout'),
            'parent_item_colon' => __('Parent Example Layout:'),
            'edit_item' => __('Edit Example Layout'),
            'update_item' => __('Update Example Layout'),
            'add_new_item' => __('Add Example Layout'),
            'new_item_name' => __('New Example Layout'),
            'menu_name' => __('Example Layouts'),
        ),
    ));

/********************* ADD A SEARCH BY FILTER IN ADMIN *********/

    function restrict_example_layout_by_genre() {
        global $typenow;
        $post_type = 'page'; // change HERE
        $taxonomy = 'layout'; // change HERE
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

    add_action('restrict_manage_posts', 'restrict_example_layout_by_genre');

    function convert_example_layout_id_to_term_in_query($query) { // change here
        global $pagenow;
        $post_type = 'layout'; // change HERE
        $taxonomy = 'example_layout'; // change HERE
        $q_vars = &$query->query_vars;
        if ($pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0) {
            $term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
            $q_vars[$taxonomy] = $term->slug;
        }
    }

    add_filter('parse_query', 'convert_tent_id_to_term_in_query'); // change here


}

add_action('init', 'add_example_layout_taxonomy', 0);
