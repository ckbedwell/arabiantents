<!---- DIDNT RECEIVE EMAIL ------------>

<div class="didnt-receive-email hide">
  <p>There are a few possibilities that might have happened:</p>
  <ul>
    <li>The email hasn't come through yet (wait a few hours to see if it appears)</li>
    <li>You mistyped your email (this is what you provided us with: <?= $email; ?>)</li>
    <li>There was a problem somewhere along the way and we were unable to send a confirmation email to you</li>
  </ul>
  <p>You can either try resending your message or you can contact us directly by phone or email.</p>
  <? dynamic_sidebar('contact-details'); ?>
</div>
<style>
  .didnt-receive-email ul {
    list-style: none;
    padding: 0;
    margin: 0 auto;
  }
</style>
