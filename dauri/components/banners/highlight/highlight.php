<?php
/**
 * Modal for highlight banner
 */

$fields      = get_field( 'world_of_success', 'option' );
$title       = $fields['title'] ?? __( 'БУДЬ В КУРСЕ МИРА <span>РОСКОШИ!</span>' );
$description = $fields['description'] ?? __( 'Получайте эксклюзивные предложения и следите за миром роскоши в нашем TG канале!' );
$button_url  = $fields['button_url'] ?? '/';
$button_text = $fields['button_text'] ?? __( 'ОЩУТИТЬ ПРИВИЛЕГИИ' );
?>
<div id="hightlight-banner" class="highlight-banner">
    <div class="highlight-banner-wrapper">
        <button class="highlight-close">
            <img src="<?php echo esc_attr( THEME_URL ); ?>/assets/img/close.svg" alt="">
        </button>
        <div class="highlight-inner">
            <div class="highlight-title">
				<?php echo $title; ?>
            </div>
            <p><?php echo $description; ?></p>
        </div>
        <a id="highlight-btn" href="<?php esc_attr( $button_url ); ?>" class="button gradient">
			<?php echo esc_html( $button_text ); ?>
        </a>
    </div>
</div>