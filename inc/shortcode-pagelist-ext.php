<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }


if ( !function_exists('pagelist_unqprfx_ext_shortcode') ) {
	function pagelist_unqprfx_ext_shortcode( $atts ) {
		global $post, $pagelist_unq_settings;
		$return = '';
		extract( shortcode_atts( array(
			'show_image' => 1,
			'show_first_image' => 0,
			'show_title' => 1,
			'show_content' => 1,
			'more_tag' => 1,
			'limit_content' => 250,
			'image_width' => '150',
			'image_height' => '150',
			'child_of' => '',
			'sort_order' => 'ASC',
			'sort_column' => 'menu_order, post_title',
			'hierarchical' => 1,
			'exclude' => '0',
			'include' => '0',
			'meta_key' => '',
			'meta_value' => '',
			'authors' => '',
			'parent' => -1,
			'exclude_tree' => '',
			'number' => '',
			'offset' => 0,
			'post_type' => 'page',
			'post_status' => 'publish',
			'class' => '',
			'strip_tags' => 1,
			'strip_shortcodes' => 1,
			'show_child_count' => 0,
			'child_count_template' => 'Subpages: %child_count%',
			'show_meta_key' => '',
			'meta_template' => '%meta%'
		), $atts ) );

		// Sanitize and validate image_width
		$image_width = absint($image_width);
		if ($image_width === 0) {
			$image_width = 150; // Set a default value if invalid input is provided
		}

		// Sanitize and validate image_height
		$image_height = absint($image_height);
		if ($image_height === 0) {
			$image_height = 150; // Set a default value if invalid input is provided
		}

		if ( $child_of == '' ) { // show subpages if child_of is empty
			$child_of = isset($post->ID) ? $post->ID : 0;
		}

		// --- Security hardening (CVE: Wordfence ticket 454582) ---
		// Restrict post_type to public post types; fall back to 'page' otherwise.
		$pagelist_ext_allowed_types = get_post_types( array( 'public' => true ) );
		if ( ! is_array( $pagelist_ext_allowed_types ) || ! in_array( $post_type, $pagelist_ext_allowed_types, true ) ) {
			$post_type = 'page';
		}
		// Restrict post_status: only allow non-public statuses if the current
		// user has the capability to read those posts for the requested type.
		$pagelist_ext_requested_status = $post_status;
		$post_status = 'publish';
		$pagelist_ext_pt_obj = get_post_type_object( $post_type );
		if ( $pagelist_ext_requested_status === 'private'
			&& $pagelist_ext_pt_obj
			&& current_user_can( $pagelist_ext_pt_obj->cap->read_private_posts ) ) {
			$post_status = 'private';
		} elseif ( in_array( $pagelist_ext_requested_status, array( 'draft', 'pending', 'future', 'trash' ), true )
			&& $pagelist_ext_pt_obj
			&& current_user_can( $pagelist_ext_pt_obj->cap->edit_others_posts ) ) {
			$post_status = $pagelist_ext_requested_status;
		}
		// Disallow protected (underscore-prefixed) meta keys unless the user
		// can edit others' posts. Prevents disclosure of arbitrary post meta.
		if ( $show_meta_key !== '' && is_protected_meta( $show_meta_key, 'post' ) && ! current_user_can( 'edit_others_posts' ) ) {
			$show_meta_key = '';
		}

		$page_list_ext_args = array(
			'show_image' => $show_image,
			'show_first_image' => $show_first_image,
			'show_title' => $show_title,
			'show_content' => $show_content,
			'more_tag' => $more_tag,
			'limit_content' => $limit_content,
			'image_width' => $image_width,
			'image_height' => $image_height,
			'sort_order' => $sort_order,
			'sort_column' => $sort_column,
			'hierarchical' => $hierarchical,
			'exclude' => pagelist_unqprfx_norm_params($exclude),
			'include' => pagelist_unqprfx_norm_params($include),
			'meta_key' => $meta_key,
			'meta_value' => $meta_value,
			'authors' => $authors,
			'child_of' => pagelist_unqprfx_norm_params($child_of),
			'parent' => pagelist_unqprfx_norm_params($parent),
			'exclude_tree' => pagelist_unqprfx_norm_params($exclude_tree),
			'number' => '', // $number - own counter
			'offset' => 0, // $offset - own offset
			'post_type' => $post_type,
			'post_status' => $post_status,
			'class' => $class,
			'strip_tags' => $strip_tags,
			'strip_shortcodes' => $strip_shortcodes,
			'show_child_count' => $show_child_count,
			'child_count_template' => $child_count_template,
			'show_meta_key' => $show_meta_key,
			'meta_template' => $meta_template
		);
		$page_list_ext_args_all = array(
			'show_image' => $show_image,
			'show_first_image' => $show_first_image,
			'show_title' => $show_title,
			'show_content' => $show_content,
			'more_tag' => $more_tag,
			'limit_content' => $limit_content,
			'image_width' => $image_width,
			'image_height' => $image_height,
			'sort_order' => $sort_order,
			'sort_column' => $sort_column,
			'hierarchical' => $hierarchical,
			'exclude' => pagelist_unqprfx_norm_params($exclude),
			'include' => pagelist_unqprfx_norm_params($include),
			'meta_key' => $meta_key,
			'meta_value' => $meta_value,
			'authors' => $authors,
			'child_of' => 0, // for showing all pages
			'parent' => pagelist_unqprfx_norm_params($parent),
			'exclude_tree' => pagelist_unqprfx_norm_params($exclude_tree),
			'number' => '', // $number - own counter
			'offset' => 0, // $offset - own offset
			'post_type' => $post_type,
			'post_status' => $post_status,
			'class' => $class,
			'strip_tags' => $strip_tags,
			'strip_shortcodes' => $strip_shortcodes,
			'show_child_count' => $show_child_count,
			'child_count_template' => $child_count_template,
			'show_meta_key' => $show_meta_key,
			'meta_template' => $meta_template
		);
		$list_pages = get_pages( $page_list_ext_args );
		if ( count( $list_pages ) == 0 && $post_status === 'publish' ) { // if there is no subpages
			// Only fall back to a site-wide query for public content to avoid
			// disclosing unrelated private/draft pages (Wordfence ticket 454582).
			$list_pages = get_pages( $page_list_ext_args_all ); // we are showing all pages
		}
		$list_pages_html = '';
		$count = 0;
		$offset_count = 0;
		if ( $list_pages !== false && count( $list_pages ) > 0 ) {
			foreach($list_pages as $page){
				// Skip pages the current user is not permitted to read
				// (Wordfence ticket 454582). Only enforced for non-public
				// statuses; published pages are visible to everyone and
				// current_user_can( 'read_post', ... ) returns false for
				// anonymous viewers, which would hide published content.
				if ( $post_status !== 'publish' && ! current_user_can( 'read_post', $page->ID ) ) {
					continue;
				}
				$count++;
				$offset_count++;
				if ( !empty( $offset ) && is_numeric( $offset ) && $offset_count <= $offset ) {
					$count = 0; // number counter to zero if offset is not finished
				}
				if ( ( !empty( $offset ) && is_numeric( $offset ) && $offset_count > $offset ) || ( empty( $offset ) ) || ( !empty( $offset ) && !is_numeric( $offset ) ) ) {
					if ( ( !empty( $number ) && is_numeric( $number ) && $count <= $number ) || ( empty( $number ) ) || ( !empty( $number ) && !is_numeric( $number ) ) ) {
						$link = get_permalink( $page->ID );
						$list_pages_html .= '<div class="page-list-ext-item">';
						if ( $show_image == 1 ) {
							if ( get_the_post_thumbnail( $page->ID ) ) { // if there is a featured image
								$list_pages_html .= '<div class="page-list-ext-image"><a href="'.$link.'" title="'.esc_attr($page->post_title).'">';
								//$list_pages_html .= get_the_post_thumbnail($page->ID, array($image_width,$image_height)); // doesn't work good with image size

								$image = wp_get_attachment_image_src( get_post_thumbnail_id( $page->ID ), array($image_width,$image_height) ); // get featured img; 'large'
								$img_url = $image[0]; // get the src of the featured image
								$list_pages_html .= '<img src="'.esc_url($img_url).'" width="'.esc_attr($image_width).'" alt="'.esc_attr($page->post_title).'" />'; // not using height="'.$image_height.'" because images could be not square shaped and they will be stretched

								$list_pages_html .= '</a></div> ';
							} else {
								if ( $show_first_image == 1 ) {
									$img_scr = pagelist_unqprfx_get_first_image( $page->post_content );
									if ( !empty( $img_scr ) ) {
										$list_pages_html .= '<div class="page-list-ext-image"><a href="'.$link.'" title="'.esc_attr($page->post_title).'">';
										$list_pages_html .= '<img src="'.esc_url($img_scr).'" width="'.esc_attr($image_width).'" alt="'.esc_attr($page->post_title).'" />'; // not using height="'.$image_height.'" because images could be not square shaped and they will be stretched
										$list_pages_html .= '</a></div> ';
									}
								}
							}
						}


						if ( $show_title == 1 ) {
							$list_pages_html .= '<h3 class="page-list-ext-title"><a href="'.$link.'" title="'.esc_attr($page->post_title).'">'.esc_html($page->post_title).'</a></h3>';
						}
						if ( $show_content == 1 ) {
							//$content = apply_filters('the_content', $page->post_content);
							//$content = str_replace(']]>', ']]&gt;', $content); // both used in default the_content() function

							if ( !empty( $page->post_excerpt ) ) {
								$text_content = $page->post_excerpt;
							} else {
								$text_content = $page->post_content;
							}

							if ( post_password_required($page) ) {
								$content = '<!-- password protected -->';
							} else {
								$content = pagelist_unqprfx_parse_content( $text_content, $limit_content, $strip_tags, $strip_shortcodes, $more_tag );
								$content = do_shortcode( $content );

								if ( $show_title == 0 ) { // make content as a link if there is no title
									$content = '<a href="'.$link.'">'.$content.'</a>';
								}
							}

							$list_pages_html .= '<div class="page-list-ext-item-content">'.$content.'</div>';

						}
						if ( $show_child_count == 1 ) {
							$count_subpages = count(get_pages("child_of=".$page->ID));
							if ( $count_subpages > 0 ) { // hide empty
								$child_count_pos = strpos($child_count_template, '%child_count%'); // check if we have %child_count% marker in template
								if ($child_count_pos === false) { // %child_count% not found in template
									$child_count_template_html = esc_html($child_count_template).' '.$count_subpages;
									$list_pages_html .= '<div class="page-list-ext-child-count">'.$child_count_template_html.'</div>';
								} else { // %child_count% found in template
									$child_count_template_html = str_replace('%child_count%', $count_subpages, esc_html($child_count_template));
									$list_pages_html .= '<div class="page-list-ext-child-count">'.$child_count_template_html.'</div>';
								}
							}
						}
						if ( $show_meta_key != '' ) {
							$post_meta = do_shortcode(get_post_meta($page->ID, $show_meta_key, true));
							if ( !empty($post_meta) ) { // hide empty
								$meta_pos = strpos($meta_template, '%meta%'); // check if we have %meta% marker in template
								if ($meta_pos === false) { // %meta% not found in template
									$meta_template_html = esc_html($meta_template).' '.esc_html($post_meta);
									$list_pages_html .= '<div class="page-list-ext-meta">'.$meta_template_html.'</div>';
								} else { // %meta% found in template
									$meta_template_html = str_replace('%meta%', esc_html($post_meta), esc_html($meta_template));
									$list_pages_html .= '<div class="page-list-ext-meta">'.$meta_template_html.'</div>';
								}
							}
						}
						$list_pages_html .= '</div>'."\n";
					}
				}
			}
		}
		$return .= $pagelist_unq_settings['powered_by'];
		if ($list_pages_html) {
			$return .= '<div class="page-list page-list-ext '.esc_attr($class).'">'."\n".$list_pages_html."\n".'</div>';
		} else {
			$return .= '<!-- no pages to show -->'; // this line will not work, because we show all pages if there is no pages to show
		}
		return $return;
	}
	add_shortcode( 'pagelist_ext', 'pagelist_unqprfx_ext_shortcode' );
	add_shortcode( 'pagelistext', 'pagelist_unqprfx_ext_shortcode' );
}
