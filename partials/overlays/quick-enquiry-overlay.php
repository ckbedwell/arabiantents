<div class="more-info-overlay width-contain hide fade-in quick-enquiry">
  <a class="icon-cross close" title="Close Enquiry Box"><span>Close</span></a>
  <div class="alignleft wrapper">
    <div class="third intro contact-page side-info">
      <div class="wrapper">
      <? $contactPage = get_page_by_title('Contact');
              $content = $contactPage->post_content;
              echo wpautop($content);

              if (is_active_sidebar('contact-details')) {
                  dynamic_sidebar('contact-details');
                  }
            ?>
        </div>
      </div>

      <div class="two-thirds">
        <? get_template_part('/partials/enquiry-forms/quick-form'); ?>
      </div>
  </div>
</div>
