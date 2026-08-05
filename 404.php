<?php
get_header();
$options = ppf_get_options();
?>
<section class="ppf-error-page">
	<div class="ppf-container ppf-container--narrow">
		<p class="ppf-eyebrow"><?php esc_html_e( 'ERRO 404', 'pai-de-princesa' ); ?></p>
		<h1><?php esc_html_e( 'Essa página não foi encontrada.', 'pai-de-princesa' ); ?></h1>
		<p><?php esc_html_e( 'O link pode estar incorreto ou a página pode ter sido movida. Volte para o início ou fale com o suporte.', 'pai-de-princesa' ); ?></p>
		<div class="ppf-error-actions">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="ppf-btn ppf-btn--primary"><?php esc_html_e( 'Ir para a página inicial', 'pai-de-princesa' ); ?></a>
			<?php if ( ! empty( $options['support_email'] ) ) : ?>
				<a href="mailto:<?php echo esc_attr( $options['support_email'] ); ?>" class="ppf-btn ppf-btn--ghost"><?php esc_html_e( 'Falar com o suporte', 'pai-de-princesa' ); ?></a>
			<?php endif; ?>
		</div>
	</div>
</section>
<?php
get_footer();
