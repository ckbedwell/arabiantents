<!---- DIDNT RECEIVE EMAIL ------------>

<div class="more-info-overlay width-contain hide fade-in contact-page didnt-receive-email">
  <a class="icon-cross close" title="Close Information Box"><span>Close</span></a>
    <h2>If you haven't received a confirmation email from us</h2>
    <p>There are a few possibilities that might have happened:</p>
    <ul>
      <li>The email hasn't come through yet (wait a few hours to see if it appears)</li>
      <li>You mistyped your email (this is what you provided us with: <?= $field_email; ?>)</li>
      <li>There was a problem somewhere along the way and we were unable to send a confirmation email to you</li>
    </ul>
    <p>You can either try resending your message or you can contact us directly by phone or email.</p>
    <? dynamic_sidebar('contact-details'); ?>
</div>
