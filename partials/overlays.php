<?
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
