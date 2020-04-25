<?php
if (! defined('ABSPATH')){
  exit; // Exit if accessed directly
}
global $product; // об'являємо глобальну змінну "продукт" - отримуємо змінну, яку ми отримали на поточній ітерації циклу
$price_html = $product->get_price_html();
?>
<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
  <div class="block2">
    <div class="block2-pic hov-img0">
      <?php echo woocommerce_get_product_thumbnail();?>
      <a href="'.<?php echo get_the_permalink();?>.'" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">Quick View</a>
    </div>
    <div class="block2-txt flex-w flex-t p-t-14">
      <div class="block2-txt-child1 flex-col-l ">
        <a href="<?php echo get_the_permalink();?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6"><?php echo get_the_title()?></a>
        <span class="stext-105 cl3">
          <?php echo $price_html?>
        </span>
      </div>
      <div class="block2-txt-child2 flex-r p-t-3">
<!--        --><?php //add_shortcode('[ti_wishlists_addtowishlist]'); ?>
        <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
          <img class="icon-heart1 dis-block trans-04"
               src="<?php echo get_template_directory_uri(); ?>./images/icons/icon-heart-01.png" alt="ICON">
          <img class="icon-heart2 dis-block trans-04 ab-t-l"
               src="<?php echo get_template_directory_uri(); ?>./images/icons/icon-heart-02.png" alt="ICON">
        </a>
      </div>
    </div>
  </div>
</div>


