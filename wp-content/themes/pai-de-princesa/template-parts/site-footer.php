<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$options = ppf_get_options();
?>
<footer class="ppf-footer">
	<div class="ppf-container ppf-footer-inner">
		<div class="ppf-footer-brand">
			<?php ppf_render_logo( 'light' ); ?>
			<p class="ppf-footer-tagline"><?php esc_html_e( 'Talvez ninguem tenha ensinado voce. Mas voce pode aprender.', 'pai-de-princesa' ); ?></p>
			<?php if ( ! empty( $options['instagram_url'] ) ) : ?>
				<a href="<?php echo esc_url( $options['instagram_url'] ); ?>" target="_blank" rel="noopener noreferrer" class="ppf-footer-instagram">
					@paideprincesa.oficial
					<span aria-hidden="true">&#8599;</span>
				</a>
			<?php endif; ?>
		</div>

		<div class="ppf-footer-col">
			<h3><?php esc_html_e( 'Curso', 'pai-de-princesa' ); ?></h3>
			<ul>
				<li><a href="#oferta"><?php esc_html_e( 'Ver oferta', 'pai-de-princesa' ); ?></a></li>
				<?php if ( ! empty( $options['member_area_url'] ) ) : ?>
					<li><a href="<?php echo esc_url( $options['member_area_url'] ); ?>"><?php esc_html_e( 'Area do aluno', 'pai-de-princesa' ); ?></a></li>
				<?php endif; ?>
				<?php if ( ! empty( $options['support_email'] ) ) : ?>
					<li><a href="mailto:<?php echo esc_attr( $options['support_email'] ); ?>"><?php esc_html_e( 'Suporte', 'pai-de-princesa' ); ?></a></li>
				<?php endif; ?>
			</ul>
		</div>

		<div class="ppf-footer-col">
			<h3><?php esc_html_e( 'Institucional', 'pai-de-princesa' ); ?></h3>
			<ul>
				<li><a href="<?php echo esc_url( home_url( '/termos' ) ); ?>"><?php esc_html_e( 'Termos de uso', 'pai-de-princesa' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/privacidade' ) ); ?>"><?php esc_html_e( 'Politica de privacidade', 'pai-de-princesa' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/cookies' ) ); ?>"><?php esc_html_e( 'Politica de cookies', 'pai-de-princesa' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/reembolso' ) ); ?>"><?php esc_html_e( 'Politica de reembolso', 'pai-de-princesa' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/aviso-legal' ) ); ?>"><?php esc_html_e( 'Aviso legal', 'pai-de-princesa' ); ?></a></li>
			</ul>
		</div>
	</div>

	<div class="ppf-container ppf-footer-legal">
		<p>
			&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> Pai de Princesa.
			<?php esc_html_e( 'Todos os direitos reservados.', 'pai-de-princesa' ); ?>
			<?php if ( ! empty( $options['company_legal_name'] ) ) : ?>
				<?php echo esc_html( $options['company_legal_name'] ); ?>
			<?php else : ?>
				[RAZAO SOCIAL A CONFIRMAR]
			<?php endif; ?>
			<?php if ( ! empty( $options['company_cnpj'] ) ) : ?>
				&mdash; CNPJ <?php echo esc_html( $options['company_cnpj'] ); ?>
			<?php else : ?>
				&mdash; CNPJ [A CONFIRMAR]
			<?php endif; ?>
		</p>
	</div>
</footer>
