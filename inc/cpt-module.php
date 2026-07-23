<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * CPT "Modulos do curso" - grade de conteudo exibida na landing page.
 * Tratado como conteudo inicial editavel: nao afirmamos que e a grade oficial
 * ate ser confirmada pelo administrador (todos comecam publicados com o
 * conteudo do briefing, mas podem ser editados livremente no wp-admin).
 */
function ppf_register_cpt_module() {
	register_post_type( 'ppf_module', array(
		'labels' => array(
			'name'          => __( 'Modulos do curso', 'pai-de-princesa' ),
			'singular_name' => __( 'Modulo', 'pai-de-princesa' ),
			'add_new_item'  => __( 'Adicionar modulo', 'pai-de-princesa' ),
			'edit_item'     => __( 'Editar modulo', 'pai-de-princesa' ),
			'menu_name'     => __( 'Modulos do curso', 'pai-de-princesa' ),
		),
		'public'              => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_icon'           => 'dashicons-welcome-learn-more',
		'supports'            => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
		'has_archive'         => false,
		'publicly_queryable'  => false,
		'exclude_from_search' => true,
	) );
}
add_action( 'init', 'ppf_register_cpt_module' );

function ppf_module_meta_fields() {
	return array(
		array( 'key' => 'lessons_count', 'label' => __( 'Quantidade de aulas', 'pai-de-princesa' ), 'type' => 'number' ),
		array( 'key' => 'duration_label', 'label' => __( 'Duracao total', 'pai-de-princesa' ), 'type' => 'text', 'help' => __( 'Ex: 45 min', 'pai-de-princesa' ) ),
		array(
			'key'            => 'is_locked',
			'label'          => __( 'Modulo bloqueado?', 'pai-de-princesa' ),
			'type'           => 'checkbox',
			'checkbox_label' => __( 'Exibir como bloqueado/em breve na landing page', 'pai-de-princesa' ),
		),
	);
}

ppf_register_meta_box( 'ppf_module', 'ppf_module_details', __( 'Detalhes do modulo', 'pai-de-princesa' ), ppf_module_meta_fields() );

function ppf_get_published_modules() {
	return get_posts( array(
		'post_type'      => 'ppf_module',
		'post_status'    => 'publish',
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
		'posts_per_page' => -1,
	) );
}
