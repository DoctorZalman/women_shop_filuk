<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) {

   foreach ($related_products as $product) {
    $post_object = get_post($product->get_id());
    setup_postdata($GLOBALS['post'] =& $post_object);
    get_template_part('template-parts/product-item');
  };
};
wp_reset_postdata();
