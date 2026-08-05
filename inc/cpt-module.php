<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * CPT "Módulos do curso" - grade de conteúdo exibida na landing page.
 * Tratado como conteúdo inicial editável: não afirmamos que é a grade oficial
 * até ser confirmada pelo administrador (todos começam publicados com o
 * conteúdo do roteiro oficial, mas podem ser editados livremente no wp-admin).
 */
function ppf_register_cpt_module() {
	register_post_type( 'ppf_module', array(
		'labels' => array(
			'name'          => __( 'Módulos do curso', 'pai-de-princesa' ),
			'singular_name' => __( 'Módulo', 'pai-de-princesa' ),
			'add_new_item'  => __( 'Adicionar módulo', 'pai-de-princesa' ),
			'edit_item'     => __( 'Editar módulo', 'pai-de-princesa' ),
			'menu_name'     => __( 'Módulos do curso', 'pai-de-princesa' ),
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
		array( 'key' => 'short_description', 'label' => __( 'Descrição curta', 'pai-de-princesa' ), 'type' => 'textarea', 'help' => __( 'Aparece sempre visível no card do módulo.', 'pai-de-princesa' ) ),
		array( 'key' => 'content_items', 'label' => __( 'Conteúdo (um item por linha)', 'pai-de-princesa' ), 'type' => 'textarea', 'help' => __( 'Exibido dentro do accordion "Ver o que você vai aprender".', 'pai-de-princesa' ) ),
		array( 'key' => 'participants', 'label' => __( 'Participações', 'pai-de-princesa' ), 'type' => 'text', 'help' => __( 'Ex: Prity Santos, Rodrigo Fabbris e participação da filha de Rodrigo.', 'pai-de-princesa' ) ),
		array( 'key' => 'duration_label', 'label' => __( 'Duração prevista', 'pai-de-princesa' ), 'type' => 'text', 'help' => __( 'Ex: 8 a 10 minutos.', 'pai-de-princesa' ) ),
		array( 'key' => 'badge_label', 'label' => __( 'Selo (opcional)', 'pai-de-princesa' ), 'type' => 'text', 'help' => __( 'Ex: "Com a professora convidada Kimberly" ou "Bônus".', 'pai-de-princesa' ) ),
		array( 'key' => 'featured_quote', 'label' => __( 'Frase em destaque (opcional)', 'pai-de-princesa' ), 'type' => 'textarea' ),
		array( 'key' => 'notice_text', 'label' => __( 'Aviso (opcional)', 'pai-de-princesa' ), 'type' => 'textarea', 'help' => __( 'Ex: aviso de segurança/supervisão no módulo de maquiagem.', 'pai-de-princesa' ) ),
		array(
			'key'            => 'is_locked',
			'label'          => __( 'Módulo bloqueado?', 'pai-de-princesa' ),
			'type'           => 'checkbox',
			'checkbox_label' => __( 'Exibir como bloqueado/em breve na landing page', 'pai-de-princesa' ),
		),
		array( 'key' => 'admin_review_note', 'label' => __( 'Pendência administrativa (uso interno)', 'pai-de-princesa' ), 'type' => 'textarea', 'help' => __( 'NUNCA aparece no site público - visível apenas aqui, no admin.', 'pai-de-princesa' ) ),
	);
}

ppf_register_meta_box( 'ppf_module', 'ppf_module_details', __( 'Detalhes do módulo', 'pai-de-princesa' ), ppf_module_meta_fields() );

function ppf_get_published_modules() {
	return get_posts( array(
		'post_type'      => 'ppf_module',
		'post_status'    => 'publish',
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
		'posts_per_page' => -1,
	) );
}

/**
 * O roteiro oficial usa "Kimberly" (professora convidada de penteados e
 * maquiagem, módulos 3 e bônus) e "Kemily" (psicóloga do módulo 4). Até ser
 * confirmado se são a mesma pessoa grafada de duas formas ou duas
 * profissionais diferentes, mantemos os dois nomes como vêm no roteiro e
 * avisamos quem edita o conteúdo - nunca alteramos silenciosamente.
 */
function ppf_admin_notice_kimberly_kemily() {
	$screen = get_current_screen();
	if ( ! $screen || 'ppf_module' !== $screen->post_type ) {
		return;
	}
	echo '<div class="notice notice-warning"><p><strong>Pai de Princesa:</strong> ' .
		esc_html__( 'Confirmar se Kimberly e Kemily são duas profissionais diferentes e validar a grafia antes da publicação definitiva.', 'pai-de-princesa' ) .
		'</p></div>';
}
add_action( 'admin_notices', 'ppf_admin_notice_kimberly_kemily' );
