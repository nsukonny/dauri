<?php
/**
 * Buttons template
 *
 * @package Dauri
 */

$class = $args['class'] ?? 'header-btn';
?>
<button class="theme-button <?php echo esc_attr( $class ); ?>">
    <img class="lightImg hidden" src="<?php echo esc_attr( THEME_URL ); ?>/assets/img/moon.svg" alt="">
    <img class="darkImg" src="<?php echo esc_attr( THEME_URL ); ?>/assets/img/sun.svg" alt="">
    <span class="theme-text"><?php _e( 'Ночная тема' ); ?></span>
</button>