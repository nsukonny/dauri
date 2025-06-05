<?php

$logo_url = get_field( 'logo_url', 'option' ) ?? THEME_URL . '/assets/img/logo-full.svg';
$logo_alt = get_bloginfo( 'name' );

if ( is_front_page() ) {
	$logo = '<span class="footer-logo" ><img alt="' . esc_attr( $logo_alt ) . '" src="' . esc_url( $logo_url ) . '"></span>';
} else {
	$logo = '<a class="footer-logo" href="/"><img alt="' . esc_attr( $logo_alt ) . '" src="' . esc_url( $logo_url ) . '"></a>';
}

?>
<footer class="footer">
    <div class="container">
        <div class="footer-wrapper">
			<?php echo $logo; ?>

            <div class="footer-cols">
				<?php if ( has_nav_menu( 'footer_clocks' ) ) { ?>
                    <div class="footer-col">

                        <div class="col-title">
                            <span><?php _e( 'ЧАСЫ' ); ?></span>
                            <span class="lines">
							<img alt="" class="line-1" src="<?php echo esc_attr( THEME_URL ); ?>/assets/img/line.svg">
							<img alt="" class="line-2" src="<?php echo esc_attr( THEME_URL ); ?>/assets/img/line.svg">
						</span>
                        </div>

						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'footer_clocks',
								'container'      => '',
								'menu_class'     => 'menu',
							)
						);
						?>
                    </div>
				<?php } ?>

				<?php if ( has_nav_menu( 'footer_services' ) ) { ?>
                    <div class="footer-col">
                        <div class="col-title">
                            <span><?php _e( 'УСЛУГИ' ); ?></span>
                            <span class="lines">
							<img alt="" class="line-1" src="<?php echo esc_attr( THEME_URL ); ?>/assets/img/line.svg">
							<img alt="" class="line-2" src="<?php echo esc_attr( THEME_URL ); ?>/assets/img/line.svg">
						</span>
                        </div>
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'footer_services',
								'container'      => '',
								'menu_class'     => 'menu',
							)
						);
						?>
                    </div>
				<?php } ?>

                <div class="footer-col">
                    <div class="footer-buttons">
						<?php get_template_part( 'components/buttons/theme-buttons/theme-button', array( 'class' => 'dark' ) ); ?>
						<?php get_template_part( 'components/buttons/button-ico/button-ico', array(
							'class' => 'dark',
							'src'   => 'img/world.svg',
							'text'  => __( 'ЯЗЫК/РЕГИОН' )
						) ); ?>
                    </div>

					<?php
					$social_networks = get_field( 'social_networks', 'option' );
					if ( ! empty( $social_networks ) ) {
						?>
                        <div class="footer-socials">
							<?php
							foreach ( $social_networks as $network ) {
								?>
                                <a href="<?php echo esc_attr( $network['url'] ); ?>" target="_blank">
                                    <img alt="" src="<?php echo esc_url( $network['icon'] ); ?>">
                                </a>
								<?php
							}
							?>
                        </div>
						<?php
					}
					?>
                </div>

				<?php if ( has_nav_menu( 'footer_company' ) ) { ?>
                    <div class="footer-col">
                        <div class="col-title">
                            <span><?php _e( 'КОМПАНИЯ' ); ?></span>
                            <span class="lines">
                                <img alt="" class="line-1"
                                     src="<?php echo esc_attr( THEME_URL ); ?>/assets/img/line.svg">
                                <img alt="" class="line-2"
                                     src="<?php echo esc_attr( THEME_URL ); ?>/assets/img/line.svg">
                            </span>
                        </div>
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'footer_company',
								'container'      => '',
								'menu_class'     => 'menu',
							)
						);
						?>
                    </div>
				<?php } ?>

				<?php
				$phones          = get_field( 'phones', 'option' );
				$social_contacts = get_field( 'social_contacts', 'option' );

				if ( ! empty( $phones ) || ! empty( $social_contacts ) ) {
					?>
                    <div class="footer-col">
                        <div class="col-title">
                            <span>КОНТАКТЫ</span>
                            <span class="lines">
							<img alt="" class="line-1" src="<?php echo esc_attr( THEME_URL ); ?>/assets/img/line.svg">
							<img alt="" class="line-2" src="<?php echo esc_attr( THEME_URL ); ?>/assets/img/line.svg">
						</span>
                        </div>
                        <div class="footer-col-contacts">
							<?php if ( ! empty( $phones ) ) { ?>
                                <ul class="menu numbers">
									<?php foreach ( $phones as $phone ) {
										?>
                                        <a href="tel:<?php echo esc_attr( $phone['phone_number'] ); ?>"
                                           class="menu-item"><?php echo esc_html( $phone['phone_number'] ); ?></a>
									<?php } ?>
                                </ul>
							<?php } ?>

							<?php if ( ! empty( $social_contacts ) ) { ?>
                                <ul class="menu messengers">
									<?php foreach ( $social_contacts as $contact ) {
										$icon = $contact['icon'] ?? '';
										$url  = $contact['url'] ?? '#';
										?>
                                        <li class="menu-item">
                                            <a href="<?php echo esc_url( $url ); ?>" target="_blank">
                                                <img alt="" src="<?php echo esc_url( $icon ); ?>">
                                            </a>
                                        </li>
									<?php } ?>
                                </ul>
							<?php } ?>
                        </div>
                    </div>
				<?php } ?>
            </div>
        </div>
        <div class="copyright">
            <p>
                © <?php echo date( 'Y' ); ?>, <span>DAURI CLUB</span>. Все права защищены.
            </p>
            <p>
                DESIGNED BY <br>
                <span>KHAMOKOV AGENCY</span>
            </p>
        </div>
    </div>

	<?php wp_footer(); ?>

</footer>

<?php
get_template_part( 'components/banners/cookie-banner/cookie-banner' );
get_template_part( 'components/banners/highlight/highlight' );
get_template_part( 'components/modals/article-modal' );
get_template_part( 'components/modals/success-modal' );
get_template_part( 'components/modals/contact-modal' );
?>
<!-- SVG GRADIENT DEFS FOR HEART. Don't REMOVE IT -->
<svg fill="none" height="0" style="opacity: 0; position: absolute; z-index:-10" viewBox="0 0 39 39" width="0"
     xmlns="http://www.w3.org/2000/svg">
    <defs>
        <linearGradient gradientUnits="userSpaceOnUse" id="heart-grad" x1="21.7442" x2="34.8117" y1="2.89462"
                        y2="54.2348">
            <stop offset="0.15" stop-color="#F6BA83"/>
            <stop offset="0.49" stop-color="#915D47"/>
        </linearGradient>
    </defs>
</svg>
</div><!-- .wrapper -->