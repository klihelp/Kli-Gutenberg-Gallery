<?php
/**
 * @package klip-gutenberg-gallery
 * @version 1.0.0
 */
/*
Plugin Name: Klip - Gutenberg Gallery
Plugin URI: http://klipolis.com
Author: Klipolis
Version: 1.0.0
Author URI: http://klipolis.com
*/
    
    // ----------------------- ADMIN ----------------------------
    if ( is_admin () ):


        include_once 'admin_functions.php';

    // ----------------------- FRONT END ----------------------------
    else:

        include_once 'front_functions.php';

	endif;