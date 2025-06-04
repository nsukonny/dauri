<?php
/**
 * Perks section template
 *
 * @package dauri
 */

$perks = get_field( 'perks', 'option' );
if ( empty( $perks ) ) {
	return;
}
?>
<section class="perks" data-aos="fade-up" data-aos-duration="1000">
    <div class="container">
        <div class="perks-wrapper">
            <div class="swiper swiper-card-carousel">
                <div class="swiper-wrapper">
					<?php foreach ( $perks as $perk ) { ?>
                        <div class="swiper-slide">
                            <div class="perks-item">
                                <img src="<?php echo esc_url( $perk['icon'] ); ?>"
                                     alt="<?php echo esc_attr( $perk['title'] ); ?>">
                                <span><?php echo esc_html( $perk['title'] ); ?></span>
                            </div>
                        </div>
					<?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>