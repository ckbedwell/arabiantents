<?
/*
* Template Name: Home Page
*/

$page_id = get_the_ID();
get_header();
$content = "
Springing from a love of outdoor parties, The Arabian Tent Company was founded in 2004 by Katherine Hudson. The magic of festivals and marquee parties captured Katherine's imagination, and ever since she has designed, created and executed luxury marquee weddings, VIP areas at festivals across the UK, and brought delight and wonder to home celebrations.

This collection of unique marquees are not just confined to Arabian influences, and have inspired interiors with a multitude of themes as well as the ethnic influences that inspired us originally. These include an 'Arts and Crafts' inspired tent interior, vintage-style tents, tea party tents as well as the Arabic, Moroccan and Bollywood themes which were the original source of inspiration for the collection.
";

?>

<main <? post_class('site-main home-page'); ?> role="main">
  <section class="sectioned">
    <?= createHeaderImage(postFeaturedImage($post), "The very best in tent hire", [
      [
        'link' => '/event-design/parties/',
        'link_label' => 'Parties',
      ],
      [
        'link' => '/event-design/',
        'link_label' => 'Events',
      ],
      [
        'link' =>'/event-design/weddings/',
        'link_label' => 'Weddings'
      ],
    ], 'center'); ?>
  </section>

  <section class="width-contain-960 sectioned">
    <h2 class="section-header">The largest collection of themed marquees in the UK</h2>
     <?= createTextColumns($content); ?>
  </section>
  
    <?
    $ctaBlocks = array(
      'Event Design' => array(
        'desc' => 'We love what we do and do what we love',
        'img' => 'https://arabiantents.com/wp-content/uploads/2021/03/Arabian-Tents-UK-marquee-Hire-120-of-1.jpg',
        'href' => 'event-design/',
      ),
      'Marquees' => array(
        'desc' => 'Pole Tents, Frame Tents, Stretch Tents, Pearl Tents, not to mention Glamping Tents...',
        'img' => 'https://arabiantents.com/wp-content/uploads/2021/03/Arabian-Tents-UK-marquee-Hire-2-of-2.jpg',
        'href' => 'marquee-hire/',
      ),
      'Furniture and props' => array(
        'desc' => 'To perfectly complement our tents and interiors',
        'img' => 'https://arabiantents.com/wp-content/uploads/2018/12/club-cairo-Jessica-Milberg-Photography-.jpg',
        'href' => 'furniture-decoration/',
      ),
      'Decor Options' => array(
        'desc' => 'An envious collection of sumptuous fabrics, bespoke props and furniture',
        'img' => 'https://arabiantents.com/wp-content/uploads/2019/11/JessicaMilbergPhotographySussexWeddingPhotographer-19-1.jpg',
        'href' => 'decor-options/',
      ),
      'Galleries' => array(
        'desc' => 'Thousands of pictures from thousands of events',
        'img' => 'https://arabiantents.com/wp-content/uploads/2016/01/wedding-decor-optimised.jpg',
        'href' => 'galleries/',
      ),
      'Contact' => array(
        'desc' => "Get in touch! We'd love to hear all about your event",
        'href' => 'contact/',
        'img' => 'https://arabiantents.com/wp-content/uploads/2022/03/IMG-20201003-WA0001.jpg',
      ),
    );
      echo inc('/partials/cta-blocks.php', [ 'args' => $ctaBlocks, 'ratio' => [1,1]] );
    ?>

  <? get_template_part('partials/enquiry-forms/quick-form'); ?>

  <section class="sectioned width-contain-960">
      <?
      include(locate_template('/partials/testimonial-slider.php'));
      ?>
  </section>

  <section class="sectioned width-contain">
    <? include(locate_template('/partials/worked-with.php')); ?>
  </section>
  <footer class="entry-footer">
    <? edit_post_link(__('Edit', 'digicrab'), '<span class="edit-link">', '</span>'); ?>
  </footer>
</main>
<? get_footer(); ?>