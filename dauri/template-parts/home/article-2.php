<?php
/**
 * Second article section for home page
 *
 * @var array $args
 * @var WP_Post $post
 *
 * @package DAURI
 */

$home_page_id = get_option( 'page_on_front' );
$post         = get_field( 'service_article', $home_page_id );

if ( empty( $post ) || ! is_a( $post, 'WP_Post' ) ) {
	return;
}

$link_url  = get_field( 'service_article_link_url', $home_page_id );
$link_text = get_field( 'service_article_link_text', $home_page_id );

$content = get_the_content();
$content = str_replace( array( '<p>', '</p>' ), '', $content );
?>
<section class="article">
    <div class="container">
        <div class="article-wrapper">
            <div class="article-img" data-aos="fade-up" data-aos-duration="1300">
                <img src="<?php echo esc_attr( THEME_URL ); ?>/assets/img/a2.jpg" alt="">
            </div>
            <div class="article-info">
                <h2 class="flex flex-col" data-aos="fade-up" data-aos-duration="1000">
					<?php _e( 'DAURI' ); ?>
                    <span><?php echo esc_html( $post->post_title ); ?></span>
                </h2>
                <p data-aos="fade-up" data-aos-duration="1300">
					<?php echo $content; ?>
                </p>
                <a class="link border" href="<?php echo esc_url( $link_url ); ?>" data-aos="fade-up"
                   data-aos-duration="1700">
                    <span class="line"></span>
					<?php echo esc_html( $link_text ); ?>
                </a>
            </div>
        </div>
    </div>
</section>