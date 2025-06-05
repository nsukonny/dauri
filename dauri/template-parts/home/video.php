<?php
$home_page_id      = get_option( 'page_on_front' );
$special_attribute = get_field( 'special_attribute', $home_page_id );

if ( empty( $special_attribute ) ) {
	return;
}
?>
<section class="video">
    <div class="container">
        <h2 data-aos="fade-up" data-aos-duration="1000">
			<?php echo esc_html( $special_attribute['title'] ); ?>
            <span><?php echo esc_html( $special_attribute['subtitle'] ); ?></span>
        </h2>
        <div class="video-wrapper ">
            <div class="video-left">
				<?php
				get_template_part( 'components/cards/video-left-item-card',
					null,
					array(
						'product' => $special_attribute['product'],
					)
				);
				?>
            </div>
            <div class="video-right" data-aos="fade-left" data-aos-duration="1000">
                <video autoplay muted loop preload="auto"
                       poster="<?php echo esc_url( $special_attribute['preview'] ); ?>">
                    <source src="<?php echo esc_url( $special_attribute['video'] ); ?>"
                            type="video/mp4">
                </video>
            </div>
        </div>
    </div>
</section>