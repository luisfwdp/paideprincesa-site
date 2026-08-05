<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$items = array(
	__( 'Mais segurança nos dias em que estiverem sozinhos.', 'pai-de-princesa' ),
	__( 'Menos dependência de outras pessoas.', 'pai-de-princesa' ),
	__( 'Mais tranquilidade para cuidar do cabelo.', 'pai-de-princesa' ),
	__( 'Penteados simples feitos por você.', 'pai-de-princesa' ),
	__( 'Mais participação na escolha das roupas.', 'pai-de-princesa' ),
	__( 'Mais confiança para momentos especiais.', 'pai-de-princesa' ),
	__( 'Mais proximidade entre pai e filha.', 'pai-de-princesa' ),
	__( 'Conhecimentos que podem acompanhar diferentes fases da infância.', 'pai-de-princesa' ),
);
?>
<section class="ppf-section ppf-benefits">
	<div class="ppf-container">
		<h2 class="ppf-section-title ppf-section-title--center"><?php esc_html_e( 'Você aprende novas habilidades. Sua filha ganha um pai ainda mais presente.', 'pai-de-princesa' ); ?></h2>
		<p class="ppf-section-lead ppf-section-lead--center"><?php esc_html_e( 'Cada cuidado aprendido representa mais autonomia para você e mais um momento de proximidade entre vocês.', 'pai-de-princesa' ); ?></p>

		<div class="ppf-benefits-grid">
			<?php foreach ( $items as $item ) : ?>
				<div class="ppf-benefit-item js-reveal">
					<span class="ppf-benefit-check" aria-hidden="true">&#10003;</span>
					<p><?php echo esc_html( $item ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>

		<p class="ppf-section-closing ppf-section-closing--center"><?php esc_html_e( 'Pequenos cuidados podem se transformar em grandes lembranças.', 'pai-de-princesa' ); ?></p>
	</div>
</section>
