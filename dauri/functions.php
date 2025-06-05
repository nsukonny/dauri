<?php
/**
 * Dauri functions and definitions
 *
 * @package DAURI
 */

define( 'THEME_PATH', get_template_directory() );
define( 'THEME_URL', get_template_directory_uri() );

/**
 * Add theme menus
 *
 * @return void
 */
function add_blog_menus(): void {
	register_nav_menus(
		array(
			'header_menu'     => __( 'Меню в шапке' ),
			'footer_clocks'   => __( 'Подвал. Часы' ),
			'footer_services' => __( 'Подвал. Услуги' ),
			'footer_company'  => __( 'Подвал. Компания' ),
		)
	);
}

add_action( 'after_setup_theme', 'add_blog_menus' );

/**
 * Adding theme styles
 *
 * @return void
 */
function add_theme_styles(): void {
	wp_register_style(
		'dauri-style',
		THEME_URL . '/assets/css/main.min.css',
		null,
		filemtime( THEME_PATH . '/assets/css/main.min.css' ),
		false
	);

	wp_enqueue_style( 'dauri-style' );

	wp_register_script(
		'dauri-script',
		THEME_URL . '/assets/js/main.min.js',
		null,
		filemtime( THEME_PATH . '/assets/js/main.min.js' ),
		true
	);

	wp_enqueue_script( 'dauri-script' );
}

add_action( 'wp_enqueue_scripts', 'add_theme_styles' );

if ( function_exists( 'acf_add_options_page' ) ) {
	$option_page = acf_add_options_page(
		array(
			'page_title' => __( 'Настройки DAURI' ),
			'menu_title' => __( 'Настройки DAURI' ),
			'menu_slug'  => 'theme-options',
			'capability' => 'edit_posts',
			'redirect'   => false,
		)
	);
}

add_filter( 'show_admin_bar', '__return_false' );

/**
 * Add support for SVG uploads
 *
 * @param $mimes
 *
 * @return mixed
 */
function dauri_allow_svg_uploads( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';

	return $mimes;
}

add_filter( 'upload_mimes', 'dauri_allow_svg_uploads' );

/**
 * Fix SVG display in the admin panel
 *
 * @return void
 */
function dauri_fix_svg_display() {
	echo '<style>
        .attachment-266x266, .thumbnail img {
            width: 100% !important;
            height: auto !important;
        }
    </style>';
}

add_action( 'admin_head', 'dauri_fix_svg_display' );

add_image_size( 'dauri-product-thumb', 143, 171, true );

require_once THEME_PATH . '/components/components.php';