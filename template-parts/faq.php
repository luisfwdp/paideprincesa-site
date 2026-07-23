<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$faqs = ppf_get_published_faqs();

if ( empty( $faqs ) ) {
	return;
}
?>
<section class="ppf-section ppf-faq" id="duvidas">
	<div class="ppf-container ppf-container--narrow">
		<h2 class="ppf-section-title ppf-section-title--center"><?php esc_html_e( 'Perguntas frequentes', 'pai-de-princesa' ); ?></h2>

		<div class="ppf-faq-list">
			<?php foreach ( $faqs as $faq ) : ?>
				<details class="ppf-faq-item js-faq-item">
					<summary><?php echo esc_html( get_the_title( $faq ) ); ?></summary>
					<div class="ppf-faq-answer"><?php echo wp_kses_post( wpautop( $faq->post_content ) ); ?></div>
				</details>
			<?php endforeach; ?>
		</div>
	</div>
</section>
