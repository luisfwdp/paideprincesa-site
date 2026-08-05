<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function ppf_enqueue_assets() {
	wp_enqueue_style(
		'ppf-fonts',
		'https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Manrope:wght@400;500;600;700;800&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'ppf-style',
		PPF_THEME_URI . '/assets/css/style.css',
		array( 'ppf-fonts' ),
		PPF_THEME_VERSION
	);

	wp_enqueue_script(
		'ppf-main',
		PPF_THEME_URI . '/assets/js/main.js',
		array(),
		PPF_THEME_VERSION,
		true
	);

	$options = ppf_get_options();

	wp_localize_script( 'ppf-main', 'ppfSettings', array(
		'gtmId'            => $options['gtm_id'],
		'whatsappNumber'   => $options['whatsapp_number'],
		'whatsappMessage'  => $options['whatsapp_message'],
		'whatsappEnabled'  => (bool) $options['whatsapp_enabled'],
		'checkoutUrl'      => ppf_get_active_checkout_url(),
		'campaignEndsAt'   => $options['campaign_ends_at'],
		'consentCookieKey' => 'ppf_cookie_consent',
	) );
}
add_action( 'wp_enqueue_scripts', 'ppf_enqueue_assets' );

/**
 * DM Serif Display / Manrope são carregadas do Google Fonts por padrão.
 * Para reduzir dependência externa (LGPD/performance), o dev pode trocar por
 * next/font-style self-hosting baixando os arquivos woff2 para assets/fonts
 * e apontando @font-face em assets/css/style.css.
 */
