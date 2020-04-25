<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

/*Template Name: Cart*/

defined( 'ABSPATH' ) || exit;

get_header();
get_template_part('template-parts/bread_crumb');

do_action( 'woocommerce_before_cart' ); ?>

<form class="woocommerce-cart-form bg0 p-t-75 p-b-85" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
        <div class="m-l-25 m-r--38 m-lr-0-xl">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>

<!--  table head-->
          <div class="wrap-table-shopping-cart">
	<table class="table-shopping-cart" cellspacing="0">
      <tr class="table_head">

				<th class="column-2 product-thumbnail"></th>
        <th class="column-1 product-name"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
        <th class="column-2 product-thumbnail"></th>
				<th class="column-3 product-price"><?php esc_html_e( 'Price', 'woocommerce' ); ?></th>
				<th class="column-4 product-quantity"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
				<th class="column-5 product-subtotal"><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
        <th class="column-5 product-subtotal product-remove">&nbsp;</th>
			</tr>

			<?php do_action( 'woocommerce_before_cart_contents' ); ?>

			<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
          <tr class="table_row woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

<!--            thumbnail-->
						<td class="column-1 product-thumbnail">

						<?php
						$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

						if ( ! $product_permalink ) {
							echo $thumbnail; // PHPCS: XSS ok.
						} else {
							printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
						}
						?>
						</td>
<!--            product-name-->
						<td class="column-2 product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
						<?php
						if ( ! $product_permalink ) {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
						} else {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
						}

						do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

						// Meta data.
//						echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

						// Backorder notification.
						if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
						}
						?>
						</td>
<!--            // Meta data.-->
            <td class="meta"><?php echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.?></td>
<!--            product-price-->
						<td class="column-3 product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
							<?php
								echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
							?>
						</td>
<!--            product-quantity-->
						<td class="column-4 product-quantity" data-title="<?php esc_attr_e('Quantity', 'woocommerce'); ?>">
              <div class="wrap-num-product flex-w m-l-auto m-r-0">
                <?php
                if ( $_product->is_sold_individually() ) {
                  $product_quantity = sprintf( ' <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                } else {
                  $product_quantity = woocommerce_quantity_input(
                    array(
                      'input_name'   => "cart[{$cart_item_key}][qty]",
                      'input_value'  => $cart_item['quantity'],
                      'max_value'    => $_product->get_max_purchase_quantity(),
                      'min_value'    => '0',
                      'product_name' => $_product->get_name(),
                    ),
                    $_product,
                    false
                  );
                }
                echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
                ?>



<!--                <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">-->
<!--                  <i class="fs-16 zmdi zmdi-minus">--><?php //echo esc_attr( $step ); ?><!--</i>-->
<!--                </div>-->
<!---->
<!--                <input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product --><?php //echo esc_attr( $input_name ); ?><!--" value="1" placeholder="--><?php //echo esc_attr( $placeholder ); ?><!--">-->
<!---->
<!--                <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">-->
<!--                  <i class="fs-16 zmdi zmdi-plus">--><?php //echo esc_attr( $step ); ?><!--</i>-->
<!--                </div>-->
              </div>

<!--              <div class="quantity">-->
<!--                <span class="product_quantity_minus">-</span>-->
<!--                <input type="number" step="--><?php //echo esc_attr( $step ); ?><!--" --><?php //if ( is_numeric( $min_value ) ) : ?><!--min="--><?php //echo esc_attr( $min_value ); ?><!--"--><?php //endif; ?><!-- --><?php //if ( is_numeric( $max_value ) ) : ?><!--max="--><?php //echo esc_attr( $max_value ); ?><!--"--><?php //endif; ?><!-- name="--><?php //echo esc_attr( $input_name ); ?><!--" value="--><?php //echo esc_attr( $input_value ); ?><!--" title="--><?php //_ex( 'Qty', 'Product quantity input tooltip', 'woocommerce' ) ?><!--" class="mtext-104 cl3 txt-center num-product" size="4" />-->
<!--                <span class="product_quantity_plus">+</span>-->
<!--              </div>-->

						</td>
<!--            product-subtotal-->
						<td class="column-5 product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
							<?php
								echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
							?>
						</td>
            <!--            remove-->
            <td class="product-remove">
              <?php
              echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                'woocommerce_cart_item_remove_link',
                sprintf(
                  '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
                  esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                  esc_html__( 'Remove this item', 'woocommerce' ),
                  esc_attr( $product_id ),
                  esc_attr( $_product->get_sku() )
                ),
                $cart_item_key
              );
              ?>
            </td>
					</tr>
					<?php
				}
			}
			?>
			<?php do_action( 'woocommerce_cart_contents' ); ?>


			<?php do_action( 'woocommerce_after_cart_contents' ); ?>
	</table>
	<?php do_action( 'woocommerce_after_cart_table' ); ?>
          </div>
          <!--          coupon and update cart-->
          <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
            <div class="flex-w flex-m m-r-20 m-tb-5">
              <!--          coupon-->
              <?php if ( wc_coupons_enabled() ) { ?>

                  <input type="text" name="coupon_code" class="input-text stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" />


                <button type="submit" class="button flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>">
                    <?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>
                  </button>
                  <?php do_action( 'woocommerce_cart_coupon' ); ?>
              <?php } ?>
            </div>
            <!--          update_cart-->
            <button type="submit" class="button flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10" name="update_cart" placeholder="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>

<!--            <div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">-->
<!--              Update Cart-->
<!--            </div>-->

<!--            <button type="submit" class="button" name="update_cart" value="--><?php //esc_attr_e( 'Update cart', 'woocommerce' ); ?><!--">--><?php //esc_html_e( 'Update cart', 'woocommerce' ); ?><!--</button>-->

          </div>
        </div>
      </div>

      <?php do_action( 'woocommerce_before_cart_collaterals' ); ?>
      <div class="cart-collaterals col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
        <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm cart_totals <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">

          <?php do_action( 'woocommerce_before_cart_totals' ); ?>

          <h4 class="mtext-109 cl2 p-b-30"><?php esc_html_e( 'Cart totals', 'woocommerce' ); ?></h4>

          <table cellspacing="0" class="shop_table shop_table_responsive">


            <div class="flex-w flex-t bor12 p-b-13 cart-subtotal">
              <div class="size-208">
                <span class="stext-110 cl2"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></span>
              </div>

              <div class="size-209">
                <span class="mtext-110 cl2" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>"<?php wc_cart_totals_subtotal_html(); ?><span>
              </div>
            </div>

            <!--    якщо буде колись купон-->
            <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
              <tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                <th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
                <td data-title="<?php echo esc_attr( wc_cart_totals_coupon_label( $coupon, false ) ); ?>"><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
              </tr>
            <?php endforeach; ?>
            <!--    якщо буде колись купон кіінець-->

            <div class="flex-w flex-t bor12 p-t-15 p-b-30">
              <div class="size-208 w-full-ssm">

                <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
                  <?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>
                  <?php wc_cart_totals_shipping_html(); ?>
                  <?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>
                <?php elseif ( WC()->cart->needs_shipping() && 'yes' === get_option( 'woocommerce_enable_shipping_calc' ) ) : ?>
                <tr class="shipping">
                  <td class="stext-110 cl2"><?php esc_html_e( 'Shipping', 'woocommerce' ); ?>
                  </td>
                  <?php endif; ?>
                  <!--									Shipping:-->
              </div>
              <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                <p class="stext-111 cl6 p-t-2">
                  There are no shipping methods available. Please double check your address, or contact us if you need any help.
                </p>
                <!--								Calculate Shipping-->
                <div class="p-t-15">

                  <span class="stext-112 cl8" data-title="<?php esc_attr_e( 'Shipping', 'woocommerce' ); ?>"><?php woocommerce_shipping_calculator(); ?></span>
                  </tr>
                  <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                    <select class="js-select2" name="time">
                      <option>Select a country...</option>
                      <option>USA</option>
                      <option>UK</option>
                    </select>
                    <div class="dropDownSelect2"></div>
                  </div>
                  <div class="bor8 bg0 m-b-12">
                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="state" placeholder="State /  country">
                  </div>
                  <div class="bor8 bg0 m-b-22">
                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="postcode" placeholder="Postcode / Zip">
                  </div>


                  <!--free ship-->
                  <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
                    <tr class="fee">
                      <th><?php echo esc_html( $fee->name ); ?></th>
                      <td data-title="<?php echo esc_attr( $fee->name ); ?>"><?php wc_cart_totals_fee_html( $fee ); ?></td>
                    </tr>
                  <?php endforeach; ?>
                  <!--tax ship-->
                  <?php
                  if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) {
                    $taxable_address = WC()->customer->get_taxable_address();
                    $estimated_text  = '';

                    if ( WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping() ) {
                      /* translators: %s location. */
                      $estimated_text = sprintf( ' <small>' . esc_html__( '(estimated for %s)', 'woocommerce' ) . '</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] );
                    }

                    if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) {
                      foreach ( WC()->cart->get_tax_totals() as $code => $tax ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
                        ?>
                        <tr class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                          <th><?php echo esc_html( $tax->label ) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></th>
                          <td data-title="<?php echo esc_attr( $tax->label ); ?>"><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
                        </tr>
                        <?php
                      }
                    } else {
                      ?>
                      <tr class="tax-total">
                        <th><?php echo esc_html( WC()->countries->tax_or_vat() ) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></th>
                        <td data-title="<?php echo esc_attr( WC()->countries->tax_or_vat() ); ?>"><?php wc_cart_totals_taxes_total_html(); ?></td>
                      </tr>
                      <?php
                    }
                  }
                  ?>

                  <?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

                  <!--									Update Totals-->
                  <div class="flex-w">
                    <div class="flex-c-m stext-101 cl2 size-115 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer order-total">
                      <?php esc_html_e( 'Update Totals', 'woocommerce' ); ?>
                      <td data-title="<?php esc_attr_e( 'Total', 'woocommerce' ); ?>"><?php wc_cart_totals_order_total_html(); ?></td>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>
            <div class="flex-w flex-t p-t-27 p-b-33">
              <div class="size-208">
                <span class="mtext-101 cl2"><?php esc_html_e( 'Total', 'woocommerce' ); ?></span>
              </div>

              <div class="size-209 p-t-1">
                <span class="mtext-110 cl2"><?php wc_cart_totals_order_total_html(); ?></span>
              </div>
            </div>

            <div class="wc-proceed-to-checkout">
            </div>
            <button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
              <?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
            </button>
          </table>
          <?php do_action( 'woocommerce_after_cart_totals' ); ?>
        </div>
      </div>
      <?php do_action( 'woocommerce_after_cart' ); ?>
    </div>
  </div>
</form>

<?php get_footer(); ?>


