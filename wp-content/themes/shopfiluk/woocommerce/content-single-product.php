<?php
if (! defined('ABSPATH')){
  exit; // Exit if accessed directly
}
global $product;
$post_thumbnail_id = $product->get_image_id();
$attachment_ids = $product->get_gallery_attachment_ids();
global $post;
$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );
$heading_desc = apply_filters( 'woocommerce_product_description_heading', __( 'Description', 'woocommerce' ) );
$heading = apply_filters( 'woocommerce_product_additional_information_heading', __( 'Additional information', 'woocommerce' ) );

$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );
//$attribute_keys  = array_keys( $attributes );
?>

<div class="container">
  <div class="row">
    <div class="col-md-6 col-lg-7 p-b-30">
      <div class="p-l-25 p-r-30 p-lr-0-lg">
        <div class="wrap-slick3 flex-sb flex-w">
          <div class="wrap-slick3-dots"></div>
          <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>
<!--            --><?php //do_action('woocommerce_before_single_product_summary'); ?>

          <div class="slick3 gallery-lb">
              <div class="item-slick3" data-thumb="<?php echo wp_get_attachment_image_src( $post_thumbnail_id, 'large' )[0]; ?>">
                <div class="wrap-pic-w pos-relative">
                  <img src="<?php echo wp_get_attachment_image_src( $post_thumbnail_id, 'large' )[0]; ?>" alt="IMG-PRODUCT0">
                  <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="<?php echo wp_get_attachment_image_src( $post_thumbnail_id, 'large' )[0]; ?>">
                    <i class="fa fa-expand"></i>
                  </a>
                </div>
              </div>
          <?php foreach( $attachment_ids as $attachment_id ) :?>
            <div class="item-slick3" data-thumb="<?php echo wp_get_attachment_image_src( $attachment_id, 'large' )[0]; ?>">
              <div class="wrap-pic-w pos-relative">
                <img src="<?php echo wp_get_attachment_image_src( $attachment_id, 'full' )[0]; ?>" alt="IMG-PRODUCT">
                <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="<?php echo wp_get_attachment_image_src( $attachment_id, 'large' )[0]; ?>">
                  <i class="fa fa-expand"></i>
                </a>
              </div>
            </div>
            <?endforeach;?>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-5 p-b-30">
      <div class="p-r-50 p-t-5 p-lr-0-lg">
        <h4 class="mtext-105 cl2 js-name-detail p-b-14"><?php the_title();?></h4>
        <span class="mtext-106 cl2"><?php echo $product->get_price_html(); ?></span>
        <p class="stext-102 cl3 p-t-23"><?php echo $short_description; // WPCS: XSS ok. ?></p>
        <!-- Size-->
        <div class="p-t-33">
          <?php woocommerce_template_single_add_to_cart();?>
          <div class="flex-w flex-r-m p-b-10">

            <div class="size-203 flex-c-m respon6">
              Size
            </div>
            <div class="size-204 respon6-next">
              <div class="rs1-select2 bor8 bg0">
                <select class="js-select2" name="time">
                  <option>Choose an option</option>
                  <option>Size S</option>
                  <option>Size M</option>
                  <option>Size L</option>
                  <option>Size XL</option>
                </select>
                <div class="dropDownSelect2"></div>
              </div>
            </div>
          </div>
        </div>

          <div class="flex-w flex-r-m p-b-10">
            <div class="size-204 flex-w flex-m respon6-next">

            </div>
          </div>
        </div>
        <!-- social-->
        <div class="flex-w flex-m p-l-100 p-t-40 respon7">
<!--            --><?php //wp_nav_menu([
//              'theme_location'  => 'social_icon',
//              'container'       => null,
//              'items_wrap'      => '%3$s'
//            ]);?>

            <a href="<?php echo home_url('/wishlist'); ?>" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100" data-tooltip="Add to Wishlist">
              <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>

<!--              <i class="zmdi zmdi-favorite"></i>-->
            </a>

<!--          <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">-->
<!--            <i class="fa fa-facebook"></i>-->
<!--          </a>-->
<!---->
<!--          <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">-->
<!--            <i class="fa fa-twitter"></i>-->
<!--          </a>-->
<!---->
<!--          <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus">-->
<!--            <i class="fa fa-google-plus"></i>-->
<!--          </a>-->
        </div>
      </div>
    </div>
  </div>

  <!-- Tab`s -->
  <div class="bor10 m-t-50 p-t-43 p-b-40">
    <!-- Tab01 -->
    <div class="tab01">
      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item p-b-10">
          <a class="nav-link active" data-toggle="tab" href="#description" role="tab"><?php echo esc_html( $heading_desc ); ?></a>
        </li>

        <li class="nav-item p-b-10">
          <a class="nav-link" data-toggle="tab" href="#information" role="tab"><?php echo esc_html( $heading ); ?></a>
        </li>


        <li class="nav-item p-b-10">
          <a class="nav-link" data-toggle="tab" href="#reviews" role="tab"><?php echo get_field('reviews_single_product', 'options');?></a>
        </li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content p-t-43">
        <!-- descript_full -->
        <div class="tab-pane fade show active" id="description" role="tabpanel">
          <div class="how-pos2 p-lr-15-md">
            <p class="stext-102 cl6">
              <?php the_content(); ?>
            </p>
          </div>
        </div>

        <!-- - Additional information-->
        <div class="tab-pane fade" id="information" role="tabpanel">
          <div class="row">
            <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
              <ul class="p-lr-28 p-lr-15-sm">

                <li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">
                        <?php $product->list_attributes();?>
<!--												--><?php //echo get_field('materials_single_product')?>
											</span>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Reviews (1)- -->
        <div class="tab-pane fade" id="reviews" role="tabpanel">
          <div class="row">
            <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
              <div class="p-b-30 m-lr-15-sm">


             <?php  $comments = get_comments(['post_id' => get_the_ID()]); ?>
                  <?php wp_list_comments($args, $comments);
                  comment_form([
                    'comment_field' => '<div class="col-12 p-b-5 stext-102 cl3"><p><sup>*</sup>Comment<br>
				<textarea id="comment" name="comment" class="form-control size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10"></textarea>
			</p></div>' . '<div class="comment-form-rating">
			<label for="rating">' . esc_html__( 'Your rating', 'woocommerce' ) .'</label>
			<select name="rating" id="rating" aria-required="true" required>
						<option value="">' . esc_html__( 'Rate&hellip;', 'woocommerce' ) . '</option>
						<option value="5">' . esc_html__( 'Perfect', 'woocommerce' ) . '</option>
						<option value="4">' . esc_html__( 'Good', 'woocommerce' ) . '</option>
						<option value="3">' . esc_html__( 'Average', 'woocommerce' ) . '</option>
						<option value="2">' . esc_html__( 'Not that bad', 'woocommerce' ) . '</option>
						<option value="1">' . esc_html__( 'Very poor', 'woocommerce' ) . '</option>
					</select>
					</div>',
                    'fields' => [
                      'author' => '<div class="col-sm-6 p-b-5">
                          <p><sup>*</sup>Name<br>
											<input id="author" name="author" type="text" class="form-control size-111 bor8 stext-102 cl2 p-lr-20"/>
										</p>
										</div>',
                      'email' => '<div class="col-sm-6 p-b-5"><p><sup>*</sup>Email <br>
											<input id="email" name="email" type="email" class="form-control size-111 bor8 stext-102 cl2 p-lr-20"/>
										</p></div>'
                    ],
                    'class_submit'  => 'btn btn-primary pull-right',
                    'label_submit'  => __('Post Comment'),
                    'title_reply'   => 'Comment',
                  ]);
                  ?>

                <!-- Review -->
                <div class="flex-w flex-t p-b-68">

                  <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                    <img src="images/avatar-01.jpg" alt="AVATAR">
                  </div>

                  <div class="size-207">
                    <div class="flex-w flex-sb-m p-b-17">
													<span class="mtext-107 cl2 p-r-20">
														Ariana Grande
													</span>

                      <span class="fs-18 cl11">
														<i class="zmdi zmdi-star"></i>
														<i class="zmdi zmdi-star"></i>
														<i class="zmdi zmdi-star"></i>
														<i class="zmdi zmdi-star"></i>
														<i class="zmdi zmdi-star-half"></i>
													</span>
                    </div>

                    <p class="stext-102 cl6">
                      Quod autem in homine praestantissimum atque optimum est, id deseruit. Apud ceteros autem philosophos
                    </p>
                  </div>
                </div>

                 Add review
                <form class="w-full">
                  <h5 class="mtext-108 cl2 p-b-7">
                    Add a review
                  </h5>

                  <p class="stext-102 cl6">
                    Your email address will not be published. Required fields are marked *
                  </p>

                  <div class="flex-w flex-m p-t-50 p-b-23">
												<span class="stext-102 cl3 m-r-16">
													Your Rating
												</span>

                    <span class="wrap-rating fs-18 cl11 pointer">
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<input class="dis-none" type="number" name="rating">
												</span>
                  </div>
<!---->
                  <div class="row p-b-25">
                    <div class="col-12 p-b-5">
                      <label class="stext-102 cl3" for="review">Your review</label>
                      <textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="review" name="review"></textarea>
                    </div>

                    <div class="col-sm-6 p-b-5">
                      <label class="stext-102 cl3" for="name">Name</label>
                      <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="name" type="text" name="name">
                    </div>

                    <div class="col-sm-6 p-b-5">
                      <label class="stext-102 cl3" for="email">Email</label>
                      <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="email" type="text" name="email">
                    </div>
                  </div>
<!---->
                  <button class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
                    Submit
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!--SKU // Category // Tags-->
<div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
			<span class="stext-107 cl6 p-lr-25">
				<?php esc_html_e( 'SKU:', 'woocommerce' ); ?> <span class="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?></span>
			</span>

				      <?php echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="stext-107 cl6 p-lr-25">' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'woocommerce' ) . ' ', '</span>' ); ?>

  <?php echo wc_get_product_tag_list( $product->get_id(), ', ', '<span class="stext-107 cl6 p-lr-25">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'woocommerce' ) . ' ', '</span>' ); ?>
</div>

<!-- Related Products -->
<section class="sec-relate-product bg0 p-t-45 p-b-105">
  <div class="container">
    <div class="p-b-45">
      <h3 class="ltext-106 cl5 txt-center">
        Related Products
      </h3>
    </div>
    <!-- Slide2 -->
    <div class="wrap-slick2">
      <div class="slick2">
        <?php woocommerce_related_products( apply_filters( 'woocommerce_output_related_products_args', ['posts_per_page' => 99999] ) ); ?>
      </div>
    </div>
  </div>
</section>