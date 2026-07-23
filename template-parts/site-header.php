<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$options = ppf_get_options();
?>
<header class="ppf-header" id="ppf-header">
	<div class="ppf-container ppf-header-inner">
		<?php ppf_render_logo( 'dark' ); ?>

		<nav class="ppf-nav" id="ppf-primary-nav" aria-label="<?php esc_attr_e( 'Menu principal', 'pai-de-princesa' ); ?>">
			<a href="#metodo"><?php esc_html_e( 'O que voce vai aprender', 'pai-de-princesa' ); ?></a>
			<a href="#para-quem"><?php esc_html_e( 'Para quem e', 'pai-de-princesa' ); ?></a>
			<a href="#conteudo"><?php esc_html_e( 'Conteudo', 'pai-de-princesa' ); ?></a>
			<a href="#duvidas"><?php esc_html_e( 'Duvidas', 'pai-de-princesa' ); ?></a>
		</nav>

		<div class="ppf-header-actions">
			<?php if ( ! empty( $options['member_area_url'] ) ) : ?>
				<a href="<?php echo esc_url( $options['member_area_url'] ); ?>" class="ppf-btn ppf-btn--ghost ppf-btn--small"><?php esc_html_e( 'Area do aluno', 'pai-de-princesa' ); ?></a>
			<?php endif; ?>
			<a <?php echo ppf_checkout_cta_attrs( 'header_cta_click' ); ?>><?php esc_html_e( 'Quero aprender', 'pai-de-princesa' ); ?></a>

			<button type="button" class="ppf-menu-toggle" id="ppf-menu-toggle" aria-expanded="false" aria-controls="ppf-primary-nav">
				<span class="screen-reader-text"><?php esc_html_e( 'Abrir menu', 'pai-de-princesa' ); ?></span>
				<span class="ppf-menu-toggle-bar"></span>
				<span class="ppf-menu-toggle-bar"></span>
				<span class="ppf-menu-toggle-bar"></span>
			</button>
		</div>
	</div>
</header>
