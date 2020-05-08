<?php

if ( ! function_exists( 'yith_wcqv_get_custom_style' ) ) {
	/**
	 * Get custom style from plugin options panel
	 *
	 * @since  1.2.0
	 * @author Francesco Licandro
	 * @return string
	 */
	function yith_wcqv_get_custom_style() {
		$content_w                = get_option( 'yith-quick-view-modal-width', '1000' );
		$image_w                  = get_option( 'yith-quick-view-product-image-width', '500' );
		$background_modal         = get_option( 'yith-wcqv-background-modal', '#ffffff' );
		$button_text_color        = get_option( 'yith-wcqv-button-quick-view-text-color', '#ffffff' );
		$button_text_color_hover  = get_option( 'yith-wcqv-button-quick-view-text-color-hover', '#ababab' );
		$button_color             = get_option( 'yith-wcqv-button-quick-view-color', '#222222' );
		$button_color_hover       = get_option( 'yith-wcqv-button-quick-view-color-hover', '#ababab' );
		$main_text_color          = get_option( 'yith-wcqv-main-text-color', '#222222' );
		$star_color               = get_option( 'yith-wcqv-star-color', '#f7c104' );
		$cart_color               = get_option( 'yith-wcqv-button-cart-color', '#a46497' );
		$cart_color_hover         = get_option( 'yith-wcqv-button-cart-color-hover', '#935386' );
		$cart_text_color          = get_option( 'yith-wcqv-button-cart-text-color', '#ffffff' );
		$cart_text_color_hover    = get_option( 'yith-wcqv-button-cart-text-color-hover', '#ffffff' );
		$details_color            = get_option( 'yith-wcqv-button-details-color', '#ebe9eb' );
		$details_color_hover      = get_option( 'yith-wcqv-button-details-color-hover', '#dad8da' );
		$details_text_color       = get_option( 'yith-wcqv-button-details-text-color', '#515151' );
		$details_text_color_hover = get_option( 'yith-wcqv-button-details-text-color-hover', '#515151' );

		$image_w   = ( 100 * $image_w ) / $content_w;
		$summary_w = 100 - $image_w;

		$inline_css = ".yith-quick-view.yith-modal .yith-wcqv-main{background:{$background_modal};}
			.yith-wcqv-button.inside-thumb span, .yith-wcqv-button.button{color:{$button_text_color} !important;background:{$button_color} !important;}
			.yith-wcqv-button.inside-thumb:hover span, .yith-wcqv-button.button:hover{color:{$button_text_color_hover} !important;background:{$button_color_hover} !important;}
			.yith-quick-view-content.woocommerce div.summary h1,.yith-quick-view-content.woocommerce div.summary div[itemprop=\"description\"],.yith-quick-view-content.woocommerce div.summary .product_meta,.yith-quick-view-content.woocommerce div.summary .price,.yith-quick-view-content.woocommerce div.summary .price ins {color: {$main_text_color};}
			.yith-quick-view-content.woocommerce div.summary .woocommerce-product-rating .star-rating,.yith-quick-view-content.woocommerce div.summary .woocommerce-product-rating .star-rating:before {color: {$star_color};}
			.yith-quick-view-content.woocommerce div.summary button.button.alt{background: {$cart_color};color: {$cart_text_color};}
			.yith-quick-view-content.woocommerce div.summary button.button.alt:hover{background: {$cart_color_hover};color: {$cart_text_color_hover};}
			.yith-quick-view-content.woocommerce div.summary .yith-wcqv-view-details{background: {$details_color}!important;color: {$details_text_color};!important}
			.yith-quick-view-content.woocommerce div.summary .yith-wcqv-view-details:hover{background: {$details_color_hover}!important;color: {$details_text_color_hover};!important}
			@media (min-width: 481px){.yith-quick-view.yith-modal .yith-quick-view-content div.images{width:{$image_w}% !important;}
			.yith-quick-view.yith-modal .yith-quick-view-content div.summary{width:{$summary_w}% !important;}}";

		return $inline_css;
	}
}