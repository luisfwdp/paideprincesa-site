<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Painel "Pai de Princesa" em wp-admin: centraliza tudo que muda com
 * frequencia e nao deveria exigir um dev - links de checkout, WhatsApp,
 * datas de campanha, dados da oferta, GTM e a foto do hero. Guardado como
 * um unico option serializado (ppf_options) para simplificar migracao/backup.
 */

function ppf_option_defaults() {
	return array(
		'checkout_provider'        => 'kiwify',
		'kiwify_checkout_url'      => '',
		'greenn_checkout_url'      => '',
		'campaign_checkout_url'    => '',
		'campaign_ends_at'         => '',
		'campaign_banner_enabled'  => '0',
		'campaign_banner_text'     => 'Condicao especial de lancamento por tempo limitado.',
		'member_area_url'          => '',
		'whatsapp_enabled'         => '1',
		'whatsapp_number'          => '',
		'whatsapp_message'         => 'Ola! Tenho uma duvida sobre o curso Pai de Princesa.',
		'support_email'            => '',
		'gtm_id'                   => '',
		'clarity_id'               => '',
		'offer_price_original'     => '',
		'offer_price_launch'       => '',
		'offer_price_promo'        => '',
		'offer_price_special_label'=> 'Oferta especial para os primeiros 30 compradores',
		'offer_installments_count' => '',
		'offer_installment_value'  => '',
		'offer_access_duration'    => '',
		'offer_guarantee_text'     => '',
		'hero_photo_id'            => '',
		'company_legal_name'       => '',
		'company_cnpj'             => '',
		'instagram_url'            => 'https://www.instagram.com/paideprincesa.oficial/',
	);
}

function ppf_get_options() {
	$saved = get_option( 'ppf_options', array() );
	return wp_parse_args( $saved, ppf_option_defaults() );
}

/**
 * Condicao de lancamento confirmada: preco cheio R$ 497, preco oficial de
 * lancamento R$ 297, oferta especial R$ 197 (sem contador de vagas - ver
 * decisao no historico do projeto: nao exibimos quantidade "restante" de
 * vagas porque o checkout e externo e o site nao tem como contar vendas de
 * verdade). So sobrescreve campos que ainda estao vazios ou com o valor
 * anterior desta mesma migracao automatica - nunca um preco editado a mao.
 */
function ppf_migrate_launch_price_v2() {
	if ( get_option( 'ppf_launch_price_migrated_v2' ) ) {
		return;
	}

	$options = get_option( 'ppf_options', array() );

	if ( in_array( $options['offer_price_original'] ?? '', array( '', 'R$ 997,00' ), true ) ) {
		$options['offer_price_original'] = 'R$ 497,00';
	}
	if ( empty( $options['offer_price_launch'] ) ) {
		$options['offer_price_launch'] = 'R$ 297,00';
	}
	if ( in_array( $options['offer_price_promo'] ?? '', array( '', 'R$ 197,00' ), true ) ) {
		$options['offer_price_promo'] = 'R$ 197,00';
	}

	update_option( 'ppf_options', $options );
	update_option( 'ppf_launch_price_migrated_v2', 1 );
}
add_action( 'init', 'ppf_migrate_launch_price_v2' );

/**
 * URL de checkout ativa no momento: usa o link de campanha enquanto a
 * campanha estiver dentro do prazo configurado, senao cai no checkout
 * padrao da plataforma escolhida (Kiwify ou Greenn).
 */
function ppf_get_active_checkout_url() {
	$options = ppf_get_options();

	if ( ! empty( $options['campaign_checkout_url'] ) && ppf_campaign_is_active( $options['campaign_ends_at'] ) ) {
		return $options['campaign_checkout_url'];
	}

	return 'greenn' === $options['checkout_provider']
		? $options['greenn_checkout_url']
		: $options['kiwify_checkout_url'];
}

function ppf_campaign_is_active( $ends_at ) {
	if ( empty( $ends_at ) ) {
		return false;
	}
	$timestamp = strtotime( $ends_at );
	return $timestamp && $timestamp > current_time( 'timestamp' );
}

function ppf_register_settings() {
	register_setting( 'ppf_options_group', 'ppf_options', array(
		'sanitize_callback' => 'ppf_sanitize_options',
	) );
}
add_action( 'admin_init', 'ppf_register_settings' );

function ppf_sanitize_options( $input ) {
	$defaults = ppf_option_defaults();
	$output   = array();

	$output['checkout_provider']       = in_array( $input['checkout_provider'] ?? '', array( 'kiwify', 'greenn' ), true ) ? $input['checkout_provider'] : $defaults['checkout_provider'];
	$output['kiwify_checkout_url']     = esc_url_raw( $input['kiwify_checkout_url'] ?? '' );
	$output['greenn_checkout_url']     = esc_url_raw( $input['greenn_checkout_url'] ?? '' );
	$output['campaign_checkout_url']   = esc_url_raw( $input['campaign_checkout_url'] ?? '' );
	$output['campaign_ends_at']        = sanitize_text_field( $input['campaign_ends_at'] ?? '' );
	$output['campaign_banner_enabled'] = ! empty( $input['campaign_banner_enabled'] ) ? '1' : '0';
	$output['campaign_banner_text']    = sanitize_text_field( $input['campaign_banner_text'] ?? $defaults['campaign_banner_text'] );
	$output['member_area_url']         = esc_url_raw( $input['member_area_url'] ?? '' );
	$output['whatsapp_enabled']        = ! empty( $input['whatsapp_enabled'] ) ? '1' : '0';
	$output['whatsapp_number']         = preg_replace( '/[^0-9]/', '', $input['whatsapp_number'] ?? '' );
	$output['whatsapp_message']        = sanitize_text_field( $input['whatsapp_message'] ?? $defaults['whatsapp_message'] );
	$output['support_email']           = sanitize_email( $input['support_email'] ?? '' );
	$output['gtm_id']                  = sanitize_text_field( $input['gtm_id'] ?? '' );
	$output['clarity_id']              = sanitize_text_field( $input['clarity_id'] ?? '' );
	$output['offer_price_original']    = sanitize_text_field( $input['offer_price_original'] ?? '' );
	$output['offer_price_launch']      = sanitize_text_field( $input['offer_price_launch'] ?? '' );
	$output['offer_price_promo']       = sanitize_text_field( $input['offer_price_promo'] ?? '' );
	$output['offer_price_special_label'] = sanitize_text_field( $input['offer_price_special_label'] ?? '' );
	$output['offer_installments_count']= sanitize_text_field( $input['offer_installments_count'] ?? '' );
	$output['offer_installment_value'] = sanitize_text_field( $input['offer_installment_value'] ?? '' );
	$output['offer_access_duration']   = sanitize_text_field( $input['offer_access_duration'] ?? '' );
	$output['offer_guarantee_text']    = sanitize_textarea_field( $input['offer_guarantee_text'] ?? '' );
	$output['hero_photo_id']           = ! empty( $input['hero_photo_id'] ) ? absint( $input['hero_photo_id'] ) : '';
	$output['company_legal_name']      = sanitize_text_field( $input['company_legal_name'] ?? '' );
	$output['company_cnpj']            = sanitize_text_field( $input['company_cnpj'] ?? '' );
	$output['instagram_url']           = esc_url_raw( $input['instagram_url'] ?? $defaults['instagram_url'] );

	return $output;
}

function ppf_add_options_page() {
	add_menu_page(
		__( 'Pai de Princesa', 'pai-de-princesa' ),
		__( 'Pai de Princesa', 'pai-de-princesa' ),
		'manage_options',
		'ppf-options',
		'ppf_render_options_page',
		'dashicons-heart',
		3
	);
}
add_action( 'admin_menu', 'ppf_add_options_page' );

function ppf_options_admin_assets( $hook ) {
	if ( 'toplevel_page_ppf-options' !== $hook ) {
		return;
	}
	wp_enqueue_media();
	wp_enqueue_script( 'ppf-admin-options', PPF_THEME_URI . '/assets/js/admin-options.js', array( 'jquery' ), PPF_THEME_VERSION, true );
}
add_action( 'admin_enqueue_scripts', 'ppf_options_admin_assets' );

function ppf_render_options_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$options = ppf_get_options();
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Configuracoes - Pai de Princesa', 'pai-de-princesa' ); ?></h1>
		<p><?php esc_html_e( 'O checkout e a area de membros ficam a cargo da Kiwify ou da Greenn. Aqui voce configura apenas os links e as informacoes que aparecem na pagina de vendas.', 'pai-de-princesa' ); ?></p>
		<form method="post" action="options.php">
			<?php settings_fields( 'ppf_options_group' ); ?>

			<h2><?php esc_html_e( 'Checkout', 'pai-de-princesa' ); ?></h2>
			<table class="form-table" role="presentation">
				<tr>
					<th scope="row"><label for="checkout_provider"><?php esc_html_e( 'Plataforma ativa', 'pai-de-princesa' ); ?></label></th>
					<td>
						<select id="checkout_provider" name="ppf_options[checkout_provider]">
							<option value="kiwify" <?php selected( $options['checkout_provider'], 'kiwify' ); ?>>Kiwify</option>
							<option value="greenn" <?php selected( $options['checkout_provider'], 'greenn' ); ?>>Greenn</option>
						</select>
						<p class="description"><?php esc_html_e( 'Define qual link de checkout os botoes "Quero aprender" vao usar.', 'pai-de-princesa' ); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="kiwify_checkout_url"><?php esc_html_e( 'Link de checkout - Kiwify', 'pai-de-princesa' ); ?></label></th>
					<td><input type="url" class="regular-text" id="kiwify_checkout_url" name="ppf_options[kiwify_checkout_url]" value="<?php echo esc_attr( $options['kiwify_checkout_url'] ); ?>" placeholder="https://pay.kiwify.com.br/xxxxxxx" /></td>
				</tr>
				<tr>
					<th scope="row"><label for="greenn_checkout_url"><?php esc_html_e( 'Link de checkout - Greenn', 'pai-de-princesa' ); ?></label></th>
					<td><input type="url" class="regular-text" id="greenn_checkout_url" name="ppf_options[greenn_checkout_url]" value="<?php echo esc_attr( $options['greenn_checkout_url'] ); ?>" placeholder="https://checkout.greenn.com.br/xxxxxxx" /></td>
				</tr>
				<tr>
					<th scope="row"><label for="member_area_url"><?php esc_html_e( 'Link da area do aluno (login)', 'pai-de-princesa' ); ?></label></th>
					<td><input type="url" class="regular-text" id="member_area_url" name="ppf_options[member_area_url]" value="<?php echo esc_attr( $options['member_area_url'] ); ?>" placeholder="https://membros.kiwify.com.br ou area de membros da Greenn" /></td>
				</tr>
			</table>

			<h2><?php esc_html_e( 'Campanha (opcional)', 'pai-de-princesa' ); ?></h2>
			<table class="form-table" role="presentation">
				<tr>
					<th scope="row"><?php esc_html_e( 'Exibir barra de campanha', 'pai-de-princesa' ); ?></th>
					<td><label><input type="checkbox" name="ppf_options[campaign_banner_enabled]" value="1" <?php checked( $options['campaign_banner_enabled'], '1' ); ?> /> <?php esc_html_e( 'Ativar barra no topo do site', 'pai-de-princesa' ); ?></label></td>
				</tr>
				<tr>
					<th scope="row"><label for="campaign_banner_text"><?php esc_html_e( 'Texto da barra', 'pai-de-princesa' ); ?></label></th>
					<td><input type="text" class="regular-text" id="campaign_banner_text" name="ppf_options[campaign_banner_text]" value="<?php echo esc_attr( $options['campaign_banner_text'] ); ?>" /></td>
				</tr>
				<tr>
					<th scope="row"><label for="campaign_ends_at"><?php esc_html_e( 'Encerramento da campanha', 'pai-de-princesa' ); ?></label></th>
					<td>
						<input type="datetime-local" id="campaign_ends_at" name="ppf_options[campaign_ends_at]" value="<?php echo esc_attr( $options['campaign_ends_at'] ); ?>" />
						<p class="description"><?php esc_html_e( 'A barra e o contador somem automaticamente apos essa data/hora.', 'pai-de-princesa' ); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="campaign_checkout_url"><?php esc_html_e( 'Checkout alternativo da campanha', 'pai-de-princesa' ); ?></label></th>
					<td><input type="url" class="regular-text" id="campaign_checkout_url" name="ppf_options[campaign_checkout_url]" value="<?php echo esc_attr( $options['campaign_checkout_url'] ); ?>" /></td>
				</tr>
			</table>

			<h2><?php esc_html_e( 'Oferta', 'pai-de-princesa' ); ?></h2>
			<p class="description"><?php esc_html_e( 'Deixe em branco o que ainda nao foi confirmado: o site mostra "Consulte a condicao disponivel no checkout" nesses campos.', 'pai-de-princesa' ); ?></p>
			<table class="form-table" role="presentation">
				<tr>
					<th scope="row"><label for="offer_price_original"><?php esc_html_e( 'Preco cheio', 'pai-de-princesa' ); ?></label></th>
					<td><input type="text" id="offer_price_original" name="ppf_options[offer_price_original]" value="<?php echo esc_attr( $options['offer_price_original'] ); ?>" placeholder="R$ 000,00" /></td>
				</tr>
				<tr>
					<th scope="row"><label for="offer_price_launch"><?php esc_html_e( 'Preco oficial de lancamento', 'pai-de-princesa' ); ?></label></th>
					<td><input type="text" id="offer_price_launch" name="ppf_options[offer_price_launch]" value="<?php echo esc_attr( $options['offer_price_launch'] ); ?>" placeholder="R$ 000,00" /></td>
				</tr>
				<tr>
					<th scope="row"><label for="offer_price_promo"><?php esc_html_e( 'Preco da oferta especial (destaque)', 'pai-de-princesa' ); ?></label></th>
					<td><input type="text" id="offer_price_promo" name="ppf_options[offer_price_promo]" value="<?php echo esc_attr( $options['offer_price_promo'] ); ?>" placeholder="R$ 000,00" /></td>
				</tr>
				<tr>
					<th scope="row"><label for="offer_price_special_label"><?php esc_html_e( 'Texto da oferta especial', 'pai-de-princesa' ); ?></label></th>
					<td>
						<input type="text" class="regular-text" id="offer_price_special_label" name="ppf_options[offer_price_special_label]" value="<?php echo esc_attr( $options['offer_price_special_label'] ); ?>" placeholder="Ex: Oferta especial para os primeiros 30 compradores" />
						<p class="description"><?php esc_html_e( 'Deixe em branco para nao exibir nenhum texto abaixo do preco. So escreva aqui uma condicao que voce realmente vai cumprir - nao exibimos contador de vagas restantes porque o site nao tem como contar vendas de verdade.', 'pai-de-princesa' ); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="offer_installments_count"><?php esc_html_e( 'Numero de parcelas', 'pai-de-princesa' ); ?></label></th>
					<td><input type="text" id="offer_installments_count" name="ppf_options[offer_installments_count]" value="<?php echo esc_attr( $options['offer_installments_count'] ); ?>" placeholder="12x" /></td>
				</tr>
				<tr>
					<th scope="row"><label for="offer_installment_value"><?php esc_html_e( 'Valor da parcela', 'pai-de-princesa' ); ?></label></th>
					<td><input type="text" id="offer_installment_value" name="ppf_options[offer_installment_value]" value="<?php echo esc_attr( $options['offer_installment_value'] ); ?>" placeholder="R$ 00,00" /></td>
				</tr>
				<tr>
					<th scope="row"><label for="offer_access_duration"><?php esc_html_e( 'Prazo de acesso', 'pai-de-princesa' ); ?></label></th>
					<td><input type="text" id="offer_access_duration" name="ppf_options[offer_access_duration]" value="<?php echo esc_attr( $options['offer_access_duration'] ); ?>" placeholder="Ex: acesso vitalicio, ou 12 meses" /></td>
				</tr>
				<tr>
					<th scope="row"><label for="offer_guarantee_text"><?php esc_html_e( 'Texto da garantia', 'pai-de-princesa' ); ?></label></th>
					<td><textarea id="offer_guarantee_text" name="ppf_options[offer_guarantee_text]" rows="3" class="large-text" placeholder="Ex: 7 dias de garantia incondicional"><?php echo esc_textarea( $options['offer_guarantee_text'] ); ?></textarea></td>
				</tr>
			</table>

			<h2><?php esc_html_e( 'WhatsApp e suporte', 'pai-de-princesa' ); ?></h2>
			<table class="form-table" role="presentation">
				<tr>
					<th scope="row"><?php esc_html_e( 'Botao flutuante do WhatsApp', 'pai-de-princesa' ); ?></th>
					<td><label><input type="checkbox" name="ppf_options[whatsapp_enabled]" value="1" <?php checked( $options['whatsapp_enabled'], '1' ); ?> /> <?php esc_html_e( 'Ativar', 'pai-de-princesa' ); ?></label></td>
				</tr>
				<tr>
					<th scope="row"><label for="whatsapp_number"><?php esc_html_e( 'Numero (com DDI e DDD)', 'pai-de-princesa' ); ?></label></th>
					<td><input type="text" id="whatsapp_number" name="ppf_options[whatsapp_number]" value="<?php echo esc_attr( $options['whatsapp_number'] ); ?>" placeholder="5541999999999" /></td>
				</tr>
				<tr>
					<th scope="row"><label for="whatsapp_message"><?php esc_html_e( 'Mensagem inicial', 'pai-de-princesa' ); ?></label></th>
					<td><input type="text" class="large-text" id="whatsapp_message" name="ppf_options[whatsapp_message]" value="<?php echo esc_attr( $options['whatsapp_message'] ); ?>" /></td>
				</tr>
				<tr>
					<th scope="row"><label for="support_email"><?php esc_html_e( 'E-mail de suporte', 'pai-de-princesa' ); ?></label></th>
					<td><input type="email" class="regular-text" id="support_email" name="ppf_options[support_email]" value="<?php echo esc_attr( $options['support_email'] ); ?>" /></td>
				</tr>
			</table>

			<h2><?php esc_html_e( 'Analytics', 'pai-de-princesa' ); ?></h2>
			<table class="form-table" role="presentation">
				<tr>
					<th scope="row"><label for="gtm_id"><?php esc_html_e( 'Google Tag Manager ID', 'pai-de-princesa' ); ?></label></th>
					<td><input type="text" id="gtm_id" name="ppf_options[gtm_id]" value="<?php echo esc_attr( $options['gtm_id'] ); ?>" placeholder="GTM-XXXXXXX" /></td>
				</tr>
				<tr>
					<th scope="row"><label for="clarity_id"><?php esc_html_e( 'Microsoft Clarity ID (opcional)', 'pai-de-princesa' ); ?></label></th>
					<td><input type="text" id="clarity_id" name="ppf_options[clarity_id]" value="<?php echo esc_attr( $options['clarity_id'] ); ?>" /></td>
				</tr>
			</table>

			<h2><?php esc_html_e( 'Imagem do hero', 'pai-de-princesa' ); ?></h2>
			<table class="form-table" role="presentation">
				<tr>
					<th scope="row"><?php esc_html_e( 'Foto principal (pai e filha)', 'pai-de-princesa' ); ?></th>
					<td>
						<div id="ppf-hero-photo-preview">
							<?php if ( $options['hero_photo_id'] ) : ?>
								<?php echo wp_get_attachment_image( $options['hero_photo_id'], 'medium' ); ?>
							<?php endif; ?>
						</div>
						<input type="hidden" id="hero_photo_id" name="ppf_options[hero_photo_id]" value="<?php echo esc_attr( $options['hero_photo_id'] ); ?>" />
						<p>
							<button type="button" class="button" id="ppf-hero-photo-select"><?php esc_html_e( 'Selecionar imagem', 'pai-de-princesa' ); ?></button>
							<button type="button" class="button" id="ppf-hero-photo-remove"><?php esc_html_e( 'Remover', 'pai-de-princesa' ); ?></button>
						</p>
					</td>
				</tr>
			</table>

			<h2><?php esc_html_e( 'Dados institucionais', 'pai-de-princesa' ); ?></h2>
			<table class="form-table" role="presentation">
				<tr>
					<th scope="row"><label for="company_legal_name"><?php esc_html_e( 'Razao social', 'pai-de-princesa' ); ?></label></th>
					<td><input type="text" class="regular-text" id="company_legal_name" name="ppf_options[company_legal_name]" value="<?php echo esc_attr( $options['company_legal_name'] ); ?>" placeholder="[RAZAO SOCIAL A CONFIRMAR]" /></td>
				</tr>
				<tr>
					<th scope="row"><label for="company_cnpj"><?php esc_html_e( 'CNPJ', 'pai-de-princesa' ); ?></label></th>
					<td><input type="text" id="company_cnpj" name="ppf_options[company_cnpj]" value="<?php echo esc_attr( $options['company_cnpj'] ); ?>" placeholder="[CNPJ A CONFIRMAR]" /></td>
				</tr>
				<tr>
					<th scope="row"><label for="instagram_url"><?php esc_html_e( 'Instagram oficial', 'pai-de-princesa' ); ?></label></th>
					<td><input type="url" class="regular-text" id="instagram_url" name="ppf_options[instagram_url]" value="<?php echo esc_attr( $options['instagram_url'] ); ?>" /></td>
				</tr>
			</table>

			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}
