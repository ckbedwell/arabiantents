<?
wp_reset_postdata();
$postID = get_the_ID();
$featuredImage = get_the_featured_image($postID)['full_url'];

if($isSingleTent != true && (is_archive() || is_tag() || is_tax())) { //
    $queried_object = get_queried_object();
    $taxonomy = $queried_object->taxonomy;
    $term_id = $queried_object->term_id;

    $featuredImage = get_field('term_image', $taxonomy . '_' . $term_id);
    $title = $queried_object->name;
    $excerpt = get_field('term_excerpt', $taxonomy . '_' . $term_id);
}
?>

<div class="alignleft wrapper">
    <div class="third intro side-info">
        <? if(is_page_template('my-templates/event-sub-page.php')) : ?>
            <h2>Enquiry form for <? the_title(); ?> event management</h2>
        <? elseif(is_page_template('my-templates/additional-service-page.php')) : ?>
            <h2>Enquiry form for our <? the_title(); ?> service</h2>
        <? elseif(is_tag()) : ?>
            <h2>Enquiry form for <?= $title; ?></h2>
        <? endif; ?>
        <div class="wrapper">
            <img src="<?= $featuredImage; ?>">
            <p>Fill in a few details opposite and we will get back to you as soon as possible with an accurate quote.</p>
            <p>We aim to respond to all enquiries within 24 hours.</p>
        </div>
    </div>

    <div class="two-thirds">
        <form action="/thank-you" method="post" class="tent-form"  reminder="event-form">
            <? $hideEvent = get_post_meta($post->ID, 'hide-event', true);
            if(!$hideEvent) : ?>

                <div class="full event-field">
                    <div class="sixth text-center">
                        <span class="icon-glass"></span>
                    </div>
                    <div class="five-sixths">
                        <h4>What is your event?</h4>
                        <input type="radio" name="field_events" value="Wedding" id="wedding-2">
                        <label for="wedding-2" class="quarter-margined input-button clickable">
                            <span class="alignleft full vertical-align">Wedding</span>
                        </label>

                        <input type="radio" name="field_events" value="Party" id="party-2">
                        <label for="party-2" class="quarter-margined input-button clickable">
                            <span class="alignleft full vertical-align">Party</span>
                        </label>

                        <input type="radio" name="field_events" value="Corporate" id="corporate-2">
                        <label for="corporate-2" class="quarter-margined input-button clickable">
                            <span class="alignleft full vertical-align">Corporate Event</span>
                        </label>

                        <input type="radio" name="field_events" value="Festival" id="festival-2">
                        <label for="festival-2" class="quarter-margined input-button clickable">
                            <span class="alignleft full vertical-align">Festival</span>
                        </label>


                    </div>
                </div>
            <? endif; ?>

            <div class="full guests-field">
                <div class="sixth text-center">
                    <span class="icon-man-woman"></span>
                </div>
                <div class="five-sixths">
                    <div class="half no-padding-left total-guests">
                        <h4 class="alignleft wrapper">Total amount of guests<button class="quick-info icon-info2" value="total-guests-box"></button><span class="quick-info-box total-guests-box hide">If you aren't sure on exact numbers, tell us the most guests you are expecting.</span></h4>
                        <input type="number" min="0" value="0" name="field_total_guests" class="text-center" id="field_total_guests">
                    </div>
                    <? if(is_page_template('my-templates/event-sub-page.php') || is_tag()) : ?>
                        <div class="half no-padding-left point-eight-trans dining-guests">
                            <h4 class="alignleft wrapper">Are any of these dining?<button class="quick-info icon-info2" value="dining-guests-box"></button><span class="quick-info-box dining-guests-box hide">Are you having a sit-down meal? If not, just leave this at zero.</span></h4>
                            <input type="number" min="0" value="0" name="field_dining_guests" class="text-center" id="field_dining_guests">
                        </div>
                    <? endif; ?>
                </div>
            </div>

            <div class="full date-field">
                <div class="sixth text-center">
                    <span class="icon-calendar"></span>
                </div>
                <div class="five-sixths hidden-fields">
                    <h4 class="heading-label">Do you have a date?</h4>
                    
                    <input type="date" name="field_date" id="field_date" class="" placeholder="date">
                </div>
            </div>

            <div class="full postcode-field">
                <div class="sixth text-center">
                    <span class="icon-location"></span>
                </div>
                <div class="five-sixths">
                    <h4 class="alignleft wrapper">What's the location of your venue?<button class="quick-info icon-info2" value="postcode-box"></button><span class="quick-info-box postcode-box hide">If you don't have an exact postcode, give us an indication of whereabouts in the country your venue will be so we can quote for delivery.</span></h4>
                    <input type="text" name="field_postcode" id="field_postcode" class="clearleft" placeholder="Postcode / location">
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
                <div class="five-sixths hidden-fields">
                    <div class="full ">
                        <h4 class="heading-label">Would you like to add a message?</h4>
                        <input type="radio" name="message-option" id="message_yes-2" class="show_option">
                        <label for="message_yes-2" class="input-button clickable">Yes</label>

                        <input type="radio" name="message-option" id="message_no-2" checked="checked">
                        <label for="message_no-2" class="input-button clickable">No</label>
                    </div>

                    <textarea name="field_message" id="field_message" class="full option-box fade-in move-left hide" rows="8" placeholder="Your message"></textarea>
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
                    <input type="hidden" name="which-form" value="Event Enquiry Form"/>
                    <input type="hidden" name="page-url" value="<?= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>"/>
                    <input type="submit" name="quick-form" data-id="event_enquiry" id="submit_results" class="no-margin enquire-button" placeholder="Submit"/>
                    <input type="hidden" class="token"/>
                </div>
            </div>
        </form>
    </div>
</div>