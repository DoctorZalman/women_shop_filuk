<?php
if (! defined('ABSPATH')){
  exit; // Exit if accessed directly
}
/* Template name: Shop Page */
$wp_query = new WP_Query(['post_type' => 'product']);
?>
<?php get_header(); ?>
  <!-- Product -->
  <div class="bg0 m-t-23 p-b-140">
    <div class="container">
      <!--category-->
      <div class="flex-w flex-sb-m p-b-52">
        <?php get_template_part('template-parts/category/category'); ?>
        <?php get_template_part('template-parts/category/search_filter_buttons'); ?>
        <!-- Search product -->
        <?php get_template_part('template-parts/search'); ?>
        <!-- Filter -->
        <?php get_template_part('template-parts/filter'); ?>
      </div>
        <!--Product-->
      <div class="row isotope-grid">
        <?php if(have_posts()) : ?>
          <?php while($wp_query->have_posts()) : $wp_query->the_post();?>
            <?php wc_get_template_part('content', 'product-cat'); ?>
          <?php endwhile; ?>
          <!-- Block2 -->
        </div>
        <?php else: ?>
          <?php wc_get_template_part('loop/no-products-found')?>
        <?php endif; ?>
      </div>
      <!-- Load more -->
      <?php get_template_part('template-parts/load_more_button'); ?>
    </div>
<?php get_footer(); ?>