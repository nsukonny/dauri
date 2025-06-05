<?php
/**
 * Button with icon component
 *
 * @param string $class CSS class for the button.
 * @param string $src URL of the icon image.
 * @param string $text Text to display on the button.
 */

$class = $args['class'] ?? 'dark';
$src   = $args['src'] ?? THEME_URL . '/assets/img/world.svg';
$text  = $args['text'] ?? __( 'ЯЗЫК/РЕГИОН' );
?>

<button class="button-ico <?php echo esc_attr( $class ); ?>">
    <img src="<?php echo esc_url( $src ); ?>" alt="">
    <span><?php echo esc_attr( $text ); ?></span>
</button>