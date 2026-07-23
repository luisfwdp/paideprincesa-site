<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$options = ppf_get_options();
?>
<section class="ppf-section ppf-guarantee">
	<div class="ppf-container ppf-container--narrow ppf-guarantee-inner">
		<h2 class="ppf-section-title"><?php esc_html_e( 'Voce pode conhecer o conteudo com tranquilidade.', 'pai-de-princesa' ); ?></h2>
		<?php if ( ! empty( $options['offer_guarantee_text'] ) ) : ?>
			<p><?php echo esc_html( $options['offer_guarantee_text'] ); ?></p>
		<?php else : ?>
			<p><?php esc_html_e( 'Caso o curso nao faca sentido para voce, podera solicitar o cancelamento dentro do periodo de garantia informado no momento da compra.', 'pai-de-princesa' ); ?></p>
		<?php endif; ?>
	</div>
</section>
