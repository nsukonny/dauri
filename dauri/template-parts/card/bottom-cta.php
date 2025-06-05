<?php
/**
 * Luxury world
 *
 * @package dauri
 */

$luxury = get_field( 'luxury', 'option' );
if ( empty( $luxury ) ) {
	return;
}
?>
<section class="bottom-cta" data-aos="fade-in" data-aos-duration="2000">
    <div class="container">
        <div class="bottom-cta-wrapper">
            <h2>
				<?php echo esc_html( $luxury['title'] ); ?>
                <span><?php echo esc_html( $luxury['subtitle'] ); ?></span>
            </h2>
            <p>
				<?php echo esc_html( $luxury['description'] ); ?>
            </p>
            <a href="<?php echo esc_attr( $luxury['link_url'] ); ?>" class="button gradient sm">
				<?php echo esc_html( $luxury['link_text'] ); ?>
            </a>
        </div>
    </div>
</section>