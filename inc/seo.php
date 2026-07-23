<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function ppf_meta_description() {
	return __( 'Aprenda cuidados com cabelo, penteados, roupas e rotina para participar da vida da sua filha com mais confianca, carinho e autonomia.', 'pai-de-princesa' );
}

function ppf_print_head_meta() {
	if ( ! is_front_page() ) {
		return;
	}
	$options     = ppf_get_options();
	$description = ppf_meta_description();
	$url         = home_url( '/' );
	$image       = $options['hero_photo_id'] ? wp_get_attachment_image_url( $options['hero_photo_id'], 'large' ) : '';
	?>
	<meta name="description" content="<?php echo esc_attr( $description ); ?>" />
	<link rel="canonical" href="<?php echo esc_url( $url ); ?>" />

	<meta property="og:type" content="website" />
	<meta property="og:site_name" content="Pai de Princesa" />
	<meta property="og:title" content="Pai de Princesa | Curso pratico para pais presentes" />
	<meta property="og:description" content="<?php echo esc_attr( $description ); ?>" />
	<meta property="og:url" content="<?php echo esc_url( $url ); ?>" />
	<?php if ( $image ) : ?>
		<meta property="og:image" content="<?php echo esc_url( $image ); ?>" />
	<?php endif; ?>

	<meta name="twitter:card" content="summary_large_image" />
	<meta name="twitter:title" content="Pai de Princesa | Curso pratico para pais presentes" />
	<meta name="twitter:description" content="<?php echo esc_attr( $description ); ?>" />
	<?php if ( $image ) : ?>
		<meta name="twitter:image" content="<?php echo esc_url( $image ); ?>" />
	<?php endif; ?>
	<?php
}
add_action( 'wp_head', 'ppf_print_head_meta', 2 );

function ppf_print_structured_data() {
	if ( ! is_front_page() ) {
		return;
	}
	$options = ppf_get_options();
	$url     = home_url( '/' );

	$same_as = array_values( array_filter( array( $options['instagram_url'] ) ) );

	$organization = array(
		'@context' => 'https://schema.org',
		'@type'    => 'Organization',
		'name'     => 'Pai de Princesa',
		'url'      => $url,
		'sameAs'   => $same_as,
	);

	if ( has_custom_logo() ) {
		$logo_id = get_theme_mod( 'custom_logo' );
		$logo    = $logo_id ? wp_get_attachment_image_url( $logo_id, 'full' ) : '';
		if ( $logo ) {
			$organization['logo'] = $logo;
		}
	} else {
		$organization['logo'] = ppf_brand_image_url( 'logo-horizontal-burgundy.png' );
	}

	$website = array(
		'@context' => 'https://schema.org',
		'@type'    => 'WebSite',
		'name'     => 'Pai de Princesa',
		'url'      => $url,
	);

	echo '<script type="application/ld+json">' . wp_json_encode( $organization ) . '</script>' . "\n";
	echo '<script type="application/ld+json">' . wp_json_encode( $website ) . '</script>' . "\n";

	$faqs = ppf_get_published_faqs();
	if ( ! empty( $faqs ) ) {
		$entities = array();
		foreach ( $faqs as $faq ) {
			$entities[] = array(
				'@type'          => 'Question',
				'name'           => get_the_title( $faq ),
				'acceptedAnswer' => array(
					'@type' => 'Answer',
					'text'  => wp_strip_all_tags( $faq->post_content ),
				),
			);
		}
		$faq_schema = array(
			'@context'   => 'https://schema.org',
			'@type'      => 'FAQPage',
			'mainEntity' => $entities,
		);
		echo '<script type="application/ld+json">' . wp_json_encode( $faq_schema ) . '</script>' . "\n";
	}

	/*
	 * Course/Offer schema so e emitido quando o preco promocional esta
	 * configurado no painel - evitamos publicar dados de oferta nao
	 * confirmados nos resultados de busca.
	 */
	if ( ! empty( $options['offer_price_promo'] ) ) {
		$course = array(
			'@context'    => 'https://schema.org',
			'@type'       => 'Course',
			'name'        => 'Pai de Princesa',
			'description' => ppf_meta_description(),
			'provider'    => array(
				'@type' => 'Organization',
				'name'  => 'Pai de Princesa',
				'sameAs' => $url,
			),
			'offers'      => array(
				'@type'         => 'Offer',
				'price'         => preg_replace( '/[^0-9.,]/', '', $options['offer_price_promo'] ),
				'priceCurrency' => 'BRL',
				'url'           => ppf_get_active_checkout_url() ?: $url,
				'availability'  => 'https://schema.org/InStock',
			),
		);
		echo '<script type="application/ld+json">' . wp_json_encode( $course ) . '</script>' . "\n";
	}
}
add_action( 'wp_head', 'ppf_print_structured_data', 3 );

/**
 * Robots.txt e sitemap.xml ja sao gerados nativamente pelo WordPress (desde
 * a 5.5, em /wp-sitemap.xml). Nao recriamos essa infraestrutura aqui - para
 * SEO avancado (breadcrumbs ricos, controle fino de robots por pagina),
 * recomenda-se instalar Yoast SEO ou Rank Math (ver README).
 */
