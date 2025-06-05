<?php
/**
 * Detailed card of product
 *
 * @param WC_Product $wc_product Product object.
 */
$wc_product = $args['product'] ?? null;

if ( empty( $wc_product ) ) {
	return;
}

$description            = get_the_content();
$faqs                   = get_field( 'product_faq', 'option' ) ?? array();
$delivery_faqs          = get_field( 'delivery_faq', 'option' ) ?? array();
$guaranty_faqs          = get_field( 'guaranty_faq', 'option' ) ?? array();
$product_delivery       = get_field( 'product_delivery', 'option' ) ?? '';
$product_delivery_short = get_field( 'product_delivery_short', 'option' ) ?? '';
$product_guaranty       = get_field( 'product_guaranty', 'option' ) ?? '';
$product_guaranty_short = get_field( 'product_guaranty_short', 'option' ) ?? '';
?>
<section class="card-tabs">
    <div class="container">
        <div class="card-tabs-buttons" data-aos="fade-up" data-aos-duration="1000">
            <button class="tab-button active" data-tab-button data-id="1">
				<?php _e( 'Описание' ); ?>
            </button>
            <button class="tab-button" data-tab-button data-id="2">
				<?php _e( 'Доставка' ); ?>
            </button>
            <button class="tab-button" data-tab-button data-id="3">
				<?php _e( 'Гарантия Подлинности' ); ?>
            </button>
        </div>
        <div class="card-tab-content active" data-tab-content="1">
            <div class="tab-content-inner">
                <div class="tab-content-desc" data-aos="fade-up" data-aos-duration="1000">
                    <p class="short-desc">
						<?php echo $wc_product->get_short_description(); ?>
                    </p>
					<?php if ( ! empty( $description ) ) { ?>
                        <div class="dropdown">
                            <div class="dropdown-open">
                                <div class="dropdown-inner">
                                    <div class="hidden-content-texts">
										<?php the_content(); ?>
                                    </div>
                                </div>
                            </div>
                            <button class="dropdown-button show-more">
                                <span class="show-more-text"><?php _e( 'Показать еще' ); ?></span>
                            </button>
                        </div>
					<?php } ?>
                </div>

				<?php get_template_part( 'template-parts/card/tab-faq', null, array( 'faqs' => $faqs ) ); ?>

            </div>
        </div>


        <div class="card-tab-content" data-tab-content="2">
            <div class="tab-content-inner">
                <div class="tab-content-desc">
                    <p class="short-desc">
						<?php echo esc_html( $product_delivery_short ); ?>
                    </p>
                    <div class="dropdown">
                        <div class="dropdown-open">
                            <div class="dropdown-inner">
                                <div class="hidden-content-texts">
									<?php echo $product_delivery; ?>
                                </div>
                            </div>
                        </div>
                        <button class="dropdown-button show-more">
                            <span class="show-more-text"><?php _e( 'Показать еще' ); ?></span>
                        </button>
                    </div>
                </div>

				<?php get_template_part( 'template-parts/card/tab-faq', null, array( 'faqs' => $delivery_faqs ) ); ?>

            </div>
        </div>
        <div class="card-tab-content" data-tab-content="3">
            <div class="tab-content-inner">
                <div class="tab-content-desc">
                    <p class="short-desc">
						<?php echo esc_html( $product_guaranty_short ); ?>
                    </p>
                    <div class="dropdown">
                        <div class="dropdown-open">
                            <div class="dropdown-inner">
                                <div class="hidden-content-texts">
									<?php echo $product_guaranty; ?>
                                </div>
                            </div>
                        </div>
                        <button class="dropdown-button show-more">
                            <span class="show-more-text"><?php _e( 'Показать еще' ); ?></span>
                        </button>
                    </div>
                </div>

				<?php get_template_part( 'template-parts/card/tab-faq', null, array( 'faqs' => $guaranty_faqs ) ); ?>

            </div>
        </div>
    </div>
</section>