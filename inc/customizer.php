<?php
/**
 * Customizer options.
 *
 * @package HedwigusJournal
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Default hero texts.
 *
 * @param string $key Setting id.
 * @return string
 */
function hedwigus_hero_default( $key ) {
	$defaults = array(
		'hedwigus_hero_eyebrow' => __( 'Catatan dari Hedwigus', 'hedwigus-journal' ),
		'hedwigus_hero_title'   => __( 'Teknologi, keluarga,', 'hedwigus-journal' ),
		'hedwigus_hero_accent'  => __( 'dan segalanya.', 'hedwigus-journal' ),
		'hedwigus_hero_lead'    => __( 'Cerita sehari-hari tentang AI, olahraga, hobi, dan hal-hal kecil yang bikin hidup lebih menarik. Ditulis pelan-pelan, dibaca santai.', 'hedwigus-journal' ),
	);
	return isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
}

/**
 * Get a hero text (Customizer value or default).
 *
 * @param string $key Setting id.
 * @return string
 */
function hedwigus_hero_text( $key ) {
	return get_theme_mod( $key, hedwigus_hero_default( $key ) );
}

add_action( 'customize_register', 'hedwigus_customize_register' );
/**
 * Register theme options.
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function hedwigus_customize_register( $wp_customize ) {
	$wp_customize->add_section( 'hedwigus_options', array(
		'title'       => __( 'Hedwigus Journal', 'hedwigus-journal' ),
		'description' => __( 'Theme appearance options.', 'hedwigus-journal' ),
		'priority'    => 160,
	) );

	$wp_customize->add_setting( 'hedwigus_accent', array(
		'default'           => '#1f6f5c',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'hedwigus_accent',
		array(
			'label'   => __( 'Accent color', 'hedwigus-journal' ),
			'section' => 'hedwigus_options',
		)
	) );

	$wp_customize->add_setting( 'hedwigus_dark_default', array(
		'default'           => false,
		'sanitize_callback' => 'wp_validate_boolean',
	) );
	$wp_customize->add_control( 'hedwigus_dark_default', array(
		'label'   => __( 'Start in dark mode', 'hedwigus-journal' ),
		'type'    => 'checkbox',
		'section' => 'hedwigus_options',
	) );

	$hero_fields = array(
		'hedwigus_hero_eyebrow' => array( __( 'Hero: small label', 'hedwigus-journal' ), 'text' ),
		'hedwigus_hero_title'   => array( __( 'Hero: headline', 'hedwigus-journal' ), 'text' ),
		'hedwigus_hero_accent'  => array( __( 'Hero: headline (italic second line)', 'hedwigus-journal' ), 'text' ),
		'hedwigus_hero_lead'    => array( __( 'Hero: intro paragraph', 'hedwigus-journal' ), 'textarea' ),
	);
	foreach ( $hero_fields as $id => $field ) {
		$wp_customize->add_setting( $id, array(
			'default'           => hedwigus_hero_default( $id ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( $id, array(
			'label'   => $field[0],
			'type'    => $field[1],
			'section' => 'hedwigus_options',
		) );
	}

	$wp_customize->add_setting( 'hedwigus_footer_text', array(
		'default'           => __( 'Hedwigus, Me, Family and Fun.', 'hedwigus-journal' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'hedwigus_footer_text', array(
		'label'   => __( 'Footer note', 'hedwigus-journal' ),
		'type'    => 'text',
		'section' => 'hedwigus_options',
	) );
}

add_action( 'wp_head', 'hedwigus_customizer_css', 20 );
/**
 * Output accent color overrides.
 */
function hedwigus_customizer_css() {
	$accent = get_theme_mod( 'hedwigus_accent', '#1f6f5c' );
	if ( ! $accent ) {
		return;
	}
	echo '<style id="hedwigus-accent">:root{--accent:' . esc_attr( $accent ) . '}</style>' . "\n";
}

add_action( 'customize_preview_init', 'hedwigus_customize_preview_js' );
/**
 * Live preview script (optional).
 */
function hedwigus_customize_preview_js() {
	wp_enqueue_script(
		'hedwigus-customizer',
		get_template_directory_uri() . '/assets/js/customizer.js',
		array( 'customize-preview' ),
		'1.0.0',
		true
	);
}
