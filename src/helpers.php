<?php
/**
 * Helpers for the plugin.
 */

function mtps_get_field_value( $field_name ) {
    $options = get_option( 'mtps_settings' );
    if ( isset( $options[ $field_name ] ) ) {
        return $options[ $field_name ];
    }
    return '';
}

/**
 * Cookie declaration shorcode.
 *
 * Usage: [mtps-cookie-declaration]
 *
 * @param array $atts Shortcode attributes (none at the moment).
 * @return void
 */
function mtps_cookie_declaration( $atts ) {
    $cookiebot_field_value = mtps_get_field_value( 'mtps_cookiebot_field' );
    $cookiebot_id          = apply_filters( 'mtps_cookiebot_id', $cookiebot_field_value );

    if ( $cookiebot_id ) {
        $current_locale = substr( get_locale(), 0, 2 );
        return '<script src="https://consent.cookiebot.com/' . esc_attr( $cookiebot_id ) . '/cd.js" data-culture="' . esc_attr( $current_locale ) . '" id="CookieDeclaration" async></script>'; // phpcs:ignore
    }

    return '';
}
add_shortcode( 'mtps-cookie-declaration', 'mtps_cookie_declaration' );
