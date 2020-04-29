<?php
defined( 'ABSPATH' ) || exit;
get_header();
get_template_part('template-parts/bread_crumb');
?>
<section class="bg0 p-t-23 p-b-140">
  <div class="container">
<?php if ( have_posts() ): while ( have_posts() ): the_post(); ?>
  <?php the_content(); ?>
<?php endwhile; endif;?>
  </div>
</section>
<?php get_footer(); ?>


