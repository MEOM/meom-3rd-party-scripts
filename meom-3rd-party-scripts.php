<?php

/**
 * Plugin name: MEOM 3rd Party Scripts
 * Author: MEOM
 * Author URI: https://www.meom.fi/
 * Description: Create settings for 3rd party script like Google Tag Manager and Cookiebot.
 * Version: 1.1.1
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Load languages
 *
 * @return void
 */
function mtps_text_domain() {
    load_plugin_textdomain(
        'mtps',
        false,
        basename( dirname( __FILE__ ) ) . '/languages'
    );
}
add_action( 'plugins_loaded', 'mtps_text_domain' );

require_once dirname( __FILE__ ) . '/src/helpers.php';
require_once dirname( __FILE__ ) . '/src/dashboard.php';
require_once dirname( __FILE__ ) . '/src/script-rendering.php';
