<?php
/*
Plugin Name: Page-list
Plugin URI: http://wordpress.org/plugins/page-list/
Description: [pagelist], [subpages], [siblings] and [pagelist_ext] shortcodes
Version: 6.0
Author: webvitaly
Author URI: http://web-profile.net/wordpress/plugins/
License: GPLv3
*/

if ( ! defined( 'ABSPATH' ) ) { exit; }

define('PAGE_LIST_PLUGIN_VERSION', '6.0');
define('PAGE_LIST_PLUGIN_FILE', __FILE__);

$pagelist_unq_settings = array(
	'version' => PAGE_LIST_PLUGIN_VERSION,
	'powered_by' => "\n".'<!-- Page-list plugin v.'.PAGE_LIST_PLUGIN_VERSION.' wordpress.org/plugins/page-list/ -->'."\n",
	'page_list_defaults' => array(
		'depth' => '0',
		'child_of' => '0',
		'exclude' => '0',
		'exclude_tree' => '',
		'include' => '0',
		'title_li' => '',
		'number' => '',
		'offset' => '',
		'meta_key' => '',
		'meta_value' => '',
		'show_date' => '',
		'date_format' => get_option('date_format'),
		'authors' => '',
		'sort_column' => 'menu_order, post_title',
		'sort_order' => 'ASC',
		'link_before' => '',
		'link_after' => '',
		'post_type' => 'page',
		'post_status' => 'publish',
		'class' => ''
	)
);


if ( !function_exists('pagelist_unqprfx_add_stylesheet') ) {
	function pagelist_unqprfx_add_stylesheet() {
		wp_enqueue_style( 'page-list-style', plugins_url( '/css/page-list.css', __FILE__ ), false, PAGE_LIST_PLUGIN_VERSION, 'all' );
	}
	add_action('wp_enqueue_scripts', 'pagelist_unqprfx_add_stylesheet');
}


require_once __DIR__ . '/inc/helpers.php';
require_once __DIR__ . '/inc/shortcode-pagelist.php';
require_once __DIR__ . '/inc/shortcode-subpages.php';
require_once __DIR__ . '/inc/shortcode-siblings.php';
require_once __DIR__ . '/inc/shortcode-pagelist-ext.php';
require_once __DIR__ . '/inc/plugin-meta.php';
