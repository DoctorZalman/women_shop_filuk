jQuery(document).ready(function() {

  function updatenpdb(){
    var data2 = {action: 'novaposhta_updbasesnp'};
    jQuery.post(NovaPoshtaHelper.ajaxUrl, data2, function(response) {
    });
  }

  function calcdelivery() { //function to show calculated delivery price
     var data = {
        action: 'my_actionfogetnpshippngcost',
        c2: jQuery('#billing_nova_poshta_city').val(),
        cod: jQuery('#payment_method_cod').attr('checked')
      };

      jQuery.post(NovaPoshtaHelper.ajaxUrl, data, function(response) {
        jQuery('#shipcost').remove();
              if (!(response.includes('01234')) && (response != 0)) {
                jQuery('.order-total').after('<tr id=shipcost class=order-total><th>Розрахунок вартості доставки</th><td><strong><span class="woocommerce-Price-currencySymbol">₴</span>' + response + '<strong><input type="hidden" name=deliveryprice value="'+ response +'"/ ></td></tr>')

              } else {
              }

          });
  }

  function calculated() { //function to remove  calcuated post
    jQuery('#shipcost').remove();
  }

  //function custom select3 matcher
  function matchCustom(params, data) { //matcher function
            // If there are no search terms, return all of the data
            if (jQuery.trim(params.term) === '') {
                return data;
            }

            // Do not display the item if there is no 'text' property
            if (typeof data.text === 'undefined') {
                return null;
            }

            // `params.term` should be the term that is used for searching
            // `data.text` is the text that is displayed for the data object
            var s = jQuery.trim(params.term).toLowerCase();
            var s2 = jQuery.trim(data.text).toLowerCase();
            if (s === s2.substr(0, s.length)) {
                return data;
            }

            // Return `null` if the term should not be displayed
            return null;
  }

  //custom select3 func
  function isNotEmpty(res) {
    return false;
  }

  //template result funtion to display city options
  function myTemplateResult(res) { //custom func
    if (res.loading) return res.text;
    res.id = res.id;
    if (isNotEmpty(res.code)) {
      return res.code + ":" + res.text;
    }
    else {
      return res.text;
     }
  }

  //custom select3 function
  function myTemplateSelection(res) {
    return res.text;
  }

  function callchangecountry() {
      jQuery('#billing_country').trigger('change', []);
    }

  let ischeckoutpage = document.getElementById("billing_nova_poshta_city");

  if (ischeckoutpage) {// adding event listeners for custom calculating

      //ask update db if not enough
      updatenpdb();

      //fix bad checkout on some sites by change country trigger if not work, increase timeout
      setTimeout(callchangecountry, 500);

      //add event listener calculate shipping if billing city changed
      jQuery('#billing_nova_poshta_city').change(function() {
          calcdelivery();
          city = jQuery("#billing_nova_poshta_city").val();
          document.cookie = "city="+city;
      });

      //add event listener to calculate shipping if payment method changed and delays to do if late
      jQuery('body').on('click', '.wc_payment_method', function() { //what to do if payment city changed

          setTimeout(function() {
              calcdelivery();
          }, 20);
          setTimeout(function() {
              calcdelivery();
          }, 500);
          setTimeout(function() {
              calcdelivery();
          }, 4000);
      });


      //add event listener what to do if shipping method changed

      jQuery('body').on('click', '.shipping_method', function() {

          console.log(jQuery(this).val());
          if (jQuery(this).val() == 'nova_poshta_shipping_method') {
              calcdelivery();
              setTimeout(function() {
                  calcdelivery();
              }, 500);
              setTimeout(function() {
                  calcdelivery();
              }, 4000);
          } else {
              calculated();
          }

      });

      //selectize meta
      var selectizecityfield = { //selectize billing city field

            minimumInputLength: 2,



            language: {
                errorLoading: function() {
                    return 'Завантаження.';
                },
                inputTooShort: function() {
                    return "Введіть більше символів...";
                },
                noResults: function() {
                    return 'Нічого не знайдено';
                },
                searching: function() {
                    return 'Пошук…';
                }
            }
        }

      if( document.getElementById("billing_nova_poshta_region") ){

        jQuery("#billing_nova_poshta_city").select2();


            jQuery("#shipping_nova_poshta_city").select2();

        jQuery("#billing_nova_poshta_warehouse").select2();
        //jQuery("#billing_nova_poshta_region").select3();
        jQuery("#shipping_nova_poshta_warehouse").select2();
        //jQuery("#shipping_nova_poshta_region").select3();

        jQuery("#billing_nova_poshta_region").on("change", function() {

            jQuery("#billing_nova_poshta_city").select2({
              sorter: function (data) {
                data.sort(function (a, b) {
                  let jQuerysearch = jQuery('.select2-search__field');
                  if (0 === jQuerysearch.length || '' === jQuerysearch.val()) {
                    return data;
                  }
                  let textA = a.text.toLowerCase(),
                      textB = b.text.toLowerCase(),
                      search = jQuerysearch.val().toLowerCase();
                  if (textA.indexOf(search) < textB.indexOf(search)) {
                    return -1;
                  }
                  if (textA.indexOf(search) > textB.indexOf(search)) {
                    return 1;
                  }
                  return 0;
                });
                return data;
              }
            });
            jQuery("#billing_nova_poshta_warehouse").select2("val", "");
        });

        jQuery("#billing_nova_poshta_city").on("change", function() {
            jQuery("#billing_nova_poshta_warehouse").select2("val", "");
        });
        jQuery("#shipping_nova_poshta_region").on("change", function() {
            jQuery("#shipping_nova_poshta_city").select2({

                sorter: function (data) {
                  data.sort(function (a, b) {
                    let jQuerysearch = jQuery('.select2-search__field');
                    if (0 === jQuerysearch.length || '' === jQuerysearch.val()) {
                      return data;
                    }
                    let textA = a.text.toLowerCase(),
                        textB = b.text.toLowerCase(),
                        search = jQuerysearch.val().toLowerCase();
                    if (textA.indexOf(search) < textB.indexOf(search)) {
                      return -1;
                    }
                    if (textA.indexOf(search) > textB.indexOf(search)) {
                      return 1;
                    }
                    return 0;
                  });
                  return data;
                }
            });
            jQuery("#shipping_nova_poshta_warehouse").select2("val", "");
        });
        jQuery("#shipping_nova_poshta_city").on("change", function() {
            jQuery("#shipping_nova_poshta_warehouse").select2("val", "");
        });
      }
      else{
        jQuery("#billing_nova_poshta_city").select3(selectizecityfield);
        jQuery("#shipping_nova_poshta_city").select3(selectizecityfield);

        jQuery("#billing_nova_poshta_warehouse").select3();
        //jQuery("#billing_nova_poshta_region").select2();
        jQuery("#shipping_nova_poshta_warehouse").select3();
        //jQuery("#shipping_nova_poshta_region").select2();

        jQuery("#billing_nova_poshta_region").on("change", function() {
            jQuery("#billing_nova_poshta_city").select3("val", "");
            jQuery("#billing_nova_poshta_warehouse").select3("val", "");
        });

        jQuery("#billing_nova_poshta_city").on("change", function() {
            jQuery("#billing_nova_poshta_warehouse").select3("val", "");
        });
        jQuery("#shipping_nova_poshta_region").on("change", function() {
            jQuery("#shipping_nova_poshta_city").select3("val", "");
            jQuery("#shipping_nova_poshta_warehouse").select3("val", "");
        });
        jQuery("#shipping_nova_poshta_city").on("change", function() {
            jQuery("#shipping_nova_poshta_warehouse").select3("val", "");
        });
      }



    }
    var NovaPoshtaOptions = (function(jQuery) {
        var result = {};

        var novaPoshtaBillingOptions = jQuery('#billing_nova_poshta_region, #billing_nova_poshta_city, #billing_nova_poshta_warehouse');
        var billingAreaSelect = jQuery('#billing_nova_poshta_region');
        var billingCitySelect = jQuery('#billing_nova_poshta_city');
        var billingWarehouseSelect = jQuery('#billing_nova_poshta_warehouse');

        var novaPoshtaShippingOptions = jQuery('#shipping_nova_poshta_region, #shipping_nova_poshta_city, #shipping_nova_poshta_warehouse');
        var shippingAreaSelect = jQuery('#shipping_nova_poshta_region');
        var shippingCitySelect = jQuery('#shipping_nova_poshta_city');
        var shippingWarehouseSelect = jQuery('#shipping_nova_poshta_warehouse');

        var shippingMethods = 'nova_poshta_shipping_method';
        var shippinglocalpickup = 'wcso_local_shipping';

        var defaultBillingOptions = jQuery('#billing_address_1, #billing_address_2, #billing_city, #billing_state, #billing_postcode');
        var defaultShippingOptions = jQuery('#shipping_address_1, #shipping_address_2, #shipping_city, #shipping_state, #shipping_postcode');

        var shippingMethod = jQuery("input[name^=shipping_method]");
        var shipToDifferentAddressCheckbox = jQuery('#ship-to-different-address-checkbox');

        var shipToDifferentAddress = function() {
            return shipToDifferentAddressCheckbox.is(':checked');
        };

        var ensureNovaPoshta = function() {
            //TODO this method should be more abstract
            var value = jQuery('input[name^=shipping_method][type=radio]:checked').val();
            if (!value) {
                value = jQuery('input#shipping_method_0').val();
            }
            if (!value) {
                value = jQuery('input[name^=shipping_method][type=hidden]').val();
            }
            if (!value) {
              jQuery.post(NovaPoshtaHelper.ajaxUrl,{action: 'my_action_for_wc_get_chosen_method_ids'}, function(response) {
                  value = response;
              });
            }
            if( (jQuery('#billing_country').val() ) ){
              if(jQuery('#billing_country').val() != 'UA'){

                return false;
              }
            }
            if (!value) {
                return true;
            }


            return value === 'nova_poshta_shipping_method';
        };

        //billing
        var enableNovaPoshtaBillingOptions = function() {
            novaPoshtaBillingOptions.each(function() {
                jQuery(this).removeAttr('disabled').closest('.form-row').show();
            });
            disableDefaultBillingOptions();
        };

        var disableNovaPoshtaBillingOptions = function() {
            novaPoshtaBillingOptions.each(function() {
                jQuery(this).attr('disabled', 'disabled').closest('.form-row').hide();
            });
            enableDefaultBillingOptions();
        };

        var enableDefaultBillingOptions = function() {
          if( !(shippingMethods.includes(getNovaPoshta()) )){

            var strladr = 'npttn_address_shipping_method';
            var str1 = getNovaPoshta() || '1';

            if(  (str1.includes(strladr) )  ){
              jQuery('#billing_address_2_field').attr('disabled', 'disabled').css('display', 'none');
              jQuery('#billing_state_field').attr('value', '_').css('display', 'none');
              jQuery('#billing_postcode_field').attr('disabled', 'disabled').css('display', 'none');
              jQuery('#billing_address_1').removeAttr('disabled').css('display', 'block').closest('.form-row').show();
              jQuery('#billing_city').removeAttr('disabled').css('display', 'block').closest('.form-row').show();
            }
            else{
              defaultBillingOptions.each(function() {
                  jQuery(this).removeAttr('disabled').closest('.form-row').show();
              });
            }
          }
        };

        var disableDefaultBillingOptions = function() {
            if(shippingMethods.includes(getNovaPoshta()) ){
              defaultBillingOptions.each(function() {
                  jQuery(this).attr('disabled', 'disabled').closest('.form-row').hide();
              });


            }
            else{
            }

        };

        var getNovaPoshta = function() {
            var value = jQuery('input[name^=shipping_method][type=radio]:checked').val();
            if (!value) {
                value = jQuery('input#shipping_method_0').val();
            }
            if (!value) {
                value = jQuery('input[name^=shipping_method][type=hidden]').val();
            }

            return value;
        };

        //shipping
        var enableNovaPoshtaShippingOptions = function() {
            novaPoshtaShippingOptions.each(function() {
                jQuery(this).removeAttr('disabled').closest('.form-row').show();
            });
            disableDefaultBillingOptions();
            disableDefaultShippingOptions();
        };

        var disableNovaPoshtaShippingOptions = function() {
            novaPoshtaShippingOptions.each(function() {
                jQuery(this).attr('disabled', 'disabled').closest('.form-row').hide();
            });
            enableDefaultShippingOptions();
        };

        var enableDefaultShippingOptions = function() {
            defaultShippingOptions.each(function() {
                jQuery(this).removeAttr('disabled').closest('.form-row').show();
            });
        };

        var disableDefaultShippingOptions = function() {
            defaultShippingOptions.each(function() {
                jQuery(this).attr('disabled', 'disabled').closest('.form-row').hide();
            });
        };

        //common
        var disableNovaPoshtaOptions = function() {
            disableNovaPoshtaBillingOptions();
            disableNovaPoshtaShippingOptions();
        };

        var handleShippingMethodChange = function() {
            disableNovaPoshtaOptions();
            if (ensureNovaPoshta()) {
                if (shipToDifferentAddress()) {
                    enableNovaPoshtaShippingOptions();
                } else {
                    enableNovaPoshtaBillingOptions();
                }
            }
        };

        var initShippingMethodHandlers = function() {
            //TODO check count of call of this method during initialisation and other actions
            jQuery(document).on('change', shippingMethod, function() {
                handleShippingMethodChange();
            });
            jQuery(document).on('change', shipToDifferentAddressCheckbox, function() {
                handleShippingMethodChange();
            });
            jQuery(document.body).bind('updated_checkout', function() {
                handleShippingMethodChange();
            });
            handleShippingMethodChange();
        };

        var initOptionsHandlers = function() {
            billingAreaSelect.on('change', function() {
                var areaRef = this.value;
                jQuery.ajax({
                    url: NovaPoshtaHelper.ajaxUrl,
                    method: "POST",
                    data: {
                        'action': NovaPoshtaHelper.getCitiesAction,
                        'parent_ref': areaRef
                    },
                    success: function(json) {
                        try {
                            var data = JSON.parse(json);
                            billingCitySelect
                                .find('option:not(:first-child)')
                                .remove();

                            jQuery.each(data, function(key, value) {
                                billingCitySelect
                                    .append(jQuery("<option></option>")
                                        .attr("value", key)
                                        .text(value)
                                    );
                            });
                            billingWarehouseSelect.find('option:not(:first-child)').remove();

                        } catch (s) {
                            console.log("Error. Response from server was: " + json);
                        }
                    },
                    error: function() {
                        console.log('Error.');
                    }
                });
            });
            billingCitySelect.on('change', function() {
                var cityRef = this.value;
                jQuery.ajax({
                    url: NovaPoshtaHelper.ajaxUrl,
                    method: "POST",
                    data: {
                        'action': NovaPoshtaHelper.getWarehousesAction,
                        'parent_ref': cityRef
                    },
                    success: function(json) {
                        try {
                            var data = JSON.parse(json);
                            billingWarehouseSelect
                                .find('option:not(:first-child)')
                                .remove();

                            jQuery.each(data, function(key, value) {
                                billingWarehouseSelect
                                    .append(jQuery("<option></option>")
                                        .attr("value", key)
                                        .text(value)
                                    );
                            });

                        } catch (s) {
                            console.log("Error. Response from server was: " + json);
                        }
                    },
                    error: function() {
                        console.log('Error.');
                    }
                });
            });
            shippingAreaSelect.on('change', function() {
                var areaRef = this.value;
                jQuery.ajax({
                    url: NovaPoshtaHelper.ajaxUrl,
                    method: "POST",
                    data: {
                        'action': NovaPoshtaHelper.getCitiesAction,
                        'parent_ref': areaRef
                    },
                    success: function(json) {
                        try {
                            var data = JSON.parse(json);
                            shippingCitySelect
                                .find('option:not(:first-child)')
                                .remove();

                            jQuery.each(data, function(key, value) {
                                shippingCitySelect
                                    .append(jQuery("<option></option>")
                                        .attr("value", key)
                                        .text(value)
                                    );
                            });
                            shippingWarehouseSelect.find('option:not(:first-child)').remove();

                        } catch (s) {
                            console.log("Error. Response from server was: " + json);
                        }
                    },
                    error: function() {
                        console.log('Error.');
                    }
                });
            });
            shippingCitySelect.on('change', function() {
                var cityRef = this.value;
                jQuery.ajax({
                    url: NovaPoshtaHelper.ajaxUrl,
                    method: "POST",
                    data: {
                        'action': NovaPoshtaHelper.getWarehousesAction,
                        'parent_ref': cityRef
                    },
                    success: function(json) {
                        try {
                            var data = JSON.parse(json);
                            shippingWarehouseSelect
                                .find('option:not(:first-child)')
                                .remove();

                            jQuery.each(data, function(key, value) {
                                shippingWarehouseSelect
                                    .append(jQuery("<option></option>")
                                        .attr("value", key)
                                        .text(value)
                                    );
                            });

                        } catch (s) {
                            console.log("Error. Response from server was: " + json);
                        }
                    },
                    error: function() {
                        console.log('Error.');
                    }
                });
            });
        };

        result.init = function() {
            initShippingMethodHandlers();
            initOptionsHandlers();
        };

        return result;
    }(jQuery));
    var Calculator = (function(jQuery) {
        var result = {};



        var ensureNovaPoshta = function() {
            var value = jQuery('input[name^=shipping_method][type=radio]:checked').val();
            if (!value) {
                value = jQuery('input#shipping_method_0').val();
            }
            return value === 'nova_poshta_shipping_method';
        };

        var addNovaPoshtaHandlers = function() {
            jQuery('#calc_shipping_country').find('option').each(function() {
                //Ship to Ukraine only
                if (jQuery(this).val() !== 'UA') {
                    jQuery(this).remove();
                }
            });
            jQuery('#calc_shipping_state_field').hide();

            var shippingMethod = jQuery('<input type="hidden" id="calc_nova_poshta_shipping_method" value="nova_poshta_shipping_method" name="shipping_method">');
            var cityInputKey = jQuery('<input type="hidden" id="calc_nova_poshta_shipping_city" name="calc_nova_poshta_shipping_city">');
            jQuery('#calc_shipping_city_field').append(cityInputKey).append(shippingMethod);
            var cityInputName = jQuery('#calc_shipping_city');

            cityInputName.autocomplete({
                source: function(request, response) {
                    jQuery.ajax({
                        type: 'POST',
                        url: NovaPoshtaHelper.ajaxUrl,
                        data: {
                            action: NovaPoshtaHelper.getCitiesByNameSuggestionAction,
                            name: request.term
                        },
                        success: function(json) {
                            var data = JSON.parse(json);
                            response(jQuery.map(data, function(item, key) {
                                return {
                                    label: item,
                                    value: key
                                }
                            }));
                        }
                    })
                },
                focus: function(event, ui) {
                    cityInputName.val(ui.item.label);
                    return false;
                },
                select: function(event, ui) {
                    cityInputName.val(ui.item.label);
                    cityInputKey.val(ui.item.value);
                    return false;
                }
            });

            jQuery('form.woocommerce-shipping-calculator').on('submit', function() {
                if (jQuery('#calc_shipping_country').val() !== 'UA') {
                    return false;
                }
            });
        };

        result.init = function() {
            jQuery(document.body).bind('updated_wc_div updated_shipping_method', function() {
                if (ensureNovaPoshta()) {
                    addNovaPoshtaHandlers();
                }
            });

            if (ensureNovaPoshta()) {
                addNovaPoshtaHandlers();
            }
        };

        return result;
    }(jQuery));

    NovaPoshtaOptions.init();
    Calculator.init();

});
