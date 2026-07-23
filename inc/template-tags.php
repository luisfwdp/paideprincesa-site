<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Renderiza a logo. Usa o Custom Logo do WordPress (Aparencia > Personalizar
 * > Identidade do Site) quando o admin configurar um explicitamente - isso
 * sempre tem prioridade. Por padrao, usa a arte oficial fornecida pelo
 * cliente (recortada em assets/images/brand/, sem o perfil do Instagram
 * embutido, conforme diretriz de marca): variante bordo para fundos claros
 * ($theme = 'dark', usada no header) e variante creme para fundos escuros
 * ($theme = 'light', usada no footer).
 */
function ppf_render_logo( $theme = 'dark' ) {
	if ( has_custom_logo() ) {
		echo '<span class="ppf-logo ppf-logo--custom">';
		the_custom_logo();
		echo '</span>';
		return;
	}

	$image_file = 'light' === $theme ? 'logo-horizontal-cream.png' : 'logo-horizontal-burgundy.png';
	?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="ppf-logo ppf-logo--image ppf-logo--<?php echo esc_attr( $theme ); ?>" aria-label="<?php esc_attr_e( 'Pai de Princesa - pagina inicial', 'pai-de-princesa' ); ?>">
		<img src="<?php echo esc_url( ppf_brand_image_url( $image_file ) ); ?>" alt="Pai de Princesa" width="193" height="30" loading="eager" decoding="async" />
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
function ppf_checkout_cta_attrs( $event_name = 'section_cta_click', $extra_class = '' ) {
	return sprintf(
		'href="%s" class="ppf-btn ppf-btn--primary js-checkout-cta%s" data-analytics-event="%s"',
		esc_url( ppf_get_active_checkout_url() ?: '#oferta' ),
		$extra_class ? ' ' . esc_attr( $extra_class ) : '',
		esc_attr( $event_name )
	);
}

function ppf_format_price_field( $value ) {
	return $value !== '' ? esc_html( $value ) : esc_html__( 'Consulte a condicao disponivel no checkout.', 'pai-de-princesa' );
}
