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
<!--        --><?php //dynamic_sidebar( 'shopping' ); ?>
<!--        --><?php //dynamic_sidebar( 'favorite' ); ?>


        <?php wp_nav_menu([
          'theme_location'  => 'wish_list',
          'container'       => null,
          'items_wrap'      => '%3$s'
        ]);?>
        <span class="wishlist_products_counter top_wishlist-heart top_wishlist- no-txt" ></span>  <span class="wishlist_products_counter_number"></span>



<!--        --><?php //add_shortcode('[ti_wishlists_addtowishlist]'); ?>
        <!--        --><?php //if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
        //
        //          $count = WC()->cart->cart_contents_count;
        //          ?><!--<a class="cart-contents" href="--><?php //echo WC()->cart->get_cart_url(); ?><!--" title="--><?php //_e( 'View your shopping cart' ); ?><!--">--><?php
        //          if ( $count > 0 ) {
        //            ?>
        <!--            <span class="cart-contents-count">--><?php //echo esc_html( $count ); ?><!--</span>-->
        <!--            --><?php
        //          }
        //          ?><!--</a>-->
        <!---->
        <!--        --><?php //} ?>

        <div class="top-cart">
          <?php global $woocommerce; ?>
          <ul>
            <li>
              <a href="<?php echo $woocommerce->cart->get_cart_url() ?>">
                <span class="cart-icon"><i class="fa fa-shopping-cart"></i></span>
                <span class="cart-total">
                    <span class="cart-title">Cart (<?php echo $woocommerce->cart->cart_contents_count ?>)</span>
<!--                    <span class="cart-item">--><?php //echo $woocommerce->cart->cart_contents_count ?><!--</span>-->
                    <span class="top-cart-price"><?php echo $woocommerce->cart->get_cart_total()?></span>
                  </span>
              </a>
            </li>
          </ul>
        </div>


      </div>
  </nav>
</div>
</div>