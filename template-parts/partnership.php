<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$options = ppf_get_options();
$photo_id = $options['partnership_photo_id'] ?? '';

if ( ! $photo_id ) {
	return;
}
?>
<section class="ppf-section ppf-partnership">
	<div class="ppf-container">
		<div class="ppf-partnership-inner">
			<div class="ppf-partnership-photo">
				<?php echo wp_get_attachment_image( $photo_id, 'large', false, array( 'class' => 'ppf-partnership-image' ) ); ?>
			</div>
			<div class="ppf-partnership-content">
				<h2><?php esc_html_e( 'Técnica profissional. Paternidade real.', 'pai-de-princesa' ); ?></h2>
				<p><?php esc_html_e( 'Prity traz a expertise de quem entende de cuidados e beleza. Rodrigo vive a rotina real de um pai presente. Juntos, eles mostram que essa parceria é possível - que conhecimento técnico e paternidade genuína caminham lado a lado.', 'pai-de-princesa' ); ?></p>
			</div>
		</div>
	</div>
</section>
