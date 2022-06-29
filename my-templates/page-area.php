<?

/**
 *
 * Template Name: Area Page
 */

get_header();

$query = new WP_Query (array(
  'post_type' => 'page',
  'tax_query' => array(
    array(
      'taxonomy' => 'page-type',
      'field' => 'slug',
      'terms' => 'area'
    ),
  )
));
$posts = $query->posts;
wp_reset_query();

$areas = array();

foreach ($posts as $post) {
  $postId = $post->ID;
  $areaTitle = get_field('area_title', $postId);
  $desc = $post->post_excerpt;
  $href = get_permalink($postId);

  if (!isset($areaTitle)) {
    $areaTitle = $key;
  }

  $areas[$areaTitle] = array(
    // 'desc' => $desc,
    'href' => $href,
    'img' => get_the_featured_image($postId)['full_url'],
  );
}
?>

<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
  <?= createHeaderImage(postFeaturedImage($post), get_the_title()); ?>
  <? include(locate_template('/scaffold/breadcrumbs.php')); ?>

  <?= inc('/partials/cta-blocks.php', ['args' => $areas, 'ratio' => [1.6, 1]]); ?>

  <section class="width-contain-960 sectioned">
    <h2 class="section-header"><?= $section1Title; ?></h2>
    <?= createTextColumns(get_the_content()); ?>
  </section>
</main>
<? get_footer(); ?>