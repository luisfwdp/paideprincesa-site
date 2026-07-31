<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$before = array(
	__( 'Medo de errar.', 'pai-de-princesa' ),
	__( 'Inseguranca ao pentear.', 'pai-de-princesa' ),
	__( 'Duvidas sobre produtos.', 'pai-de-princesa' ),
	__( 'Dependencia de outras pessoas.', 'pai-de-princesa' ),
	__( 'Dificuldade para participar da rotina.', 'pai-de-princesa' ),
);
$after = array(
	__( 'Mais confianca nos cuidados.', 'pai-de-princesa' ),
	__( 'Mais tranquilidade ao desembaracar.', 'pai-de-princesa' ),
	__( 'Penteados simples feitos por voce.', 'pai-de-princesa' ),
	__( 'Mais autonomia na rotina.', 'pai-de-princesa' ),
	__( 'Mais momentos de proximidade entre pai e filha.', 'pai-de-princesa' ),
);
?>
<section class="ppf-section ppf-transformation">
	<div class="ppf-container">
		<p class="ppf-eyebrow ppf-eyebrow--center"><?php esc_html_e( 'A TRANSFORMACAO', 'pai-de-princesa' ); ?></p>
		<h2 class="ppf-section-title ppf-section-title--center"><?php esc_html_e( "Do 'eu nao sei fazer' para o 'deixa comigo, filha'.", 'pai-de-princesa' ); ?></h2>
		<p class="ppf-section-lead ppf-section-lead--center"><?php esc_html_e( 'O curso ajuda voce a sair da inseguranca e conquistar mais autonomia nos cuidados cotidianos da sua filha.', 'pai-de-princesa' ); ?></p>

		<div class="ppf-transformation-grid">
			<div class="ppf-transformation-col ppf-transformation-col--before js-reveal">
				<h3><?php esc_html_e( 'Antes', 'pai-de-princesa' ); ?></h3>
				<ul>
					<?php foreach ( $before as $item ) : ?>
						<li><?php echo esc_html( $item ); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<div class="ppf-transformation-col ppf-transformation-col--after js-reveal">
				<h3><?php esc_html_e( 'Depois', 'pai-de-princesa' ); ?></h3>
				<ul>
					<?php foreach ( $after as $item ) : ?>
						<li><?php echo esc_html( $item ); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>

		<p class="ppf-section-closing ppf-section-closing--light"><?php esc_html_e( 'Nao se trata de fazer tudo perfeito. Trata-se de estar presente e disposto a aprender.', 'pai-de-princesa' ); ?></p>
	</div>
</section>
