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
/**
 * @@include( 'template-parts/sections/card/card/card.html' )
 * @@include( 'template-parts/sections/card/perks/perks.html' )
 * @@include( 'template-parts/sections/card/tabs/tabs.html' )
 * @@include( 'template-parts/sections/home/slides-half/slides-half.html', {'class': 'type-a', 'title': 'ПОДОБРАЛИ ДЛЯ', 'span': 'вас', 'link': 'Перейти в каталог'} )
 * @@include( 'template-parts/sections/card/bottom-cta/bottom-cta.html' )
 */

get_footer();
