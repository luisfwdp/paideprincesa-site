<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$people = ppf_get_published_people();

if ( empty( $people ) ) {
	return;
}
?>
<section class="ppf-section ppf-responsible" id="responsaveis">
	<div class="ppf-container">
		<p class="ppf-eyebrow ppf-eyebrow--center"><?php esc_html_e( 'QUEM ESTÁ POR TRÁS DO PAI DE PRINCESA', 'pai-de-princesa' ); ?></p>
		<h2 class="ppf-section-title ppf-section-title--center"><?php esc_html_e( 'Conhecimento profissional de um lado. A vida real de um pai do outro.', 'pai-de-princesa' ); ?></h2>
		<p class="ppf-section-lead ppf-section-lead--center">
			<?php esc_html_e( 'O Pai de Princesa nasceu da união de duas experiências que se completam: a orientação de quem entende de cuidados com cabelo e beleza e a rotina real de um pai que precisa estar presente todos os dias.', 'pai-de-princesa' ); ?>
		</p>
		<p class="ppf-section-lead ppf-section-lead--center">
			<?php esc_html_e( "Não é um curso criado apenas com teoria. É um conteúdo pensado para os desafios que acontecem antes da escola, nos dias de festa, nas apresentações, nos passeios e em todos aqueles momentos em que uma filha olha para o pai e pergunta: 'Pai, você faz para mim?'", 'pai-de-princesa' ); ?>
		</p>

		<div class="ppf-responsible-grid">
			<?php foreach ( $people as $index => $person ) :
				$style               = 0 === $index % 2 ? 'light' : 'dark';
				$occupation          = get_post_meta( $person->ID, 'occupation', true );
				$city                = get_post_meta( $person->ID, 'city', true );
				$role_label          = get_post_meta( $person->ID, 'role_label', true );
				$subtitle            = get_post_meta( $person->ID, 'subtitle', true );
				$quote               = get_post_meta( $person->ID, 'featured_quote', true );
				$instagram_primary   = get_post_meta( $person->ID, 'instagram_primary', true );
				$instagram_secondary = get_post_meta( $person->ID, 'instagram_secondary', true );
				$cta_label           = get_post_meta( $person->ID, 'cta_label', true );
				$secondary_cta_label = get_post_meta( $person->ID, 'secondary_cta_label', true );
				$consent             = get_post_meta( $person->ID, 'image_consent_confirmed', true );
				$has_photo           = $consent && has_post_thumbnail( $person );
				?>
				<article class="ppf-responsible-card js-reveal ppf-responsible-card--<?php echo esc_attr( $style ); ?>">
					<div class="ppf-responsible-photo">
						<?php if ( $has_photo ) : ?>
							<?php echo get_the_post_thumbnail( $person, 'ppf-portrait', array( 'alt' => esc_attr( get_the_title( $person ) ) ) ); ?>
						<?php else : ?>
							<div class="ppf-media-placeholder" role="img" aria-label="<?php echo esc_attr( sprintf( __( 'Foto de %s - a ser adicionada', 'pai-de-princesa' ), get_the_title( $person ) ) ); ?>">
								<span><?php echo esc_html( get_the_title( $person ) ); ?></span>
								<small><?php esc_html_e( 'Foto e autorização de uso pendentes', 'pai-de-princesa' ); ?></small>
							</div>
						<?php endif; ?>
					</div>

					<div class="ppf-responsible-content">
						<h3><?php echo esc_html( get_the_title( $person ) ); ?></h3>
						<?php if ( $role_label ) : ?>
							<p class="ppf-responsible-role"><?php echo esc_html( $role_label ); ?></p>
						<?php endif; ?>
						<?php
						$meta_line = implode( ' · ', array_filter( array( $occupation, $city ) ) );
						?>
						<?php if ( $meta_line ) : ?>
							<p class="ppf-responsible-meta"><?php echo esc_html( $meta_line ); ?></p>
						<?php endif; ?>
						<?php if ( $subtitle ) : ?>
							<p class="ppf-responsible-subtitle"><?php echo esc_html( $subtitle ); ?></p>
						<?php endif; ?>

						<div class="ppf-responsible-bio"><?php echo wp_kses_post( wpautop( $person->post_content ) ); ?></div>

						<?php if ( $quote ) : ?>
							<blockquote class="ppf-responsible-quote">&ldquo;<?php echo esc_html( $quote ); ?>&rdquo;</blockquote>
						<?php endif; ?>

						<div class="ppf-responsible-links">
							<?php if ( $instagram_primary ) : ?>
								<a href="<?php echo esc_url( $instagram_primary ); ?>" target="_blank" rel="noopener noreferrer" class="ppf-btn ppf-btn--ghost ppf-btn--small js-responsible-link" data-person-slug="<?php echo esc_attr( $person->post_name ); ?>" data-link-type="personal_instagram">
									<?php echo esc_html( $cta_label ? $cta_label : sprintf( __( 'Conhecer %s', 'pai-de-princesa' ), get_the_title( $person ) ) ); ?>
									<span aria-hidden="true">&#8599;</span>
								</a>
							<?php endif; ?>
							<?php if ( $instagram_secondary ) : ?>
								<a href="<?php echo esc_url( $instagram_secondary ); ?>" target="_blank" rel="noopener noreferrer" class="ppf-responsible-secondary-link js-responsible-link" data-person-slug="<?php echo esc_attr( $person->post_name ); ?>" data-link-type="secondary_instagram">
									<?php echo esc_html( $secondary_cta_label ? $secondary_cta_label : __( 'Ver perfil profissional', 'pai-de-princesa' ) ); ?>
									<span aria-hidden="true">&#8599;</span>
								</a>
							<?php endif; ?>
						</div>
					</div>
				</article>
			<?php endforeach; ?>
		</div>

		<div class="ppf-responsible-closing">
			<h3><?php esc_html_e( 'Ela ensina como fazer. Ele mostra que é possível fazer.', 'pai-de-princesa' ); ?></h3>
			<p><?php esc_html_e( 'Prity leva o conhecimento técnico. Rodrigo traz as dúvidas, os desafios e as situações reais da paternidade. Juntos, eles ajudam a transformar conhecimentos profissionais em orientações possíveis para pais com rotinas reais.', 'pai-de-princesa' ); ?></p>
			<a <?php echo ppf_checkout_cta_attrs( 'responsible_section_cta_click' ); ?>>
				<?php esc_html_e( 'Quero aprender com eles', 'pai-de-princesa' ); ?>
			</a>
		</div>
	</div>
</section>
