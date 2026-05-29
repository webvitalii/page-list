<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }


if ( !function_exists('siblings_unqprfx_shortcode') ) {
	function siblings_unqprfx_shortcode( $atts ) {
		global $post, $pagelist_unq_settings;
		$return = '';
		extract( shortcode_atts( $pagelist_unq_settings['page_list_defaults'], $atts ) );

		if ( $exclude == 'current' || $exclude == 'this' ) {
			$exclude = isset($post->ID) ? $post->ID : 0;
		}

		$page_list_args = array(
			'depth'        => $depth,
			'child_of'     => isset($post->post_parent) ? $post->post_parent : 0,
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
			'post_type'    => $post_type
		);
		$list_pages = wp_list_pages( $page_list_args );

		$return .= $pagelist_unq_settings['powered_by'];
		if ($list_pages) {
			$return .= '<ul class="page-list siblings-page-list '.esc_attr($class).'">'."\n".$list_pages."\n".'</ul>';
		} else {
			$return .= '<!-- no pages to show -->';
		}
		return $return;
	}
	add_shortcode( 'siblings', 'siblings_unqprfx_shortcode' );
}
