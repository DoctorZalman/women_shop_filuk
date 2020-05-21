<?php

namespace kirillbdev\WCUkrShipping\Classes;

use kirillbdev\WCUkrShipping\Services\StorageService;

if ( ! defined('ABSPATH')) {
  exit;
}

class OrderCreator
{
  private $db;

  public function __construct()
  {
    global $wpdb;

    $this->db = $wpdb;

    add_action('woocommerce_checkout_create_order', [ $this, 'createOrder' ]);
  }

  public function createOrder($order)
  {
    if ( ! $this->isNovaPoshtaShipping($order)) {
      return;
    }

    $this->saveArea($order);
    $this->saveCity($order);

    if ($this->maybeAddressShipping()) {
      $this->saveAddress($order);
    }
    else {
      $this->saveWarehouse($order);
    }
  }

  /**
   * @param \WC_Order $order
   *
   * @return bool
   */
  private function isNovaPoshtaShipping($order)
  {
    return $order->has_shipping_method(WC_UKR_SHIPPING_NP_SHIPPING_NAME);
  }

  private function maybeAddressShipping()
  {
    return isset($_POST['np_custom_address']) && (int)$_POST['np_custom_address'];
  }

  /**
   * @param \WC_Order $order
   */
  private function saveArea($order)
  {
    $npArea = $this->db->get_row("
      SELECT description 
      FROM wc_ukr_shipping_np_areas 
      WHERE ref = '" . esc_attr($_POST[WC_UKR_SHIPPING_NP_SHIPPING_NAME . '_area']) . "'
    ", ARRAY_A);

    if ($npArea) {
      $order->set_shipping_state($npArea['description']);
      $order->set_billing_state($npArea['description']);
      $order->update_meta_data('wc_ukr_shipping_np_area_ref', esc_attr($_POST[WC_UKR_SHIPPING_NP_SHIPPING_NAME . '_area']));
    }
  }

  /**
   * @param \WC_Order $order
   */
  private function saveCity($order)
  {
    $npCity = $this->db->get_row("
      SELECT description 
      FROM wc_ukr_shipping_np_cities 
      WHERE ref = '" . esc_attr($_POST[WC_UKR_SHIPPING_NP_SHIPPING_NAME . '_city']) . "'
    ", ARRAY_A);

    if ($npCity) {
      $order->set_shipping_city($npCity['description']);
      $order->set_billing_city($npCity['description']);
      $order->update_meta_data('wc_ukr_shipping_np_city_ref', esc_attr($_POST[WC_UKR_SHIPPING_NP_SHIPPING_NAME . '_city']));
    }
  }

  /**
   * @param \WC_Order $order
   */
  private function saveWarehouse($order)
  {
    $npWarehouse = $this->db->get_row("
      SELECT description 
      FROM wc_ukr_shipping_np_warehouses 
      WHERE ref = '" . esc_attr($_POST[WC_UKR_SHIPPING_NP_SHIPPING_NAME . '_warehouse']) . "'
    ", ARRAY_A);

    if ($npWarehouse) {
      $order->set_shipping_address_1($npWarehouse['description']);
      $order->set_billing_address_1($npWarehouse['description']);
      $order->update_meta_data('wc_ukr_shipping_np_warehouse_ref', esc_attr($_POST[WC_UKR_SHIPPING_NP_SHIPPING_NAME . '_warehouse']));

      StorageService::setValue('wc_ukr_shipping_np_selected_warehouse', esc_attr($_POST[WC_UKR_SHIPPING_NP_SHIPPING_NAME . '_warehouse']));
    }
  }

  /**
   * @param \WC_Order $order
   */
  private function saveAddress($order)
  {
    $order->set_shipping_address_1(sanitize_text_field($_POST[WC_UKR_SHIPPING_NP_SHIPPING_NAME . '_custom_address']));
    $order->set_billing_address_1(sanitize_text_field($_POST[WC_UKR_SHIPPING_NP_SHIPPING_NAME . '_custom_address']));
  }
}