<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Renderiza a logo. Usa o Custom Logo do WordPress (Aparencia > Personalizar
 * > Identidade do Site) quando configurado - assim o cliente troca a logo
 * sozinho, sem dev, assim que o arquivo oficial (SVG) estiver aprovado.
 * Enquanto isso, cai num simbolo provisorio (colete estilizado) + wordmark,
 * sem o perfil do Instagram embutido, conforme diretriz de marca.
 */
function ppf_render_logo( $theme = 'dark' ) {
	if ( has_custom_logo() ) {
		echo '<span class="ppf-logo ppf-logo--custom">';
		the_custom_logo();
		echo '</span>';
		return;
	}
	?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="ppf-logo ppf-logo--fallback ppf-logo--<?php echo esc_attr( $theme ); ?>" aria-label="<?php esc_attr_e( 'Pai de Princesa - pagina inicial', 'pai-de-princesa' ); ?>">
		<svg class="ppf-logo-symbol" width="30" height="30" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
			<path d="M20 8 L48 8 L50 22 L52 8 L80 8 L68 46 L68 92 L32 92 L32 46 Z" fill="currentColor" />
			<circle cx="50" cy="34" r="4" fill="var(--ppf-blush,#fcf1ef)" />
			<circle cx="50" cy="48" r="4" fill="var(--ppf-blush,#fcf1ef)" />
			<circle cx="50" cy="62" r="4" fill="var(--ppf-blush,#fcf1ef)" />
		</svg>
		<span class="ppf-logo-wordmark"><?php esc_html_e( 'Pai de Princesa', 'pai-de-princesa' ); ?></span>
	</a>
	<?php
}

/**
 * Link do WhatsApp com numero e mensagem configurados no painel de opcoes.
 */
function ppf_whatsapp_url() {
	$options = ppf_get_options();
	if ( empty( $options['whatsapp_number'] ) ) {
		return '';
	}
	return 'https://wa.me/' . $options['whatsapp_number'] . '?text=' . rawurlencode( $options['whatsapp_message'] );
}

/**
 * Atributos comuns para os botoes de CTA que levam ao checkout. A URL final
 * e resolvida/ajustada em JS (main.js) para preservar UTMs e disparar o
 * evento correto no dataLayer - aqui deixamos apenas os data-attributes.
 */
function ppf_checkout_cta_attrs( $event_name = 'section_cta_click' ) {
	return sprintf(
		'href="%s" class="ppf-btn ppf-btn--primary js-checkout-cta" data-analytics-event="%s"',
		esc_url( ppf_get_active_checkout_url() ?: '#oferta' ),
		esc_attr( $event_name )
	);
}

function ppf_format_price_field( $value ) {
	return $value !== '' ? esc_html( $value ) : esc_html__( 'Consulte a condicao disponivel no checkout.', 'pai-de-princesa' );
}
