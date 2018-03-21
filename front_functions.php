<?php
/** 
 * Front-End functions
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
            if ( ! is_main_query() ) {
                return $content;
            }
            // Find gallery blocks
            $regexp = "<ul\s[^>]*wp-block-gallery[^>]*>(.*)<\/ul>";
            if ( preg_match_all("/$regexp/imsU", $content, $matches, PREG_PATTERN_ORDER) ) {
                $updated = false;
                foreach($matches[0] as $key => $match) {
                    // Find images ids
                    if ( preg_match_all('/\sdata-id="(.*)"/imsU', $match, $match_ids, PREG_PATTERN_ORDER) ) {
                        /**
                         * We are still before do_shortcode , which has filter priority 10
                         */
                        $matches[1][$key] = '[gallery ids="'. implode(',', $match_ids[1]) .'"]';
                        $updated = true;
                    }
                }
                var_dump($updated);
                if ($updated) {
                    $content = str_replace($matches[0], $matches[1], $content);
                }
            }
            return $content;
        }, 9);  
    }

