<?php
/**
 * Card of product
 *
 * @param WC_Product $product Product object.
 */
$product_wp_post = $args['product'] ?? null;
$wc_product      = wc_get_product( $product_wp_post );

if ( empty( $wc_product ) ) {
	return;
}

$terms = get_the_terms( $wc_product->get_id(), 'product_brand' );
$brand = $terms[0]->name ?? '';

$components = $wc_product->get_attribute( 'pa_components' ) ?: '';
$condition  = $wc_product->get_attribute( 'pa_condition' ) ?: '';
?>
<div class="video-left-item">
    <div class="item-img" data-aos="zoom-in" data-aos-duration="1200">
		<?php echo $wc_product->get_image( 'dauri-product-thumb' ); ?>
    </div>
    <div class="item-info">
        <span class="item-status">
            <img src="<?php echo esc_attr( THEME_URL ); ?>/assets/img/fire.svg" alt="">
        </span>
        <span class="item-name" data-aos="fade-up" data-aos-duration="1400">
            <?php echo esc_html( $brand ); ?>
        </span>
        <div class="desc-wrapper">
            <span class="item-state" data-aos="fade-up" data-aos-duration="1500">
                <?php echo esc_html( $condition ); ?>
            </span>
            <span class="item-text" data-aos="fade-up" data-aos-duration="1600">
                <?php echo esc_html( $components ); ?>
            </span>
        </div>
        <a class="link underline" href="<?php echo esc_url( $wc_product->get_permalink() ); ?>" data-aos="fade-up"
           data-aos-duration="1700"><?php _e( 'Детальнее' ); ?></a>
    </div>
</div>