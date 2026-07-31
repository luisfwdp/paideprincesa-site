<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * CPT "Responsaveis" - usado pela secao "Quem esta por tras do Pai de Princesa"
 * (Prity Santos e Rodrigo Fabbris). Editavel em wp-admin sem precisar de dev:
 * titulo = nome, editor = biografia, imagem destacada = retrato, ordem = drag
 * and drop em Definicoes > Ordenar (menu_order via page-attributes).
 */
function ppf_register_cpt_person() {
	register_post_type( 'ppf_person', array(
		'labels' => array(
			'name'          => __( 'Responsaveis', 'pai-de-princesa' ),
			'singular_name' => __( 'Responsavel', 'pai-de-princesa' ),
			'add_new_item'  => __( 'Adicionar responsavel', 'pai-de-princesa' ),
			'edit_item'     => __( 'Editar responsavel', 'pai-de-princesa' ),
			'menu_name'     => __( 'Responsaveis', 'pai-de-princesa' ),
		),
		'public'             => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'menu_icon'          => 'dashicons-groups',
		'supports'           => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
		'has_archive'        => false,
		'publicly_queryable' => false,
		'exclude_from_search'=> true,
	) );
}
add_action( 'init', 'ppf_register_cpt_person' );

function ppf_person_meta_fields() {
	return array(
		array( 'key' => 'role_label', 'label' => __( 'Funcao no curso', 'pai-de-princesa' ), 'type' => 'text', 'help' => __( 'Ex: Responsavel pela orientacao pratica', 'pai-de-princesa' ) ),
		array( 'key' => 'occupation', 'label' => __( 'Ocupacao', 'pai-de-princesa' ), 'type' => 'text', 'help' => __( 'Ex: Cabeleireira', 'pai-de-princesa' ) ),
		array( 'key' => 'city', 'label' => __( 'Cidade', 'pai-de-princesa' ), 'type' => 'text' ),
		array( 'key' => 'subtitle', 'label' => __( 'Subtitulo (1 linha)', 'pai-de-princesa' ), 'type' => 'text' ),
		array( 'key' => 'featured_quote', 'label' => __( 'Frase em destaque', 'pai-de-princesa' ), 'type' => 'textarea' ),
		array( 'key' => 'instagram_primary', 'label' => __( 'Instagram principal (URL)', 'pai-de-princesa' ), 'type' => 'url' ),
		array( 'key' => 'instagram_secondary', 'label' => __( 'Instagram secundario / profissional (URL)', 'pai-de-princesa' ), 'type' => 'url' ),
		array( 'key' => 'cta_label', 'label' => __( 'Texto do botao principal', 'pai-de-princesa' ), 'type' => 'text', 'help' => __( 'Ex: Conhecer Prity Santos', 'pai-de-princesa' ) ),
		array( 'key' => 'secondary_cta_label', 'label' => __( 'Texto do botao secundario', 'pai-de-princesa' ), 'type' => 'text', 'help' => __( 'Ex: Conhecer o Studio Prity Santos. Deixe em branco para usar "Ver perfil profissional".', 'pai-de-princesa' ) ),
		array(
			'key'            => 'image_consent_confirmed',
			'label'          => __( 'Autorizacao de imagem confirmada?', 'pai-de-princesa' ),
			'type'           => 'checkbox',
			'checkbox_label' => __( 'Sim, ha autorizacao registrada para usar esta fotografia no site', 'pai-de-princesa' ),
			'help'           => __( 'Enquanto nao marcado, o site exibe um placeholder no lugar da imagem destacada, mesmo que uma foto tenha sido enviada.', 'pai-de-princesa' ),
		),
		array( 'key' => 'image_consent_reference', 'label' => __( 'Referencia do consentimento', 'pai-de-princesa' ), 'type' => 'text', 'help' => __( 'Uso interno: onde a autorizacao esta arquivada.', 'pai-de-princesa' ) ),
	);
}

ppf_register_meta_box( 'ppf_person', 'ppf_person_details', __( 'Detalhes do responsavel', 'pai-de-princesa' ), ppf_person_meta_fields() );

/**
 * Retorna os responsaveis publicados, ordenados por menu_order.
 * Um perfil so aparece no front-end quando esta publicado (status "publish"),
 * conforme a regra de nao publicar conteudo pendente de aprovacao.
 */
function ppf_get_published_people() {
	return get_posts( array(
		'post_type'      => 'ppf_person',
		'post_status'    => 'publish',
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
		'posts_per_page' => -1,
	) );
}
