<?php
/**
 * Display products from default category. Means New Products.
 */
$home_page_id      = get_option( 'page_on_front' );
$new_products_data = get_field( 'new_products', $home_page_id );

if ( empty( $new_products_data['products'] ) ) {
	return;
}

get_template_part( 'template-parts/home/slides-half', null, array(
		'class'       => '',
		'title'       => $new_products_data['title'] ?? __( 'Новинки' ),
		'span'        => '',
		'link'        => $new_products_data['link_title'] ?? __( 'Открыть выбор' ),
		'link_url'    => $new_products_data['url'] ?? '/',
		'products'    => $new_products_data['products'],
		'description' => $new_products_data['description'] ?? __( 'Погружение в наши новинки – это когда часы показывают время, а чувства невозможно описать.' ),
	)
);