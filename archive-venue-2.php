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
<? get_template_part('json-test'); wp_reset_query(); ?>

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

            <? if (function_exists('breadcrumbs')) { breadcrumbs(); } ?>

            <section class="parent-contain entry-content" id="scrollto-entry-content">
                <div class="width-contain">

                    <?
                        $terms = get_terms('location', array(
                            'orderby'    => 'title',
                            'order'      => 'ASC',
                            'hide_empty' => 0
                       ));

                        foreach($terms as $term) : ?>

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
                                            <a href="<? the_permalink(); ?>" class="full image-link" >
                                                <div class="display-card-medium featured-image" data-bg="<?= $featuredImage['full_url']; ?>"></div>

                                                                <noscript>
                                                                    <div class="display-card-medium featured-image" style="background-image: url(<?= $featuredImage['full_url']; ?>);"></div>
                                                                </noscript>
                                                            

                                            </a>

                                                                                  <a href="#"  class="venue__like">
                                                                    <span class="like-icon">
                                                                    <svg viewBox="0 -28 512.001 512" xmlns="http://www.w3.org/2000/svg"><path d="m256 455.515625c-7.289062 0-14.316406-2.640625-19.792969-7.4375-20.683593-18.085937-40.625-35.082031-58.21875-50.074219l-.089843-.078125c-51.582032-43.957031-96.125-81.917969-127.117188-119.3125-34.644531-41.804687-50.78125-81.441406-50.78125-124.742187 0-42.070313 14.425781-80.882813 40.617188-109.292969 26.503906-28.746094 62.871093-44.578125 102.414062-44.578125 29.554688 0 56.621094 9.34375 80.445312 27.769531 12.023438 9.300781 22.921876 20.683594 32.523438 33.960938 9.605469-13.277344 20.5-24.660157 32.527344-33.960938 23.824218-18.425781 50.890625-27.769531 80.445312-27.769531 39.539063 0 75.910156 15.832031 102.414063 44.578125 26.191406 28.410156 40.613281 67.222656 40.613281 109.292969 0 43.300781-16.132812 82.9375-50.777344 124.738281-30.992187 37.398437-75.53125 75.355469-127.105468 119.308594-17.625 15.015625-37.597657 32.039062-58.328126 50.167969-5.472656 4.789062-12.503906 7.429687-19.789062 7.429687zm-112.96875-425.523437c-31.066406 0-59.605469 12.398437-80.367188 34.914062-21.070312 22.855469-32.675781 54.449219-32.675781 88.964844 0 36.417968 13.535157 68.988281 43.882813 105.605468 29.332031 35.394532 72.960937 72.574219 123.476562 115.625l.09375.078126c17.660156 15.050781 37.679688 32.113281 58.515625 50.332031 20.960938-18.253907 41.011719-35.34375 58.707031-50.417969 50.511719-43.050781 94.136719-80.222656 123.46875-115.617188 30.34375-36.617187 43.878907-69.1875 43.878907-105.605468 0-34.515625-11.605469-66.109375-32.675781-88.964844-20.757813-22.515625-49.300782-34.914062-80.363282-34.914062-22.757812 0-43.652344 7.234374-62.101562 21.5-16.441406 12.71875-27.894532 28.796874-34.609375 40.046874-3.453125 5.785157-9.53125 9.238282-16.261719 9.238282s-12.808594-3.453125-16.261719-9.238282c-6.710937-11.25-18.164062-27.328124-34.609375-40.046874-18.449218-14.265626-39.34375-21.5-62.097656-21.5zm0 0"/></svg>
                                                                </span>
                                                                </a>
                                        </div>
                                        <div class="parent-contain">
                                            <h3><? the_title(); ?></h3>
 
                                        </div>
                                    </div>
                                    <? endwhile; ?>
                            </div>
                        <? endforeach; wp_reset_postdata(); ?>
                </div>
            </section>
		</main>
<!---------- GOOGLE MAPS ----------------->

<script>

<? $count = $wp_query->post_count; ?>

    function initMap() {
      var myLatLng = {lat: 51.3980956, lng: -1.0912716000000273};
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

        marker.addListener('click', function () {
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
        iwBackground.children(':nth-child(2)').css({'display' : 'none'});
        // Remove the white background DIV
        iwBackground.children(':nth-child(4)').css({'display' : 'none'});

        // Changes the desired color for the tail outline.
        // The outline of the tail is composed of two descendants of div which contains the tail.
        // The .find('div').children() method refers to all the div which are direct descendants of the previous div.
        iwBackground.children(':nth-child(3)').find('div').children().css({'box-shadow': 'rgba(134, 102, 28, 1) 0px 1px 6px', 'z-index' : '1'});


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
        iwCloseBtn.mouseout(function(){
            jQuery(this).css({opacity: '1'});
            });
       }); // end domready function

    var myButton = document.getElementById('scroll-toggle');
    google.maps.event.addDomListener(myButton, 'click', function(event){
        if(document.getElementById('scroll-toggle').checked) {
            map.setOptions({scrollwheel:true});
            }
        else {
            map.setOptions({scrollwheel:false});
            }
        });

    } // end initMap function


</script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBjvS-FtBe5Z1iR8mIJGLB3pEXB0F9Bmp4&callback=initMap"></script>
<? get_footer(); ?>