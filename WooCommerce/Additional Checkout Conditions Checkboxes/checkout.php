	function madnify_require_shipping_policy_checkout() { ?>
			<p class="form-row validate-required">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
				<input type="checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" name="shipping-policy" <?php checked(isset($_POST['shipping-policy']), true ); // WPCS: input var ok, csrf ok. ?> id="shipping-policy" />
					<span class="woocommerce-terms-and-conditions-checkbox-text">
						I have read and agree to the website <a href="<?php echo get_permalink(get_page_by_path('/shipping-policy/')); ?>" target="_blank">shipping policy</a>
					</span>&nbsp;<span class="required">*</span>
					<input type="hidden" name="shipping-policy-field" value="1" />
				</label>
			</p>
	<?php }

	add_action('woocommerce_checkout_after_terms_and_conditions', 'madnify_require_shipping_policy_checkout');

	function madnify_check_shipping_policy_checked() {
		if (empty($_POST['shipping-policy'])) {
			wc_add_notice('Please read and accept the shipping policy to proceed with your order.', 'error');
		}
	}

	add_action('woocommerce_checkout_process', 'madnify_check_shipping_policy_checked');
