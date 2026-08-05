<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$items = array(
	array(
		'label' => __( 'Conteúdo simples e direto', 'pai-de-princesa' ),
		'icon'  => '<path d="M4 5.5C4 4.67 4.67 4 5.5 4H12v16H5.5A1.5 1.5 0 0 1 4 18.5v-13Z"/><path d="M20 5.5c0-.83-.67-1.5-1.5-1.5H12v16h6.5c.83 0 1.5-.67 1.5-1.5v-13Z"/>',
	),
	array(
		'label' => __( 'Demonstrações práticas', 'pai-de-princesa' ),
		'icon'  => '<circle cx="12" cy="12" r="9"/><path d="M10 8.5v7l6-3.5-6-3.5Z"/>',
	),
	array(
		'label' => __( 'Acesso pelo celular', 'pai-de-princesa' ),
		'icon'  => '<rect x="7" y="2" width="10" height="20" rx="2"/><line x1="11" y1="18" x2="13" y2="18"/>',
	),
	array(
		'label' => __( 'Aprendizado sem julgamentos', 'pai-de-princesa' ),
		'icon'  => '<path d="M12 21s-7-4.35-9.5-9C.87 8.5 2 5 5.5 5c2 0 3.5 1.5 4.5 3 1-1.5 2.5-3 4.5-3 3.5 0 4.63 3.5 3 7-2.5 4.65-9.5 9-9.5 9Z"/>',
	),
);
?>
<section class="ppf-trust-bar">
	<div class="ppf-container ppf-trust-bar-inner">
		<?php foreach ( $items as $item ) : ?>
			<div class="ppf-trust-item">
				<span class="ppf-trust-icon" aria-hidden="true">
					<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $item['icon']; ?></svg>
				</span>
				<p><?php echo esc_html( $item['label'] ); ?></p>
			</div>
		<?php endforeach; ?>
	</div>
</section>
