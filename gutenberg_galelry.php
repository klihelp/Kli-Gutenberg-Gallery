<?php
/**
* WordPress Gutenberg gallery block fix to the gallery shortcode.
*/

/**
* Replace Gutenberg gallery block with the gallery shortcode.
* Tested until Gutenberg 2.4
*
* @param $the_content
*
* @return string
*
*/
if ( ! is_admin() ) {
	add_filter('the_content', function($content) {
		if ( ! is_main_query() || ! strpos($content, 'wp-block-gallery') ) {
			return $content;
		}

		// Find gallery blocks
		$regexp = "<ul\s[^>]*wp-block-gallery[^>]*>(.*)<\/ul>";
		if (preg_match_all("/$regexp/imsU", $content, $matches, PREG_PATTERN_ORDER)) {
			foreach($matches[0] as $key => $match) {
				// Find images ids
				if ( preg_match_all('/$\sdata-id="(.*)"/imsU', $match, $match_ids, PREG_PATTERN_ORDER) ) {
					$matches[1][$key] = do_shortcode( '[gallery ids="'. implode(',', $match_ids[1]) .'"]' );
				}
			}
			$content = str_replace($matches[0], $matches[1], $content);
		}
		return $content;
	}, 9);	
}
