<?php
/**
 * functionality of the plugin.
 *
 * @link       @TODO
 * @since      1.0
 *
 * @package    @TODO
 * @subpackage @TODO
 * @author     Varun Sridharan <varunsridharan23@gmail.com>
 */
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Pi_WooCommerce_Quick_Buy_Auto_Add {

	/**
	 * Class Constructor
	 */
	public function __construct() {
		$this->show_on_product = $this->showOnProduct();
		$this->show_on_archive = $this->showOnArchive();
		$this->label_product = get_option('pi_dcw_buy_now_button_text','Buy Now');
		$this->label_loop = get_option('pi_dcw_buy_now_button__loop_text','Buy Now');

		$this->product_position = get_option('pi_dcw_buy_now_button_position','after_button');
		$this->loop_position = get_option('pi_dcw_buy_now_button_loop_position','after_button');

		$this->product_redirect  = get_option('pi_dcw_buy_now_button_redirect','checkout');
		$this->loop_redirect  = get_option('pi_dcw_buy_now_button_loop_redirect','checkout');

		$this->setup_single_product_quick_buy();
		$this->setup_shop_loop_quick_buy();
	}

	function showOnProduct(){
		$setting = get_option('pi_dcw_enable_buy_now_button',0);
		$return = $setting == 0 || $setting == "" ? false : true;
		return $return;
	}

	function showOnArchive(){
		$setting = get_option('pi_dcw_enable_buy_now_button_loop',0);
		$return = $setting == 0 || $setting == "" ? false : true;
		return $return;
	}

	public function setup_single_product_quick_buy() {
		$single_pos  = $this->product_position;

		if ( $this->show_on_product == true ) {
			if ( ! empty( $single_pos ) && ! $single_pos == null ) {
				$pos = '';
				if ( $single_pos == 'before_form' ) {
					$pos = 'woocommerce_before_add_to_cart_button';
				}
				if ( $single_pos == 'after_form' ) {
					$pos = 'woocommerce_after_add_to_cart_button';
				}
				if ( $single_pos == 'after_button' ) {
					$pos = 'woocommerce_after_add_to_cart_button';
				}
				if ( $single_pos == 'before_button' ) {
					$pos = 'woocommerce_before_add_to_cart_button';
				}
				add_action( $pos, array( $this, 'add_quick_buy_button' ), 99 );
			}
		}
	}

	public function setup_shop_loop_quick_buy() {
		$single_pos  = $this->loop_position;

		if ( $this->show_on_archive == true ) {
			if ( ! empty( $single_pos ) && ! $single_pos == null ) {
				$pos = 'woocommerce_after_shop_loop_item';
				$p   = 5;
				if ( $single_pos == 'after_button' ) {
					$p = 11;
				}
				if ( $single_pos == 'before_button' ) {
					$p = 9;
				}
				add_action( $pos, array( $this, 'add_shop_quick_buy_button' ), $p );
			}
		}
	}

	public function add_quick_buy_button() {
		global $product;
		$product_id = $product->get_id();
		$class = 'pisol_type_'.$product->get_type();
		if(!$this->productLevelDisable($product_id)){
			if ( $product->get_type() == 'variable'){
				echo '<input class="button pisol_single_buy_now pisol_buy_now_button '.$class.'" type="submit" name="pi_quick_checkout" value="'.$this->label_loop.'">';
			}else{
				echo '<button class="button pisol_single_buy_now pisol_buy_now_button '.$class.'" type="submit" name="add-to-cart" value="'.$product_id.'">'.$this->label_loop.'</button>
				
				';
			}
				 

		}
	}
	
	public function add_shop_quick_buy_button() {
		global $product;
		$product_id = $product->get_id();
		if ( $product->get_type() == 'simple' && !$this->productLevelDisable($product_id) ) {
			$link  = $this->get_product_addtocartLink($product, 1, $this->loop_redirect);
			if($link !== false && $product->is_in_stock()){
				echo $this->buttonHtml($link, $this->label_loop);
			}
		}
	}

	function productLevelDisable($product_id){
		$disabled = get_post_meta($product_id, 'pi_dcw_product_buy_now_disable',true);
		if($disabled == 'yes'){
			return true;
		}
		return false;
	}

	function buttonHtml($link, $label){
		return '<a class="pisol_buy_now_button" href="'.$link.'">'.$label.'</a>';
	}

	public function get_product_addtocartLink( $product, $qty = 1 , $page= 'checkout') {
		if ( $product->get_type() == 'simple' ) {
			if($page == 'checkout'){
				$checkout = wc_get_checkout_url();
			}else{
				$checkout = wc_get_cart_url();
			}
			$link = $checkout.'?add-to-cart='.$product->get_id();
			return $link;
		}
		return false;
	}

	static function get_redirect_url(){
		$loop_redirect = get_option('pi_dcw_buy_now_button_loop_redirect','checkout');
		if($loop_redirect == 'checkout'){
			$checkout = wc_get_checkout_url();
		}else{
			$checkout = wc_get_cart_url();
		}
		$link = $checkout;
		return $link;
	}

}

new Pi_WooCommerce_Quick_Buy_Auto_Add();