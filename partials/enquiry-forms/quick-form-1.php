<form action="/thank-you" method="post" class="small-form quick-form"  reminder="quick-form">
    <div class="full name-field">
        <div class="sixth text-center">
            <span class="icon-vcard"></span>
        </div>
        <div class="five-sixths">
            <label class="heading-label">Your name:</label>
            <input type="text" name="field_name" id="field_name" placeholder="Name" />
        </div>
    </div>

    <div class="full email-field">
        <div class="sixth text-center">
            <span class="icon-at-sign"></span>
        </div>
        <div class="five-sixths">
            <label class="heading-label">Your email:</label>
            <input type="text" name="field_email" id="field_email" placeholder="Email" />
        </div>
    </div>

    <div class="full telephone-field">
        <div class="sixth text-center">
            <span class="icon-phone"></span>
        </div>
        <div class="five-sixths">
            <label class="heading-label">Your telephone:</label>
            <input type="text" name="field_telephone" id="field_telephone" placeholder="Telephone" />
        </div>
    </div>
<div class="full event-field">
                    <div class="sixth text-center">
                        <span class="icon-glass"></span>
                    </div>
                    <div class="five-sixths">
                        <h4>What is your event?</h4>
                        <input type="radio" name="field_events" value="Wedding" id="wedding-e">
                        <label for="wedding-e" class="quarter-margined input-button clickable" style="padding: 2.95rem 3rem;">
                            <span class="alignleft full vertical-align">Wedding</span>
                        </label>

                        <input type="radio" name="field_events" value="Party" id="party-e">
                        <label for="party-e" class="quarter-margined input-button clickable" style="padding: 2.95rem 3rem;">
                            <span class="alignleft full vertical-align">Party</span>
                        </label>

                        <input type="radio" name="field_events" value="Corporate" id="corporate-e">
                        <label for="corporate-e" class="quarter-margined input-button clickable" style="padding: 2.95rem 3rem;">
                            <span class="alignleft full vertical-align">Corporate Event</span>
                        </label>

                        <input type="radio" name="field_events" value="Festival" id="festival-e">
                        <label for="festival-e" class="quarter-margined input-button clickable" style="padding: 2.95rem 3rem;">
                            <span class="alignleft full vertical-align">Festival</span>
                        </label>


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
    <div class="full message-field">
        <div class="sixth text-center">
            <span class="icon-envelop"></span>
        </div>
        <div class="five-sixths">
            <div class="full">
                <label class="heading-label">Your message:</label>
            </div>

            <textarea name="field_message" id="field_message" class="full" rows="8" placeholder="Your message"></textarea>
        </div>
    </div>

    <div class="full">
        <div class="five-sixths alignright">
            <input type="hidden" name="which-form" value="Quick Enquiry Form"/>
            <input type="hidden" name="page-url" value="<?= "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>"/>
            <input disabled type="submit" name="quick-form" data-id="quick-form" id="submit_results" class="enquire-button" placeholder="Submit"/>
            <input type="hidden" class="token"/>
        </div>
    </div>
</form>