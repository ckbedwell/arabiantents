<div class="marketing-banner">
  <div class="width-contain">
      Marketing banner
  </div>
</div>
<header class="site-header">
  <div class="width-contain">
    <div class="site-header__wrapper">
      <a href="">
        <img
          alt="Arabian Tents Logo"
          class="site-header__logo"
          src="wp-content/themes/arabiantents/images/atc-rectangle-smaller.png"
        />
      </a>
      <div class="flex gap-1">
        <a class="action-button">
          Get brochures
        </a>
        <button
          class="site-header__menu"
          id="site-header-menu"
        >
          <span class="icon-menu"></span>
          Menu
        </button>
      </div>
    </div>
  </div>
</header>

<script>
  const siteHeaderMenu = document.getElementById(`site-header-menu`)
  siteHeaderMenu.addEventListener(`click`, () => {
    console.log(`do something`)
  })
</script>
