<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Logo oficial "Pai de Princesa" (extraída da arte fornecida pelo cliente,
 * recortada e exportada em duas variantes de cor - bordô para fundos claros,
 * creme para fundos escuros). Vive em assets/images/brand/ e é usada por
 * padrão em ppf_render_logo() (inc/template-tags.php). Se o admin enviar uma
 * logo própria em Aparência > Personalizar > Identidade do Site, o
 * has_custom_logo() lá tem prioridade sobre esses arquivos.
 */
function ppf_brand_image_url( $filename ) {
	return PPF_THEME_URI . '/assets/images/brand/' . $filename;
}

function ppf_brand_image_path( $filename ) {
	return PPF_THEME_DIR . '/assets/images/brand/' . $filename;
}

/**
 * Copia um arquivo de imagem do tema para a biblioteca de mídia do
 * WordPress e retorna o ID do anexo criado. Usado apenas para o favicon
 * (Site Icon), que precisa ser um anexo de verdade para o WordPress gerar
 * os tamanhos usados em aba do navegador, PWA e apple-touch-icon.
 */
function ppf_import_theme_image_as_attachment( $relative_path, $title ) {
	$file_path = PPF_THEME_DIR . '/' . $relative_path;

	if ( ! file_exists( $file_path ) ) {
		return 0;
	}

	$contents = file_get_contents( $file_path );
	if ( false === $contents ) {
		return 0;
	}

	$upload = wp_upload_bits( basename( $file_path ), null, $contents );
	if ( ! empty( $upload['error'] ) ) {
		return 0;
	}

	$filetype   = wp_check_filetype( $upload['file'], null );
	$attachment = array(
		'post_mime_type' => $filetype['type'],
		'post_title'      => $title,
		'post_content'    => '',
		'post_status'     => 'inherit',
	);

	$attach_id = wp_insert_attachment( $attachment, $upload['file'] );
	if ( ! $attach_id || is_wp_error( $attach_id ) ) {
		return 0;
	}

	require_once ABSPATH . 'wp-admin/includes/image.php';
	$attach_data = wp_generate_attachment_metadata( $attach_id, $upload['file'] );
	wp_update_attachment_metadata( $attach_id, $attach_data );

	return $attach_id;
}

/**
 * Define o favicon (Site Icon) automaticamente na ativação do tema, usando
 * a logo oficial, caso nenhum favicon tenha sido configurado ainda.
 */
function ppf_seed_brand_assets() {
	if ( get_option( 'ppf_brand_assets_seeded' ) ) {
		return;
	}

	if ( ! get_option( 'site_icon' ) ) {
		$icon_id = ppf_import_theme_image_as_attachment(
			'assets/images/brand/site-icon-512.png',
			'Pai de Princesa - ícone do site'
		);
		if ( $icon_id ) {
			update_option( 'site_icon', $icon_id );
		}
	}

	update_option( 'ppf_brand_assets_seeded', 1 );
}
add_action( 'after_switch_theme', 'ppf_seed_brand_assets' );
/*
 * Também em admin_init: sites que já tinham o tema ativo antes desta
 * funcionalidade existir não disparam after_switch_theme só por causa de um
 * git pull. Isso garante que o favicon seja configurado no próximo acesso ao
 * wp-admin, sem precisar reativar o tema manualmente.
 */
add_action( 'admin_init', 'ppf_seed_brand_assets' );
