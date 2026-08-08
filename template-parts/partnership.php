<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$options  = ppf_get_options();
$photo_id = $options['partnership_photo_id'] ?? '';

if ( ! $photo_id ) {
	return;
}
?>
<section class="ppf-section ppf-partnership">
	<div class="ppf-container ppf-container--narrow">
		<p class="ppf-eyebrow ppf-eyebrow--center"><?php esc_html_e( 'UMA PARCERIA POSSÍVEL', 'pai-de-princesa' ); ?></p>
		<h2 class="ppf-section-title ppf-section-title--center"><?php esc_html_e( 'Técnica profissional. Paternidade real.', 'pai-de-princesa' ); ?></h2>
		<p class="ppf-section-lead ppf-section-lead--center">
			<?php esc_html_e( 'Prity traz a expertise de quem entende de cuidados e beleza. Rodrigo vive a rotina real de um pai presente. Juntos, eles mostram que essa parceria é possível: conhecimento técnico e paternidade genuína caminhando lado a lado.', 'pai-de-princesa' ); ?>
		</p>

		<div class="ppf-partnership-photo">
			<?php echo wp_get_attachment_image( $photo_id, 'large', false, array( 'class' => 'ppf-partnership-image' ) ); ?>
		</div>
	</div>
</section>
