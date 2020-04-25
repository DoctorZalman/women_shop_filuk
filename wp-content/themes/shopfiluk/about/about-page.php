<?php
/* Template name: About */
get_header(); ?>

<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92 title_bottom" style="background-image: url(<?php echo get_field('about-img')?>);">
  <h2 class="ltext-105 cl0 txt-center"><?php wp_title(''); ?></h2>
</section>


<!-- Content page -->
<section class="bg0 p-t-75 p-b-120">
  <div class="container">
    <?php get_template_part('about/text-1'); ?>
    <?php get_template_part('about/text-2'); ?>
  </div>
</section>

<?php get_footer(); ?>


