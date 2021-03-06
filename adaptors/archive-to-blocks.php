<?php 
  function archiveToBlocks($posts) {
    $ctaBlocks = array();

    foreach ($posts as $post) {
      $postId = $post->ID;
      $title = $post->post_title;
      $desc = $post->post_excerpt;
      $href = get_permalink($postId);

      $ctaBlocks[$title] = array(
        // 'desc' => $desc,
        'href' => $href,
        'img' => get_the_featured_image($postId)['full_url'],
      );
    }

    return $ctaBlocks;
  }
?>