<?php
$home_post_id = get_option( 'page_on_front' );
$text         = get_field( 'consult_text', $home_post_id );
if ( empty( $text ) ) {
	return;
}

$btn_text = get_field( 'consult_btn_text', $home_post_id );
?>
<section class="cta">
    <div class="container">
        <div class="cta-wrapper">
            <p><?php echo esc_html( $text ); ?></p>
            <button class="button gradient big">
				<?php echo esc_html( $btn_text ); ?>
            </button>
        </div>
    </div>
</section>