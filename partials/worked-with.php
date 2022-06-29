<?php
  $items = Array(
    "https://arabiantents.com/wp-content/uploads/2016/02/audi-cars-logo-emblem.jpg",
    "https://arabiantents.com/wp-content/uploads/2016/02/british-museum.png",
    "https://arabiantents.com/wp-content/uploads/2016/02/charlteston.png",
    "https://arabiantents.com/wp-content/uploads/2016/02/clinique.jpg",
    "https://arabiantents.com/wp-content/uploads/2016/02/MAC_Cosmetics_logo.png",
    "https://arabiantents.com/wp-content/uploads/2016/02/national-trust-loogo.jpg",
    "https://arabiantents.com/wp-content/uploads/2016/02/RAF.gif",
    "https://arabiantents.com/wp-content/uploads/2016/02/Vodafone-UK-APN-Settings.jpg",
    "https://arabiantents.com/wp-content/uploads/2016/02/Watts_page01.jpg",
    "https://arabiantents.com/wp-content/uploads/2016/02/vanda-1.png",
    "https://arabiantents.com/wp-content/uploads/2016/02/the-admirable-crichton.png",
    "https://arabiantents.com/wp-content/uploads/2019/03/Corporate-Logo-1.png",
    "https://arabiantents.com/wp-content/uploads/2019/03/Corporate-Logo-2.png",
    "https://arabiantents.com/wp-content/uploads/2019/03/Corporate-Logo-3.png",
    "https://arabiantents.com/wp-content/uploads/2019/03/Corporate-Logo-4.png",
  )
?>

<div class="worked-with text-center">
  <h3 class="secondary">We've worked with</h3>
    <div class="worked-with-slider">
      <? foreach ($items as $item) {
        createSlide($item);
      }?>
  </div>
</div>
<script>
  jQuery(document).ready(($) => {
    $('.worked-with-slider').slick({
      autoplay: true,
      autoplaySpeed: 2000,
      slidesToShow: 8,
      slidesToScroll: 1,
      arrows: false,
      infinite: true,
      responsive: [
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 6,
          }
        },
        {
          breakpoint: 620,
          settings: {
            slidesToShow: 4,
          }
        }
      ]
    })

    matchHeight()
    document.addEventListener('resize', matchHeight)

    function matchHeight() {
      $('.worked-with-slider .slide').each((i, item) => {
        item.style.height = `${item.offsetWidth}px`
      })
    }
  })
</script>

<?php
  function createSlide($src) {
    ob_start();
?>
    <div
      class="slide"
    >
      <div class="slide-wrapper">
        <img src="<?= $src; ?>" />
      </div>
    </div>
<?php
  $output = ob_get_clean();
  echo $output;
  }
?>