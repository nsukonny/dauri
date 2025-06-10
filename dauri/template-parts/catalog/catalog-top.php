<?php
/**
 * Categories top menu
 *
 * @package dauri
 */

$categories_menu = get_field( 'categories_menu', 'option' );
if ( ! $categories_menu ) {
	return;
}

$current_term_id         = get_queried_object_id();
$is_current_page_is_term = is_tax( 'product_cat' ) || is_product_category() || is_product_tag();
if ( ! $is_current_page_is_term ) {
	$current_term_id = $categories_menu[0]['category']->term_id;
}

$request_product = get_field( 'request_product', 'option' );
?>
<section class="catalog-top">
    <div class="container">
        <div class="catalog-top-wrapper">
            <h1>
				<?php _e( 'КАТАЛОГ' ); ?>
            </h1>
            <div class="catalog-top-scroll">
                <div class="catalog-top-inner">
                    <div class="catalog-top-links">
						<?php
						foreach ( $categories_menu as $category ) {
							$term_url = get_term_link( $category['category'] );
							$class    = ( $current_term_id === $category['category']->term_id ) ? 'active' : '';
							?>
                            <a href="<?php echo esc_url( $term_url ); ?>"
                               class="catalog-link <?php echo esc_attr( $class ); ?>">
								<?php echo esc_html( $category['category']->name ); ?>
                            </a>
						<?php } ?>
                    </div>
					<?php if ( ! empty( $request_product ) ) { ?>
                        <a href="<?php echo esc_attr( $request_product['url'] ); ?>" target="_blank" class="request">
							<?php echo esc_html( $request_product['text'] ); ?>
                        </a>
					<?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>