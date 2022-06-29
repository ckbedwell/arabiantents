<?php
function blockTestimonials()
{
  $content = get_sub_field('testimonials');
  $container = get_sub_field('container');
  $classes = get_sub_field('classes');
  $blockContent = createTestimonials($content);

  return blockWrapper($container, $classes, $blockContent);
}
?>

<?
function createTestimonials($testimonials)
{
  ob_start();
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
        createBlockTestimonialSlide($testimonial);
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
  $output = ob_get_clean();
  ob_flush();
  return $output;
}
?>

<?php
  function createBlockTestimonialSlide($testimonial) {
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
  echo $output;
  }
?>