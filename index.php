<?php
get_header();
?>
<div class="ppf-container ppf-container--narrow" style="padding:4rem 0;">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<article>
				<h1><?php the_title(); ?></h1>
				<div><?php the_content(); ?></div>
			</article>
		<?php endwhile; ?>
	<?php else : ?>
		<p><?php esc_html_e( 'Nenhum conteúdo encontrado.', 'pai-de-princesa' ); ?></p>
	<?php endif; ?>
</div>
<?php
get_footer();
