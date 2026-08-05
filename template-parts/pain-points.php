<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$cards = array(
	__( 'Tenho medo de machucar ao desembaraçar.', 'pai-de-princesa' ),
	__( 'Não sei quais produtos devo usar.', 'pai-de-princesa' ),
	__( 'Minha filha pede um penteado e eu não sei fazer.', 'pai-de-princesa' ),
	__( 'Fico perdido na hora de escolher a roupa.', 'pai-de-princesa' ),
	__( 'Sempre preciso pedir ajuda para outra pessoa.', 'pai-de-princesa' ),
	__( 'Quero participar mais, mas ainda não tenho prática.', 'pai-de-princesa' ),
);
?>
<section class="ppf-section ppf-pain">
	<div class="ppf-container ppf-container--narrow">
		<h2 class="ppf-section-title"><?php esc_html_e( 'Amor você já tem. O que faltava era alguém mostrar como fazer.', 'pai-de-princesa' ); ?></h2>
		<p class="ppf-section-lead"><?php esc_html_e( 'Pentear o cabelo, escolher os produtos certos, montar um look ou preparar sua filha para um dia especial pode parecer complicado quando ninguém ensinou você.', 'pai-de-princesa' ); ?></p>
		<p class="ppf-section-lead"><?php esc_html_e( 'Isso não significa que você seja menos pai. Significa apenas que algumas habilidades também precisam ser aprendidas.', 'pai-de-princesa' ); ?></p>
		<p class="ppf-section-lead"><?php esc_html_e( 'O Pai de Princesa foi criado para ensinar esses cuidados de maneira simples, respeitosa e possível de aplicar na vida real.', 'pai-de-princesa' ); ?></p>

		<div class="ppf-pain-grid">
			<?php foreach ( $cards as $card ) : ?>
				<div class="ppf-pain-card js-reveal">
					<p>&ldquo;<?php echo esc_html( $card ); ?>&rdquo;</p>
				</div>
			<?php endforeach; ?>
		</div>

		<p class="ppf-section-closing"><?php esc_html_e( 'Você não precisa virar cabeleireiro, stylist ou especialista. Precisa apenas aprender o suficiente para poder dizer: deixa comigo, filha.', 'pai-de-princesa' ); ?></p>
	</div>
</section>
