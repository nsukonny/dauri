<?php
/**
 * Header template
 *
 * @package Dauri
 */

$logo_text = get_bloginfo( 'name' );
$logo_url  = get_field( 'logo_url', 'option' ) ?? THEME_URL . '/assets/img/logo-full.svg';
?>
<header class="header">
    <div class="container">
        <div class="header-wrapper">
            <div class="header-left">
                <div class="header-left-inner">
                    <button class="burger-button">
                        <img src="<?php echo esc_attr( THEME_URL ); ?>/assets<?php echo esc_attr( THEME_URL ); ?>/assets/img/line.svg"
                             alt="">
                        <img src="<?php echo esc_attr( THEME_URL ); ?>/assets/img/line.svg" alt="">
                    </button>
                    <button class="contact-button" data-modal-target="contact-modal">
                        <img src="<?php echo esc_attr( THEME_URL ); ?>/assets/img/phone.svg" alt="">
                    </button>
                </div>

				<?php if ( has_nav_menu( 'header_menu' ) ) { ?>
                    <nav class="header-nav">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'header_menu',
								'container'      => '',
								'menu_class'     => 'header-menu',
							)
						);
						?>
                    </nav>
				<?php } ?>
            </div>

			<?php if ( ! is_front_page() ) { ?>
                <a href="<?php echo esc_url( home_url() ); ?>" class="header-logo">
                    <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo esc_attr( $logo_text ); ?>">
                </a>
			<?php } else { ?>
                <div class="header-logo">
                    <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo esc_attr( $logo_text ); ?>">
                </div>
			<?php } ?>

            <div class="header-right">
				<?php get_template_part( 'components/buttons/theme-buttons/theme-button', array( 'class' => 'header-btn' ) ); ?>

                <div class="header-right-buttons">
                    <button class="hidden-m">
                        <img src="<?php echo esc_attr( THEME_URL ); ?>/assets/img/heart.svg" alt="">
                    </button>
                    <button id="search">
                        <img src="<?php echo esc_attr( THEME_URL ); ?>/assets/img/loupe.svg" alt="">
                    </button>
                    <a href="/profile">
                        <img src="<?php echo esc_attr( THEME_URL ); ?>/assets/img/user.svg" alt="">
                    </a>
                </div>

				<?php get_template_part( 'components/searchbar/searchbar' ); ?>

            </div>
        </div>
    </div>
</header>