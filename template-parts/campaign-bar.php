<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$options = ppf_get_options();

if ( '1' !== $options['campaign_banner_enabled'] ) {
	return;
}

if ( ! empty( $options['campaign_ends_at'] ) && ! ppf_campaign_is_active( $options['campaign_ends_at'] ) ) {
	return;
}
?>
<div class="ppf-campaign-bar" data-campaign-ends="<?php echo esc_attr( $options['campaign_ends_at'] ); ?>">
	<p>
		<?php echo esc_html( $options['campaign_banner_text'] ); ?>
		<?php if ( ! empty( $options['campaign_ends_at'] ) ) : ?>
			<span class="ppf-campaign-countdown" data-countdown></span>
		<?php endif; ?>
	</p>
</div>
