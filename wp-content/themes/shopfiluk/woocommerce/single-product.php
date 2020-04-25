<?php
if (! defined('ABSPATH')){exit; // Exit if accessed directly
}
/* Template name: Single Product */
get_header();
global $post;
$heading = apply_filters( 'woocommerce_product_description_heading', __( 'Description', 'woocommerce' ) );
?>
<!-- breadcrumb -->
<?php get_template_part('template-parts/bread_crumb'); ?>
<!-- Product Detail -->
<section class="sec-product-detail bg0 p-t-65 p-b-60">
    <?php while(have_posts()) : the_post();?>
      <?php wc_get_template_part('content', 'single-product'); ?>
    <?php endwhile; ?>
</section>
<?php get_footer(); ?>
