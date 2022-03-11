<div class="flex gap-1 site-header__mobile-menu">
  <a href="event-design/view-brochure/" class="action-button">
    Get brochures
  </a>
  <button class="site-header__mobile-menu-button gap-1" id="site-header-menu-button">
    <span class="icon-menu"></span>
    <span class="site-header__mobile-menu-text">Menu</span>
  </button>
  <div class="site-header__mobile-menu-content hide">
    <div class="site-header__mobile-menu-overlay"></div>
    <div class="site-header__mobile-menu-nav">
      <nav>
        <? wp_nav_menu(array('theme_location' => 'primary', 'menu_id' => 'mobile-nav', 'menu_class' => 'site-header__mobile-menu-nav-rar')); ?>
      </nav>
      <div class="site-header__mobile-menu-supporting">
        <? include(locate_template('/partials/address.php')); ?>
      </div>
    </div>
  </div>
</div>
<script>
  jQuery(document).ready(($) => {
    let open = false

    $('#mobile-nav .menu-item-has-children').each((index, element) => {
      const button = document.createElement(`button`)
      button.innerHTML = '<span class="icon-arrow-right"></span>'
      button.onclick = () => {
        if (element.classList.contains('active')) {
          element.classList.remove('active')
        } else {
          element.classList.add('active')
        }
      }

      const subMenu = element.querySelector('.sub-menu')
      subMenu.insertAdjacentElement(`beforebegin`, button)
    })

    $('.site-header__mobile-menu-overlay').click(() => {
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
      document.querySelector('.site-header__mobile-menu-content').style.display = 'block'
    }

    function hideMenu() {
      open = false
      document.body.style.removeProperty('overflow')
      document.querySelector('.site-header__mobile-menu-content').style.removeProperty('display')
    }
  })
</script>