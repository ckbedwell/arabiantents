<?

/*************** ENABLE META BOXES *********************/


add_filter('rwmb_meta_boxes', 'pg_register_resource_page_meta_boxes');
function pg_register_resource_page_meta_boxes($meta_boxes) {

$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
$template_file = get_post_meta($post_id,'_wp_page_template',TRUE);
     if ($template_file == 'my-templates/page-resources.php') {


         $meta_boxes[] = array(
               'title' => 'Resources',
               'pages'    => array('page'),
               'priority' => 'high',
               'autosave' => true,
               'fields' => array(
                    // Group
                    array(
                         'name' => 'Resources to upload', // Optional
                         'id' => 'resources',
                         'type' => 'group',
                         'clone'  => true,
                         'sort_clone' => true,
                         'fields' => array(
                              array(
                                   'name' => 'Resource Title',
                                   'id' => 'resource-title',
                                   'type' => 'text',
                                  ),

                              array(
                                   'name' => 'Resource cover Image',
                                   'id' => 'resource-image',
                                   'type' => 'image_advanced',
                                  ),

                              array(
                                   'name'    => 'Link',
                                   'id'      => 'resource-download',
                                   'type'    => 'file_advanced',
                                  ),

                        ),
                   ),
              ),
           );



	}

     return $meta_boxes;
}
