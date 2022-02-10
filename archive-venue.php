<?

/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package digicrab
 */
wp_enqueue_script('markerclusterer', get_template_directory_uri() . '/js/google-maps-markercluster-git/markerclusterer.js', array(), '1.0', false);
get_header();

?>
<? get_template_part('json-test');
wp_reset_query(); ?>

<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
  <header class="row-padding small-header text-center">
    <div class="width-contain">
      <h1 class="entry-title">Venues</h1>
    </div>
  </header>

  <section class="parent-contain no-padding-top intro map-wrapper">
    <p class="width-contain-600 row-padding-small text-center">
      <?= get_the_excerpt(get_page_by_title('Venues')->ID); ?>
    </p>
    <div class="width-contain">
      <div id="map" class="map"></div>
      <div class="material-card scroll-toggle">
        <input type="checkbox" id="scroll-toggle" />
        <label for="scroll-toggle">Enable mousewheel scrolling</label>
      </div>
    </div>
  </section>

  <? if (function_exists('breadcrumbs')) {
    breadcrumbs();
  } ?>

  <section class="parent-contain entry-content" id="scrollto-entry-content">
    <div class="width-contain">

      <form action="/found-venues/" method="get">
        <div class="row">

          <?php $locations = get_terms('location', array(
            'orderby'    => 'title',
            'order'      => 'ASC',
            'hide_empty' => 0
          )); ?>
          <select name="locationv">
            <option value>Locations</option>
            <?php foreach ($locations as $location) : ?>
              <option value="<?php echo $location->term_id; ?>"><?php echo $location->name; ?></option>
            <?php endforeach; ?>
            <select>

              <?php $capacity = get_terms(array(
                'taxonomy' => 'capacity',
                'hide_empty' => false,
              )); ?>
              <select name="capacityv">
                <option value>Capacity</option>
                <?php foreach ($capacity as $capacity_single) : ?>
                  <option value="<?php echo $capacity_single->term_id; ?>"><?php echo $capacity_single->name; ?></option>
                <?php endforeach; ?>
              </select>


              <?php $licensed_for_marriage = get_terms(array(
                'taxonomy' => 'licensed_for_marriage',
                'hide_empty' => false,
              )); ?>
              <select name="licensed_for_marriage">
                <option value>Licences for Marriage</option>
                <?php foreach ($licensed_for_marriage as $licensed_for_marriage_single) : ?>
                  <option value="<?php echo $licensed_for_marriage_single->term_id; ?>"><?php echo $licensed_for_marriage_single->name; ?></option>
                <?php endforeach; ?>
              </select>

              <?php $catering = get_terms(array(
                'taxonomy' => 'catering',
                'hide_empty' => false,
              )); ?>
              <select name="catering">
                <option value>Catering</option>
                <?php foreach ($catering as $catering_single) : ?>
                  <option value="<?php echo $catering_single->term_id; ?>"><?php echo $catering_single->name; ?></option>
                <?php endforeach; ?>
              </select>


              <?php $bar = get_terms(array(
                'taxonomy' => 'bar',
                'hide_empty' => false,
              )); ?>
              <select name="bar">
                <option value>Bar</option>
                <?php foreach ($bar as $bar_single) : ?>
                  <option value="<?php echo $bar_single->term_id; ?>"><?php echo $bar_single->name; ?></option>
                <?php endforeach; ?>
              </select>


              <?php $pets_welcome = get_terms(array(
                'taxonomy' => 'pets_welcome',
                'hide_empty' => false,
              )); ?>
              <select name="pets_welcome">
                <option value>Pets Welcome</option>
                <?php foreach ($pets_welcome as $pets_welcome_single) : ?>
                  <option value="<?php echo $pets_welcome_single->term_id; ?>"><?php echo $pets_welcome_single->name; ?></option>
                <?php endforeach; ?>
              </select>


              <?php $child_friendly = get_terms(array(
                'taxonomy' => 'child_friendly',
                'hide_empty' => false,
              )); ?>
              <select name="child_friendly">
                <option value>Child Friendly</option>
                <?php foreach ($child_friendly as $child_friendly_single) : ?>
                  <option value="<?php echo $child_friendly_single->term_id; ?>"><?php echo $child_friendly_single->name; ?></option>
                <?php endforeach; ?>
              </select>


              <?php $exclusivity = get_terms(array(
                'taxonomy' => 'exclusivity',
                'hide_empty' => false,
              )); ?>
              <select name="exclusivity">
                <option value>Exclusivity</option>
                <?php foreach ($exclusivity as $exclusivity_single) : ?>
                  <option value="<?php echo $exclusivity_single->term_id; ?>"><?php echo $exclusivity_single->name; ?></option>
                <?php endforeach; ?>
              </select>


              <?php $accommodation = get_terms(array(
                'taxonomy' => 'accommodation_',
                'hide_empty' => false,
              )); ?>
              <select name="accommodation">
                <option value>Accomodation</option>
                <?php foreach ($accommodation as $accommodation_single) : ?>
                  <option value="<?php echo $accommodation_single->term_id; ?>"><?php echo $accommodation_single->name; ?></option>
                <?php endforeach; ?>
              </select>



              <button type="submit" class="enquire-button align-center">Find Venues</button>

        </div>
      </form>

      <?
      $terms = get_terms('location', array(
        'orderby'    => 'title',
        'order'      => 'ASC',
        'hide_empty' => 0
      ));

      foreach ($terms as $term) : ?>

        <div class="alignleft col-third-list full padded material-card" style="margin-bottom: 8rem">
          <?
          $args = array(
            'post_type' => 'venue',
            'location' => $term->slug
          );

          $query = new WP_Query($args);
          $count = $query->post_count;
          ?>

          <h2>Venues in <?= $term->name; ?> (<?= $count; ?>)</h2>
          <? while ($query->have_posts()) : $query->the_post(); ?>
            <? $featuredImage = get_the_featured_image($post->ID); ?>
            <div class="third archive-item venue" id="post-<? the_ID(); ?>">
              <div class="parent-contain">
                <div class="full">
                  <div class="display-card-medium featured-image" data-bg="<?= $featuredImage['full_url']; ?>"></div>

                  <noscript>
                    <div class="display-card-medium featured-image" style="background-image: url(<?= $featuredImage['full_url']; ?>);"></div>
                  </noscript>


                </div>
                <?php echo get_favorites_button($post->ID); ?>
              </div>
              <div class="parent-contain">
                <h3><? the_title(); ?></h3>

              </div>
            </div>
          <? endwhile; ?>
        </div>
      <? endforeach;
      wp_reset_postdata(); ?>
    </div>
  </section>
</main>
<!---------- GOOGLE MAPS ----------------->

<script>
  <? $count = $wp_query->post_count; ?>

  function initMap() {
    var myLatLng = {
      lat: 51.3980956,
      lng: -1.0912716000000273
    };
    var map = new google.maps.Map(document.getElementById('map'), {
      center: myLatLng,
      scrollwheel: false,
      zoom: 8
    });

    var markers = [];
    for (var i = 0; i < <?= $count; ?>; i++) {

      var dataPhoto = data.photos[i];

      var dblatlng = dataPhoto.latlng;

      var splitlatlng = dblatlng.split(',')
      var combined = new google.maps.LatLng(parseFloat(splitlatlng[0]), parseFloat(splitlatlng[1]));

      var featuredImage = dataPhoto.image_url;
      var url = dataPhoto.url;
      var title = dataPhoto.title;
      var dbaddress = dataPhoto.address;
      var address = dbaddress.split(",").join('<br/>');
      var website = dataPhoto.website;
      var phone = dataPhoto.phone;
      var email = dataPhoto.email;

      var infowindow = new google.maps.InfoWindow();


      var marker = new google.maps.Marker({
        position: combined,
        title: title,
        url: url,
        featured: featuredImage,
        address: address,
        website: website,
        phone: phone,
        email: email,
      });

      marker.addListener('click', function() {
        infowindow.setContent('<h1>' + this.title + '</h1><a href="' + this.url + '" class="featured-image image-link" style="background-image: url(' + this.featured + ');' +
          '"></a><div class="contact-info"><div class="half"><h2>Address</h2>' + this.address + '</div>' +
          '<div class="half"><h2>Contact</h2><ul><li><a target="_blank" href="' + this.website + '">View website</a></li>' +
          '<li><a href="tel:' + this.phone + '">' + this.phone + '</a></li><li><a href="mailto:' + this.email + '">' + this.email + '</a></li></ul></div></div>');
        infowindow.open(map, this);

      });

      markers.push(marker);

      var options = {
        imagePath: '/wp-content/themes/arabiantents/js/google-maps-markercluster-git/images/m'
      };
    }



    var markerCluster = new MarkerClusterer(map, markers, options);

    // Taken from http://en.marnoto.com/2014/09/5-formas-de-personalizar-infowindow.html
    google.maps.event.addListener(infowindow, 'domready', function() {
      // Reference to the DIV which receives the contents of the infowindow using jQuery
      var iwOuter = jQuery('.gm-style-iw');
      /* The DIV we want to change is above the .gm-style-iw DIV.
       * So, we use jQuery and create a iwBackground variable,
       * and took advantage of the existing reference to .gm-style-iw for the previous DIV with .prev().
       */
      var iwBackground = iwOuter.prev();
      // Remove the background shadow DIV
      iwBackground.children(':nth-child(2)').css({
        'display': 'none'
      });
      // Remove the white background DIV
      iwBackground.children(':nth-child(4)').css({
        'display': 'none'
      });

      // Changes the desired color for the tail outline.
      // The outline of the tail is composed of two descendants of div which contains the tail.
      // The .find('div').children() method refers to all the div which are direct descendants of the previous div.
      iwBackground.children(':nth-child(3)').find('div').children().css({
        'box-shadow': 'rgba(134, 102, 28, 1) 0px 1px 6px',
        'z-index': '1'
      });


      // Taking advantage of the already established reference to
      // div .gm-style-iw with iwOuter variable.
      // You must set a new variable iwCloseBtn.
      // Using the .next() method of JQuery you reference the following div to .gm-style-iw.
      // Is this div that groups the close button elements.
      var iwCloseBtn = iwOuter.next();

      // Apply the desired effect to the close button
      iwCloseBtn.css({
        opacity: '1', // by default the close button has an opacity of 0.7
        right: '23px',
        top: '2px', // button repositioning
        border: '7px solid rgba(134, 102, 28, 1)', // increasing button border and new color
        'border-radius': '13px', // circular effect
        'box-shadow': '0 0 5px #3990B9', // 3D effect to highlight the button
        'box-sizing': 'content-box',
      });

      // The API automatically applies 0.7 opacity to the button after the mouseout event.
      // This function reverses this event to the desired value.
      iwCloseBtn.mouseout(function() {
        jQuery(this).css({
          opacity: '1'
        });
      });
    }); // end domready function

    var myButton = document.getElementById('scroll-toggle');
    google.maps.event.addDomListener(myButton, 'click', function(event) {
      if (document.getElementById('scroll-toggle').checked) {
        map.setOptions({
          scrollwheel: true
        });
      } else {
        map.setOptions({
          scrollwheel: false
        });
      }
    });

  } // end initMap function
</script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBjvS-FtBe5Z1iR8mIJGLB3pEXB0F9Bmp4&callback=initMap"></script>
<? get_footer(); ?>