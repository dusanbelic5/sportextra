<?php
/**
 * Single Posts Featured Template
 */

$class_name = 'posts_featured_block';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}

// Fields
$heading         = get_field('heading');
$post_to_display = get_field('posts_to_display');
?>
<div class="<?php echo esc_attr( $class_name ); ?> <?php echo preg_replace('/\W+/','',strtolower(strip_tags($heading))) ?> se-block se-posts-featured-4">
        <?php if($heading){ ?>
            <div class="se-posts-featured-top-section"><div class="se-posts-featured-heading"><span class="h4"><?= $heading ?></span></div></div>
            <?php } ?>
        <div class="se-posts-featured-list">
        <?php
        if ($post_to_display) {
            $count = 0;
            foreach ($post_to_display as $selected_post) {
                setup_postdata($selected_post);
                $count++;
                ?>
                <article class="se-posts-featured-single">
                        <?php
                        if (has_post_thumbnail($selected_post)) { ?>
                        <div class="se-posts-featured-single-image">
                            <a href="<?php echo esc_url( get_permalink($selected_post) ); ?>">
                                <?php
                                    $img_id = get_post_thumbnail_id($selected_post);
                                    $full   = wp_get_attachment_image_src($img_id, 'posts_featured_image');
                                    $thumb  = wp_get_attachment_image_src($img_id, 'image_lazy');
                                ?>
                                <img
                                    src="<?php echo esc_url($thumb[0]); ?>"
                                    data-src="<?php echo esc_url($full[0]); ?>"
                                    width="<?php echo esc_attr($full[1]); ?>"
                                    height="<?php echo esc_attr($full[2]); ?>"
                                    class="lazy-blur"
                                    alt="<?php echo esc_attr(get_the_title($selected_post)); ?>"
                                >
                            </a>
                        </div>
                        <?php
                        }
                        ?>
                        <div class="se-posts-featured-single-content">
                            <span class="h5">
                                <a href="<?php echo esc_url( get_permalink($selected_post) ); ?>">
                                    <?= esc_html( get_the_title($selected_post) ); ?>
                                </a>
                            </span>
                        </div>
                </article>
                <?php
            }
            wp_reset_postdata();
        }
        ?>
        </div>
</div>
