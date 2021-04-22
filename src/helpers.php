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
