<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$options = ppf_get_options();
$stack   = array(
	__( 'Curso completo Pai de Princesa.', 'pai-de-princesa' ),
	__( 'Acesso a todos os modulos.', 'pai-de-princesa' ),
	__( 'Atualizacoes durante o periodo de acesso.', 'pai-de-princesa' ),
	__( 'Materiais complementares confirmados.', 'pai-de-princesa' ),
	__( 'Bonus confirmados.', 'pai-de-princesa' ),
	__( 'Suporte, quando aplicavel.', 'pai-de-princesa' ),
);
?>
<section class="ppf-section ppf-offer" id="oferta">
	<div class="ppf-container ppf-container--narrow">
		<h2 class="ppf-section-title ppf-section-title--center"><?php esc_html_e( 'Comece hoje a participar com mais confianca.', 'pai-de-princesa' ); ?></h2>

		<div class="ppf-offer-panel js-reveal">
			<div class="ppf-offer-blob" aria-hidden="true"></div>

			<div class="ppf-offer-grid">
				<div class="ppf-offer-features">
					<span class="ppf-offer-ribbon"><?php esc_html_e( 'Oferta', 'pai-de-princesa' ); ?></span>
					<h3><?php esc_html_e( 'Acesso completo ao Pai de Princesa', 'pai-de-princesa' ); ?></h3>
					<ul class="ppf-offer-stack">
						<?php foreach ( $stack as $item ) : ?>
							<li><span aria-hidden="true">&#10003;</span> <?php echo esc_html( $item ); ?></li>
						<?php endforeach; ?>
					</ul>
				</div>

				<div class="ppf-offer-price-card">
					<?php if ( ! empty( $options['offer_price_original'] ) && ! empty( $options['offer_price_promo'] ) ) : ?>
						<p class="ppf-offer-price-original"><del><?php echo esc_html( $options['offer_price_original'] ); ?></del></p>
					<?php endif; ?>
					<p class="ppf-offer-price-main"><?php echo ppf_format_price_field( $options['offer_price_promo'] ); ?></p>
					<?php if ( ! empty( $options['offer_installments_count'] ) || ! empty( $options['offer_installment_value'] ) ) : ?>
						<p class="ppf-offer-installments">
							<?php echo esc_html( trim( $options['offer_installments_count'] . ' ' . $options['offer_installment_value'] ) ); ?>
						</p>
					<?php endif; ?>
					<?php if ( ! empty( $options['offer_access_duration'] ) ) : ?>
						<p class="ppf-offer-duration"><?php echo esc_html( $options['offer_access_duration'] ); ?></p>
					<?php endif; ?>

					<a <?php echo ppf_checkout_cta_attrs( 'begin_checkout', 'ppf-btn--gold' ); ?> id="ppf-offer-cta">
						<?php esc_html_e( 'Quero entrar para o Pai de Princesa', 'pai-de-princesa' ); ?>
					</a>
					<p class="ppf-offer-microcopy">
						<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="5" y="11" width="14" height="9" rx="2"/><path d="M8 11V7a4 4 0 0 1 8 0v4"/></svg>
						<?php esc_html_e( 'Voce sera direcionado para um ambiente seguro de pagamento.', 'pai-de-princesa' ); ?>
					</p>
				</div>
			</div>
		</div>
	</div>
</section>
