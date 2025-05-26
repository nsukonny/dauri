<?php
$hero_slider = get_field( 'hero_slider', 'option' );
if ( ! $hero_slider ) {
	return;
}
?>
<section class="hero">
    <div class="hero-wrapper">
        <div class="swiper hero-swiper">
            <div class="swiper-wrapper">
				<?php foreach ( $hero_slider as $slide ) {
					$title      = $slide['title'] ?? '';
					$image      = $slide['image'] ?? '';
					$thumb      = $slide['thumb'] ?? '';
					$link_title = $slide['link_title'] ?? '';
					$link_url   = $slide['link_url'] ?? '#';
					?>
                    <div class="swiper-slide">
                        <div class="swiper-slide-img">
                            <img src="<?php echo esc_url( $image ); ?>" alt="">
                        </div>
                        <div class="swiper-slide-info" data-aos="fade-in" data-aos-duration="2000">
                            <div class="slide-info-img">
                                <img src="<?php echo esc_url( $thumb ); ?>" alt="">
                            </div>
                            <div class="slide-info-brand" data-aos="fade-up" data-aos-duration="1000">
                                <img src="<?php echo esc_attr( THEME_URL ); ?>/assets/img/r-m.svg" alt="">
                            </div>
                            <div class="slide-info-desc" data-aos="fade-up" data-aos-duration="1500">
								<?php echo esc_html( $title ); ?>
                            </div>
                            <a class="link underline" href="#" data-aos="fade-up" data-aos-duration="1700">
								<?php echo esc_html( $link_title ); ?>
                            </a>
                        </div>
                    </div>
				<?php } ?>
            </div>
            <div class="container">
                <div class="pagination-wrapper">
                    <button id="autoplayToggle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="8" height="11" viewBox="0 0 8 11" fill="none">
                            <rect width="2.82612" height="10.3625" rx="1.41306" fill="#585858"/>
                            <rect x="4.71094" width="2.82612" height="10.3625" rx="1.41306" fill="#585858"/>
                        </svg>
                    </button>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
</section>