<?php
get_header();
?>
<article class="ppf-legal-page">
	<div class="ppf-container ppf-container--narrow">
		<?php while ( have_posts() ) : the_post(); ?>
			<h1 class="ppf-legal-title"><?php the_title(); ?></h1>
			<div class="ppf-legal-content">
				<?php the_content(); ?>
			</div>
		<?php endwhile; ?>
	</div>
</article>
<?php
get_footer();
