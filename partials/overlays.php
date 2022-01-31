<?php
$enquiry = $_GET["enquiry"];
if($enquiry == true) {
    $hide = 'active';
} else {
    $hide = 'hide';
}

?>
<div class="overlay <?= $hide; ?> fade-in"></div>
<div class="vertical-align horizontal-align message-reminder">
    <span class="icon-envelop"></span>
</div>
<?

include(locate_template('/partials/overlays/quick-enquiry-overlay.php'));
include(locate_template('/partials/overlays/events-enquiry-overlay.php'));
include(locate_template('/partials/overlays/tents-enquiry-overlay.php'));
include(locate_template('/partials/overlays/venue-dressing-overlay.php'));
include(locate_template('/partials/overlays/furniture-enquiry-overlay.php'));
include(locate_template('/partials/overlays/feedback-form-overlay.php'));
include(locate_template('/partials/overlays/newsletter-overlay.php'));


if (is_singular(array('tent', 'location', 'product')) || is_tax('tent_type')) {
    include(locate_template('/partials/overlays/tent-specific-enquiry-overlay.php'));
    include(locate_template('/partials/overlays/tent-faqs.php'));
}

if (is_page_template('my-templates/event-sub-page.php') || is_page_template('my-templates/additional-service-page.php') || is_tag() || is_page_template('my-templates/page-ideas.php')) {
    include(locate_template('/partials/overlays/event-specific-enquiry-overlay.php'));
}

if (is_singular('venue-dressing')) {
    include(locate_template('/partials/overlays/venue-dressing-specific-enquiry-overlay.php'));
}

if (is_page_template('my-templates/thank-you.php')) {
    include(locate_template('/partials/overlays/didnt-receive-email.php'));
}
