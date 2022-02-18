<div class="address">
  <h4 class="address__title secondary">
    <a href="<?= esc_url(home_url('/')); ?>" rel="home">
      <? bloginfo('name'); ?>
    </a>
  </h4>
  <?
  if (is_active_sidebar('address-details')) {
    dynamic_sidebar('address-details');
  }
  ?>
  <? if (is_active_sidebar('contact-details')) { dynamic_sidebar('contact-details'); } ?>
</div>
