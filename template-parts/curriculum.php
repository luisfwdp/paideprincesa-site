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
		<p class="ppf-eyebrow ppf-eyebrow--center"><?php esc_html_e( 'CONTEÚDO DO CURSO', 'pai-de-princesa' ); ?></p>
		<h2 class="ppf-section-title ppf-section-title--center"><?php esc_html_e( 'O que você vai aprender no Pai de Princesa', 'pai-de-princesa' ); ?></h2>
		<p class="ppf-section-lead ppf-section-lead--center"><?php esc_html_e( 'Conteúdo direto, demonstrações práticas e orientações criadas para situações reais da rotina entre pai e filha.', 'pai-de-princesa' ); ?></p>

		<div class="ppf-curriculum-grid">
			<?php foreach ( $modules as $index => $module ) :
				$short_description = get_post_meta( $module->ID, 'short_description', true );
				$content_raw        = get_post_meta( $module->ID, 'content_items', true );
				$content_items       = $content_raw ? array_filter( array_map( 'trim', explode( "\n", $content_raw ) ) ) : array();
				$participants        = get_post_meta( $module->ID, 'participants', true );
				$duration_label      = get_post_meta( $module->ID, 'duration_label', true );
				$badge_label         = get_post_meta( $module->ID, 'badge_label', true );
				$featured_quote      = get_post_meta( $module->ID, 'featured_quote', true );
				$notice_text         = get_post_meta( $module->ID, 'notice_text', true );
				$is_locked           = '1' === get_post_meta( $module->ID, 'is_locked', true );
				$variant             = $index % 6;
				$has_details         = ! empty( $content_items ) || $participants || $featured_quote || $notice_text;
				?>
				<article class="ppf-module-card js-reveal <?php echo $is_locked ? 'is-locked' : ''; ?>">
					<div class="ppf-module-cover">
						<?php if ( has_post_thumbnail( $module ) ) : ?>
							<?php echo get_the_post_thumbnail( $module, 'ppf-cover', array( 'alt' => esc_attr( get_the_title( $module ) ) ) ); ?>
						<?php else : ?>
							<div class="ppf-module-cover-fallback ppf-module-cover-fallback--<?php echo esc_attr( $variant ); ?>" aria-hidden="true">
								<span class="ppf-module-cover-fallback-number"><?php echo esc_html( str_pad( $index + 1, 2, '0', STR_PAD_LEFT ) ); ?></span>
								<span class="ppf-module-cover-fallback-label"><?php echo esc_html( get_the_title( $module ) ); ?></span>
							</div>
						<?php endif; ?>
						<?php if ( $badge_label ) : ?>
							<span class="ppf-module-tag"><?php echo esc_html( $badge_label ); ?></span>
						<?php endif; ?>
						<?php if ( $is_locked ) : ?>
							<span class="ppf-module-badge">
								<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="5" y="11" width="14" height="9" rx="2"/><path d="M8 11V7a4 4 0 0 1 8 0v4"/></svg>
								<?php esc_html_e( 'Liberado após os anteriores', 'pai-de-princesa' ); ?>
							</span>
						<?php endif; ?>
					</div>
					<div class="ppf-module-body">
						<h3><?php echo esc_html( get_the_title( $module ) ); ?></h3>
						<?php if ( $short_description ) : ?>
							<p><?php echo esc_html( $short_description ); ?></p>
						<?php endif; ?>
						<div class="ppf-module-meta">
							<?php if ( $duration_label ) : ?>
								<span><?php echo esc_html( $duration_label ); ?></span>
							<?php endif; ?>
						</div>

						<?php if ( $has_details ) : ?>
							<details class="ppf-module-details">
								<summary><?php esc_html_e( 'Ver o que você vai aprender', 'pai-de-princesa' ); ?></summary>
								<?php if ( ! empty( $content_items ) ) : ?>
									<ul class="ppf-module-content-list">
										<?php foreach ( $content_items as $item ) : ?>
											<li><?php echo esc_html( $item ); ?></li>
										<?php endforeach; ?>
									</ul>
								<?php endif; ?>
								<?php if ( $featured_quote ) : ?>
									<blockquote class="ppf-module-quote">&ldquo;<?php echo esc_html( $featured_quote ); ?>&rdquo;</blockquote>
								<?php endif; ?>
								<?php if ( $participants ) : ?>
									<p class="ppf-module-participants"><strong><?php esc_html_e( 'Participações:', 'pai-de-princesa' ); ?></strong> <?php echo esc_html( $participants ); ?></p>
								<?php endif; ?>
								<?php if ( $notice_text ) : ?>
									<p class="ppf-module-notice"><?php echo esc_html( $notice_text ); ?></p>
								<?php endif; ?>
							</details>
						<?php endif; ?>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
