<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div id="ppf-cookie-consent" class="ppf-cookie-consent" hidden>
	<div class="ppf-cookie-consent-inner">
		<div class="ppf-cookie-consent-text">
			<p><strong><?php esc_html_e( 'Usamos cookies', 'pai-de-princesa' ); ?></strong></p>
			<p><?php esc_html_e( 'Usamos cookies necessários para o funcionamento do site e, com sua permissão, cookies de analytics, marketing e preferências para melhorar sua experiência. Você pode gerenciar suas escolhas a qualquer momento.', 'pai-de-princesa' ); ?> <a href="<?php echo esc_url( home_url( '/cookies' ) ); ?>"><?php esc_html_e( 'Saiba mais', 'pai-de-princesa' ); ?></a></p>
		</div>

		<div class="ppf-cookie-consent-options" id="ppf-cookie-options" hidden>
			<label><input type="checkbox" checked disabled /> <?php esc_html_e( 'Necessários (sempre ativos)', 'pai-de-princesa' ); ?></label>
			<label><input type="checkbox" id="ppf-consent-analytics" checked /> <?php esc_html_e( 'Analytics', 'pai-de-princesa' ); ?></label>
			<label><input type="checkbox" id="ppf-consent-marketing" checked /> <?php esc_html_e( 'Marketing', 'pai-de-princesa' ); ?></label>
			<label><input type="checkbox" id="ppf-consent-preferences" checked /> <?php esc_html_e( 'Preferências', 'pai-de-princesa' ); ?></label>
		</div>

		<div class="ppf-cookie-consent-actions">
			<button type="button" class="ppf-btn ppf-btn--ghost ppf-btn--small" id="ppf-cookie-customize"><?php esc_html_e( 'Personalizar', 'pai-de-princesa' ); ?></button>
			<button type="button" class="ppf-btn ppf-btn--ghost ppf-btn--small" id="ppf-cookie-reject"><?php esc_html_e( 'Rejeitar opcionais', 'pai-de-princesa' ); ?></button>
			<button type="button" class="ppf-btn ppf-btn--primary ppf-btn--small" id="ppf-cookie-accept"><?php esc_html_e( 'Aceitar todos', 'pai-de-princesa' ); ?></button>
		</div>
	</div>
</div>
