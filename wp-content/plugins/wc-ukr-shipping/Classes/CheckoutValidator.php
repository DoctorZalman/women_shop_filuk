<?php

namespace kirillbdev\WCUkrShipping\Classes;

if ( ! defined('ABSPATH')) {
  exit;
}

class CheckoutValidator
{
  public function __construct()
  {
    add_action('woocommerce_checkout_process', [ $this, 'validateFields' ]);
    add_filter('woocommerce_checkout_fields', [ $this, 'removeDefaultFieldsFromValidation' ]);
    add_filter('woocommerce_checkout_posted_data', [ $this, 'processCheckoutPostedData' ]);
  }

  public function removeDefaultFieldsFromValidation($fields)
  {
    if ($this->maybeDisableDefaultFields()) {
      unset($fields['billing']['billing_address_1']);
      unset($fields['billing']['billing_address_2']);
      unset($fields['billing']['billing_city']);
      unset($fields['billing']['billing_state']);
      unset($fields['billing']['billing_postcode']);
    }

    return $fields;
  }

  public function validateFields()
  {
    if (isset($_POST['shipping_method'])) {
      if (preg_match('/^' . WC_UKR_SHIPPING_NP_SHIPPING_NAME . '.*/i', $_POST['shipping_method'][0])) {
        if ($this->maybeCustomAddressActive()) {
          $this->validateAddressShipping();
        }
        else {
          $this->validateWarehouseShipping();
        }
      }
    }
  }

  public function processCheckoutPostedData($data)
  {
	  if (isset($data['shipping_method'])) {
		  if (
		  	preg_match('/^' . WC_UKR_SHIPPING_NP_SHIPPING_NAME . '.*/i', $data['shipping_method'][0]) &&
			  isset($data['ship_to_different_address'])
		  ) {
		  	unset($data['ship_to_different_address']);
		  	unset($data['shipping_first_name']);
			  unset($data['shipping_last_name']);
			  unset($data['shipping_company']);
			  unset($data['shipping_country']);
			  unset($data['shipping_address_1']);
			  unset($data['shipping_address_2']);
			  unset($data['shipping_city']);
			  unset($data['shipping_state']);
			  unset($data['shipping_postcode']);
		  }
	  }

  	return $data;
  }

  private function maybeDisableDefaultFields()
  {
    return isset($_POST['shipping_method']) &&
      preg_match('/^' . WC_UKR_SHIPPING_NP_SHIPPING_NAME . '.*/i', $_POST['shipping_method'][0]) &&
      apply_filters('wc_ukr_shipping_prevent_disable_default_fields', false) === false;
  }

  private function maybeCustomAddressActive()
  {
    return isset($_POST['np_custom_address']) && (int)$_POST['np_custom_address'];
  }

  private function validateAddressShipping()
  {
    if (
      empty($_POST[WC_UKR_SHIPPING_NP_SHIPPING_NAME . '_area'])
      || empty($_POST[WC_UKR_SHIPPING_NP_SHIPPING_NAME . '_city'])
      || empty($_POST[WC_UKR_SHIPPING_NP_SHIPPING_NAME . '_custom_address'])
    ) {
      $this->addErrorNotice();
    }
  }

  private function validateWarehouseShipping()
  {
    if (
      empty($_POST[WC_UKR_SHIPPING_NP_SHIPPING_NAME . '_area'])
      || empty($_POST[WC_UKR_SHIPPING_NP_SHIPPING_NAME . '_city'])
      || empty($_POST[WC_UKR_SHIPPING_NP_SHIPPING_NAME . '_warehouse'])
    ) {
      $this->addErrorNotice();
    }
  }

  private function addErrorNotice()
  {
    wc_add_notice('Укажите адрес <strong>Новой Почты</strong>', 'error');
  }
}