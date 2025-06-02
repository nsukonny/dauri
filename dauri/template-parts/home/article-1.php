<?php
/**
 * Article section for home page
 *
 * @var array $args
 * @var WP_Post $post
 *
 * @package DAURI
 */

$home_page_id = get_option( 'page_on_front' );
$post         = get_field( 'dauri_live_post', $home_page_id );

if ( empty( $post ) || ! is_a( $post, 'WP_Post' ) ) {
	return;
}

$content = get_the_content();
$content = str_replace( array( '<p>', '</p>' ), '', $content );
?>
<section class="article">
    <div class="container">
        <div class="article-wrapper">
            <div class="article-img" data-aos="fade-up" data-aos-duration="1300">
                <img src="<?php echo esc_url( get_the_post_thumbnail_url( $post ) ); ?>"
                     alt="<?php echo esc_html( $post->post_title ); ?>">
            </div>
            <div class="article-info">
                <h2 data-aos="fade-up" data-aos-duration="1000">
                    «<?php _e( 'DAURI LIVE' ); ?>»:
                    <span><?php echo esc_html( $post->post_title ); ?></span>
                </h2>
                <p data-aos="fade-up" data-aos-duration="1300">
					<?php echo $content; ?>
                </p>
                <a class="link border" href="<?php the_permalink( $post ); ?>" data-aos="fade-up"
                   data-aos-duration="1700">
                    <span class="line"></span>
					<?php _e( 'Просмотреть LIVE' ); ?>
                </a>
            </div>
        </div>
    </div>
</section>