<?

/********************* CUSTOM TAXONOMIES ******************************************************************************/

function add_layouts_taxonomy() {

/********************* Type (Taxonomy: layout_type) **********************/



    // Add new "Type" taxonomy to Posts
    register_taxonomy('layout_type', 'layout', array(
        'show_admin_column' => true,
        'show_ui' => true,
        'hierarchical' => true,
        'public' => true,
        'rewrite'       =>  array('slug' => 'layouts'),
        '_builtin'      => false,
        'query_var'     => 'layout_type',
        'labels' => array(
            'name' => _x('Type of layout', 'taxonomy general name'),
            'singular_name' => _x('Type of layout', 'taxonomy singular name'),
            'search_items' =>  __('Search Types of layout'),
            'all_items' => __('All Types of layout'),
            'parent_item' => __('Parent Type of layout'),
            'parent_item_colon' => __('Parent Type of layout:'),
            'edit_item' => __('Edit Type of layout'),
            'update_item' => __('Update Type of layout'),
            'add_new_item' => __('Add Type of layout'),
            'new_item_name' => __('New Type of layout'),
            'menu_name' => __('Type of layout'),
        ),
    ));

/********************* ADD A SEARCH BY FILTER IN ADMIN *********/

    function restrict_layout_by_genre() {
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

    add_action('restrict_manage_posts', 'restrict_layout_by_genre');

    function convert_layout_id_to_term_in_query($query) { // change here
        global $pagenow;
        $post_type = 'layout'; // change HERE
        $taxonomy = 'layout_type'; // change HERE
        $q_vars = &$query->query_vars;
        if ($pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0) {
            $term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
            $q_vars[$taxonomy] = $term->slug;
        }
    }

    add_filter('parse_query', 'convert_layout_id_to_term_in_query'); // change here


}

add_action('init', 'add_layouts_taxonomy', 0);
