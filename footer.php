<?

/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package digicrab
 */
?>
<footer class="" role="contentinfo">
  <img data-src="wp-content/themes/arabiantents/images/british-awards.jpg">
  <a href="https://www.youtube.com/watch?v=eAq0liEcCV8" target="_blank">
    <img data-src="wp-content/uploads/2019/01/Award-Logo.png">
  </a>
  <img data-src="wp-content/themes/arabiantents/images/House-of-Hud-300x300.png">
  <img src="wp-content/themes/arabiantents/images/festival-winner.jpg">
  <img src="wp-content/themes/arabiantents/images/TWG-2019.jpg">

  <p>We are a passionate, award-winning and inter-disciplinary team focused on making your next event a huge success.</p>

  <nav class="" role="navigation">
    <? wp_nav_menu(array('theme_location' => 'footer', 'menu_id' => 'footer-menu', 'menu_class' => 'footer-menu')); ?>
  </nav>
  <? if (is_active_sidebar('contact-details') || is_active_sidebar('contact-details')) {
    dynamic_sidebar('contact-details');
  } ?>
  <h4>
    <a href="<?= esc_url(home_url('/')); ?>" rel="home">
      <? bloginfo('name'); ?>
    </a>
  </h4>
  <?
  if (is_active_sidebar('address-details')) {
    dynamic_sidebar('address-details');
  }
  ?>
  <p>Copyright © <?php echo date("Y"); ?></p>
</footer>

<? include(locate_template('/partials/overlays.php')); ?>

<script>
  (function(i, s, o, g, r, a, m) {
    i['GoogleAnalyticsObject'] = r;
    i[r] = i[r] || function() {
      (i[r].q = i[r].q || []).push(arguments)
    }, i[r].l = 1 * new Date();
    a = s.createElement(o), m = s.getElementsByTagName(o)[0];
    a.async = 1;
    a.src = g;
    m.parentNode.insertBefore(a, m)
  })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
  ga('create', 'UA-105815387-1', 'auto');
</script>
<? wp_footer(); ?>
</body>

</html>