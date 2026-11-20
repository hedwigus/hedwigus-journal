<?php
/**
 * Google Analytics and Google AdSense integration.
 *
 * IDs are configured in Appearance > Customize > Analytics & Ads.
 * Nothing is hard-coded: leave a field blank and the tag is not loaded.
 *
 * @package HedwigusJournal
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Whitelist a Google Analytics / GTM ID.
 *
 * @param string $value Raw setting value.
 * @return string Sanitized ID or empty string.
 */
function hedwigus_sanitize_analytics_id( $value ) {
	$value = strtoupper( trim( (string) $value ) );
	$value = preg_replace( '/[^A-Z0-9-]/', '', $value );

	if ( preg_match( '/^(G-[A-Z0-9]{6,}|UA-\d+-\d+|GTM-[A-Z0-9]{4,})$/', $value ) ) {
		return $value;
	}
	return '';
}

/**
 * Whitelist an AdSense publisher ID.
 *
 * @param string $value Raw setting value.
 * @return string Sanitized ID or empty string.
 */
function hedwigus_sanitize_adsense_id( $value ) {
	$value = strtolower( trim( (string) $value ) );
	return preg_match( '/^ca-pub-\d{8,}$/', $value ) ? $value : '';
}

add_action( 'customize_register', 'hedwigus_integrations_customize_register' );
/**
 * Add the Analytics & Ads section.
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function hedwigus_integrations_customize_register( $wp_customize ) {
	$wp_customize->add_section( 'hedwigus_integrations', array(
		'title'       => __( 'Analytics & Ads', 'hedwigus-journal' ),
		'description' => __( 'Paste your own IDs here. Leave blank to disable a tag.', 'hedwigus-journal' ),
		'priority'    => 170,
	) );

	$wp_customize->add_setting( 'hedwigus_ga_id', array(
		'default'           => '',
		'sanitize_callback' => 'hedwigus_sanitize_analytics_id',
	) );
	$wp_customize->add_control( 'hedwigus_ga_id', array(
		'label'       => __( 'Google Analytics ID', 'hedwigus-journal' ),
		'description' => __( 'GA4 (G-XXXXXXXXXX), Universal Analytics (UA-XXXXX-X), or GTM (GTM-XXXXXXX).', 'hedwigus-journal' ),
		'type'        => 'text',
		'section'     => 'hedwigus_integrations',
	) );

	$wp_customize->add_setting( 'hedwigus_adsense_id', array(
		'default'           => '',
		'sanitize_callback' => 'hedwigus_sanitize_adsense_id',
	) );
	$wp_customize->add_control( 'hedwigus_adsense_id', array(
		'label'       => __( 'AdSense Publisher ID', 'hedwigus-journal' ),
		'description' => __( 'Format: ca-pub-1234567890123456', 'hedwigus-journal' ),
		'type'        => 'text',
		'section'     => 'hedwigus_integrations',
	) );

	$wp_customize->add_setting( 'hedwigus_adsense_slot', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'hedwigus_adsense_slot', array(
		'label'       => __( 'Default Ad Slot', 'hedwigus-journal' ),
		'description' => __( 'Used by the [hedwigus_ad] shortcode when no slot is given.', 'hedwigus-journal' ),
		'type'        => 'text',
		'section'     => 'hedwigus_integrations',
	) );

	$wp_customize->add_setting( 'hedwigus_exclude_admins', array(
		'default'           => true,
		'sanitize_callback' => 'wp_validate_boolean',
	) );
	$wp_customize->add_control( 'hedwigus_exclude_admins', array(
		'label'       => __( 'Skip tags for administrators', 'hedwigus-journal' ),
		'description' => __( 'Recommended: keeps your own visits out of analytics and ad impressions.', 'hedwigus-journal' ),
		'type'        => 'checkbox',
		'section'     => 'hedwigus_integrations',
	) );

	$wp_customize->add_setting( 'hedwigus_custom_head', array(
		'default'           => '',
		'sanitize_callback' => 'wp_kses_post',
	) );
	$wp_customize->add_control( 'hedwigus_custom_head', array(
		'label'       => __( 'Additional &lt;head&gt; tags', 'hedwigus-journal' ),
		'description' => __( 'Any other verification or meta tag. Pasted HTML is filtered for safety.', 'hedwigus-journal' ),
		'type'        => 'textarea',
		'section'     => 'hedwigus_integrations',
	) );

	$wp_customize->add_setting( 'hedwigus_custom_body', array(
		'default'           => '',
		'sanitize_callback' => 'wp_kses_post',
	) );
	$wp_customize->add_control( 'hedwigus_custom_body', array(
		'label'       => __( 'Tags after &lt;body&gt;', 'hedwigus-journal' ),
		'description' => __( 'For tags that must appear immediately after the opening body tag.', 'hedwigus-journal' ),
		'type'        => 'textarea',
		'section'     => 'hedwigus_integrations',
	) );
}

/**
 * Whether tracking tags should be printed for this visitor.
 *
 * @return bool
 */
function hedwigus_tracking_enabled() {
	$skip_admins = (bool) get_theme_mod( 'hedwigus_exclude_admins', true );
	if ( $skip_admins && is_user_logged_in() && current_user_can( 'manage_options' ) ) {
		return false;
	}
	return true;
}

add_action( 'wp_head', 'hedwigus_output_analytics', 2 );
/**
 * Print the Google Analytics / GTM tag.
 */
function hedwigus_output_analytics() {
	if ( ! hedwigus_tracking_enabled() ) {
		return;
	}

	$id = hedwigus_sanitize_analytics_id( get_theme_mod( 'hedwigus_ga_id', '' ) );
	if ( '' === $id ) {
		return;
	}

	$json = wp_json_encode( $id );

	if ( 0 === strpos( $id, 'GTM-' ) ) {
		printf(
			"\n<!-- Google Tag Manager — Hedwigus Journal -->\n<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer',%s);</script>\n",
			$json // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		);
		return;
	}

	printf(
		"\n<!-- Google Analytics — Hedwigus Journal -->\n<script async src=\"https://www.googletagmanager.com/gtag/js?id=%1\$s\"></script>\n<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config',%2\$s);</script>\n",
		esc_attr( $id ),
		$json // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	);
}

add_action( 'wp_body_open', 'hedwigus_output_gtm_noscript' );
/**
 * GTM requires a noscript iframe just after the opening body tag.
 */
function hedwigus_output_gtm_noscript() {
	if ( ! hedwigus_tracking_enabled() ) {
		return;
	}

	$id = hedwigus_sanitize_analytics_id( get_theme_mod( 'hedwigus_ga_id', '' ) );
	if ( 0 !== strpos( $id, 'GTM-' ) ) {
		return;
	}

	printf(
		"\n<noscript><iframe src=\"https://www.googletagmanager.com/ns.html?id=%1\$s\" height=\"0\" width=\"0\" style=\"display:none;visibility:hidden\"></iframe></noscript>\n",
		esc_attr( $id )
	);
}

add_action( 'wp_head', 'hedwigus_output_adsense', 3 );
/**
 * Print the AdSense publisher script in the head.
 */
function hedwigus_output_adsense() {
	if ( ! hedwigus_tracking_enabled() ) {
		return;
	}

	$client = hedwigus_sanitize_adsense_id( get_theme_mod( 'hedwigus_adsense_id', '' ) );
	if ( '' === $client ) {
		return;
	}

	printf(
		"\n<!-- Google AdSense — Hedwigus Journal -->\n<script async src=\"https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=%1\$s\" crossorigin=\"anonymous\"></script>\n",
		esc_attr( $client )
	);
}

add_action( 'wp_head', 'hedwigus_output_custom_head', 4 );
/**
 * Print any extra head tag configured in the Customizer.
 */
function hedwigus_output_custom_head() {
	if ( ! hedwigus_tracking_enabled() ) {
		return;
	}
	$tags = get_theme_mod( 'hedwigus_custom_head', '' );
	if ( '' === trim( (string) $tags ) ) {
		return;
	}
	echo "\n<!-- Custom head tags — Hedwigus Journal -->\n" . wp_kses_post( $tags ) . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

add_action( 'wp_body_open', 'hedwigus_output_custom_body', 4 );
/**
 * Print any extra body-open tag configured in the Customizer.
 */
function hedwigus_output_custom_body() {
	if ( ! hedwigus_tracking_enabled() ) {
		return;
	}
	$tags = get_theme_mod( 'hedwigus_custom_body', '' );
	if ( '' === trim( (string) $tags ) ) {
		return;
	}
	echo "\n<!-- Custom body tags — Hedwigus Journal -->\n" . wp_kses_post( $tags ) . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

add_shortcode( 'hedwigus_ad', 'hedwigus_ad_shortcode' );
/**
 * Render an in-content responsive AdSense unit: [hedwigus_ad slot="1234567890"].
 *
 * @param array $atts Shortcode attributes.
 * @return string
 */
function hedwigus_ad_shortcode( $atts ) {
	if ( ! hedwigus_tracking_enabled() ) {
		return '';
	}

	$atts = shortcode_atts( array( 'slot' => '' ), $atts, 'hedwigus_ad' );

	$client = hedwigus_sanitize_adsense_id( get_theme_mod( 'hedwigus_adsense_id', '' ) );
	$slot   = preg_replace( '/[^0-9]/', '', (string) $atts['slot'] );
	if ( '' === $slot ) {
		$slot = preg_replace( '/[^0-9]/', '', (string) get_theme_mod( 'hedwigus_adsense_slot', '' ) );
	}

	if ( '' === $client || '' === $slot ) {
		return '';
	}

	return sprintf(
		'<div class="hj-ad" align="center"><ins class="adsbygoogle" style="display:block" data-ad-client="%1$s" data-ad-slot="%2$s" data-ad-format="auto" data-full-width-responsive="true"></ins><script>(adsbygoogle=window.adsbygoogle||[]).push({});</script></div>',
		esc_attr( $client ),
		esc_attr( $slot )
	);
}
