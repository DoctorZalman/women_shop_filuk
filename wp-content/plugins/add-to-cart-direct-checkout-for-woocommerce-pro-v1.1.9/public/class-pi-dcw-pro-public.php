<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       piwebsolution.com
 * @since      1.0.0
 *
 * @package    Pi_Dcw_Pro
 * @subpackage Pi_Dcw_Pro/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Pi_Dcw_Pro
 * @subpackage Pi_Dcw_Pro/public
 * @author     PI Websolution <sales@piwebsolution.com>
 */
class Pi_Dcw_Pro_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	public $continue_shopping;
	public $global_redirect;
	public $ajax_support;
	public $redirect_page;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		$this->continue_shopping = get_option('pi_dcw_global_disable_continue_shopping_btn',0);
		$this->global_redirect = get_option('pi_dcw_global_redirect',1);
		$this->ajax_support = get_option('pi_dcw_global_ajax_support',1);
		$this->redirect_page = get_option('pi_dcw_global_redirect_to_page',0);

		$this->redirect_custom_url = get_option('pi_dcw_global_redirect_custom_url',0);
		$this->custom_url = get_option('pi_dcw_global_custom_url',"");

		add_filter( 'woocommerce_loop_add_to_cart_link', array($this,'filter_woocommerce_loop_add_to_cart_link'), 10, 2 );	
		add_filter( 'pi_disable_redirect_for_this_product', array($this,'pi_disable_redirect_for_this_product'), 10, 2 );	
		add_filter( 'pi_dcw_product_overwrite_global', array($this,'pi_dcw_product_overwrite_global'), 10, 2 );	
		add_filter( 'pi_dcw_product_redirect_to_page', array($this,'pi_dcw_product_redirect_to_page'), 10, 2 );
		
		add_filter( 'woocommerce_checkout_fields' , array($this,'removeFields') );

		add_filter( 'woocommerce_coupons_enabled', array($this,'removeCoupon') );
	}

	function filter_woocommerce_loop_add_to_cart_link( $link, $product ) { 
		$disable_redirect_for_this_product = get_post_meta($product->get_id(),'pi_dcw_product_redirect',true); 
		$overwrite_global = get_post_meta($product->get_id(),'pi_dcw_product_overwrite_global',true); 
		$product_redirect_to_page = get_post_meta($product->get_id(),'pi_dcw_product_redirect_to_page',true); 
		
		if($disable_redirect_for_this_product != "yes"){
			$global_redirect = $this->global_redirect;
			if($global_redirect == 1){
				$redirect_to = (int)get_option('pi_dcw_global_redirect_to_page',0);
				if($this->redirect_custom_url == 0){
					if($redirect_to == 0 || $redirect_to == ""){
						$url = wc_get_checkout_url();
					}else{
						$url = get_permalink($redirect_to);
					}
				}else{
					if($this->custom_url == ""){
						$url = wc_get_checkout_url();
					}else{
						$url = $this->custom_url;
					}
				}

				$link = str_replace("<a","<a data-redirect='".esc_url($url)."' ", $link);
			}

			if($overwrite_global == 'yes'){
				if($product_redirect_to_page == ""){
					$url = wc_get_checkout_url();
				}else{
					$url = ($product_redirect_to_page);
				}

				$link = str_replace("<a","<a data-redirect='".esc_url($url)."' ", $link);
			}
		}

		return $link; 
	}

	function pi_disable_redirect_for_this_product($string, $product_id){
		$disable_redirect_for_this_product = get_post_meta($product_id,'pi_dcw_product_redirect',true); 
		return $disable_redirect_for_this_product;
	}

	function pi_dcw_product_overwrite_global($string, $product_id){
		$overwrite_global = get_post_meta($product_id,'pi_dcw_product_overwrite_global',true); 
		return $overwrite_global;
	}

	function pi_dcw_product_redirect_to_page($string, $product_id){
		$product_redirect_to_page = get_post_meta($product_id,'pi_dcw_product_redirect_to_page',true); 
		return $product_redirect_to_page;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Pi_Dcw_Pro_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Pi_Dcw_Pro_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/pi-dcw-pro-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Pi_Dcw_Pro_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Pi_Dcw_Pro_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/pi-dcw-pro-public.js', array( 'jquery' ), $this->version, false );
		$script = '
		jQuery(document).ready(function(){
			jQuery( "body" ).on( "added_to_cart", function( e, fragments, cart_hash, this_button ) 
				{ 
					var redirect = (this_button.data("redirect"));
					if((redirect) != undefined){
					 window.location = redirect;
					}
				} 
			);
		});
		';
		wp_add_inline_script( "jquery", $script, 'after' );
	}	

	function removeFields($fields){
		$remove_order_comment = get_option('pi_dcw_remove_order_comment',0);

		if($remove_order_comment == 1){
			unset($fields['order']['order_comments']);
		}

		
		return $fields;
	}

	function removeCoupon( $enabled ) {
		$remove_have_coupon = get_option('pi_dcw_remove_have_coupon',0);

		if ( is_checkout() && $remove_have_coupon == 1 ) {
			$enabled = false;
		}
		return $enabled;
	}
}
