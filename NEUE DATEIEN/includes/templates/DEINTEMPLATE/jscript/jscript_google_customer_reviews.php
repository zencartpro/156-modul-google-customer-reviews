<?php
if(GCR_STATUS == 'true') { 
	if ($_GET['main_page'] == FILENAME_CHECKOUT_SUCCESS) { 
	// get customers last order
	$gcr_order = $db->Execute("SELECT 
		orders_id, 
		customers_email_address, 
		delivery_country
		FROM " . TABLE_ORDERS . " 
		WHERE customers_id = " . (int)$_SESSION['customer_id'] . " 
		ORDER BY orders_id DESC 
		LIMIT 1;"
	);
	if ($gcr_order->RecordCount() > 0) {
		// get the country code
		if (!$language_id) {
      $language_id = $_SESSION['languages_id'];
    }
		$countries = $db->Execute("SELECT c.countries_iso_code_2, cn.countries_name, cn.language_id, c.countries_id FROM " . TABLE_COUNTRIES . " c, " . TABLE_COUNTRIES_NAME . " cn where cn.language_id = '" . $language_id . "' AND  cn.countries_id = c.countries_id AND cn.countries_name = '" . $gcr_order->fields['delivery_country'] . "' LIMIT 1;");
		if ($countries->RecordCount() > 0) {
			
				// add the shipping time default to today's date
				$estimated_delivery_date = DATE('Y-m-d', time() + ((int)GCR_ESTIMATE_DELIVERY_TIME * 86400));
			  	
?> 
<script src="https://apis.google.com/js/platform.js?onload=renderOptIn" async defer></script>

<script>
  window.renderOptIn = function() {
    window.gapi.load('surveyoptin', function() {
      window.gapi.surveyoptin.render(
        {
          "merchant_id": <?php echo GCR_ID; ?>,
          "order_id": "<?php echo $gcr_order->fields['orders_id']; ?>",
          "email": "<?php echo $gcr_order->fields['customers_email_address']; ?>",
          "delivery_country": "<?php echo $countries->fields['countries_iso_code_2']; ?>",
          "estimated_delivery_date": "<?php echo $estimated_delivery_date; ?>",
          "opt_in_style": "<?php echo GCR_OPT_IN_STYLE; ?>"
        });
    });
  }
</script>
<script>
  window.___gcfg = {
    lang: 'de'
  };
</script>
<?php }}} ?>
<?php if (GCR_BADGE == 'true') { ?>
<script src="https://apis.google.com/js/platform.js?onload=renderBadge" async defer></script>

<script>
  window.renderBadge = function() {
    var ratingBadgeContainer = document.createElement("div");
    document.body.appendChild(ratingBadgeContainer);
    window.gapi.load('ratingbadge', function() {
      window.gapi.ratingbadge.render(ratingBadgeContainer, {"merchant_id": <?php echo GCR_ID; ?>, "position": "<?php echo GCR_OPT_IN_STYLE; ?>"});
    });
  }
</script>
<?php }} ?>