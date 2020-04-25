<?php
if (! defined('ABSPATH')){
  exit; // Exit if accessed directly
}
/* Template name: Shop Page */
$wp_query = new WP_Query(['post_type' => 'product']);
?>
<?php get_header(); ?>
  <!-- breadcrumb -->
<?php get_template_part('template-parts/bread_crumb'); ?>
  <!-- Product -->
  <div class="bg0 m-t-23">
    <div class="container p-b-140">
      <!--category - button search / filter-->
      <?php get_template_part('template-parts/category_button _search_filter'); ?>

      <div id="ajax-posts" class="row">
        <?php
        $args = array( 'post_type' => 'product',
//        'posts_per_page' => 4,
        );
        $loop = new WP_Query($args);
        while ($loop->have_posts()) : $loop->the_post(); ?>
          <?php wc_get_template_part('content', 'product'); ?>
        <?php endwhile; ?>
      </div>

      <!-- Load more -->
      <?php get_template_part('template-parts/load_more_button'); ?>
    </div>
<?php get_footer(); ?>