<?php
$phones          = get_field( 'phones', 'option' );
$social_contacts = get_field( 'social_contacts', 'option' );

if ( empty( $phones ) && empty( $social_contacts ) ) {
	return;
}
?>
<div id="contact-modal" class="modal-wrapper sm fc">
    <div class="modal">
        <div class="modal-content">
            <button class="modal-close" aria-label="Close" alt="<?php _e( 'Закрыть' ); ?>">
                <img src="<?php echo esc_attr( THEME_URL ); ?>/assets/img/close.svg" alt="">
            </button>
            <img class="phone" src="<?php echo esc_attr( THEME_URL ); ?>/assets/img/phone.svg" alt="">

			<?php if ( ! empty( $phones ) ) { ?>
                <div class="phones">
					<?php foreach ( $phones as $phone ) {
						?>
                        <a href="tel:<?php echo esc_attr( $phone['phone_number'] ); ?>"
                        ><?php echo esc_html( $phone['phone_number'] ); ?></a>
					<?php } ?>
                </div>
			<?php } ?>

			<?php if ( ! empty( $social_contacts ) ) { ?>
                <div class="contact-socials">
					<?php foreach ( $social_contacts as $contact ) {
						$icon = $contact['icon'] ?? '';
						$url  = $contact['url'] ?? '#';
						?>
                        <a href="<?php echo esc_url( $url ); ?>" target="_blank">
                            <img alt="" src="<?php echo esc_url( $icon ); ?>">
                        </a>
					<?php } ?>
                </div>
			<?php } ?>
        </div>
    </div>
</div>