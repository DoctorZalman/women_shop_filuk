<?php
// show admin_bar
add_filter('show_admin_bar', '__return_false');
// register scripts and styles
add_action( 'wp_enqueue_scripts', 'my_scripts_and_styles');
//register menus
add_action( 'after_setup_theme', 'register_menus');

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
  add_theme_support( 'woocommerce' );
}
// woocomerce style off
//add_filter('woocommerce_enqueue_styles','__return_empty_array');

// //register widget zones
add_action( 'widgets_init', 'widgets_header' );
add_theme_support( 'post-thumbnails' );

function add_fontawesome_kit() {
  wp_register_script( 'fa-kit', 'https://kit.fontawesome.com/bf73a98272.js', array( 'jquery' ) , '5.9.0', true ); // -- From an External URL

// Javascript - Enqueue Scripts
  wp_enqueue_script( 'fa-kit' );
}

add_action( 'wp_enqueue_scripts', 'add_fontawesome_kit', 100 );

function my_scripts_and_styles() {
  wp_enqueue_script('jquery', get_template_directory_uri().'/vendor/jquery/jquery-3.2.1.min.js', [], null, true);
  wp_enqueue_script('animsition', get_template_directory_uri().'/vendor/animsition/js/animsition.min.js', [], null, true);
  wp_enqueue_script('popper', get_template_directory_uri().'/vendor/bootstrap/js/popper.js', [], null, true);
  wp_enqueue_script('bootstrap', get_template_directory_uri().'/vendor/bootstrap/js/bootstrap.min.js', [], null, true);
  wp_enqueue_script('select2', get_template_directory_uri().'/vendor/select2/select2.min.js', [], null, true);
  wp_enqueue_script('moment', get_template_directory_uri().'/vendor/daterangepicker/moment.min.js', [], null, true);
  wp_enqueue_script('daterangepicker', get_template_directory_uri().'/vendor/daterangepicker/daterangepicker.js', [], null, true);
  wp_enqueue_script('slick', get_template_directory_uri().'/vendor/slick/slick.min.js', [], null, true);
  wp_enqueue_script('slick-custom', get_template_directory_uri().'/js/slick-custom.js', [], null, true);
  wp_enqueue_script('parallax100', get_template_directory_uri().'/vendor/parallax100/parallax100.js', [], null, true);
  wp_enqueue_script('magnific-popup', get_template_directory_uri().'/vendor/MagnificPopup/jquery.magnific-popup.min.js', [], null, true);
  wp_enqueue_script('isotope', get_template_directory_uri().'/vendor/isotope/isotope.pkgd.min.js', [], null, true);
  wp_enqueue_script('sweetalert', get_template_directory_uri().'/vendor/sweetalert/sweetalert.min.js', [], null, true);
  wp_enqueue_script('perfect-scrollbar', get_template_directory_uri().'/vendor/perfect-scrollbar/perfect-scrollbar.min.js', [], null, true);
  wp_enqueue_script("my-ajax-handle", get_stylesheet_directory_uri() . "/js/ajax.js", [], null, true);
  //the_ajax_script will use to print admin-ajaxurl in custom ajax.js
  wp_localize_script('my-ajax-handle', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));

  wp_enqueue_script('main', get_template_directory_uri().'/js/main.js', [], null, true);


  wp_enqueue_style('dashicons');

  wp_enqueue_style('bootstrap', get_template_directory_uri().'/vendor/bootstrap/css/bootstrap.min.css', array(), '0.1.0', 'all');
  wp_enqueue_style('font-awesome', get_template_directory_uri().'/fonts/font-awesome-4.7.0/css/font-awesome.min.css', array(), '0.1.0', 'all');
  wp_enqueue_style('material-design-iconic-font', get_template_directory_uri().'/fonts/iconic/css/material-design-iconic-font.min.css', array(), '0.1.0', 'all');
  wp_enqueue_style('icon-font.min', get_template_directory_uri().'/fonts/linearicons-v1.0.0/icon-font.min.css', array(), '0.1.0', 'all');
  wp_enqueue_style('animate', get_template_directory_uri().'/vendor/animate/animate.css', array(), '0.1.0', 'all');
  wp_enqueue_style('hamburgers', get_template_directory_uri().'/vendor/css-hamburgers/hamburgers.min.css', array(), '0.1.0', 'all');
  wp_enqueue_style('animsition', get_template_directory_uri().'/vendor/animsition/css/animsition.min.css', array(), '0.1.0', 'all');
  wp_enqueue_style('select2', get_template_directory_uri().'/vendor/select2/select2.min.css', array(), '0.1.0', 'all');
  wp_enqueue_style('daterangepicker', get_template_directory_uri().'/vendor/daterangepicker/daterangepicker.css', array(), '0.1.0', 'all');
  wp_enqueue_style('slick', get_template_directory_uri().'/vendor/slick/slick.css', array(), '0.1.0', 'all');
  wp_enqueue_style('magnific-popup', get_template_directory_uri().'/vendor/MagnificPopup/magnific-popup.css', array(), '0.1.0', 'all');
  wp_enqueue_style('perfect-scrollbar', get_template_directory_uri().'/vendor/perfect-scrollbar/perfect-scrollbar.css', array(), '0.1.0', 'all');
  wp_enqueue_style('util', get_template_directory_uri().'/css/util.css', array(), '0.1.0', 'all');
  wp_enqueue_style('main', get_template_directory_uri().'/css/main.css', array(), '0.1.0', 'all');
}

function register_menus() {
  register_nav_menus( [
    'header_menu' => 'Header menu',
    'footer_menu' => 'Footer menu',
    'social_icon' => 'Social icon',
    'wish_list'   => 'Wish list'
  ]);
}

function widgets_header() {
  register_sidebar( [
    'name'=> 'Пошук',
    'id' => 'search',
    'before_widget' => '<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search ">',
    'after_widget' => '</div>',
    'before_title' => '',
    'after_title' => '',
  ] );

  register_sidebar( [
    'name'=> 'Корзина',
    'id' => 'shopping',
    'before_widget' => '<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="2">',
    'after_widget' => '</div>',
    'before_title' => '',
    'after_title' => '',
  ] );

  register_sidebar( [
    'name'=> 'Улюблене',
    'id' => 'favorite',
    'before_widget' => '<a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti" data-notify="0">',
    'after_widget' => '</a>',
    'before_title' => '',
    'after_title' => '',
  ] );

}
// registr widgets footer
add_action( 'widgets_init', 'widgets_footer' );

function widgets_footer() {
  register_sidebar( [
    'name'=> 'Categories-Footer',
    'id' => 'sidebar-1',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h4 class="stext-301 cl0 p-b-30">',
    'after_title' => '</h4>',
  ] );

  register_sidebar( [
    'name'=> 'Help-footer',
    'id' => 'sidebar-2',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h4 class="stext-301 cl0 p-b-30">',
    'after_title' => '</h4>'
  ] );
//
  register_sidebar( [
    'name'=> 'Address',
    'id' => 'sidebar-3',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h4 class="stext-301 cl0 p-b-30">',
    'after_title' => '</h4>'
  ] );

  register_sidebar( [
    'name'=> 'Newsletter',
    'id' => 'sidebar-4',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h4 class="stext-301 cl0 p-b-30">',
    'after_title' => '</h4>'
  ] );
}

//-для изображения товара на странице каталога

add_filter('woocommerce_get_image_size_thumbnail','add_thumbnail_size', 1);
function add_thumbnail_size($size){

  $size['width'] = 270;
  $size['height'] = 335;
  $size['crop']   = 0; //0 - не обрезаем, 1 - обрезка
  return $size;
}

//// - для большого изображения на странице товара
add_filter('woocommerce_get_image_size_single','add_single_size',1,10);
function add_single_size($size){

  $size['width'] = 420;
  $size['height'] = 520;
  $size['crop']   = 0;
  return $size;
}

//- для миниатюр в галерее на странице товара

add_filter('woocommerce_get_image_size_gallery_thumbnail','add_gallery_thumbnail_size',1,10);
function add_gallery_thumbnail_size($size){

  $size['width'] = 90;
  $size['height'] = 110;
  $size['crop']   = 0;
  return $size;
}

remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );


//load more

function more_post_ajax()
{
  $ppp = (isset($_POST["ppp"])) ? $_POST["ppp"] : 1;
  $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0;
  header("Content-Type: text/html");
  $args = array(
    'suppress_filters' => true,
    'post_type' => 'product',  // вроді тре змінити на product
    'posts_per_page' => $ppp,
    'paged' => $page,
  );
  $loop = new WP_Query($args);
  $out = '';
  if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post();
    $out .= wc_get_template_part('content', 'product');
  endwhile;
  endif;
  wp_reset_postdata();
  die($out);
}
add_action('wp_ajax_nopriv_more_post_ajax', 'more_post_ajax');
add_action('wp_ajax_more_post_ajax', 'more_post_ajax');
//load more end



function my_header_add_to_cart_fragment( $fragments ) {
  ob_start();
  $count = WC()->cart->cart_contents_count;
  ?><a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><?php
  if ( $count > 0 ) {
    ?>
    <span class="cart-contents-count"><?php echo esc_html( $count ); ?></span>
    <?php
  }
  ?></a><?php

  $fragments['a.cart-contents'] = ob_get_clean();

  return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'my_header_add_to_cart_fragment' );



add_action( 'widgets_init', 'cart_header' );

function cart_header() {
  register_sidebar( [
    'name'=> 'cart_header',
    'id' => 'cart_header',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<div class="header-cart-content flex-w js-pscroll">',
    'after_title' => '</div>',
  ] ); }

add_action( 'widgets_init', 'social_icon' );

function social_icon() {
  register_sidebar([
    'name'=> 'social_icon',
    'id' => 'social_icon',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<div class="flex-m bor9 p-r-10 m-r-11">',
    'after_title' => '</div>',
  ]);
}

add_action( 'widgets_init', 'filter' );

function filter() {
  register_sidebar( [
    'name'=> 'filter',
    'id' => 'filter',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '',
    'after_title' => '',
  ] );
}

if ( function_exists( 'acf_add_options_page' ) ) {

  acf_add_options_page( array(
    'menu_title' => 'Налаштування теми',
    'menu_slug'  => 'theme-general-settings',
  ) );

  acf_add_options_sub_page( array(
    'page_title'  => 'Reviews product',
    'menu_title'  => 'Reviews product',
    'parent_slug' => 'theme-general-settings',
  ) );
  acf_add_options_sub_page( array(
    'page_title'  => 'Reviews fffproduct',
    'menu_title'  => 'Reviews profffduct',
    'parent_slug' => 'theme-general-settings',
  ) );



};
//
////Hide Price Range for WooCommerce Variable Products
//add_filter( 'woocommerce_variable_sale_price_html',
//  'lw_variable_product_price', 10, 2 );
//add_filter( 'woocommerce_variable_price_html',
//  'lw_variable_product_price', 10, 2 );
//
//function lw_variable_product_price( $v_price, $v_product ) {
//
//// Product Price
//  $prod_prices = array( $v_product->get_variation_price( 'min', true ),
//    $v_product->get_variation_price( 'max', true ) );
//  $prod_price = $prod_prices[0]!==$prod_prices[1] ? sprintf(__('From: %1$s', 'woocommerce'),
//    wc_price( $prod_prices[0] ) ) : wc_price( $prod_prices[0] );
//
//// Regular Price
//  $regular_prices = array( $v_product->get_variation_regular_price( 'min', true ),
//    $v_product->get_variation_regular_price( 'max', true ) );
//  sort( $regular_prices );
//  $regular_price = $regular_prices[0]!==$regular_prices[1] ? sprintf(__('From: %1$s','woocommerce')
//    , wc_price( $regular_prices[0] ) ) : wc_price( $regular_prices[0] );
//
//  if ( $prod_price !== $regular_price ) {
//    $prod_price = '<del>'.$regular_price.$v_product->get_price_suffix() . '</del> <ins>' .
//      $prod_price . $v_product->get_price_suffix() . '</ins>';
//  }
//  return $prod_price;
//}
////Hide “From:$X”
//add_filter('woocommerce_get_price_html', 'lw_hide_variation_price', 10, 2);
//function lw_hide_variation_price( $v_price, $v_product ) {
//  $v_product_types = array( 'variable');
//  if ( in_array ( $v_product->product_type, $v_product_types ) && !(is_shop()) ) {
//    return '';
//  }
//// return regular price
//  return $v_price;
//}
