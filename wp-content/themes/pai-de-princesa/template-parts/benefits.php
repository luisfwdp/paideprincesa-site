<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$items = array(
	__( 'Mais seguranca nos dias em que estiverem sozinhos.', 'pai-de-princesa' ),
	__( 'Menos dependencia de outras pessoas.', 'pai-de-princesa' ),
	__( 'Mais participacao na rotina.', 'pai-de-princesa' ),
	__( 'Mais tranquilidade para a filha.', 'pai-de-princesa' ),
	__( 'Momentos que fortalecem a relacao.', 'pai-de-princesa' ),
	__( 'Conhecimento que continua util em diferentes fases.', 'pai-de-princesa' ),
);
?>
<section class="ppf-section ppf-benefits">
	<div class="ppf-container">
		<h2 class="ppf-section-title ppf-section-title--center"><?php esc_html_e( 'Voce aprende uma habilidade. Sua filha ganha mais um pai presente.', 'pai-de-princesa' ); ?></h2>

		<div class="ppf-benefits-grid">
			<?php foreach ( $items as $item ) : ?>
				<div class="ppf-benefit-item">
					<span class="ppf-benefit-check" aria-hidden="true">&#10003;</span>
					<p><?php echo esc_html( $item ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
