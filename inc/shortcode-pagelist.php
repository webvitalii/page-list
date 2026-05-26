<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }


if ( !function_exists('pagelist_unqprfx_shortcode') ) {
	function pagelist_unqprfx_shortcode( $atts ) {
		global $post, $pagelist_unq_settings;
		$return = '';
		extract( shortcode_atts( $pagelist_unq_settings['page_list_defaults'], $atts ) );

		$page_list_args = array(
			'depth'        => $depth,
			'child_of'     => pagelist_unqprfx_norm_params($child_of),
			'exclude'      => pagelist_unqprfx_norm_params($exclude),
			'exclude_tree' => pagelist_unqprfx_norm_params($exclude_tree),
			'include'      => pagelist_unqprfx_norm_params($include),
			'title_li'     => esc_html($title_li),
			'number'       => $number,
			'offset'       => $offset,
			'meta_key'     => $meta_key,
			'meta_value'   => $meta_value,
			'show_date'    => $show_date,
			'date_format'  => $date_format,
			'echo'         => 0,
			'authors'      => $authors,
			'sort_column'  => $sort_column,
			'sort_order'   => $sort_order,
			'link_before'  => esc_html($link_before),
			'link_after'   => esc_html($link_after),
			'post_type'    => $post_type,
			'post_status'  => $post_status
		);
		$list_pages = wp_list_pages( $page_list_args );

		$return .= $pagelist_unq_settings['powered_by'];
		if ($list_pages) {
			$return .= '<ul class="page-list '.esc_attr($class).'">'."\n".$list_pages."\n".'</ul>';
		} else {
			$return .= '<!-- no pages to show -->';
		}
		return $return;
	}
	add_shortcode( 'pagelist', 'pagelist_unqprfx_shortcode' );
	add_shortcode( 'page_list', 'pagelist_unqprfx_shortcode' );
	add_shortcode( 'page-list', 'pagelist_unqprfx_shortcode' ); // not good (Shortcode names should be all lowercase and use all letters, but numbers and underscores (not dashes!) should work fine too.)
	add_shortcode( 'sitemap', 'pagelist_unqprfx_shortcode' );
}
