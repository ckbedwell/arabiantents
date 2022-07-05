<?
/*
*Template Name: Ideas Overview Page
*/

function my_scripts_method()
{
  wp_enqueue_script('isotope', get_template_directory_uri() . '/js/isotope/isotope.pkgd.min.js', array('jquery'), true);
}

add_action('wp_enqueue_scripts', 'my_scripts_method');

get_header();

$ctaBlocks = array();
$tags = get_terms('post_tag', array('number' => 'all', 'order' => 'ASC', 'orderby' => 'term_order', 'hide_empty' => false));

foreach ($tags as $tag) {
  $tagURL = get_term_link($tag->term_id);
  $taxonomy = $tag->taxonomy;
  $term_id = $tag->term_id;
  $acfImgURL = get_field('term_image', $taxonomy . '_' . $term_id);
  $title = $tag->name;

  if ($acfImgURL) {
    $ctaBlocks[$title] = array(
      // 'desc' => $desc,
      'href' => $tagURL,
      'img' => $acfImgURL['url'],
    );
  }
}

?>

<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
  <?= createHeaderImage(postFeaturedImage($post), get_the_title()); ?>
  <? include(locate_template('/scaffold/breadcrumbs.php')); ?>

  <!-- <section class="width-contain sectioned">
    <h2 class="">Quick Search</h2>
    <p>Browse through our ideas below, or quickly see if we have anything which you are specifically after.</p>
    <input type="text" class="quicksearch" placeholder="e.g. birthday" />
  </section> -->

  <section class="width-contain sectioned">
    <div class="isotope-grid grid-3 grid-2-t gap-3">
      <? foreach ($ctaBlocks as $key => $props) {
        echo createCtaBlock($key, $props, [1.6, 1]);
      } ?>
    </div>
  </section>
</main>

<script>
  // jQuery(document).ready(function($) {
  //   $(function() {
  //     // quick search regex
  //     var qsRegex;

  //     // init Isotope
  //     var $grid = $('.isotope-grid').isotope({
  //       itemSelector: '.cta-block',
  //       layoutMode: 'fitRows',
  //       filter: function() {
  //         return qsRegex ? $(this).text().match(qsRegex) : true;
  //       }
  //     });

  //     // use value of search field to filter
  //     var $quicksearch = $('.quicksearch').keyup(debounce(function() {
  //       qsRegex = new RegExp($quicksearch.val(), 'gi');
  //       $grid.isotope();
  //     }, 200));

  //   });

  //   // debounce so filtering doesn't happen every millisecond
  //   function debounce(fn, threshold) {
  //     var timeout;
  //     return function debounced() {
  //       if (timeout) {
  //         clearTimeout(timeout);
  //       }

  //       function delayed() {
  //         fn();
  //         timeout = null;
  //       }
  //       timeout = setTimeout(delayed, threshold || 100);
  //     }
  //   }
  // });
</script>
<? get_footer(); ?>