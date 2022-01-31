<form action="/thank-you" method="post" class="small-form feedback-form"  reminder="feedback-form">
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

    <div class="full message-field">
        <div class="sixth text-center">
            <span class="icon-envelop"></span>
        </div>
        <div class="five-sixths">
            <div class="full">
                <label class="heading-label">Your feedback:</label>
            </div>

            <textarea name="field_message" id="field_message" class="full" rows="8" placeholder="Your feedback"></textarea>
        </div>
    </div>

    <div class="full">
        <div class="five-sixths alignright">
            <input type="hidden" name="which-form" value="Feedback Form"/>
            <input type="hidden" name="page-url" value="<?= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>"/>
            <input type="submit" name="quick-form" data-id="feedback-form" id="submit_results" class="no-margin enquire-button" placeholder="Submit"/>
            <input type="hidden" class="token"/>
        </div>
    </div>
</form>