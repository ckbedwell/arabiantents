<?

/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package digicrab
 */

get_header();

$query = new WP_Query(
  array(
    'post_type' => 'press',
    'posts_per_page' => -1,
    'fields' => 'ids'
  )
);
$image_query = new WP_Query(
  array(
    'post_type' => 'attachment',
    'post_status' => 'inherit',
    'post_mime_type' => 'image',
    'posts_per_page' => -1,
    'post_parent__in' => $query->posts,
    'order' => 'DESC'
  )
);

$posts = $image_query->posts;
$images = array_map(function($post) {
  return [
    'ID' => $post->ID
  ];
}, $posts)
?>
<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
  <section class="width-contain">
    <h1 class="page-title">
      The Arabian Tent Company in the Press
    </h1>
  </section>
  <? include(locate_template('/scaffold/breadcrumbs.php')); ?>

  <section class="width-contain sectioned">
    <?= inc('/partials/gallery.php', ['images' => $images]); ?>
  </section>
</main>
<? get_footer(); ?>