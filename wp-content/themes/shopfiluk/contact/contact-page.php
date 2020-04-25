<?php
/* Template name: Contact */
get_header(); ?>

<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92 title_bottom" style="background-image: url(<?php echo get_field('contact_main_img')?>);">
  <h2 class="ltext-105 cl0 txt-center"><?php wp_title(''); ?></h2>
</section>


<!-- Content page -->
<section class="bg0 p-t-104 p-b-116">
  <div class="container">
    <div class="flex-w flex-tr">
      <?php get_template_part('contact/contact-form'); ?>
      <?php get_template_part('contact/contact-address'); ?>
    </div>
  </div>
</section>


<!-- Map -->
<!--<div class="map">-->
<!--  <div class="size-303" id="google_map" data-map-x="40.691446" data-map-y="-73.886787" data-pin="images/icons/pin.png" data-scrollwhell="0" data-draggable="1" data-zoom="11"></div>-->
<!--</div>-->

<?php get_footer(); ?>