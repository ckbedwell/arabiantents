<? $tents = rwmb_meta('specific-tents', array('multiple' => true));
if (!empty($tents)) : ?>

  <section class="parent-contain row-padding text-center quick-navigation">
    <div class="width-contain more-information">
      <h2>Tents which we mentioned in this post:</h2>
      <div class="row-padding-small center-items">
        <?
        $args = array(
          'post_type' => 'tent',
          'post__in' => $tents,
          'posts_per_page' => '-1',
        );

        $recentPosts = new WP_Query($args);

        while ($recentPosts->have_posts()) : $recentPosts->the_post(); ?>

          <?
          $featuredImage = get_the_featured_image($post->ID);
          ?>
          <a class="display-card featured-image quarter-margined" data-bg="<?= $featuredImage['full_url']; ?>" href="<?= get_permalink(); ?>">
            <div class="overlay-information">
              <h3><?= get_the_title(); ?></h3>
            </div>
          </a>


        <? endwhile;
        wp_reset_query(); // end of the loop. 
        ?>
      </div>

    </div>
  </section>
<? endif; ?>