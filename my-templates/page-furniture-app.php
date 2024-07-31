<?php
/*
* Template Name: Furniture App
* Description: Build your own furniture basket.
*/
get_header();

$args = array(
  'post_type' => 'furniture',
);

$query = new WP_Query($args);

$posts = array();
if ($query->have_posts()) {
  while ($query->have_posts()) {
    $query->the_post();
    $furniture_type = wp_get_post_terms(get_the_ID(), 'furniture_type');
    $furniture_type_names = array_map(function ($term) {
      return $term->name;
    }, $furniture_type);

    $color_type = wp_get_post_terms(get_the_ID(), 'colour');
    $color_type_names = array_map(function ($term) {
      return $term->name;
    }, $color_type);
    $furniture_price = rwmb_meta('furniture-price');
    $from_prefix = rwmb_meta('from-prefix');
    $photos_meta = rwmb_meta('photos');
    $photos_urls = array();
    foreach ($photos_meta as $photo) {
      $photos_urls[] = $photo['full_url'];
    }

    $posts[] = array(
      'id' => get_the_ID(),
      'title' => get_the_title(),
      'featured_image' => get_the_post_thumbnail_url(),
      'furniture_type' => $furniture_type_names,
      'color' => $color_type_names,
      'price' => $furniture_price,
      'from_prefix' => $from_prefix,
      'description' => get_the_content(),
      'photos' => $photos_urls,
      'quantity' => 0,
      // Add more fields as needed
    );
  }
}

echo '<script> const FURNITURE_ITEMS=' . json_encode($posts) . '</script>';

wp_reset_postdata();
?>


<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
  <?= createHeaderImage(postFeaturedImage($post), get_the_title()); ?>
  <? include(locate_template('/scaffold/breadcrumbs.php')); ?>

  <div id="root"></div>
  <link rel="stylesheet" href="<?= get_template_directory_uri(); ?>/furniture-app/dist/furnitureApp.css?v=1.0.2">
  <script src="<?= get_template_directory_uri(); ?>/furniture-app/dist/furnitureApp.js?v=1.0.3"></script>
</main>

<? get_footer(); ?>