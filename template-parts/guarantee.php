<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$options = ppf_get_options();

$has_support_channel = ! empty( $options['support_email'] ) || ( '1' === $options['whatsapp_enabled'] && ! empty( $options['whatsapp_number'] ) );

$items = array(
	array(
		'icon'  => '<path d="M12 2 4 5.5V11c0 5 3.4 8.7 8 10 4.6-1.3 8-5 8-10V5.5L12 2Z"/><path d="m9 12 2 2 4-4"/>',
		'title' => __( 'Garantia', 'pai-de-princesa' ),
		'body'  => ! empty( $options['offer_guarantee_text'] )
			? $options['offer_guarantee_text']
			: __( 'Caso o curso não faça sentido para você, poderá solicitar o cancelamento dentro do período de garantia informado no momento da compra.', 'pai-de-princesa' ),
	),
	array(
		'icon'  => '<path d="M12 8v4l3 3"/><circle cx="12" cy="12" r="9"/>',
		'title' => __( 'Acesso', 'pai-de-princesa' ),
		'body'  => ! empty( $options['offer_access_duration'] )
			? $options['offer_access_duration']
			: __( 'O prazo de acesso é o informado na oferta e confirmado no checkout.', 'pai-de-princesa' ),
	),
	array(
		'icon'  => '<path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5Z"/>',
		'title' => __( 'Suporte', 'pai-de-princesa' ),
		'body'  => $has_support_channel
			? __( 'Dúvidas sobre o curso podem ser tiradas por e-mail ou WhatsApp.', 'pai-de-princesa' )
			: __( 'Nossa equipe está disponível para ajudar em caso de dúvidas.', 'pai-de-princesa' ),
	),
);
?>
<section class="ppf-section ppf-guarantee">
	<div class="ppf-container ppf-container--narrow">
		<h2 class="ppf-section-title ppf-section-title--center"><?php esc_html_e( 'Você pode conhecer o conteúdo com tranquilidade.', 'pai-de-princesa' ); ?></h2>

		<div class="ppf-guarantee-grid">
			<?php foreach ( $items as $item ) : ?>
				<div class="ppf-guarantee-item js-reveal">
					<span class="ppf-guarantee-icon" aria-hidden="true">
						<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $item['icon']; ?></svg>
					</span>
					<h3><?php echo esc_html( $item['title'] ); ?></h3>
					<p><?php echo esc_html( $item['body'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
