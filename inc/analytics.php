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

/**
 * Meta Pixel (Facebook/Instagram Ads): é uma tag de marketing, então só
 * carrega com consentimento de marketing (não basta analytics) - mesma regra
 * de carregamento condicional do GTM acima, para manter conformidade com o
 * banner de cookies (LGPD).
 */
function ppf_has_marketing_consent() {
	if ( empty( $_COOKIE['ppf_cookie_consent'] ) ) {
		return false;
	}
	$consent = json_decode( wp_unslash( $_COOKIE['ppf_cookie_consent'] ), true );
	return ! empty( $consent['marketing'] );
}

function ppf_print_meta_pixel_head() {
	$options = ppf_get_options();
	if ( empty( $options['meta_pixel_id'] ) || ! ppf_has_marketing_consent() ) {
		return;
	}
	?>
	<script>
	!function(f,b,e,v,n,t,s)
	{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	n.queue=[];t=b.createElement(e);t.async=!0;
	t.src=v;s=b.getElementsByTagName(e)[0];
	s.parentNode.insertBefore(t,s)}(window, document,'script',
	'https://connect.facebook.net/en_US/fbevents.js');
	fbq('init', '<?php echo esc_js( $options['meta_pixel_id'] ); ?>');
	fbq('track', 'PageView');
	</script>
	<noscript><img height="1" width="1" style="display:none"
	src="https://www.facebook.com/tr?id=<?php echo esc_attr( $options['meta_pixel_id'] ); ?>&ev=PageView&noscript=1"
	/></noscript>
	<?php
}
add_action( 'wp_head', 'ppf_print_meta_pixel_head', 1 );
