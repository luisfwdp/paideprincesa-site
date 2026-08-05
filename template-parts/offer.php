<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$options = ppf_get_options();
$stack   = array(
	__( 'Curso completo Pai de Princesa.', 'pai-de-princesa' ),
	__( '5 modulos principais.', 'pai-de-princesa' ),
	__( 'Bonus Maquiagem de Princesa.', 'pai-de-princesa' ),
	__( 'Orientacoes com Prity Santos.', 'pai-de-princesa' ),
	__( 'Experiencias reais com Rodrigo Fabbris.', 'pai-de-princesa' ),
	__( 'Participacao de profissionais convidadas.', 'pai-de-princesa' ),
	__( 'Demonstracoes praticas.', 'pai-de-princesa' ),
	__( 'Acesso pelo celular, tablet ou computador.', 'pai-de-princesa' ),
	__( 'Conteudo para assistir no seu ritmo.', 'pai-de-princesa' ),
);
?>
<section class="ppf-section ppf-offer" id="oferta">
	<div class="ppf-container ppf-container--narrow">
		<p class="ppf-eyebrow ppf-eyebrow--center"><?php esc_html_e( 'CONDICAO DE LANCAMENTO', 'pai-de-princesa' ); ?></p>
		<h2 class="ppf-section-title ppf-section-title--center"><?php esc_html_e( 'Comece agora a participar com mais confianca.', 'pai-de-princesa' ); ?></h2>
		<p class="ppf-section-lead ppf-section-lead--center"><?php esc_html_e( 'Tenha acesso ao conteudo completo do Pai de Princesa e aprenda, no seu ritmo, habilidades que podem fazer diferenca na rotina com sua filha.', 'pai-de-princesa' ); ?></p>

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
					<?php if ( ! empty( $options['offer_price_original'] ) ) : ?>
						<p class="ppf-offer-price-tier ppf-offer-price-tier--original">
							<?php esc_html_e( 'De', 'pai-de-princesa' ); ?> <del><?php echo esc_html( $options['offer_price_original'] ); ?></del>
						</p>
					<?php endif; ?>
					<?php if ( ! empty( $options['offer_price_launch'] ) ) : ?>
						<p class="ppf-offer-price-tier ppf-offer-price-tier--launch">
							<?php esc_html_e( 'Preco oficial de lancamento:', 'pai-de-princesa' ); ?> <del><?php echo esc_html( $options['offer_price_launch'] ); ?></del>
						</p>
					<?php endif; ?>
					<p class="ppf-offer-price-main"><?php echo ppf_format_price_field( $options['offer_price_promo'] ); ?></p>
					<?php if ( ! empty( $options['offer_price_special_label'] ) ) : ?>
						<p class="ppf-offer-price-special"><?php echo esc_html( $options['offer_price_special_label'] ); ?></p>
					<?php endif; ?>
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
