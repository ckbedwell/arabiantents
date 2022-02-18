<?php
  $messages = Array(
    array(
      'message' => 'Add any marketing messages you like, such as',
      'href' => 'some-link',
    ),
    array(
      'message' => 'We have a showroom event on the 19th February',
      'href' => 'some-link',
    ),
    array(
      'message' => 'Sign up to our newsletter for our best tips for your event',
      'href' => 'some-link',
    ),
  )
?>

<div class="marketing-banner">
  <div class="width-contain">
    <div class="marketing-banner-slider">
    <? foreach ($messages as $message) {
        createMarketingSlide($message);
      }?>
    </div>
  </div>
</div>
<script>
jQuery(document).ready(($) => {
    $('.marketing-banner-slider').slick({
      autoplay: true,
      autoplaySpeed: 2000,
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      infinite: true,
    })
  })
</script>

<?php
  function createMarketingSlide($props) {
    $message = $props['message'];
    $href = $props['href'];
    ob_start();
?>
    <div
      class="slide"
    >
      <a href="<?= $href; ?>" class="slide-wrapper">
        <?= $message; ?>
      </a>
    </div>
<?php
  $output = ob_get_clean();
  ob_flush();
  echo $output;
  }
?>