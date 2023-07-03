<?php

if ( class_exists( 'QuadLayers\\WP_Plugin_Table_Links\\Load' ) ) {
	new \QuadLayers\WP_Plugin_Table_Links\Load(
		QLXXX_PLUGIN_FILE,
		array(
			array(
				'text'   => esc_html__( 'Settings', '{{plugin-name}}' ),
				'url'    => admin_url( 'admin.php?page=wc-settings&tab=qlxxx' ),
				'target' => '_self',
			),
			array(
				'text' => esc_html__( 'Premium', '{{plugin-name}}' ),
				'url'  => QLXXX_PURCHASE_URL,
			),
			array(
				'place' => 'row_meta',
				'text'  => esc_html__( 'Support', '{{plugin-name}}' ),
				'url'   => QLXXX_SUPPORT_URL,
			),
			array(
				'place' => 'row_meta',
				'text'  => esc_html__( 'Documentation', '{{plugin-name}}' ),
				'url'   => QLXXX_DOCUMENTATION_URL,
			),
		)
	);
}
