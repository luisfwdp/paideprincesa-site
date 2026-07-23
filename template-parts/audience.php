<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$items = array(
	__( 'E pai solteiro ou divorciado.', 'pai-de-princesa' ),
	__( 'Divide a guarda da filha.', 'pai-de-princesa' ),
	__( 'Fica sozinho com a filha em determinados dias.', 'pai-de-princesa' ),
	__( 'Quer participar mais da rotina.', 'pai-de-princesa' ),
	__( 'Nunca aprendeu a cuidar de cabelo.', 'pai-de-princesa' ),
	__( 'Quer ter mais autonomia.', 'pai-de-princesa' ),
	__( 'Deseja criar lembrancas especiais com a filha.', 'pai-de-princesa' ),
	__( 'Quer aprender sem julgamentos e sem complicacao.', 'pai-de-princesa' ),
);
?>
<section class="ppf-section ppf-audience" id="para-quem">
	<div class="ppf-container ppf-container--narrow">
		<h2 class="ppf-section-title"><?php esc_html_e( 'O Pai de Princesa e para voce que...', 'pai-de-princesa' ); ?></h2>

		<ul class="ppf-audience-list">
			<?php foreach ( $items as $item ) : ?>
				<li><?php echo esc_html( $item ); ?></li>
			<?php endforeach; ?>
		</ul>

		<p class="ppf-audience-note"><?php esc_html_e( 'O curso tambem pode ajudar avos, padrastos, responsaveis e outros cuidadores que participam ativamente da rotina de uma menina.', 'pai-de-princesa' ); ?></p>
	</div>
</section>
