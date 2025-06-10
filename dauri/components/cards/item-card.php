<?php
/**
 * Card of product
 *
 * @param string $class CSS class for the button. new | hot | sale.
 * @param WC_Product $product Product object.
 */
$product_wp_post = $args['product'] ?? null;
$wc_product      = wc_get_product( $product_wp_post );

if ( empty( $wc_product ) ) {
	return;
}

$class = $args['class'] ?? 'new';
$terms = get_the_terms( $wc_product->get_id(), 'product_brand' );
$brand = $terms[0]->name ?? '';

$diameter   = $wc_product->get_attribute( 'pa_diameter' ) ?: '';
$components = $wc_product->get_attribute( 'pa_components' ) ?: '';
$condition  = $wc_product->get_attribute( 'pa_condition' ) ?: '';

$in_stock = $wc_product->is_in_stock() ? __( 'В НАЛИЧИИ' ) : __( 'ПО ЗАПРОСУ' );
?>
<div class="item-card">
    <a href="<?php echo esc_url( $wc_product->get_permalink() ); ?>" class="item-card-inner">
        <div class="item-card-status <?php echo esc_attr( $class ); ?>">
			<span class="item-status new">
				<img src="<?php echo esc_attr( THEME_URL ); ?>/assets/img/new.svg" alt="">
			</span>
            <span class="item-status hot">
				<img src="<?php echo esc_attr( THEME_URL ); ?>/assets/img/fire.svg" alt="">
			</span>
            <span class="item-status sale">
				<img src="<?php echo esc_attr( THEME_URL ); ?>/assets/img/sale.svg" alt="">
			</span>
        </div>
        <div class="item-card-img" data-aos="zoom-in" data-aos-duration="1000">
			<?php echo $wc_product->get_image( 'dauri-product-thumb' ); ?>
        </div>
    </a>
    <div class="item-card-info">
        <div class="item-card-heading">
            <div class="item-card-name">
                <div class="item-card-mark" data-aos="fade-up" data-aos-duration="1100">
					<?php echo esc_html( $brand ); ?>
                </div>
                <div class="item-card-model" data-aos="fade-up" data-aos-duration="1200">
					<?php echo esc_html( $wc_product->get_name() ); ?>
                </div>
            </div>
            <span class="price">
                <?php echo $wc_product->get_price_html(); ?>
            </span>
        </div>
        <div class="item-card-desc">
            <div class="item-card-size" data-aos="fade-up" data-aos-duration="1300">
				<?php echo esc_html( $diameter ); ?>
            </div>
            <div class="item-card-state" data-aos="fade-up" data-aos-duration="1400">
				<?php echo esc_html( $condition ); ?>
            </div>
            <div class="item-card-text" data-aos="fade-up" data-aos-duration="1500">
				<?php echo esc_html( $components ); ?>
            </div>
        </div>
        <div class="item-card-bottom" data-aos="fade-up" data-aos-duration="1600">
            <div class="indicator-wrapper">
                <div class="item-card-indicator">
					<?php echo esc_html( $in_stock ); ?>
                </div>
            </div>
            <button class="add-to-fav">
                <svg xmlns="http://www.w3.org/2000/svg" width="39" height="39" viewBox="0 0 39 39" fill="none">
                    <path
                            d="M20.2707 10.4723C21.6419 8.98494 23.607 8.05469 25.7907 8.05469C29.86 8.05469 33.1731 11.2865 33.3057 15.3226C33.3074 15.384 33.3091 15.4453 33.3091 15.5067V15.5232C33.3007 15.8383 33.2593 16.5149 33.0653 17.4716C32.3838 20.8444 29.8252 25.0181 20.2689 31.8963C10.7343 25.0331 8.16569 20.8726 7.4792 17.4932C7.28187 16.5249 7.23875 15.84 7.23047 15.5232V15.5067C7.23047 15.4453 7.23213 15.384 7.23379 15.3226C7.36644 11.2865 10.6795 8.05469 14.7488 8.05469"
                            stroke="#1A1A1ACC" stroke-width="2.41692" stroke-miterlimit="10"
                            stroke-linecap="round"/>
                </svg>
            </button>
        </div>
    </div>
</div>