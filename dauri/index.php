<?php
/**
 * Home template
 *
 * @package FAP404
 */

get_header();

if ( is_front_page() || is_home() ) {
	get_template_part( 'components/front_page/front_page' );
} else {

}

get_footer();
