<?php
/**
 * Exclusive section for home page
 */

$home_page_id = get_option( 'page_on_front' );
$exclusive    = get_field( 'exclusive', $home_page_id );
if ( empty( $exclusive ) ) {
	return;
}

$title                 = $exclusive['title'] ?? __( 'ЭКСКЛЮЗИВНЫЕ' );
$subtitle              = $exclusive['subtitle'] ?? __( 'МОДЕЛИ' );
$main_banner           = $exclusive['main_banner'] ?? '';
$main_banner_product   = $exclusive['main_banner_product'] ?? '';
$second_banner         = $exclusive['second_banner'] ?? '';
$second_banner_product = $exclusive['second_banner_product'] ?? '';
$products              = $exclusive['products'] ?? array();
?>
<section class="exclusive">
    <div class="container">
        <div class="title-wrapper">
            <h2 data-aos="fade-up" data-aos-duration="1400">
				<?php echo esc_html( $title ); ?> <span><?php echo esc_html( $subtitle ); ?></span>
            </h2>
        </div>
        <div class="exclusive-wrapper">

			<?php if ( ! empty( $main_banner ) ) { ?>
                <div class="exclusive-left">
                    <div class="exclusive-left-img" data-popover-container data-aos="fade-up" data-aos-duration="1000">
                        <img class="exclusive-img" src="<?php echo esc_url( $main_banner ); ?>" alt="">
                        <button class="button round call">
                            <img src="<?php echo esc_attr( THEME_URL ); ?>/assets/img/bag.svg" alt="">
                        </button>
						<?php
						get_template_part( 'components/popups/popover',
							null,
							array(
								'product' => $main_banner_product,
							)
						);
						?>
                    </div>
                </div>
			<?php } ?>

            <div class="exclusive-right">
				<?php if ( ! empty( $second_banner ) ) { ?>
                    <div class="exclusive-right-img" data-popover-container data-aos="fade-up" data-aos-duration="1400">
                        <img class="exclusive-img" src="<?php echo esc_url( $second_banner ); ?>" alt="">
                        <button class="button round call">
                            <img src="<?php echo esc_attr( THEME_URL ); ?>/assets/img/bag.svg" alt="">
                        </button>
						<?php
						get_template_part( 'components/popups/popover',
							null,
							array(
								'product' => $second_banner_product,
							)
						);
						?>
                    </div>
				<?php } ?>

				<?php if ( ! empty( $products ) ) { ?>
                    <div class="swiper exclusive-swiper" data-aos="fade-up" data-aos-duration="1700">
                        <div class="swiper-wrapper">
							<?php foreach ( $products as $product ) { ?>
                                <div class="swiper-slide">
									<?php
									get_template_part(
										'components/cards/exclusive-item',
										null,
										array(
											'product' => $product['product'] ?? null,
										)
									);
									?>
                                </div>
							<?php } ?>
                        </div>
                        <div class="swiper-controls">
                            <div class="swiper-buttons">
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
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
				<?php } ?>
            </div>
        </div>
    </div>
</section>