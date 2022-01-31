<?
/*
*Template Name: Ideas Overview Page
*/

function my_scripts_method() {
	wp_enqueue_script('isotope', get_template_directory_uri() . '/js/isotope/isotope.pkgd.min.js', array('jquery'), true);
    }

add_action('wp_enqueue_scripts', 'my_scripts_method');

get_header(); ?>

	<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">

        <? get_template_part('featured-image'); ?>

        <div class="entry-content scrollto-padding" id="scrollto-entry-content">
            <section class="scrollto-padding info quick-search">
                <? if (function_exists('breadcrumbs')) { breadcrumbs(); } ?>

                <div class="width-contain row-padding-small">
                    <div class="alignleft width-contain-800 no-padding wrapper">
                        <div class="half">
                            <h2>Quick Search</h2>
                            <p>Browse through our ideas below, or quickly see if we have anything which you are specifically after.</p>
                        </div>

                        <input type="text" class="half vertical-align quicksearch" placeholder="e.g. birthday">

                    </div>


                </div>
            </section>

            <section class="entry-content">
                <div class="width-contain">
                    <div class="alignleft full isotope-grid">
                    <? $tags = get_terms('post_tag', array('number'=>'all', 'order'=>'ASC', 'orderby'=>'term_order', 'hide_empty'=>false));
                        foreach($tags as $tag) {
                            $tagURL = get_term_link($tag->term_id);
                            $taxonomy = $tag->taxonomy;
                            $term_id = $tag->term_id;
                            $acfImgURL = get_field('term_image', $taxonomy . '_' . $term_id);

                            echo '<div class="third element-item">
                                    <a href="' . $tagURL . '"class="full image-link">
                                        <div class="featured-image display-card" data-bg="' . $acfImgURL . '"></div>
                                        <noscript><div class="featured-image display-card" style="background-image:url(' . $acfImgURL . ');"></div></noscript>
                                        <div class="overlay-information"><h3>' . $tag->name . '</h3></div>
                                    </a>
                                </div>';
                            }
                    ?>
                        <div class="width-contain-600 text-center tell-us hide">
                            <h3>It doesn't look like we have had that idea for an event yet.</h3>
                            <p>We love to hear new and exciting ideas for throwing events, why not tell us what you are thinking? We want to make your next event the best it can possibly be.</p>
                            <a href="/contact" class="aligncenter clickable more-info enquire-button" value="enquiry-form">Tell us your <?= $title; ?> ideas</a>
                        </div>
                    </div>
                </div>
            </section>
            <? include(locate_template('/partials/cta.php')); ?>
        </div>




        <footer class="entry-footer">
            <? edit_post_link(__('Edit', 'digicrab'), '<span class="edit-link">', '</span>'); ?>
        </footer>
    </main>
<? get_footer(); ?>

<script>
jQuery(document).ready(function($) {
    $(function() {
          // quick search regex
          var qsRegex;

          // init Isotope
          var $grid = $('.isotope-grid').isotope({
            itemSelector: '.element-item',
            layoutMode: 'fitRows',
            filter: function() {
              return qsRegex ? $(this).text().match(qsRegex) : true;
              }
          });

          // use value of search field to filter
          var $quicksearch = $('.quicksearch').keyup(debounce(function() {
            qsRegex = new RegExp($quicksearch.val(), 'gi');
            $grid.isotope();
            $('html,body').animate({scrollTop: $('#scrollto-entry-content').offset().top},'500');
            if(!$('.isotope-grid').children('.element-item:visible').length == 0) {
                $('.tell-us').removeClass('fade-in').addClass('hide');
                }
            }, 200));

        });

        // debounce so filtering doesn't happen every millisecond
        function debounce(fn, threshold) {
          var timeout;
          return function debounced() {
            if (timeout) {
              clearTimeout(timeout);
            }
            function delayed() {
              fn();
              timeout = null;
            }
            timeout = setTimeout(delayed, threshold || 100);
          }
        }


        $('.quicksearch').keyup(function() {
            setTimeout(function() {
            if($('.isotope-grid').children('.element-item:visible').length == 0) {
                    if($('.tell-us').hasClass('hide')) {
                        $('.tell-us').removeClass('hide').addClass('fade-in');
                        }
                    }
                else {
                    $('.tell-us').removeClass('fade-in').addClass('hide');
                    }
            },650);
        });
    });
</script>
