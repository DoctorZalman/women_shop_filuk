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
add_filter('woocommerce_enqueue_styles','__return_empty_array');

// //register widget zones
add_action( 'widgets_init', 'widgets_header' );
add_theme_support( 'post-thumbnails' );





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
  wp_enqueue_script('main', get_template_directory_uri().'/js/main.js', [], null, true);


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
    'footer_menu' => 'Footer menu'
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

add_filter('woocommerce_get_image_size_thumbnail','add_thumbnail_size',1,10);
function add_thumbnail_size($size){

  $size['width'] = 270;
  $size['height'] = 335;
  $size['crop']   = 1; //0 - не обрезаем, 1 - обрезка
  return $size;
}
//- для большого изображения на странице товара
add_filter('woocommerce_get_image_size_single','add_single_size',1,10);
function add_single_size($size){

  $size['width'] = 1200;
  $size['height'] = 1485;
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

//function woocommerce_template_loop_product_thumbnail() {
//  echo woocommerce_get_product_thumbnail();
//}

// guttn custom block
/**
 * Register Blocks
 *
 */


//function be_register_blocks() {
//  if( ! function_exists('acf_register_block') )
//    return;
//  acf_register_block( array(
//    'name'			=> 'about-text-1',
//    'title'			=> __( 'about-text-1', 'text-1' ),
//    'render_template'	=> 'template-parts/about/text-1.php',
//    'category'		=> 'formatting',
//    'icon'			=> 'admin-users',
//    'mode'			=> 'preview',
//    'keywords'		=> array( 'profile', 'user', 'author' )
//  ));
//
//  acf_register_block( array(
//    'name'			=> 'about-text-2',
//    'title'			=> __( 'about-text-2', 'text-2' ),
//    'render_template'	=> 'template-parts/about/text-2.php',
//    'category'		=> 'formatting',
//    'icon'			=> 'admin-users',
//    'mode'			=> 'preview',
//    'keywords'		=> array( 'profile', 'user', 'author' )
//  ));
//}
//add_action('acf/init', 'be_register_blocks' );
//
