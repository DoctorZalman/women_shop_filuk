<?php
/* Template name: Home Page */
get_header(); ?>
  <!-- Slider -->
<?php get_template_part('template-parts/home-screen/home-slider'); ?>
  <!-- Banner -->
<?php //get_template_part( 'template-parts/category/category-banner');?>
  <!-- Product -->
<?php do_action('woocommerce_before_main_content'); ?>
  <!--category - button search / filter-->
<?php get_template_part('template-parts/category_button _search_filter'); ?>
<?php do_action('woocommerce_archive_description'); ?>
    <div id="ajax-posts" class="row">
<!--  --><?php
  $args = array( 'post_type' => 'product',
  );
  $loop = new WP_Query($args);
  while ($loop->have_posts()) : $loop->the_post(); ?>
<?php //if ( have_posts() ): while ( have_posts() ): the_post(); ?>
    <?php wc_get_template_part('content', 'product'); ?>
  <?php endwhile; ?>
    </div>
  <!-- Load more -->
<?php //get_template_part('template-parts/load_more_button'); ?>

  <div class="flex-c-m flex-w w-full p-t-45">
<!--    --><?php //$page_id = 74 ?>
<!--    <a href="--><?php //echo get_page_link( $page_id ); ?><!--" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">-->
    <a href="<?php echo home_url('/shop'); ?>" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
      Shop
    </a>
  </div>

<?php do_action('woocommerce_after_main_content'); ?>

<?php get_footer(); ?>