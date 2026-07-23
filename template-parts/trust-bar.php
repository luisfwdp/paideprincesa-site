<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$items = array(
	array(
		'label' => __( 'Aulas simples e praticas', 'pai-de-princesa' ),
		'icon'  => '<path d="M4 5.5C4 4.67 4.67 4 5.5 4H12v16H5.5A1.5 1.5 0 0 1 4 18.5v-13Z"/><path d="M20 5.5c0-.83-.67-1.5-1.5-1.5H12v16h6.5c.83 0 1.5-.67 1.5-1.5v-13Z"/>',
	),
	array(
		'label' => __( 'Assista pelo celular', 'pai-de-princesa' ),
		'icon'  => '<rect x="7" y="2" width="10" height="20" rx="2"/><line x1="11" y1="18" x2="13" y2="18"/>',
	),
	array(
		'label' => __( 'Conteudo para o cotidiano', 'pai-de-princesa' ),
		'icon'  => '<rect x="3" y="4" width="18" height="17" rx="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="16" y1="2" x2="16" y2="6"/>',
	),
	array(
		'label' => __( 'Acesso seguro e imediato apos a confirmacao', 'pai-de-princesa' ),
		'icon'  => '<path d="M12 2 4 5.5V11c0 5 3.4 8.7 8 10 4.6-1.3 8-5 8-10V5.5L12 2Z"/><path d="m9 12 2 2 4-4"/>',
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
