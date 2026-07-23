<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * CPT "Perguntas Frequentes". Titulo = pergunta, editor = resposta.
 * Reordenar arrastando (menu_order) via pagina de listagem do admin.
 */
function ppf_register_cpt_faq() {
	register_post_type( 'ppf_faq', array(
		'labels' => array(
			'name'          => __( 'Perguntas Frequentes', 'pai-de-princesa' ),
			'singular_name' => __( 'Pergunta', 'pai-de-princesa' ),
			'add_new_item'  => __( 'Adicionar pergunta', 'pai-de-princesa' ),
			'edit_item'     => __( 'Editar pergunta', 'pai-de-princesa' ),
			'menu_name'     => __( 'FAQ', 'pai-de-princesa' ),
		),
		'public'              => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_icon'           => 'dashicons-editor-help',
		'supports'            => array( 'title', 'editor', 'page-attributes' ),
		'has_archive'         => false,
		'publicly_queryable'  => false,
		'exclude_from_search' => true,
	) );
}
add_action( 'init', 'ppf_register_cpt_faq' );

function ppf_get_published_faqs() {
	return get_posts( array(
		'post_type'      => 'ppf_faq',
		'post_status'    => 'publish',
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
		'posts_per_page' => -1,
	) );
}
