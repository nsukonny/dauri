<?php
/**
 * Detailed card of product
 *
 * @param WC_Product $wc_product Product object.
 */
$faqs = $args['faqs'] ?? null;

if ( empty( $faqs ) ) {
	return;
}

$duration = 500;
?>
<div class="tab-faq">
    <div class="tab-faq-wrapper">
        <h2>
			<?php _e( 'ЧАСТО ЗАДАВАЕМЫЕ' ); ?>
            <span><?php _e( 'ВОПРОСЫ' ); ?></span>
        </h2>
        <div class="dropdowns">
			<?php
			foreach ( $faqs as $faq ) {
				?>
                <div class="dropdown" data-aos="fade-up"
                     data-aos-duration="<?php echo $duration; ?>">
                    <button class="dropdown-button">
                        <span class="dropdown-button-name"><?php echo esc_html( $faq['question'] ); ?></span>
                        <span class="plus"></span>
                    </button>
                    <div class="dropdown-open">
                        <div class="dropdown-inner">
							<?php echo $faq['answer']; ?>
                        </div>
                    </div>
                </div>
				<?php
				$duration += 100;
			}
			?>
        </div>
    </div>
</div>