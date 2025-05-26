<?php

global $post;

get_header();
?>
    <div class="wrapper">
        <?php
        get_template_part(
            'components/banners/banners',
            '',
            array(
                'template' => 'horizontal',
                'banner_field' => 'horizontal_banner',
            )
        );
        ?>
        <div class="main_wrapper">
            <?php
            get_template_part('components/left-menu/left-menu');

            get_template_part('single/single-' . $post->post_type);
            ?>
        </div>

    </div>
<?php
add_video_view($post);

get_footer();
