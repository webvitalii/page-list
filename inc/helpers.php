<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }


if ( !function_exists('pagelist_unqprfx_norm_params') ) {
	function pagelist_unqprfx_norm_params( $str ) {
		global $post;
		$new_str = $str;
		if(isset($post)) {
			$new_str = str_replace('this', $post->ID, $new_str); // exclude this page
			$new_str = str_replace('current', $post->ID, $new_str); // exclude current page
			$new_str = str_replace('curent', $post->ID, $new_str); // exclude curent page with mistake
			$new_str = str_replace('parent', $post->post_parent, $new_str); // exclude parent page
		}
		return $new_str;
	}
}


if ( !function_exists('pagelist_unqprfx_parse_content') ) {
	function pagelist_unqprfx_parse_content($content, $limit_content = 250, $strip_tags = 1, $strip_shortcodes = 1, $more_tag = 1) {

		$more_tag_found = 0;

		if ( $more_tag ) { // "more_tag" have higher priority than "limit_content"
			if ( preg_match('/<!--more(.*?)?-->/', $content, $matches) ) {
				$more_tag_found = 1;
				$more_tag = $matches[0];
				$content_temp = explode($matches[0], $content);
				$content_temp = $content_temp[0];
				$content_before_more_tag_length = strlen($content_temp);
				$content = substr_replace($content, '###more###', $content_before_more_tag_length, 0);
			}
		}

		// replace php and comments tags so they do not get stripped
		//$content = preg_replace("@<\?@", "#?#", $content);
		//$content = preg_replace("@<!--@", "#!--#", $content); // save html comments
		// strip tags normally
		//$content = strip_tags($content);
		if ( $strip_tags ) {
			$content = str_replace('</', ' </', $content); // <p>line1</p><p>line2</p> - adding space between lines
			$content = strip_tags($content); // ,'<p>'
		}
		// return php and comments tags to their origial form
		//$content = preg_replace("@#\?#@", "<?", $content);
		//$content = preg_replace("@#!--#@", "<!--", $content);

		if ( $strip_shortcodes ) {
			$content = strip_shortcodes( $content );
		}

		if ( $more_tag && $more_tag_found ) { // "more_tag" have higher priority than "limit_content"
			$fake_more_pos = mb_strpos($content, '###more###', 0, 'UTF-8');
			if ( $fake_more_pos === false ) {
				// substring not found in string and this is strange :)
			} else {
				$content = mb_substr($content, 0, $fake_more_pos, 'UTF-8');
			}
		} else {
			if ( strlen($content) > $limit_content ) { // limiting content
				$pos = strpos($content, ' ', $limit_content); // find first space position
				if ($pos !== false) {
					$first_space_pos = $pos;
				} else {
					$first_space_pos = $limit_content;
				}
				$content = mb_substr($content, 0, $first_space_pos, 'UTF-8') . '...';
			}
		}

		$output = force_balance_tags($content);
		return $output;
	}
}


if ( !function_exists('pagelist_unqprfx_get_first_image') ) {
	function pagelist_unqprfx_get_first_image( $content='' ) {
		$first_img = '';
		$matchCount = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches);
		if ( $matchCount !== 0 ) { // if we found first image
			$first_img = $matches[1][0];
		}
		return $first_img;
	}
}
