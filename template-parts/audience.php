<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$items = array(
	__( 'É pai solteiro ou separado.', 'pai-de-princesa' ),
	__( 'Divide a rotina ou a guarda da filha.', 'pai-de-princesa' ),
	__( 'Fica sozinho com a filha em alguns dias.', 'pai-de-princesa' ),
	__( 'Quer participar mais dos cuidados cotidianos.', 'pai-de-princesa' ),
	__( 'Nunca aprendeu a cuidar de cabelo infantil.', 'pai-de-princesa' ),
	__( 'Quer saber fazer penteados simples.', 'pai-de-princesa' ),
	__( 'Deseja ter mais autonomia.', 'pai-de-princesa' ),
	__( 'Quer aprender sem julgamentos.', 'pai-de-princesa' ),
	__( 'Deseja construir mais momentos de conexão com a filha.', 'pai-de-princesa' ),
);
?>
<section class="ppf-section ppf-audience" id="para-quem">
	<div class="ppf-container ppf-container--narrow">
		<h2 class="ppf-section-title"><?php esc_html_e( 'O Pai de Princesa é para você que...', 'pai-de-princesa' ); ?></h2>

		<ul class="ppf-audience-list">
			<?php foreach ( $items as $item ) : ?>
				<li><?php echo esc_html( $item ); ?></li>
			<?php endforeach; ?>
		</ul>

		<p class="ppf-audience-note"><?php esc_html_e( 'O conteúdo também pode ajudar padrastos, avós, tios e outros responsáveis que participam ativamente da rotina de uma menina.', 'pai-de-princesa' ); ?></p>
	</div>
</section>
