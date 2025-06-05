<?php
/**
 * Popover for exclusive section banners on home page
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

$components = $wc_product->get_attribute( 'pa_components' ) ?: '';
$condition  = $wc_product->get_attribute( 'pa_condition' ) ?: '';
?>
<div class="popover-ex">
    <div class="popover-ex-wrapper">
        <button class="close"><img src="<?php echo esc_attr( THEME_URL ); ?>/assets/img/close.svg" alt=""></button>
        <div class="popover-i">
            <div class="popover-i-left">
                <div class="popover-i-img" data-aos="fade-up" data-aos-duration="1000">
					<?php echo $wc_product->get_image( 'dauri-product-thumb' ); ?>
                </div>
            </div>
            <div class="popover-i-right">
                <div class="popover-i-name" data-aos="fade-up" data-aos-duration="1400">
					<?php echo esc_html( $wc_product->get_name() ); ?>
                </div>
                <div class="popover-i-desc">
                    <p class="popover-i-state" data-aos="fade-up" data-aos-duration="1600">
						<?php echo esc_html( $condition ); ?>
                    </p>
                    <p class="popover-i-text" data-aos="fade-up" data-aos-duration="1800">
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
    </div>
</div>