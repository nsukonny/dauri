<?php
/**
 * Display list of similar products
 *
 * @param WC_Product $wc_product Product object.
 */
$wc_product = $args['product'] ?? null;

if ( empty( $wc_product ) ) {
	return;
}

$terms       = get_the_terms( $wc_product->get_id(), 'product_brand' );
$category_id = $terms[0]->term_id ?? 0;

$related_products_by_category = wc_get_products( array(
	'category' => array( $category_id ),
	'limit'    => 6,
	'exclude'  => array( $wc_product->get_id() ),
) );

$related_products_by_random = array();
if ( empty( $related_products_by_category ) || count( $related_products_by_category ) < 6 ) {
	$related_products_by_random = wc_get_products( array(
		'limit'   => 6,
		'exclude' => array_merge( array( $wc_product->get_id() ), $related_products_by_category ),
	) );
}

$related_products = array_merge( $related_products_by_category, $related_products_by_random );
if ( empty( $related_products ) ) {
	return;
}

get_template_part( 'template-parts/home/slides-half',
	null,
	array(
		'class'       => 'type-a',
		'products'    => $related_products,
		'title'       => __( 'ПОДОБРАЛИ ДЛЯ' ),
		'subtitle'    => __( 'вас' ),
		'description' => '',
		'link'        => __( 'Перейти в каталог' ),
		'link_url'    => get_permalink( wc_get_page_id( 'shop' ) ),
	)
);