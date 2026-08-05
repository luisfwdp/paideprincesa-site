<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! is_front_page() ) {
	return;
}
?>
<div class="ppf-sticky-cta">
	<a <?php echo ppf_checkout_cta_attrs( 'sticky_cta_click' ); ?>>
		<?php esc_html_e( 'Quero aprender a cuidar com confiança', 'pai-de-princesa' ); ?>
	</a>
</div>
