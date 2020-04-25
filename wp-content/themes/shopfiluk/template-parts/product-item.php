<!--Виводить карточку тов у рекоменд-->

<?php global $product; ?>

<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
  <!-- Block2 -->
  <div class="block2">
    <div class="block2-pic hov-img0">
      <?php the_post_thumbnail('medium'); ?>

      <a href="<?php the_permalink(); ?>" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
        Quick View
      </a>
    </div>

    <div class="block2-txt flex-w flex-t p-t-14">
      <div class="block2-txt-child1 flex-col-l ">
        <a href="<?php the_permalink(); ?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
          <?php the_title(); ?>
        </a>
        <span class="stext-105 cl3"><?php echo $product->get_price_html(); ?></span>
      </div>
      <div class="block2-txt-child2 flex-r p-t-3">
        <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
          <img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png" alt="ICON">
          <img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png" alt="ICON">
        </a>
      </div>
    </div>
  </div>
</div>
