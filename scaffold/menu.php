<button
  class="site-header__menu-button gap-1"
  id="site-header-menu-button"
>
  <span class="icon-menu"></span>
  <span class="site-header__menu-text">Menu</span>
</button>
<div class="site-header__menu hide">
  <div class="site-header__menu-overlay"></div>
  <div class="site-header__menu-nav">
    <nav>
      <? wp_nav_menu(array('theme_location' => 'primary', 'menu_id' => 'primary-menu', 'menu_class' => 'primary-menu')); ?>
    </nav>
    <div class="site-header__menu-supporting">
      <? include(locate_template('/partials/address.php')); ?>
    </div>
  </div>
</div>
<script>
  jQuery(document).ready(($) => {
    let open = false

    $('.site-header__menu-overlay').click(() => {
      hideMenu()
    })

    $('#site-header-menu-button').click(() => {
      if (open) {
        hideMenu()
      } else {
        openMenu()
      }
    })

    function openMenu() {
      open = true
      document.body.style.overflow = 'hidden'
      document.querySelector('.site-header__menu').style.display = 'block'
    }

    function hideMenu() {
      open = false
      document.body.style.removeProperty('overflow')
      document.querySelector('.site-header__menu').style.removeProperty('display')
    }
  })
</script>