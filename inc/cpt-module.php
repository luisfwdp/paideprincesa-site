<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * CPT "Modulos do curso" - grade de conteudo exibida na landing page.
 * Tratado como conteudo inicial editavel: nao afirmamos que e a grade oficial
 * ate ser confirmada pelo administrador (todos comecam publicados com o
 * conteudo do roteiro oficial, mas podem ser editados livremente no wp-admin).
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
		array( 'key' => 'short_description', 'label' => __( 'Descricao curta', 'pai-de-princesa' ), 'type' => 'textarea', 'help' => __( 'Aparece sempre visivel no card do modulo.', 'pai-de-princesa' ) ),
		array( 'key' => 'content_items', 'label' => __( 'Conteudo (um item por linha)', 'pai-de-princesa' ), 'type' => 'textarea', 'help' => __( 'Exibido dentro do accordion "Ver o que voce vai aprender".', 'pai-de-princesa' ) ),
		array( 'key' => 'participants', 'label' => __( 'Participacoes', 'pai-de-princesa' ), 'type' => 'text', 'help' => __( 'Ex: Prity Santos, Rodrigo Fabbris e participacao da filha de Rodrigo.', 'pai-de-princesa' ) ),
		array( 'key' => 'duration_label', 'label' => __( 'Duracao prevista', 'pai-de-princesa' ), 'type' => 'text', 'help' => __( 'Ex: 8 a 10 minutos.', 'pai-de-princesa' ) ),
		array( 'key' => 'badge_label', 'label' => __( 'Selo (opcional)', 'pai-de-princesa' ), 'type' => 'text', 'help' => __( 'Ex: "Com a professora convidada Kimberly" ou "Bonus".', 'pai-de-princesa' ) ),
		array( 'key' => 'featured_quote', 'label' => __( 'Frase em destaque (opcional)', 'pai-de-princesa' ), 'type' => 'textarea' ),
		array( 'key' => 'notice_text', 'label' => __( 'Aviso (opcional)', 'pai-de-princesa' ), 'type' => 'textarea', 'help' => __( 'Ex: aviso de seguranca/supervisao no modulo de maquiagem.', 'pai-de-princesa' ) ),
		array(
			'key'            => 'is_locked',
			'label'          => __( 'Modulo bloqueado?', 'pai-de-princesa' ),
			'type'           => 'checkbox',
			'checkbox_label' => __( 'Exibir como bloqueado/em breve na landing page', 'pai-de-princesa' ),
		),
		array( 'key' => 'admin_review_note', 'label' => __( 'Pendencia administrativa (uso interno)', 'pai-de-princesa' ), 'type' => 'textarea', 'help' => __( 'NUNCA aparece no site publico - visivel apenas aqui, no admin.', 'pai-de-princesa' ) ),
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

/**
 * O roteiro oficial usa "Kimberly" (professora convidada de penteados e
 * maquiagem, modulos 3 e bonus) e "Kemily" (psicologa do modulo 4). Ate ser
 * confirmado se sao a mesma pessoa grafada de duas formas ou duas
 * profissionais diferentes, mantemos os dois nomes como vem no roteiro e
 * avisamos quem edita o conteudo - nunca alteramos silenciosamente.
 */
function ppf_admin_notice_kimberly_kemily() {
	$screen = get_current_screen();
	if ( ! $screen || 'ppf_module' !== $screen->post_type ) {
		return;
	}
	echo '<div class="notice notice-warning"><p><strong>Pai de Princesa:</strong> ' .
		esc_html__( 'Confirmar se Kimberly e Kemily sao duas profissionais diferentes e validar a grafia antes da publicacao definitiva.', 'pai-de-princesa' ) .
		'</p></div>';
}
add_action( 'admin_notices', 'ppf_admin_notice_kimberly_kemily' );
