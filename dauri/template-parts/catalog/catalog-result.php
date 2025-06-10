<?php
/**
 * Category products
 *
 * @package dauri
 */

$args            = array(
	'post_type'   => 'product',
	'numberposts' => 12,
);
$current_term_id = get_queried_object_id();
if ( ! empty( $current_term_id ) && is_tax( 'product_cat' ) || is_product_category() || is_product_tag() ) {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'product_cat',
			'field'    => 'term_id',
			'terms'    => $current_term_id,
		),
	);
}

$wc_products = get_posts( $args );
?>
<section class="catalog-result">
    <div class="container">
        <div class="catalog-result-wrapper">
            <div class="catalog-result-items">
				<?php
				foreach ( $wc_products as $product ) {
					get_template_part( 'components/cards/item-card',
						null,
						array(
							'class'   => 'new',
							'product' => $product,
						)
					);
				}
				?>
            </div>
        </div>
    </div>
</section>