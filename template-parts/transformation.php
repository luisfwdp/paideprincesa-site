<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$before = array(
	__( 'Inseguranca.', 'pai-de-princesa' ),
	__( 'Medo de errar.', 'pai-de-princesa' ),
	__( 'Dependencia de outras pessoas.', 'pai-de-princesa' ),
	__( 'Dificuldade com os cuidados basicos.', 'pai-de-princesa' ),
	__( 'Sensacao de nao conseguir participar.', 'pai-de-princesa' ),
);
$after = array(
	__( 'Mais confianca.', 'pai-de-princesa' ),
	__( 'Cuidados mais tranquilos.', 'pai-de-princesa' ),
	__( 'Penteados simples feitos por voce.', 'pai-de-princesa' ),
	__( 'Mais autonomia na rotina.', 'pai-de-princesa' ),
	__( 'Momentos de proximidade e conexao.', 'pai-de-princesa' ),
);
?>
<section class="ppf-section ppf-transformation">
	<div class="ppf-container">
		<h2 class="ppf-section-title ppf-section-title--center"><?php esc_html_e( "Do 'eu nao sei fazer' para o 'deixa comigo, filha'.", 'pai-de-princesa' ); ?></h2>

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
	</div>
</section>
