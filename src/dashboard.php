<?php
/**
 * Register mtps page under Settings
 * Create fields for GTM and Cookiebot IDs
 */

add_action( 'admin_menu', 'mtps_add_admin_menu' );
add_action( 'admin_init', 'mtps_settings_init' );

/**
 * Create the options page.
 *
 * @return void
 */
function mtps_add_admin_menu() {
    add_options_page( __( 'MEOM 3rd party scripts', 'mtps' ), __( '3rd party scripts', 'mtps' ), 'manage_options', 'meom-third-party-scripts', 'mtps_options_page' );
}

/**
 * Init settings.
 *
 * @return void
 */
function mtps_settings_init() {
    register_setting( 'mtps_plugin', 'mtps_settings' );

    add_settings_section(
        'mtps_plugin_section',
        __( 'Service IDs', 'mtps' ),
        'mtps_settings_section_callback',
        'mtps_plugin'
    );

    add_settings_field(
        'mtps_gtm_field',
        __( 'Google Tag Manager ID', 'mtps' ),
        'mtps_gtm_field_render',
        'mtps_plugin',
        'mtps_plugin_section'
    );

    add_settings_field(
        'mtps_cookiebot_field',
        __( 'Cookiebot ID', 'mtps' ),
        'mtps_cookiebot_field_render',
        'mtps_plugin',
        'mtps_plugin_section'
    );

    add_settings_field(
        'mtps_cookiebot_no_head',
        __( 'Do not add Cookiebot code to the head', 'mtps' ),
        'mtps_cookiebot_no_head_render',
        'mtps_plugin',
        'mtps_plugin_section'
    );
}

/**
 * Render input for GTM ID.
 *
 * @return void
 */
function mtps_gtm_field_render() {
    $field_value = mtps_get_field_value( 'mtps_gtm_field' );
    ?>
    <input type='text' name='mtps_settings[mtps_gtm_field]' value='<?php echo esc_attr( $field_value ); ?>' placeholder='GTM-xxxxxxxx'>
    <?php
}

/**
 * Render input for Cookiebot ID.
 *
 * @return void
 */
function mtps_cookiebot_field_render() {
    $field_value = mtps_get_field_value( 'mtps_cookiebot_field' );
    ?>
    <input type='text' name='mtps_settings[mtps_cookiebot_field]' value='<?php echo esc_attr( $field_value ); ?>' placeholder='xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx'>
    <?php
}

/**
 * Render input for Cookiebot No head.
 *
 * @return void
 */
function mtps_cookiebot_no_head_render() {
    $field_value = mtps_get_field_value( 'mtps_cookiebot_no_head' );
    ?>
    <input type='checkbox' name='mtps_settings[mtps_cookiebot_no_head]' value='1' <?php checked( 1, $field_value, true ); ?>>
    <p><?php esc_html_e( 'You can still use shortcode', 'mtps' ); ?> <em>[mtps-cookie-declaration]</em></p>
    <?php
}

/**
 * Render page description.
 *
 * @return void
 */
function mtps_settings_section_callback() {
    echo __( 'Add IDs for the services and the theme will include needed scripts to the page.', 'mtps' );
}

/**
 * Render the content for the settings page.
 *
 * @return void
 */
function mtps_options_page() {
    ?>
    <form action='options.php' method='post'>
        <h1><?php esc_html_e( 'MEOM 3rd party scripts', 'mtps' ); ?></h1>
        <?php
        settings_fields( 'mtps_plugin' );
        do_settings_sections( 'mtps_plugin' );
        submit_button();
        ?>
    </form>
    <?php
}
