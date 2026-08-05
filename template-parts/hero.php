<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$options = ppf_get_options();
?>
<section class="ppf-hero">
	<div class="ppf-container ppf-hero-inner">
		<div class="ppf-hero-content">
			<p class="ppf-eyebrow"><?php esc_html_e( 'CURSO PRÁTICO PARA PAIS PRESENTES', 'pai-de-princesa' ); ?></p>
			<h1 class="ppf-hero-title">
				<?php esc_html_e( "Quando sua filha disser \u{201C}Pai, arruma meu cabelo?\u{201D},", 'pai-de-princesa' ); ?>
				<span class="ppf-text-accent"><?php esc_html_e( 'você vai saber por onde começar', 'pai-de-princesa' ); ?></span>.
			</h1>
			<p class="ppf-hero-subtitle"><?php esc_html_e( 'Aprenda, passo a passo, a cuidar do cabelo, fazer penteados simples, escolher roupas e participar dos pequenos momentos da rotina da sua filha com mais segurança, carinho e confiança.', 'pai-de-princesa' ); ?></p>
			<p class="ppf-hero-support"><?php esc_html_e( 'Talvez ninguém tenha ensinado você. Mas você pode aprender.', 'pai-de-princesa' ); ?></p>

			<div class="ppf-hero-ctas">
				<a <?php echo ppf_checkout_cta_attrs( 'hero_cta_click', 'ppf-btn--pulse' ); ?>>
					<?php esc_html_e( 'Quero aprender a cuidar com confiança', 'pai-de-princesa' ); ?>
				</a>
				<a href="#conteudo" class="ppf-btn ppf-btn--ghost">
					<?php esc_html_e( 'Ver tudo o que vou aprender', 'pai-de-princesa' ); ?>
				</a>
			</div>

			<p class="ppf-hero-microcopy"><?php esc_html_e( '5 módulos práticos + bônus', 'pai-de-princesa' ); ?> &bull; <?php esc_html_e( 'Assista pelo celular', 'pai-de-princesa' ); ?> &bull; <?php esc_html_e( 'Aprenda no seu ritmo', 'pai-de-princesa' ); ?></p>
		</div>

		<div class="ppf-hero-media">
			<?php if ( $options['hero_photo_id'] ) : ?>
				<?php echo wp_get_attachment_image( $options['hero_photo_id'], 'large', false, array( 'class' => 'ppf-hero-image' ) ); ?>
			<?php else : ?>
				<div class="ppf-hero-placeholder ppf-hero-image" role="img" aria-label="<?php esc_attr_e( 'Foto de um pai penteando o cabelo da filha', 'pai-de-princesa' ); ?>">
					<svg width="72" height="72" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
						<circle cx="12" cy="7.5" r="3.5" />
						<path d="M5 21c0-4 3-7.5 7-7.5s7 3.5 7 7.5" />
						<path d="M16.5 10c1.4-.6 2.5-1.9 2.5-3.6C19 4.5 17.2 3 15 3c-1.1 0-2.1.4-2.8 1.1" />
					</svg>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
