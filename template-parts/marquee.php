<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Faixa decorativa com frases curtas ja aprovadas em outros pontos da
 * pagina (tagline, CTA final, pilares do metodo) - nao inventa nenhuma
 * afirmacao nova. Marcada aria-hidden porque e puramente decorativa e o
 * conteudo real ja esta acessivel em outras secoes da pagina.
 */
$phrases = array(
	__( 'Talvez ninguem tenha ensinado voce.', 'pai-de-princesa' ),
	__( 'Mas voce pode aprender.', 'pai-de-princesa' ),
	__( 'Deixa comigo, filha.', 'pai-de-princesa' ),
	__( 'Cuidado. Pratica. Confianca. Conexao.', 'pai-de-princesa' ),
	__( 'Presenca que fica.', 'pai-de-princesa' ),
	__( 'Pequenos cuidados, grandes momentos.', 'pai-de-princesa' ),
);
?>
<section class="ppf-marquee" aria-hidden="true">
	<div class="ppf-marquee-track">
		<?php for ( $repeat = 0; $repeat < 2; $repeat++ ) : ?>
			<?php foreach ( $phrases as $phrase ) : ?>
				<span class="ppf-marquee-item">
					<?php echo esc_html( $phrase ); ?>
					<span class="ppf-marquee-dot">&#10022;</span>
				</span>
			<?php endforeach; ?>
		<?php endfor; ?>
	</div>
</section>
