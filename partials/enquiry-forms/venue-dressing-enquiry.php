<?
$postID = get_the_ID();
$imgID = get_post_thumbnail_id($post->ID); //get the id of the featured image
$featuredImage = wp_get_attachment_image_src($imgID, 'full');//get the url of the featured image (returns an array)
$imgURL = $featuredImage[0]; //get the url of the image out of the array
?>

<div class="alignleft wrapper">
    <div class="third intro side-info">
        <h2>Enquiry form for <? the_title(); ?> venue dressing</h2>
        <div class="wrapper">
            <img src="<?= $imgURL; ?>">
            <p>Fill in a few details opposite and we will get back to you as soon as possible with an accurate quote.</p>
            <p>We aim to respond to all enquiries within 24 hours.</p>
        </div>
    </div>

    <div class="two-thirds">
        <form action="/thank-you" method="post" class="tent-form" enctype="multipart/form-data"  reminder="venue-dressing-form">
            <? $hideEvent = get_post_meta($post->ID, 'hide-event', true);
            if(!$hideEvent) : ?>

                <div class="full event-field">
                    <div class="sixth text-center">
                        <span class="icon-glass"></span>
                    </div>
                    <div class="five-sixths">
                        <h4>What is your event?</h4>
                        <input type="radio" name="field_events" value="Wedding" id="wedding-3">
                        <label for="wedding-3" class="quarter-margined input-button clickable">
                            <span class="alignleft full vertical-align">Wedding</span>
                        </label>

                        <input type="radio" name="field_events" value="Party" id="party-3">
                        <label for="party-3" class="quarter-margined input-button clickable">
                            <span class="alignleft full vertical-align">Party</span>
                        </label>

                        <input type="radio" name="field_events" value="Corporate" id="corporate-3">
                        <label for="corporate-3" class="quarter-margined input-button clickable">
                            <span class="alignleft full vertical-align">Corporate Event</span>
                        </label>

                        <input type="radio" name="field_events" value="Festival" id="festival-3">
                        <label for="festival-3" class="quarter-margined input-button clickable">
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

                    <div class="half no-padding-left point-eight-trans dining-guests">
                        <h4 class="alignleft wrapper">Are any of these dining?<button class="quick-info icon-info2" value="dining-guests-box"></button><span class="quick-info-box dining-guests-box hide">Are you having a sit-down meal? If not, just leave this at zero.</span></h4>
                        <input type="number" min="0" value="0" name="field_dining_guests" class="text-center" id="field_dining_guests">
                    </div>
                </div>
            </div>

            <div class="full date-field">
                <div class="sixth text-center">
                    <span class="icon-calendar"></span>
                </div>
                <div class="five-sixths hidden-fields">
                    <h4 class="heading-label">Do you have a date?</h4>
                   

                    <input type="date" name="field_date" id="field_date" class="" placeholder="When?">
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

            <div class="clearleft full file-attachments">
                <div class="sixth text-center">
                    <span class="icon-cloud-upload"></span>
                </div>
                <div class="five-sixths">
                    <label for="field_file" class="alignleft">Do you have an interior picture of the venue? (optional)<button class="quick-info icon-info2" value="venue-picture"></button><span class="quick-info-box venue-picture hide">If you are able to provide us with an image of the inside of the venue, we can see how it looks and more accurately quote for you.</span></label>
                    <input class="clearleft row-padding-extra-small" type="file" name="field_file" id="field_file">
                </div>
            </div>

            <div class="clearleft full file-attachments">
                <div class="sixth text-center">
                    <span class="icon-rulers"></span>
                </div>
                <div class="five-sixths">
                    <label class="alignleft">Do you know the measurements of the venue? (optional)<button class="quick-info icon-info2" value="venue-measurements"></button><span class="quick-info-box venue-measurements hide">If you are able to provide us with the measurements of the venue, we can more accurately quote for you.</span></label>
                    <div class="alignleft full row-padding-extra-small no-padding-bottom">
                        <input class="third-margined" type="text" name="field_width" id="field_width" placeholder="Width" />
                        <input class="third-margined" type="text" name="field_length" id="field_length" placeholder="Length" />
                        <input class="third-margined" type="text" name="field_height" id="field_height" placeholder="Height" />
                    </div>
                </div>
            </div>

            <div class="clearleft full message-field">
                <div class="sixth text-center">
                    <span class="icon-envelop"></span>
                </div>
                <div class="five-sixths hidden-fields">
                    <div class="full ">
                        <h4 class="heading-label">Would you like to add a message?</h4>
                        <input type="radio" name="message-option" id="message_yes-3" class="show_option">
                        <label for="message_yes-3" class="input-button clickable">Yes</label>

                        <input type="radio" name="message-option" id="message_no-3" checked="checked">
                        <label for="message_no-3" class="input-button clickable">No</label>
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
                    <input type="hidden" name="which-form" value="Venue Dressing Form"/>
                    <input type="hidden" name="page-url" value="<?= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>"/>
                    <input type="submit" name="quick-form" data-id="venue-dressing" id="submit_results" class="no-margin enquire-button" placeholder="Submit"/>
                    <input type="hidden" class="token"/>
                </div>
            </div>
        </form>
    </div>
</div>