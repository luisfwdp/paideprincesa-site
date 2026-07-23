<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$modules = ppf_get_published_modules();

if ( empty( $modules ) ) {
	return;
}
?>
<section class="ppf-section ppf-curriculum" id="conteudo">
	<div class="ppf-container">
		<p class="ppf-eyebrow ppf-eyebrow--center"><?php esc_html_e( 'CONTEUDO DO CURSO', 'pai-de-princesa' ); ?></p>
		<h2 class="ppf-section-title ppf-section-title--center"><?php esc_html_e( 'O que voce vai aprender, modulo a modulo.', 'pai-de-princesa' ); ?></h2>
		<p class="ppf-section-lead ppf-section-lead--center"><?php esc_html_e( 'Esta e a grade inicial do curso. Os detalhes finais (quantidade exata de aulas e duracao) sao confirmados na area de membros apos a compra.', 'pai-de-princesa' ); ?></p>

		<div class="ppf-curriculum-grid">
			<?php foreach ( $modules as $index => $module ) :
				$lessons_count  = get_post_meta( $module->ID, 'lessons_count', true );
				$duration_label = get_post_meta( $module->ID, 'duration_label', true );
				$is_locked      = '1' === get_post_meta( $module->ID, 'is_locked', true );
				?>
				<article class="ppf-module-card js-reveal <?php echo $is_locked ? 'is-locked' : ''; ?>">
					<div class="ppf-module-cover">
						<?php if ( has_post_thumbnail( $module ) ) : ?>
							<?php echo get_the_post_thumbnail( $module, 'ppf-cover', array( 'alt' => esc_attr( get_the_title( $module ) ) ) ); ?>
						<?php else : ?>
							<div class="ppf-media-placeholder ppf-module-cover-fallback" aria-hidden="true">
								<span><?php echo esc_html( str_pad( $index + 1, 2, '0', STR_PAD_LEFT ) ); ?></span>
							</div>
						<?php endif; ?>
						<?php if ( $is_locked ) : ?>
							<span class="ppf-module-badge">
								<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="5" y="11" width="14" height="9" rx="2"/><path d="M8 11V7a4 4 0 0 1 8 0v4"/></svg>
								<?php esc_html_e( 'Liberado apos os anteriores', 'pai-de-princesa' ); ?>
							</span>
						<?php endif; ?>
					</div>
					<div class="ppf-module-body">
						<h3><?php echo esc_html( get_the_title( $module ) ); ?></h3>
						<p><?php echo esc_html( $module->post_content ); ?></p>
						<div class="ppf-module-meta">
							<?php if ( $lessons_count ) : ?>
								<span><?php echo esc_html( sprintf( _n( '%d aula', '%d aulas', (int) $lessons_count, 'pai-de-princesa' ), (int) $lessons_count ) ); ?></span>
							<?php endif; ?>
							<?php if ( $duration_label ) : ?>
								<span><?php echo esc_html( $duration_label ); ?></span>
							<?php endif; ?>
						</div>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
