<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="ppf-section ppf-final-cta">
	<div class="ppf-container ppf-container--narrow">
		<h2 class="ppf-section-title ppf-section-title--center ppf-section-title--light"><?php esc_html_e( 'Talvez ninguem tenha ensinado voce. Agora voce pode aprender.', 'pai-de-princesa' ); ?></h2>
		<p class="ppf-final-cta-text"><?php esc_html_e( 'Comece com o basico, pratique no seu ritmo e esteja mais preparado para os pequenos momentos que fazem parte da vida da sua filha.', 'pai-de-princesa' ); ?></p>
		<a <?php echo ppf_checkout_cta_attrs( 'final_cta_click', 'ppf-btn--gold' ); ?>>
			<?php esc_html_e( 'Quero ser um Pai de Princesa mais presente', 'pai-de-princesa' ); ?>
		</a>
	</div>
</section>
