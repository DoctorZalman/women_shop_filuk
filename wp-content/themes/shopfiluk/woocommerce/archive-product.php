<?php
/* Template name: Archive */
get_header(); ?>
  <!-- Slider -->
<?php get_template_part('template-parts/home-screen/home-slider'); ?>
  <!-- Banner -->
<?php //get_template_part( 'template-parts/category/category-banner');?>

  <!-- Product -->
<?php do_action('woocommerce_before_main_content'); ?>
<?php get_template_part('template-parts/page_title_product_overview'); ?>
  <!--category-->
  <div class="flex-w flex-sb-m p-b-52">
    <?php get_template_part('template-parts/category/category'); ?>

    <?php get_template_part('template-parts/category/search_filter_buttons'); ?>

    <!-- Search product -->
    <?php get_template_part('template-parts/search'); ?>

    <!-- Filter -->
    <?php get_template_part('template-parts/filter'); ?>
  </div>

<?php do_action('woocommerce_archive_description'); ?>
<?php
$ards = array(
  'post_type' => 'product',
  'post_per_page' => 8
  //    'meta_key' => '_featured',
  //    'meta_value' => 'yes'
);
global $wp_query;
$wp_query = new WP_Query($ards);
//print_r($wp_query);

if ($wp_query->have_posts()) : ?>
  <?php woocommerce_product_loop_start(); ?>
  <!--пишемо цикл для виовду поста-->

  <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
    <?php wc_get_template_part('content', 'product'); ?>
  <?php endwhile; ?>

  <?php woocommerce_product_loop_end(); ?>
<?php endif; ?>
  <!-- Load more -->
<?php get_template_part('template-parts/load_more_button'); ?>

<?php do_action('woocommerce_after_main_content'); ?>

<?php get_footer(); ?>