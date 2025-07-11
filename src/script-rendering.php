<?php
/**
 * Create needed actions for rendering the scripts.
 */

/**
 * Add action for printing the head scripts.
 *
 * @return void
 */
function mtps_head_scripts() {
    // GTM settings.
    $gtm_field_value = mtps_get_field_value( 'mtps_gtm_field' );
    $gtm_id          = apply_filters( 'mtps_gtm_id', $gtm_field_value );
    // Cookiebot settings.
    $cookiebot_no_head     = mtps_get_field_value( 'mtps_cookiebot_no_head' );
    $cookiebot_field_value = mtps_get_field_value( 'mtps_cookiebot_field' );
    $cookiebot_id          = apply_filters( 'mtps_cookiebot_id', $cookiebot_field_value );

    if ( $cookiebot_id && $cookiebot_no_head !== '1' ) {
        // If we have Cookiebot in use, we need to set the consent mode.
        $cookiebot_consent_mode = "
            <!-- Google Consent Mode -->
            <script data-cookieconsent='ignore' async>
            window.dataLayer = window.dataLayer || [];
            function gtag() {
                dataLayer.push(arguments)
            }
            gtag('consent', 'default', {
                ad_personalization: 'denied',
                ad_storage: 'denied',
                ad_user_data: 'denied',
                analytics_storage: 'denied',
                functionality_storage: 'granted',
                personalization_storage: 'denied',
                security_storage: 'granted',
                wait_for_update: 500
            });
            gtag('set', 'ads_data_redaction', true);
            gtag('set', 'url_passthrough', false);
            </script>
            <!-- End Google Consent Mode-->
        ";
        $cookiebot_consent_mode = apply_filters( 'mtps_cookiebot_consent_mode', $cookiebot_consent_mode );
        // phpcs:disable
        echo $cookiebot_consent_mode;
        // phpcs:enable

        $current_locale = substr( get_locale(), 0, 2 );
        $cookiebot_code = '<script async id="Cookiebot" data-culture="' . esc_attr( $current_locale ) . '" src="https://consent.cookiebot.com/uc.js" data-cbid="' . esc_attr( $cookiebot_id ) . '" data-blockingmode="auto"></script>';
        $cookiebot_code = apply_filters( 'mtps_cookiebot_code', $cookiebot_code, $cookiebot_id );
        // phpcs:disable
        echo $cookiebot_code;
        // phpcs:enable
    }

    if ( $gtm_id ) {
        // If we have Cookiebot in use, we need data-cookieconsent attribute for the script.
        $scripts_ignore = $cookiebot_id ? ' data-cookieconsent="ignore"' : '';
        // Set code.
        $gtm_code =
        "<!-- Google Tag Manager -->
        <script" . $scripts_ignore . ">(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','" . $gtm_id . "');</script>
        <!-- End Google Tag Manager -->";
        $gtm_code = apply_filters( 'mtps_gtm_head_code', $gtm_code, $gtm_id );
        // phpcs:disable
        echo $gtm_code;
        // phpcs:enable
    }
}
add_action( 'wp_head', 'mtps_head_scripts', 0 );

/**
 * Add action for printing the "after opening <body>" scripts.
 *
 * @return void
 */
function mtps_body_open_scripts() {
    $gtm_field_value = mtps_get_field_value( 'mtps_gtm_field' );
    $gtm_id          = apply_filters( 'mtps_gtm_id', $gtm_field_value );
    if ( $gtm_id ) {
        $gtm_code =
        '<!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=' . esc_attr( $gtm_id ) . '"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->';
        $gtm_code = apply_filters( 'mtps_gtm_body_code', $gtm_code, $gtm_id );
        // phpcs:disable
        echo $gtm_code;
        // phpcs:enable
    }
}
add_action( 'wp_body_open', 'mtps_body_open_scripts', 0 );
