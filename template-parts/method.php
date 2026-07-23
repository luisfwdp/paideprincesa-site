<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$pillars = array(
	array( __( 'Cuidado', 'pai-de-princesa' ), __( 'Aprender a cuidar com calma, atencao e respeito.', 'pai-de-princesa' ) ),
	array( __( 'Pratica', 'pai-de-princesa' ), __( 'Tecnicas simples que podem ser aplicadas no dia seguinte.', 'pai-de-princesa' ) ),
	array( __( 'Confianca', 'pai-de-princesa' ), __( 'Saber o que fazer sem depender sempre de outra pessoa.', 'pai-de-princesa' ) ),
	array( __( 'Conexao', 'pai-de-princesa' ), __( 'Transformar a rotina em momentos que sua filha vai lembrar.', 'pai-de-princesa' ) ),
);
?>
<section class="ppf-section ppf-method" id="metodo">
	<div class="ppf-container">
		<p class="ppf-eyebrow ppf-eyebrow--center"><?php esc_html_e( 'METODO PAI DE PRINCESA', 'pai-de-princesa' ); ?></p>
		<h2 class="ppf-section-title ppf-section-title--center"><?php esc_html_e( 'Um caminho simples, na ordem certa.', 'pai-de-princesa' ); ?></h2>

		<div class="ppf-method-grid">
			<?php foreach ( $pillars as $index => $pillar ) : ?>
				<div class="ppf-method-card js-reveal">
					<span class="ppf-method-number"><?php echo esc_html( str_pad( $index + 1, 2, '0', STR_PAD_LEFT ) ); ?></span>
					<h3><?php echo esc_html( $pillar[0] ); ?></h3>
					<p><?php echo esc_html( $pillar[1] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
