<?

/********************* CUSTOM TAXONOMIES ******************************************************************************/

function add_colour_taxonomy() {

/********************* Type (Taxonomy: colour_type) **********************/



    // Add new "Type" taxonomy to Posts
    register_taxonomy('colour', array('tent', 'furniture'), array(
        'show_admin_column' => true,
        'show_ui' => true,
        'hierarchical' => true,
        'public' => true,
        'rewrite'       =>  array('slug' => 'colour'),
        '_builtin'      => false,
        'query_var'     => 'colour',
        'labels' => array(
            'name' => _x('Colour', 'taxonomy general name'),
            'singular_name' => _x('Colour', 'taxonomy singular name'),
            'search_items' =>  __('Search colours'),
            'all_items' => __('All colours'),
            'parent_item' => __('Parent colour'),
            'parent_item_colon' => __('Parent colour:'),
            'edit_item' => __('Edit colour'),
            'update_item' => __('Update colour'),
            'add_new_item' => __('Add colour'),
            'new_item_name' => __('New colour'),
            'menu_name' => __('Colours'),
        ),
    ));

/********************* ADD A SEARCH BY FILTER IN ADMIN *********/

    function restrict_colour_by_genre() {
        global $typenow;
        $post_type = 'page'; // change HERE
        $taxonomy = 'colour'; // change HERE
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

    add_action('restrict_manage_posts', 'restrict_colour_by_genre');

    function convert_colour_id_to_term_in_query($query) { // change here
        global $pagenow;
        $post_type = array('tent', 'furniture'); // change HERE
        $taxonomy = 'colour'; // change HERE
        $q_vars = &$query->query_vars;
        if ($pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0) {
            $term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
            $q_vars[$taxonomy] = $term->slug;
        }
    }

    add_filter('parse_query', 'convert_colour_id_to_term_in_query'); // change here


}

add_action('init', 'add_colour_taxonomy', 0);

/*Filtro per modificare il permalink*/
add_filter('post_link', 'colour_permalink', 1, 3);
add_filter('post_type_link', 'colour_permalink', 1, 3);

function colour_permalink($permalink, $post_id, $leavename) {
    //con %brand% catturo il rewrite del Custom Post Type
    if (strpos($permalink, '%colour%') === FALSE) return $permalink;
        // Get post
        $post = get_post($post_id);
        if (!$post) return $permalink;

        // Get taxonomy terms
        $terms = wp_get_object_terms($post->ID, 'colour');
        if (!is_wp_error($terms) && !empty($terms) && is_object($terms[0]))
            $taxonomy_slug = $terms[0]->slug;
        else $taxonomy_slug = 'no-brand';

    return str_replace('%colour%', $taxonomy_slug, $permalink);
}
