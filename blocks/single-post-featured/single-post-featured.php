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
    <div class="se-container">
        <?php if($heading){ ?>
            <div class="se-posts-featured-top-section"><div class="se-posts-featured-heading"><h3><?= $heading ?></h3></div><span class="h4"></div>
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
                                <?= get_the_post_thumbnail($selected_post, 'full'); ?>
                            </a>
                        </div>
                        <?php
                        }
                        ?>
                        <div class="se-posts-featured-single-content">
                            <h5 class="">
                                <a href="<?php echo esc_url( get_permalink($selected_post) ); ?>">
                                    <?= esc_html( get_the_title($selected_post) ); ?>
                                </a>
                            </h5>
                        </div>
                </article>
                <?php
            }
            wp_reset_postdata();
        }
        ?>
        </div>
    </div>
</div>
