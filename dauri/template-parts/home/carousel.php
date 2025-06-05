<?php
/**
 * Show brands carousel on home page
 */
$home_page_id = get_option( 'page_on_front' );
$brands       = get_field( 'brands', $home_page_id );

if ( empty( $brands ) || ! is_array( $brands ) ) {
	return;
}
?>
<section class="carousel">
    <div class="swiper swiper-carousel" data-aos="fade-left" data-aos-duration="2000">
        <div class="swiper-wrapper">
			<?php foreach ( $brands as $brand ) { ?>
                <div class="swiper-slide">
                    <img src="<?php echo esc_url( $brand['image']['sizes']['thumbnail'] ); ?>"
                         alt="<?php echo esc_attr( $brand['image']['alt'] ); ?>">
                </div>
			<?php } ?>
        </div>
    </div>
</section>