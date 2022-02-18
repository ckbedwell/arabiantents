<?php
  $args = array(
    'post_type' => 'testimonial',
    'order' => 'ASC',
    'posts_per_page' => 10,
  );

  $testimonialsQuery = new WP_Query($args);
  $testimonials = $testimonialsQuery->posts;
  wp_reset_query();
?>
<style>
  .testimonials-slider .slick-track {
    display: flex;
    align-items: center;
  }

  .testimonials-slider img {
    display: inline-block;
    margin: 2rem 0;
  }
</style>
<div class="testimonials text-center">
    <div class="testimonials-slider">
      <? foreach ($testimonials as $testimonial) {
        createTestimonialSlide($testimonial);
      } ?>
  </div>
</div>
<script>
  jQuery(document).ready(($) => {
    $('.testimonials-slider').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      infinite: true,
      dots: true,
    })
  })
</script>

<?php
  function createTestimonialSlide($testimonial) {
    ob_start();
?>
    <div
      class="slide"
    >
      <div class="slide-wrapper">
        <?= createBlockquote($testimonial->post_content, $testimonial->post_title); ?>
      </div>
    </div>
<?php
  $output = ob_get_clean();
  ob_flush();
  echo $output;
  }
?>