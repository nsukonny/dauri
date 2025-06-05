<?php
$home_page_id = get_option( 'page_on_front' );
$products     = get_field( 'hight_jewerly_products', $home_page_id );
$slides       = get_field( 'hight_jewerly_slides', $home_page_id );

if ( empty( $products ) || empty( $slides ) ) {
	return;
}

$title       = get_field( 'hight_jewerly_title', $home_page_id ) ?: __( 'HIGH' );
$subtitle    = get_field( 'hight_jewerly_subtitle', $home_page_id ) ?: __( 'JEWELRY' );
$description = get_field( 'hight_jewerly_description', $home_page_id ) ?: __( 'Прикоснитесь к драгоценному совершенству, созданному покорять сердца даже самых искушенных ценителей.' );
$link_text   = get_field( 'hight_jewerly_link_text', $home_page_id ) ?: __( 'Перейти к каталогу' );
$link_url    = get_field( 'hight_jewerly_link_url', $home_page_id ) ?: '#';
?>
<section class="slides">
    <div class="container">
        <div class="title-wrapper">
            <h2 data-aos="fade-up" data-aos-duration="1000">
				<?php echo esc_html( $title ); ?> <span><?php echo esc_html( $subtitle ); ?></span>
            </h2>
            <p data-aos="fade-up" data-aos-duration="1400">
				<?php echo esc_html( $description ); ?>
            </p>
        </div>
        <div class="slides-wrapper">
            <div class="slides-left">
                <div class="swiper swiper-slides">
                    <div class="swiper-wrapper">
						<?php foreach ( $products as $product ) { ?>
                            <div class="swiper-slide">
								<?php
								get_template_part( 'components/cards/item-card',
									null,
									array(
										'class'   => $product['product_group']['is_hot'] ? 'hot' : '',
										'product' => $product['product_group']['product'] ?? null,
									)
								);
								?>
                            </div>
						<?php } ?>
                    </div>
                    <div class="slides-buttons">
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
            <div class="slides-right">
                <div class="swiper fade-swiper">
                    <div class="swiper-wrapper">
						<?php foreach ( $slides as $slide ) { ?>
                            <div class="swiper-slide">
                                <div class="swiper-slide-img">
                                    <img src="<?php echo esc_url( $slide['slide'] ); ?>" alt="">
                                </div>
                            </div>
						<?php } ?>
                    </div>
                    <div class="pagination-wrapper ">
                        <button id="autoplayToggle1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="8" height="11" viewBox="0 0 8 11"
                                 fill="none">
                                <rect width="2.82612" height="10.3625" rx="1.41306" fill="#585858"/>
                                <rect x="4.71094" width="2.82612" height="10.3625" rx="1.41306" fill="#585858"/>
                            </svg>
                        </button>
                        <div class="swiper-pagination  gap-15"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="link-wrapper">
            <a href="<?php echo esc_url( $link_url ); ?>" class="link border"> <span class="line"></span>
				<?php echo esc_html( $link_text ); ?>
            </a>
        </div>
    </div>
</section>