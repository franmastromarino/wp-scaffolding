<?php

if ( class_exists( 'QuadLayers\\WP_Notice_Plugin_Promote\\Load' ) ) {
	/**
	 *  Promote constants
	 */
	define( 'QLXXX_PROMOTE_LOGO_SRC', plugins_url( '/assets/backend/img/logo.jpg', QLXXX_PLUGIN_FILE ) );
	/**
	 * Notice review
	 */
	define( 'QLXXX_PROMOTE_REVIEW_URL', 'https://wordpress.org/support/plugin/{{plugin-name}}/reviews/?filter=5#new-post' );
	/**
	 * Notice premium sell
	 */
	define( 'QLXXX_PROMOTE_PREMIUM_SELL_SLUG', '{{plugin-name}}-pro' );
	define( 'QLXXX_PROMOTE_PREMIUM_SELL_NAME', 'Perfect WooCommerce Brands PRO' );
	define( 'QLXXX_PROMOTE_PREMIUM_INSTALL_URL', 'https://quadlayers.com/product/{{plugin-name}}/?utm_source=qlxxx_admin' );
	define( 'QLXXX_PROMOTE_PREMIUM_SELL_URL', QLXXX_PREMIUM_SELL_URL );
	/**
	 * Notice cross sell 1
	 */
	define( 'QLXXX_PROMOTE_CROSS_INSTALL_1_SLUG', 'woocommerce-checkout-manager' );
	define( 'QLXXX_PROMOTE_CROSS_INSTALL_1_NAME', 'WooCommerce Checkout Manager' );
	define( 'QLXXX_PROMOTE_CROSS_INSTALL_1_DESCRIPTION', esc_html__( 'This plugin allows you to add custom fields to the checkout page, related to billing, shipping or additional fields sections.', '{{plugin-name}}' ) );
	define( 'QLXXX_PROMOTE_CROSS_INSTALL_1_URL', 'https://quadlayers.com/portfolio/woocommerce-checkout-manager/?utm_source=qlxxx_admin' );
	/**
	 * Notice cross sell 2
	 */
	define( 'QLXXX_PROMOTE_CROSS_INSTALL_2_SLUG', 'woocommerce-direct-checkout' );
	define( 'QLXXX_PROMOTE_CROSS_INSTALL_2_NAME', 'WooCommerce Direct Checkout' );
	define( 'QLXXX_PROMOTE_CROSS_INSTALL_2_DESCRIPTION', esc_html__( 'It allows you to reduce the steps in the checkout process by skipping the shopping cart page. This can encourage buyers to shop more and quickly. You will increase your sales reducing cart abandonment.', '{{plugin-name}}' ) );
	define( 'QLXXX_PROMOTE_CROSS_INSTALL_2_URL', 'https://quadlayers.com/portfolio/woocommerce-direct-checkout/?utm_source=qlxxx_admin' );

	new \QuadLayers\WP_Notice_Plugin_Promote\Load(
		QLXXX_PLUGIN_FILE,
		array(
			array(
				'type'               => 'ranking',
				'notice_delay'       => MONTH_IN_SECONDS,
				'notice_logo'        => QLXXX_PROMOTE_LOGO_SRC,
				'notice_title'       => sprintf(
					esc_html__(
						'Hello! Thank you for choosing the %s plugin!',
						'{{plugin-name}}'
					),
					QLXXX_PLUGIN_NAME
				),
				'notice_description' => esc_html__( 'Could you please give it a 5-star rating on WordPress? Your feedback boosts our motivation, helps us promote, and continues to improve this product. Your support matters!', '{{plugin-name}}' ),
				'notice_link'        => QLXXX_PROMOTE_REVIEW_URL,
				'notice_link_label'  => esc_html__(
					'Yes, of course!',
					'{{plugin-name}}'
				),
				'notice_more_link'   => QLXXX_SUPPORT_URL,
				'notice_more_label'  => esc_html__(
					'Report a bug',
					'{{plugin-name}}'
				),
			),
			array(
				'plugin_slug'        => QLXXX_PROMOTE_PREMIUM_SELL_SLUG,
				'plugin_install_link'   => QLXXX_PROMOTE_PREMIUM_INSTALL_URL,
				'plugin_install_label'  => esc_html__(
					'Purchase Now',
					'{{plugin-name}}'
				),
				'notice_delay'       => MONTH_IN_SECONDS,
				'notice_logo'        => QLXXX_PROMOTE_LOGO_SRC,
				'notice_title'       => esc_html__(
					'Hello! We have a special gift!',
					'{{plugin-name}}'
				),
				'notice_description' => sprintf(
					esc_html__(
						'Today we have a special gift for you. Use the coupon code %1$s within the next 48 hours to receive a %2$s discount on the premium version of the %3$s plugin.',
						'{{plugin-name}}'
					),
					'ADMINPANEL20%',
					'20%',
					QLXXX_PROMOTE_PREMIUM_SELL_NAME
				),
				'notice_more_link'   => QLXXX_PROMOTE_PREMIUM_SELL_URL,
				'notice_more_label'  => esc_html__(
					'More info!',
					'{{plugin-name}}'
				),
			),
			array(
				'plugin_slug'        => QLXXX_PROMOTE_CROSS_INSTALL_1_SLUG,
				'notice_delay'       => MONTH_IN_SECONDS * 4,
				'notice_logo'        => QLXXX_PROMOTE_LOGO_SRC,
				'notice_title'       => sprintf(
					esc_html__(
						'Hello! We want to invite you to try our %s plugin!',
						'{{plugin-name}}'
					),
					QLXXX_PROMOTE_CROSS_INSTALL_1_NAME
				),
				'notice_description' => QLXXX_PROMOTE_CROSS_INSTALL_1_DESCRIPTION,
				'notice_more_link'   => QLXXX_PROMOTE_CROSS_INSTALL_1_URL,
				'notice_more_label'  => esc_html__(
					'More info!',
					'{{plugin-name}}'
				),
			),
			array(
				'plugin_slug'        => QLXXX_PROMOTE_CROSS_INSTALL_2_SLUG,
				'notice_delay'       => MONTH_IN_SECONDS * 6,
				'notice_logo'        => QLXXX_PROMOTE_LOGO_SRC,
				'notice_title'       => sprintf(
					esc_html__(
						'Hello! We want to invite you to try our %s plugin!',
						'{{plugin-name}}'
					),
					QLXXX_PROMOTE_CROSS_INSTALL_2_NAME
				),
				'notice_description' => QLXXX_PROMOTE_CROSS_INSTALL_2_DESCRIPTION,
				'notice_more_link'   => QLXXX_PROMOTE_CROSS_INSTALL_2_URL,
				'notice_more_label'  => esc_html__(
					'More info!',
					'{{plugin-name}}'
				),
			),
		)
	);
}
