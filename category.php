<?

get_header(); ?>


<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
  <header class="row-padding small-header ">
    <div class="width-contain">
      <h1 class="entry-title text-center"><? display_the_archive_title(); ?></h1>
    </div>
  </header>

  <? if (function_exists('breadcrumbs')) {
    breadcrumbs();
  } ?>

  <section class="parent-contain" id="scrollto-entry-content">
    <div class="width-contain">
      <?
      $featuredImage = get_the_featured_image($post->ID);

      if (have_posts()) : ?>
        <? $i = 0;
        while (have_posts()) : the_post();
          if ($i == 0) : ?>
            <article class="featured-article">
              <a href="<? the_permalink(); ?>" class="parent-contain image-link">
                <div class="display-card-large featured-image" data-bg="<?= $featuredImage['full_url']; ?>"></div>
                <noscript>
                  <div class="display-card-large featured-image" style="background-image: url(<?= $featuredImage['full_url']; ?>);"></div>
                </noscript>
                <div class="overlay-information">
                  <div class="width-contain-700 alignleft">
                    <? the_title('<h2 class="excerpt-title">', '</h2>'); ?>
                    <? the_excerpt(); ?>
                    <span class="white-button scale-five clickable" href="<? the_permalink(); ?>">Read more</span>
                  </div>
                  <? if ('post' == get_post_type()) {
                    if (in_category('external-blogs')) {
                      echo '<div class="post-meta">';
                      author_image(get_the_author()->ID);
                      echo '<span>' . get_field('website_name') . '</span>';
                      published_date();
                      echo '</div>';
                    } else {
                      echo '<div class="post-meta">';
                      author_image(get_the_author()->ID);
                      echo '<span>' . get_the_author_link() . '</span>';
                      published_date();
                      echo '</div>';
                    }
                  } ?>
                </div>
              </a>
            </article>
            <div class="parent-contain col-third-list row-padding-small sd">
            <? $i++;
          else : ?>
              <? get_template_part('excerpt'); ?>
          <? endif;
        endwhile; ?>

        <? else : ?>
          <? get_template_part('content', 'none'); ?>
        <? endif; ?>
            </div>
    </div>
  </section>

  <? include(locate_template('/partials/cta.php')); ?>
</main>

<? get_footer(); ?>