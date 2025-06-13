<?php
/**
 * Functionality of catalog component
 */

/**
 * Load more products via AJAX
 *
 * @return void
 */
function dauri_load_more(): void {
	$args = array(
		'post_type'   => 'product',
		'numberposts' => 30,
		'orderby'     => 'date',
		'paged'       => isset( $_POST['page'] ) ? intval( $_POST['page'] ) : 1,
	);

	$term_id = isset( $_POST['term_id'] ) ? intval( $_POST['term_id'] ) : 0;
	if ( 0 !== $term_id ) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'product_cat',
				'field'    => 'term_id',
				'terms'    => $term_id,
			),
		);
	}

	$wc_products = get_posts( $args );

	if ( empty( $wc_products ) ) {
		wp_send_json_success( array( 'is_end' => true, 'html' => '' ) );
		wp_die();
	}

	ob_start();
	foreach ( $wc_products as $product ) {
		get_template_part( 'components/cards/item-card', null, array( 'class' => 'new', 'product' => $product ) );
	}
	$html = ob_get_clean();

	wp_send_json_success( array( 'is_end' => false, 'html' => $html ) );
	wp_die();
}

add_action( 'wp_ajax_dauri_load_more', 'dauri_load_more' );
add_action( 'wp_ajax_nopriv_dauri_load_more', 'dauri_load_more' );