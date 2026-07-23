<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$items = array(
	__( 'Aulas simples e praticas', 'pai-de-princesa' ),
	__( 'Assista pelo celular', 'pai-de-princesa' ),
	__( 'Conteudo para o cotidiano', 'pai-de-princesa' ),
	__( 'Acesso seguro e imediato apos a confirmacao', 'pai-de-princesa' ),
);
?>
<section class="ppf-trust-bar">
	<div class="ppf-container ppf-trust-bar-inner">
		<?php foreach ( $items as $item ) : ?>
			<p><?php echo esc_html( $item ); ?></p>
		<?php endforeach; ?>
	</div>
</section>
