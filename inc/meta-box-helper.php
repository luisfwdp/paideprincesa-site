<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Helper genérico para registrar meta boxes simples (texto, url, textarea,
 * número, checkbox) em custom post types, sem depender de plugins como ACF.
 * Usado pelos CPTs de responsáveis, FAQ e módulos.
 *
 * @param string $post_type Post type alvo.
 * @param string $box_id    ID único da meta box.
 * @param string $title     Título exibido no admin.
 * @param array  $fields    Lista de campos: [ 'key' => '', 'label' => '', 'type' => 'text|url|textarea|checkbox|number', 'help' => '' ].
 */
function ppf_register_meta_box( $post_type, $box_id, $title, $fields ) {
	add_action( 'add_meta_boxes', function () use ( $post_type, $box_id, $title, $fields ) {
		add_meta_box(
			$box_id,
			$title,
			function ( $post ) use ( $box_id, $fields ) {
				ppf_render_meta_box_fields( $post, $box_id, $fields );
			},
			$post_type,
			'normal',
			'high'
		);
	} );

	add_action( 'save_post_' . $post_type, function ( $post_id ) use ( $box_id, $fields ) {
		ppf_save_meta_box_fields( $post_id, $box_id, $fields );
	} );
}

function ppf_render_meta_box_fields( $post, $box_id, $fields ) {
	wp_nonce_field( $box_id . '_save', $box_id . '_nonce' );
	echo '<table class="form-table" role="presentation"><tbody>';

	foreach ( $fields as $field ) {
		$value = get_post_meta( $post->ID, $field['key'], true );
		$id    = esc_attr( $box_id . '_' . $field['key'] );

		echo '<tr><th scope="row"><label for="' . $id . '">' . esc_html( $field['label'] ) . '</label></th><td>';

		switch ( $field['type'] ) {
			case 'textarea':
				echo '<textarea id="' . $id . '" name="' . $id . '" rows="4" class="large-text">' . esc_textarea( $value ) . '</textarea>';
				break;
			case 'checkbox':
				echo '<label><input type="checkbox" id="' . $id . '" name="' . $id . '" value="1" ' . checked( $value, '1', false ) . ' /> ' . esc_html( $field['checkbox_label'] ?? __( 'Sim', 'pai-de-princesa' ) ) . '</label>';
				break;
			case 'number':
				echo '<input type="number" id="' . $id . '" name="' . $id . '" value="' . esc_attr( $value ) . '" class="small-text" />';
				break;
			case 'url':
				echo '<input type="url" id="' . $id . '" name="' . $id . '" value="' . esc_attr( $value ) . '" class="large-text" placeholder="https://" />';
				break;
			default:
				echo '<input type="text" id="' . $id . '" name="' . $id . '" value="' . esc_attr( $value ) . '" class="large-text" />';
		}

		if ( ! empty( $field['help'] ) ) {
			echo '<p class="description">' . esc_html( $field['help'] ) . '</p>';
		}

		echo '</td></tr>';
	}

	echo '</tbody></table>';
}

function ppf_save_meta_box_fields( $post_id, $box_id, $fields ) {
	$nonce_field = $box_id . '_nonce';

	if ( ! isset( $_POST[ $nonce_field ] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST[ $nonce_field ] ) ), $box_id . '_save' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	foreach ( $fields as $field ) {
		$id = $box_id . '_' . $field['key'];

		if ( 'checkbox' === $field['type'] ) {
			$value = isset( $_POST[ $id ] ) ? '1' : '0';
			update_post_meta( $post_id, $field['key'], $value );
			continue;
		}

		if ( ! isset( $_POST[ $id ] ) ) {
			continue;
		}

		$raw = wp_unslash( $_POST[ $id ] );

		switch ( $field['type'] ) {
			case 'textarea':
				$value = sanitize_textarea_field( $raw );
				break;
			case 'url':
				$value = esc_url_raw( $raw );
				break;
			case 'number':
				$value = is_numeric( $raw ) ? $raw + 0 : '';
				break;
			default:
				$value = sanitize_text_field( $raw );
		}

		update_post_meta( $post_id, $field['key'], $value );
	}
}
