<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$cards = array(
	__( 'Tenho medo de machucar ao pentear.', 'pai-de-princesa' ),
	__( 'Nao sei quais produtos usar.', 'pai-de-princesa' ),
	__( 'Fico perdido para escolher a roupa.', 'pai-de-princesa' ),
	__( 'Sempre preciso pedir ajuda para outra pessoa.', 'pai-de-princesa' ),
	__( 'Quero participar mais, mas nao tenho pratica.', 'pai-de-princesa' ),
	__( 'Minha filha pede um penteado e eu nao sei fazer.', 'pai-de-princesa' ),
);
?>
<section class="ppf-section ppf-pain">
	<div class="ppf-container ppf-container--narrow">
		<h2 class="ppf-section-title"><?php esc_html_e( 'Voce ama sua filha. So nao sabe por onde comecar em alguns momentos.', 'pai-de-princesa' ); ?></h2>
		<p class="ppf-section-lead"><?php esc_html_e( 'Prender o cabelo, escolher uma roupa, desembaracar sem machucar ou preparar sua filha para um dia especial pode parecer dificil quando ninguem ensinou voce a fazer isso.', 'pai-de-princesa' ); ?></p>
		<p class="ppf-section-lead"><?php esc_html_e( 'E esta tudo bem nao saber. O que faz a diferenca e estar disposto a aprender.', 'pai-de-princesa' ); ?></p>

		<div class="ppf-pain-grid">
			<?php foreach ( $cards as $card ) : ?>
				<div class="ppf-pain-card">
					<p>&ldquo;<?php echo esc_html( $card ); ?>&rdquo;</p>
				</div>
			<?php endforeach; ?>
		</div>

		<p class="ppf-section-closing"><?php esc_html_e( 'Voce nao precisa fazer tudo perfeito. Precisa apenas saber o suficiente para poder dizer: deixa comigo, filha.', 'pai-de-princesa' ); ?></p>
	</div>
</section>
