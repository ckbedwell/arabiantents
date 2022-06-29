<?php
function createMarketingSlide($message)
{
  ob_start();
?>
  <div class="slide">
    <?= $message; ?>
  </div>
<?php
  $output = ob_get_clean();
  ob_flush();
  echo $output;
}

if (have_rows('marketing_banner', 'option')) : ?>
  <div class="marketing-banner">
    <div class="width-contain">
      <div class="marketing-banner-slider">
        <? while (have_rows('marketing_banner', 'option')) : {
            the_row();
            createMarketingSlide(get_sub_field('banner'));
          }
        endwhile; ?>
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
<?php endif; ?>