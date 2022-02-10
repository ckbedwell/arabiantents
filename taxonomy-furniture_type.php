<? get_header(); ?>

<style>
  #results {
    overflow: hidden;
  }

  .clearfix:after {
    content: "";
    display: table;
    clear: both;
  }

  .filter-btn-group {
    display: flex;
    flex-wrap: wrap;
    list-style-type: none;
    padding: 0;
    margin: 0 0 2rem;
  }

  .filter-btn-group li {
    flex: 1 1 auto;
  }

  .filter-btn-group.single-filter li {
    flex-basis: 25%;
  }

  .filter-btn-group button {
    width: 100%;
    height: 100%;
    padding: 0;
    border: 1px solid rgba(255, 255, 255, 1);
    background-color: rgba(227, 227, 227, 1);
    font-family: inherit;
    cursor: pointer;
  }

  .filter-btn-group.single-filter button,
  .filter-btn-group.multi-filter .any-color {
    padding: 1rem 2rem;
  }

  .filter-btn-group.single-filter li button [class*="icon-"] {
    margin-right: 1rem;
    font-size: 3rem;
  }

  .filter-btn-group.single-filter li button .text {
    position: relative;
    top: -0.5rem;
  }

  .filter-btn-group.multi-filter button span {
    display: block;
    width: 100%;
  }

  span.term-color {
    height: 2rem;
  }

  span.term-name {
    padding: 0.5rem;
    background: rgba(0, 0, 0, 0.15);
  }

  .filter-btn-group button:hover {
    background-color: rgba(223, 218, 205, 1);
  }

  .filter-btn-group button.is-checked {
    background-color: rgba(227, 209, 168, 1);
  }

  @media screen and (max-width: 1030px) {
    .filter-btn-group li {
      flex-basis: 16%;
    }
  }

  @media screen and (max-width: 960px) {
    .header-content [class*="third"] {
      width: 100%;
    }

    .filter-btn-group.single-filter li {
      flex-basis: 50%;
    }
  }

  @media screen and (max-width: 450px) {
    .filter-btn-group.single-filter li button [class*="icon-"] {
      font-size: 2rem;
    }

    .filter-btn-group.single-filter li button .text {
      top: -0.25rem;
    }
  }
</style>

<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
  <header class="row-padding wrapper small-header">
    <div class="width-contain text-center">
      <h1 class="entry-title"><? display_the_archive_title(); ?></h1>
    </div>
  </header>

  <div class="alignleft full wrapper entry-content drop-off" id="scrollto-entry-content">
    <section class="no-padding info">
      <? if (function_exists('breadcrumbs')) {
        breadcrumbs();
      } ?>

      <div class="height-filler hide"></div>
      <div class="full sticky-info">
        <div class="width-contain row-padding-extra-small">
          <div class="two-thirds">
            <span class="icon-furniture big-icon no-padding alignleft"></span>
            <div class="five-sixths no-padding">
              <h2>Take a look through our furniture</h2>
              <p>Tell us a bit about what you are after and we can get back to you within 24 hours with a quote.</p>
            </div>
          </div>
          <div class="alignright third">
            <a href="/contact" class="vertical-align horizontal-align no-margin enquire-button more-info" value="furniture-selection">Enquire about our furniture</a>
          </div>
          <button class="lower-info point-five-trans clickable"><span class="icon-arrow-right point-five-trans"></span></button>
        </div>
      </div>
    </section>

    <!--Filter start -->
    <section>
      <div class="width-contain">
        <div class="row-padding-small filters">
          <h3 class="text-center">Filter what furniture you would like to see</h3>
          <ul class="clearfix filter-btn-group single-filter" data-filter-group="furniture_type" data-filter-type="single">
            <li>
              <button class="is-checked" data-filter="">All</button>
            </li>

            <? $furniture_types = get_terms('furniture_type', array('hide_empty' => true)); ?>
            <? foreach ($furniture_types as $term) : ?>
              <? $icon = get_field('term_icon', $term->taxonomy . '_' . $term->term_taxonomy_id); ?>
              <li>
                <button data-filter="<?= '.' . $term->slug; ?>">
                  <span class="<?= $icon; ?>"></span>
                  <span class="text"><?= $term->name; ?></span>
                </button>
              </li>
            <? endforeach; ?>
          </ul>

          <ul class="clearfix filter-btn-group multi-filter" data-filter-group="color" data-filter-type="multi">
            <li>
              <button class="any-color is-checked" data-filter="">All</button>
            </li>
            <? $colors = get_terms('colour', array('hide_empty' => true)); ?>
            <? //this is the color id arrange by white to black 
            ?>
            <? //$color_arranges = array(54,53,83,166,82,56,160,49,188,50,159,55,51,60,61,69,52,57); 
            ?>
            <? $color_arranges = array(54, 53, 83, 166, 82, 188, 56, 160, 50, 49, 51, 159, 60, 61, 55, 69, 52, 57); ?>
            <? $i = 0; ?>

            <? //need to sort according to the color arrangement 
            ?>
            <? foreach ($color_arranges as $colour) { ?>
              <? foreach ($colors as $term) { ?>
                <? if ($colour == $term->term_id) { ?>
                  <? $color_arrange[$i]['term_id'] = $term->term_id; ?>
                  <? $color_arrange[$i]['name'] = $term->name; ?>
                  <? $color_arrange[$i]['slug'] = $term->slug; ?>
                  <? $color_arrange[$i]['term_group'] = $term->term_group; ?>
                  <? $color_arrange[$i]['term_taxonomy_id'] = $term->term_taxonomy_id; ?>
                  <? $color_arrange[$i]['taxonomy'] = $term->taxonomy; ?>
                  <? $color_arrange[$i]['description'] = $term->description; ?>
                  <? $color_arrange[$i]['parent'] = $term->parent; ?>
                  <? $color_arrange[$i]['count'] = $term->count; ?>
                  <? $color_arrange[$i]['filter'] = $term->filter; ?>
                  <? $color_arrange[$i]['term_order'] = $term->term_order; ?>
                  <? $i++; ?>
                <? } ?>
              <? } ?>
            <? } ?>

            <? foreach ($color_arrange as $term) : ?>
              <? $color = get_field('term_colour', $term['taxonomy'] . '_' . $term['term_taxonomy_id']); ?>
              <li>
                <button data-filter="<?= '.' . $term['slug']; ?>">
                  <span class="term-color" style="background-color: <?= $color; ?>"></span>
                  <span class="term-name"><?= $term['name']; ?></span>
                </button>
              </li>
            <? endforeach; ?>
          </ul>
        </div>
        <div class="full no-padding furniture-grid gallery" id="results">
          <? $args = ['post_type' => 'furniture', 'order' => 'ASC']; ?>
          <? $furniture = new WP_Query($args); ?>
          <? if ($furniture->have_posts()) { ?>
            <? while ($furniture->have_posts()) : ?>
              <? $furniture->the_post(); ?>
              <? $imgID = get_post_thumbnail_id($post->ID); //get the id of the featured image 
              ?>
              <? $featuredImage = wp_get_attachment_image_src($imgID, 'full'); //get the url of the featured image (returns an array) 
              ?>
              <? $imgURL = $featuredImage[0]; //get the url of the image out of the array 
              ?>
              <? $furniturePrice = rwmb_meta('furniture-price', $args = array('type=text')); ?>
              <? $furniture_types = get_the_terms($post->ID, 'furniture_type'); ?>
              <? $color = get_the_terms($post->ID, 'colour'); ?>

              <a class="lightbox-link masonry-item image-link <? foreach ((array) $furniture_types as $term) {
                                                                echo $term->slug . " ";
                                                              }
                                                              foreach ((array) $color as $term) {
                                                                echo $term->slug . " ";
                                                              } ?>" href="<?= $imgURL; ?>" caption="<? the_title(); ?>">
                <img class="point-five-trans" src="<?= $imgURL; ?>">
                <div class="overlay-information">
                  <h3><?= the_title(); ?></h3>
                  <h5>
                    <? if (!empty($furniturePrice)) { ?>
                      <? if (rwmb_meta('from-prefix') == 1) { ?>
                        <?= 'From '; ?>
                      <? } ?>
                      <?= '&pound;' . $furniturePrice; ?>
                    <? } ?>
                  </h5>
                </div>
                <button class="pinterest-btn" onclick="window.open('//pinterest.com/pin/create/link/?url=<?= 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>&media=<?= $imgURL; ?>&description=<?= get_the_title(); ?>','_blank','resizable=yes'); event.stopPropagation(); event.preventDefault();">Save</button>
              </a>
            <? endwhile; ?>
          <? } ?>
        </div>
      </div>
    </section>

    <section class="parent-contain entry-content" id="search-container">
      <div class="width-contain">
        <div class="full no-padding masonry-grid gallery" id="results">
          <? while (have_posts()) : ?>
            <? the_post(); ?>
            <? $imgID = get_post_thumbnail_id($post->ID); //get the id of the featured image 
            ?>
            <? $featuredImage = wp_get_attachment_image_src($imgID, 'full'); //get the url of the featured image (returns an array) 
            ?>
            <? $imgURL = $featuredImage[0]; //get the url of the image out of the array 
            ?>
            <? $furniturePrice = rwmb_meta('furniture-price', $args = array('type=text')); ?>

            <a class="lightbox-link masonry-item image-link" href="<?= $imgURL; ?>" caption="<? the_title(); ?>">
              <img class="point-five-trans" src="<?= $imgURL; ?>">
              <div class="overlay-information">
                <h3><?= the_title(); ?></h3>
                <h5>
                  <? if (!empty($furniturePrice)) { ?>
                    <? if (rwmb_meta('from-prefix') == 1) { ?>
                      <?= 'From '; ?>
                    <? } ?>
                    <?= '&pound;' . $furniturePrice; ?>
                  <? } ?>
                </h5>
              </div>
            </a>
          <? endwhile; ?>
        </div>
      </div>
    </section>
  </div>

  <? include(locate_template('/partials/cta.php')); ?>

  <footer class="entry-footer">
    <? edit_post_link(__('Edit', 'digicrab'), '<span class="edit-link">', '</span>'); ?>
  </footer>
</main>

<script src="<?= get_template_directory_uri(); ?>/js/isotope/isotope.pkgd.min.js"></script>
<script>
  // init Isotope
  var $grid = $('#results').isotope({
    itemSelector: '.masonry-item',
    isAnimated: false,
    layoutMode: 'masonry',
    percentPosition: true
  });

  var filters = {
    single: "",
    multi: {}
  };

  $('.filters').on('click', 'button', function() {
    var $this = $(this);
    var $buttonGroup = $this.parents('.filter-btn-group');
    var filterGroup = $buttonGroup.attr('data-filter-group');
    var filterType = $buttonGroup.attr('data-filter-type');
    var dataFilter = $this.attr("data-filter");
    var singleValue = filters["single"];
    var multiValues = concatValues(filters["multi"]);
    var wholeValue;
    var oneChecked = false;

    if ($this.hasClass("any-color")) {
      $($buttonGroup.find(".is-checked")).each(function() {
        $(this).removeClass("is-checked");
      });

      $this.addClass("is-checked");
      filters["multi"] = {};
    }

    if (filterType === "single") {
      filters[filterType] = dataFilter;
      $(".single-filter button").removeClass("is-checked");
      $this.addClass("is-checked");
    }

    if (filterType === "multi" && !$this.hasClass("any-color")) {
      //if filter already exists remove it
      if (filters["multi"][dataFilter] === dataFilter) {
        $this.removeClass("is-checked");
        filters["multi"][dataFilter] = '';

        // otherwise create it
      } else {
        $this.addClass("is-checked");
        filters[filterType][dataFilter] = dataFilter;
      }

      $(".multi-filter button").each(function() {
        if ($(this).hasClass("is-checked")) {
          $(".any-color").removeClass("is-checked");
          oneChecked = true;
        }
      });

      if (!oneChecked) {
        $(".any-color").addClass("is-checked");
      }
    }

    wholeValue = concatValues(filters["multi"]).toString() || filters["single"];
    var split = wholeValue.split(',');
    $('.masonry-item').removeClass('visible-for-lb');

    for (var i = 0; i < split.length; i++) {
      if (split[0] == "") {
        $('.masonry-item').addClass('visible-for-lb');
      } else {
        $(split[i]).addClass('visible-for-lb');
      }
    }

    $grid.isotope({
      filter: wholeValue,
    });

    var magnific = function() {
      jQuery('.gallery').each(function() {
        jQuery(this).magnificPopup({
          delegate: '.visible-for-lb',
          type: 'image',
          image: {
            titleSrc: 'caption',
          },
          gallery: {
            enabled: true,
          },
        });
      });
    }
    magnific();
  });

  // flatten object by concatting values
  function concatValues(obj) {
    var value = '';
    for (var prop in obj) {
      if (obj[prop] != "") {
        value += filters["single"] + obj[prop] + ", ";
      }
    }
    return value.slice(0, -2);
  }
</script>

<? get_footer(); ?>