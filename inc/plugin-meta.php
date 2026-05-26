<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }


if ( ! function_exists('pagelist_unqprfx_plugin_meta') ) {
	function pagelist_unqprfx_plugin_meta( $links, $file ) { // add links to plugin meta row
		if ( $file == plugin_basename( PAGE_LIST_PLUGIN_FILE ) ) {
			$row_meta = array(
				'support' => '<a href="http://web-profile.net/wordpress/plugins/page-list/" target="_blank">' . __( 'Page-list', 'page-list' ) . '</a>',
				'donate' => '<a href="http://web-profile.net/donate/" target="_blank">' . __( 'Donate', 'page-list' ) . '</a>',
				'pro' => '<a href="https://1.envato.market/KdRNz" target="_blank" title="Advanced iFrame Pro">' . __( 'Advanced iFrame Pro', 'page-list' ) . '</a>'
			);
			$links = array_merge( $links, $row_meta );
		}
		return (array) $links;
	}
	add_filter( 'plugin_row_meta', 'pagelist_unqprfx_plugin_meta', 10, 2 );
}
