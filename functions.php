<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'PPF_THEME_VERSION', '1.0.0' );
define( 'PPF_THEME_DIR', get_template_directory() );
define( 'PPF_THEME_URI', get_template_directory_uri() );

require_once PPF_THEME_DIR . '/inc/enqueue.php';
require_once PPF_THEME_DIR . '/inc/meta-box-helper.php';
require_once PPF_THEME_DIR . '/inc/cpt-person.php';
require_once PPF_THEME_DIR . '/inc/cpt-faq.php';
require_once PPF_THEME_DIR . '/inc/cpt-module.php';
require_once PPF_THEME_DIR . '/inc/theme-options.php';
require_once PPF_THEME_DIR . '/inc/default-content.php';
require_once PPF_THEME_DIR . '/inc/template-tags.php';
require_once PPF_THEME_DIR . '/inc/seo.php';
require_once PPF_THEME_DIR . '/inc/analytics.php';

function ppf_theme_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo', array(
		'height'      => 80,
		'width'       => 260,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'automatic-feed-links' );

	register_nav_menus( array(
		'primary' => __( 'Menu principal', 'pai-de-princesa' ),
		'footer'  => __( 'Menu do rodape', 'pai-de-princesa' ),
	) );

	add_image_size( 'ppf-portrait', 900, 1125, true );
	add_image_size( 'ppf-cover', 800, 500, true );
}
add_action( 'after_setup_theme', 'ppf_theme_setup' );

/**
 * front-page.php monta a landing page e o WordPress o usa automaticamente na
 * home, independente da opcao "Sua pagina inicial exibe" em Definicoes >
 * Leitura - MAS somente quando show_on_front = 'posts' (padrao de instalacao
 * nova), ou quando = 'page' com page_on_front apontando para uma pagina
 * real. Se show_on_front ficar em 'page' sem page_on_front definido,
 * is_front_page() passa a retornar falso e o WordPress cai no index.php
 * (lista de posts). Aqui garantimos o estado valido em toda carga, sem
 * depender de reativar o tema.
 */
function ppf_ensure_valid_front_page_setting() {
	if ( 'page' === get_option( 'show_on_front' ) && ! get_option( 'page_on_front' ) ) {
		update_option( 'show_on_front', 'posts' );
	}
}
add_action( 'after_setup_theme', 'ppf_ensure_valid_front_page_setting' );

/**
 * Nunca deixar o WordPress ser indexado acidentalmente enquanto o site estiver em desenvolvimento.
 * O admin controla isso normalmente em Definicoes > Leitura > "Desencorajar mecanismos de busca".
 * Aqui so garantimos um aviso no admin caso essa opcao esteja ativa em producao.
 */
function ppf_admin_notice_search_engine_visibility() {
	if ( '0' === get_option( 'blog_public' ) ) {
		echo '<div class="notice notice-warning"><p><strong>Pai de Princesa:</strong> a opcao "Desencorajar mecanismos de busca" esta ativa em Definicoes &rarr; Leitura. O site nao sera indexado pelo Google enquanto isso nao for desmarcado.</p></div>';
	}
}
add_action( 'admin_notices', 'ppf_admin_notice_search_engine_visibility' );

function ppf_body_classes( $classes ) {
	if ( is_front_page() ) {
		$classes[] = 'ppf-landing';
	}
	return $classes;
}
add_filter( 'body_class', 'ppf_body_classes' );
