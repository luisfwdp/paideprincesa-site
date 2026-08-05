<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Faixa decorativa com frases curtas já aprovadas em outros pontos da
 * página (tagline, CTA final, pilares do método) - não inventa nenhuma
 * afirmação nova. Marcada aria-hidden porque é puramente decorativa e o
 * conteúdo real já está acessível em outras seções da página.
 */
$phrases = array(
	__( 'Talvez ninguém tenha ensinado você.', 'pai-de-princesa' ),
	__( 'Mas você pode aprender.', 'pai-de-princesa' ),
	__( 'Deixa comigo, filha.', 'pai-de-princesa' ),
	__( 'Cuidado. Prática. Confiança. Conexão.', 'pai-de-princesa' ),
	__( 'Presença que fica.', 'pai-de-princesa' ),
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
