<div class="wrap-menu-desktop">
  <nav class="limiter-menu-desktop container">

    <!-- Logo desktop -->
    <a class="logo" href="<?php echo home_url();?>">
      <img src="<?php echo get_template_directory_uri();?>./images/icons/logo-01.png" alt="IMG-LOGO">
    </a>
    <!-- Menu desktop -->
    <div class="menu-desktop">
      <ul class="main-menu">
        <?php wp_nav_menu([
          'theme_location'  => 'header_menu',
          'container'       => null,
          'items_wrap'      => '%3$s'
        ]);?>
      </ul>
      <!-- Icon header -->
      <div class="wrap-icon-header flex-w flex-r-m">
        <?php dynamic_sidebar( 'search' ); ?>
        <?php dynamic_sidebar( 'shopping' ); ?>
        <?php dynamic_sidebar( 'favorite' ); ?>
      </div>
  </nav>
</div>
</div>