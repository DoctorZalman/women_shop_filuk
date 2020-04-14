<?php
/**
 * Displayed when no products are found matching the current query
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/no-products-found.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 2.0.0
 */
defined( 'ABSPATH' ) || exit;
global $product;
$price_html = $product->get_price_html();
if($price_html && !is_shop()) :
?>

  <span class="stext-105 cl3"> <?php echo $price_html?>
<!--        --><?php //do_action('woocommerce_after_shop_loop_item'); ?>
      </span>
<?php endif;?>
