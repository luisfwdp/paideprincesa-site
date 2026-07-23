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
		<?php esc_html_e( 'Quero cuidar com mais confianca', 'pai-de-princesa' ); ?>
	</a>
</div>
