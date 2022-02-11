<?
/*
* Template Name: Home Page
*/

include(locate_template('factories/index.php'));

$page_id = get_the_ID();
get_header();
?>

<style>
  h1 {
    color: var(--goldLight);
    text-shadow: 2px 2px black;
    font-size: 12rem;
    text-align: center;
  }

  h2 {
    font-size: 6rem;
    text-align: center;
  }

  .usps {
    display: flex;
    justify-content: center;
    color: white;
    font-size: 2rem;
  }

  .cta-blocks {
    margin-top: -1rem;
  }

  .intro {
    padding: 8rem 0;
  }
</style>

<main <? post_class('site-main'); ?> role="main">
  <div class="wrapper">
    <?= createHeaderImage($post); ?>
    <div class="width-contain vertical-align horizontal-align">
      <h1>The very best in tent hire</h1>
      <div class="usps">
        <div class="flex gap-1">
          <a href="/">Parties</a>
          <a href="/">Events</a>
          <a href="/">Weddings</a>
        </div>
      </div>
    </div>
  </div>
  <section class="width-contain-960 intro">
    <h2>The largest collection of themed marquees in the UK</h2>
    <div class="grid-2 grid-1-t gap-3">
      <p>Springing from a love of outdoor parties, The Arabian Tent Company was founded in 2004 by Katherine Hudson. The magic of festivals and marquee parties captured Katherine's imagination, and ever since she has designed, created and executed luxury marquee weddings, VIP areas at festivals across the UK, and brought delight and wonder to home celebrations.</p>

      <p>This collection of unique marquees are not just confined to Arabian influences, and have inspired interiors with a multitude of themes as well as the ethnic influences that inspired us originally.These include an 'Arts and Crafts' inspired tent interior, vintage-style tents, tea party tents as well as the Arabic, Moroccan and Bollywood themes which were the original source of inspiration for the collection.</p>
    </div>
  </section>
  <section class="width-contain cta-blocks">
    <div class="grid-3 grid-2-t grid-1-m gap-3">
      <?
        $ctaBlocks = array(
          'Event Design' => array(
            'desc' => 'We love what we do and do what we love',
            'img' => 'https://arabiantents.com/wp-content/uploads/2021/03/Arabian-Tents-UK-marquee-Hire-120-of-1.jpg',
            'href' => 'event-design'
          ),
          'Marquees' => array(
            'desc' => 'Pole Tents, Frame Tents, Stretch Tents, Pearl Tents, not to mention Glamping Tents...',
            'img' => 'https://arabiantents.com/wp-content/uploads/2021/03/Arabian-Tents-UK-marquee-Hire-2-of-2.jpg',
            'href' => 'marquee-hire'
          ),
          'Furniture and props' => array(
            'desc' => 'To perfectly complement our tents and interiors',
            'img' => 'https://arabiantents.com/wp-content/uploads/2016/03/76.jpg',
            'href' => 'furniture-decoration'
          ),
          'Decor Options' => array(
            'desc' => 'An envious collection of sumptuous fabrics, bespoke props and furniture',
            'img' => 'https://arabiantents.com/wp-content/uploads/2019/11/JessicaMilbergPhotographySussexWeddingPhotographer-19-1.jpg',
            'href' => 'decor-options'
          ),
          'Galleries' => array(
            'desc' => 'Thousands of pictures from thousands of events',
            'img' => 'https://arabiantents.com/wp-content/uploads/2021/03/Arabian-Tents-UK-marquee-Hire-120-of-1.jpg',
            'href' => 'galleries'
          ),
          'Contact' => array(
            'desc' => "Get in touch! We'd love to hear all about your event",
            'href' => 'contact'
          ),
        );

        foreach ($ctaBlocks as $key => $props) {
          createCtaBlock($key, $props);
        }
      ?>
    </div>
  </section>

  <section>
    <div class="">
      <h2 class="">What kind of event are you having?</h2>
      <?

      $args = array(
        'post_type' => 'page',
        'order' => 'ASC',
        'tax_query' => array(
          array(
            'taxonomy' => 'page-type',
            'field' => 'slug',
            'terms' => 'service-page',
          )
        )
      );

      $recentPosts = new WP_Query($args);
      while ($recentPosts->have_posts()) : $recentPosts->the_post();
        $postID = get_the_ID();
        $imgID = get_post_thumbnail_id($post->ID); //get the id of the featured image
        $featuredImage = wp_get_attachment_image_src($imgID, 'full'); //get the url of the featured image (returns an array)
        $imgURL = $featuredImage[0]; //get the url of the image out of the array
        $title = the_title()
      ?>

        <a class="" href="<? the_permalink(); ?>">
          <?= createDisplayCard($title, $imgURL); ?>
        </a>
      <? endwhile;
      wp_reset_query(); ?>
    </div>
  </section>

  <section class="">
    <div class="">
      <h2>What can we do for you?</h2>
      <p>We have a full range of services to help make your next event a huge success.</p>
      <div class="">
        <?

        $args = array(
          'post_type' => 'page',
          //                         'order' => 'ASC',
          'tax_query' => array(
            array(
              'taxonomy' => 'page-type',
              'field' => 'slug',
              'terms' => array('top-level', 'additional-service'),
            )
          )
        );

        $recentPosts = new WP_Query($args);
        while ($recentPosts->have_posts()) : $recentPosts->the_post();
          $postID = get_the_ID();
          $imgID = get_post_thumbnail_id($post->ID); //get the id of the featured image
          $featuredImage = wp_get_attachment_image_src($imgID, 'full'); //get the url of the featured image (returns an array)
          $imgURL = $featuredImage[0]; //get the url of the image out of the array
        ?>

          <a class="quarter-margined no-padding no-margin-bottom image-link" href="<? the_permalink(); ?>">
            <div class="display-card-large featured-image" data-bg="<?= $imgURL; ?>"></div>
            <noscript>
              <div class="display-card-large featured-image" style="background-image:url(<?= $imgURL; ?>);"></div>
            </noscript>

            <div class="overlay-information">
              <div class="wrapper">
                <h3><? the_title(); ?></h3>
              </div>
            </div>
          </a>
        <? endwhile;
        wp_reset_query(); ?>
      </div>
    </div>
  </section>

  <section class="">
    <div class="">
      <div class="">
        <h2>About the Arabian Tent Company</h2>
        <p>Springing from a love of outdoor parties, The Arabian Tent Company was founded in 2004 by Katherine Hudson. The magic of festivals and marquee parties captured Katherine’s imagination, soon she was hooked and decided she had to try and put on her own event.</p>
        <p>After searching the whole of the UK for a suitable party tent, and finding nothing but white PVC marquees, Katherine realised she would have to try a little harder if she wanted to do something truly special.</p>
        <a href="/about" class="">Read more</a>
      </div>

      <div class="">
        <h3>Explore more about the Arabian Tent Company</h3>
        <?

        $args = array(
          'post_type' => 'page',
          'order' => 'ASC',
          'tax_query' => array(
            array(
              'taxonomy' => 'page-type',
              'field' => 'slug',
              'terms' => 'about-sub',
            )
          )
        );

        $recentPosts = new WP_Query($args);
        while ($recentPosts->have_posts()) : $recentPosts->the_post();
          $postID = get_the_ID();
          $imgID = get_post_thumbnail_id($post->ID); //get the id of the featured image
          $featuredImage = wp_get_attachment_image_src($imgID, 'full'); //get the url of the featured image (returns an array)
          $imgURL = $featuredImage[0]; //get the url of the image out of the array
        ?>

          <a class="" href="<? the_permalink(); ?>">
            <div class="" data-bg="<?= $imgURL; ?>"></div>
            <div class="">
              <div class="">
                <h3><? the_title(); ?></h3>
              </div>
            </div>
          </a>
        <? endwhile;
        wp_reset_query(); ?>

      </div>
    </div>
  </section>
  <? include(locate_template('/partials/cta.php')); ?>

  <footer class="entry-footer">
    <? edit_post_link(__('Edit', 'digicrab'), '<span class="edit-link">', '</span>'); ?>
  </footer>
</main>
<? get_footer(); ?>