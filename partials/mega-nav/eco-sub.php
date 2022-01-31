
<section class="eco-sub">
  <div class="width-contain-1000">
    <div class="full no-padding additional-info">
      <div class="sub-menu-full">
        <div class="point-three-trans text-center">
          <?php
            $args = array (
              'post_type' => 'page',
              'order' => 'ASC',
              'posts_per_page' => 7,
              'post_parent'    => 9466
            );

            $ecoPages = new WP_Query ($args);
            while ($ecoPages->have_posts()) : $ecoPages->the_post();
              $postID = get_the_ID();
              $imgID = get_post_thumbnail_id($post->ID); //get the id of the featured image
              $featuredImage = wp_get_attachment_image_src($imgID, 'full');//get the url of the featured image (returns an array)
              $imgURL = $featuredImage[0]; //get the url of the image out of the array
            ?>
              <div class="quarter-margined no-padding">
                <a
                  href="<? the_permalink(); ?>"
                  class="full display-card-small image-link additional-service"
                  style="
                    background-image: url(<?= $imgURL; ?>);
                  "
                ></a>
                <?php the_title(); ?>
              </div>
            <? endwhile; wp_reset_query(); ?>
        </div>
      </div>
    </div>
  </div>
</section>