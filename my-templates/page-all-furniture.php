<?
/*
* Template Name: All furniture items
* Description: Display all the Team Members on the website.
*/
get_header();
?>

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

  section.row-padding-g {
    padding-top: 0rem;
    padding-bottom: 0rem;
  }
</style>

<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
  <div class="alignleft full wrapper entry-content drop-off">
    <section class="no-padding info">
      <? if (function_exists('breadcrumbs')) {
        breadcrumbs();
      } ?>
      <!-- 
            <div class="height-filler hide"></div>
            <div class="full sticky-info">
                <div class="width-contain row-padding-extra-small-s">
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
            </div> -->
    </section>

    <section class="row-padding-g">
      <div class="width-contain">
        <div class="full clearfix header-content">
          <div class="two-thirds-margined intro">
            <h1 class="entry-title"><? the_title(); ?></h1>
            <?= do_shortcode(wpautop(get_the_content())); ?>
          </div>

          <div class="third-margined">
            <h5>Download our furniture pricelist</h5>
            <a href="https://arabiantents.com/wp-content/themes/arabiantents/resources/HoH-Price-List-05.18-HoH.pdf" target="_blank" class="image-link download-link text-center material-card">
              <img src="https://arabiantents.com/wp-content/uploads/2019/09/Screenshot-2019-09-20-at-15.25.04.png" src="https://arabiantents.com/wp-content/uploads/2019/09/Screenshot-2019-09-20-at-15.25.04.png" class="lazy-loaded">
              <noscript>
                <img src="https://arabiantents.com/wp-content/uploads/2019/09/Screenshot-2019-09-20-at-15.25.04.png">
              </noscript>
            </a>
          </div>
        </div>
      </div>
    </section>


  </div>

  <?= inc('/partials/cta.php'); ?>

  <footer class="entry-footer">
    <? edit_post_link(__('Edit', 'digicrab'), '<span class="edit-link">', '</span>'); ?>
  </footer>
</main>

<script src="<?= get_template_directory_uri(); ?>/js/isotope/isotope.pkgd.min.js"></script>
<script>
  $(document).ready(function() {
    // init Isotope
    var $grid = $('#results').isotope({
      itemSelector: '.masonry-item',
      isAnimated: false,
      layoutMode: 'masonry',
      percentPosition: true
    });

    $grid.imagesLoaded().progress(function() {
      $grid.isotope('layout');
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
        // if filter already exists remove it
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
  });
</script>

<? get_footer(); ?>