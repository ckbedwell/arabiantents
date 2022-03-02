<div class="flex gap-1 site-header__desktop-menu">
  <nav>
    <? wp_nav_menu(array(
      'theme_location' => 'primary',
      'menu_id' => 'desktop-nav',
      'menu_class' => 'site-header__desktop-menu-nav',
      // 'walker' => new Child_Wrap()
    )); ?>
  </nav>
</div>