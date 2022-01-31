<?
// https://www.creare.co.uk/blog/simple-wp_query-ajax
//Enqueue Ajax Scripts
function enqueue_ajax_scripts() {
    wp_register_script('ajax-js', get_template_directory_uri() . '/js/ajax-functions.js', array('jquery'), '1.0', true);

    wp_localize_script('ajax-js', 'ajax_functions_params', array('ajax_url' => admin_url('admin-ajax.php')));
    wp_enqueue_script('ajax-js');
}
add_action('wp_enqueue_scripts', 'enqueue_ajax_scripts');

add_action('wp_ajax_get_furniture', 'get_furniture');
add_action('wp_ajax_nopriv_get_furniture', 'get_furniture');

add_action('wp_ajax_get_more_furniture', 'get_more_furniture');
add_action('wp_ajax_nopriv_get_more_furniture', 'get_more_furniture');

add_action('wp_ajax_get_framed_layouts', 'get_framed_layouts');
add_action('wp_ajax_nopriv_get_framed_layouts', 'get_framed_layouts');

add_action('wp_ajax_get_pole_layouts', 'get_pole_layouts');
add_action('wp_ajax_nopriv_get_pole_layouts', 'get_pole_layouts');


add_action('wp_ajax_events_contact_overlay', 'events_contact_overlay');
add_action('wp_ajax_nopriv_events_contact_overlay', 'events_contact_overlay');

add_action('wp_ajax_tents_contact_overlay', 'tents_contact_overlay');
add_action('wp_ajax_nopriv_tents_contact_overlay', 'tents_contact_overlay');

add_action('wp_ajax_venue_dressing_contact_overlay', 'venue_dressing_contact_overlay');
add_action('wp_ajax_nopriv_venue_dressing_contact_overlay', 'venue_dressing_contact_overlay');

add_action('wp_ajax_furniture_contact_overlay', 'furniture_contact_overlay');
add_action('wp_ajax_nopriv_furniture_contact_overlay', 'furniture_contact_overlay');


add_action('wp_ajax_construct_furniture_form', 'construct_furniture_form');
add_action('wp_ajax_nopriv_construct_furniture_form', 'construct_furniture_form');


function construct_furniture_form() {
    $query_data = $_GET;
    $postIDs = ($query_data['postIDs']) ? $query_data['postIDs'] : false;


    $args = array(
        'post_type' => 'furniture',
        'post__in' => $postIDs
    );


    $recentPosts = new WP_Query($args);

    while ($recentPosts->have_posts()) : $recentPosts->the_post();
        $imgID = get_post_thumbnail_id($post->ID); //get the id of the featured image
        $featuredImage = wp_get_attachment_image_src($imgID, 'full');//get the url of the featured image (returns an array)
        $imgURL = $featuredImage[0]; //get the url of the image out of the array
        $thumbImage = wp_get_attachment_image_src($imgID, 'thumbnail');//get the url of the featured image (returns an array)
        $thumbURL = $thumbImage[0]; //get the url of the image out of the array
        ?>

        <tr value="<? the_ID(); ?>">
            <td>
                <a class="lightbox-link" href="<?= $imgURL; ?>" caption="<? the_title(); ?>">
                    <img src="<?= $thumbURL; ?>" class="point-three-trans">
                </a>
            </td>
            <td>
                <input readonly name="furniture_item[]" value="<? the_title(); ?>">
            </td>
            <td>
                <input type="number" name="furniture_quantity[]" min="1" value="1">
            </td>
            <td>
                <span class="icon-cross"></span>
            </td>
        </tr>
    <? endwhile; wp_reset_postdata();
    die();
}

//CONTACT FORMS

//EVENT FORMS

function events_contact_overlay() { ?>
    <h2>What kind of event are you planning?</h2>
    <p class="width-contain-800">Depending on your event, we can help with planning and organisation, such as recommending layouts, furniture and other furnishings. We want your event to be the best it can possibly be!</p>
    <div class="full">
        <?
        $args = array(
            'post_type' => 'page',
            'order' => ASC,
            'tax_query' => array (
                array(
                    'taxonomy' => 'page-type',
                    'field' => 'slug',
                    'terms' => 'service-page',
                ),
            )
        );

        $query = new WP_Query($args);
        $count = $query->post_count;
        if ($count == 2 || $count == 4) { $size = 'half'; }
        else { $size = 'third'; }
        while ($query->have_posts()) : $query->the_post();
            $imgID = get_post_thumbnail_id($post->ID); //get the id of the featured image
            $featuredImage = wp_get_attachment_image_src($imgID, 'full');//get the url of the featured image (returns an array)
            $imgURL = $featuredImage[0]; //get the url of the image out of the array
            ?>

            <div class="<?= $size; ?>">
                <a href="<? the_permalink(); ?>?enquiry=true" class="display-card-large image-link featured-image" style="background-image: url(<?= $imgURL; ?>);">
                    <div class="overlay-information">
                        <h3><? the_title(); ?></h3>
                    </div>
                </a>
            </div>
        <? endwhile; wp_reset_postdata(); ?>
    </div>
    <? die();
} // END EVENTS CONTACT OVERLAY

// TENT FORM
function tents_contact_overlay() { ?>
    <div class="all-tent-types">
        <h2>What kind of tent do you wish to enquire about?</h2>
        <p class="width-contain-800">We have several different types of tent for you to choose from. Depending on what event you are planning will depend on which tent will be best suited for you.</p>
        <?
        $tentTypes = get_terms('tent_type');
        foreach($tentTypes as $tentType) :
            $name = $tentType->name;
            $id = 'tent_type_' . $tentType->term_id;
            $imgURL = get_term_meta($id, 'term_image', true);
            $count = $tentType->count;
            $slug = $tentType->slug;
            ?>

            <div class="quarter enquiry-choices">
                <? if($count == 1) : ?>
                    <a href="/tents/<?= $slug; ?>?enquiry=true" class="full display-card image-link featured-image" style="background-image: url(<? the_field('term_image', $id); ?>);">
                        <div class="overlay-information">
                            <h3><?= $name; ?></h3>
                        </div>
                    </a>

                <? else : ?>

                    <a value="<?= $slug; ?>" class="full display-card image-link featured-image" style="background-image: url(<? the_field('term_image', $id); ?>);">
                        <div class="overlay-information">
                            <h3><?= $name; ?></h3>
                        </div>
                    </a>
                <? endif; ?>
            </div>
        <? endforeach; ?>
        <div class="quarter enquiry-choices">
            <a href="" value="quick-enquiry" class="full display-card image-link featured-image more-info" style="background-image: url(/wp-content/themes/arabiantents/images/not-sure.png);">
                <div class="overlay-information">
                    <h3>Not sure!</h3>
                </div>
            </a>
        </div>
    </div>
    <? foreach($tentTypes as $tentType) :
        $name = $tentType->name;
        $id = 'tent_type_' . $tentType->term_id;
        $imgURL = get_term_meta($id, 'term_image', true);
        $count = $tentType->count;
        $slug = $tentType->slug;
        $description = $tentType->description;
        if($count > 1) :
            ?>
            <div class="tent-type hide" id="<?= $slug; ?>">
                <h2>Which tent would you like to enquire about?</h2>
                <p class="width-contain-800"><?= $description; ?></p>
                <button class="clearleft clickable go-back"><span class="icon-arrow-right"></span>Go Back to Tents Selection</button>
                <?
                $args = array(
                    'post_type' => 'tent',
                    'tent_type' => $slug
                );


                $query = new WP_Query($args);
                $count = $query->post_count;
                if ($count == 2) { $size = 'half archive larger-cards';}
                else if ($count == 4) { $size = 'quarter';}
                else { $size = 'third'; }
                while ($query->have_posts()) : $query->the_post();
                    $imgID = get_post_thumbnail_id($post->ID); //get the id of the featured image
                    $featuredImage = wp_get_attachment_image_src($imgID, 'full');//get the url of the featured image (returns an array)
                    $imgURL = $featuredImage[0]; //get the url of the image out of the array
                    ?>

                    <div class="<?= $size; ?>">
                        <a href="<? the_permalink(); ?>?enquiry=true" class="display-card image-link featured-image" style="background-image: url(<?= $imgURL; ?>);">
                            <div class="overlay-information">
                                <h3><? the_title(); ?></h3>
                            </div>
                        </a>
                    </div>
                <? endwhile; wp_reset_postdata(); ?>
            </div>
        <? endif; endforeach; die();
} // END TENTS CONTACT OVERLAY


//EVENT FORMS

function venue_dressing_contact_overlay() { ?>
    <h2>What venue dressing are you in need of?</h2>
    <p class="width-contain-800">We have a range of venue dressings to choose from. Pick the one that best suits your needs.</p>
    <div class="full">
        <?
        $args = array(
            'post_type' => 'venue-dressing',
            'order' => 'ASC'
        );


        $query = new WP_Query($args);
        $count = $query->post_count;
        if ($count == 2 || $count == 4) { $size = 'half'; }
        else { $size = 'third'; }
        while ($query->have_posts()) : $query->the_post();
            $imgID = get_post_thumbnail_id($post->ID); //get the id of the featured image
            $featuredImage = wp_get_attachment_image_src($imgID, 'full');//get the url of the featured image (returns an array)
            $imgURL = $featuredImage[0]; //get the url of the image out of the array
            ?>

            <div class="<?= $size; ?>">
                <a href="<? the_permalink(); ?>?enquiry=true" class="display-card-large image-link featured-image" style="background-image: url(<?= $imgURL; ?>);">
                    <div class="overlay-information">
                        <h3><? the_title(); ?></h3>
                    </div>
                </a>
            </div>
        <? endwhile; wp_reset_postdata(); ?>
    </div>
    <? die();
} // END VENUE DRESSING CONTACT OVERLAY


/****/

function furniture_contact_overlay() {
    $query_data = $_GET;
    $pageURL = ($query_data['pageURL']) ? $query_data['pageURL'] : false;
    ?>

    <div class="third intro side-info">
        <h2>Do you know what furniture you are after?</h2>
        <p>This form let's you be as specific or as vague as you like.</p>
        <p>You can either find every item you are after and tell us how many, or just tell us what furniture you are after in the message box.</p>
        <p>As soon as we have received your enquiry we will get back to you within 24 hours.</p>
    </div>

    <form action="/thank-you" method="post"  class="two-thirds furniture-form" id="form9" reminder="furniture-form">
        <div class="full">
            <div class="four-fifths no-padding-left">
                <select multiple class="chosen-select" data-placeholder="Browse or search for furniture">
                    <?
                    WP_reset_query();
                    $terms = get_terms('furniture_type');

                    foreach($terms as $term){
                        $termID = $term->slug;
                        $termName = $term->name;

                        $args = array (
                            'post_type' => 'furniture',
                            'orderby' => 'name',
                            'order' => 'ASC',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'furniture_type',
                                    'field' => 'slug',
                                    'terms' => $termID
                                )
                            )
                        );

                        $furnitureQuery = new WP_Query($args);
                        echo '<optgroup label="' . $termName . '">';
                        while($furnitureQuery->have_posts()) {

                            $furnitureQuery->the_post();
                            $title = get_the_title();
                            $lower = strtolower($title);
                            $lower = str_replace(' ', '-', $lower);
                            $id = get_the_ID();
                            echo $lower;
                            echo '<option value="'. $id . '" data-img-src="http://arabiantents.digicrab.com/wp-content/uploads/2016/03/Little-Details-four-poster-daybed-1-150x150.jpg">' . $title . '</option>';
                        }
                        echo '</optgroup>';
                    }
                    ?>
                </select>
                <input class="edgefix" style="opacity: 0; width: 0; position: absolute; z-index: -10;">
            </div>
            <div class="fifth no-padding-right">
                <button type="button" class="clickable furniture-add">Add Items</button>
            </div>
        </div>
        <table class="furniture-table text-center gallery">
            <thead>
            <tr>
                <th></th>
                <th class="table-name">Name</th>
                <th class="table-quantity">Quantity</th>
                <th class="table-remove">Remove</th>
            </tr>
            </thead>
            <tbody>
            <tr class="placeholder">
                <td colspan="4"><em style="display: inline-block; padding: 0 1rem;">Use the select box above to choose furniture then hit the 'Add Items' button, or alternatively use the message box below to tell us what you are after.</em></td>
            </tr>
            </tbody>
        </table>

        <div class="divider">
            <h3>A few extra details...</h3>
            <div class="full date-field">
                <div class="sixth text-center">
                    <span class="icon-calendar"></span>
                </div>
                <div class="five-sixths">
                    <h4 class="heading-label">Hire date:</h4>
                    <input type="text" name="field_date" id="field_date" class="option-box" placeholder="When?">
                </div>
            </div>

            <div class="full postcode-field">
                <div class="sixth text-center">
                    <span class="icon-location"></span>
                </div>
                <div class="five-sixths">
                    <h4 class="alignleft wrapper">What's the location of your venue?</h4>
                    <input type="text" name="field_postcode" id="field_postcode" class="clearleft" placeholder="Postcode or location">
                </div>
            </div>

            <div class="full name-field">
                <div class="sixth text-center">
                    <span class="icon-vcard"></span>
                </div>
                <div class="five-sixths">
                    <h4 class="heading-label">Your name:</h4>
                    <input type="text" name="field_name" id="field_name" placeholder="Name" />
                </div>
            </div>

            <div class="full email-field">
                <div class="sixth text-center">
                    <span class="icon-at-sign"></span>
                </div>
                <div class="five-sixths">
                    <h4 class="heading-label">Your email:</h4>
                    <input type="text" name="field_email" id="field_email" placeholder="Email" />
                </div>
            </div>

            <div class="full telephone-field">
                <div class="sixth text-center">
                    <span class="icon-phone"></span>
                </div>
                <div class="five-sixths">
                    <h4 class="heading-label">Your telephone:</h4>
                    <input type="text" name="field_telephone" id="field_telephone" placeholder="Telephone" />
                </div>
            </div>

            <div class="full message-field">
                <div class="sixth text-center">
                    <span class="icon-envelop"></span>
                </div>
                <div class="five-sixths">
                    <h4 class="heading-label">Would you like to add a message?</h4>
                    <textarea name="field_message" id="field_message" class="full option-box" rows="8" placeholder="Your message"></textarea>
                </div>
            </div>

            <div class="full newsletter-field">
                <div class="sixth text-center">
                </div>
                <div class="five-sixths">
                    <input type="checkbox" class="alignleft" name="field_newsletter" id="field_newsletter" checked/>
                    <p class="alignleft">I would like to receive news and updates</p>
                </div>
            </div>

            <div class="full">
                <div class="five-sixths alignright">
                    <input type="hidden" name="which-form" value="Furniture Enquiry Form"/>
                    <input type="hidden" name="page-url" value="<?= $pageURL; ?>"/>
                    <input type="submit" data-id="furniture-form-ajax-functions" name="furniture-form" id="submit_results" class="enquire-button" placeholder="Submit"/>
                    <input type="hidden" class="token"/>
                </div>
            </div>
        </div>
    </form>
    <? die();
} // END FURNITURE CONTACT OVERLAY

function get_furniture() {

    $query_data = $_GET;
    $postID = ($query_data['postID']) ? $query_data['postID'] : false;
    $postTitle = ($query_data['title']) ? $query_data['title'] : false;

    $meta_quer_args = array(
        'relation'  =>   'OR',
        array(
            'key'       =>   'specific-tents',
            'value'     =>   $postID,
            'compare'   =>   '=',
        )
    );

    $args = array(
        'post_type' => 'furniture',
        'posts_per_page' => '10',
        'meta_query' => $meta_quer_args
    );


    $recentPosts = new WP_Query($args);
    $countPosts = $recentPosts->found_posts;
    if ($recentPosts->have_posts()) :
        ?>

        <? while ($recentPosts->have_posts()) : $recentPosts->the_post();
        $imgID = get_post_thumbnail_id($post->ID); //get the id of the featured image
        $featuredImage = wp_get_attachment_image_src($imgID, 'full');//get the url of the featured image (returns an array)
        $imgURL = $featuredImage[0]; //get the url of the image out of the array
        $furniturePrice = get_post_meta(get_the_ID(), 'furniture-price', true);
        ?>

        <a class="lightbox-link masonry-item image-link vis-hide" href="<?= $imgURL; ?>" caption="<? the_title(); ?>">
            <img class="point-five-trans" src="<?= $imgURL; ?>">
            <div class="overlay-information">
                <h3><? the_title(); ?></h3>
                <h5><?
                    if(!empty($furniturePrice)) {
                        if (get_post_meta(get_the_ID(), 'from-prefix', true) == 1) {
                            echo 'From ';
                        }
                        echo '£' . $furniturePrice;
                    }
                    ?></h5>

            </div>
        </a>
    <? endwhile; wp_reset_postdata(); ?>
        <div class="row-padding-small full bottom-wrapper">
            <p>Showing <strong class="showing" id="showing">10</strong> out of <strong class="out-of"></strong> furniture items.</p>
            <button class="black-button clickable aligncenter ajax-more-button">Load More</button>
        </div>
        <script>
            var countPosts = <?= $countPosts; ?>;
            jQuery('.out-of').html(countPosts);
            if (countPosts <= 10) {
                jQuery('.ajax-more-button').remove();
            }
        </script>
    <? endif;
    die();
}

//Construct Additional Furniture Loop
function get_more_furniture() {

    $query_data = $_GET;
    $postID = ($query_data['postID']) ? $query_data['postID'] : false;
    $offset = ($query_data['offset']) ? $query_data['offset'] : false;

    $meta_quer_args = array(
        'relation'  =>   'OR',
        array(
            'key'       =>   'specific-tents',
            'value'     =>   $postID,
            'compare'   =>   '=',
        )
    );

    $args = array(
        'post_type' => 'furniture',
        'posts_per_page' => '10',
        'meta_query' => $meta_quer_args,
        'offset' => $offset
    );

    $recentPosts = new WP_Query($args);
    $countPosts = $recentPosts->found_posts;
    if ($recentPosts->have_posts()) : ?>
        <? while ($recentPosts->have_posts()) : $recentPosts->the_post();
            $imgID = get_post_thumbnail_id($post->ID); //get the id of the featured image
            $featuredImage = wp_get_attachment_image_src($imgID, 'full');//get the url of the featured image (returns an array)
            $imgURL = $featuredImage[0]; //get the url of the image out of the array
            $furniturePrice = get_post_meta(get_the_ID(), 'furniture-price', true);
            ?>

            <a class="lightbox-link masonry-item image-link vis-hide" href="<?= $imgURL; ?>" caption="<? the_title(); ?>">
                <img class="point-five-trans" src="<?= $imgURL; ?>">
                <div class="overlay-information">
                    <h3><?= the_title(); ?></h3>
                    <h5><?
                        if(!empty($furniturePrice)) {
                            if (get_post_meta(get_the_ID(),'from-prefix', true) == 1) {
                                echo 'From ';
                            }
                            echo '£' . $furniturePrice;
                        }
                        ?>
                    </h5>
                </div>
            </a>
        <? endwhile; wp_reset_postdata(); ?>
        <script>
            var currentCount = jQuery('#showing').html();
            var newCount = parseInt(currentCount, 10) + 10;
            jQuery('.showing').html(newCount);

            totalCount = <?= $countPosts; ?>;
            if (newCount >= totalCount) {
                jQuery('.showing').html(totalCount);
                jQuery('.ajax-more-button').addClass('hide');
            }
        </script>
    <? endif;
    die();
}

//Construct Framed Layout Loop
function get_framed_layouts() {

    $query_data = $_GET;
    $totalGuests = ($query_data['totalGuests']) ? $query_data['totalGuests'] : false;
    $diningGuests = ($query_data['diningGuests']) ? $query_data['diningGuests'] : false;
    $acceptableError = $diningGuests * 1.5;
    $acceptablePartyError = $totalGuests * 1.25;

    // EXACT MATCH
    if ($diningGuests == 0) { // CHECK FOR PARTY LAYOUT
        $meta_quer_args = array(
            'relation'  =>   'AND',
            array(
                'key'       =>   'max-dining-capacity',
                'value'     =>   '0', // CHECKS FOR PARTY LAYOUT AS NO DINERS
                'type'      =>  'numeric',
                'compare'   =>   '=',
            ),

            array(
                'key'       =>   'max-capacity',
                'value'     =>   $totalGuests,
                'type'      =>  'numeric',
                'compare'   =>   '=',
            )
        );

        $args = array(
            'post_type' => 'layout',
            'posts_per_page' => '6',
            'meta_query' => $meta_quer_args
        );
    }
    else { // DINING LAYOUT
        $meta_quer_args = array(
            'relation'  =>   'AND',
            array(
                'key'       =>   'max-dining-capacity',
                'value'     =>   $diningGuests,
                'type'      =>  'numeric',
                'compare'   =>   '=',
            ),

            array(
                'key'       =>   'max-capacity',
                'value'     =>   $totalGuests,
                'type'      =>  'numeric',
                'compare'   =>   '>=',
            )
        );

        $args = array(
            'post_type' => 'layout',
            'posts_per_page' => '6',
            'meta_query' => $meta_quer_args
        );
    }

    // NO LAYOUT EXACTLY MATCHES THE USER QUERY, LOOK FOR LAYOUTS WITH ACCEPTABLE DEVIATION
    if ($diningGuests == 0) { // CHECK FOR PARTY LAYOUT
        $meta_quer_argsTwo = array(
            'relation'  =>   'AND',
            array(
                'key'       =>   'max-dining-capacity',
                'value'     =>   '0', // CHECKS FOR PARTY LAYOUT AS NO DINERS
                'type'      =>  'numeric',
                'compare'   =>   '=',
            ),

            array(
                'key'       =>   'max-capacity',
                'value'     =>   array($totalGuests, $acceptablePartyError),
                'type'      =>  'numeric',
                'compare'   =>   'BETWEEN',
            )
        );

        $argsTwo = array(
            'post_type' => 'layout',
            'posts_per_page' => '6',
            'meta_query' => $meta_quer_argsTwo
        );
    }
    else { // DINING LAYOUT
        $meta_quer_argsTwo = array(
            'relation'  =>   'AND',
            array(
                'key'       =>   'max-dining-capacity',
                'value'     =>   array($diningGuests, $acceptableError),
                'type'      =>  'numeric',
                'compare'   =>   'BETWEEN',
            ),

            array(
                'key'       =>   'max-capacity',
                'value'     =>   $totalGuests,
                'type'      =>  'numeric',
                'compare'   =>   '>=',
            )
        );

        $argsTwo = array(
            'post_type' => 'layout',
            'posts_per_page' => '6',
            'meta_query' => $meta_quer_argsTwo
        );
    }

    //

    $recentPosts = new WP_Query($args);
    $notExact = new WP_Query($argsTwo);
    if ($recentPosts->have_posts()) : ?>

        <? while ($recentPosts->have_posts()) : $recentPosts->the_post();
            $imgID = get_post_thumbnail_id($post->ID); //get the id of the featured image
            $featuredImage = wp_get_attachment_image_src($imgID, 'full');//get the url of the featured image (returns an array)
            $imgURL = $featuredImage[0]; //get the url of the image out of the array
            $lower = strtolower(get_the_title());
            $friendlyTitle = str_replace(" ", "-", $lower);
            $maxCapacity = get_post_meta(get_the_ID(), 'max-capacity', true);
            $maxDiningCapacity = get_post_meta(get_the_ID(), 'max-dining-capacity', true);
            ?>
            <div class="half-margined gallery" id="post-<? the_ID(); ?>">
                <input type="checkbox" name="field_framed_layouts[]" value="<?= $imgURL; ?>" id="<?= $friendlyTitle; ?>">
                <label for="<?= $friendlyTitle; ?>">
                    <div class="overlay-information"></div>
                    <img class="point-five-trans" src="<?= $imgURL; ?>">
                    <a class="lightbox-link view-more-link" href="<?= $imgURL; ?>" caption="<? the_title(); ?>" title="View Larger"></a>
                </label>
                <h3>Layout Title</h3>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                <ul>
                    <li><span class="icon-man-woman"></span><strong>Max Capacity:</strong> <?= $maxCapacity; ?></li>
                    <li><span class="icon-fork-knife"></span><strong>Dining Capacity:</strong> <?= $maxDiningCapacity; ?></li>
                </ul>

            </div>

        <? endwhile; wp_reset_postdata(); ?>
        <script>console.log('Exact query used');</script>

    <? elseif ($notExact->have_posts()) : ?>
        <? while ($notExact->have_posts()) : $notExact->the_post();
            $imgID = get_post_thumbnail_id($post->ID); //get the id of the featured image
            $featuredImage = wp_get_attachment_image_src($imgID, 'full');//get the url of the featured image (returns an array)
            $imgURL = $featuredImage[0]; //get the url of the image out of the array
            $lower = strtolower(get_the_title());
            $friendlyTitle = str_replace(" ", "-", $lower);
            $maxCapacity = get_post_meta(get_the_ID(), 'max-capacity', true);
            $maxDiningCapacity = get_post_meta(get_the_ID(), 'max-dining-capacity', true);
            ?>
            <div class="half-margined gallery" id="post-<? the_ID(); ?>">
                <input type="checkbox" name="field_framed_layouts[]" value="<?= $imgURL; ?>" id="<?= $friendlyTitle; ?>">
                <label for="<?= $friendlyTitle; ?>">
                    <div class="overlay-information"></div>
                    <img class="point-five-trans" src="<?= $imgURL; ?>">
                    <a class="lightbox-link view-more-link" href="<?= $imgURL; ?>" caption="<? the_title(); ?>" title="View Larger"></a>
                </label>
                <h3>Layout Title</h3>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                <ul>
                    <li><span class="icon-man-woman"></span><strong>Max Capacity:</strong> <?= $maxCapacity; ?></li>
                    <li><span class="icon-fork-knife"></span><strong>Dining Capacity:</strong> <?= $maxDiningCapacity; ?></li>
                </ul>

            </div>

        <? endwhile; wp_reset_postdata(); ?>
        <script>
            console.log("Acceptable query used");
            console.log("<? 'Acceptable Party Error: ' . $acceptablePartyError; ?>");
            console.log("<? 'Acceptable Dining Error: ' . $acceptableError; ?>");
            console.log("<? 'Acceptable Total Guests: ' . $totalGuests; ?>");
        </script>
    <? else : ?>
        <?= 'Acceptable Party Error: ' . $acceptablePartyError; ?>
        <?= 'Acceptable Dining Error: ' . $acceptableError; ?>
    <? endif;



    die();
}


// DO NOT MODIFY UNTIL HAPPY WITH FRAMED FUNCTION -- REPEATED EXCEPT FOR TENT TYPE
//Construct Pole Layout Loop
function get_pole_layouts() {

    $query_data = $_GET;
    $totalGuests = ($query_data['totalGuests']) ? $query_data['totalGuests'] : false;
    $diningGuests = ($query_data['diningGuests']) ? $query_data['diningGuests'] : false;
    $acceptableError = $diningGuests * 1.5;
    $acceptablePartyError = $totalGuests * 1.25;

    // EXACT MATCH
    if ($diningGuests == 0) { // CHECK FOR PARTY LAYOUT
        $meta_quer_args = array(
            'relation'  =>   'AND',
            array(
                'key'       =>   'max-dining-capacity',
                'value'     =>   '0', // CHECKS FOR PARTY LAYOUT AS NO DINERS
                'type'      =>  'numeric',
                'compare'   =>   '=',
            ),

            array(
                'key'       =>   'max-capacity',
                'value'     =>   $totalGuests,
                'type'      =>  'numeric',
                'compare'   =>   '=',
            )
        );

        $args = array(
            'post_type' => 'layout',
            'posts_per_page' => '6',
            'meta_query' => $meta_quer_args
        );
    }
    else { // DINING LAYOUT
        $meta_quer_args = array(
            'relation'  =>   'AND',
            array(
                'key'       =>   'max-dining-capacity',
                'value'     =>   $diningGuests,
                'type'      =>  'numeric',
                'compare'   =>   '=',
            ),

            array(
                'key'       =>   'max-capacity',
                'value'     =>   $totalGuests,
                'type'      =>  'numeric',
                'compare'   =>   '>=',
            )
        );

        $args = array(
            'post_type' => 'layout',
            'posts_per_page' => '6',
            'meta_query' => $meta_quer_args
        );
    }

    // NO LAYOUT EXACTLY MATCHES THE USER QUERY, LOOK FOR LAYOUTS WITH ACCEPTABLE DEVIATION
    if ($diningGuests == 0) { // CHECK FOR PARTY LAYOUT
        $meta_quer_argsTwo = array(
            'relation'  =>   'AND',
            array(
                'key'       =>   'max-dining-capacity',
                'value'     =>   '0', // CHECKS FOR PARTY LAYOUT AS NO DINERS
                'type'      =>  'numeric',
                'compare'   =>   '=',
            ),

            array(
                'key'       =>   'max-capacity',
                'value'     =>   array($totalGuests, $acceptablePartyError),
                'type'      =>  'numeric',
                'compare'   =>   'BETWEEN',
            )
        );

        $argsTwo = array(
            'post_type' => 'layout',
            'posts_per_page' => '6',
            'meta_query' => $meta_quer_argsTwo
        );
    }
    else { // DINING LAYOUT
        $meta_quer_argsTwo = array(
            'relation'  =>   'AND',
            array(
                'key'       =>   'max-dining-capacity',
                'value'     =>   array($diningGuests, $acceptableError),
                'type'      =>  'numeric',
                'compare'   =>   'BETWEEN',
            ),

            array(
                'key'       =>   'max-capacity',
                'value'     =>   $totalGuests,
                'type'      =>  'numeric',
                'compare'   =>   '>=',
            )
        );

        $argsTwo = array(
            'post_type' => 'layout',
            'posts_per_page' => '6',
            'meta_query' => $meta_quer_argsTwo
        );
    }

    //

    $recentPosts = new WP_Query($args);
    $notExact = new WP_Query($argsTwo);
    if ($recentPosts->have_posts()) : ?>

        <? while ($recentPosts->have_posts()) : $recentPosts->the_post();
            $imgID = get_post_thumbnail_id($post->ID); //get the id of the featured image
            $featuredImage = wp_get_attachment_image_src($imgID, 'full');//get the url of the featured image (returns an array)
            $imgURL = $featuredImage[0]; //get the url of the image out of the array
            $lower = strtolower(get_the_title());
            $friendlyTitle = str_replace(" ", "-", $lower);
            $maxCapacity = get_post_meta(get_the_ID(), 'max-capacity', true);
            $maxDiningCapacity = get_post_meta(get_the_ID(), 'max-dining-capacity', true);
            ?>
            <div class="half-margined gallery" id="post-<? the_ID(); ?>">
                <input type="checkbox" name="field_pole_layouts[]" value="<?= $imgURL; ?>" id="pole-<?= $friendlyTitle; ?>">
                <label for="pole-<?= $friendlyTitle; ?>">
                    <div class="overlay-information"></div>
                    <img class="point-five-trans" src="<?= $imgURL; ?>">
                    <a class="lightbox-link view-more-link" href="<?= $imgURL; ?>" caption="<? the_title(); ?>" title="View Larger"></a>
                </label>
                <h3>Layout Title</h3>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                <ul>
                    <li><span class="icon-man-woman"></span><strong>Max Capacity:</strong> <?= $maxCapacity; ?></li>
                    <li><span class="icon-fork-knife"></span><strong>Dining Capacity:</strong> <?= $maxDiningCapacity; ?></li>
                </ul>

            </div>

        <? endwhile; wp_reset_postdata(); ?>
        <script>console.log('Exact query used');</script>

    <? elseif ($notExact->have_posts()) : ?>
        <? while ($notExact->have_posts()) : $notExact->the_post();
            $imgID = get_post_thumbnail_id($post->ID); //get the id of the featured image
            $featuredImage = wp_get_attachment_image_src($imgID, 'full');//get the url of the featured image (returns an array)
            $imgURL = $featuredImage[0]; //get the url of the image out of the array
            $lower = strtolower(get_the_title());
            $friendlyTitle = str_replace(" ", "-", $lower);
            $maxCapacity = get_post_meta(get_the_ID(), 'max-capacity', true);
            $maxDiningCapacity = get_post_meta(get_the_ID(), 'max-dining-capacity', true);
            ?>
            <div class="half-margined gallery" id="post-<? the_ID(); ?>">
                <input type="checkbox" name="field_pole_layouts[]" value="<?= $imgURL; ?>" id="field-<?= $friendlyTitle; ?>">
                <label for="field-<?= $friendlyTitle; ?>">
                    <div class="overlay-information"></div>
                    <img class="point-five-trans" src="<?= $imgURL; ?>">
                    <a class="lightbox-link view-more-link" href="<?= $imgURL; ?>" caption="<? the_title(); ?>" title="View Larger"></a>
                </label>
                <h3>Layout Title</h3>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                <ul>
                    <li><span class="icon-man-woman"></span><strong>Max Capacity:</strong> <?= $maxCapacity; ?></li>
                    <li><span class="icon-fork-knife"></span><strong>Dining Capacity:</strong> <?= $maxDiningCapacity; ?></li>
                </ul>
            </div>

        <? endwhile; wp_reset_postdata(); ?>
        <script>
            console.log("Acceptable query used");
            console.log("<? 'Acceptable Party Error: ' . $acceptablePartyError; ?>");
            console.log("<? 'Acceptable Dining Error: ' . $acceptableError; ?>");
            console.log("<? 'Acceptable Total Guests: ' . $totalGuests; ?>");
        </script>

    <? else : ?>
        <?= 'Acceptable Party Error: ' . $acceptablePartyError; ?>
        <?= 'Acceptable Dining Error: ' . $acceptableError; ?>
    <? endif;
    die();
}