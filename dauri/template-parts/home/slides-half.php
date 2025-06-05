<?php
/**
 * Button with icon component
 *
 * @param string $class CSS class for the button.
 * @param string $span
 * @param string $title Title of the section.
 * @param string $link Link text for the button.
 * @param array $products Array of products to display.
 * @param WC_Product_Simple $product
 */
$products = $args['products'] ?? array();

if ( empty( $products ) ) {
	return;
}

$title       = $args['title'] ?? __( 'Новинки' );
$subtitle    = $args['subtitle'] ?? '';
$description = $args['description'] ?? __( 'Погружение в наши новинки – это когда часы показывают время, а чувства невозможно описать.' );
$span        = $args['span'] ?? '';
$link        = $args['link'] ?? __( 'Открыть выбор' );
$link_url    = $args['link_url'] ?? '/';
$class       = $args['class'] ?? '';
?>
<section class="slides-half <?php echo esc_attr( $class ); ?>">
    <div class="container">
        <div class="slides-half-wrapper">
            <div class="slides-half-left">
                <div class="title-wrapper">
                    <h2 data-aos="fade-up" data-aos-duration="1000">
						<?php echo esc_html( $title ); ?> <span><?php echo esc_html( $subtitle ); ?></span>
                    </h2>
                    <p data-aos="fade-up" data-aos-duration="1200">
						<?php echo esc_html( $description ); ?>
                    </p>
                </div>
                <a href="<?php echo esc_url( $link_url ); ?>" class="link border" data-aos="fade-up"
                   data-aos-duration="1400"><span class="line"></span><?php echo esc_html( $link ); ?></a>
            </div>
            <div class="slides-half-right">
                <div class="swiper slides-half-swiper">
                    <div class="swiper-wrapper">
						<?php foreach ( $products as $product ) {
							$categories       = get_the_terms( $product->get_id(), 'product_cat' );
							$categories_slugs = ! empty( $categories ) ? array_column( $categories, 'slug' ) : array();
							?>
                            <div class="swiper-slide">
								<?php get_template_part( 'components/cards/item-card',
									null,
									array(
										'product' => $product ?? null,
										'class'   => in_array( 'new-product', $categories_slugs ) ? 'new' : '',
									)
								);
								?>
                            </div>
						<?php } ?>
                    </div>
					<?php
					get_template_part( 'components/buttons/swiper-button', null, array(
						'direction' => 'prev',
						'type'      => 'circle'
					) );

					get_template_part( 'components/buttons/swiper-button', null, array(
						'direction' => 'next',
						'type'      => 'circle'
					) );
					?>
                </div>
            </div>
        </div>
    </div>
</section>