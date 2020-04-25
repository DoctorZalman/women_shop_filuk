<?php
if (! defined('ABSPATH')){
  exit; // Exit if accessed directly
  // CART PAGE
}
do_action( 'woocommerce_before_cart' );
?>

<?php the_content();?>
