<?php 
  function queryToBlocks($args) {
    $query = new WP_Query ($args);
    $posts = $query->posts;
    $ctaBlocks = array();

    foreach ($posts as $post) {
      $postId = $post->ID;
      $title = $post->post_title;
      $desc = $post->post_excerpt;
      $href = get_permalink($postId);

      $ctaBlocks[$title] = array(
        // 'desc' => $desc,
        'id' => $postId,
        'href' => $href,
        'img' => get_the_featured_image($postId)['full_url'],
      );
    }

    wp_reset_query();
    return $ctaBlocks;
  }

?>