<?

/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package digicrab
 */
?>

<footer class="footer text-center">
<div class="awards-section">
  <div class="width-contain">
    <div class="flex gap-5 awards">
      <img data-src="wp-content/themes/arabiantents/images/footer/award-1.jpg">
      <a href="https://www.youtube.com/watch?v=eAq0liEcCV8" target="_blank">
        <img data-src="wp-content/themes/arabiantents/images/footer/award-2.png">
      </a>
      <img src="wp-content/themes/arabiantents/images/footer/award-3.png">
      <img src="wp-content/themes/arabiantents/images/footer/award-4.png">
    </div>
  </div>
</div>
  <div class="width-contain-600">
    <div class="flex-column flex-center-align gap-3">
      <div class="hoh-image">
        <?= createImage("wp-content/themes/arabiantents/images/House-of-Hud-300x300.png", "house of hud"); ?>
      </div>
      <div>We are a passionate, award-winning and inter-disciplinary team focused on making your next event a huge success.</div>

      <? include(locate_template('/partials/address.php')); ?>

      <nav class="footer-nav" role="navigation">
        <? wp_nav_menu(array('theme_location' => 'footer', 'menu_id' => 'footer-menu', 'menu_class' => 'footer-menu')); ?>
      </nav>
      <div>Copyright © <?php echo date("Y"); ?></div>
    </div>
  </div>
</footer>

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
<? edit_post_link(__('Edit', 'digicrab'), '<span class="edit-link">', '</span>'); ?>
</body>

</html>