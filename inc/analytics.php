<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Google Tag Manager só é impresso no <head> quando o visitante já deu
 * consentimento de analytics/marketing nesta sessão (cookie ppf_cookie_consent
 * gravado pelo banner de LGPD). Em novas visitas sem decisão ainda tomada,
 * o main.js injeta o GTM dinamicamente assim que o consentimento é dado -
 * o script nunca carrega antes da escolha do usuário.
 */
function ppf_has_analytics_consent() {
	if ( empty( $_COOKIE['ppf_cookie_consent'] ) ) {
		return false;
	}
	$consent = json_decode( wp_unslash( $_COOKIE['ppf_cookie_consent'] ), true );
	return ! empty( $consent['analytics'] ) || ! empty( $consent['marketing'] );
}

function ppf_print_gtm_head() {
	$options = ppf_get_options();
	if ( empty( $options['gtm_id'] ) || ! ppf_has_analytics_consent() ) {
		return;
	}
	?>
	<script>
	(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','<?php echo esc_js( $options['gtm_id'] ); ?>');
	</script>
	<?php
}
add_action( 'wp_head', 'ppf_print_gtm_head', 1 );

function ppf_print_gtm_noscript() {
	$options = ppf_get_options();
	if ( empty( $options['gtm_id'] ) || ! ppf_has_analytics_consent() ) {
		return;
	}
	?>
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo esc_attr( $options['gtm_id'] ); ?>" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<?php
}
