<?
/*
* Template Name: Home Page
*/

$page_id = get_the_ID();
get_header();
$specificTestimonial = rwmb_meta('specific-testimonial')
?>

<main <? post_class('site-main home-page'); ?> role="main">
  <div class="wrapper">
    <?= createHeaderImage($post); ?>
    <div class="radial">
      <div class="width-contain">
        <h1>The very best in tent hire</h1>
        <div class="usps">
          <div class="flex gap-2 gap-1-m">
            <a href="/">Parties</a>
            <span class="divider"></span>
            <a href="/">Events</a>
            <span class="divider"></span>
            <a href="/">Weddings</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <section class="width-contain-960">
    <h2>The largest collection of themed marquees in the UK</h2>
    <div class="grid-2 grid-1-t gap-3">
      <p>Springing from a love of outdoor parties, The Arabian Tent Company was founded in 2004 by Katherine Hudson. The magic of festivals and marquee parties captured Katherine's imagination, and ever since she has designed, created and executed luxury marquee weddings, VIP areas at festivals across the UK, and brought delight and wonder to home celebrations.</p>

      <p>This collection of unique marquees are not just confined to Arabian influences, and have inspired interiors with a multitude of themes as well as the ethnic influences that inspired us originally.These include an 'Arts and Crafts' inspired tent interior, vintage-style tents, tea party tents as well as the Arabic, Moroccan and Bollywood themes which were the original source of inspiration for the collection.</p>
    </div>
  </section>
  <section class="width-contain">
    <div class="grid-3 grid-2-t grid-1-m gap-3 cta-blocks">
      <?
      $ctaBlocks = array(
        'Event Design' => array(
          'desc' => 'We love what we do and do what we love',
          'img' => 'https://arabiantents.com/wp-content/uploads/2021/03/Arabian-Tents-UK-marquee-Hire-120-of-1.jpg',
          'href' => 'event-design',
          'cta' => 'Make the event of your dreams',
        ),
        'Marquees' => array(
          'desc' => 'Pole Tents, Frame Tents, Stretch Tents, Pearl Tents, not to mention Glamping Tents...',
          'img' => 'https://arabiantents.com/wp-content/uploads/2021/03/Arabian-Tents-UK-marquee-Hire-2-of-2.jpg',
          'href' => 'marquee-hire',
          'cta' => 'Explore our tents',
        ),
        'Furniture and props' => array(
          'desc' => 'To perfectly complement our tents and interiors',
          'img' => 'https://arabiantents.com/wp-content/uploads/2018/12/club-cairo-Jessica-Milberg-Photography-.jpg',
          'href' => 'furniture-decoration',
          'cta' => 'See our unique items',
        ),
        'Decor Options' => array(
          'desc' => 'An envious collection of sumptuous fabrics, bespoke props and furniture',
          'img' => 'https://arabiantents.com/wp-content/uploads/2019/11/JessicaMilbergPhotographySussexWeddingPhotographer-19-1.jpg',
          'href' => 'decor-options',
          'cta' => 'Dress your event',
        ),
        'Galleries' => array(
          'desc' => 'Thousands of pictures from thousands of events',
          'img' => 'https://arabiantents.com/wp-content/uploads/2016/01/wedding-decor-optimised.jpg',
          'href' => 'galleries',
          'cta' => 'Get inspired',
        ),
        'Contact' => array(
          'desc' => "Get in touch! We'd love to hear all about your event",
          'href' => 'contact',
          'cta' => 'Send us a message',
          'icon' => 'icon-phone',
        ),
      );

      foreach ($ctaBlocks as $key => $props) {
        createCtaBlock($key, $props);
      }
      ?>
    </div>
  </section>

  <? get_template_part('partials/enquiry-forms/quick-form'); ?>

  <section class="">
    <div class="width-contain-960">
      <?
      include(locate_template('/partials/testimonial-slider.php'));
      ?>
    </div>
  </section>

  <section class="">
    <div class="width-contain">
      <? include(locate_template('/partials/worked-with.php')); ?>
    </div>
  </section>
  <footer class="entry-footer">
    <? edit_post_link(__('Edit', 'digicrab'), '<span class="edit-link">', '</span>'); ?>
  </footer>
</main>
<? get_footer(); ?>