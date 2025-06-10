<?php
/**
 * The template for displaying all single posts.
 *
 * @package DAURI
 */
global $post;

get_header();

$wc_product = wc_get_product( $post->ID );
if ( empty( $wc_product ) ) {
	wp_safe_redirect( home_url( '/404' ) );
	exit;
}

get_template_part( 'template-parts/card/card', null, array( 'product' => $wc_product ) );
get_template_part( 'template-parts/card/perks' );
get_template_part( 'template-parts/card/tabs', null, array( 'product' => $wc_product ) );
get_template_part( 'template-parts/card/similar-products', null, array( 'product' => $wc_product ) );
get_template_part( 'template-parts/card/bottom-cta' );

get_footer();
