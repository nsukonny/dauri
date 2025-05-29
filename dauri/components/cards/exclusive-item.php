<?php
/**
 * Product card in exclusive section slider
 *
 * @var WC_Product $product
 *
 * @package DAURI
 */
$wp_post    = $args['product'] ?? null;
$wc_product = wc_get_product( $wp_post );
if ( empty( $wc_product ) ) {
	return;
}

$diameter   = $wc_product->get_attribute( 'pa_diameter' ) ?: '';
$components = $wc_product->get_attribute( 'pa_components' ) ?: '';
$condition  = $wc_product->get_attribute( 'pa_condition' ) ?: '';
?>
<div class="exclusive-item ">
    <div class="exclusive-item-left">
        <div class="exclusive-item-img" data-aos="fade-up" data-aos-duration="1000">
			<?php echo $wc_product->get_image( 'dauri-product-thumb' ); ?>
        </div>
    </div>
    <div class="exclusive-item-right">
        <div class="exclusive-item-status" data-aos="fade-up" data-aos-duration="1300">
			<span>
				<?php _e( 'EXCLUSIVE' ); ?>
			</span>
        </div>
        <div class="exclusive-item-name" data-aos="fade-up" data-aos-duration="1400">
			<?php echo esc_html( $wc_product->get_name() ); ?>
        </div>
        <div class="exclusive-item-desc">
            <p class="exclusive-item-state" data-aos="fade-up" data-aos-duration="1600">
				<?php echo esc_html( $condition ); ?>
            </p>
            <p class="exclusive-item-text" data-aos="fade-up" data-aos-duration="1800">
				<?php echo esc_html( $components ); ?>
            </p>
        </div>
        <a href="<?php echo esc_url( $wc_product->get_permalink() ); ?>"
           class="link underline" data-aos="fade-up"
           data-aos-duration="2000">
			<?php _e( 'Детальнее' ); ?>
        </a>
    </div>
</div>