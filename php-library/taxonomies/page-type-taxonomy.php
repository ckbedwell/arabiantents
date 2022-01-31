<?

/********************* CUSTOM TAXONOMIES ******************************************************************************/

function add_page_type_taxonomy() {

/********************* Type (Taxonomy: page-type) **********************/



    // Add new "Type" taxonomy to Posts
    register_taxonomy('page-type', 'page', array(
        'show_admin_column' => true,
        'show_ui' => true,
        'public' => false,
        '_builtin'      => false,
        'query_var'     => 'page-type',
        'labels' => array(
            'name' => _x('Page Type', 'taxonomy general name'),
            'singular_name' => _x('Page Type', 'taxonomy singular name'),
            'search_items' =>  __('Search Page Types'),
            'all_items' => __('All Page Types'),
            'parent_item' => __('Parent Page Type'),
            'parent_item_colon' => __('Parent Page Type:'),
            'edit_item' => __('Edit Page Type'),
            'update_item' => __('Update Page Type'),
            'add_new_item' => __('Add Page Type'),
            'new_item_name' => __('New Page Type'),
            'menu_name' => __('Page Types'),
        ),
    ));

/********************* ADD A SEARCH BY FILTER IN ADMIN *********/

    function restrict_page_type_by_genre() {
        global $typenow;
        $post_type = 'page'; // change HERE
        $taxonomy = 'page-type'; // change HERE
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

    add_action('restrict_manage_posts', 'restrict_page_type_by_genre');

    function convert_page_type_id_to_term_in_query($query) { // change here
        global $pagenow;
        $post_type = 'venue'; // change HERE
        $taxonomy = 'page-type'; // change HERE
        $q_vars = &$query->query_vars;
        if ($pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0) {
            $term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
            $q_vars[$taxonomy] = $term->slug;
        }
    }

    add_filter('parse_query', 'convert_page_type_id_to_term_in_query'); // change here


}

add_action('init', 'add_page_type_taxonomy', 0);
