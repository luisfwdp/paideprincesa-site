<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$options = ppf_get_options();
?>
<section class="ppf-hero">
	<div class="ppf-container ppf-hero-inner">
		<div class="ppf-hero-content">
			<p class="ppf-eyebrow"><?php esc_html_e( 'UM CURSO PARA PAIS QUE QUEREM PARTICIPAR DE VERDADE', 'pai-de-princesa' ); ?></p>
			<h1 class="ppf-hero-title"><?php esc_html_e( 'Aprenda a cuidar dos pequenos detalhes da sua filha - mesmo que ninguem nunca tenha ensinado voce.', 'pai-de-princesa' ); ?></h1>
			<p class="ppf-hero-subtitle"><?php esc_html_e( 'O Pai de Princesa mostra, passo a passo, como cuidar do cabelo, escolher roupas, criar penteados simples e participar da rotina da sua filha com mais seguranca, carinho e confianca.', 'pai-de-princesa' ); ?></p>

			<div class="ppf-hero-ctas">
				<a <?php echo ppf_checkout_cta_attrs( 'hero_cta_click', 'ppf-btn--pulse' ); ?>>
					<?php esc_html_e( 'Quero cuidar com mais confianca', 'pai-de-princesa' ); ?>
				</a>
				<a href="#metodo" class="ppf-btn ppf-btn--ghost">
					<?php esc_html_e( 'Ver o que vou aprender', 'pai-de-princesa' ); ?>
				</a>
			</div>

			<p class="ppf-hero-microcopy"><?php esc_html_e( 'Aulas praticas', 'pai-de-princesa' ); ?> &bull; <?php esc_html_e( 'Acesso pelo celular', 'pai-de-princesa' ); ?> &bull; <?php esc_html_e( 'Aprenda no seu ritmo', 'pai-de-princesa' ); ?></p>
		</div>

		<div class="ppf-hero-media">
			<?php if ( $options['hero_photo_id'] ) : ?>
				<?php echo wp_get_attachment_image( $options['hero_photo_id'], 'large', false, array( 'class' => 'ppf-hero-image' ) ); ?>
			<?php else : ?>
				<div class="ppf-media-placeholder ppf-hero-image" role="img" aria-label="<?php esc_attr_e( 'Foto de um pai penteando o cabelo da filha - a ser adicionada', 'pai-de-princesa' ); ?>">
					<span><?php esc_html_e( '[ Foto: pai penteando o cabelo da filha ]', 'pai-de-princesa' ); ?></span>
					<small><?php esc_html_e( 'Adicione a foto em Pai de Princesa > Imagem do hero', 'pai-de-princesa' ); ?></small>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
