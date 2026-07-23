<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
	<noscript><style>.js-reveal{opacity:1!important;transform:none!important;}</style></noscript>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="ppf-skip-link" href="#ppf-main-content"><?php esc_html_e( 'Pular para o conteudo', 'pai-de-princesa' ); ?></a>

<?php get_template_part( 'template-parts/gtm-noscript' ); ?>
<?php get_template_part( 'template-parts/campaign-bar' ); ?>
<?php get_template_part( 'template-parts/site-header' ); ?>

<main id="ppf-main-content">
